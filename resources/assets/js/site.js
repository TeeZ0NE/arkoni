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
        // responsive: [
        //     {
        //         breakpoint: 1200,
        //         settings: {
        //             slidesToShow: 7,
        //             slidesToScroll: 7
        //         }
        //     },
        //     {
        //         breakpoint: 992,
        //         settings: {
        //             slidesToShow: 5,
        //             slidesToScroll: 5
        //         }
        //     },
        //     {
        //         breakpoint: 680,
        //         settings: {
        //             slidesToShow: 4,
        //             slidesToScroll: 4
        //         }
        //     },
        //     {
        //         breakpoint: 540,
        //         settings: {
        //             slidesToShow: 3,
        //             slidesToScroll: 3
        //         }
        //     },
        //     {
        //         breakpoint: 440,
        //         settings: {
        //             slidesToShow: 2,
        //             slidesToScroll: 2
        //         }
        //     },
        //     {
        //         breakpoint: 360,
        //         settings: {
        //             slidesToShow: 1,
        //             slidesToScroll: 1
        //         }
        //     }
        // ]
    });

    //google maps
    //if front page
    if(window.location.pathname.split('/').length === 2 || window.location.pathname.split('/')[2] === 'contacts') {
        initMap();
    }

    function initMap() {
        //create map
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.237887, lng: 28.460762},
            zoom: 17
        });
        //create marker
        var marker = new google.maps.Marker({
            position: {lat: 49.238323, lng: 28.463262},
            map: map
        });
    }

    //stars
    Stars();
    function Stars() {
        var page = window.location.pathname.split('/').filter(function (val, index) {
            return index > 1
        }).join('/');

        var ratingBlock = $('#rating-block', $('footer.footer, #item'));
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

    //
});