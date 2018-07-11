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
            <div class="panel-heading">Social Media </div>

                <div class="panel-body">
                 <div id="responseMsg"></div>
                  <form class="form-horizontal" method="post" name="mediaSetting" id="mediaSetting" action="<?php echo base_url() ?>administrator/socialmedia">
                   
                        <div class="form-group <?php if(form_error('facebook')){?>has-error<?php }?>">
                            <label class="col-sm-3 control-label">Facebook <span class="text-danger"></span></label>
                            <div class="col-sm-8">
                            <input type="text" name="facebook" class="form-control" placeholder="Enter facebook url here..." value="<?php if(isset($socialmedia->facebook)){ echo $socialmedia->facebook;}?>"/>
                            <label id="facebook-error" class="error" for="facebook"><?php echo form_error('facebook');?></label>
                            </div>
                        </div>
                       
                        <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                            <label class="col-sm-3 control-label">Google<span class="text-danger"></span></label>
                            <div class="col-sm-8">
                            <input type="text" name="google" class="form-control" placeholder="Enter google url here..." value="<?php if(isset($socialmedia->google)){ echo $socialmedia->google;}?>"/>
                            <label id="google-error" class="error" for="google"><?php echo form_error('google');?></label>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                            <label class="col-sm-3 control-label">Linkedin <span class="text-danger"></span></label>
                            <div class="col-sm-8">
                            <input type="text" name="linkedin" class="form-control" placeholder="Enter linkedin url here..." value="<?php if(isset($socialmedia->linkedin)){ echo $socialmedia->linkedin;}?>"/>
                            <label id="linkedin-error" class="error" for="linkedin"><?php echo form_error('linkedin');?></label>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                            <label class="col-sm-3 control-label">Twitter <span class="text-danger"></span></label>
                            <div class="col-sm-8">
                            <input type="text" name="twitter" class="form-control" placeholder="Enter twitter url here..." value="<?php if(isset($socialmedia->twitter)){ echo $socialmedia->twitter;}?>"/>
                            <label id="twitter-error" class="error" for="twitter"><?php echo form_error('twitter');?></label>
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
