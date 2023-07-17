(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Modal Video
    var $videoSrc;

    $('.btn-play').click(function () {
        $videoSrc = $(this).data("src");
    });

    $('#videoModal').on('shown.bs.modal', function (e) {
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })
    $('#videoModal').on('hide.bs.modal', function (e) {
        $("#video").attr('src', $videoSrc);
    })


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Project carousel
    $(".project-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        loop: true,
        center: true,
        dots: false,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ],
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            }
        }
    });


    $('#myForm').submit(function (event) {
        event.preventDefault(); // Prevent form submission

        // Validate form fields
        var membership_no = $('#membership_no').val();
        var password = $('#password').val();
        var valid = true;

        // Perform client-side validation
        if (membership_no === '') {
            $('#membership_noError').html('Please Enter IADVL Number.');
            valid = false;
        } else {
            $('#membership_noError').html('');
        }

        // If client-side validation passes, perform AJAX request
        if (valid) {
            $.ajax({
                url: 'check.php', // PHP script to handle validation and database operations
                method: 'POST',
                data: { membership_no: membership_no },
                success: function (response) {
                    console.log(response);
                    var result = JSON.parse(response);
                    if (result.status === 1) {
                        window.location.href = 'register.php?id=' + result.result.id;

                    } else {
                        $('#membership_noError').html('Invalid IADVL Number.');
                    }
                },
                error: function () {
                    // Handle error
                }
            });
        }
    });


    $(".custom-checkbox").on("click", function() {
        // Toggle the checkbox when the label is clicked
        var checkbox = $(this).find(".hidden-checkbox");
        checkbox.prop("checked", !checkbox.prop("checked"));
    });


})(jQuery);

