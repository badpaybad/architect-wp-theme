jQuery.fn.exists = function(callback) {
  var args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
};

/*! .isOnScreen() returns bool */
jQuery.fn.isOnScreen = function(){

    var win = jQuery(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};

/*----------------------------------------------------
/* Header Search
/*---------------------------------------------------*/
jQuery(document).ready(function($){
    var $header = $('#header');
    var $input = $header.find('.hideinput, .header-search .fa-search');
    $header.find('.fa-search').hover(function(e){
        $input.addClass('active').focus();
    }, function() {
       
    });
    $('.header-search .hideinput').click(function(e) {
        e.stopPropagation();
    });
}).click(function(e) {
    jQuery('#header .hideinput, .header-search .fa-search').removeClass('active');
});

jQuery(document).ready(function($){
    $('.header-search .fa-search').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
});

/*----------------------------------------------------
/* Scroll to top
/*--------------------------------------------------*/
jQuery(document).ready(function($) {
	//move-to-top arrow
	jQuery("body").prepend("<a href='#' id='move-to-top' class='animate to-top'><i class='fa fa-angle-up'></i></a>");
	var scrollDes = 'html,body';  
	/*Opera does a strange thing if we use 'html' and 'body' together so my solution is to do the UA sniffing thing*/
	if(navigator.userAgent.match(/opera/i)){
		scrollDes = 'html';
	}
	//show ,hide
	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 160) {
			jQuery('#move-to-top').addClass('filling').removeClass('hiding');
		} else {
			jQuery('#move-to-top').removeClass('filling').addClass('hiding');
		}
	});
	// scroll to top when click 
	jQuery('#move-to-top').click(function(e) {
        e.preventDefault();
		jQuery(scrollDes).animate({ 
			scrollTop: 0
		},{
			duration :500
		});
	});
});

/*----------------------------------------------------
/* Responsive Navigation
/*--------------------------------------------------*/
if (mts_customscript.responsive && mts_customscript.nav_menu != 'none') {
    jQuery(document).ready(function($){
        $('body').append('<div id="mobile-menu-overlay" />');
        // merge if two menus exist
        var menu_wrapper;
        if (mts_customscript.nav_menu == 'both') {
            menu_wrapper = $('.primary-navigation')
                .clone().attr('class', 'mobile-menu primary').wrap('<div id="mobile-menu-wrapper" />')
                .parent().hide()
                .appendTo('body');
            $('.footer-navigation').clone().attr('class', 'mobile-menu footer').appendTo(menu_wrapper);
        } else {
            menu_wrapper = $('.'+mts_customscript.nav_menu+'-navigation')
                .clone().attr('class', 'mobile-menu ' + mts_customscript.nav_menu)
                .wrap('<div id="mobile-menu-wrapper" />').parent().hide()
                .appendTo('body');
        }
    
        $('.toggle-mobile-menu').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#mobile-menu-wrapper').show();

            if ( $('body').hasClass('mobile-menu-active') ) {

                var scrollTop = parseInt( $('html').css('top') );
                $('html').removeClass('noscroll');
                $('html,body').scrollTop( -scrollTop );
                $('body').removeClass('mobile-menu-active');
                $('#mobile-menu-overlay').fadeOut();

            } else {

                $('body').addClass('mobile-menu-active');
                if ( $(document).height() > $(window).height() ) {
                    var scrollTop = ( $('html').scrollTop() ) ? $('html').scrollTop() : $('body').scrollTop();
                    $('html').addClass('noscroll').css( 'top', -scrollTop );
                }
                $('#mobile-menu-overlay').fadeIn();
            }
        });
    }).click(function() {
        if ( !jQuery('body').hasClass('mobile-menu-active') ) {
            return;
        }

        jQuery('body').removeClass('mobile-menu-active');
        jQuery('html').removeClass('noscroll');
        jQuery('#mobile-menu-overlay').fadeOut();

        if ( jQuery('a#pull').css('display') !== 'none' ) { // if toggle menu button is visible ( small screens )
            var scrollTop = parseInt( jQuery('html').css('top') );
            jQuery('html,body').scrollTop( -scrollTop );
        }
    });
}
/*----------------------------------------------------
/* Remove active state for nav links which uses #
/*--------------------------------------------------*/
jQuery(document).ready(function($){
    jQuery('.secondary-navigation .menu-item').each(function() {
        var $this = jQuery(this);
        if ($this.find('a').first().attr('href').indexOf("#") != -1) {
            $this.removeClass('current-menu-item');
        }
    });
});

