<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
/* Style the radio buttons */
input[type="radio"] {
  appearance: none;
  display: inline-block;
    width: 40px;
    line-height: 40px;
    height: 40px;
  border: 1px solid #ccc;
  border-radius: 50%;
  background-color: #fff;
  cursor: pointer;
  position: relative; /* Add relative positioning for the pseudo-element */
  margin-right: 5px;
}
/* Display the number by default */
input[type="radio"]::after {
  content: attr(value); /* Display the value of the radio button */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* Center the number within the circle */
  color: #000; /* Set the number color to black */
  font-size: 12px; /* Adjust the font size as needed */
}
input[type="radio"]:checked {
  background-color: #E4663E;
  border-color: #E4663E;
}
input[type="radio"]:checked::after {
  content: attr(value); /* Display the value of the radio button */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* Center the number within the circle */
  color: #fff; /* Set the number color to white */
  font-size: 12px; /* Adjust the font size as needed */
}
/* Style the labels associated with the radio buttons */
label {
  display: inline-block;
  padding: 5px;
  cursor: pointer;
}
fieldset {
    margin-bottom: 30px;border: 1px solid #EBEBEB;
}
textarea, input {
    width: 96%;
    border: 1px solid #E1E1E1;
    padding: 10px 2%;
}
.container{ width:90%; max-width:800px; margin:0 auto; }
input[type="submit"] {
    background: #E86438;
    text-transform: uppercase;
    padding: 21px 2%;
    border-radius: 3px;
    border: none;
    letter-spacing: 2px;
    display: inline-block;
    font-size: 14px;
    margin-right: 0px;
    color: #fff;
    width: 100%;
}
</style>
</head>
<body>
<div class="container">
<form>
<fieldset>
<legend>Name</legend>
<input type="text" id="name" name="name" >
</fieldset>
<fieldset>
<legend>Contact Number</legend>
<input type="tel" id="phone" name="Contact-Number" >
</fieldset>
<fieldset> <legend>How is your overall experience with Hunter Douglas</legend> <label><input type="radio" name="number" value="1"></label> <label><input type="radio" name="number" value="2"></label> <label><input type="radio" name="number" value="3"></label> <label><input type="radio"
 name="number" value="4"></label> <label><input type="radio" name="number" value="5"></label> <label><input type="radio" name="number" value="6"></label> <label><input type="radio" name="number" value="7"></label> <label><input type="radio" name="number" value="8"></label> <label><input type="radio" name="number" value="9"></label> <label><input type="radio" name="number" value="10"></label> </fieldset>
 <fieldset> <legend>How happy are you with our product</legend> <label><input type="radio" name="number1" value="1"></label> <label><input type="radio" name="number1" value="2"></label> <label><input type="radio" name="number1" value="3"></label> <label><input type="radio"
 name="number1" value="4"></label> <label><input type="radio" name="number1" value="5"></label> <label><input type="radio" name="number1" value="6"></label> <label><input type="radio" name="number1" value="7"></label> <label><input type="radio" name="number1" value="8"></label> <label><input type="radio" name="number1" value="9"></label> <label><input type="radio" name="number1" value="10"></label> </fieldset>
 <fieldset> <legend>How would you like to rate our service?<br>
(0 Very Unlikely to 5 Very Likely).</legend> <label><input type="radio" name="number2" value="1"></label> <label><input type="radio" name="number2" value="2"></label> <label><input type="radio" name="number2" value="3"></label> <label><input type="radio"
 name="number2" value="4"></label> <label><input type="radio" name="number2" value="5"></label> <label><input type="radio" name="number2" value="6"></label> <label><input type="radio" name="number2" value="7"></label> <label><input type="radio" name="number2" value="8"></label> <label><input type="radio" name="number2" value="9"></label> <label><input type="radio" name="number2" value="10"></label> </fieldset>
 <fieldset> <legend>How likely are you to recommend this product to a friend or colleague?<br>
 (0 Very Unlikely to 10 Very Likely).</legend> <label><input type="radio" name="number3" value="1"></label> <label><input type="radio" name="number3" value="2"></label> <label><input type="radio" name="number3" value="3"></label> <label><input type="radio"
 name="number3" value="4"></label> <label><input type="radio" name="number3" value="5"></label> <label><input type="radio" name="number3" value="6"></label> <label><input type="radio" name="number3" value="7"></label> <label><input type="radio" name="number3" value="8"></label> <label><input type="radio" name="number3" value="9"></label> <label><input type="radio" name="number3" value="10"></label> </fieldset>
 <fieldset>
<legend>Please add any other comments/suggestions for us: HunterDouglas</legend>
 <textarea id="message" name="message" rows="4" cols="50" ></textarea>
</fieldset>
 <div class="submit-btn">
<input type="submit" value="Submit">
 </div>
 </form>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
    jQuery(document).ready(function($) {
    function initializeFeedbackValidation() {
        // Restrict numeric and special characters in name field
        $('input[name=name]').on('input', function() {
            var value = $(this).val().replace(/[^a-zA-Z\s]/g, ''); // Removes everything except letters and spaces
            if (value.length > 50) {
                value = value.substring(0, 50);
            }
            $(this).val(value);
        });
        // Restrict phone input to numeric only and limit to 10 digits
        $('input[name="Contact-Number"]').on('input', function() {
            var value = $(this).val().replace(/\D/g, '');
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            $(this).val(value);
        });
        // Validate form on submit button click
        $('form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission
            var form = $(this);
            var isValid = validateFeedbackForm(form);
            if (isValid) {
                // Submit the form if valid
                form.off('submit').submit();
            }
        });
    }
    function validateFeedbackForm(form) {
        form.find('.error').remove();
        var error = false;
        // Name validation
        var nameField = form.find('input[name=name]');
        if (nameField.val().trim().length < 2) {
            nameField.after('<div class="error">Name must be at least 2 characters long.</div>');
            nameField.css('border-color', 'red');
            error = true;
        } else {
            nameField.css('border-color', 'green');
        }
        // Phone number validation
        var phoneField = form.find('input[name="Contact-Number"]');
        var phoneRegex = /^[6789][0-9]{9}$/;
        if (phoneField.val() == '') {
            phoneField.after('<div class="error">Please enter your mobile number.</div>');
            phoneField.css('border-color', 'red');
            error = true;
        } else if (!phoneRegex.test(phoneField.val())) {
            phoneField.after('<div class="error">Enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.</div>');
            phoneField.css('border-color', 'red');
            error = true;
        } else {
            phoneField.css('border-color', 'green');
        }
        // Radio button validation for ratings
        var ratingFields = ['number', 'number1'];
        ratingFields.forEach(function(ratingField) {
            var selectedRating = form.find(`input[name=${ratingField}]:checked`);
            if (selectedRating.length == 0) {
                form.find(`input[name=${ratingField}]`).last().after('<div class="error" style="color:red;">Please select a rating for this field.</div>');
                error = true;
            }
        });
        return !error;
    }
    initializeFeedbackValidation();
});
 </script>
</body>
</html>
