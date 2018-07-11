<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <!-- Bootstrap Validator  -->
    <link rel="stylesheet" href="<?php base_url(); ?>assets_admin/css/bootstrap-validator/bootstrap-validator.css" />
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading">Contact</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>administrator/contact">
                      <div class="form-group <?php if(form_error('title')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" placeholder="Enter your title..." value="<?php if(isset($contactUsContent->title)){ echo $contactUsContent->title; }?>" readonly />
                           <label id="title-error" class="error" for="title"><?php echo form_error('title');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('mata_author')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Author <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_author" class="form-control" placeholder="Enter author..." value="<?php if(isset($aboutus->mata_author)) {echo $aboutus->mata_author; }?>"  />
                           <label id="mata_author-error" class="error" for="mata_author"><?php echo form_error('mata_author');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_keywords')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Keywords <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_keywords" class="form-control" placeholder="Enter keywords..." value="<?php if(isset($aboutus->mata_keywords)) {echo $aboutus->mata_keywords; }?>"  />
                           <label id="mata_keywords-error" class="error" for="mata_keywords"><?php echo form_error('mata_keywords');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_description')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta  Description <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_description" class="form-control" placeholder="Enter description..." value="<?php if(isset($aboutus->mata_description)) {echo $aboutus->mata_description; }?>" />
                           <label id="mata_description-error" class="error" for="mata_description"><?php echo form_error('mata_description');?></label>
                        </div>
                      </div>

                      <div class="form-group <?php if(form_error('mata_viewport')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Meta Viewport <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="mata_viewport" class="form-control" placeholder="Enter Viewport..." value="<?php if(isset($aboutus->mata_viewport)) {echo $aboutus->mata_viewport; }?>" />
                           <label id="mata_viewport-error" class="error" for="mata_viewport"><?php echo form_error('mata_viewport');?></label>
                        </div>
                      </div>
                     <div class="form-group <?php if(form_error('address')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label">Address <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" name="address" class="form-control" placeholder="Enter your address..." value="<?php if(isset($contactUsContent->address)){ echo $contactUsContent->address; }?>"  />
                           <label id="address-error" class="error" for="address"><?php echo form_error('address');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('phone')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label">Phone<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" name="phone" id="cphone" class="form-control" placeholder="Enter your phone number..."  value="<?php if(isset($contactUsContent->phone)){ echo $contactUsContent->phone; }?>" maxlength="14" minlengt="14" />
                           <label id="phone-error" class="error" for="phone"><?php echo form_error('phone');?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('email')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" name="email" class="form-control" placeholder="Enter your email id..." value="<?php if(isset($contactUsContent->email)){ echo $contactUsContent->email; }?>"  />
                           <label id="email-error" class="error" for="email"><?php echo form_error('email');?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Content<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="content" rows="50"><?php if(isset($contactUsContent->content)) {echo $contactUsContent->content; }?></textarea>
                       <label id="content-error" class="error" for="lawsContent"><?php echo form_error('content');?></label>
                          
                        </div>
                      </div>
                      <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Submit</button>
                        </div>
                       </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function phoneFormatter() {
  $('#cphone').on('input', function() {
    var number = $(this).val().replace(/[^\d]/g, '')
    if (number.length == 7) {
     number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
    } else if (number.length == 10) {
      number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
    }
    $(this).val(number)
  });
};

$(phoneFormatter);
</script>