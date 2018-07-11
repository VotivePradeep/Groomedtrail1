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
                <div class="panel-heading">Change Password</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form class="ng-pristine ng-valid" id="addnews" name="addnews" method="post" action="<?php echo base_url()."administrator/changepassword" ?>">
                    <input type="hidden" name="admin_id" id="admin_id" class="form-control" value="<?php echo $ID; ?>"/>

                    <div class="form-group <?php if(form_error('current_password')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Current Password <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                         <input type="password" name="current_password" id="current_password" onblur="check_password();" class="form-control" placeholder="Enter current password here..." value=""/>
                          <label id="current_password-error" class="error" for="current_password"><?php echo form_error('current_password');?></label>
                         <span id="currentpassword" style="display:none;color:#D9534F"></span>
                        </div>
                      </div>
                    

                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">New Password <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="password" name="first_password" class="form-control" placeholder="Enter password here..." />
                           <label id="first_password-error" class="error" for="first_password"><?php echo form_error('first_password');?></label>
                        </div> 
                      </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="password" name="second_password" class="form-control" placeholder="Enter password here..." />
                           <label id="second_password-error" class="error" for="second_password"><?php echo form_error('second_password');?></label>
                        </div> 
                      </div>
                      
                      
                      
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                       </div>
                       
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<script type="text/javascript">

function check_password(){
  
  var current_password = $('#current_password').val();
  var admin_id = $('#admin_id').val();
  
  $.post('<?php echo base_url('administrator/admin/oldpassword_check');?>',{current_password:current_password,admin_id:admin_id},function(data){
        // $('#resetpasswordFrm')[0].reset();
    if(data==1){
          
          $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Old password is correct, Plaese enter below new password. </div>').show().fadeOut(5000);
          $('#current_password').removeClass('importantRed');
          $('#currentpassword').hide();
    
     }else{
      $('#current_password-error').hide();
      $('#current_password').val('').focus();
      $('#currentpassword').html('Old password does not match.').show();
      
     }
   }); 
  }

</script>