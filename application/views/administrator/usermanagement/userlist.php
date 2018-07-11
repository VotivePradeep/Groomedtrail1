<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Users List</h3>
  <button onclick="window.location.href='<?php echo base_url();?>administrator/admin/export_users'" class="exuserdata" type="button" style=" margin-left: 22px;">Export Data</button>
</div>
<div class="panel panel-default POI-table">
    <div class="panel-heading">
       <?php if ($u_id ==1) { ?>
        <a href="<?php echo base_url();?>administrator/role/add" class="btn btn-default btn-sm">Add Role</a>
        <?php } ?>
        <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 1) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
        <a href="<?php echo base_url();?>administrator/adduser" class="btn btn-default btn-sm">Add User</a>
    <?php } elseif ($u_id==1) { ?>
           <a href="<?php echo base_url();?>administrator/adduser" class="btn btn-default btn-sm">Add User</a>
 
    <?php } ?>
    </div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Profile Image</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if ($checkper->permission_id == 1) {
                                    if ($checkper->status_change_permission==1) { 
                                    $flag = 1;
                                   }
                                }
                            }
                        }
                    if ($flag == 1) {  ?>
                    <th>Status</th>
                    <?php } elseif ($u_id==1) { ?>
                    <th>Status</th>
                    <?php }
                        $flag1=0;
                        $flag2=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 1)) {
                                 if(($checkper->delete_permission==1)) { 
                                     $flag1 = 1;
                                  }
                                  if(($checkper->view_permission==1)) { 
                                    $flag2 = 1;
                                  }
                                }
                            }
                        }
                    if ($flag1 == 1 || $flag2 = 1) {  ?>   
                    <th>Action</th>
                    <?php } elseif ($u_id==1) { ?>
                    <th>Action</th>
                    <?php }?>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($userList)){
                    foreach ($userList as $user) { 
                       
                        if($user->status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                             if($basesegment == 'users'){ 
                             //if(($user->siterole_id != 1) ){?>
                            <?php 
                              if(isset($user->profile_picture) && !empty($user->profile_picture)){ 

                              if(strpos($user->profile_picture, "http://") !== false OR strpos($user->profile_picture, "https://") !== false){
                                $img = $user->profile_picture;
                              }else
                              {
                                $img = base_url().$user->profile_picture;
                              }

                              }
                              else
                              { 
                              $img =  base_url().'assets/images/default.png';}

                              ?>
                                    
                    <tr>
                       
                        <td><?php if(isset($user->username)){echo $user->username;}?></td>
                        <td><?php if(isset($user->fname)){echo $user->fname;}?></td>
                        <td><?php if(isset($user->lname)){echo $user->lname;}?></td>
                        <td><?php if(isset($user->email)){echo $user->email;}?></td>
                        <td><img src="<?php echo $img;?>" style="height: 72px;margin-left: 33px;"></td>
                        <td>
                          <?php //if(isset($user->siterole_id)){ 
                            $query=$this->db->query("SELECT * FROM tbl_user_assign_permission LEFT JOIN tbl_user_role ON tbl_user_assign_permission.role_id =tbl_user_role.role_id WHERE tbl_user_assign_permission.user_id=".$user->user_id."");

                             $result = $query->result();
                             //print_r($result);

                            if(isset($result[0]->role_name)){
                              echo $result[0]->role_name;
                            }else{
                              if($user->user_id != 1){
                                echo 'Normal User';
                              }else{
                                echo 'Super Admin';
                              }
                              
                            } ?>
                            
                          </td>
                        <td><?php if(isset($user->created_date)){$date = date_create($user->created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>

                        <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if ($checkper->permission_id == 1) {
                                        if($checkper->status_change_permission==1) { 
                                           $flag = 1;
                                        }
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>    
                        <td><?php if($user->user_id != 1){ ?><a href="javascript:void(0);" id="status_<?php echo $user->user_id; ?>" onClick="changeStatus(<?php echo $user->user_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($user->status)? 'Deactivate':'Activate' ?></a><?php } ?></td>
                        <?php } elseif ($u_id==1) {
                         
                         ?>
                        <td><?php if($user->user_id != 1){ ?><a href="javascript:void(0);" id="status_<?php echo $user->user_id; ?>" onClick="changeStatus(<?php echo $user->user_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($user->status)? 'Deactivate':'Activate' ?></a><?php } ?></td>
                        <?php } ?>
                        <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 1) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 1) && ($checkper->view_permission==1)) {
                                    $flag2 = 1;
                                }
                                 if (($checkper->permission_id == 1) && ($checkper->edit_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                        <?php if($flag2 == 1 || $flag1 == 1 || $flag3 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                            <?php 
                            if ($flag2 == 1) { ?>
                            <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/userdetails/'.$user->user_id; ?>">View</a></li>
                           <?php }?>
                            <?php if($flag3 == 1){ ?>
                              <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/useredit/'.$user->user_id; ?>">Edit</a></li>
                           <?php }  ?>
                            <?php if($flag1 == 1){ ?>
                              <?php if($user->user_id != 1){ ?><li><a class="btn btn-default btn-sm deleteuser btn-delete" id="<?php echo $user->user_id; ?>">Delete</a></li><?php } ?>
                           <?php }  ?>
                          <?php 
                            if ($flag3 == 1) { ?>
                           <?php if($user->user_id != 1){ ?><li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="<?php echo $user->user_id; ?>" style="max-width: 100% !important; width: auto !important;" data-toggle="modal" data-target="#myModal<?php echo $user->user_id; ?>">Change Password</a>
                                <!-- Modal -->
                          <div id="myModal<?php echo $user->user_id; ?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Change  Password</h4>
                                </div>
                                <form id="user_change_password<?php echo $user->user_id; ?>" name="user_change_password" class="cd-form" method="post" >
                                  <div class="modal-body">
                                     <div id="responseMsg<?php echo $user->user_id; ?>"></div>
                          
                                    <p class="vac_msg">
                                      <span>Password</span>
                                      <input type="password" name="password" id="password_<?php echo $user->user_id; ?>" placeholder="Please enter password"  />
                                      <input type="hidden" name="userid" id="userid_<?php echo $user->user_id; ?>" placeholder="Please enter password" value="<?php echo $user->user_id; ?>" />
                                    </p>
                                    <p class="vac_msg">
                                      <span>Confirm Password</span>
                                      <input type="password" name="cpassword" id="confirm_<?php echo $user->user_id; ?>" placeholder="Please enter confirm password" />
                                    </p>
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit"  id="status11_<?php echo $user->user_id; ?>" class="btn btn-default rent_sub" onclick="change_password(<?php echo $user->user_id; ?>)">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                             
                              </div>

                            </div>
                          </div>
                           <!-- Modal -->

                            </li>
                            <?php }  } ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                            <ul class="edv-option">
                            <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/userdetails/'.$user->user_id; ?>">View</a></li>
                            <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/useredit/'.$user->user_id; ?>">Edit</a></li>
                            <?php if($user->user_id != 1){ ?><li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="<?php echo $user->user_id; ?>" style="max-width: 100% !important; width: auto !important;" data-toggle="modal" data-target="#myModal<?php echo $user->user_id; ?>">Change Password</a>
                                <!-- Modal -->
                          <div id="myModal<?php echo $user->user_id; ?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Change  Password</h4>
                                </div>
                                <form id="user_change_password<?php echo $user->user_id; ?>" name="user_change_password" class="cd-form" method="post" >
                                  <div class="modal-body">
                                     <div id="responseMsg<?php echo $user->user_id; ?>"></div>
                          
                                    <p class="vac_msg">
                                      <span>Password</span>
                                      <input type="password" name="password" id="password_<?php echo $user->user_id; ?>" placeholder="Please enter password"  />
                                      <input type="hidden" name="userid" id="userid_<?php echo $user->user_id; ?>" placeholder="Please enter password" value="<?php echo $user->user_id; ?>" />
                                    </p>
                                    <p class="vac_msg">
                                      <span>Confirm Password</span>
                                      <input type="password" name="cpassword" id="confirm_<?php echo $user->user_id; ?>" placeholder="Please enter confirm password" />
                                    </p>
                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit"  id="status11_<?php echo $user->user_id; ?>" class="btn btn-default rent_sub" onclick="change_password(<?php echo $user->user_id; ?>)">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                             
                              </div>

                            </div>
                          </div>
                           <!-- Modal -->

                            </li>
                            <?php } ?>
                            <?php if($user->user_id != 1){ ?>
                            <li><a class="btn btn-default btn-sm deleteuser btn-delete" id="<?php echo $user->user_id; ?>">Delete</a></li>
                             <?php } ?>

                            </ul>
                        </td>
                       <?php } ?>
                    </tr>    
               <?php $i++; } } } //} ?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->

<script type="text/javascript">
    function change_password(id){
       $("#user_change_password"+id).validate({   
// Specify the validation rules
    rules: {
        
        password: {
            required: true,                     
            minlength:6
        },
        cpassword : {
            required: true,
            minlength:6,
            equalTo : "#password_"+id
        }
    },
    // Specify the validation error messages
    messages: {
       
        password: {
            required: "Please enter Password",
            equalTo :  "Password do not match "
        },
        cpassword: {
            required: "Please enter Confirm Password"
        },
    },
    submitHandler: function() 
    {
    var URl= '<?php echo base_url();?>';
       //form.submit();       
        $.ajax({
              type: "POST",
              url : URl+"administrator/admin/change_password",
              data: $('#user_change_password'+id).serialize(),
              //dataType:"JSON",
              success:function(data){
                if(data == 1){
                    $('#form-error').html('');
                    $('#responseMsg'+id).removeClass('alert-danger');
                    $('#responseMsg'+id).html('<div class="alert alert-success">Successfully changed password!</div>').addClass('alert-success').show().fadeOut(20000);
                     location.reload();
                }
            }
        });
        return false;
    }
});
//});
}
$(document).ready(function() { 
$('#toggleColumn-datatable').DataTable({ 
  "order": [[ 6, "desc" ]] 
}); 
});
$(document).ready(function(){

/////////////////////////delete poi////////////////


$(document).on('click','.deleteuser', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_user_master';
           
if (confirm('Do you want to remove this User?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});
/////////////////////////delete poi////////////////
});

/////////////////////////change poi status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_user_master'},function(data){
    
    if(data){

      if($('#status_'+id).text() == 'Activate'){      
        $('#status_'+id).text('Deactivate'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Activate');
        $('#status_'+id).removeClass('text-success').addClass('text-danger'); 
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',1)');
      }
      $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
</script>