/*----------------------------------------------------
/* Smooth scroll
/*--------------------------------------------------*/
jQuery(document).ready(function($) { 
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            if ($('body').hasClass('mobile-menu-active')) {
                $('body').removeClass('mobile-menu-active');
                $('html').removeClass('noscroll');
                $('#mobile-menu-overlay').fadeOut();
            }
            $('html,body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
    });
});

/*----------------------------------------------------
/*  Dropdown menu
/* ------------------------------------------------- */
jQuery(document).ready(function($) { 
	$('#navigation ul.sub-menu, #navigation ul.children').hide(); // hides the submenus in mobile menu too
	$('#navigation li').hover( 
		function() {
			$(this).children('ul.sub-menu, ul.children').slideDown('fast');
		}, 
		function() {
			$(this).children('ul.sub-menu, ul.children').hide();
		}
	);
});

/*---------------------------------------------------
/*  Vertical ( widget ) menus/lists
/* -------------------------------------------------*/
jQuery(document).ready(function($) {

    $('.widget_nav_menu, .widget_product_categories, .widget_pages').addClass('toggle-menu');
    $('.toggle-menu ul.sub-menu, .toggle-menu ul.children').addClass('toggle-submenu');
    $('.toggle-menu .current-menu-item, .toggle-menu .current-cat, .toggle-menu .current_page_item').addClass('toggle-menu-current-item');
    $('.toggle-menu .menu-item-has-children, .toggle-menu .cat-parent, .toggle-menu .page_item_has_children').addClass('toggle-menu-item-parent');

    $('.toggle-menu').each(function() {
        var $this = $(this);

        $this.find('.toggle-submenu').hide();

        $this.find('.toggle-menu-current-item').last().parents('.toggle-menu-item-parent').addClass('active').children('.toggle-submenu').show();
        $this.find('.toggle-menu-item-parent').append('<span class="toggle-caret"><i class="fa fa-angle-down"></i></span>');
    });
    

    $('.toggle-caret').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('active').children('.toggle-submenu').slideToggle('fast');
    });
});

/*----------------------------------------------------
/* Social button scripts
/*---------------------------------------------------*/
jQuery(document).ready(function($){
	(function(d, s) {
	  var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.src = url; js.id = id;
		fjs.parentNode.insertBefore(js, fjs);
	  };
	jQuery('span.facebookbtn, .facebook_like').exists(function() {
	  load('//connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
	});
	jQuery('span.gplusbtn').exists(function() {
	  load('https://apis.google.com/js/plusone.js', 'gplus1js');
	});
	jQuery('span.twitterbtn').exists(function() {
	  load('//platform.twitter.com/widgets.js', 'tweetjs');
	});
	jQuery('span.linkedinbtn').exists(function() {
	  load('//platform.linkedin.com/in.js', 'linkedinjs');
	});
	jQuery('span.pinbtn').exists(function() {
	  load('//assets.pinterest.com/js/pinit.js', 'pinterestjs');
	});
	jQuery('span.stumblebtn').exists(function() {
	  load('//platform.stumbleupon.com/1/widgets.js', 'stumbleuponjs');
	});
	}(document, 'script'));
});

/*----------------------------------------------------
/* Crossbrowser input placeholder fix
/*---------------------------------------------------*/
jQuery(document).ready(function($){
    $(function() {
        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();
        $('[placeholder]').parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            })
        });
    });
});

