<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>  
  <div id="msg"></div>            
<div class="page-header"><h3>State List</h3>
   
</div>
<div class="panel panel-default POI-table">
      <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 6) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
       <div class="panel-heading">
        <ul class="cls-status-list">
            <li> <a href="<?php echo base_url();?>administrator/state/add" class="btn btn-default" style="background-color: #000;color: #fff">Add State</a></li>
        </ul>
            
        </div>
    <?php  
    } elseif ($u_id==1) {
    ?>
        <div class="panel-heading">
            <ul class="cls-status-list">
            <li> <a href="<?php echo base_url();?>administrator/state/add" class="btn btn-default" style="background-color: #000;color: #fff">Add State</a></li>
        </ul>
        </div>
    <?php } ?> 
     <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr><th>s. no</th>
                    <th>State Name</th>
                    <th>Created Date</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 6) && ($checkper->status_change_permission==1)) { 
                                    $flag = 1;
                                }
                            }
                        }
                    if ($flag == 1) {  ?>
                    <th>Status</th>
                    <?php } elseif ($u_id==1) {
                        echo '<th>Status</th>';
                    }
                    
                     
            $flag1=0;
              $flag2=0;
              $flag3=0;
               if (isset($checkpers)) {
                  foreach ($checkpers as $checkper) {    
                      if (($checkper->permission_id == 6) ) { 

                          if($checkper->delete_permission==1){
                             $flag1 = 1; 
                          }
                          if($checkper->edit_permission==1){
                             $flag2 = 1; 
                          }
                          if($checkper->view_permission==1){
                             $flag3 = 1; 
                          }
                      }
                  }
              }
              if ($flag1 == 1 || $flag2 == 1 ||  $flag3 == 1) {  ?>
              <th>Action</th>
              <?php } elseif ($u_id==1) {
                  echo '<th>Action</th>';
              } ?>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($stateList)){
                    foreach ($stateList as $stateList) { 
                      if($stateList->state_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                        
                             ?>
                    <tr><td ><?php echo $i; ?></td>
                        <td><?php if(isset($stateList->state_name)){echo $stateList->state_name;}?></td>
                        <td><?php if(isset($stateList->state_created_date)){$date = date_create($stateList->state_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                        <td><?php if(isset($stateList->last_modify_user_id) && !empty($stateList->last_modify_user_id)){
                        $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$stateList->last_modify_user_id."");
                        $result = $query->result();
                        echo $result[0]->fname;

                        }?></td>
                        <td><?php if(isset($stateList->last_modify_date) && $stateList->last_modify_date !='0000-00-00'){$date = date_create($stateList->last_modify_date); 
                        echo date_format($date, 'd-M-Y');}?></td>
                        <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 6) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>  
                          <td><a href="javascript:void(0);" id="status_<?php echo $stateList->state_id; ?>" onClick="changeStatus(<?php echo $stateList->state_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($stateList->state_status)? 'Unpublish':'Publish' ?></a>
                          </td>
                     <?php } elseif ($u_id==1) { ?>
                        <td><a href="javascript:void(0);" id="status_<?php echo $stateList->state_id; ?>" onClick="changeStatus(<?php echo $stateList->state_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($stateList->state_status)? 'Unpublish':'Publish' ?></a>
                          </td>
                     <?php } ?>

                     <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 6) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 6) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag2 == 1 || $flag1 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                            <?php 
                            if ($flag2 == 1) { ?>
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/state/edit/'.$stateList->state_id;?>">Edit</a></li>
                           <?php }?>
                            <?php if($flag1 == 1){ ?>
                             <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($stateList->state_id)){echo $stateList->state_id;}?>">Delete</a>
                           <?php }  ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                           <ul class="edv-option">
                              <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/state/edit/'.$stateList->state_id;?>">Edit</a></li>
                              <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($stateList->state_id)){echo $stateList->state_id;}?>">Delete</a>
                              </li>
                            
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
$(document).ready(function(){

/////////////////////////delete kml////////////////
$(document).on('click','.deletekml', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_state';
           
if (confirm('Do you want to remove this State?'))
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
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_state'},function(data){
    
    if(data){

      if($('#status_'+id).text() == 'Unpublish'){      
        $('#status_'+id).text('Publish'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Unpublish');
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