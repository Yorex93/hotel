/**
 * Theme JS
 */

'use strict';


/*** Preloader ***/

var preloader = (function() {

	// Variables
	var $window = $(window);
	var loader = $("#loader-wrapper");

	// Methods
	$window.on({
		'load': function() {

			loader.fadeOut();

		}
	});

	// Events

})();

/*** Button to top page ***/

var toTopButton = (function() {

	// Variables
	var topButton = $('#back-to-top');
	var scrollTop = $(window).scrollTop();
	var isActive = false;
	if (scrollTop > 100) {
		isActive = true;
	}

	// Methods	

	// Events
	$(window).scroll(function() {
		scrollTop = $(window).scrollTop();

		if (scrollTop > 100 && !isActive) {
	        isActive = true;
	        topButton.fadeIn();
	    } else if (scrollTop <= 100 && isActive) {
	        isActive = false;
	        topButton.fadeOut();
	    }

	});

})();

/*** Smooth scroll to anchor ***/

var smoothScroll = (function() {

	// Variables
	var link = $('a[href^="#section__"]');
	var duration = 1000;

	// Methods
	function scrollTo(link) {
		var target = $(link.attr('href'));
		var navbar = $('.navbar');
		var navbarHeight = navbar.outerHeight();

		if ( target.length ) {
			$('html, body').animate({
				scrollTop: target.offset().top - navbarHeight + 20
			}, duration);
		}
	}

	// Events
	link.on('click', function(e) {
		e.preventDefault();
		scrollTo( $(this) );
	});

})();


/*** Count to ***/

var countTo = (function() {

	// Variables
	var statsItem = $('.section-data__nbr');

	// Methods
	function init() {
		statsItem.each(function() {
			var $this = $(this);

			$this.waypoint(function(direction) {
				$this.not('.finished').countTo();
				}, {
				offset: 350
			});
		});
	}
	
	// Events
	if ( statsItem.length ) {
		init();
	}
	
})();


/**
* Alerts
*/

var alert = (function() {
    // Config
    // ======

    var alertLifetime = 6000;

    // Methods
    // =======

    var generate = function(type, message) {
        var newAlert = $(
            '<div class="alert alert-' +
                type +
                ' fade in" id="page-alert">' +
                message +
                "</div>"
        );

        // Append new alert
        $("body").append(newAlert);

        // Remove new alert
        setTimeout(function() {
            newAlert.alert("close");
        }, alertLifetime);
    };

    // Events
    // ======

    $(document).on("sunset.alert.show", function(e, type, message) {
        generate(type, message);
    });
})();


/**
 * Newsletter
 */

var newsletter = (function() {

    // Variables
    var $form = $("#mc-embedded-subscribe-form");

    // Proceed form
    function register() {
        $.ajax({
            type: $form.attr("method"),
            url: $form.attr("action"),
            data: $form.serialize(),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function(err) {
                console.log(err);
                $(document).trigger("sunset.alert.show", [
                    "danger",
                    "Could not connect to the registration server. Please try again later."
                ]);
            },
            success: function(data) {
                // Remove message id
                var successMessage = data.msg.substr(0);

                if (data.result != "success") {
                    $(document).trigger("sunset.alert.show", ["danger", successMessage]);
                } else {
                    // Show a confirmation
                    $(document).trigger("sunset.alert.show", ["success", data.msg]);

                    // Reset a form
                    $form[0].reset();
                }
            }
        });
    }

    // Events
    $form.on("submit", function(e) {
        register();

        e.preventDefault();
    });
})();



