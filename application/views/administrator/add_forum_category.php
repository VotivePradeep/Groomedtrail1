<?php $this->load->view('administrator/include/left_sidebar'); ?>
<?php
if(isset($_GET['forum_cat_id'])){
	$pagetitle="Edit";
	$buttonName="Update";
	$display="display: inline";
} else{
	$pagetitle="Add";
	$buttonName="Submit";
	$display="display: none";
}
?>
 <style type="text/css">
     .form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
.div-image img{
    height: 100px;margin: 6px;width: 100px;
}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php echo $pagetitle; 
							
								?> Forum Category </div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                 <?php msg_alert(); ?>
                   
                    <form action="<?php echo base_url().''.BASE_FOLDER_PATH.''.'Forum_category/add_edit_category'; ?>" method="POST" class="ng-pristine ng-valid" enctype="multipart/form-data">

						<div class="form-group ">
							<label class="col-sm-3 control-label cms-label">Category <span class="text-danger">*</span></label>
							<div class="col-sm-8">

								<input type="text" name="forum_cat_name" value=" <?php 
								if(!empty($category)){ echo $category->forum_cat_name; } ?>" placeholder="Required Field" required class="form-control">
								<input type="hidden"  name="forum_cat_id" value="<?php if(isset($_GET['forum_cat_id'])){ echo $_GET['forum_cat_id']; } ?>" class="form-control">

							</div> 
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label cms-label">Category url</label>
							<div class="col-sm-8">
								<input type="text" name="forum_cat_url" id="forum_cat_url" value=" <?php 
								if(!empty($category)){ echo $category->forum_cat_url; } ?>" placeholder="Required Field" required class="form-control">
								 <span style="color:red" class="view_error"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label cms-label">Description</label>
							<div class="col-sm-8">
								<textarea id="ckeditor" name="discription" rows="50" cols="100">
								<?php 
								if(!empty($category)){ echo $category->category_description; } ?>
								</textarea>
							</div>
						</div>
						<div class="form-group">
	                        <label class="col-sm-3 control-label cms-label">Category Image</label>
	                        <div class="col-sm-6">
	                        <input type="file" name="userfile" value="" placeholder="Required Field" class="form-control" >
	                       </div>	
	                    </div>
	                    <?php if(!empty($category)){
								
								echo "<div class='form-group'><div class='col-sm-3 control-label'>&nbsp;</div>";
								
							echo "<div class='col-sm-6'><img src='".base_url()."assets/category_images/icon/".$category->	forum_cat_image."'></div>";	
							echo "</div>";
						} ?>
						<div class="form-group">
						    <label class="col-sm-3 control-label cms-label">Status</label>
						    <div class="col-sm-6">
						    <select name="forum_cat_status"  class="form-control required">
							<option value="">Select Status</option>
							<option <?php if(isset($_GET['forum_cat_id'])){ if($category->forum_cat_status=="Aproved"){ echo "selected"; }} ?> value="Aproved">Published</option>
							<option <?php if(isset($_GET['forum_cat_id'])){ if($category->forum_cat_status=="Panding"){ echo "selected"; }} ?> value="Panding">Unpublished</option>
							
							</select>
							</div>
						</div>

                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <input class="btn btn-success submit" type="submit" name="submit" value="<?php echo $buttonName; ?>">
							<input class="btn-default btn" type="reset" name="Reset" value="Reset">
	                        <a style="<?php echo $display; ?>" href="<?php echo base_url() . BASE_FOLDER_PATH ?>add_forum_category" data-loading-text="Loading..." class="loading-example-btn btn btn-primary">Add New Category</a>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
<script>
		$('#forum_cat_url').on("keyup",function(){
		
		var title=$(this).val();
		
	var formAction="<?php echo base_url(); ?>administrator/forum_category/Already_exit_post_title";
    var id = '';
	 $.ajax({		
		url : formAction,
		type : "POST",
		dataType:"text",
		data : "title="+title+"&id="+id,
		success:function(data) 
		{    
			   
			 if(data==1){
			  
				  $(".view_error").html('This is already exist');
				  $(".submit").attr("disabled", true);  
			  }else{
			  $(".view_error").html('');
			  $(".submit").attr("disabled", false); 
			  }
	    }
	 });
	 
	});
	
	</script>