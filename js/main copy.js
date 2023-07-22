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
                    var result = JSON.parse(response);
                    if (result.status === 1) {
                        console.log(result)
                        $('#otpfrm').css('display', 'block');
                        $('#regform').css('display', 'none');
                        document.getElementById("otp-input-start").focus();
                        // window.location.href = 'register.php?id=' + result.encryptedID;

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


    $("#otp-input-end").on("keyup", function () {

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


})(jQuery);



const result = document.querySelector('.result');

// Built n inputs dynamically
const times = () => {
    let inputTemplates = [];
    for (let i = 0; i < 6; i++) {
        inputTemplates[i] = '<input type="text" onchange="isComplete()" maxlength="1" oninput="goToNextInput()" disabled>';
    }

    let inputCollection = inputTemplates.join('');
    return inputCollection;
}

// Mount html template
const container = document.querySelector('.container1');
container.innerHTML = times();

// Collect the inputs
const inputsList = document.querySelectorAll('input');

// onchange setDisabledAttribute

const isComplete = () => {
    for (const [i, inputElement] of inputsList.entries()) {
        if (inputElement.value.length === 1) {
            // setDisabledAttribute(inputsList[i]);
            inputsList[i].classList.add('paintOrangeLine');
        } else {
            inputsList[i].classList.remove('paintOrangeLine');
        }
    }
}

const goToNextInput = () => {
    for (const [i, inputElement] of inputsList.entries()) {
        if (inputElement.value.length === 1 && i !== 5) {
            removeDisabledAttribute(inputsList[i + 1]);
            inputsList[i + 1].focus();
        }
        if (inputElement.value.length === 1 && i === 5) {
            inputElement.parentElement.nextElementSibling.focus();
            areAllFilled(inputsList) ? setDisabledAttributeForAll(inputsList) : '';
        }
    }
}

// Get all values from inputs
const sendValues = () => {
    let inputValues = [];
    for (let inputValue of inputsList) {
        if (inputValue.value.length === 1) {

            inputValues.push(inputValue.value);
        }
    }

    result.innerHTML = inputValues.join('');
}

// Show result in screen after button clicked
const btn = document.querySelector('button');
btn.addEventListener('click', sendValues, true);


// Remove disabled attribute from input
const removeDisabledAttribute = (elem) => {
    elem.removeAttribute("disabled");;
}

// Set disabled attribute from input
const setDisabledAttribute = (elem) => {
    elem.setAttribute("disabled", '');
}

const setDisabledAttributeForAll = (arr) => {
    for (let input of arr) {
        input.setAttribute('disabled', '');
    }
}

// Remove disabled from the first input
// to be called in connectedCallback()
removeDisabledAttribute(inputsList[0]);

const fill = (currentValue) => {
    return currentValue.value.length === 1;
}

// Check if all fields are filled
const areAllFilled = (arr) => {
    let newArray = Array.from(arr);
    return newArray.every((input) => input.value.length === 1);
}



$("#otpbutton").on("click", function () {
    var mebno = $('#membership_no').val();
    var mbeship = $('#mbmship_no').val(mebno);
    
    if (mbeship != '') {
        $.ajax({
            type: "POST",
            url: check.php,
            data: { 'membership_no': mebno },
            success: function (response) {
                //if request if made successfully then the response represent the data
                console.log(response);
                $("#result").empty().append(response);
            }
        });
    }
});

// Function to move focus to the previous OTP input field on backspace
function moveToPrevious(event, currentInput) {
    if (event.key === "Backspace" && currentInput.value === "") {
        var previousInput = currentInput.previousElementSibling;
        if (previousInput !== null) {
            previousInput.focus();
        }
    }
}

// Function to move focus to the next OTP input field
function moveToNext(currentInput) {
    var nextInput = currentInput.nextElementSibling;
    if (nextInput !== null) {
        nextInput.focus();
    }
}
// Function to get the complete OTP as a single value
function getOTP() {
    var otpValue = "";
    var otpInputs = document.getElementsByClassName("otp-input");
    for (var i = 0; i < otpInputs.length; i++) {
        otpValue += otpInputs[i].value;
    }
    console.log("Complete OTP: " + otpValue);
    // You can now use otpValue for further processing (e.g., validation).
}

 // Function to enable the submit button when all OTP fields are filled
 function enableSubmitButton() {
    var allFilled = true;
    var otpInputs = document.getElementsByClassName("otp-input");
    for (var i = 0; i < otpInputs.length; i++) {
        if (otpInputs[i].value === "") {
            allFilled = false;
            break;
        }
    }
    var submitButton = document.getElementById("submitBtn");
    submitButton.disabled = !allFilled;
}