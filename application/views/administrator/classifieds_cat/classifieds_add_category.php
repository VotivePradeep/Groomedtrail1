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
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'addclassifiedscat'){ echo 'Add classified category'; }else{
                       echo 'Edit classified category'; 
                    } 
                    ?></div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                 <form  method="post" id="addclassifiedscat" method="post" action="<?php if(isset($segment) && $segment == 'addclassifiedscat'){echo base_url().'administrator/classifieds/addclassifiedscat'; }else{
                    echo base_url().'administrator/classifieds/editclassifiedscat/'.$classifiedscatID; } ?>"  enctype="multipart/form-data">
                 
                    
                    <div class="form-group">
                           
                                <label class="col-sm-3 control-label cms-label">Classifieds category name </label>
                                 <div class="col-sm-8">
                                <input type="text" class="form-control" name="classified_cat_name" id="classified_cat_name" placeholder="Classified category name" value="<?php if(isset($classifiedDetail[0]->classified_cat_name)){echo $classifiedDetail[0]->classified_cat_name; } ?>" />
                                <label id="classified_cat_name-error" class="error" for="classified_cat_name"><?php echo form_error('classified_cat_name');?></label></div>
                        
                    </div>

                    <hr class="dotted">
                    
                    <div class="form-group buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate"><?php if(isset($segment) && $segment == 'addclassifiedscat'){ echo 'Submit'; }else{
                       echo 'Update'; 
                    } 
                    ?></button>
                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/classifiedslist';  ?>';">Cancel</button>
                    </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
