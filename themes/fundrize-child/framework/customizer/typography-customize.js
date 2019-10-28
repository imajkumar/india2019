/**
 * Update Typography Customizer settings live.
*/

( function( $ ) {

// Declare vars
var api = wp.customize;

var objFont = {
	body: "body",
	headings: "h1,h2,h3,h4,h5,h6, .font-heading, .wprt-causes .campaign .campaign-donation-stats, #gallery-filter .cbp-filter-item, .single-figure .figure, #charitable-donation-login-form, #charitable-donation-form, .campaign .login-prompt, .woo-single-post-class .summary .product_meta > span, .products li .price, .products li .product-info .add_to_cart_button, .products li .product-info .product_type_variable",
	top_bar_content: "#top-bar .top-bar-content .content, #top-bar .top-bar-socials .texts",
	header_aside_title: "#site-header .wprt-info .info-c > .title",
	header_aside_subtitle: "#site-header .wprt-info .info-c > .subtitle",
	main_menu: "#main-nav > ul > li > a",
	main_menu_dropdown: "#main-nav .sub-menu li a",
	mobile_menu: "#main-nav-mobi ul > li > a",
	featured_title: "#featured-title .featured-title-heading",
	blog_post_title: ".hentry .post-title",
	blog_single_post_title: ".post-content-single-wrap .hentry .post-title",
	blog_post_meta: ".hentry .post-meta",
	theme_button: ".hentry .post-link a, .wprt-news .post-btn a, .wpcf7-form-control.wpcf7-submit",
	breadcrumbs: "#featured-title #breadcrumbs",
	sidebar_widget_title: "#sidebar .widget .widget-title",
	entry_h1: "h1",
	entry_h2: "h2",
	entry_h3: "h3",
	entry_h4: "h4",
	footer_widget_title: "#footer-widgets .widget .widget-title",
	copyright: "#copyright",
	bottom_menu: "#bottom ul.bottom-nav > li > a"
};

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-family]", function(e) {
	    e.bind(function(e) {
	        if (e) {
	            var t = (e.trim().toLowerCase().replace(" ", "-"), "customizer-typography-" + k + "-font-family"),
	                i = e.replace(" ", "%20");
	            i = i.replace(",", "%2C"), i = wprt.googleFontsUrl + "/css?family=" + e + ":300italic,400italic,600italic,700italic,800italic,400,300,600,700,800", $("#" + t).length ? $("#" + t).attr("href", i) : $("head").append('<link id="' + t + '" rel="stylesheet" type="text/css" href="' + i + '">')
	        }
	        var a = $(".customizer-typography-" + k + "-font-family");
	        if (e) {
	            var o = '<style class="customizer-typography-' + k + '-font-family">' + v + '{font-family: ' + e + ";</style>";
	            a.length ? a.replaceWith(o) : $("head").append(o)
	        } else a.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-weight]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-weight");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-weight">' + v + '{font-weight: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-style]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-style");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-style">' + v + '{font-style: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[font-size]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-font-size");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-font-size">' + v + '{font-size: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[color]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-color");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-color">' + v + '{color: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[line-height]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-line-height");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-line-height">' + v + '{line-height: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[letter-spacing]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-letter-spacing");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-letter-spacing">' + v + '{letter-spacing: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

$.each( objFont, function( k, v ) {
	api( k + "_typography[text-transform]", function(e) {
	    e.bind(function(e) {
	        var t = $(".customizer-typography-" + k + "-text-transform");
	        if (e) {
	            var i = '<style class="customizer-typography-' + k + '-text-transform">' + v + '{text-transform: ' + e + ";</style>";
	            t.length ? t.replaceWith(i) : $("head").append(i)
	        } else t.remove()
	    })
	});
});

} )( jQuery );