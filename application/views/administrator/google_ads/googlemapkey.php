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
            <div class="panel-heading">Google Map Key</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/gmapkey" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Google Map Key</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="google_key" id="google_key" placeholder="Google Map Key" value="<?php if(isset($googlemap->google_key)){echo $googlemap->google_key; } ?>" />
                                <label id="google_key-error" class="error" for="google_key"><?php echo form_error('google_key');?></label>
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
