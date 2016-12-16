(function(window, document, $) {
	'use strict';

	var vfbTableTop;

	var VFBProRunningTotal = function() {
		this.entry          = '';
		this.decimals       = 2;
		this.basePrice      = 0;
		this.basePriceText  = '';
		this.currency       = '';
        this.totalText      = '';
        this.publicForm     = '';
        this.priceFields    = [];

        this.tmpl = '<table id="run" border="0" cellspacing="0" cellpadding="0">' +
	    		   '<tfoot>{rows}</tfoot>' +
				   '<tbody>' +
				   '<tr><td colspan="2"><b>{totalText}</b><span>{total}</span></td></tr>' +
				   '</tbody>' +
				   '</table>';

		this.init();

		if ( this.showRunningTotal() ) {
			this.organizePriceFields( this.priceFields );
            this.updateTotal();
            this.calculateTop();
            this.runScroll();

            $( window ).on( 'scroll', this.runScroll );
		}
	};

	VFBProRunningTotal.prototype = {
		init : function() {
			var self = this;

			if ( window.vfbp_prices ) {
				var obj = $.parseJSON( vfbp_prices.prices ),
					selectors = [],
					keyupSelectors = [];

				$( obj ).each( function() {
					var currency      = this.currency,
						decimals      = this.decimals,
						totalText     = this['total-text'],
						basePriceName = this['base-price-name'],
						basePrice     = this['base-price'],
						priceFields   = this['price-fields'];

					self.currency      = currency;
		            self.decimals      = decimals;
		            self.totalText     = totalText;
		            self.basePriceText = basePriceName;
		            self.basePrice     = self.toNumber( basePrice );
		            self.priceFields   = priceFields;

		            $.each( priceFields, function(){
						selectors.push( '[name^=vfb-field-' + this['field-id'] + ']' );

						if ( this.type === 'currency' ) {
							keyupSelectors.push( '[name^=vfb-field-' + this['field-id'] + ']' );
						}
					});

					$( selectors.join(',') ).change( function(){
						self.updateTotal();
					});

					$( keyupSelectors.join(',') ).keyup( function(){
						self.updateTotal();
					});
				});
			}
		},
		showRunningTotal: function() {
			var canShowRunningTotal = false;

            if ( $( '#vfbp-running-total' ).length ) {
                canShowRunningTotal = true;
            }

            return canShowRunningTotal;
		},
		calculateTop: function() {
            var el = document.getElementById( 'vfbp-running-total' );
            vfbTableTop =- 75;

            if ( el ) {
                vfbTableTop += $( el ).offset().top;
                el = el.offsetParent;
            }
        },
        runScroll: function() {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
            var $table = $( '#vfbp-running-total' );

            if ( scrollTop >= vfbTableTop && $table.length ) {
                $table.css( 'margin-top', scrollTop - vfbTableTop + 7 );
            }
            else {
                $table.css( 'margin-top', 7 );
            }
        },
        organizePriceFields: function( rawPriceFields ) {
            this.priceFields = [];
            var self = this;

            $.each( rawPriceFields, function( index, field ) {
				//var theField  = field['field-id'],
				var	type      = field.type;

				if ( String( type ) === 'checkbox' ) {
					$.each( field, function( key, obj ) {
						if ( typeof obj === 'object' ) {
                            self.addToPriceFields( field, obj, key);
                        }
					});
				}
				else if ( String( type ) === 'radio' || String( type ) === 'select' ) {
					var textToIndex = self.getTextToIndexs( field );

					$.each( field, function( key, obj ) {
						if ( typeof obj === 'object' ) {
                            var index = textToIndex[ obj.choice ];
                            self.addToPriceFields( field, obj, index);
                        }
					});
				}
				else if ( String( type ) === 'currency' ) {
					field.price = '1';
					self.addToPriceFields( field, null, 0 );
				}
            });
        },
        addToPriceFields: function( field, subObj, i ) {
	        var priceField = {},
	        	obj = ( String( field.type ) === 'currency' ) ? field : subObj;

            priceField.FieldID  = field['field-id'];
            priceField.Price    = obj.price;
            priceField.Choice   = obj.choice;
            priceField.Type     = field.type;
            priceField.Index    = i;

            if ( String( field.type ) === 'currency' ) {
                priceField.Header = obj.title;
            }
            else {
                priceField.Header = obj.choice;
            }

            this.priceFields.push( priceField );
        },
        getTextToIndexs: function( obj ) {
            var count   = 0,
            	fieldID = obj['field-id'],
            	textToIndex = [];

            $.each( obj, function() {
	            var $el = $( '#vfb-field-' + fieldID + '-' + count );

	            if ( $el.length ) {
                    textToIndex[ $el.val() ] = count;
                }

                count += 1;
			});

            return textToIndex;
        },
        updateTotal: function() {
            var $table = $( '#vfbp-running-total' );

            if ( $table.length ) {
                var fieldToPrices = this.getFieldToPrices(),
                	tableHTML     = this.buildRunningTotalTable( fieldToPrices );

                $table.html( tableHTML );
            }
        },
        buildRunningTotalTable: function( fieldToPrices ) {
            var html = '',
            	total = this.basePrice;

            if ( this.basePrice > 0 ) {
                html += '<tr><th>' + this.basePriceText + '</th>';
                html += '<td>' + this.formatNumber( this.basePrice ) + '</td></tr>';
            }

            for ( var i = 0; i < fieldToPrices.length; i++ ) {
                var fieldToPrice = fieldToPrices[i];
                total = total + fieldToPrice.fieldValue;

                var className = ( fieldToPrice.fieldValue < 0 ) ? 'vfb-negative-amount': '';
                html += '<tr class="' + className + '"><th>' + fieldToPrice.field.Header + '</th>';
                html += '<td>' + this.formatNumber( fieldToPrice.fieldValue ) + '</td></tr>';
            }

            var tplValues = {
                'totalText': this.totalText,
                'total': this.formatNumber( total ),
                'rows': html
            };

            return this.template( tplValues );
        },
        getFieldToPrices: function() {
            var fieldToPrices = [],
            	fieldValue,
            	fieldToPrice;

            for ( var i = 0; i < this.priceFields.length; i++ ) {
                fieldValue = this.getFieldValue( this.priceFields[i] );
                fieldValue = ( String( this.priceFields[i].type ) === 'currency' && fieldValue < 0 ) ? 0 : fieldValue;

                if ( fieldValue > 0 || fieldValue < 0 ) {
                    fieldToPrice = {
                        'fieldValue': fieldValue,
                        'field': this.priceFields[i]
                    };

                    fieldToPrices.push( fieldToPrice );
                }
            }

            return fieldToPrices;
        },
        getFieldValue: function( field ) {
            var value     = 0,
            	el        = this.getElement( field ),
            	fieldType = String( field.Type );

            if ( el ) {
                if ( !this.isElementHidden( el ) ) {
                    value = this.getElementValue( field, el );
                }
            }
            else {
                if ( fieldType === 'currency' ) {
                    value = this.entry[ field.FieldID ];
                }
                else if ( fieldType === 'checkbox' ) {
                    if ( typeof this.entry[ field.FieldID ] !== 'undefined' && this.entry[ field.FieldID ] !== '' ) {
                        value = field.Price;
                    }
                }
                else if ( fieldType === 'radio' || fieldType === 'select' ) {
                    if ( field.Choice === this.entry[ field.FieldID ] ) {
                        value = field.Price;
                    }
                }
            }

            return this.toNumber( value );
        },
        getElement: function( field ) {
            if ( String( field.Type ) === 'checkbox' || String( field.Type ) === 'radio' ) {
                return $( '#vfb-field-' + field.FieldID + '-' + field.Index )[0];
            }
            else {
                return $( '#vfb-field-' + field.FieldID )[0];
            }
        },
        getElementValue: function( field, el ) {
            if ( String( field.Type ) === 'checkbox' || String( field.Type ) === 'radio' ) {
                return ( el.checked ) ? field.Price : 0;
            }
            else if ( String( field.Type ) === 'select' ) {
                return ( field.Choice === el.value ) ? field.Price : 0;
            }
            else if ( String( field.Type ) === 'currency' ) {
                var $field  = $( '#vfb-field-' + field.FieldID ),
                	price = $field.val().replace( /[^0-9\.]/g, '' );

                return String( price );
            }
        },
        isElementHidden: function( el ) {
            var isElementHidden = false,
            	li = this.getFieldEl( el );

            if ( this.hasHiddenClassName( li ) ) {
                isElementHidden = true;
            }

            return isElementHidden;
        },
        hasHiddenClassName: function( li ) {
            var $li = $( li );

            if ( $li.hasClass( 'vfb-rule-hide' ) ) {
	            return true;
            }
        },
        getFieldEl: function( fieldName ) {
			var el = $( fieldName );
			el = ( el.length ) ? el : $( fieldName );

			return el[0];
	    },
        formatNumber: function( num ) {
            var isNegative = ( num < 0 ) ? true: false;

            num = Math.abs( num );
            num = num.toFixed( this.decimals );
            num = this.addCommas( num );
            num = this.currency + num;
            num = ( isNegative ) ? '-' + num : num;
            return num;
        },
        addCommas: function( nStr ) {
            nStr += '';

            var x  = nStr.split( '.' ),
            	x1 = x[0],
            	x2 = x.length > 1 ? '.' + x[1]: '',
            	rgx = /(\d+)(\d{3})/;

            while ( rgx.test( x1 ) ) {
                x1 = x1.replace( rgx, '$1' + ',' + '$2' );
            }

            return x1 + x2;
        },
        toNumber: function( numAsString ) {
            if ( typeof numAsString === 'undefined' ) {
                numAsString = '0';
            }

            var num = Number( numAsString );

            num = ( isNaN( num ) ) ? 0.00 : num;

            return num;
        },
        template: function( data ) {

			var template = this.tmpl
 						   .replace( /\{totalText\}/g, data.totalText )
 						   .replace( /\{total\}/g, data.total )
 						   .replace( /\{rows\}/g, data.rows );

			return template;
        }
	};

	window.VFBProRunningTotal = new VFBProRunningTotal();
}(window, document, jQuery));