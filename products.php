<div id="con-1-i" class="container">
   <ul class="nav nav-tabs">
      <li class="active"><a href="#">Product Downloads</a></li>
   </ul>
   <div class="tab-content">
      <div id="home" class="tab-pane fade in active">

         
            <?php //print_r($product_list); exit; 
               if(isset($message)) { 
               	if($message['success'] == 1){
               		echo '<div class="success">Requistion added successfully</div>';
               	} else {
               		echo '<div class="error">Please try again</div>';
               	} 
               	$tab = 'add';
               } 
               ?>
            <!-- <ul class="nav nav-tabs">
               <li class="<?php echo isset($tab) ? '' : 'active'; ?>"><a data-toggle="tab" href="#home">Approvals</a></li>
               
               <li class="<?php echo isset($tab) ? 'active' : ''; ?>"><a data-toggle="tab" href="#menu1">Add</a></li>
               
               </ul>-->
            
               <div id="home" class="tab-pane fade in <?php echo isset($tab) ? '' : 'active'; ?>">
                  <div class="row">
                     
                     <div class="col-sm-12">
                       
                        <?php 
                           $i=0;
                           if(isset($product_list) && count($product_list) > 0){
                           ?>
                        <?php
                           foreach($product_list as $product) { 
                           	$i++;
                           ?>
                        <div class="employees">
                           <div class="employee_list col-sm-8">
                              <?php //echo $i.']'?>
                              <h4><?php echo $product->product_name; ?></h4>
<div class="row">
   <div class="col-sm-3">                           
<div class="details-info">
<p class="details-header">Category</p>
<p><?php echo $this->comfunction->getProductCategoryName($product->product_category_id); ?></p>
</div></div>
<div class="col-sm-5">   
<div class="details-info">
<p class="details-header">Sub Category</p>
<p><?php echo $this->comfunction->getProductSubCategoryName($product->product_sub_category_id); ?></p>
</div></div>
<div class="col-sm-4">   

<div class="details-info">
<p class="details-header">Type</p>
<p><?php echo $product->download_type ?></p>
</div></div></div>

                              <!--<span><?php //echo $this->comfunction->getBrandName($product->brand_id); ?></span><br/>
                              <span><?php //echo $product->product_quantity ?></span><br/>
                              <span><?php //echo $product->product_price ?></span><br/>
                              <span><?php //echo $product->download_type ?></span><br/>-->

                           </div>
                           
                           <div class="employee_view col-sm-4">
<a href="<?php echo base_url(); ?>assets/media/datafiles/productfile/<?php echo $product->download_path ?>" download ><button>Download</button></a>
			

		</div>
        
                        </div>
                        <?php }
                           } else {
                           
                           ?>
                        <div class="no-results">Sorry no results found for Product Downloads </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
       


      </div>
   </div>
</div>
<script>
   function getRequisitionForm(){
   var cat = $("#requisition_category").val();
   $.ajax({
   url : "<?php echo base_url(); ?>Requisitions/getRequisitionForm",
   data : {'category_id':cat},
   method:"POST",
   success : function(msg){
   $("#dynamic_form").html(msg);
   $("#category").attr('value',cat);
   },
   error: function(msg){
   $("#requistion_request_form").html('Sorry Could not fetch form. Please try again');
   }
   });
   
   }
</script>