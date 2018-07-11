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
    <div class="panel-heading"><?php if($segment == 'edit'){ ?>Edit <?php }else{ ?>Add  <?php } ?> POI Type</div>
    <div class="panel-body">
    <div id="responseMsg"></div>
     <form  method="post" id="addpoi" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/poitypes/add'; }else{
        echo base_url().'administrator/poitypes/edit/'.$poiID; } ?>"  enctype="multipart/form-data">
       
       
        <div class="form-group">
            <label class="col-sm-3 control-label cms-label">POI Name</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="poi_type" placeholder="POI Type Name" value="<?php if(isset($poiDetail[0]->trail_name)){echo $poiDetail[0]->trail_name; } ?>"/>
            <label id="poi_name-error" class="error" for="poi_type"><?php echo form_error('poi_type');?></label></div>
      
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label cms-label">POI Name</label>
            <div class="col-sm-8">
            <input type="file" name="userfile" id="userfile" onchange="showImg(this)"><br/>
            <img id="dummy_image" style="width:30px;" src="<?php if(isset($poiDetail[0]->trail_marker)){ echo base_url().$poiDetail[0]->trail_marker; }else{echo base_url().'assets/images/2017-05-11 (2).png'; } ?>">
           </div>
       </div>
       
        <hr class="dotted">
        <div class="form-group buton-edit">
            <button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if($segment == 'edit'){ ?>Update<?php }else{ ?>Submit <?php } ?></button>
            <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/poilist';  ?>';">Cancel</button>
        </div>
        </form>
    </div>
</div>
</div>
</div>       

</div>
<!-- Warper Ends Here (working area) -->
<script>
 function showImg(fdata) {
        if (fdata.files && fdata.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#dummy_image').attr('src', e.target.result);
            }

            reader.readAsDataURL(fdata.files[0]);
        }
    }
</script>