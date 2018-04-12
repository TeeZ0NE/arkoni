var $ = require("jquery");
require('popper.js');
require('bootstrap');
require('slick-carousel');
require('bootstrap-rating');
require('jquery.cookie');


$(function () {

    var baseURL = window.location.protocol + '//' + window.location.host;

    //front page reviews slider
    $('#comments-slider', $('.front')).slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 10000,
        speed: 500,
        arrows: true,
        nextArrow: '<i class="fas fa-angle-right slick-arrow arrow-next"></i>',
        prevArrow: '<i class="fas fa-angle-left slick-arrow arrow-prev"></i>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });


    //front page producers slider
    $('#producers-slider', $('.producers')).slick({
        dots: true,
        // infinite: true,
        speed: 300,
        slidesToShow: 6,
        adaptiveHeight: false,
        slidesToScroll: 6,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
        ]
    });

    //stars
    Stars();
    function Stars() {
        var page = window.location.pathname.split('/').filter(function (val, index) {
            return index > 1
        }).join('/');

        var ratingBlock = $('#rating-block');
        var rating = ratingBlock.find('input.rating');

        if (!rating.length) {
            return false;
        }
        rating.rating();

        if (!page) {
            page = 'front'; //front page
        }

        var data = {};
        data.ratings = rating.data('ratings');
        data.count = rating.data('count');
        data.page = page;

        if ($.cookie('stars-' + page)) {
            rating.attr('data-readonly', true);
        }

        rating.on('change', function () {
            $.cookie('stars-' + page, true); //set read only cookies from page
            data.ratings = +((+data.ratings * +data.count + +$(this).val()) / (+data.count + 1)).toFixed(6); //get form rating
            data.count = +data.count + 1; //get form count
            paintRating(data);
            send(data);

            rating.attr('data-readonly', true);
        });

        function paintRating(data) {
            var rating = ratingBlock.find('div[itemprop="aggregateRating"]');
            rating.children('span[itemprop="ratingValue"]').text(+data['ratings'].toFixed(2));
            rating.children('span[itemprop="ratingCount"]').text(+data['count']);
            rating.find('input.rating').rating('rate', +data['ratings'].toFixed(2));

            rating.find('.msg').show().delay(3200).fadeOut(300);
        }

        function send(ratings) {
            $.ajax({
                url: baseURL + '/stars',
                data: ratings,
                type: "GET",
                dataType: "json",
                async: false,
                error: function (jqXHR) {
                    console.log(jqXHR);
                },
                success: function (d) {
                    data = d;
                }
            });
        }
    }

    $('HTML').addClass('JS');//if js is ready
    //show all text
    $('.JS .read-all').click(function () {
        $(this).children('.content-show').toggleClass('hide');
        $(this).children('.content-hidden').toggleClass('show');
        $(this).prev().slideToggle('slow');
    });

    //phone main menu
    $(window).resize(function () {
        mainMenu();
    });

    mainMenu();
    function mainMenu() {
        if (window.innerWidth <= 768) {
            var mainMenu = $('.main-menu');
            mainMenu.find(".navbar-toggler").click(function (e) {
                e.preventDefault();
                mainMenu.find('.menu-shadow').show();
                mainMenu.find(".collapse").animate({left: '0'}, 350);
            });

            mainMenu.find(".menu-shadow").click(function (e) {
                e.preventDefault();
                mainMenu.find(".collapse").animate({left: '-240px'}, 350);
                mainMenu.find('.menu-shadow').hide();
            });
        } else {
            $('.main-menu .navbar-toggler').click(function () {
                $('.collapse').collapse('toggle');
            });
        }
    }

    //fix main menu
    fixTopMenu();
    function fixTopMenu() {
        var menu = $('.main-menu');
        $(window).scroll(function () {
            if ($(this).scrollTop() > $('.header').innerHeight() - 20) {
                menu.addClass('fixed');
            } else {
                menu.removeClass('fixed');
            }
        });
    }

});