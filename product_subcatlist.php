<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 <div class="callout callout-info">
      <p><?php echo $page_about; ?></p>
   </div>
	<div class="box-header with-border">
		  <?php if(isset($error_msg) && $error_msg !=''){?>
			<p class="login-box-msg text-red"><?php echo $error_msg?></p>
		  <?php }?>
          <?php if(isset($success_msg) && $success_msg !=''){?>
            <p class="login-box-msg text-orange"><?php echo $success_msg?></p>
          <?php }?>
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Manage Product Types
		</h1>
		<div class="row">
			<div class="col-xs-12">		
			<button style="margin-right: 5px;" class="btn btn-primary pull-right" onclick="window.location='Product_subcategory/export_product_sub_category_details'" type="button">		
			<i class="fa fa-download"></i>&nbsp; Download Product Type Sheet (.csv)			
			</button>
				<button style="margin-right: 5px;" class="btn btn-primary pull-right" type="button" onclick="window.location='Product_subcategory/add_productsubcategory'">
					<i class="fa fa-plus"></i>&nbsp; Add New Product Type
				</button>				
			</div>
		</div>
    </section>
	<!-- Main content -->
	<section class="content">
	  <div class="row">
		<div class="col-xs-12">
		  <div class="box">
			<!-- /.box-header -->
			<div class="box-body">			
				<div class="row">
					<div class="col-xs-3">
						<input type="checkbox" name="selectAll" id="selectAll"/><label for ="selectAll">Select All</label>
					</div>					
					<div class="col-xs-1 pull-right">
						<div class="form-group">
							<button  type="button" class="btn btn-info btn-flat delete_select" style="margin:0px;padding:8px;" onclick = "checkedremove()" disabled="disabled">Delete</button>
						</div>
					</div>
					<?php echo form_open('Product_subcategory/form_list');?>
					<div class="col-xs-1 pull-right">
						<div class="form-group">
							<button type="text" class="btn btn-info btn-flat"  style="margin:0px;padding:8px;" >Clear</button>
						</div>
					</div>
					<?php echo form_close();?>
					<?php echo form_open('Product_subcategory/form_list',array('method'=>'get'));?>
					<div class="col-xs-6 pull-right" id="search-bar123">
						<div class="form-group">
							<input type="text"  id="search_box" class="form-control" placeholder="Search using product type & Category" name="search_type"/><button type="submit" class="btn btn-info btn-flat" >Search</button>
						</div>
					</div>					
					<?php echo form_close();?>
				</div>
				<table id="example2" class="table table-bordered table-hover">
				<thead>
				  <tr>
					<th>Select</th>
					<th>Sr. No.</th>
					<th>Product Type </th>
					<th>Category </th>
					<th>Status</th>
					<th>Manage</th>				
				  </tr>
				</thead>
				<tbody class="getdata">
					<?php
						$i=isset($page) ? $page : 0;
						if(count($subcat_list)>0)
						{
						foreach($subcat_list as $list)
						{
							$i++;
							$product_sub_category_id = $list->product_sub_category_id;
					?>
					<tr>
					<td><input name="checkbox[]" type="checkbox" id="checkbox" class="icheckbox" value="<?php echo $list->product_sub_category_id; ?>"/></td>
					<td><?php echo $i?></td>
					<td><?php echo $list->sub_category_name ?></td>	
					<td><?php echo $this->comfunction->getProductCategoryName($list->product_category_id); ?></td>	
					<td><?php if($list->sub_category_status == '1'){ echo 'Enabled';} else { echo 'Disabled';} ?></td>					
					<td class="edit-aaaa">
					<a href='Product_subcategory/edit_productsubcategory/<?php echo $list->product_sub_category_id ?>'>Edit</a>	&nbsp;|&nbsp;<a href='Product_subcategory/delete_productsubcategory/<?php echo $list->product_sub_category_id ?>' class='delete_faq' onclick="return confirm('Are you sure want to delete？')">Delete</a>
					</td>
					</tr>
					<?php						
						}
						}
						else
						{
					?>
					<tr>
					<td colspan='6'>data not found</td>	
					</tr>
					<?php
						}
					?>
				</tbody>
				<tfoot>
				</tfoot>
			  </table>
				<?php
					//echo $page_links;
				?>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->		  
		</div><!-- /.col -->
	  </div><!-- /.row -->
	</section>
	<!-- /.content -->
 </div>
<!-- /.content-wrapper -->
<script>
$('[name=selectAll]').change(function() {
     if ($(this).is(':checked')) {
        $('.icheckbox').attr('checked', 'checked');
    } else {
        $('.icheckbox').attr('checked', false);
    }
	var numberChecked = $('input[name="checkbox[]"]:checked').length;
	//console.log(numberChecked);
	(numberChecked > 0) ? $('.delete_select').prop('disabled', false) : $('.delete_select').prop('disabled', true);
});
$(function() {
    $(".icheckbox").click(function(){
	var numberChecked = $('input[name="checkbox[]"]:checked').length;
	(numberChecked > 0) ? $('.delete_select').prop('disabled', false) : $('.delete_select').prop('disabled', true);
	});
});
function checkedremove(){
	var n=confirm("Are you sure want to delete?");			
	var selected_value = [] ;				
	$("#checkbox:checked").each(function(){
		selected_value.push($(this).val());
	});
	console.log(selected_value);
	if(n){
		var selected_value = [] ;				
		$("#checkbox:checked").each(function(){
				   selected_value.push($(this).val());
		});
		console.log(selected_value);				
		$.ajax({
		   url: "Product_subcategory/ajaxfunction",
		  data:{showtype:'delete_multiple_product_subcategory', product_sub_category_id:selected_value},
		  type: "POST"
		}).done(function(results) {
		var json = JSON.parse(results);		
		  if(json.success)
		  {
			alert("Product sub category record deleted successfully");
			//oTable.fnDeleteRow(aPos);
			location.reload();
		  }
		  else{
			  alert(json.error);
		  }
		});
	}
}
 </script>