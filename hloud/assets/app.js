const $ = require('jquery');

global.$ = global.jQuery = $;

import './styles/app.scss';

require('bootstrap');

var typingTimer;
var doneTypingInt = 1500;

var bolSignupHasErrors = false;

$("#registration_form_username").on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTypingUsername, doneTypingInt);
})
$("#registration_form_email").on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTypingEmail, doneTypingInt);
})

// do api request to check if username already
// exists and add right classes to input field
function doneTypingUsername()
{
    if ( $("#registration_form_username")[0].value.length != 0 )
    {
        $.ajax({
            type: "GET",
            url: "/api/user/exists?type=username&q=" + $("#registration_form_username")[0].value,
            dataType: "json",
            success: function (r) {
                if ( r == true ) {
                    $("#registration_form_username").removeClass('border-success')
                    $("#registration_form_username").addClass('border-danger')
                    bolSignupHasErrors = true;
                } else {
                    $("#registration_form_username").removeClass('border-danger')
                    $("#registration_form_username").addClass('border-success')
                    bolSignupHasErrors = false;
                }
            }
        })
    }
}

// do api request to check if email already
// exists and add right classes to input fields
function doneTypingEmail()
{
    if ( $("#registration_form_email")[0].value.length != 0 )
    {
        $.ajax({
            type: "GET",
            url: "/api/user/exists?type=email&q=" + $("#registration_form_email")[0].value,
            dataType: "json",
            success: function (r) {
                if ( r == true ) {
                    $("#registration_form_email").removeClass('border-success');
                    $("#registration_form_email").addClass('border-danger');
                    bolSignupHasErrors = true;
                } else {
                    $("#registration_form_email").removeClass('border-danger');
                    $("#registration_form_email").addClass('border-success');
                    bolSignupHasErrors = false;
                }
            }
        })
    }
}

// start the Stimulus application
// import './bootstrap';
