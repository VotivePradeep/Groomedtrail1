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
				<div class="panel-heading"><?php if($segment == 'add'){
					echo 'Add Plan';
					}else{
					echo 'Edit Plan';
				} ?></div>
				<div class="panel-body">
					<div id="responseMsg"></div>
					<form  method="post" id="addpoi" class="full-form" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/rentalplan/add'; }else{
						echo base_url().'administrator/rentalplan/edit/'.$planID; } ?>"  enctype="multipart/form-data">
						
						   <div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">Plan Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pl_name" placeholder="Plan Name" value="<?php if(isset($pl_name->pl_name)){echo $pl_name->pl_name; } ?>" id="region_name"/>
								<label id="poi_name-error" class="error" for="poi_name"><?php echo form_error('pl_name');?></label>
							</div>
								
							</div>
							 <div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">Plan Description</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pl_description" placeholder="Plan Description" value="<?php if(isset($pl_name->pl_description)){echo $pl_name->pl_description; } ?>" id="pl_description"/>
								<label id="pl_description-error" class="error" for="pl_description"><?php echo form_error('pl_description');?></label>
							</div>
								
							</div>
							<div class="form-group">
								<label class="col-sm-4 text-right control-label cms-label">Plan Duration in Days</label>
								<!--<div class="plan_duration_note">(Note:- Please insert at least one plan duration)</div>-->
								<div class="col-sm-8">
									<input type="number" name="pl_days" id="pl_days" class="form-control"  min="0" placeholder="Plan Days" value="<?php if(isset($pl_name->pl_days)){echo $pl_name->pl_days; } ?>">
								</div>
						    </div>
						    <div class="form-group">
								<label class="col-sm-4 text-right control-label cms-label">Plan Duration in Months</label>
								<div class="col-sm-8">
									<input type="number" name="pl_months" id="pl_months" class="form-control"  min="0" placeholder="Plan Months" value="<?php if(isset($pl_name->pl_months)){echo $pl_name->pl_months; } ?>">
								</div>
						    </div>
						    <div class="form-group">
								<label class="col-sm-4 text-right control-label cms-label">Plan Duration in Year</label>
								<div class="col-sm-8">
									<input type="number" name="pl_year" id="pl_year" class="form-control"  min="0" placeholder="Plan Year" value="<?php if(isset($pl_name->pl_year)){echo $pl_name->pl_year; } ?>">
								</div>
							
						    </div>
							<div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">Plan Price ($)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="pl_price" placeholder="Plan Price" value="<?php if(isset($pl_name->pl_price)){echo $pl_name->pl_price; } ?>" id="pl_price"/>
								<label id="pl_price-error" class="error" for="pl_price"><?php echo form_error('pl_price');?></label>
							</div>
								
							</div>
							<div class="form-group buton-edit">
								<div class="col-sm-4"></div>
								<div class="col-sm-8">								
									<button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if($segment == 'add'){
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