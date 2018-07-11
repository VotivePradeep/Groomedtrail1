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
					echo 'Add State';
					}else{
					echo 'Edit State';
				} ?></div>
				<div class="panel-body">
					<div id="responseMsg"></div>
					<form  method="post" id="addpoi" class="full-form" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/state/add'; }else{
						echo base_url().'administrator/state/edit/'.$stateID; } ?>"  enctype="multipart/form-data">
						
						<div class="form-group">
							<label class="col-sm-4 text-right control-label cms-label">State Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="state_name" placeholder="State Name" value="<?php if(isset($stateDetail->state_name)){echo $stateDetail->state_name; } ?>" id="region_name"/>
								<label id="poi_name-error" class="error" for="poi_name"><?php echo form_error('state_name');?></label></div>
								
							</div>
							<div class="form-group buton-edit">
								<div class="col-sm-4"></div>
								<div class="col-sm-8">								
									<button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if($segment == 'add'){
									echo 'Submit';
									}else{
									echo 'Update';
									} ?></button>
									<button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/state';  ?>';">Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>