<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>  
  <div id="msg"></div>            
<div class="page-header"><h3>Role List</h3>
   
</div>
<div class="panel panel-default POI-table">
  
    <div class="panel-heading">
      <ul class="cls-status-list">
        <?php
              $flag1=0;
              $flag2=0;
              $flag3=0;
              $flag4=0;
              $flag26 = 0;
              $flag26_3 = 0;
              if (isset($checkpers)) {
                  foreach ($checkpers as $checkper) {    
                      if (($checkper->permission_id == 25) && ($checkper->add_permission==1)) { 
                          $flag1 = 1;
                      }
                      if (($checkper->permission_id == 25) && ($checkper->edit_permission==1)) { 
                          $flag2 = 1;
                      }

                      if (($checkper->permission_id == 25) && ($checkper->delete_permission==1)) { 
                          $flag4 = 1;
                      }
                      if (($checkper->permission_id == 25) && ($checkper->status_change_permission==1)) { 
                          $flag3 = 1;
                      }
                      if (($checkper->permission_id == 26) && ($checkper->add_permission==1)) { 
                          $flag26 = 1;
                      }
                      if (($checkper->permission_id == 26) && ($checkper->edit_permission==1)) { 
                          $flag26_3 = 1;
                      }
                  }
              }
      if ($flag1 == 1 || $u_id==1) {  ?>

      <li> <a href="<?php echo base_url();?>administrator/role/add" class="btn btn-default" style="background-color: #000;color: #fff">Add Role</a></li>
      <?php } 
     if ($flag26 == 1 || $u_id==1) {  ?>
      <li> <a href="<?php echo base_url();?>administrator/permissions/add" class="btn btn-default" style="background-color: #000;color: #fff">Add Permisson</a></li>
      <?php } ?>
      </ul>
    </div>
    
     <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th style="display:none">id</th>
                    <th>Role Name</th>
                    <th>Updated Date</th>
                    <?php if ($flag3 == 1 || $u_id==1) {  ?>
                    <th>Status</th>
                    <?php } ?>
                    <?php if ($flag2 == 1 || $u_id==1 || $flag26_3 == 1 || $flag4 == 1 || $flag2 == 1) {  ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($roleList)){
                    foreach ($roleList as $roleList) { 
                      if($roleList->role_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                        
                             ?>
                      <tr>
                         <td style="display:none"><?php if(isset($roleList->role_id)){echo $roleList->role_id;}?></td>
                        <td><?php if(isset($roleList->role_name)){echo $roleList->role_name;}?></td>

                        <td><?php if(isset($roleList->role_update_date) && $roleList->role_update_date != '0000-00-00'){$date = date_create($roleList->role_update_date); 
                      echo date_format($date, 'd-M-Y');}?></td>
                        <?php if ($flag3 == 1 || $u_id==1) {  ?>
                        <td><a href="javascript:void(0);" id="status_<?php echo $roleList->role_id; ?>" onClick="changeStatus(<?php echo $roleList->role_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($roleList->role_status)? 'Deactivate':'Activate' ?></a>
                          </td>
                          <?php } ?>
                          <?php if ($flag2 == 1 || $u_id==1 || $flag4==1 || $flag26_3==1) { ?>
                         <td>
                           <ul class="edv-option">
                            <?php 
                            if ($flag2 == 1 || $u_id==1) {  ?>
                              <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/role/edit/'.$roleList->role_id;?>">Edit</a></li>
                              <?php } if ($flag4 == 1 || $u_id==1) {  ?>
                              <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($roleList->role_id)){echo $roleList->role_id;}?>">Delete</a>
                              </li>
                              <?php } if ($flag26_3 == 1 || $u_id==1) {  ?>
                              <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/permissions/edit/'.$roleList->role_id;?>" style="max-width: 100% !important;width:auto !important;">Edit Permissions</a></li>
                              <?php } ?>
                          </ul>
                        </td>
                        <?php } ?>
                    </tr>    
               <?php $i++;  } }?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
	$(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 0, "desc" ]] 
    }); 
});
$(document).ready(function(){

/////////////////////////delete kml////////////////
$(document).on('click','.deletekml', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_user_role';
           
if (confirm('Do you want to remove this Role?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
            $('#responseMsg').html('<div class="alert alert-success">Delete successfully</div>').show().fadeOut(5000);
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});
});

function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_user_role'},function(data){
    
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
      $('#msg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
</script>