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
                <div class="panel-heading">ADD FAQ</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="aboutUs" name="aboutUs" method="post" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/faq/add'; }else{
                    echo base_url().'administrator/faq/edit/'.$pageID; } ?>">
                      <div class="form-group <?php if(form_error('faq_que')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Questions <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="faq_que" class="form-control" placeholder="Enter Questions..." value="<?php if(isset($faqlist->faq_que)) {echo $faqlist->faq_que; }?>"  />
                           <label id="faq_que-error" class="error" for="faq_que"><?php echo form_error('faq_que');?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Answers<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <textarea cols="100" id="ckeditor" name="faq_ans" rows="50"><?php if(isset($faqlist->faq_ans)) {echo $faqlist->faq_ans; }?></textarea>
                       <label id="faq_ans-error" class="error" for="lawsContent"><?php echo form_error('faq_ans');?></label>
                          
                        </div>

                      </div>

                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Submit</button>

                        <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/faq';">Cancel</button>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
