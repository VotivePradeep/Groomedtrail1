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
    <div class="panel-heading">Edit POI</div>
    <div class="panel-body">
    <div id="responseMsg"></div>
     <form  method="post" id="addpoi" action="<?php if(isset($segment) && $segment == 'addpoi'){echo base_url().'administrator/poilist/addpoi'; }else{
        echo base_url().'administrator/poilist/editpoi/'.$poiID; } ?>"  enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-3 control-label cms-label">Trail Type</label>
             <div class="col-sm-8">
             <select name="trail_type_id" id="trail_type_id" class="form-control">
            <option value="">Please Select Trail Type</option>
            <?php if(isset($trailList)){
                foreach ($trailList as $trail) { ?>
                <option value="<?php if(isset($trail->trail_id)){echo $trail->trail_id;} ?>" <?php if(isset($poiDetail[0]->trail_type_id)){ if ($poiDetail[0]->trail_type_id == $trail->trail_id){ echo ' selected="selected"'; } } ?>><?php if(isset($trail->trail_name)){echo $trail->trail_name;} ?></option>
            <?php } } ?>
            </select>
            <label id="placed_on_route_id-error" class="error" for="placed_on_route_id"><?php echo form_error('placed_on_route_id');?></label>
            </div>
                
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label cms-label">State Name</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="region_name" placeholder="State Name" value="<?php if(isset($poiDetail[0]->region_name)){echo $poiDetail[0]->region_name; } ?>" id="region_name"/>
            <label id="poi_name-error" class="error" for="poi_name"><?php echo form_error('region_name');?></label></div>
      
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label cms-label">POI Name</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="kml_data_name" placeholder="POI Name" value="<?php if(isset($poiDetail[0]->kml_data_name)){echo $poiDetail[0]->kml_data_name; } ?>" id="poi_address"/>
            <label id="poi_name-error" class="error" for="poi_name"><?php echo form_error('kml_data_name');?></label></div>
      
        </div>
       <!-- <div class="form-group">
            <label class="col-sm-3 control-label cms-label">POI Image</label>
             <div class="col-sm-8">
            <textarea cols="37" id="description" name="description" rows="10"><?php if(isset($poiDetail[0]->description)){echo $poiDetail[0]->description; } ?></textarea>
            <label id="Description-error" class="error" for="Description"><?php echo form_error('poi_address');?></label></div>
        </div> -->
        <hr class="dotted">
        <div class="form-group buton-edit">
            <button type="submit" class="btn btn-primary" name="signup" value="Validate">Update</button>
            <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/poilist';  ?>';">Cancel</button>
        </div>
        </form>
    </div>
</div>
</div>
</div>       

</div>
<!-- Warper Ends Here (working area) -->
 