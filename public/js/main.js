/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Back To Top Js
03. sticky header
04. Add tag 
05. Common Js
06. Mobile Menu Js
07. Add hover class
08. Offcanvas Js
09. Body overlay Js
10. One Page Scroll Js
11. Nice Select Js
12. MagnificPopup
13. Hover to Active
14. Range slider
15. Password Toggle Js
16. Mouse Custom Cursor
17. Wow Js
18. Counter Js
19. Filter Show
****************************************************/

(function ($) {
	"use strict";

	var windowOn = $(window);

	////////////////////////////////////////////////////
	// 01. PreLoader Js
	windowOn.on('load', function () {
		$("#loading").fadeOut(500);
	});

	
	////////////////////////////////////////////////////
	// 02. Back To Top Js
	function back_to_top() {
		var btn = $('#back_to_top');
		var btn_wrapper = $('.back-to-top-wrapper');

		windowOn.scroll(function () {
			if (windowOn.scrollTop() > 300) {
				btn_wrapper.addClass('back-to-top-btn-show');
			} else {
				btn_wrapper.removeClass('back-to-top-btn-show');
			}
		});

		btn.on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({ scrollTop: 0 }, '300');
		});
	}
	back_to_top();


	////////////////////////////////////////////////////
	// 03. sticky header
	function tp_pinned_header(){
		var lastScrollTop = 0;

		windowOn.on('scroll',function() {
				var currentScrollTop = $(this).scrollTop();

				if(currentScrollTop > lastScrollTop) {
						$('.tp-int-menu').removeClass('tp-header-pinned');
				}else if($(this).scrollTop() <= 500){
					$('.tp-int-menu').removeClass('tp-header-pinned');
				}else {
						// Scrolling up, remove the class
						$('.tp-int-menu').addClass('tp-header-pinned');
				}
				lastScrollTop = currentScrollTop;
		});
	}
	tp_pinned_header();


	////////////////////////////////////
	// 04. Add tag 
	$('.tp-main-menu ul li a').each(function(){
		$(this).wrapInner("<span></span>");
	});


	////////////////////////////////////////////////////
	// 05. Common Js
	$("[data-background]").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});

	$("[data-text-color]").each(function () {
		$(this).css("color", $(this).attr("data-text-color"));
	});


	////////////////////////////////////////////////////
	// 06. Mobile Menu Js
	var tpMenuWrap = $('.tp-mobile-menu-active > ul').clone();
	var tpSideMenu = $('.tp-offcanvas-menu nav');
	tpSideMenu.append(tpMenuWrap);
	if ($(tpSideMenu).find('.sub-menu, .tp-mega-menu').length != 0) {
		$(tpSideMenu).find('.sub-menu, .tp-mega-menu').parent().append('<button class="tp-menu-close"><i class="fas fa-chevron-right"></i></button>');
	}

	var sideMenuList = $('.tp-offcanvas-menu nav > ul > li button.tp-menu-close, .tp-offcanvas-menu nav > ul li.has-dropdown > a');
	$(sideMenuList).on('click', function (e) {
		e.preventDefault();
		if (!($(this).parent().hasClass('active'))) {
			$(this).parent().addClass('active');
			$(this).siblings('.sub-menu, .tp-mega-menu').slideDown();
		} else {
			$(this).siblings('.sub-menu, .tp-mega-menu').slideUp();
			$(this).parent().removeClass('active');
		}
	});

	///////////////////////////////////
	// 07. Add hover class on mouseenter
	$(document).ready(function() {
		// Add hover class on mouseenter
		$('.tp-header-1-menu nav > ul > li > a').on('mouseenter', function () {
			$(".tp-header-1-menu nav > ul > li > a").removeClass("hover");
			$(this).addClass("hover");
		});
	});


	////////////////////////////////////////////////////
	// 08. Offcanvas Js
	$(".offcanvas-open-btn").on("click", function () {
		$(".offcanvas__area").addClass("offcanvas-opened");
		$(".body-overlay").addClass("opened");
	});
	$(".offcanvas-close-btn ,.tp-main-menu-mobile .tp-onepage-menu li a  > *:not(button)").on("click", function () {
		$(".offcanvas__area").removeClass("offcanvas-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 09. Body overlay Js
	$(".body-overlay").on("click", function () {
		$(".offcanvas__area").removeClass("offcanvas-opened");
		$(".tp-search-area").removeClass("opened");
		$(".cartmini__area").removeClass("cartmini-opened");
		$(".body-overlay").removeClass("opened");
	});


	////////////////////////////////////////////////////
	// 10. One Page Scroll Js
	function scrollNav() {
		$('.tp-onepage-menu li a').click(function(){
			$(".tp-onepage-menu li a.active").removeClass("active");     
			$(this).addClass("active");

			$('html, body').stop().animate({
			scrollTop: $($(this).attr('href')).offset().top - 100
			}, 300);
			return false;
		});
	}
	scrollNav();


	////////////////////////////////////////////////////
	// Rent Slider Active
	if ($('.tp-rent-slider-active').length > 0) {
		var slider = new Swiper('.tp-rent-slider-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			freeMode: true,
			breakpoints: {
				'1400':{
					slidesPerView:4,
				},
				'1200':{
					slidesPerView:3,
				},
				'768':{
					slidesPerView:2,
				},
				'576': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
				},
				pagination: {
					el: ".tp-rent-slider-dot",
					clickable: true,
				},
		});
	}


	////////////////////////////////////////////////////
	// Rent 5 Active
	if ($('.tp-rent-5-active').length > 0) {
		var slider = new Swiper('.tp-rent-5-active', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			freeMode: true,
			breakpoints: {
				'1400':{
					slidesPerView:3,
				},
				'1200':{
					slidesPerView:3,
				},
				'768':{
					slidesPerView:2,
				},
				'576': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
			},
			pagination: {
				el: ".tp-rent-5-dot",
				clickable: true,
			},
		});
	}


	////////////////////////////////////////////////////
	// Testimonial Slider Active
	if ($('.tp-testimonial-slider-active').length > 0) {
		var slider = new Swiper('.tp-testimonial-slider-active', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:3,
				},
				'1200':{
					slidesPerView:3,
				},
				'768':{
					slidesPerView:2,
				},
				'576': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
			},
			pagination: {
				el: ".tp-testimonial-slider-dot",
				clickable: true,
			},
		});
	}


	////////////////////////////////////////////////////
	// Testimonial Slider Active
	if ($('.tp-tesmimonial-2-active').length > 0) {
		var slider = new Swiper('.tp-tesmimonial-2-active', {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			
			navigation: {
				nextEl: ".tp-testimonial-button-next",
				prevEl: ".tp-testimonial-button-prev",
			},
		});
	}


	////////////////////////////////////////////////////
	// Testimonial Slider Active
	if ($('.tp-testimonial-3-active').length > 0) {
		var slider = new Swiper('.tp-testimonial-3-active', {
			slidesPerView: 2,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:2,
				},
				'1200':{
					slidesPerView:2,
				},
				'992':{
					slidesPerView:2,
				},
				'768': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
			},
		});
	}

	
	////////////////////////////////////////////////////
	//brand-slider
	if ($('.tp-brand-active').length > 0) {
		var brand_1 = new Swiper('.tp-brand-active', {
			loop: true,
			freemode: true,
			slidesPerView: 'auto',
			spaceBetween: 90,
			centeredSlides: false,
			allowTouchMove: false,
			speed: 2000,
			autoplay: {
				delay: 1,
				disableOnInteraction: true,
			},
		});
	}


	////////////////////////////////////////////////////
	// Team Slider Active
	if ($('.tp-team-active').length > 0) {
		var slider = new Swiper('.tp-team-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:4,
				},
				'1200':{
					slidesPerView:3,
				},
				'992':{
					slidesPerView:2,
				},
				'768': {
					slidesPerView:2,
				},
				'0': {
					slidesPerView:1,
				},
			},
			pagination: {
				el: ".tp-team-slider-dot",
				clickable: true,
			},
		});
	}


	////////////////////////////////////////////////////
	// offer Slider Active
	if ($('.tp-offer-active').length > 0) {
		$(document).ready(function() {
			// slick carousel
			$('.tp-offer-active').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				arrows: false,
				fade: true,
		});
		});
	}


	////////////////////////////////////////////////////
	// Listing Slider Active
	if ($('.tp-listing-active').length > 0) {
		var slider = new Swiper('.tp-listing-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:4,
				},
				'1200':{
					slidesPerView:4,
				},
				'992':{
					slidesPerView:3,
				},
				'768': {
					slidesPerView:2,
				},
				'0': {
					slidesPerView:1,
				},
			},
			navigation: {
				nextEl: ".tp-listing-button-next",
				prevEl: ".tp-listing-button-prev",
			},
		});
	}

	////////////////////////////////////////////////////
	// countries Slider Active
	if ($('.tp-countries-active').length > 0) {
		var slider = new Swiper('.tp-countries-active', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:4,
				},
				'1200':{
					slidesPerView:4,
				},
				'992':{
					slidesPerView:3,
				},
				'768': {
					slidesPerView:2,
				},
				'0': {
					slidesPerView:1,
				},
			},
			navigation: {
				nextEl: ".tp-countries-button-next",
				prevEl: ".tp-countries-button-prev",
			},
		});
	}


	// property slider //
	if ($('.tp-property-active').length > 0) {
		const slider = new Swiper('.tp-property-active', {
			// Optional parameters
			loop: true,
			slidesPerView: 2,
			spaceBetween: 30,	
			grabCursor: true,
			breakpoints: {
				'1200': {
					slidesPerView: 2,
				},
				'992': {
					slidesPerView: 2,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},

			// scrollbar
			scrollbar: {
				el: ".tp-scrollbar",
				clickable: true,
				draggable: true,
			},
		});
	}


	// property slider //
	if ($('.tp-property-5-active').length > 0) {
		const slider = new Swiper('.tp-property-5-active', {
			// Optional parameters
			loop: true,
			slidesPerView: 2,
			spaceBetween: 20,	
			grabCursor: true,
			breakpoints: {
				'1200': {
					slidesPerView: 2,
				},
				'992': {
					slidesPerView: 1,
				},
				'768': {
					slidesPerView: 1,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
			navigation: {
				nextEl: ".tp-property-button-next",
				prevEl: ".tp-property-button-prev",
			},
		});
	}

	// property slider //
	if ($('.tp-slider-image-active').length > 0) {
		const slider = new Swiper('.tp-slider-image-active', {
			loop: true,
			slidesPerView: 3,
			spaceBetween: 30,	
			grabCursor: true,
			autoplay: {
				delay: 3500,
			},
			breakpoints: {
				'1200': {
					slidesPerView: 3,
				},
				'992': {
					slidesPerView: 2,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});
	}


	//////////////////////////////////////////
	// hero 3 active
	if ($('.tp-slider-active').length > 0) {
		var slider = new Swiper('.tp-slider-active', {
			slidesPerView: 1,
			effect: 'fade',
			loop: true,
			autoplay: {
				delay: 3500,
			},
			// Navigation arrows
			navigation: {
				clickable:true,
				nextEl: '.hero-3-next',
				prevEl: '.hero-3-prev',
			},
		});
	}


	////////////////////////////////////////////////////
	// Property Slider Active
	if ($('.tp-property-details-one').length > 0) {
		var slider = new Swiper('.tp-property-details-one', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:3,
				},
				'1200':{
					slidesPerView:3,
				},
				'768':{
					slidesPerView:2,
				},
				'576': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
			},
		});
	}


	///////////////////////////////////////////////////
	// Property Slider Active
	if ($('.tp-property-details-two').length > 0) {
		var slider = new Swiper('.tp-property-details-two', {
			slidesPerView: 4,
			spaceBetween: 10,
			loop: true,
			breakpoints: {
				'1400':{
					slidesPerView:4,
				},
				'1200':{
					slidesPerView:4,
				},
				'768':{
					slidesPerView:2,
				},
				'576': {
					slidesPerView:1,
				},
				'0': {
					slidesPerView:1,
				},
			},
		});
	}


	// home Five
	if ($('.tp-slider-5-active').length > 0) {
		$('.tp-slider-5-active').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.tp-slider-5-arrow'
			});
			$('.tp-slider-5-arrow').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '.tp-slider-5-active',
			dots: false,
			centerMode: false,
			focusOnSelect: true,
			centerPadding:"5px",
			arrows: false,
			responsive: [
				{
					breakpoint: 500,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					centerPadding: '15px',
					},
				},
			],
		});
	}

	////////////////////////////////////////////////////
	// 11. Nice Select Js
	$('.tp-select .select').niceSelect();


	////////////////////////////////////////////////////
	/* 12. MagnificPopup img view */
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
	});


	//////////////////////////////////////////////////
	// 13. Hover to Active
	$('.tp-feature-item').on('mouseenter', function () {
		$(this).addClass('active').parent().siblings().find('.tp-feature-item').removeClass('active');
	});

	//////////////////////////////////////
	// Hover reveal start
	const hoverItem = document.querySelectorAll(".tp-hover-reveal-item");
	function moveImage(e, hoverItem,index) {
		const item = hoverItem.getBoundingClientRect();
		const x = e.clientX - item.x;
		const y = e.clientY - item.y;
		if (hoverItem.children[index]) {
			hoverItem.children[index].style.transform = `translate(${x}px, ${y}px)`;
		}
	}
	hoverItem.forEach((item, i) => {
		item.addEventListener("mousemove", (e) => {
			setInterval(moveImage(e, item,1), 100);
		});
	});
	// hover reveal end


	//////////////////////////////////////
	// 14. Range slider
	if($('#slider-range').length > 0){
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500,
			values: [75, 300],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
				" - $" + $("#slider-range").slider("values", 1));
	}

	if($('#slider-range-2').length > 0){
		$("#slider-range-2").slider({
			range: true,
			min: 0,
			max: 1000,
			values: [50, 800],
			slide: function (event, ui) {
				$("#amount-2").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount-2").val("$" + $("#slider-range-2").slider("values", 0) +
				" - $" + $("#slider-range-2").slider("values", 1));
	}

	////////////////////////////////////////////////////
	// 15. Password Toggle Js
	if($('.password-show-toggle').length > 0){

		var showBtn = $('.password-show-toggle');

		showBtn.each(function (e) {
			$(this).on('click', function(x){
				let inputField = $(this).parent().find('input');
				if(inputField.attr('type') === "password"){
					inputField.attr('type', 'text')
					$(this).children('.open-eye-icon').css({
						'display' : 'block'
					})
					$(this).children('.close-eye-icon').css({
						'display' : 'none'
					})
				}else{
					inputField.attr('type', 'password')
					$(this).children('.open-eye-icon').css({
						'display' : 'none'
					})
					$(this).children('.close-eye-icon').css({
						'display' : 'block'
					})
				}
			})
		})
	}

	//////////////////////////////////
	// 16. Mouse Custom Cursor
	function tpCursor() {
		var myCursor = jQuery(".mouseCursor");
		if (myCursor.length) {
				if ($("body")) {
					const e = document.querySelector(".cursor-inner"),
							t = document.querySelector(".cursor-outer");
					let n,
							i = 0,
							o = !1;
					(window.onmousemove = function(s) {
							o ||
									(t.style.transform =
											"translate(" + s.clientX + "px, " + s.clientY + "px)"),
									(e.style.transform =
											"translate(" + s.clientX + "px, " + s.clientY + "px)"),
									(n = s.clientY),
									(i = s.clientX);
					}),
					$("body").on("mouseenter", "button, a, .cursor-pointer", function() {
								e.classList.add("cursor-hover"), t.classList.add("cursor-hover");
						}),
						$("body").on("mouseleave", "button, a, .cursor-pointer", function() {
								($(this).is("a", "button") &&
										$(this).closest(".cursor-pointer").length) ||
								(e.classList.remove("cursor-hover"),
										t.classList.remove("cursor-hover"));
						}),
						(e.style.visibility = "visible"),
						(t.style.visibility = "visible");
				}
			}
	}
	tpCursor();

	$(".tp-cursor-point-area").on("mouseenter", function () {
		$(".mouseCursor").addClass("cursor-big");
	});
	$(".tp-cursor-point-area").on("mouseleave", function () {
		$(".mouseCursor").removeClass("cursor-big");
	});


	////////////////////////////////////////////////////
	// 17. Wow Js
	new WOW().init();

	////////////////////////////////////////////////////
	// 18. Counter Js
	new PureCounter();

	///////////////////////////////////////////////////
	// 19. Filter Show
	if($('.filter-btn').length > 0){
		$(document).ready(function(){
			$(".filter-btn").click(function(){
					$(".tp-from-filter").toggleClass("show hidden");
			});
		});
	}


})(jQuery);