<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <style type="text/css">
     .form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
.div-image img{
    height: 100px;margin: 6px;width: 100px;
}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'addnews'){ echo 'Add News'; }else{
                       echo 'Edit News'; 
                    } 
                    ?></div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="addnews" name="addnews" method="post" action="<?php if(isset($segment) && $segment == 'addnews'){echo base_url().'administrator/news/addnews'; }else{
                    echo base_url().'administrator/news/editnews/'.$newsId; } ?>" enctype="multipart/form-data">
                      <div class="form-group <?php if(form_error('news_title')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="news_title" class="form-control" placeholder="Enter your News title..." value="<?php if(isset($newDetail[0]->news_title)){echo $newDetail[0]->news_title;}else{echo set_value('news_title'); }?>"/>
                           <label id="news_title-error" class="error" for="news_title"><?php echo form_error('news_title');?></label>
                        </div> 
                      </div>
                      <div class="form-group <?php if(form_error('news_image')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Upload Image <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="hidden" class="form-control" name="news_image11" id="news_image11" />
                          <input type="file" class="form-control" name="news_image" id="news_image" />
                          <label id="news_image11-error" class="error" for="news_image11"><?php echo form_error('news_image11');?></label>
                          <?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){ ?>
                          <div class="pictures-show" id="dvPreview">
                          <img src="<?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){echo base_url().$newDetail[0]->news_image;}?>" <?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){ ?>style="height: 100px;margin: 6px;width: 100px;" <?php } ?> />
                        </div>
                        <?php } ?>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('news_description')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Body<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="news_description" rows="50"><?php if(isset($newDetail[0]->news_description)){echo $newDetail[0]->news_description; }else{echo set_value('news_description'); }?></textarea>
                       <label id="news_description-error" class="error" for="news_description"><?php echo form_error('news_description');?></label>
                          
                        </div>

                      </div>
                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/newslist';">Cancel</button>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->

<script>
$(document).ready(function() {

  $('#news_image').change(function(){
   var url = $(this).val();
   $('#news_image11').val(url);
  });
});
</script>