$(function() {

	/*** Navbar: Sticky ***/ 

	var sectionInfo = $('.section__info'), 
		navbarDefault = $('.navbar-default'); 

	var stickyNavbar = new Waypoint({ 
		element: sectionInfo, 
		handler: function(direction) { 
			navbarDefault.toggleClass('navbar-sticky'); 
		}, 
		offset: function() {
			return -sectionInfo.height(); 
		} 
	});

	/*** Navbar: Sticky ***/ 

	$('#services__modal').on('shown.bs.modal', function () {

		$('#myInput').focus()

	});

	/*** Home parallax ***/

    var elem = $(".section__home"),
        elemHeight = elem.height(),
        parallaxRate = 2;

    $(window).scroll(function() {

        var scrollTop = $(window).scrollTop(),
            elementOffsetTop = scrollTop,
            parallaxOffset = elementOffsetTop / parallaxRate;
        
        if (elementOffsetTop <= elemHeight) {
            $(".home-parallax__bg").css({
                "-webkit-transform": "translateY(" + parallaxOffset + "px)",
                        "transform": "translateY(" + parallaxOffset + "px)"
            });
        }

    });

	/*** Dropdowns for Availability section ***/

	$('.reservation-dropdown').on('click', '.dropdown-menu > li > a', function () {

		var $this = $(this);

		var value = $this.text();

		var dropdownToggle = $this.parents('.dropdown').find('.dropdown-toggle');

		var reservationInput = $this.parents('.form-group').find('input');

		dropdownToggle.find('span').text(value);

		reservationInput.attr('value', parseInt(value), 10);

		dropdownToggle.dropdown('toggle');

		return false;
	});

	/*** Best-rooms hover effect for iOS ***/

    var mobileHover = function () { 

        $('.best-rooms__item').on({

            'touchstart': function () {

                $(this).trigger('hover');
            },

            'touchend': function () {

                $(this).trigger('hover');
            }

        });

    };

    mobileHover();

	/*** Own Carousel (For Gallery Section) ***/
	
	var $carouselGallery = $("#gallery__carousel");

	if ($carouselGallery.length) {
		$carouselGallery.owlCarousel({
 			margin:10,
    		nav:true,
 			slideSpeed:150,
      		animateOut:'fadeOut',
      		responsiveClass:true,
      		responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:4
		        }
		    }
 		});
	};

	/*** Calendar (for Availability Section) ***/

	var $Calendar = $('.form-control.date');

	if ($Calendar.length) {

		$Calendar.datetimepicker({
			icons: {
	            time: 'ion-android-time',
	            date: 'ion-android-calendar',
	            up: ' ion-chevron-up',
	            down: 'ion-chevron-down',
	            previous: 'ion-chevron-left',
	            next: 'ion-chevron-right',
	            today: 'ion-android-locate',
	            clear: 'ion-trash-b',
	            close: 'ion-close-round'
	        },
	        format: 'DD MMMM YYYY'
		});
	};

	/*** Own Carousel (For Testimonials Section) ***/

	var $carouselTestimonials = $("#testimonials__carousel");

	if ($carouselTestimonials.length) {

		$carouselTestimonials.owlCarousel({
 			margin:10,
 			slideSpeed:150,
      		responsiveClass:true,
      		responsive:{
		        0:{
		            items:1
		        },
		        1000:{
		            items:2
		        }
		    }
 		});
	};

	/*** Own Carousel (For Room-detail Section) ***/

	var $carouselRoomDetail = $("#room-detail__carousel");

	if ($carouselRoomDetail.length) {

		$carouselRoomDetail.owlCarousel({
			items:1,
 			margin:10,
 			nav:false,
 			animateOut:'fadeOut',
 			slideSpeed:150
 		});
	};
	
	/*** Smooth scroll to anchor ***/

	$('a[href*="#"]').not('[href="#"], [data-slide], [data-toggle]').on('click', function() {

		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
			
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - 65
				}, 1000);
				return false;
			}

		}
	});

	/*** Gallery (filtering) ***/

	var $gallery = $("#gallery__items");

	if ($gallery.length) {

		// Init Isotope
		$gallery.isotope({
			itemSelector: ".gallery__item",
			layoutMode: "masonry"
		});

		// layout Isotope after each image loads
		$gallery.imagesLoaded().progress( function() {
		  $gallery.isotope('layout');
		});

		// Set ititial filtering
		$gallery.isotope({ filter: ".all" });

		// Filrter items on click
		$(".gallery-nav__link > a").on('click', function(e) {

			// Filter items 
			var filterValue = $(this).attr('data-filter');
			
			$gallery.isotope({ filter: filterValue });

			// Change active button
			$(this).parents("li").addClass("active").siblings("li").removeClass("active");

			e.preventDefault();
		});
	};

});

