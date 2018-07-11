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
            <div class="panel panel-default add-kml-sec">
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'uploadkml'){echo 'Upload kml file'; }?></div>
                <div class="panel-body">
                <div id="responseMsg"></div>
                 <form  method="post" id="addtrail" action="<?php if(isset($segment) && $segment == 'uploadkml'){echo base_url().'administrator/kmlmanagement/uploadkml'; } ?>"  enctype="multipart/form-data">
                     
                   <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Category</label>
                        <div class="col-sm-8">
                            <select name="trail_name" id="trail_name" class="form-control">
                                <option value="">Please Select KML Category</option>
                                <?php if(isset($trailList)){
                                foreach ($trailList as $trail) { ?>
                                <option value="<?php if(isset($trail->trail_name)){echo $trail->trail_name;} ?>" <?php if(isset($poiDetail[0]->trail_type_name)){ if ($poiDetail[0]->trail_type_name == $trail->trail_name){ echo ' selected="selected"'; } } ?>><?php if(isset($trail->trail_name)){echo $trail->trail_name;} ?></option>
                                <?php } } ?>
                            </select>
                            <label id="trail_name-error" class="error" for="trail_name"><?php echo form_error('trail_name');?></label>

                        </div>
                    </div>
                    <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">State Name</label>
                         <div class="col-sm-8">
                            <select name="region_name" id="region_name" class="form-control">
                                <option value="">Please Select State Name</option>
                                <?php if(isset($getState)){
                                foreach ($getState as $getState) { ?>
                                <option value="<?php if(isset($getState->state_name)){echo $getState->state_name;} ?>" <?php if(isset($poiDetail[0]->region_name)){ if ($poiDetail[0]->region_name == $getState->state_name){ echo ' selected="selected"'; } } ?>><?php if(isset($getState->state_name)){echo $getState->state_name;} ?></option>
                                <?php } } ?>
                            </select>
                             <!--<input type="text" class="form-control" name="region_name" placeholder="Please enter state name" />-->
                             <a href="<?php echo base_url(); ?>administrator/state/add">Add State <i class="fa fa-plus-square" aria-hidden="true"></i></a>
                             <label id="region_name-error" class="error" for="region_name"><?php echo form_error('region_name');?></label>
                        </div>
                    </div>
                    <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">Upload File (KML only)</label>
                         <div class="col-sm-8">
                             <input type="file" class="form-control" name="trail_kml_path" placeholder="Upload KML File" />
                          
                        </div>
                    </div>
                     <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">Description</label>
                         <div class="col-sm-8">
                             <textarea cols="100" id="ckeditor" name="description" rows="50"></textarea>
                             <label id="description-error" class="error" for="description"><?php echo form_error('description');?></label>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="form-group buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if(isset($segment) && $segment == 'addtrail'){echo 'Upload'; }else{
                    echo 'Update'; } ?></button>
                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/trails';  ?>';">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
