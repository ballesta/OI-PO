// feedback.js
// 2013, Kázmér Rapavi, https://github.com/ivoviz/feedback
//2015, webatix, http://webatix.com
// Licensed under the MIT license.

var detectRBExtension = function() {
	
	var timer;

	var listener = function( event ) {
  
		var data = event.data;
	    
		if ( data.cmd === 'rollerblade_ext.installed' ) {

			if ( timer ) {

				clearTimeout( timer );
				
			}	

			window.removeEventListener( 'message', listener );

			RBExtension.detected = true;
			
			RBinitScreenshotExtension();

		}

	};
	
	window.addEventListener( 'message', listener );
	
	timer = setTimeout( function() {
		
		window.removeEventListener( 'message', listener );
		
		RBExtension.detected = false;
		
	}, 1000 );
	
	window.postMessage( {
		
		cmd: 'rollerblade_ext.is_installed'
			
	}, '*' );

};

var RBinitScreenshotExtension = function() {
	
	window.addEventListener( 'message', function( event ) {
		
		var data = event.data;
		
		if ( data.cmd === 'rollerblade_ext.image_data' ) {
			
			RBExtension.screenshot = data.payload;
			
			//show comment box
			jQuery( '#feedback-overview' ).css( { display: 'block' } );
			
		}
	
	} );
	
};

var RBtakeScreenshot = function() {
	
	window.postMessage( {
		
		cmd: 'rollerblade_ext.get_image'
			
	}, '*' );
	
};

//extension ID
var RBExtension = {};

RBExtension.detected = false;

RBExtension.screenshot = '';

//detect if extension is installed for future use
detectRBExtension();

