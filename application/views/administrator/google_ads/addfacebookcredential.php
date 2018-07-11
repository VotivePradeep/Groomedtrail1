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
            <div class="panel-heading">Facebook Credential</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/facebookcredential" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Facebook oAuth Key</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="facebook_oauth_key" id="facebook_oauth_key" placeholder="Facebook oAuth Key" value="<?php if(isset($facebook_credential->oauth_key)){echo $facebook_credential->oauth_key; } ?>" />
                                <label id="facebook_oauth_key-error" class="error" for="facebook_oauth_key"><?php echo form_error('facebook_oauth_key');?></label>
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
