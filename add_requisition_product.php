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
	<form class="col s12" method="POST" action = '' id="requisition_product" enctype="multipart/form-data">
		<div class="col-md-6 cal6">			
			<label class="add dept">Requisition Material Name <span class="requiredimp">*</span></label>
			<input type="text" id="product_title" name="product_title" value="<?php echo isset($product_details[0]->product_title) ? $product_details[0]->product_title : ''; ?>" class="form-control capitalize-me" placeholder="Please enter product title" autofocus>
			<div class="error-class" id="product_title_validate"></div>
		</div>			<div class="col-md-6 cal6">						<label class="add dept">Requisition Material Thumbnail <span class="requiredimp">*</span></label>			<!--<input type="file" id="product_thumbnail" name="product_thumbnail" value="<?php echo isset($product_details[0]->product_thumbnail) ? $product_details[0]->product_thumbnail : ''; ?>" class="form-control capitalize-me" placeholder="Please enter product thumbnail" autofocus>-->			<div class="well">			<h4 style="margin-bottom: 10px;"><?php // echo $album->name; ?></h4>				<div class="file_upload" id="f0">					<div class="file-upload-container">						<div class="file-upload-override-button left">						   							<input name="product_thumbnail" type="file" class="file-upload-button" id="product_thumbnail-0"  class="form-control capitalize-me" accept=".jpg,.png,.jpeg" >							<div align="center" class="vpb-display-preview-0"></div>						</div>						<div class="both"></div>					</div>				</div>			</div>			<ul id="sortable">					<?php 					$files_list	= isset($product_details[0]->product_thumbnail) ? $product_details[0]->product_thumbnail : '';;					//print_r($files_list); exit;																	if(isset($files_list) && !empty($files_list[0])){					 ?>					<input type="hidden" id="added_files_<?php echo $files_list; ?>" name="added_files" file-name="<?php echo $files_list; ?>" value="<?php echo $files_list; ?>" accept=".jpg,.png,.jpeg,.gif"  />						<?php $img_url = base_url() . 'assets/media/datafiles/product/' . $files_list;	?>					<img src="<?php echo $img_url; ?>" >					<?php //if (!file_exists($img_url)) {						//$img_url = base_url() . 'assets/media/datafiles/product/medium-default-product.jpg';						?><!--<img src="<?php echo $img_url; ?>" >-->					<?php// }else{						?>						<!--<img src="<?php echo $img_url; ?>" >--><?php 						//}					} ?>				</ul>				<span class="status_note">Warning:</span></br>				<span class="status_note">1) Thumbnail must be of  extension .jpg, .png, .jpeg</span></br>				<span class="status_note">2) Thumbnail must be of grey Scale</span></br>				<span class="status_note">3) Size of Thumbnail must not exceed more than 100Kb</span></br>					<span class="status_note">3) Dimension of Thumbnail must be 90X90 Pixels</span></br>				<div class="error-class" id="product_thumbnail_validate"></div>		</div>					<div class="col-md-6 cal6">						<label class="add dept">Requisition Material Price Per Unit <span class="requiredimp">*</span></label>			<input type="text" id="product_price_per_unit" name="product_price_per_unit" value="<?php echo isset($product_details[0]->product_price_per_unit) ? $product_details[0]->product_price_per_unit : ''; ?>" class="form-control capitalize-me" placeholder="Please enter product price per unit" autofocus>			<div class="error-class" id="product_price_per_unit_validate"></div>		</div>				<div class="col-md-6 cal6">						<label class="add dept">Requisition Category <span class="requiredimp">*</span></label>			<select id="requisition_category_id" name="requisition_category_id"  class="form-control capitalize-me">			<option value="" disabled selected>Please select requisition category</option>			<?php 				$category	= $this->comfunction->getReqcatlist();				$option_cat = isset($product_details[0]->requisition_category_id) ? $product_details[0]->requisition_category_id : '';				if($category != "" && !empty($category)){											foreach($category as  $key => $value)					{						 					   $selected = '';						   if(count($option_cat) > 0){									$selected = '';								if($key == $option_cat){									$selected = 'selected';								} 					   }					   echo "<option value=".$key.' '.$selected.">".$value."</option>";					}				}else{					echo '<option value="" disabled style="color:red;">Requisition category not available</option>';				}			?>			</select>						<div class="error-class" id="requisition_category_id_validate"></div>		</div>	
		<div class="col-md-6 cal6">
			<label class="add dept">Requisition Material Status <span class="requiredimp">*</span> <span class="status_note">(Orange button indicates status enabled, Grey button indicates status disabled.)</span></label>		
			<div style="clear:both;"></div>
			  <label class="switch">
			  <input type="checkbox" value="1" id="product_status" name="product_status" style="opacity:0" <?php if(isset($product_details[0]->product_status) && $product_details[0]->product_status == '1'){ ?> checked <?php } ?>>
				<div class="slider round"></div>
			</label>
		</div>	</br>	
		<input class="btn" type="submit" value="Save" name="requisition_product_form"  id="requisition_product_form" />
		</form>
	</div>
 </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
</div>
<!--  Scripts-->
<script src="/assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src='/assets/js/jquery.validate.js'></script>
<script type="text/javascript" src='/assets/js/additional-methods.min.js'></script>
<script type="text/javascript" src='/assets/js/jquery.form.js'></script>

<script> $('#product_status').on('change', function(){   this.value = this.checked ? 1 : 0;   //alert(this.value);}).change();$('#requisition_product_form').click(function(e){e.preventDefault();$("#requisition_product").validate({		rules: {			product_title: {				required: true,			},			product_price_per_unit: {				required: true,			},			requisition_category_id: {				required: true,			},		},				messages: {			product_title: {				required: "This field is mandatory",			},			product_price_per_unit: {				required: "This field is mandatory",			},			requisition_category_id: {				required: "This field is mandatory",			},				},		errorPlacement: function(error, element) {		var name = $(element).attr("id");		error.appendTo($("#" + name + "_validate"));		$('#requisition_product').addClass('shake');		},		});		$('#requisition_product').submit();});//For Back page redirection functionalityfunction goBack() {	window.location = "<?php echo base_url(); ?>Requisition_product";}
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