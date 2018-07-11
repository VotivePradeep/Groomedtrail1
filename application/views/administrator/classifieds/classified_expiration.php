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
                <div class="panel-heading">Classified Expiration</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                 <form  method="post" id="addclassifiedscat" method="post" action="<?php echo base_url().'administrator/classifieds/expiration/duration';  ?>">
                 
                    
                    <div class="form-group">
                           
                                <label class="col-sm-3 control-label cms-label">Classified Expiration Duration </label>
                                 <div class="col-sm-8">
                                 <input type="text" class="form-control" name="cl_ex_time" id="cl_ex_time" placeholder="Classified Expiration Duration" value="<?php if(isset($classifiedDetail[0]->cl_ex_time)){echo $classifiedDetail[0]->cl_ex_time; } ?>" />
                                <label id="cl_ex_time-error" class="error" for="cl_ex_time"><?php echo form_error('cl_ex_time');?></label></div>
                        
                    </div>

                    <hr class="dotted">
                    <label class="col-sm-3 control-label cms-label"></label>
                    <div class="form-group buton-edit col-sm-8">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Update</button>
                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/classifiedslist';  ?>';">Cancel</button>
                    </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
