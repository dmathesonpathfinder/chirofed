/* SCROLL TO TOP */
var scrolltotop={setting:{startline:100,scrollto:0,scrollduration:0,fadeduration:[0,0]},controlHTML:'<span class="fa fa-chevron-up to-top-btn"></span>',controlattrs:{offsetx:15,offsety:10},anchorkeyword:"#top",state:{isvisible:!1,shouldvisible:!1},scrollup:function(){this.cssfixedsupport||this.$control.css({opacity:0});var t=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);t="string"==typeof t&&1==jQuery("#"+t).length?jQuery("#"+t).offset().top:0,this.$body.animate({scrollTop:t},this.setting.scrollduration)},keepfixed:function(){var t=jQuery(window),o=t.scrollLeft()+t.width()-this.$control.width()-this.controlattrs.offsetx,s=t.scrollTop()+t.height()-this.$control.height()-this.controlattrs.offsety;this.$control.css({left:o+"px",top:s+"px"})},togglecontrol:function(){var t=jQuery(window).scrollTop();this.cssfixedsupport||this.keepfixed(),this.state.shouldvisible=t>=this.setting.startline?!0:!1,this.state.shouldvisible&&!this.state.isvisible?(this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]),this.state.isvisible=!0):0==this.state.shouldvisible&&this.state.isvisible&&(this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]),this.state.isvisible=!1)},init:function(){jQuery(document).ready(function(t){var o=scrolltotop,s=document.all;o.cssfixedsupport=!s||s&&"CSS1Compat"==document.compatMode&&window.XMLHttpRequest,o.$body=t(window.opera?"CSS1Compat"==document.compatMode?"html":"body":"html,body"),o.$control=t('<div id="topcontrol">'+o.controlHTML+"</div>").css({position:o.cssfixedsupport?"fixed":"absolute",bottom:o.controlattrs.offsety,right:o.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"Scroll to Top"}).click(function(){return o.scrollup(),!1}).appendTo("body"),document.all&&!window.XMLHttpRequest&&""!=o.$control.text()&&o.$control.css({width:o.$control.width()}),o.togglecontrol(),t('a[href="'+o.anchorkeyword+'"]').click(function(){return o.scrollup(),!1}),t(window).bind("scroll resize",function(t){o.togglecontrol()})})}};scrolltotop.init();

(function($) {
$(document).ready(function() {

	/* RESPONSIVE DROPDOWN MENU */

	$("#navigation .menu").before('<div class="menu-icon"><span class="fas navicon fa-bars"></span></div>').prepend('<div class="menu-closer fas fa-times"></div>');
	$('.sub-menu, .sub-menu .sub-menu').prepend('<div class="menu-closer menu-back fas fa-long-arrow-alt-left"></div>');


	if (window.innerWidth <= 1024) {

		$('.menu-icon').on('click', function(e) {
			e.preventDefault();
			if ($('#navigation .menu').hasClass('show-menu')) {
				$('#navigation .menu').removeClass('show-menu');
			} else {
				$('#navigation .menu').addClass('show-menu');
				$('html').addClass('hide-scroll');
			}
			if ($('html').hasClass('hide-scroll')) {
				$('.menu-closer.fa-times').on('click', function() {
					$('html').removeClass('hide-scroll');
				});
			}
		});
		// Sub menus open
		$('.menu-item-has-children > a').on('click', function(e) {
			e.preventDefault();
			$(this).siblings('.sub-menu').addClass('show-menu');
		});
		$('.menu-closer').on('click', function(e) {
			e.preventDefault();
			$(this).parent().removeClass('show-menu');
		});

	}

	/* OPEN LOGIN MODAL ON CLICK */

	// this initializes the dialog
	$("#login-modal").dialog({
		autoOpen : false,
		modal : true,
		show : "drop",
		hide : "drop",
		draggable : false,
		minWidth : 430
	});

	// next add the onclick handler
	$("#login-button").click(function() {
		if ($('body').hasClass('overlay light')) {
			$(this).removeClass('overlay light');
			$("#login-modal").dialog("close");
		} else {
			$('body').addClass('overlay light');
			$("#login-modal").dialog("open");
		}
		return false;
	});
	$('.ui-dialog-titlebar-close').click(function() {
		$('body').removeClass('overlay light');
	})

	/* SLIDE IN SEARCH FORM ON CLICK */

	$('#search-box a.fas').on('click', function(e) {
		e.preventDefault();
		if ($('#search-box').hasClass('show')) {
			$(this).removeClass('active').removeClass('fa-times').addClass('fa-search');;
			$('#search-box').removeClass('show');
			$('#search-form').animate({width: "toggle"}, 100);
			$('body').removeClass('overlay');
		} else {
			$(this).addClass('active').removeClass('fa-search').addClass('fa-times');
			$('#search-box').addClass('show');
			$('#search-form').animate({width: "toggle"}, 100);
			$('body').addClass('overlay');
		}
	});

	/* SLIDE UP ITEMS ON SCROLL */

	$(".slide-up-element").css("position", "relative").addClass("slide-up");

	var animation_elements = $.find('.slide-up');
	var web_window = $(window);

	function check_if_in_view() {
		var window_height = web_window.height();
		var window_top_position = web_window.scrollTop();
		var window_bottom_position = (window_top_position + window_height);

		$.each(animation_elements, function() {

		var element = $(this);
		var element_height = $(element).outerHeight();
		var element_top_position = $(element).offset().top;
		var element_bottom_position = (element_top_position + element_height);

		if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
			element.addClass('in-view');
		}
		});

	}

	$(window).on('scroll resize', function() {
		check_if_in_view()
		})
	$(window).trigger('scroll');

});
}(jQuery));