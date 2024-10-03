<!-- Include Code Mirror CSS. -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

   <div class="callout callout-info">

      <p><?php echo $page_about; ?></p>

   </div>

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        <?php echo $heading; ?>

      </h1>

	  <div class="row">

			<div class="col-xs-12">

				<button class="btn btn-info pull-right"  onclick="goBack()" value="back" name="back">Back</button>

			</div>

		</div>

    </section>

	<!-- Loader -->

	<div id="divLoading" style="display:none; margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: #f6f6f6; z-index: 30001; opacity: 0.8;">

	<p style="position: absolute; color: White; top: 40%; left: 40%;">

	<img src="assets/images/loading.gif">

	</p>

	</div>

	  <!-- Main content -->

    <section class="content">

	  <div class="box box-default">

	     <div class="box-header with-border">

			 <h3 class="box-title">Please fill all the details below (Fields marked with <span class="star" >*</span> are mandatory)</h3>

		  <?php if(isset($error_msg) && $error_msg !='') { ?>

			<p class="login-box-msg text-red"><?php echo $error_msg ?></p>

		  <?php } ?>

          <?php if(isset($success_msg) && $success_msg !='' ) { ?>

            <p class="login-box-msg text-orange"><?php echo $success_msg ?></p>

          <?php } ?>          

        </div>

	<form class="col s12" method="POST" action = '' id="product_category">
<div class="row">
		<div class="col-md-6 cal6">			

			<label class="add dept">Category Name <span class="requiredimp">*</span></label>

			<input type="text" id="cat_name" name="cat_name" value="<?php echo isset($product_category_details[0]->category_name) ? $product_category_details[0]->category_name : ''; ?>" class="form-control capitalize-me" placeholder="Please enter category name" autofocus>

			<div class="error-class" id="cat_name_validate"></div>

		</div>	
        <div style="clear:both;"></div>			

		<div class="col-md-6 cal6">

			<label class="add dept">Category Status <span class="requiredimp">*</span> <span class="status_note">(Orange button indicates status enabled, Grey button indicates status disabled.)</span></label>		

			<div style="clear:both;"></div>

			  <label class="switch">

			  <input type="checkbox" value="1" id="cat_status" name="cat_status" style="opacity:0" <?php if(isset($product_category_details[0]->category_status) && $product_category_details[0]->category_status == '1'){ ?> checked <?php } ?>>

				<div class="slider round"></div>

			</label>

		</div>	
        <div style="clear:both;"></div>
<div class="col-md-12 cal12">		
		<input class="btn" type="submit" value="save" name="category_form"  id="category_form" style="margin:0;" />
</div>
<div style="clear:both;"></div>
</div>
		</form>

	</div>

</section>

    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

<!--  Scripts-->

<script src="/assets/js/jquery-2.1.4.min.js"></script>

<script type="text/javascript" src='/assets/js/jquery.validate.js'></script>

<script type="text/javascript" src='/assets/js/additional-methods.min.js'></script>

<script type="text/javascript" src='/assets/js/jquery.form.js'></script>



<script> 

$('#cat_status').on('change', function(){

   this.value = this.checked ? 1 : 0;

   //alert(this.value);

}).change();

$('#category_form').click(function(e){

e.preventDefault();

$("#product_category").validate({

		rules: {

			cat_name: {

				required: true,

			},

		},

		

		messages: {

			cat_name: {

				required: "This field is mandatory",

			},		

		},

		errorPlacement: function(error, element) {

		var name = $(element).attr("id");

		error.appendTo($("#" + name + "_validate"));

		$('#product_category').addClass('shake');

		},

		});

		$('#product_category').submit();

});

//For Back page redirection functionality

function goBack() {

	window.location = "<?php echo base_url(); ?>Product_category";

}

</script> 

<style>

	.btn.focus, .btn:focus, .btn:hover{

		color: white !important;

	}

	.slider.round.disablebtn {

		cursor:not-allowed;

	}

	.form-group input.error, .form-group textarea.error, .form-group select.error {

		border: 1px solid red;

	}

	.dropdown-toggle{

		display:none !important;

	}

	ul.wysihtml5-toolbar li.btn-group a.btn.btn-default{

		display:none !important;

	}

	.a90 {

		margin-bottom: 15px;

		display: table;

	}

	.add_lead{

		float: none;

		width: 95%;

		text-align: left;

		margin: 0 auto;

		clear: both;

		margin-bottom: 3px;

		font-weight:500;

	}

	.switch {

	  position: relative;

	  display: inline-block;

	  width: 50px;

	  height: 17px;float: left;

	}



	/* Hide default HTML checkbox */

	.switch input {display:none;}



	/* The slider */

	.slider {

	  position: absolute;

	  cursor: pointer;

	  top: 0;

	  left: 0;

	  right: 0;

	  bottom: 0;

	  background-color: #ccc;

	  -webkit-transition: .4s;

	  transition: .4s;

	}



	.slider:before {

	  position: absolute;

	  content: "";

	  height: 12px;

	  width: 12px;

	  left: 7px;

	  bottom: 3px;

	  background-color: white;

	  -webkit-transition: .4s;

	  transition: .4s;

	}



	input:checked + .slider {

	  background-color: #f47400;

	}



	input:focus + .slider {

	  box-shadow: 0 0 1px #f47400;

	}



	input:checked + .slider:before {

	  -webkit-transform: translateX(26px);

	  -ms-transform: translateX(26px);

	  transform: translateX(26px);

	}



	/* Rounded sliders */

	.slider.round {

	  border-radius: 34px;

	}



	.slider.round:before {

	  border-radius: 50%;

	}

	.ui-autocomplete{

		z-index:100000 !important;

	}

	.error{

		color: red;

		background: #fff;

		font-size: 12px;

		font-weight: 600;

		/*float: right;*/

	}

	span.status_note {

		color: #9a8787;

		font-weight: 100;

		font-style: italic;

	}

	textarea::placeholder{

		font-style: italic;

	}

</style>

</body>

</html>