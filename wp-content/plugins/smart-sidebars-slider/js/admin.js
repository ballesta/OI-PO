// LimitKeyPress //
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(6($){$.M.T=6(g){4 h={H:/^[-+]?\\d*\\.?\\d*$/};4 g=$.P(h,g);j 9.10(6(){4 f=g.H;$(9).W(6(){D(9)});$(9).14(6(e){5(e.q=="0"||e.q=="8"||e.q=="13"||e.15||e.12){j}B(9);4 a=R.Y(e.q),F=9.2.l(0,u(9))+a+9.2.l(w(9),9.2.7);5(!f.v(F)){e.N();j}j});6 B(o){4 a=u(o),k=w(o),y="",3="",m=[];z(i=0;i<o.2.7;i++){5(a>i){m[i]=\'A\'}n 5((a<=i)&&(k>i)){m[i]=\'E\'}}z(i=0;i<o.2.7;i++){4 b=i+1;3+=o.2.l(i,b);5((!f.v(3))){4 c=3.7-1;y=3.l(0,c);3=y;5(m[i]==\'A\'){a=a-1;k=k-1}n 5(m[i]==\'E\'){k=k-1}}}o.2=3;p(o,a,k)}6 D(o){4 a="",3="";z(i=0;i<o.2.7;i++){4 b=i+1;3+=o.2.l(i,b);5((!f.v(3))){4 c=3.7-1;a=3.l(0,c);3=a}}o.2=3}6 u(o){5(o.t){4 r=C.I.K().G();r.J(\'s\',o.2.7);5(r.x==\'\')j o.2.7;j o.2.O(r.x)}n j o.S}6 w(o){5(o.t){4 r=C.I.K().G();r.L(\'s\',-o.2.7);j r.x.7}n j o.Q}6 p(a,b,c){5(a.p){a.U();a.p(b,c)}n 5(a.t){4 d=a.t();d.V(X);d.J(\'s\',c);d.L(\'s\',b);d.Z()}}})}})(11);',62,68,'||value|testPlusChar|var|if|function|length||this||||||||||return|endCaretPos|substring|selectionCharInfo|else||setSelectionRange|which||character|createTextRange|getSelectionStart|test|getSelectionEnd|text|temp|for|beforeSelection|sanitizeWithSelection|document|sanitize|inSelection|updatedInput|duplicate|rexp|selection|moveEnd|createRange|moveStart|fn|preventDefault|lastIndexOf|extend|selectionEnd|String|selectionStart|limitkeypress|focus|collapse|blur|true|fromCharCode|select|each|jQuery|altKey||keypress|ctrlKey'.split('|'),0,{}));

// jQuery EasyTabs plugin 3.2.0  //
(function(a){a.easytabs=function(j,e){var f=this,q=a(j),i={animate:true,panelActiveClass:"active",tabActiveClass:"active",defaultTab:"li:first-child",animationSpeed:"normal",tabs:"> ul > li",updateHash:true,cycle:false,collapsible:false,collapsedClass:"collapsed",collapsedByDefault:true,uiTabs:false,transitionIn:"fadeIn",transitionOut:"fadeOut",transitionInEasing:"swing",transitionOutEasing:"swing",transitionCollapse:"slideUp",transitionUncollapse:"slideDown",transitionCollapseEasing:"swing",transitionUncollapseEasing:"swing",containerClass:"",tabsClass:"",tabClass:"",panelClass:"",cache:true,event:"click",panelContext:q},h,l,v,m,d,t={fast:200,normal:400,slow:600},r;f.init=function(){f.settings=r=a.extend({},i,e);r.bind_str=r.event+".easytabs";if(r.uiTabs){r.tabActiveClass="ui-tabs-selected";r.containerClass="ui-tabs ui-widget ui-widget-content ui-corner-all";r.tabsClass="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all";r.tabClass="ui-state-default ui-corner-top";r.panelClass="ui-tabs-panel ui-widget-content ui-corner-bottom"}if(r.collapsible&&e.defaultTab!==undefined&&e.collpasedByDefault===undefined){r.collapsedByDefault=false}if(typeof(r.animationSpeed)==="string"){r.animationSpeed=t[r.animationSpeed]}a("a.anchor").remove().prependTo("body");q.data("easytabs",{});f.setTransitions();f.getTabs();b();g();w();n();c();q.attr("data-easytabs",true)};f.setTransitions=function(){v=(r.animate)?{show:r.transitionIn,hide:r.transitionOut,speed:r.animationSpeed,collapse:r.transitionCollapse,uncollapse:r.transitionUncollapse,halfSpeed:r.animationSpeed/2}:{show:"show",hide:"hide",speed:0,collapse:"hide",uncollapse:"show",halfSpeed:0}};f.getTabs=function(){var x;f.tabs=q.find(r.tabs),f.panels=a(),f.tabs.each(function(){var A=a(this),z=A.children("a"),y=A.children("a").data("target");A.data("easytabs",{});if(y!==undefined&&y!==null){A.data("easytabs").ajax=z.attr("href")}else{y=z.attr("href")}y=y.match(/#([^\?]+)/)[1];x=r.panelContext.find("#"+y);if(x.length){x.data("easytabs",{position:x.css("position"),visibility:x.css("visibility")});x.not(r.panelActiveClass).hide();f.panels=f.panels.add(x);A.data("easytabs").panel=x}else{f.tabs=f.tabs.not(A);if("console" in window){console.warn("Warning: tab without matching panel for selector '#"+y+"' removed from set")}}})};f.selectTab=function(x,C){var y=window.location,B=y.hash.match(/^[^\?]*/)[0],z=x.parent().data("easytabs").panel,A=x.parent().data("easytabs").ajax;if(r.collapsible&&!d&&(x.hasClass(r.tabActiveClass)||x.hasClass(r.collapsedClass))){f.toggleTabCollapse(x,z,A,C)}else{if(!x.hasClass(r.tabActiveClass)||!z.hasClass(r.panelActiveClass)){o(x,z,A,C)}else{if(!r.cache){o(x,z,A,C)}}}};f.toggleTabCollapse=function(x,y,z,A){f.panels.stop(true,true);if(u(q,"easytabs:before",[x,y,r])){f.tabs.filter("."+r.tabActiveClass).removeClass(r.tabActiveClass).children().removeClass(r.tabActiveClass);if(x.hasClass(r.collapsedClass)){if(z&&(!r.cache||!x.parent().data("easytabs").cached)){q.trigger("easytabs:ajax:beforeSend",[x,y]);y.load(z,function(C,B,D){x.parent().data("easytabs").cached=true;q.trigger("easytabs:ajax:complete",[x,y,C,B,D])})}x.parent().removeClass(r.collapsedClass).addClass(r.tabActiveClass).children().removeClass(r.collapsedClass).addClass(r.tabActiveClass);y.addClass(r.panelActiveClass)[v.uncollapse](v.speed,r.transitionUncollapseEasing,function(){q.trigger("easytabs:midTransition",[x,y,r]);if(typeof A=="function"){A()}})}else{x.addClass(r.collapsedClass).parent().addClass(r.collapsedClass);y.removeClass(r.panelActiveClass)[v.collapse](v.speed,r.transitionCollapseEasing,function(){q.trigger("easytabs:midTransition",[x,y,r]);if(typeof A=="function"){A()}})}}};f.matchTab=function(x){return f.tabs.find("[href='"+x+"'],[data-target='"+x+"']").first()};f.matchInPanel=function(x){return(x&&f.validId(x)?f.panels.filter(":has("+x+")").first():[])};f.validId=function(x){return x.substr(1).match(/^[A-Za-z]+[A-Za-z0-9\-_:\.].$/)};f.selectTabFromHashChange=function(){var y=window.location.hash.match(/^[^\?]*/)[0],x=f.matchTab(y),z;if(r.updateHash){if(x.length){d=true;f.selectTab(x)}else{z=f.matchInPanel(y);if(z.length){y="#"+z.attr("id");x=f.matchTab(y);d=true;f.selectTab(x)}else{if(!h.hasClass(r.tabActiveClass)&&!r.cycle){if(y===""||f.matchTab(m).length||q.closest(y).length){d=true;f.selectTab(l)}}}}}};f.cycleTabs=function(x){if(r.cycle){x=x%f.tabs.length;$tab=a(f.tabs[x]).children("a").first();d=true;f.selectTab($tab,function(){setTimeout(function(){f.cycleTabs(x+1)},r.cycle)})}};f.publicMethods={select:function(x){var y;if((y=f.tabs.filter(x)).length===0){if((y=f.tabs.find("a[href='"+x+"']")).length===0){if((y=f.tabs.find("a"+x)).length===0){if((y=f.tabs.find("[data-target='"+x+"']")).length===0){if((y=f.tabs.find("a[href$='"+x+"']")).length===0){a.error("Tab '"+x+"' does not exist in tab set")}}}}}else{y=y.children("a").first()}f.selectTab(y)}};var u=function(A,x,z){var y=a.Event(x);A.trigger(y,z);return y.result!==false};var b=function(){q.addClass(r.containerClass);f.tabs.parent().addClass(r.tabsClass);f.tabs.addClass(r.tabClass);f.panels.addClass(r.panelClass)};var g=function(){var y=window.location.hash.match(/^[^\?]*/)[0],x=f.matchTab(y).parent(),z;if(x.length===1){h=x;r.cycle=false}else{z=f.matchInPanel(y);if(z.length){y="#"+z.attr("id");h=f.matchTab(y).parent()}else{h=f.tabs.parent().find(r.defaultTab);if(h.length===0){a.error("The specified default tab ('"+r.defaultTab+"') could not be found in the tab set ('"+r.tabs+"') out of "+f.tabs.length+" tabs.")}}}l=h.children("a").first();p(x)};var p=function(z){var y,x;if(r.collapsible&&z.length===0&&r.collapsedByDefault){h.addClass(r.collapsedClass).children().addClass(r.collapsedClass)}else{y=a(h.data("easytabs").panel);x=h.data("easytabs").ajax;if(x&&(!r.cache||!h.data("easytabs").cached)){q.trigger("easytabs:ajax:beforeSend",[l,y]);y.load(x,function(B,A,C){h.data("easytabs").cached=true;q.trigger("easytabs:ajax:complete",[l,y,B,A,C])})}h.data("easytabs").panel.show().addClass(r.panelActiveClass);h.addClass(r.tabActiveClass).children().addClass(r.tabActiveClass)}q.trigger("easytabs:initialised",[l,y])};var w=function(){f.tabs.children("a").bind(r.bind_str,function(x){r.cycle=false;d=false;f.selectTab(a(this));x.preventDefault?x.preventDefault():x.returnValue=false})};var o=function(z,D,E,H){f.panels.stop(true,true);if(u(q,"easytabs:before",[z,D,r])){var A=f.panels.filter(":visible"),y=D.parent(),F,x,C,G,B=window.location.hash.match(/^[^\?]*/)[0];if(r.animate){F=s(D);x=A.length?k(A):0;C=F-x}m=B;G=function(){q.trigger("easytabs:midTransition",[z,D,r]);if(r.animate&&r.transitionIn=="fadeIn"){if(C<0){y.animate({height:y.height()+C},v.halfSpeed).css({"min-height":""})}}if(r.updateHash&&!d){window.location.hash="#"+D.attr("id")}else{d=false}D[v.show](v.speed,r.transitionInEasing,function(){y.css({height:"","min-height":""});q.trigger("easytabs:after",[z,D,r]);if(typeof H=="function"){H()}})};if(E&&(!r.cache||!z.parent().data("easytabs").cached)){q.trigger("easytabs:ajax:beforeSend",[z,D]);D.load(E,function(J,I,K){z.parent().data("easytabs").cached=true;q.trigger("easytabs:ajax:complete",[z,D,J,I,K])})}if(r.animate&&r.transitionOut=="fadeOut"){if(C>0){y.animate({height:(y.height()+C)},v.halfSpeed)}else{y.css({"min-height":y.height()})}}f.tabs.filter("."+r.tabActiveClass).removeClass(r.tabActiveClass).children().removeClass(r.tabActiveClass);f.tabs.filter("."+r.collapsedClass).removeClass(r.collapsedClass).children().removeClass(r.collapsedClass);z.parent().addClass(r.tabActiveClass).children().addClass(r.tabActiveClass);f.panels.filter("."+r.panelActiveClass).removeClass(r.panelActiveClass);D.addClass(r.panelActiveClass);if(A.length){A[v.hide](v.speed,r.transitionOutEasing,G)}else{D[v.uncollapse](v.speed,r.transitionUncollapseEasing,G)}}};var s=function(z){if(z.data("easytabs")&&z.data("easytabs").lastHeight){return z.data("easytabs").lastHeight}var B=z.css("display"),y,x;try{y=a("<div></div>",{position:"absolute",visibility:"hidden",overflow:"hidden"})}catch(A){y=a("<div></div>",{visibility:"hidden",overflow:"hidden"})}x=z.wrap(y).css({position:"relative",visibility:"hidden",display:"block"}).outerHeight();z.unwrap();z.css({position:z.data("easytabs").position,visibility:z.data("easytabs").visibility,display:B});z.data("easytabs").lastHeight=x;return x};var k=function(y){var x=y.outerHeight();if(y.data("easytabs")){y.data("easytabs").lastHeight=x}else{y.data("easytabs",{lastHeight:x})}return x};var n=function(){if(typeof a(window).hashchange==="function"){a(window).hashchange(function(){f.selectTabFromHashChange()})}else{if(a.address&&typeof a.address.change==="function"){a.address.change(function(){f.selectTabFromHashChange()})}}};var c=function(){var x;if(r.cycle){x=f.tabs.index(h);setTimeout(function(){f.cycleTabs(x+1)},r.cycle)}};f.init()};a.fn.easytabs=function(c){var b=arguments;return this.each(function(){var e=a(this),d=e.data("easytabs");if(undefined===d){d=new a.easytabs(this,c);e.data("easytabs",d)}if(d.publicMethods[c]){return d.publicMethods[c](Array.prototype.slice.call(b,1))}})}})(jQuery);

/*jslint regexp: true, nomen: true, sloppy: true, eqeq: true, vars: true, white: true, plusplus: true, maxerr: 50, indent: 4 */
var sss_admin;

;(function($, window, document, undefined) {
    sss_admin = {
        scroll_offset: 40,
        init: function() {
            $(".sct-input-numeric").limitkeypress({ rexp: /^[+]?\d*$/ });

            $("#run-export").click(function(){
                var url = $(this).data("url") + "&export=", lists = [];

                $(".sct-export-list.to-export input:checked").each(function(){
                    lists.push($(this).val());
                });

                window.location = url + lists.join(".");
            });
        },
        sidebars: function() {
            $(".stw-block-element *, .srt-job-options a, .sct-table-grid a").tooltip();

            $("#sidebar-content-select").change(function(){
                var val = $(this).val();

                $("tr.sidebar-content").hide();
                $("tr#sidebar-content-" + val).fadeIn();
            });

            $(".sss-form-rules .sss-rule-active").change(function(){
                var active = jQuery(this).is(":checked"),
                    settings = jQuery(this).closest('fieldset').find('div');

                if (active) {
                    settings.show();
                } else {
                    settings.hide();
                }
            });

            $("#sss-rules-mode").change(function(){
                var custom = jQuery(this).val() === 'rules';

                if (custom) {
                    jQuery("#sss-custom-rules").show();
                } else {
                    jQuery("#sss-custom-rules").hide();
                }
            });

            $("#sss-sidebars-grid tbody").sortable({
                cursor: "move",
                axis: "y",
                handle: ".sss-sort-handler",
                scrollSensitivity: 32,
                helper: function(e, ui) {					
                    ui.children().each(function() {
                        jQuery(this).width(jQuery(this).width());
                    });

                    return ui;
                },
                start: function(event, ui) {
                    ui.item.addClass("sss-tr-dragged");
                    
                    var height = ui.item.height();

                    jQuery("#sss-sidebars-grid tbody tr.ui-sortable-placeholder").height(height);
                },
                stop: function(event, ui) {
                    ui.item.removeClass("sss-tr-dragged");
                },
                update: function(event, ui) {
                    var order = [];

                    jQuery("#sss-sidebars-grid tbody tr").each(function(idx) {
                        order.push(jQuery(this).data("sidebar"));
                    });

                    jQuery.ajax({
                        dataType: "html", data: { list: order },
                        type: "POST", url: "admin-ajax.php?action=sss_sidebars_change_order&_ajax_nonce=" + sss_admin_data.nonce
                    });
                }
            });
        },
        styler: function() {
            $(".stw-block-element *, .srt-job-options a, .sct-table-grid a").tooltip();

            $("#std-preview .std-drawer").nanoScroller();

            $(".stw-style-builder").easytabs({
                updateHash: false,
                tabs: "ul.stw-header > li",
                tabActiveClass: "stw-tab-active",
                panelActiveClass: "stw-panel-active"
            });

            $(".stw-color-hex").minicolors({
                opacity: true, 
                position: "top", 
                change: function(hex, opacity) {
                    $(this).closest("div.stw-block-element").find(".stw-color-opacity").val(opacity).trigger("change");
                }
            });

            $(".stw-color-opacity").spinner({
                step: 0.01, numberFormat: "n", min: 0, max: 1,
                change: function() {
                    $(this).closest("div.stw-block-element").find(".stw-color-hex").minicolors("opacity", $(this).val());
                },
                spin: function() {
                    $(this).closest("div.stw-block-element").find(".stw-color-hex").minicolors("opacity", $(this).val());
                }
            });

            $(".stw-block-background input, .stw-block-color input").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _clr = _obj.find(".stw-color-hex").minicolors("rgbaString");
                var _slk = _obj.data("selector");
                var _ttr = _obj.data("attribute");

                $(_slk).css(_ttr, _clr);
            });

            $(".stw-block-borderradius input, .stw-block-padding input").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _clr = _obj.find(".stw-numeric-input").val();
                var _slk = _obj.data("selector");
                var _ttr = _obj.data("attribute");

                $(_slk).css(_ttr, _clr + "px");
            });

            $(".stw-block-fontsize select, .stw-block-fontsize input").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _fnt = _obj.find('.stw-font-value').val();
                var _unt = _obj.find('.stw-font-unit').val();
                var _slk = _obj.data("selector");

                $(_slk).css('font-size', _fnt + _unt);
            });

            $(".stw-block-fontstyle select, .stw-block-fontweight select").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _vle = _obj.find("select").val();
                var _slk = _obj.data("selector");
                var _ttr = _obj.data("attribute");

                $(_slk).css(_ttr, _vle);
            });

            $(".stw-block-fontfamily select").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _vle = _obj.find("select").val();
                var _fnt = _obj.find("select option:selected").text();
                var _slk = _obj.data("selector");
                var _ttr = _obj.data("attribute");

                if (_vle === "none") {
                    _fnt = "";
                } else if (_vle === "inherit") {
                    _fnt = "inherit";
                }

                $(_slk).css(_ttr, _fnt);
            });

            $(".stw-block-border input, .stw-block-border select").change(function(){
                var _obj = $(this).closest("div.stw-block-element");

                var _wdt = _obj.find(".stw-width-value").val();
                var _lne = _obj.find(".stw-width-border").val();
                var _clr = _obj.find(".stw-color-hex").minicolors("rgbaString");
                var _slk = _obj.data("selector");
                var _ttr = _obj.data("attribute");

                $(_slk).css(_ttr, _wdt + "px" + " " + _lne + " " + _clr);

                $("#std-preview .std-tab").css("margin-left", (156 - parseInt(_wdt)) + "px");
            });

            $(".stw-block-element input, .stw-block-element select").trigger("change");
        },
        export: function() {
            $("#run-export").click(function(){
                var url = $(this).data("url"), exp = [];

                $("[name^=export_]").each(function(){
                    if ($(this).is(":checked")) {
                        exp.push($(this).attr("id").substr(7));
                    }
                });

                url+= "&export=" + exp.join(",");
                window.location = url;
            });
        },
        scroller: function() {
            var $sidebar = $("#scs-scroll-sidebar"), 
                $window = $(window);

            if ($sidebar.length > 0) {
                var offset = $sidebar.offset();

                $window.scroll(function() {
                    if ($window.scrollTop() > offset.top && $sidebar.hasClass("scs-scroll-active")) {
                        $sidebar.stop().animate({
                            marginTop: $window.scrollTop() - offset.top + sss_admin.scroll_offset
                        });
                    } else {
                        $sidebar.stop().animate({
                            marginTop: 0
                        });
                    }
                });
            }
        },
        confirm: function() {
            return confirm(sss_admin_data.confirm_areyousure);
        }
    };

    $(document).ready(function() {
        sss_admin.init();
        sss_admin.scroller();

        if (sss_admin_data.init_styler) {
            sss_admin.styler();
        }

        if (sss_admin_data.init_sidebars) {
            sss_admin.sidebars();
        }

        if (sss_admin_data.init_export) {
            sss_admin.export();
        }
    });
})(jQuery, window, document);
