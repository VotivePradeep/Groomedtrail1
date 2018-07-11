<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
    .form-group {
	    overflow: hidden;
	}
	label.col-sm-3.control-label.cms-label {
	    text-align: right;
	    margin-bottom: 10px;
	}
</style>
<div class="warper container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default add-poi-sec">
				<div class="panel-heading"><?php if($reviewID == 'add'){
					//echo 'Add Review';
					}else{
					echo 'Edit Review';
				} ?></div>
				<div class="panel-body">
					<div id="responseMsg"></div>
					<form  method="post" id="addpoi" class="full-form" action="<?php if(isset($reviewID) && $reviewID == 'add'){echo base_url().'administrator/review/add'; }else{
						echo base_url().'administrator/rental/review/edit/'.$reviewEdit[0]->review_ID; } ?>"  enctype="multipart/form-data">
						
						   <div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">User Name</label>
							<div class="col-sm-8">
								<?php if(isset($reviewEdit[0]->fname)){echo strtoupper($reviewEdit[0]->fname); } ?>
							</div>
								
							</div>
							 <div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">Title</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="review_title" placeholder="Review title" value="<?php if(isset($reviewEdit[0]->review_title)){echo $reviewEdit[0]->review_title; } ?>" id="review_title"/>
								<label id="review_title-error" class="error" for="review_title"><?php echo form_error('review_title');?></label>
							</div>
								
							</div>
							<div class="form-group">
								<label class="col-sm-4 text-right control-label cms-label">Comment</label>
								<!--<div class="plan_duration_note">(Note:- Please insert at least one plan duration)</div>-->
								<div class="col-sm-8">
									<textarea name="comment" id="comment" class="form-control"  min="0" placeholder="Review comment" ><?php if(isset($reviewEdit[0]->comment)){echo $reviewEdit[0]->comment; } ?></textarea>
								</div>
						    </div>
						    
						    
							
							<div class="form-group buton-edit">
								<div class="col-sm-4"></div>
								<div class="col-sm-8">								
									<button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if($reviewID == 'add'){
									echo 'Submit';
									}else{
									echo 'Update';
									} ?></button>
									<button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/rentalplan';  ?>';">Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>