( function( $ ) {

	$.feedback = function( options ) {
	
	    var settings = $.extend( {
	    	
				ajaxURL: '',
				
				postBrowserInfo: true,
				
				postHTML: true,
				
				postURL: true,
				
				proxy: undefined,
				
				letterRendering: false,
				
				initButtonText: 'Send feedback',
				
				strokeStyle: '#00afff',
				
				shadowColor: 'black',
				
				shadowOffsetX: 0,
				
				shadowOffsetY: 0,
				
				shadowBlur: 0,
				
				lineJoin: 'miter',
				
				lineWidth: 12,
				
				feedbackButton: '.feedback-btn',
				
				showDescriptionModal: true,
				
				isDraggable: true,
				
				onScreenshotTaken: function() {},
				
				tpl: {
					description: '<div id="feedback-welcome"><div class="feedback-logo">Feedback</div><p>Feedback lets you send us suggestions about our products. We welcome problem reports, feature ideas and general comments.</p><p>Start by writing a brief description:</p><p>Next we\'ll let you identify areas of the page related to your description.</p><button id="feedback-welcome-next" class="feedback-next-btn feedback-btn-gray">Next</button><div id="feedback-welcome-error">Please enter a description.</div><div class="feedback-wizard-close"></div></div>',
					overview: '<div id="feedback-overview"><div class="feedback-logo">Feedback</div><div id="feedback-overview-description"><div id="feedback-overview-description-text"><h3>Description</h3><h3 class="feedback-additional">Additional info</h3><div id="feedback-additional-none"><span>None</span></div><div id="feedback-browser-info"><span>Browser Info</span></div><div id="feedback-page-info"><span>Page Info</span></div><div id="feedback-page-structure"><span>Page Structure</span></div></div></div><div id="feedback-overview-screenshot"><h3>Screenshot</h3></div><div class="feedback-buttons"><button id="feedback-overview-back" class="feedback-back-btn feedback-btn-gray">Back</button><button id="feedback-submit" class="feedback-submit-btn feedback-btn-blue">Submit</button></div><div id="feedback-overview-error">Please enter a description.</div><div class="feedback-wizard-close"></div></div>',
					submitSuccess: '<div id="feedback-submit-success"><div class="feedback-logo">Feedback</div><p>Thank you for your feedback. We value every piece of feedback we receive.</p><p>We cannot respond individually to every one, but we will use your comments as we strive to improve your experience.</p><button class="feedback-close-btn feedback-btn-blue">OK</button><div class="feedback-wizard-close"></div></div>',
					submitError: '<div id="feedback-submit-error"><div class="feedback-logo">Feedback</div><p>Sadly an error occured while sending your feedback. Please try again.</p><button class="feedback-close-btn feedback-btn-blue">OK</button><div class="feedback-wizard-close"></div></div>'
				},
				
				onClose: function() {},
				
				screenshotStroke: true,
				
				highlightElement: true,
				
				initialBox: false
				
	    }, options );
    
		var supportedBrowser = !!window.HTMLCanvasElement;
		
		if ( supportedBrowser ) {
			
			//detect the browser and set extension url
			var rbCurrentBrowser = '',
				rbExtensionURL = '';
			
			if ( typeof InstallTrigger !== 'undefined' ) {
				
				rbCurrentBrowser = 'firefox';
				
				rbExtensionURL = 'https://addons.mozilla.org/en-us/firefox/addon/rollerblade-screenshots-for-wo/';
				
			} else if ( ! ! window.chrome && ! ( ! ! window.opera || navigator.userAgent.indexOf( ' OPR/' ) >= 0 ) ) {
				
				rbCurrentBrowser = 'chrome';
				
				rbExtensionURL = 'https://chrome.google.com/webstore/detail/rollerblade-screenshots-f/kkljdoalkdfkpjomjoaoeikpmjkkkknn?hl=en';
				
			} else if ( Object.prototype.toString.call( window.HTMLElement ).indexOf( 'Constructor' ) > 0 ) {
				
				rbCurrentBrowser = 'safari';
				
				rbExtensionURL = '';
				
			}
			
			$( document ).on( 'click', settings.feedbackButton, function() {
				
				//first check if our browser extension is installed or if user was already prompted to install it
				var isExtensionPrompted = RBgetCookie( 'RB_extension_prompted' );
				
				if ( ! isExtensionPrompted && ( RBExtension.detected === false ) && rbExtensionURL !== '' ) {		//if extension is not installed (browser is chrome, firefox or safari) and we've not prompted to install it yet, let's do it now
					
					//prompt should be shown only once
					document.cookie = 'RB_extension_prompted=true; path=/';
					
					$( 'body' ).append( '<div id="feedback-module" class="rb-install-extension-dialog"><div id="feedback-submit-error"><p>You must install the <a href="' + rbExtensionURL + '" target="_blank">Rollerblade Screenshots extension</a> to ensure accurate screenshots. (You can use Rollerblade without it, but screenshots will not be correct in many cases).<br />Please, reload this page when extension is installed and activated.</p><a href="' + rbExtensionURL + '" target="_blank" class="feedback-close-btn feedback-btn-blue">Install it Now</a><div class="feedback-box-top"><p></p></div><div class="feedback-wizard-close"></div></div></div>' );
					
					//make "x" icon close the pop-up
					$( '#feedback-submit-error .feedback-wizard-close' ).click( function( event ) {
						
						event.preventDefault();
						
						$( '#feedback-module' ).remove();
						
					} );
					
					//after user clicks on one of "install the extension" links, "x" and "install it" button reloads the page
					$( '#feedback-submit-error .feedback-wizard-close, #feedback-submit-error .feedback-btn-blue' ).click( function() {
						
						$( '#feedback-submit-error .feedback-btn-blue' ).text( 'Reload the page' );
						
						$( '#feedback-submit-error .feedback-wizard-close, #feedback-submit-error .feedback-btn-blue' ).off( 'click' ).on( 'click', function( event ) {
							
							event.preventDefault();
							
							window.location.reload();
							
						} );
						
					} );
					
					$( '#feedback-submit-error' ).draggable( {		//make the pop-up draggable
						handle: '.feedback-box-top',
						cursor: 'pointer'
					} );
					
					return false;
					
				}
				
				//if the button was clicked already, disable rollerblade
				if ( $( 'body' ).hasClass( 'rollerblade-active' ) ) {
					
					//hide mouse tip as well
					$( '#mouse-tip' ).hide();
					
					$( 'body' ).removeClass( 'rollerblade-active' );
					
					close();
					
					return false;
					
				} else {
					
					$( 'body' ).addClass( 'rollerblade-active' );
					
				}
				
				var canDraw = false,
					img = '',
					h 	= $( document ).height(),
					w 	= $( document ).width(),
					tpl = '<div id="feedback-module">';
				
				if ( settings.initialBox ) {
					
					tpl += settings.tpl.description;
					
				}
				
				tpl += settings.tpl.overview + '<canvas id="feedback-canvas"></canvas><div id="feedback-helpers"></div></div>';
				
				$( 'body' ).append( tpl );
				
				$( '#feedback-canvas' ).mouseover( function() {
					
					if ( canDraw ) {
						
						$( '#mouse-tip' ).show();
						
					} else {
						
						$( '#mouse-tip' ).hide();
						
					}
					
				} );
  				
				/* ADDING TOOLTIP HINT NEAR CURSOR */
				var tooltipDiv = document.getElementById( 'mouse-tip' );

				window.onmousemove = function ( e ) {
					
					var x = e.clientX,
						y = e.clientY;
					
					if ( x + 300 > window.innerWidth ) {
						
						x = window.innerWidth - 300;
						
					}
					
					tooltipDiv.style.top = ( y + 40 ) + 'px';
					
					tooltipDiv.style.left = ( x + 40 ) + 'px';
					
				};
				
				moduleStyle = {
					'position':	'absolute',
					'left': 	'0px',
					'top':		'0px'
				};
				
				canvasAttr = {
					'width': w,
					'height': h
				};
				
				$( '#feedback-module' ).css( moduleStyle );
				
				$( '#feedback-canvas' ).attr( canvasAttr ).css( 'z-index', '9999995' );
				
				if ( ! settings.initialBox ) {
					
					$( '#feedback-highlighter-back' ).remove();
					
					canDraw = true;

					$( '#feedback-helpers' ).show();
					
					$( '#feedback-welcome' ).hide();
					
					$( '#feedback-highlighter' ).show();
					
				}
				
				if( settings.isDraggable ) {
					
					$( '#feedback-overview>.feedback-box-top' ).on( 'mousedown', function( e ) {
						
						var targ = $( '#feedback-overview' );
						
						var $d = $( targ ).addClass( 'feedback-draggable' ),
							drag_h 	= $d.outerHeight(),
							drag_w 	= $d.outerWidth(),
							pos_y 	= $d.offset().top + drag_h - e.pageY,
							pos_x 	= $d.offset().left + drag_w - e.pageX;
						
						$d.parents().on( 'mousemove', function( e ) {
							
							_top 	= e.pageY + pos_y - drag_h;
							
							_left 	= e.pageX + pos_x - drag_w;
							
							_bottom = drag_h - e.pageY;
							
							_right 	= drag_w - e.pageX;
							
							//don't let comment box go outside of the window
							if ( _left < 0 ) {
								
								_left = 0;
								
							}
							
							if ( _top < 0 ) {
								
								_top = 0;
								
							}
							
							if ( _right > $( window ).width() ) {
								
								_left = $( window ).width() - drag_w;
								
							}
							
							if ( _left > $( window ).width() - drag_w ) {
								
								_left = $( window ).width() - drag_w;
								
							}
							
							if ( _bottom > $( document ).height() ) {
								
								_top = $( document ).height() - drag_h;
								
							}
							
							if ( _top > $( document ).height() - drag_h ) {
								
								_top = $( document ).height() - drag_h;
								
							}	

							$( '.feedback-draggable' ).offset( { top:	_top, left:	_left } ).on( 'mouseup', function() {
								
								$( this ).removeClass( 'feedback-draggable' );
								
							} );
							
						} );
						
						e.preventDefault();
						
					} ).on( 'mouseup', function() {
						
						$( '#feedback-overview' ).removeClass( 'feedback-draggable' );
						
						$( '#feedback-overview' ).parents().off( 'mousemove mousedown' );
						
					} );
					
				}

				var ctx = $( '#feedback-canvas' )[0].getContext( '2d' ),
					rect = {},
					drag = false,
					highlight = 1,
					post = {};
				
				ctx.fillStyle = 'rgba(102,102,102,0.5)';
				
				ctx.fillRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
				
				if ( settings.postBrowserInfo ) {
					
					post.browser = {};
					
					post.browser.appCodeName = navigator.appCodeName;
					
					post.browser.name = navigator.userAgent.match(/(firefox|msie|chrome|safari)[/\s]([\d.]+)/ig);
					
					post.browser.appVersion = navigator.appVersion;
					
					post.browser.cookieEnabled = navigator.cookieEnabled;
					
					if ( post.browser.cookieEnabled === true ) {

						//parse cookies into an object
						post.browser.cookies = document.cookie.split( ';' ).map( function( x ) { return x.trim().split( '=' ); } ).reduce( function( a, b ) { a[ b[ 0 ] ] = b[ 1 ]; return a; }, {} );
						
						//send last 10 pages on the site visited by the user
						post.browser.pagesVisited = RBgetCookie( 'RB_pages_visited' );
						
					}
						
					post.browser.onLine = navigator.onLine;
					
					post.browser.platform = navigator.platform;
					
					post.browser.userAgent = navigator.userAgent;
					
					post.browser.plugins = [];
				
					$.each( navigator.plugins, function( i ) {
						
						post.browser.plugins.push( navigator.plugins[ i ].name );
						
					} );
					
				}
				
				if ( settings.postURL ) {
					
					post.url = document.URL;
					
					$( '#feedback-page-info' ).show();
					
				}
				
				if ( settings.postHTML ) {
					
					post.html = $( 'html' ).html();
					
					$( '#feedback-page-structure' ).show();
					
				}
				
				if ( ! settings.postBrowserInfo && ! settings.postURL && ! settings.postHTML ) {
					
					$( '#feedback-additional-none' ).show();
					
				}	
				
				$( document ).on( 'mousedown', '#feedback-canvas', function( e ) {
					
					if ( canDraw ) {

						rect.startX = e.pageX - $( this ).offset().left;
						
						rect.startY = e.pageY - $( this ).offset().top;
						
						rect.w = 0;
						
						rect.h = 0;
						
						drag = true;
						
					}
					
				} );

				$( document ).on( 'mouseup', function( event ) {
					
					if ( canDraw ) {
						
						drag = false;
						
						var dtop	= rect.startY,
							dleft	= rect.startX,
							dwidth	= rect.w,
							dheight	= rect.h;
							dtype	= 'highlight';
						
						//if nothing was selected, do nothing
						if (dwidth == 0 || dheight == 0) {
							
							return;
							
						}
						
						if (dwidth < 0) {
							
							dleft 	+= dwidth;
							
							dwidth 	*= -1;
							
						}
						
						if (dheight < 0) {
							
							dtop 	+= dheight;
							
							dheight *= -1;
							
						}
						
						if ( dtop + dheight > $( document ).height() ) {
							
							dheight = $(document).height() - dtop;
							
						}
						
						if ( dleft + dwidth > $( document ).width() ) {
							
							dwidth = $( document ).width() - dleft;
							
						}
						
						if ( highlight == 0 ) {
							
							dtype = 'blackout';
							
						}
						
						$( '#feedback-helpers' ).append( '<div class="feedback-helper" data-type="' + dtype + '" data-time="' + Date.now() + '" style="position:absolute;top:' + dtop + 'px;left:' + dleft + 'px;width:' + dwidth + 'px;height:' + dheight + 'px;z-index:9999997;"></div>' );
						
						redraw( ctx );
						
						rect.w = 0;
						
						//make sure that comment box is not outside of the window
						var newTop = dtop + dheight/2 - 92.5,
							newLeft = dleft + 148.5 + dwidth/2;
						
						if ( newTop < 30 ) {
							
							newTop = 30;
							
						}
						
						if ( newTop > $( window ).height() - 220 ) {
							
							newTop = $( window ).height() - 220;
							
						}
						
						if ( newLeft < 330 ) {
							
							newLeft = 330;
							
						}
						
						if ( newLeft > $( window ).width() - 30 ) {
							
							newLeft = $( window ).width() - 30;
							
						}
						
						if ( $( event.target ).attr( 'id' ) !== 'rollerblade-button' ) {		//if it wasn't a click on the rollerblade button, show "in progress" overlay
						
							$( '#feedback-overview' ).css( { left: newLeft + 'px', top: newTop + 'px' } );
						
							$( 'body' ).append( '<div id="rb-loading-overlay"></div><div id="rb-loading">Saving Screenshot</div>' );
						
							$( '#rb-loading' ).css( { left: window.innerWidth/2 - 148 + 'px', top: window.innerHeight/2 - 54 + 'px' } );
							
						}
						
						//take the screenshot by emulating the click on "take screenshot" button
						$( '#feedback-highlighter-next-clone' ).click();
						
						//only one highlighted area per screenshot
						canDraw = false;
						
						$( '#mouse-tip' ).hide();
						
						$( '#feedback-canvas' ).addClass( 'cant-draw' );
						
					}
					
				} );

				$( document ).on( 'mousemove', function( e ) {
					
					if ( canDraw && drag ) {
						
						rect.w = ( e.pageX - $( '#feedback-canvas' ).offset().left ) - rect.startX;
						
						rect.h = ( e.pageY - $( '#feedback-canvas' ).offset().top) - rect.startY;
						
						ctx.clearRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
						
						ctx.fillStyle = 'rgba(102,102,102,0.5)';
						
						ctx.fillRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
						
						$( '.feedback-helper' ).each( function() {
							
							if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
								
								drawlines( ctx, parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
								
							}
							
						} );
						
						if ( highlight==1 ) {
							
							drawlines( ctx, rect.startX, rect.startY, rect.w, rect.h );
							
							ctx.clearRect( rect.startX, rect.startY, rect.w, rect.h );
							
						}
						
						$( '.feedback-helper' ).each( function() {
							
							if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
								
								ctx.clearRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
								
							}
							
						} );
						
						$( '.feedback-helper' ).each( function() {
							
							if ( $( this ).attr( 'data-type' ) == 'blackout' ) {
								
								ctx.fillStyle = 'rgba(0,0,0,1)';
								
								ctx.fillRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
								
							}
							
						} );
						
						if ( highlight == 0 ) {
							
							ctx.fillStyle = 'rgba(0,0,0,0.5)';
							
							ctx.fillRect( rect.startX, rect.startY, rect.w, rect.h );
							
						}
						
					}
					
				} );
				
				if ( settings.highlightElement ) {
					
					var highlighted = [],
						tmpHighlighted = [],
						hidx = 0;
					
					$( document ).on( 'mousemove click', '#feedback-canvas', function( e ) {
						
						if ( canDraw ) {
							
							redraw( ctx );
							
							tmpHighlighted = [];
							
							$( '* :not(body,script,iframe,div,section,.feedback-btn,#feedback-module *)' ).each( function() {
								
								if ( $( this ).attr( 'data-highlighted' ) === 'true' ) {
									
									return;
									
								}
									
								if ( e.pageX > $( this ).offset().left && e.pageX < $( this ).offset().left + $( this ).width() && e.pageY > $( this ).offset().top + parseInt( $( this ).css( 'padding-top' ), 10 ) && e.pageY < $( this ).offset().top + $( this ).height() + parseInt( $( this ).css( 'padding-top' ), 10 ) ) {
									
										tmpHighlighted.push( $( this ) );
										
								}
								
							} );
							
							var $toHighlight = tmpHighlighted[ tmpHighlighted.length - 1 ];
							
							if ( $toHighlight && ! drag ) {
								
								var _x = $toHighlight.offset().left - 2,
									_y = $toHighlight.offset().top - 2,
									_w = $toHighlight.width() + parseInt( $toHighlight.css( 'padding-left' ), 10 ) + parseInt( $toHighlight.css( 'padding-right' ), 10 ) + 6,
									_h = $toHighlight.height() + parseInt( $toHighlight.css( 'padding-top' ), 10 ) + parseInt( $toHighlight.css( 'padding-bottom' ), 10 ) + 6;
								
								if ( highlight == 1 ) {
									
									drawlines( ctx, _x, _y, _w, _h );
									
									ctx.clearRect( _x, _y, _w, _h );
									
									dtype = 'highlight';
									
								}
								
								$( '.feedback-helper' ).each( function() {
									
									if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
										
										ctx.clearRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
										
									}
									
								} );
								
								if ( highlight == 0 ) {
									
									dtype = 'blackout';
									
									ctx.fillStyle = 'rgba(0,0,0,0.5)';
									
									ctx.fillRect( _x, _y, _w, _h );
									
								}

								$( '.feedback-helper' ).each( function() {
									
									if ( $( this ).attr( 'data-type' ) == 'blackout' ) {
										
										ctx.fillStyle = 'rgba(0,0,0,1)';
										
										ctx.fillRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10), $( this ).width(), $( this ).height() );
										
									}
									
								} );
								
								if ( e.type == 'click' && e.pageX == rect.startX && e.pageY == rect.startY ) {
									
									$( '#feedback-helpers' ).append( '<div class="feedback-helper" data-highlight-id="' + hidx + '" data-type="' + dtype + '" data-time="' + Date.now() + '" style="position:absolute;top:' + _y + 'px;left:' + _x + 'px;width:' + _w + 'px;height:' + _h + 'px;z-index:9999997;"></div>' );
									
									highlighted.push( hidx );
									
									++hidx;
									
									redraw( ctx );
									
								}
								
							}
							
						}
						
					} );
					
				}
				
				$( document ).on( 'mouseleave', 'body,#feedback-canvas', function() {
					
					redraw( ctx );
					
				} );
				
				$( document ).on( 'mouseenter', '.feedback-helper', function() {
					
					redraw( ctx );
					
				} );
				
				$( document ).on( 'click', '#feedback-welcome-next', function() {
					
					if ( $( '#feedback-overview-note' ).val().length > 0 ) {
						
						canDraw = true;
						
						$( '#feedback-helpers' ).show();
						
						$( '#feedback-welcome' ).hide();
						
						$( '#feedback-highlighter' ).show();
						
					} else {
						
						$( '#feedback-welcome-error' ).show();
						
					}
					
				} );
				
				$( document ).on( 'mouseenter mouseleave', '.feedback-helper', function( e ) {
					
					if ( drag ) {
						
						return;
						
					}	
					
					rect.w = 0;
					
					rect.h = 0;
					
					if ( e.type === 'mouseenter' ) {
						
						$( this ).css( 'z-index', '30001' );
						
						$( this ).append( '<div class="feedback-helper-inner" style="width:' + ( $( this ).width() - 2 ) + 'px;height:' + ( $( this ).height() - 2 ) + 'px;position:absolute;margin:1px;"></div>' );
						
						$( this ).append( '<div id="feedback-close"></div>' );
						
						$( this ).find( '#feedback-close' ).css( {
							'top' 	: -1 * ( $( this ).find( '#feedback-close' ).height() / 2) + 'px',
							'left' 	: $( this ).width() - ( $( this ).find( '#feedback-close' ).width() / 2 ) + 'px'
						} );
						
						if ( $( this ).attr( 'data-type' ) == 'blackout') {
							
							/* redraw white */
							ctx.clearRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
							
							ctx.fillStyle = 'rgba(102,102,102,0.5)';
							
							ctx.fillRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
							
							$( '.feedback-helper' ).each( function() {
								
								if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
									
									drawlines( ctx, parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
									
								}
								
							} );
							
							$( '.feedback-helper' ).each( function() {
								
								if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
									
									ctx.clearRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
									
								}
								
							} );

							ctx.clearRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
							
							ctx.fillStyle = 'rgba(0,0,0,0.75)';
							
							ctx.fillRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
							
							ignore = $( this ).attr( 'data-time' );

							/* redraw black */
							$( '.feedback-helper' ).each( function() {
								
								if ( $( this ).attr( 'data-time' ) == ignore ) {
									
									return true;
									
								}
								
								if ( $( this ).attr( 'data-type' ) == 'blackout' ) {
									
									ctx.fillStyle = 'rgba(0,0,0,1)';
									
									ctx.fillRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
									
								}
								
							} );
							
						}
						
					} else {
						
						$( this ).css( 'z-index','9999996' );
						
						$( this ).children().remove();
						
						if ( $( this ).attr( 'data-type' ) == 'blackout' ) {
							
							redraw( ctx );
							
						}
						
					}
					
				} );
				
				$( document ).on( 'click', '#feedback-close', function() {
					
					if ( settings.highlightElement && $( this ).parent().attr( 'data-highlight-id' ) ) {
						
						var _hidx = $( this ).parent().attr( 'data-highlight-id' );
						
					}
					
					$( this ).parent().remove();
					
					if ( settings.highlightElement && _hidx ) {
						
						$( '[data-highlight-id="' + _hidx + '"]' ).removeAttr( 'data-highlighted' ).removeAttr( 'data-highlight-id' );
						
					}
					
					redraw( ctx );
					
				} );

				$( '#feedback-module' ).on( 'click', '.feedback-wizard-close,.feedback-close-btn', function( event ) {
					
					event.preventDefault();
					
					event.stopPropagation();
					
					close();
					
				} );
				
				$( document ).on( 'keyup', function( e ) {		
					
					if ( e.keyCode == 27 ) {		//close the tool on Esc key press
						
						close();
						
					}
					
				});
				
				//when press "tab" in the comment box, move focus to "submit" button
				$( document ).on( 'keydown', '#feedback-overview-note', function( e ) {
					
					if ( ( e.keyCode ) == 9 ) {	
						
						e.preventDefault();
						
						$( '#feedback-submit' ).focus();
					
					}
					
				} );
				
				$( document ).on( 'click', '#feedback-highlighter-back', function() {
					
					canDraw = false;
					
					$( '#feedback-helpers' ).hide();
					
					$( '#feedback-highlighter' ).hide();
					
					$( '#feedback-welcome-error' ).hide();
					
					$( '#feedback-welcome' ).show();
					
				} );
				
				$( document ).on( 'mousedown', '.feedback-sethighlight', function() {
					
					highlight = 1;
					
					$( this ).addClass( 'feedback-active' );
					
					$( '.feedback-setblackout' ).removeClass( 'feedback-active' );
					
				} );
				
				$( document ).on( 'mousedown', '.feedback-setblackout', function() {
					
					highlight = 0;
					
					$( this ).addClass( 'feedback-active' );
					
					$( '.feedback-sethighlight' ).removeClass( 'feedback-active' );
					
				} );
				
				$( document ).on( 'click', '#feedback-highlighter-next, #feedback-highlighter-next-clone', function() {
					
					canDraw = false;	//highlighting is done, let's take a screenshot now
					
					var sy = $( document ).scrollTop(),
						dh = $( window ).height();
					
					$( '#feedback-helpers' ).hide();
					
					$( '#feedback-highlighter' ).hide();
					
					if ( ! settings.screenshotStroke ) {
						
						redraw( ctx, false );
						
					}
					
					//if RB extension is installed, we use it instead of html2canvas
					if ( RBExtension.detected === true ) {
						
						//make sure the comment box is not visible on the screenshot
						$( '#feedback-overview' ).css( { display: 'none' } );
						
						//remove "loading" spinner
						$( '#rb-loading, #rb-loading-overlay' ).remove();
						
						RBtakeScreenshot();
						
						//screenshot is taken, remove canvas
						$( '#feedback-canvas-tmp' ).remove();

						if ( ! $( '#feedback-overview-note' ).length ) {
						
							//add a textarea for a comment to the screenshot
							$( '<textarea id="feedback-overview-note"></textarea>' ).insertAfter( '#feedback-overview-description-text h3:eq(0)' );
							
						}
						
					} else {
					
						html2canvas( $( 'body' ), {
							
							onpreloaded: function() {	//do not include our tool elements to the screenshot
								
								$( '#feedback-overview' ).css( { display: 'none' } );
								
								//remove "loading" spinner
								$( '#rb-loading, #rb-loading-overlay' ).remove();
								
							},
							
							onrendered: function( canvas ) {
								
								if ( ! settings.screenshotStroke ) {
									
									redraw( ctx );
									
								}
								
								_canvas = $( '<canvas id="feedback-canvas-tmp" width="'+ w +'" height="'+ dh +'"/>' ).hide().appendTo( 'body' );
								
								_ctx = _canvas.get( 0 ).getContext( '2d' );
								
								_ctx.drawImage( canvas, 0, sy, w, dh, 0, 0, w, dh );
								
								img = _canvas.get( 0 ).toDataURL();
								
								$( document ).scrollTop( sy );
								
								post.img = img;
									
								settings.onScreenshotTaken( post.img );
								
								if( settings.showDescriptionModal ) {
									
									canDraw = false;
									
									$( '#feedback-canvas-tmp' ).remove();
									
									//show comment box
									$( '#feedback-overview' ).css( { display: 'block' } );
									
									if ( ! $( '#feedback-overview-note' ).length ) {
									
										//add a textarea for a comment to the screenshot
										$( '<textarea id="feedback-overview-note"></textarea>' ).insertAfter( '#feedback-overview-description-text h3:eq(0)' );
										
									}

								} else {
									
									$('#feedback-module').remove();
									
									close();
									
									_canvas.remove();
									
								}
								
							},
							
							proxy: settings.proxy,
							
							letterRendering: settings.letterRendering
							
						} );
					
					}
					
					//after comment box is loaded, focus on it
					setTimeout( function() {
						
						$( '#feedback-overview-note' ).focus();
						
					}, 500 );
					
				} );
				
				$( document ).on( 'click', '#feedback-overview-back', function( e ) {
					
					canDraw = true;
					
					$( this ).parent().parent().children( '.feedback-wizard-close' ).click();
					
				} );
				
				$( document ).on( 'click', '#feedback-submit', function() {
					
					canDraw = false;
					
					if ( $( '#feedback-overview-note' ).val().length > 0 ) {
						
						$( '#feedback-submit-success, #feedback-submit-error' ).remove();
						
						$( '#feedback-overview' ).css( { display: 'none' } );
						
						if ( RBExtension.detected === true ) {
							
							post.img = RBExtension.screenshot;
							
						} else {
						
							post.img = img;
						
						}
						
						post.note = $( '#feedback-overview-note' ).val();
						
						post.origin = window.location.href;
						
						//show "loading" spinner
						$( 'body' ).append( '<div id="rb-loading-overlay"></div><div id="rb-loading">Submitting Your Report</div>' );
						
						$( '#rb-loading' ).css({ left: window.innerWidth/2 - 148 + 'px', top: window.innerHeight/2 - 54 + 'px' });
						
						$.ajax( {
							
							url: settings.ajaxURL,
							
							dataType: 'json',
							
							type: 'POST',
							
							data: {
								action: 'send_rb_request',
								security: settings.ajaxNonce,
								request_data: post,
							},
							
							success: function( response ) {
								
								//remove "loading" spinner
								$( '#rb-loading, #rb-loading-overlay' ).remove();
								
								if ( response && response.status == 'ok' ) {
									
									$( '#feedback-module' ).append( settings.tpl.submitSuccess );
									
									$( '#rb-ticket-id' ).append( '#' + response.object_id );
									
									$( '#rb-success-ticket-link' ).attr( 'href', response.object_url );
									
									//close "success" message button
									jQuery( '#success-rb-close-icon' ).click( function() {
										
										jQuery( '#rollerblade-button' ).click();
										
									} );
									
									//close it automatically, after 3 seconds
									setTimeout( function() {
										
										jQuery( '#success-rb-close-icon' ).click();
										
									}, 3000 );
									
								} else {
									
									$( '#feedback-module' ).append( '<div id="feedback-submit-error"><p>Something went wrong, please try again or contact site administrator!</p><button class="feedback-close-btn feedback-btn-blue">OK</button><div class="feedback-box-top"><p></p></div><div class="feedback-wizard-close"></div></div>' );
									
								}
								
							},
							
							error: function() {
								
								//remove "loading" spinner
								$( '#rb-loading, #rb-loading-overlay' ).remove();
								
								$( '#feedback-module' ).append( settings.tpl.submitError );
								
							}
							
						} );
						
					} else {
						
						$( '#feedback-overview-error' ).show();
						
					}
					
				} );
				
			} );
			
		}
			
		function close() {
			
			canDraw = false;
			
			$( document ).off( 'mouseenter mouseleave', '.feedback-helper' );
			
			$( document ).off( 'mouseup keyup' );
			
			$( document ).off( 'mousedown', '.feedback-setblackout' );
			
			$( document ).off( 'mousedown', '.feedback-sethighlight' );
			
			$( document ).off( 'mousedown click', '#feedback-close' );
			
			$( document ).off( 'mousedown', '#feedback-canvas' );
			
			$( document ).off( 'click', '#feedback-highlighter-next' );
			
			$( document ).off( 'click', '#feedback-highlighter-back' );
			
			$( document ).off( 'click', '#feedback-welcome-next' );
			
			$( document ).off( 'click', '#feedback-overview-back' );
			
			$( document ).off( 'mouseleave', 'body' );
			
			$( document ).off( 'mouseenter', '.feedback-helper' );
			
			$( '#feedback-module' ).off( 'click', '.feedback-wizard-close,.feedback-close-btn' );
			
			$( document ).off( 'click', '#feedback-submit' );
			
			if ( settings.highlightElement ) {
				
				$( document ).off( 'click', '#feedback-canvas' );
				
				$( document ).off( 'mousemove', '#feedback-canvas' );
				
			}
			
			$( '[data-highlighted="true"]' ).removeAttr( 'data-highlight-id' ).removeAttr( 'data-highlighted' );
			
			$( '#feedback-module' ).remove();
			
			settings.onClose.call( this );
			
		}

		function redraw( ctx, border ) {
			
			border = typeof border !== 'undefined' ? border : true;
			
			ctx.clearRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
			
			ctx.fillStyle = 'rgba(102,102,102,0.5)';
			
			ctx.fillRect( 0, 0, $( '#feedback-canvas' ).width(), $( '#feedback-canvas' ).height() );
			
			$( '.feedback-helper' ).each( function() {
				
				if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
					
					if ( border ) {
						
						drawlines( ctx, parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
						
					}	
					
				}
				
			} );
			
			$( '.feedback-helper' ).each( function() {
				
				if ( $( this ).attr( 'data-type' ) == 'highlight' ) {
					
					ctx.clearRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
					
				}
				
			} );
			
			$( '.feedback-helper' ).each( function() {
				
				if ( $( this ).attr( 'data-type' ) == 'blackout' ) {
					
					ctx.fillStyle = 'rgba(0,0,0,1)';
					
					ctx.fillRect( parseInt( $( this ).css( 'left' ), 10 ), parseInt( $( this ).css( 'top' ), 10 ), $( this ).width(), $( this ).height() );
					
				}
				
			} );
			
		}
		
		function drawlines( ctx, x, y, w, h ) {
			
			ctx.strokeStyle = settings.strokeStyle;
			
			ctx.shadowColor = settings.shadowColor;
			
			ctx.shadowOffsetX = settings.shadowOffsetX;
			
			ctx.shadowOffsetY = settings.shadowOffsetY;
			
			ctx.shadowBlur = settings.shadowBlur;
			
			ctx.lineJoin = settings.lineJoin;
			
			ctx.lineWidth = settings.lineWidth;
			
			ctx.strokeRect( x,y,w,h );
			
			ctx.shadowOffsetX = 0;
			
			ctx.shadowOffsetY = 0;
			
			ctx.shadowBlur = 0;
			
			ctx.lineWidth = 1;
		}
	
	};
	
} ( jQuery ) );
