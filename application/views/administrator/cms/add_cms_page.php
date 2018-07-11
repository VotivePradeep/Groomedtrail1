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
                <div class="panel-heading">Add Page</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="aboutUs" name="aboutUs" method="post" action="<?php if(isset($segment) && $segment == 'addcmspage'){echo base_url().'administrator/cmspage/addcmspage'; }else{
                    echo base_url().'administrator/cmspage/editcmspage/'.$pageID; } ?>">

                    <div class="form-group <?php if(form_error('menu_name')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Menu Title<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="menu_name" class="form-control" placeholder="Enter menu title..." value="<?php if(isset($aboutus->menu_name)) {echo $aboutus->menu_name; }else{echo set_value('menu_name'); }?>"  />
                           <label id="menu_name-error" class="error" for="menu_name"><?php echo form_error('menu_name');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Page Title <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" placeholder="Enter page title..." value="<?php if(isset($aboutus->page_name)) {echo $aboutus->page_name; }else{echo set_value('title'); }?>"  />
                           <label id="title-error" class="error" for="title"><?php echo form_error('title');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_author')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Author <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_author" class="form-control" placeholder="Enter author..." value="<?php if(isset($aboutus->mata_author)) {echo $aboutus->mata_author; }else{echo set_value('mata_author'); }?>"  />
                           <label id="mata_author-error" class="error" for="mata_author"><?php echo form_error('mata_author');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_keywords')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Keywords <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_keywords" class="form-control" placeholder="Enter keywords..." value="<?php if(isset($aboutus->mata_keywords)) {echo $aboutus->mata_keywords; }else{echo set_value('mata_keywords'); }?>"  />
                           <label id="mata_keywords-error" class="error" for="mata_keywords"><?php echo form_error('mata_keywords');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_description')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta  Description <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_description" class="form-control" placeholder="Enter description..." value="<?php if(isset($aboutus->mata_description)) {echo $aboutus->mata_description; }else{echo set_value('mata_description'); }?>" />
                           <label id="mata_description-error" class="error" for="mata_description"><?php echo form_error('mata_description');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_viewport')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Viewport <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_viewport" class="form-control" placeholder="Enter Viewport..." value="<?php if(isset($aboutus->mata_viewport)) {echo $aboutus->mata_viewport; }else{echo set_value('mata_viewport'); }?>" />
                           <label id="mata_viewport-error" class="error" for="mata_viewport"><?php echo form_error('mata_viewport');?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Content<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="content" rows="50"><?php if(isset($aboutus->content)) {echo $aboutus->content; }else{echo set_value('content'); }?></textarea>
                       <label id="content-error" class="error" for="lawsContent"><?php echo form_error('content');?></label>
                          
                        </div>

                      </div>

                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Submit</button>

                        <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/cmspage';">Cancel</button>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
