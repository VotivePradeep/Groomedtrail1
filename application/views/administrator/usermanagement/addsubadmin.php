<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php if(isset($basesegment) && $basesegment == 'addsubadmin'){ echo 'Add Sub admin'; }else{
                       echo 'Edit Sub admin'; 
                    } 
                    ?></div>
                <div class="panel-body">
                 <form  method="post" id="addroute" method="post" action="<?php if(isset($basesegment) && $basesegment == 'addsubadmin'){echo base_url().'administrator/addsubadmin'; } ?><?php if(isset($basesegment) && $basesegment == 'edituser'){echo base_url().'administrator/edituser/'.$userID; } ?>"  enctype="multipart/form-data">
                  <input type="hidden" name="siterole_id" value="3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($userDetail->username)){echo $userDetail->username; }else{echo set_value('username'); } ?>" <?php if(isset($userDetail->username)){echo 'readonly'; } ?> />
                            <label id="Username-error" class="error" for="Username"><?php echo form_error('username');?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="<?php if(isset($userDetail->email)){echo $userDetail->email; }else{echo set_value('email'); } ?>" <?php if(isset($userDetail->email)){echo 'readonly'; } ?>/>
                            <label id="email-error" class="error" for="email"><?php echo form_error('email');?></label>
                        </div>
                    </div>
                    <?php if(isset($userDetail->email)){ }else{ ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="Password" value="" />
                            <label id="password-error" class="error" for="password"><?php echo form_error('password');?></label>
                        </div>
                    </div>
                   <?php } ?>
                    

                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Permission</label>
                        <div class="col-sm-9">
                      
                          <?php if(isset($permissionList)){
                            foreach ($permissionList as $permission) { 
                              if(isset($userID)){
                                $query = $this->db->query("SELECT * FROM  tbl_role_permission where permission_id=".$permission->permission_id." AND user_id=".$userID."");
                                $permissionUser = $query->result();
                              }
                              
                              ?>
                                <div class="pertion-div-box">
                                  <div class="main-permion">
                                    <label for="repair<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" class="permission-name">
                                      <?php if(isset($permission->permission_name)){echo $permission->permission_name; } ?>
                                    </label>
                                    <div class="main-chk">
                                    <input id="repair<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_id[]" type="checkbox" value="<?php if(isset($permissionUser[0]->permission_id)){ if($permissionUser[0]->permission_id == $permission->permission_id) { echo $permissionUser[0]->permission_id; } }else{ echo $permission->permission_id;} ?><?php //if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" <?php if(isset($permissionUser[0]->permission_id)){ if($permissionUser[0]->permission_id == $permission->permission_id) { echo 'checked'; } } ?> >
                                    <label for="repair<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>                                    
                                  </div>
                                  <?php  ?>
                                  <div class="permission-main-div">
                                    <div class="pern-status">
                                      <label for="permission_type_add">Add</label>
                                      <div class="main-chk">
                                      <input id="permission_type_add<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="<?php if(isset($permissionUser[0]->add_permission)){ if($permissionUser[0]->add_permission !=0) { echo 1; } }else{echo 1; } ?>"  <?php if(isset($permissionUser[0]->add_permission)){ if($permissionUser[0]->add_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_add<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                     
                                    <div class="pern-status">
                                      <label for="permission_type_edit">Edit</label>
                                    <div class="main-chk">
                                      <input id="permission_type_edit<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="<?php if(isset($permissionUser[0]->edit_permission)){ if($permissionUser[0]->edit_permission !=0) { echo 2; } }else{echo 2; } ?>" <?php if(isset($permissionUser[0]->edit_permission)){ if($permissionUser[0]->edit_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_edit<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_view">Viwe</label>
                                      <div class="main-chk">
                                      <input id="permission_type_view<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="<?php if(isset($permissionUser[0]->view_permission)){ if($permissionUser[0]->view_permission !=0) { echo 3; } }else{echo 3; } ?>" <?php if(isset($permissionUser[0]->view_permission)){ if($permissionUser[0]->view_permission !=0) { echo 'checked'; } } ?>>
                                      <label for="permission_type_view<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_delete">Delete</label>
                                      <div class="main-chk">
                                      <input id="permission_type_delete<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox" value="<?php if(isset($permissionUser[0]->delete_permission)){ if($permissionUser[0]->delete_permission !=0) { echo 4; } }else{echo 4; } ?>" <?php if(isset($permissionUser[0]->delete_permission)){ if($permissionUser[0]->delete_permission !=0) { echo 'checked'; } } ?> >
                                      <label for="permission_type_delete<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>"></label>
                                      </div>
                                    </div>

                                    <div class="pern-status">
                                      <label for="permission_type_status">Status change</label>
                                      <div class="main-chk">
                                        <input class="check-in" id="permission_type_status<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>" name="permission_type_<?php if(isset($permission->permission_id)){echo $permission->permission_id; } ?>[]" type="checkbox"  value="<?php if(isset($permissionUser[0]->status_change_permission)){ if($permissionUser[0]->status_change_permission !=0) { echo 5; } }else{echo 5; } ?>" <?php if(isset($permissionUser[0]->status_change_permission)){ if($permissionUser[0]->status_change_permission !=0) { echo 'checked'; } } ?> >
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

                        <button type="button" class="btn btn-info" id="resetBtn" onclick="location.href='<?php echo base_url().'administrator/subadmins';  ?>';">Cancel</button>
                      </div>
                    </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('.btn-primary').click(function(){
            if ($('.main-permion input[type="checkbox"]').is(":checked")) {
              var atLeastOneIsChecked = $(".permission-main-div .pern-status input:checked").length > 0;
              if (!atLeastOneIsChecked){
                  alert("Please check at least one checkbox");
              }
            }
        });
    });
</script> -->