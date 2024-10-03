<!-- Include Code Mirror CSS. -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <div class="callout callout-info">
      <p><?php  echo $page_about; ?></p>
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
	<?php if(isset($message)){ echo $message; } ?>
	<form class="col s12" method="POST" action = '' id="product_subcategory">
		<div class="col-md-6 cal6">			
			<label class="add dept">Product Type Name <span class="requiredimp">*</span></label>
			<input type="text" id="subcat_name" name="subcat_name" value="<?php echo isset($product_subcategory_details[0]->sub_category_name) ? $product_subcategory_details[0]->sub_category_name : ''; ?>" class="form-control capitalize-me" placeholder="Please enter product subcategory name" autofocus>
			<div class="error-class" id="subcat_name_validate"></div>
		</div>
		<div class="col-md-6 cal6">			
			<label class="add dept">Product Category <span class="requiredimp">*</span></label>
			<select id="cat_id" name="cat_id"  class="form-control capitalize-me">
			<option value="" disabled selected>Please select category</option>
			<?php 
				$product_category	= $this->comfunction->getproduct_category_list();
				$option_category = isset($product_subcategory_details[0]->product_category_id) ? $product_subcategory_details[0]->product_category_id : '';
				if($product_category != "" && !empty($product_category)){						
					foreach($product_category as  $key => $value)
					{						 
					   $selected = '';		
					   if(count($option_category) > 0){	
								$selected = '';
								if($key == $option_category){
									$selected = 'selected';
								} 
					   }
					   echo "<option value=".$key.' '.$selected.">".$value."</option>";
					}
				}else{
					echo '<option value="" disabled style="color:red;">Product category not available</option>';
				}
			?>
			</select>
			
			<div class="error-class" id="cat_id_validate"></div>
		</div>
		<div class="col-md-6 cal6">
			<label class="add dept">Product Type Status <span class="requiredimp">*</span> <span class="status_note">(Orange button indicates status enabled, Grey button indicates status disabled.)</span></label>		
			<div style="clear:both;"></div>
			  <label class="switch">
			  <input type="checkbox" value='1' id="subcategory_status" name="subcategory_status" style="opacity:0" <?php if(isset($product_subcategory_details[0]->sub_category_status) && $product_subcategory_details[0]->sub_category_status == '1'){ ?> checked <?php } ?>>
				<div class="slider round"></div>
			</label>
		</div>	</br>	
		<input class="btn" type="submit" value="save" name="subcategory_form"  id="subcategory_form" />
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
$('#subcategory_status').on('change', function(){
   this.value = this.checked ? 1 : 0;
   //alert(this.value);
}).change();
$('#subcategory_form').click(function(e){
e.preventDefault();
$("#product_subcategory").validate({
		rules: {
			subcat_name: {
				required: true,
			},
			cat_id: {
				required: true,
			},
		},
		
		messages: {
			subcat_name: {
				required: "This field is mandatory",
			},
			cat_id: {
				required: "This field is mandatory",
			},		
		},
		errorPlacement: function(error, element) {
		var name = $(element).attr("id");
		error.appendTo($("#" + name + "_validate"));
		$('#product_subcategory').addClass('shake');
		},
		});
		$('#product_subcategory').submit();
});

//For Back page redirection functionality
function goBack() {
	window.location = "<?php echo base_url(); ?>Product_subcategory";
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