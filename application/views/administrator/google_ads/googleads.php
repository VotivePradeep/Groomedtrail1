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
            <div class="panel-heading">Google Ads Credential</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>

                 <form  method="post" method="post" action="<?php echo base_url()."administrator/googleads_edit/" ?><?php if(isset($googleads->script_id)){echo $googleads->script_id; } ?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Page Name </label>
                        <div class="col-sm-8">
                            <select name="pagename" id="pagename" class="form-control">
                                <option value="">Selete Page Name</option>
                                 <option value="CMS Pages" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'CMS Pages'){ echo 'selected'; } }?>>CMS Pages</option>
                                <option value="CMS Pages" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'CMS Pages'){ echo 'selected'; } }?>>CMS Pages</option>
                                <option value="Forum" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Forum'){ echo 'selected'; } }?>>Forum</option>
                                <option value="Forum Details" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Forum Details'){ echo 'selected'; } }?>>Forum Details</option>
                                <option value="Classifieds" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Classifieds'){ echo 'selected'; } }?>>Classifieds</option>
                                <option value="Classifieds Details" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Classifieds Details'){ echo 'selected'; } }?>>Classifieds Details</option>
                                <option value="Events" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Events'){ echo 'selected'; } }?>>Events</option>
                                <option value="Events Details" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Events Details'){ echo 'selected'; } }?>>Events Detail</option>
                                <option value="News" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'News'){ echo 'selected'; } }?>>News</option>
                                <option value="News Details" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'News Details'){ echo 'selected'; } }?>>News Detail</option>
                                <option value="Lodging" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Lodging'){ echo 'selected'; } }?>>Lodging</option>
                                <option value="Lodging Details" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Lodging Details'){ echo 'selected'; } }?>>Lodging Details</option>
                                <option value="Profile" <?php if(isset($googleads->pagename)){if($googleads->pagename == 'Profile'){ echo 'selected'; } }?>>Profile</option>
                            </select>
                            <label id="pagename-error" class="error" for="pagename"><?php echo form_error('pagename');?></label>
                        </div>       
                    </div>
                    
                     <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Script Url </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="script_url" id="script_url" placeholder="Enter Script Url" value="<?php if(isset($googleads->script_url)){echo $googleads->script_url; }else{ echo set_value('script_url');} ?>" />
                            <label id="script_url-error" class="error" for="script_url"><?php echo form_error('script_url');?></label>
                        </div>       
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Client Id </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="client_id" id="client_id" placeholder="Enter Client Id" value="<?php if(isset($googleads->google_ad_client)){echo $googleads->google_ad_client; }else{ echo set_value('client_id');} ?>" />
                            <label id="client_id-error" class="error" for="client_id"><?php echo form_error('client_id');?></label>
                        </div>       
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Slot Id </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="slot_id" id="slot_id" placeholder="Enter Client Id" value="<?php if(isset($googleads->slot_id)){echo $googleads->slot_id; }else{ echo set_value('slot_id');} ?>" />
                            <label id="slot_id-error" class="error" for="slot_id"><?php echo form_error('slot_id');?></label>
                        </div>       
                    </div> 

                    <hr class="dotted">
                    
                    <div class="form-group buton-edit">
                        <input type="submit" class="btn btn-primary" name="signup" value="Validate"/>
                    </div>
                    </form>        
                
                </div>
            </div>
        </div>
    </div>  
</div>
