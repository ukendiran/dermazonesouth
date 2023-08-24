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

    $('#btn-submit').click(function (e) {
        loginCheck();
    });
    $('#login-form').submit(function (e) {
        loginCheck();
    });

    function loginCheck() {
        // Validate form fields
        var membership_no = $('#membership_no').val();
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
                    var result = JSON.parse(response);
                    console.log(result);
                    // window.location.href = 'abstract_submition.php?id=' + result.encryptedID;
                    if (result.status === 1) {
                        var mobileNumber = "91" + result.result.mobile;
                        var configuration = {
                            widgetId: "336776706f44343133353038",
                            tokenAuth: "401998T8dXEwkg64bbb368P1",
                            identifier: mobileNumber,
                            success: (data) => {
                                if (data.type = "success") {
                                    window.location.href = 'abstract_submition.php?id=' + result.encryptedID;
                                }
                            },
                            failure: (error) => {
                                // handle error
                                console.log('failure reason', error);
                            },
                        };
                        // window.location.href = 'abstract_submition.php?id=' + result.encryptedID;
                        initSendOTP(configuration);
                    } else if (result.status === 2) {
                        $('#membership_noError').html('Please Pay for subscription.');
                    } else {
                        $('#membership_noError').html('There is no registration on this membership number. Make sure the membership number you entered is correct.');
                    }
                },
                error: function () {
                    // Handle error
                }
            });
        }
    }


    $('#login-registation-form').submit(function (event) {
        event.preventDefault(); // Prevent form submission

        // Validate form fields
        var membership_no = $('#membership_no').val();
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
                    var result = JSON.parse(response);
                    if (result.status === 1) {
                        $('#membership_noError').html('Please login and submit the Abstract.');
                    } else if (result.status === 2) {
                        window.location.href = 'registration.php?id=' + result.encryptedID;
                    } else {
                        $('#membership_noError').html('There is no registration on this membership number. Make sure the membership number you entered is correct.');
                    }
                },
                error: function () {
                    // Handle error
                }
            });
        }
    });


    $("#workshopCheck").on("change", function () {
        // Toggle the checkbox when the label is clicked
        var checkbox = $(this);
        var isChecked = checkbox.prop("checked");
        checkbox.prop("checked", checkbox.prop("checked"));
        if (isChecked)
            $('#has_workshop').val('1');
        else
            $('#has_workshop').val('0');
    });


    $('#upload-form').submit(function (event) {
        event.preventDefault(); // Prevent form submission

        // If client-side validation passes, perform AJAX request
        if (valid) {
            $.ajax({
                url: 'check.php', // PHP script to handle validation and database operations
                method: 'POST',
                data: { membership_no: membership_no },
                success: function (response) {
                    var result = JSON.parse(response);
                    // console.log(result);
                    window.location.href = 'abstract_submition.php?id=' + result.encryptedID;
                    // if (result.status === 1) {
                    //     var mobileNumber = result.result.mobile;
                    //     var configuration = {
                    //         widgetId: "336776706f44343133353038",
                    //         tokenAuth: "401998T8dXEwkg64bbb368P1",
                    //         // identifier: mobileNumber,
                    //         identifier: "",
                    //         success: (data) => {                              
                    //             if (data.type = "success") {
                    //                 window.location.href = 'abstract_submition.php?id=' + result.encryptedID;
                    //             }
                    //         },
                    //         failure: (error) => {
                    //             // handle error
                    //             console.log('failure reason', error);
                    //         },
                    //     };
                    //     initSendOTP(configuration);
                    // } else if (result.status === 2) {
                    //     $('#membership_noError').html('Please Pay for subscription.');
                    // } else {
                    //     $('#membership_noError').html('There is no registration on this membership number. Make sure the membership number you entered is correct.');
                    // }
                },
                error: function () {
                    // Handle error
                }
            });
        }
    });



    $("#uploadForm").on('submit', function (e) {
        e.preventDefault();
        var id = $('#id').val();
        var fileInput = $('#fileInput').val();
        if (fileInput !== "") {
            e.preventDefault();
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: 'upload.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $(".progress-bar").width('0%');
                    // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                },
                error: function () {
                    $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                },
                success: function (resp) {
                    var result = JSON.parse(resp);
                    setTimeout(function () {
                        $('#fileInput').attr('disbaled', 'true');
                        if (result.msg == 'ok') {
                            $('#uploadForm')[0].reset();
                            $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                        } else if (result.msg == 'err') {
                            $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                        }
                        window.location.href = 'abstract_submition.php?id=' + id;
                    }, 3000);

                }
            });
        } else {
            alert("Please select a valid file (PDF/DOC/DOCX).")
        }
        console.log(fileInput);

    });

    // File type validation
    $("#fileInput").change(function () {
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        var file = this.files[0];
        var fileType = file.type;
        if (!allowedTypes.includes(fileType)) {
            alert('Please select a valid file (PDF/DOC/DOCX/XLX/XLXS).');
            $("#fileInput").val('');
            return false;
        }
    });




    $(".btn-pay").click(function (e) {
        e.preventDefault();
        var jsonData;
        var access_code = "AVZT92KG93CE22TZEC"; //But access code here
        var amount = "10.00";
        var currency = "INR";
        var url = 'https://test.ccavenue.com/transaction/transaction.do?command-getJsonData&access_code=' + access_code + '&currency=' + currency + '&amount=' + amount;
        console.log(url);
        $.ajax({
            url: url,
            dataType: 'jsonp',
            jsonp: true,
            jsonpCallback: 'processData',
            processData: true,
            success: function (data) {
                jsonData = data;
                console.log(jsonData);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log('An error occurred!' + errorThrown);
            }
        });
    });


    $(".payOption").click(function () {
        $("#card_name").children().remove(); // remove old card names from old one
        $("#card_name").append("<option value=''>Select</option>");
        var paymentOption = $(this).val();
        $("#card_type").val(paymentOption.replace("OPT", ""));

        $.each(jsonData, function (index, value) {
            if (value.payOpt == paymentOption) {
                var payoptJSONArray = $.parseJSON(value[paymentOption]);
                $.each(payOptJSONArray, function () {
                    $("#card_name").find("option: Last").after("<option class=" + this['dataAcceptedAt'] + " " + this['status'] + " value=" + this['cardName'] + "'>" + this['cardName'] + "</option>");
                });

            }
        });
    });

    $("#card_name").click(function () {
        if ($(this).find(":selected").hasClass("DOWN")) {
            alert("Selected option is currently unavailable. Select another payment option or try again later.");
        }
        if ($(this).find("selected").hasClass("CCAvenue")) {
            $("#data_accept").val("Y");
        } else {
            $("#data_accept").val("N");
        }
    });


})(jQuery);

// window.onload = function () {
//     var d = new Date().getTime();
//     document.getElementById("tid").value = d;
// };