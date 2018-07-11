<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
  form#addroute-nwest .form-group select#roles {
    float: left;
    width: 48%;
}
form#addroute-nwest label.control-label.cms-label {
    float: left;
    width: 100%;
}
form#addroute-nwest .pertion-div-box {
    width: 48%;
    float: left;
    margin-right: 10px;
}  
.role-err {
    float: left;
    width: 100%;
}
</style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'add'){ echo 'Add Permission'; }else{
                       echo 'Edit Permission'; 
                    } 
                    ?></div>
                <div class="panel-body">
                  <div id="responseMsg"></div>
                 <form  method="post" id="addroute-nwest" action="<?php if(isset($segment) && $segment == 'add'){echo base_url().'administrator/permissions/add'; }else{
            echo base_url().'administrator/permissions/edit/'.$roleID; } ?>"  enctype="multipart/form-data">
                    <div class="form-group">
                        
                        <div class="col-sm-12">
                          <label class="control-label cms-label">Role Name</label>
                            <select name="roles" id="roles" class="form-control" <?php if(isset($roleID)){ ?>  disabled <?php } ?>>
                            <option value="">Select Role</option>
                            <?php if(isset($roleList)){
                              foreach ($roleList as $roleList) { ?>
                            <option value="<?php if(isset($roleList->role_id)){echo $roleList->role_id;}?>" <?php if(isset($roleID)) {if($roleList->role_id == $roleID){echo 'selected';}} ?> ><?php if(isset($roleList->role_name)){echo $roleList->role_name;}?></option>
                            <?php } } ?>
                            </select>
                            <div class="role-err"><label id="roles-error" class="error" for="roles"><?php echo form_error('roles');?></label></div>
                        </div>
                    </div>
                      <div class="form-group">
                        
                        <div class="col-sm-12">
                        <label class="control-label cms-label">Permission</label>
                          <?php if(isset($permissionList)){
                            foreach ($permissionList as $permission) { 
                              if(isset($roleID)){
                                $query = $this->db->query("SELECT * FROM  tbl_role_permission where permission_id=".$permission->permission_id." AND role_id=".$roleID."");
                                $permissionUser = $query->result();
                              }
                              
                              ?>
                                <div class="pertion-div-box">
                                  <div class="main-permion">
                                    <label for="repair_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" class="permission-name">
                                      <?php if(isset($permission->permission_name)){echo $permission->permission_name; } ?>
                                    </label>
                                    <div class="main-chk">
                                    <input  class="permission-chk" id="repair_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_id[]" type="checkbox" value="<?php if(isset($permissionUser[0]->permission_id)){ if($permissionUser[0]->permission_id == $permission->permission_id) { echo $permissionUser[0]->permission_id; } }else{ echo $permission->permission_id;} ?><?php //if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" <?php if(isset($permissionUser[0]->permission_id)){ if($permissionUser[0]->permission_id == $permission->permission_id) { echo 'checked'; } } ?> >
                                    <label for="repair_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>                                    
                                  </div>
                                  <?php  ?>
                                  <div class="permission-main-div">
                                    <div class="pern-status">
                                      <label for="permission_type_add">Add</label>
                                      <div class="main-chk">
                                      <input class="permission-chk-child" id="permission_type_add<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="1"  <?php if(isset($permissionUser[0]->add_permission)){ if($permissionUser[0]->add_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_add<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                     
                                    <div class="pern-status">
                                      <label for="permission_type_edit">Edit</label>
                                    <div class="main-chk">
                                      <input class="permission-chk-child" id="permission_type_edit<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="2" <?php if(isset($permissionUser[0]->edit_permission)){ if($permissionUser[0]->edit_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_edit<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_view">View</label>
                                      <div class="main-chk">
                                      <input class="permission-chk-child" id="permission_type_view<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="3" <?php if(isset($permissionUser[0]->view_permission)){ if($permissionUser[0]->view_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_view<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_delete">Delete</label>
                                      <div class="main-chk">
                                      <input class="permission-chk-child" id="permission_type_delete<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="4" <?php if(isset($permissionUser[0]->delete_permission)){ if($permissionUser[0]->delete_permission !=0) { echo 'checked'; } } ?> >
                                      <label for="permission_type_delete<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_status">Status change</label>
                                      <div class="main-chk">
                                        <input class="permission-chk-child" class="check-in" id="permission_type_status<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox"  value="5" <?php if(isset($permissionUser[0]->status_change_permission)){ if($permissionUser[0]->status_change_permission !=0) { echo 'checked'; } } ?> >
                                        <label for="permission_type_status<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                     
                                    </div>
                                  </div>
                                </div>
                            <?php  } } ?>
                        </div>
                    </div>
                    
                    <div class="col-sm-9 col-sm-offset-3">
                      <div class="form-group buton-edit">
                        <button type="submit" class="btn btn-primary" name="submit"><?php if(isset($basesegment) && $basesegment == 'addsubadmin'){ echo 'Submit'; }else{echo 'Update';} ?></button>

                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/roles';  ?>';">Cancel</button>
                      </div>
                    </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>

<script type="text/javascript">
   /* $(document).ready(function(){
      $('#roles').change(function(){
        $('.permission-chk').prop('checked', false).triggerHandler('click');
        $('.permission-chk-child').prop('checked', false).triggerHandler('click');
       });  

    });

      function permission_chk(perm_ID){
         //var prmID = $(this).attr('id');
        ///var permissionID = prmID.split("_");
       // var perm_ID = permissionID[1];
        var roles = $("#roles").val();
        if(roles !=''){
            if (perm_ID != '') {
              $.ajax({
                type:"POST",
                dataType:"json",
                url:"<?php echo base_url(); ?>ajax/permission_chk",
                data: {perm_ID:perm_ID,roles:roles},
                success: function(data) {
                  if(data == 1){ 
                    $('#responseMsg').html('<div class="alert alert-danger">Already permission has been assigned to this module</div>').show().fadeOut(7000);
                    $('#repair_'+permissionID[1]).prop('checked', false).triggerHandler('click');
                    $('.permission-chk-child').prop('checked', false).triggerHandler('click');
                     ('#addroute').submit();
                  }
                }
              });
              
            }
        }else{
         // alert('please select role');
          $('#repair_'+permissionID[1]).prop('checked', false).triggerHandler('click');
          $('.permission-chk-child').prop('checked', false).triggerHandler('click');
        }

          }*/
</script>