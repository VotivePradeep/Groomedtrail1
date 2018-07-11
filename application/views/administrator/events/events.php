<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
 <div id="responseMsg"></div>             
<div class="page-header"><h3>Events List</h3></div>
<div class="panel panel-default route-table">
    <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 8) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
         <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/events/addevent" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add Events</a></li>
        </ul>  
    </div>
    <?php  
    } elseif ($u_id==1) {
    ?>
         <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/events/addevent" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add Events</a></li>
        </ul>  
    </div>
    <?php } ?>


    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Event Start Time</th>
                    <th>Event End Time</th>
                    <th>Created Date</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 8) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 8) ) { 

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
                if(isset($eventList)){
                    foreach ($eventList as $events) { 
                        if($events->event_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$events->event_description);
                            $content = implode(" ",array_splice($words,0,10));
                        ?>

                    <tr>
                      <td><?php if(isset($events->event_title)){echo $events->event_title;} ?></td>
                      <td><?php if(isset($events->event_date)){echo $events->event_date;} ?></td>
                      <td><?php if(isset($events->event_start_time)){echo $events->event_start_time;} ?></td>
                      <td><?php if(isset($events->event_end_time) && !empty($events->event_end_time)){echo $events->event_end_time;}else{echo 'All Day Event';} ?></td>
                      <td><?php if(isset($events->event_create_date)){$date = date_create($events->event_create_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                      <td><?php if(isset($events->last_modify_user_id) && !empty($events->last_modify_user_id)){
                      $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$events->last_modify_user_id."");
                      $result = $query->result();
                      echo $result[0]->fname;

                      }?></td>
                      <td><?php if(isset($events->last_modify_date) && $events->last_modify_date !='0000-00-00'){$date = date_create($events->last_modify_date); 
                      echo date_format($date, 'd-M-Y');}?></td>
                       <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 8) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>  
                          <td><a href="javascript:void(0);" id="status_<?php echo $events->event_id; ?>" onClick="changeStatus(<?php echo $events->event_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm" style="background-color: #387fcc;"><?php echo !empty($events->event_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } elseif ($u_id==1) { ?>
                          <td><a href="javascript:void(0);" id="status_<?php echo $events->event_id; ?>" onClick="changeStatus(<?php echo $events->event_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm" style="background-color: #387fcc;"><?php echo !empty($events->event_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } ?>

                     <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 8) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 8) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                if (($checkper->permission_id == 8) && ($checkper->view_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                            <?php 
                            if ($flag3 == 1) { ?>
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/events/view/<?php echo $events->event_id; ?>">View</a></li>
                           <?php }?>
                            <?php if($flag2 == 1){ ?>
                             <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/events/editevent/<?php echo $events->event_id; ?>">Edit</a></li>
                           <?php }  ?>
                            <?php if($flag1 == 1){ ?>
                             <li><a class="btn btn-default btn-sm deleteevent btn-delete" id="<?php echo $events->event_id; ?>" href="">Delete</a> </li>
                           <?php }  ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                            <ul class="edv-option">
                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/events/view/<?php echo $events->event_id; ?>">View</a></li>
                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/events/editevent/<?php echo $events->event_id; ?>">Edit</a></li>
                                <li><a class="btn btn-default btn-sm deleteevent btn-delete" id="<?php echo $events->event_id; ?>" href="">Delete</a> </li>
                            </ul>
                        </td>
                       <?php } ?>
                    </tr>    
               <?php $i++; } }?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->

        <script type="text/javascript">
$(document).ready(function(){
$(document).on('click','.deleteevent', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_event';
           
if (confirm('Do you want to remove this event?'))
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


/////////////////////////delete route////////////////



});

/////////////////////////change route status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_event'},function(data){
    
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
      $('#responseMsg').html('<div class="alert alert-success">Status change successfully</div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
$(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 4, "desc" ]] 
    }); 
});
</script>