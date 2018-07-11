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
                <div class="panel-heading">Edit Email Template</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="addnews" name="addnews" method="post" action="<?php  echo base_url().'administrator/email/edit/'.$Id; ?>" enctype="multipart/form-data">
                      <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" placeholder="Enter your title..." value="<?php if(isset($emailTemplatesDetail[0]->title)){echo $emailTemplatesDetail[0]->title;}?>" readonly/>
                           <label id="title-error" class="error" for="title"><?php echo form_error('title');?></label>
                        </div> 
                      </div>
                      <div class="form-group <?php if(form_error('subject')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Subject <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="subject" class="form-control" placeholder="Enter your subject..." value="<?php if(isset($emailTemplatesDetail[0]->subject)){echo $emailTemplatesDetail[0]->subject;}?>"/>
                           <label id="subject-error" class="error" for="subject"><?php echo form_error('subject');?></label>
                        </div> 
                      </div>
                      
                      <div class="form-group <?php if(form_error('news_description')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Content<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="content" rows="50"><?php if(isset($emailTemplatesDetail[0]->content)){echo $emailTemplatesDetail[0]->content; }?></textarea>
                       <label id="news_description-error" class="error" for="news_description"><?php echo form_error('news_description');?></label>
                          
                        </div>

                      </div>
                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/emailsetting';">Cancel</button>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
 $("#news_image").on('change', function () {
 $("#dvPreview").addClass("div-image");
if (typeof (FileReader) != "undefined") {

    var image_holder = $("#dvPreview");
    image_holder.empty();

    var reader = new FileReader();
    reader.onload = function (e) {
        $("<img />", {
            "src": e.target.result,
            "class": "thumb-image"
        }).appendTo(image_holder);

    }
    image_holder.show();
    reader.readAsDataURL($(this)[0].files[0]);
} else {
    alert("This browser does not support FileReader.");
}
});
</script>
