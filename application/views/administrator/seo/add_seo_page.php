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
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'add'){echo 'ADD'; }else{echo 'EDIT'; }  ?> SEO Setting</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="addseo" name="addseo" method="post" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/seo_setting/add'; }else{
                    echo base_url().'administrator/seo_setting/edit/'.$pageID; } ?>">
                    <div class="form-group <?php if(form_error('page_name')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Page Name <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <select name="page_name" id="page_name" class="form-control">
                            <option value="">Select page name</option>
                            <?php foreach($pageList as $pageLt){ ?>
                            <option value="<?php echo $pageLt->page_id; ?>" <?php if(isset($aboutus->page_id)) { if ($aboutus->page_id == $pageLt->page_id){ echo ' selected="selected"'; }  }else{ echo set_select('page_name', $pageLt->page_id); } ?> ><?php echo $pageLt->page_name ?></option>
                            <?php } ?>
                          </select>

                           <label id="page_name-error" class="error" for="page_name"><?php echo form_error('page_name');?></label>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('meta_title')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Title<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="meta_title" class="form-control" placeholder="Enter title..." value="<?php if(isset($aboutus->meta_title)) {echo $aboutus->meta_title; }else{echo set_value('meta_title'); }?>"  />
                           <label id="menu_meta_titlenmeta_titleame-error" class="error" for="meta_title"><?php echo form_error('meta_title');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('mata_author')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Author <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_author" class="form-control" placeholder="Enter author..." value="<?php if(isset($aboutus->meta_author)) {echo $aboutus->meta_author; }else{echo set_value('mata_author'); }?>"  />
                           <label id="mata_author-error" class="error" for="mata_author"><?php echo form_error('mata_author');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('mata_keywords')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Keywords <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_keywords" class="form-control" placeholder="Enter keywords..." value="<?php if(isset($aboutus->meta_keywords)) {echo $aboutus->meta_keywords; }else{echo set_value('mata_keywords'); }?>"  />
                           <label id="mata_keywords-error" class="error" for="mata_keywords"><?php echo form_error('mata_keywords');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('mata_viewport')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Viewport <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_viewport" class="form-control" placeholder="Enter Viewport..." value="<?php if(isset($aboutus->meta_viewport)) {echo $aboutus->meta_viewport; }else{echo set_value('mata_viewport'); }?>" />
                           <label id="mata_viewport-error" class="error" for="mata_viewport"><?php echo form_error('mata_viewport');?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Meta  Description<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="meta_description" rows="50"><?php if(isset($aboutus->meta_description)) {echo $aboutus->meta_description; }else{echo set_value('meta_description'); }?></textarea>
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
