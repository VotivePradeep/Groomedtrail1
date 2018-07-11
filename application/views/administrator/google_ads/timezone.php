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

            <div class="panel panel-default add-user-sec">
            <div class="panel-heading">Set Time Zone</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/set-time-zone" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Zone</label>
                            <div class="col-sm-8">
                            
                                <select class="form-control" name="zone_name" id="zone_name">
                                    <option>Select Zone</option>
                                    <?php  if(isset($zoneList)) { 
                                        foreach ($zoneList as $zone) {?>
                                    <option value="<?php echo $zone->zone_name; ?>" <?php if(!empty($timezone->country)) { if($timezone->country == $zone->zone_name){echo 'selected'; } } ?>><?php echo $zone->zone_name; ?></option>
                                    <?php } } ?>

                                </select>


                                <label id="zone_name-error" class="error" for="zone_name"><?php echo form_error('zone_name');?></label>
                            </div>
                        </div>
                        <hr class="dotted">
                        <div class="form-group buton-edit">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button  type="submit" class="btn btn-primary" name="signup">Update</button>
                            </div>
                        </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
