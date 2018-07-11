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
                <div class="panel-heading">Trail Report Edit</div>
                <div class="panel-body">
                <div id="responseMsg"></div>
                 <form  method="post" id="trailreportedit" action="<?php echo base_url().'administrator/trailreportedit/'; ?><?php if(isset($trailEdit[0]->county_name)){echo $trailEdit[0]->county_name; } ?>"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">State Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="region_name" id="region_name" value="<?php if(isset($trailEdit[0]->region_name)){echo $trailEdit[0]->region_name; } ?>">
                            <label id="region_name-error" class="error" for="region_name"><?php echo form_error('region_name');?></label>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">County Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="county_name" id="county_name" value="<?php if(isset($trailEdit[0]->county_name)){echo $trailEdit[0]->county_name; } ?>">
                            <label id="county_name-error" class="error" for="county_name"><?php echo form_error('county_name');?></label>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Cities</label>
                        <div class="col-sm-8">
                            <input type="text" name="cities" id="cities" value="<?php if(isset($trailEdit[0]->cities)){echo $trailEdit[0]->cities; } ?>">
                            <label id="cities-error" class="error" for="cities"><?php echo form_error('cities');?></label>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Submitted By</label>
                        <div class="col-sm-8">
                            <input type="text" name="submitted_by" id="submitted_by" value="<?php if(isset($trailEdit[0]->submitted_by)){echo $trailEdit[0]->submitted_by; } ?>">
                            <label id="submitted_by-error" class="error" for="submitted_by"><?php echo form_error('submitted_by');?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Maintained By</label>
                        <div class="col-sm-8">
                           <input type="text" name="maintainedBy" id="maintainedBy" value="<?php if(isset($trailEdit[0]->maintainedBy)){echo $trailEdit[0]->maintainedBy; } ?>">
                            <label id="maintainedBy-error" class="error" for="maintainedBy"><?php echo form_error('maintainedBy');?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Trail Conditions</label>
                        <div class="col-sm-8">
                          <textarea type="text" name="trail_conditions" id="trail_conditions" rows="4" cols="50">
                            <?php  if($trailEdit[0]->trail_report_status == 1){
                               echo  $trailEdit[0]->trail_report_conditions;
                            }else{
                              echo $trailEdit[0]->trail_conditions; 
                            } ?>
                                
                            </textarea>
                            <label id="trail_conditions-error" class="error" for="trail_conditions"><?php echo form_error('trail_conditions');?></label>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Description</label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="county_detail" rows="50"><?php if(isset($trailEdit[0]->county_detail)){echo $trailEdit[0]->county_detail; }?></textarea>
                        </div>
                    </div>
                    <hr class="dotted">
                    <div class="form-group buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Update</button>
                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/trailreport';  ?>';">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
 