<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Sub Admin List</h3>
<button onclick="window.location.href='<?php echo base_url();?>administrator/admin/export_subadmin'" class="exuserdata" type="button" style=" margin-left: 22px;">Export Data</button></div>
<div class="panel panel-default POI-table">
    <div class="panel-heading">
       <a href="<?php echo base_url();?>administrator/addsubadmin" class="btn btn-default btn-sm">Create Sub Admin</a> 
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
                    <th>Status</th>
                    <th>Action</th>
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
                             ?>
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
                                $img =  base_url().'assets/images/default.png';
                              }

                              ?> 
                    <tr>
                        <td><?php if(isset($user->username)){echo $user->username;}?></td>
                        <td><?php if(isset($user->fname)){echo $user->fname;}?></td>
                        <td><?php if(isset($user->lname)){echo $user->lname;}?></td>
                        <td><?php if(isset($user->email)){echo $user->email;}?></td>
                        <td><img src="<?php echo $img; ?>" style="height: 72px;margin-left: 33px;"></td>
                        <td><?php if(isset($user->siterole_id)){ if($user->siterole_id == 2){echo "User"; }}?>
                          <?php if(isset($user->siterole_id)){ if($user->siterole_id == 3){echo "Sub Admin"; }}?>
                          
                        </td>
                        <td><?php if(isset($user->created_date)){$date = date_create($user->created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>

                        <td><a href="javascript:void(0);" id="status_<?php echo $user->user_id; ?>" onClick="changeStatus(<?php echo $user->user_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($user->status)? 'Deactivate':'Activate' ?></a></td>
                        <td>
                            <ul class="edv-option">
                                <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/userdetails/'.$user->user_id; ?>">View</a></li>
                                <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/edituser/'.$user->user_id; ?>" style="max-width: 100% !important;width:auto !important;" title="Edit Permission">Edit Permission</a></li>
                                 <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" href="<?php echo base_url().'administrator/useredit/'.$user->user_id; ?>" style="max-width: 100% !important;width:auto !important;">Edit Profile </a></li>
                                <li><a class="btn btn-default btn-sm deleteuser btn-delete" id="<?php echo $user->user_id; ?>">Delete</a> </li>
                            </ul> 
                        </td>
                    </tr> 


               <?php $i++; } }  ?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">

$(document).ready(function(){
$('#toggleColumn-datatable').DataTable({ 
        "order": [[ 6, "desc" ]] 
    });
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

      if($('#status_'+id).text() == 'Deactivate'){      
        $('#status_'+id).text('Activate'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Deactivate');
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