/*
jquery.animate-enhanced plugin v1.08
---
http://github.com/benbarnett/jQuery-Animate-Enhanced
http://benbarnett.net
@benpbarnett
*/
(function(d,C,D){function J(a,b,l,c){if("d"!=l&&E(a)){var f=K.exec(b),e="auto"===a.css(l)?0:a.css(l),e="string"==typeof e?z(e):e;"string"==typeof b&&z(b);c=!0===c?0:e;var g=a.is(":hidden"),n=a.translation();"left"==l&&(c=parseInt(e,10)+n.x);"right"==l&&(c=parseInt(e,10)+n.x);"top"==l&&(c=parseInt(e,10)+n.y);"bottom"==l&&(c=parseInt(e,10)+n.y);if(f||"show"!=b)f||"hide"!=b||(c=0);else if(c=1,g)elem=a[0],elem.style&&(display=elem.style.display,d._data(elem,"olddisplay")||"none"!==display||(display=elem.style.display=
""),""===display&&"none"===d.css(elem,"display")&&d._data(elem,"olddisplay",L(elem.tagName)),""===display||"none"===display)&&(elem.style.display=d._data(elem,"olddisplay")||""),a.css("opacity",0);return f?(a=parseFloat(f[2]),f[1]&&(a=("-="===f[1]?-1:1)*a+parseInt(c,10)),f[3]&&"px"!=f[3]&&(a+=f[3]),a):c}}function M(a,b,l,c,f,e,g,n){var m=a.data(r),m=m&&!q(m)?m:d.extend(!0,{},N),s=f;if(-1<d.inArray(b,A)){var k=m.meta,p=z(a.css(b))||0,t=b+"_o",s=f-p;k[b]=s;k[t]="auto"==a.css(b)?0+s:p+s||0;m.meta=k;
g&&0===s&&(s=0-k[t],k[b]=s,k[t]=0)}return a.data(r,O(a,m,b,l,c,s,e,g,n))}function O(a,b,d,c,f,e,g,n,m){var s=!1;g=!0===g&&!0===n;b=b||{};b.original||(b.original={},s=!0);b.properties=b.properties||{};b.secondary=b.secondary||{};n=b.meta;for(var r=b.original,p=b.properties,t=b.secondary,h=k.length-1;0<=h;h--){var u=k[h]+"transition-property",v=k[h]+"transition-duration",q=k[h]+"transition-timing-function";d=g?k[h]+"transform":d;s&&(r[u]=a.css(u)||"",r[v]=a.css(v)||"",r[q]=a.css(q)||"");var P=t,Q=d,
w;if(g){w=n.left;var F=n.top;w=!0===m||!0===B&&!1!==m&&G?"translate3d("+w+"px, "+F+"px, 0)":"translate("+w+"px,"+F+"px)"}else w=e;P[Q]=w;p[u]=(p[u]?p[u]+",":"")+d;p[v]=(p[v]?p[v]+",":"")+c+"ms";p[q]=(p[q]?p[q]+",":"")+f}return b}function R(a){for(var b in a)if(!("width"!=b&&"height"!=b||"show"!=a[b]&&"hide"!=a[b]&&"toggle"!=a[b]))return!0;return!1}function q(a){for(var b in a)return!1;return!0}function L(a){a=a.toUpperCase();var b={LI:"list-item",TR:"table-row",TD:"table-cell",TH:"table-cell",CAPTION:"table-caption",
COL:"table-column",COLGROUP:"table-column-group",TFOOT:"table-footer-group",THEAD:"table-header-group",TBODY:"table-row-group"};return"string"==typeof b[a]?b[a]:"block"}function z(a){return parseFloat(a.replace(a.match(/\D+$/),""))}function E(a){var b=!0;a.each(function(a,d){return b=b&&d.ownerDocument});return b}function S(a,b,l){if(!E(l))return!1;var c=-1<d.inArray(a,T);"width"!=a&&"height"!=a&&"opacity"!=a||parseFloat(b)!==parseFloat(l.css(a))||(c=!1);return c}var T="top right bottom left opacity height width".split(" "),
A=["top","right","bottom","left"],k=["-webkit-","-moz-","-o-",""],U=["avoidTransforms","useTranslate3d","leaveTransforms"],K=/^([+-]=)?([\d+-.]+)(.*)$/,V=/([A-Z])/g,N={secondary:{},meta:{top:0,right:0,bottom:0,left:0}},r="jQe",H=null,x=!1,y=(document.body||document.documentElement).style,I=void 0!==y.WebkitTransition||void 0!==y.MozTransition||void 0!==y.OTransition||void 0!==y.transition,G="WebKitCSSMatrix"in window&&"m11"in new WebKitCSSMatrix,B=G;d.expr&&d.expr.filters&&(H=d.expr.filters.animated,
d.expr.filters.animated=function(a){return d(a).data("events")&&d(a).data("events")["webkitTransitionEnd oTransitionEnd transitionend"]?!0:H.call(this,a)});d.extend({toggle3DByDefault:function(){return B=!B},toggleDisabledByDefault:function(){return x=!x},setDisabledByDefault:function(a){return x=a}});d.fn.translation=function(){if(!this[0])return null;var a=window.getComputedStyle(this[0],null),b={x:0,y:0};if(a)for(var d=k.length-1;0<=d;d--){var c=a.getPropertyValue(k[d]+"transform");if(c&&/matrix/i.test(c)){a=
c.replace(/^matrix\(/i,"").split(/, |\)$/g);b={x:parseInt(a[4],10),y:parseInt(a[5],10)};break}}return b};d.fn.animate=function(a,b,l,c){a=a||{};var f=!("undefined"!==typeof a.bottom||"undefined"!==typeof a.right),e=d.speed(b,l,c),g=0,n=function(){g--;0===g&&"function"===typeof e.complete&&e.complete.apply(this,arguments)};return!0===("undefined"!==typeof a.avoidCSSTransitions?a.avoidCSSTransitions:x)||!I||q(a)||R(a)||0>=e.duration||e.step?C.apply(this,arguments):this[!0===e.queue?"queue":"each"](function(){var b=
d(this),c=d.extend({},e),l=function(c){var e=b.data(r)||{original:{}},g={};if(2==c.eventPhase){if(!0!==a.leaveTransforms){for(c=k.length-1;0<=c;c--)g[k[c]+"transform"]="";if(f&&"undefined"!==typeof e.meta){c=0;for(var h;h=A[c];++c)g[h]=e.meta[h+"_o"]+"px",d(this).css(h,g[h])}}b.unbind("webkitTransitionEnd oTransitionEnd transitionend").css(e.original).css(g).data(r,null);"hide"===a.opacity&&(elem=b[0],elem.style&&(display=d.css(elem,"display"),"none"===display||d._data(elem,"olddisplay")||d._data(elem,
"olddisplay",display),elem.style.display="none"),b.css("opacity",""));n.call(this)}},p={bounce:"cubic-bezier(0.0, 0.35, .5, 1.3)",linear:"linear",swing:"ease-in-out",easeInQuad:"cubic-bezier(0.550, 0.085, 0.680, 0.530)",easeInCubic:"cubic-bezier(0.550, 0.055, 0.675, 0.190)",easeInQuart:"cubic-bezier(0.895, 0.030, 0.685, 0.220)",easeInQuint:"cubic-bezier(0.755, 0.050, 0.855, 0.060)",easeInSine:"cubic-bezier(0.470, 0.000, 0.745, 0.715)",easeInExpo:"cubic-bezier(0.950, 0.050, 0.795, 0.035)",easeInCirc:"cubic-bezier(0.600, 0.040, 0.980, 0.335)",
easeInBack:"cubic-bezier(0.600, -0.280, 0.735, 0.045)",easeOutQuad:"cubic-bezier(0.250, 0.460, 0.450, 0.940)",easeOutCubic:"cubic-bezier(0.215, 0.610, 0.355, 1.000)",easeOutQuart:"cubic-bezier(0.165, 0.840, 0.440, 1.000)",easeOutQuint:"cubic-bezier(0.230, 1.000, 0.320, 1.000)",easeOutSine:"cubic-bezier(0.390, 0.575, 0.565, 1.000)",easeOutExpo:"cubic-bezier(0.190, 1.000, 0.220, 1.000)",easeOutCirc:"cubic-bezier(0.075, 0.820, 0.165, 1.000)",easeOutBack:"cubic-bezier(0.175, 0.885, 0.320, 1.275)",easeInOutQuad:"cubic-bezier(0.455, 0.030, 0.515, 0.955)",
easeInOutCubic:"cubic-bezier(0.645, 0.045, 0.355, 1.000)",easeInOutQuart:"cubic-bezier(0.770, 0.000, 0.175, 1.000)",easeInOutQuint:"cubic-bezier(0.860, 0.000, 0.070, 1.000)",easeInOutSine:"cubic-bezier(0.445, 0.050, 0.550, 0.950)",easeInOutExpo:"cubic-bezier(1.000, 0.000, 0.000, 1.000)",easeInOutCirc:"cubic-bezier(0.785, 0.135, 0.150, 0.860)",easeInOutBack:"cubic-bezier(0.680, -0.550, 0.265, 1.550)"},t={},p=p[c.easing||"swing"]?p[c.easing||"swing"]:c.easing||"swing",h;for(h in a)if(-1===d.inArray(h,
U)){var u=-1<d.inArray(h,A),v=J(b,a[h],h,u&&!0!==a.avoidTransforms);S(h,v,b)?M(b,h,c.duration,p,v,u&&!0!==a.avoidTransforms,f,a.useTranslate3d):t[h]=a[h]}b.unbind("webkitTransitionEnd oTransitionEnd transitionend");h=b.data(r);if(!h||q(h)||q(h.secondary))c.queue=!1;else{g++;b.css(h.properties);var x=h.secondary;setTimeout(function(){b.bind("webkitTransitionEnd oTransitionEnd transitionend",l).css(x)})}q(t)||(g++,C.apply(b,[t,{duration:c.duration,easing:d.easing[c.easing]?c.easing:d.easing.swing?"swing":
"linear",complete:n,queue:c.queue}]));return!0})};d.fn.animate.defaults={};d.fn.stop=function(a,b,l){if(!I)return D.apply(this,[a,b]);a&&this.queue([]);this.each(function(){var c=d(this),f=c.data(r);if(f&&!q(f)){var e,g={};if(b){if(g=f.secondary,!l&&void 0!==typeof f.meta.left_o||void 0!==typeof f.meta.top_o)for(g.left=void 0!==typeof f.meta.left_o?f.meta.left_o:"auto",g.top=void 0!==typeof f.meta.top_o?f.meta.top_o:"auto",e=k.length-1;0<=e;e--)g[k[e]+"transform"]=""}else if(!q(f.secondary)){var n=
window.getComputedStyle(c[0],null);if(n)for(var m in f.secondary)if(f.secondary.hasOwnProperty(m)&&(m=m.replace(V,"-$1").toLowerCase(),g[m]=n.getPropertyValue(m),!l&&/matrix/i.test(g[m])))for(e=g[m].replace(/^matrix\(/i,"").split(/, |\)$/g),g.left=parseFloat(e[4])+parseFloat(c.css("left"))+"px"||"auto",g.top=parseFloat(e[5])+parseFloat(c.css("top"))+"px"||"auto",e=k.length-1;0<=e;e--)g[k[e]+"transform"]=""}c.unbind("webkitTransitionEnd oTransitionEnd transitionend");c.css(f.original).css(g).data(r,
null)}else D.apply(c,[a,b])});return this}})(jQuery,jQuery.fn.animate,jQuery.fn.stop);

/*----------------------------------------------------
/* Animate counter numbers 
/*--------------------------------------------------*/
(function($) {
    $.fn.animateNumbers = function(stop, commas, duration, ease) {
        return this.each(function() {
            var $this = $(this);
            var start = parseInt($this.text().replace(/,/g, ""));
commas = (commas === undefined) ? true : commas;
            $({value: start}).animate({value: stop}, {
             duration: duration == undefined ? 1000 : duration,
             easing: ease == undefined ? "swing" : ease,
             step: function() {
             $this.text(Math.floor(this.value));
if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
             },
             complete: function() {
             if (parseInt($this.text()) !== stop) {
             $this.text(stop);
if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
             }
             }
            });
        });
    };
})(jQuery);