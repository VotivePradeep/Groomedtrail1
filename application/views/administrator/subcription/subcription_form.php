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
            <div class="panel-heading">Subcription (MailChimp)</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/subcription_form" ?>">
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Subcription Form HTM</label>
                            <div class="col-sm-8">
                                <textarea cols="100" id="ckeditor" name="html" rows="50"><?php if(isset($subcription_form->html)){echo $subcription_form->html; }else{echo set_value('html'); }?></textarea>
                                <label id="description-error" class="error" for="html"><?php echo form_error('html');?></label>
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
