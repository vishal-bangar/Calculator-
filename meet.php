 <?php
// Base url
    $base_url = 'https://in.hunterdouglas.asia/';
?>
<div class="form-enquiry">
<form class="enquiry-form" id="enquiry-form-1" action="">
<div class="row">
<!--<div class="col-sm-4">-->
<!--<div class="form-floating category-select-drop-d">-->
<!--    <label for="category">Category</label><br>-->
<!--    <select id="category" name="category" id="categoryDropdown">-->
<!--        <option value="">Select Category</option>-->
<!--        <option value="Aircraft Sales">Aircraft Sales</option>-->
<!--        <option value="Charter Aircraft">Charter Aircraft</option>-->
<!--        <option value="VIP Ground Transportation">VIP Ground Transportation</option>-->
<!--        <option value="VIP Booking">VIP Booking</option>-->
<!--    </select>-->
<!--</div>-->
<!--</div>-->

<div class="col-sm-12">
<div class="form-floating">
    <label for="name">First Name <span>*</span></label><br>
    <input type="text" id="name" name="name" placeholder="Your First Name">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-floating">
    <label for="lname">Last Name</label><br>
    <input type="text" id="lname" name="lname" placeholder="Your Last Name">
</div>
</div>
</div>

<!--<div class="col-sm-4">-->
<!--<div class="form-floating">-->
<!--    <label for="company">Company Name (If applicable)</label><br>-->
<!--    <input type="text" id="company" name="company">-->
<!--</div>-->
<!--</div>-->

<div class="row">
<div class="col-sm-12">
<div class="form-floating">  
    <label for="phone">Mobile Number<span>*</span></label><br>
    <!--<input type="tel" id="phone" name="phone" >-->
    <input type="tel" id="phone" name="phone" placeholder="Your Mobile Number">
    
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="form-floating">
    <label for="email">Email Address</label><br>
    <input type="email" id="email" name="email" placeholder="Your Email Address">
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="form-floating">
    <label for="city">City</label><br>
    <input type="text" id="city" name="city" placeholder="Your city">
</div>
</div>
</div>


<!--<div class="col-sm-4">-->
<!--<div class="form-floating">-->
<!--    <label for="condition">Condition*</label><br>-->
<!--    <select id="condition" name="condition" id="durationDropdown">-->
<!--        <option value="">Select</option>-->
<!--        <option value="Arrhythmia">Arrhythmia</option>-->
<!--        <option value="Atherosclerosis">Atherosclerosis</option>-->
<!--        <option value="Cardiomyopathy">Cardiomyopathy</option>-->
<!--        <option value="Congenital heart defects">Congenital heart defects</option>-->
<!--        <option value="Heart infections">Heart infections</option>-->
<!--    </select>-->
<!--</div>-->
<!--</div>-->

<!--<div class="col-sm-6">-->
<!--    <div class="form-floating">-->
<!--        <label for="message">Message</label><br>-->
<!--        <textarea id="message" name="message" rows="4" cols="50" style="resize: none;" placeholder="Additional notes"></textarea>-->
<!--    </div>-->
<!--</div>-->

