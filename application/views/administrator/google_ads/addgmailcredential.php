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
            <div class="panel-heading">Google Credential</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/googlecredential" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Google oAuth Key</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="gm_oauth_key" id="gm_oauth_key" placeholder="Google oAuth Key" value="<?php if(isset($googlecredential->oauth_key)){echo $googlecredential->oauth_key; } ?>" />
                                <label id="gm_oauth_key-error" class="error" for="gm_oauth_key"><?php echo form_error('gm_oauth_key');?></label>
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
