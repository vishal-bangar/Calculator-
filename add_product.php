<div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                
<div class="col-lg-12">
                                        <div class="panel panel-violet">
                                            <div class="panel-heading text-center">Add Product</div>
                                            <div class="panel-body pan">
                                            <?php if (@$msg[0]=='s') :?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong style="color:green;"><?php echo $msg[1];?></strong>
</div>
<?php endif;?>
<?php if (@$msg[0]=='e') :?>
<div class="alert alert-danger">
    <button type="button"c class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong><?php echo $msg[1];?></strong>
</div>
<?php endif;?>
                                                <form action="" method="post" class="form-horizontal">
                                                     
                                                    <div class="form-body pal">
                                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Product Name
                                                           </label>

                                                            <div class="col-md-9">
                                                                <input id="inputUsername" name="product_name" type="text" required="required" value="" class="form-control">
                                                             
                                                            </div>
                                                        </div>
                                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Product Price
                                                             </label>

                                                            <div class="col-md-9">
                                                                 
                                                                <input id="inputUsername" name="product_price" type="text" required="required" value="" class="form-control">
                                                             </div>
                                                        </div>
                                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Product PV
                                                           </label>

                                                            <div class="col-md-9">
                                                                <input id="inputUsername" name="product_pv" type="text" required="required" value="" class="form-control">
                                                             </div>
                                                        </div>
                                                      
                                                         <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Product Description
                                                             </label>

                                                            <div class="col-md-9">
                                                                 
<textarea rows="5" name="product_description" required="required" class="form-control"></textarea>                                                             
                                                            </div>
                                                        </div>
                                                           <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Product Image
                                                            <span class="require">*</span></label>

                                                            <div class="col-md-9">
 <input id="inputIncludeFile" name="product_image" type="file" required="required" value="" placeholder="Inlcude some file">                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-actions top">
                                                        <div class="col-md-offset-3 col-md-9">
             <button name="submit" type="submit" class="btn btn-green">Add Repurches Products</button>
                                                            
                                                        </div>
                                                    </div>
                                                      
                                                     
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>








                            </div>
                        </div>
                    </div>
                </div>
            </div>