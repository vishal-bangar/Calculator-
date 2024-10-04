
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="feedback-form" >
        <h1>Rate Our Service</h1>
        <form action="#" method="post" name="myForm" onsubmit="return validateForm()" >
            <div>
                <label for="name">Customer Name</label>
                <input type="text" id="name" name="name"  placeholder="Customer name" >
            </div>
            <br>
            <div>
                <label for="phone">Contact number:</label>
                <input type="text" id="phone" name="phone"  maxlength="10" placeholder="Customer Number" >
                
            </div>
            
            <label for="rating"> 1. How is your overall experience with Hunter Douglas</label>
            <div class="rating-group" id="rating-group1">
                
                    <div class="rating">

                      <input type="radio" id="rating-1" name="rating" value="1">
                      <label for="rating-1">1</label>
                    </div>

                    <div class="rating">
                      <input type="radio" id="rating-2" name="rating" value="2">
                      <label for="rating-2">2</label>
                    </div>
                    <div class="rating">
                      <input type="radio" id="rating-3" name="rating" value="3">
                      <label for="rating-3">3</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-4" name="rating" value="4">
                     <label for="rating-4">4</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-5" name="rating" value="5">
                      <label for="rating-5">5</label>
                    </div>
                    <div class="rating">
                        <input type="radio" id="rating-6" name="rating" value="6">
                        <label for="rating-6">6</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-7" name="rating" value="7">
                     <label for="rating-7">7</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-8" name="rating" value="8">
                     <label for="rating-8">8</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-9" name="rating" value="9">
                     <label for="rating-9">9</label>
                    </div>
                    <div class="rating">
                     <input type="radio" id="rating-10" name="rating" value="10">
                     <label for="rating-10">10</label>
                    </div>
               
            </div>
            
                <label for="rating"> 2. How happy are you with our product</label>
            <div class="rating-group" id="rating-group2">
                <div class="rating">
                    <input type="radio" id="rating-11" name="rating" value="1">
                    <label for="rating-11">1</label>
                </div>
                
                <span></span>
                
                <div class="rating">
                    <input type="radio" id="rating-12" name="rating1" value="2">
                    <label for="rating-12">2</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-13" name="rating1" value="3">
                    <label for="rating-13">3</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-14" name="rating1" value="4">
                    <label for="rating-14">4</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-15" name="rating1" value="5">
                    <label for="rating-15">5</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-16" name="rating1" value="6">
                    <label for="rating-16">6</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-17" name="rating1" value="7">
                    <label for="rating-17">7</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-18" name="rating1" value="8">
                    <label for="rating-18">8</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-19" name="rating1" value="9">
                    <label for="rating-19">9</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-20" name="rating1" value="10">
                    <label for="rating-20">10</label>
                </div>
                
            </div>
            
                <label for="rating"> 3. How would you like to rate our service?   
                    (0 Very Unlikely to 5 Very Likely). </label>
            <div class="rating-group" id="rating-group3">
                <div class="rating">
                    <input type="radio" id="rating-21" name="rating2" value="1">
                    <label for="rating-21">1</label>
                </div>
                
                <span></span>
                
                <div class="rating">
                    <input type="radio" id="rating-22" name="rating2" value="2">
                    <label for="rating-22">2</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-23" name="rating2" value="3">
                    <label for="rating-23">3</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-24" name="rating2" value="4">
                    <label for="rating-24">4</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-25" name="rating2" value="5">
                    <label for="rating-25">5</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-26" name="rating2" value="6">
                    <label for="rating-26">6</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-27" name="rating2" value="7">
                    <label for="rating-27">7</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-28" name="rating2" value="8">
                    <label for="rating-28">8</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-29" name="rating2" value="9">
                    <label for="rating-29">9</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-30" name="rating2" value="10">
                    <label for="rating-30">10</label>
                </div>
            
            </div>
            
                <label for="rating"> 4. How would you like to rate our service?   
                    (0 Very Unlikely to 5 Very Likely). </label>
            <div class="rating-group">
              
                <div class="rating">
                    <input type="radio" id="rating-31" name="rating3" value="1">
                    <label for="rating-31">1</label>
                </div>
                
                <span></span>
            
                <div class="rating">
                    <input type="radio" id="rating-32" name="rating3" value="2">
                    <label for="rating-32">2</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-33" name="rating3" value="3">
                    <label for="rating-33">3</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-34" name="rating3" value="4">
                    <label for="rating-34">4</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-35" name="rating3" value="5">
                    <label for="rating-35">5</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-36" name="rating3" value="6">
                    <label for="rating-36">6</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-37" name="rating3" value="7">
                    <label for="rating-37">7</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-38" name="rating3" value="8">
                    <label for="rating-38">8</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-39" name="rating3" value="9">
                    <label for="rating-39">9</label>
                </div>
                <div class="rating">
                    <input type="radio" id="rating-40" name="rating3" value="10">
                    <label for="rating-40">10</label>
                </div>
             
            </div>
            <div>
                <p>
                    <label for="rating"> 5. Please add any other comments / suggestions for us:</label>
                </p>
                <textarea rows="4" cols="50"></textarea>
            </div>
                <br>
            <button type="submit"  value="submit" >Submit Feedback</button>
        </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   
<script>
 
 // Validate name


function validateForm() {
    
    let x = document.forms["myForm"]["name"].value;
    if (x == "") {
      alert("Name must be filled out");
      return false;
    }

    let y = document.forms["myForm"]["phone"].value;
  if (y == "") {
    alert("Number must be filled out");
    return false;
  }
}
// remove space and number
 $('.feedback-form input[name=name]').on('input', function() {
         var value = $(this).val().replace(/[^a-zA-Z]/g, ''); // Removes everything except letters
         if (value.length > 50) {
             value = value.substring(0, 50);
         }
         $(this).val(value);
     });

$('.feedback-form input[name=phone]').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 10) {
        value = value.slice(0, 10);
        }
        $(this).val(value);
     });

        

    </script> 
</body>
</html>