<div class="row captcha-t6">
<div class="col-sm-6 ">
<div id="challenge-container"></div>
<input type="hidden" class="form-control" name="challenge" id="challenge" value="" />
</div>
<div class="col-sm-6 captcha-field">
                <label for="user_input">Captcha Code  <span>*</span></label><br>
                <input type="text" id="user-input" name="user_input" placeholder="Enter Captcha Code" autocomplete="off"/>
                
                <div id="captcha-error"></div>
                
            </div>
		 </div>	
			
			
            <div style="clear:both;"></div>
			<div class="row">
            <div class="col-sm-12">
                <div class="ld-sub">
                    <button type="button" class="submit-btn btnmsubmitm">Submit</button>
                    <div class="load" id="loading" style="display: none;">
                          <!--<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw loding-icon-153"></i>  ${submenu}-->
                          
                          <img src="<?php echo $base_url; ?>wp-content/uploads/2024/07/loader.png" class="spin" >
                    </div>
                </div>
            </div> </div>
			</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
    function initializeValidation() {
    // Restrict numeric and special characters in specified fields
    $('.enquiry-form input[name=name], .enquiry-form input[name=lname]').on('input', function() {
        var value = $(this).val().replace(/[^a-zA-Z]/g, ''); // Removes everything except letters
        if (value.length > 50) {
            value = value.substring(0, 50);
        }
        $(this).val(value);
    });

    // Allow letters and spaces in the city field
    $('.enquiry-form input[name=city]').on('input', function() {
        var value = $(this).val().replace(/[^a-zA-Z\s]/g, '');
        if (value.length > 50) {
            value = value.substring(0, 50);
        }
        $(this).val(value);
    });

        // Restrict phone input to numeric only and limit to 10 digits
        $('.enquiry-form input[name=phone]').on('input', function() {
            var value = $(this).val().replace(/\D/g, '');
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            $(this).val(value);
        });

        // Restrict email input to a maximum length of 100 characters
        $('.enquiry-form input[name=email]').on('input', function() {
            var value = $(this).val();
            if (value.length > 100) {
                $(this).val(value.slice(0, 100));
            }
        });

        // Validate minimum lengths on blur and show error messages
        $('.enquiry-form input').on('blur', function() {
            validateField($(this));
        });

        // Remove error styles and messages on input change
        $('.enquiry-form input').on('input change', function() {
            $(this).removeClass('alert-danger').css('border-color', '');
            $(this).parent().find('.error').remove();
            validateField($(this));
        });

        // Validate form on submit button click
        $('.enquiry-form .submit-btn').click(function(e) {
            e.preventDefault(); // Prevent form submission
            var form = $(this).closest('.enquiry-form');
            var isValid = validateForm(form);
            if (isValid) {
                commoninitpm(form.attr('id'), 'initbooking', 'init', form.attr('id'));
            } else {
                generateChallenge(); // Regenerate captcha if validation fails
            }
        });
    }

    function validateField(field) {
        var minLength = {
            'name': 2,
            'lname': 2,
            'city': 3,
            'email': 5
        }[field.attr('name')];
        var value = field.val();
        var errorMsg = `Minimum length for this field is ${minLength} characters.`;

        if (value.length > 0 && value.length < minLength) {
            if (field.next('.error').length === 0) {
                field.after('<div class="error" style="color:red;">' + errorMsg + '</div>');
            }
            field.css('border-color', 'red');
        } else {
            field.next('.error').remove();
            field.css('border-color', 'green');
        }
    }

    function generateChallenge() {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz!@#$%&*()';
        var challengeLength = 8;
        var challenge = '';
        for (var i = 0; i < challengeLength; i++) {
            challenge += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        $('#challenge-container').text(challenge);
        $('#challenge').val(challenge);
    }

    $(document).on('click', '#challenge-container', function() {
        generateChallenge();
    }).on('copy', '#challenge-container', function(e) {
        e.preventDefault();
    });
    
    // Helper function to check for repeated digits
    function hasRepeatedDigits(phoneNumber) {
        return /(\d)\1{6}/.test(phoneNumber);
    }

    function validateForm(form) {
        form.find('.error').remove();
        var error = false;
        var nameRegex = /^[a-zA-Z]+$/; // Name should not accept spaces
        var phoneRegex = /^[6789][0-9]{9}$/; 
        var emailRegex = /^[a-z0-9](?:[a-z0-9]*[._%+-]?)*[a-z0-9]@[a-z0-9.-]+\.[a-z]{2,4}$/i;
        var cityRegex = /^(?!.*\s{3})[a-zA-Z\s]+$/; // Allow one space only

        var minLength = {
            'name': 2,
            'lname': 2,
            'city': 3,
            'email': 5
        };

        var nameField = form.find('input[name=name]');
        var lnameField = form.find('input[name=lname]');
        var phoneField = form.find('input[name=phone]');
        var emailField = form.find('input[name=email]');
        var cityField = form.find('input[name=city]');

        // General minimum length check
        form.find('input').each(function() {
            var field = $(this);
            validateField(field);
            if (field.css('border-color') === 'red') {
                error = true;
            }
        });

        // Specific field validations
        if (!nameRegex.test(nameField.val())) {
            nameField.after('<div class="error">Please enter a valid first name.</div>');
            nameField.css('border-color', 'red');
            error = true;
        }
        
        if (lnameField.val() !== '' && !nameRegex.test(lnameField.val())) {
            lnameField.after('<div class="error">Please enter a valid last name.</div>');
            lnameField.css('border-color', 'red');
            error = true;
        }

        if (phoneField.val() == '') {
            phoneField.after('<div class="error">Please enter your mobile number.</div>');
            phoneField.css('border-color', 'red');
            error = true;
        } else if (phoneField.val().length < 10) {
            phoneField.after('<div class="error">Enter a valid 10-digit number.</div>');
            phoneField.css('border-color', 'red');
            error = true;
        } else if (!phoneRegex.test(phoneField.val())) {
            if (!/^[6-9]/.test(phoneField.val())) {
                phoneField.after('<div class="error">The format will accept 6789 only.</div>');
            } else {
                phoneField.after('<div class="error">Enter a valid 10-digit number.</div>');
            }
            phoneField.css('border-color', 'red');
            error = true;
        } else if (hasRepeatedDigits(phoneField.val())) {
            phoneField.after('<div class="error">Number cannot contain digit repeated more than 6 times consecutively.</div>');
            phoneField.css('border-color', 'red');
            error = true;
        }

        if (emailField.val().trim() === '') {
            emailField.after('<div class="error">Please enter the email.</div>');
            emailField.css('border-color', 'red');
            error = true;
        } else if (!emailRegex.test(emailField.val())) {
            emailField.after('<div class="error">Please enter a valid email address.</div>');
            emailField.css('border-color', 'red');
            error = true;
        }

        if (cityField.val() !== '' && !cityRegex.test(cityField.val())) {
            cityField.after('<div class="error">Please enter a valid city (letters and one space only).</div>');
            cityField.css('border-color', 'red');
            error = true;
        }

        var userEnteredValue = form.find('#user-input').val();
        var actualChallengeValue = form.find('#challenge').val();
        if (actualChallengeValue.trim() == '') {
            form.find('#captcha-error').html('<div class="error">CAPTCHA cannot be empty.</div>');
            form.find('#user-input').css('border-color', 'red');
            error = true;
        } else if (userEnteredValue !== actualChallengeValue) {
            form.find('#captcha-error').html('<div class="error">Please enter the correct CAPTCHA.</div>');
            form.find('#user-input').css('border-color', 'red');
            error = true;
        } else {
            form.find('#captcha-error').empty();
            form.find('#user-input').css('border-color', 'green');
        }

        if (error) {
            form.find('.error').css('color', 'red');
            return false;
        } else {
            form.find('input').each(function() {
                var field = $(this);
                if (field.next('.error').length === 0 && field.val().length > 0) {
                    field.css('border-color', 'green');
                }
            });
            return true;
        }
    }

   var clicked = false;

    function commoninitpm(formId, act, tp, modalm = false) {
        if (!clicked) {
            clicked = true;
            var formdata = $('#' + formId).serialize();
            formdata += '&formId=' + formId;
            // Show loader
            $('#loading').show();
            $.ajax({
                url: '<?php echo $base_url; ?>contact-mailer/contacttrigger.php',
                data: formdata,
                method: 'POST',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: "json",
                cache: false,
                beforeSend: function () {
                    $('#' + formId).addClass('disabled');
                },
                success: function (response, textStatus, jqXHR) {
                    if (response.logged === true) {
                        window.location.href = '<?php echo $base_url; ?>thank-you-meet-an-expert';
                    } else {
                        $('.wpcf7-response-output').html(response.mg);
                    }
                },
                complete: function (response) {
                    $('#' + formId).removeClass('disabled');
                    clicked = false;
                    // Hide loader
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            });
        }
    }
    
    $('body').on('click', '.btnmsubmitm', function (e) {
        var formId = $(this).closest('form').attr('id');
        if (validateForm($(this).closest('form'), e)) {
            commoninitpm(formId, 'initbooking', 'init', formId);
        }
    });

    // Initialize validation
    initializeValidation();
    // Generate initial CAPTCHA
    generateChallenge();
    
    $(window).on('pageshow', function(event) {
    if (event.originalEvent.persisted) {
        location.reload(); // Reload the page to reset form and validation
    }
    });
});
</script>