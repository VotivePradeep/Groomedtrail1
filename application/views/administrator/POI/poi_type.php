<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>            
<div class="page-header"><h3>POI Types</h3></div>
<div class="panel panel-default POI-table">
  <?php
    $flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 3) && ($checkper->add_permission==1)) { 
                $flag = 1;
            }
        }
    }
if ($flag == 1) {  ?>
    <div class="panel-heading">
      <ul class="cls-status-list">
        <li> <a href="<?php echo base_url(); ?>administrator/poitypes/add" class="btn btn-default" style="background-color: #000;color: #fff">Add POI Type</a></li>
      </ul>
    </div>
    <?php } elseif ($u_id==1) { ?>
    <div class="panel-heading">
      <ul class="cls-status-list">
        <li> <a href="<?php echo base_url(); ?>administrator/poitypes/add" class="btn btn-default" style="background-color: #000;color: #fff">Add POI Type</a></li>
      </ul>
    </div>
<?php } ?> 
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th style="display: none">POI ID</th>
                    <th>POI Type</th>
                    <th>POI Marker</th>
                    <?php
                    $flag1=0;
                    $flag2=0;
                    $flag3=0;
                    $flag4=0;
                     if (isset($checkpers)) {
                        foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 3) ) { 

                                if($checkper->delete_permission==1){
                                   $flag1 = 1; 
                                }
                                if($checkper->edit_permission==1){
                                   $flag2 = 1; 
                                }
                                if($checkper->view_permission==1){
                                   $flag3 = 1; 
                                }
                                if($checkper->status_change_permission==1){
                                   $flag4 = 1; 
                                }

                            }
                        }
                    }
                    if ($flag4 == 1 || $u_id == 1 ) {  ?>
                    <th>Status</th>
                    <?php } if ($flag1 == 1 || $flag2 == 1 ||  $flag3 == 1) {  ?>
                    <th>Action</th>
                    <?php } elseif ($u_id==1) {
                        echo '<th>Action</th>';
                    } ?>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($kmlList)){
                    foreach ($kmlList as $poi) { 
                        if($poi->trail_name != 'Trail' && $poi->trail_name != 'Trail Report'){ 
                          if($poi->trail_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                             ?>
                    <tr>
                        <td style="display: none"><?php if(isset($poi->trail_id)){echo $poi->trail_id;}?></td>
                        <td><?php if(isset($poi->trail_name)){echo $poi->trail_name;}?></td>
                        <td><img src="<?php echo base_url(); ?><?php if(isset($poi->trail_marker)){ echo $poi->trail_marker; }?>" style="height: 28px;width: 28px"></td>
                        <?php if ($flag4 == 1 || $u_id==1) {  ?>  
                           <td><a href="javascript:void(0);" id="status_<?php echo $poi->trail_id; ?>" onClick="changeStatus(<?php echo $poi->trail_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm" style="background-color: #387fcc"><?php echo !empty($poi->trail_status)? 'Unpublish':'Publish' ?></a></td>
                        <?php } ?>



                       <?php
                          if (isset($checkpers) && !empty($checkpers)) {
                              foreach ($checkpers as $checkper) {  
                                 if (($checkper->permission_id == 3)){
                                  if(($checkper->edit_permission==1) || ($checkper->delete_permission==1)){
                                
                                ?>
                        <td>
                        <ul class="edv-option">

                          <?php
                        $flag=0;
                        $flag1=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 3) && ($checkper->edit_permission==1)) { 
                                    $flag = 1;
                                }
                                if (($checkper->permission_id == 3) && ($checkper->delete_permission==1)) { 
                                    $flag1 = 1;
                                }

                            }
                        }
                         if ($flag == 1) {  ?>
                         
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/poitypes/edit/'.$poi->trail_id;?>">Edit</a> </li>
                        <?php } 
                        if ($flag1 == 1) {  ?>
                            <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->trail_id)){echo $poi->trail_id;}?>">Delete</a></li>
                        <?php } ?>  
                        </ul>
                        </td>
                        
                      <?php } } } }
                      else if($u_id==1){ ?>

                      <td>
                        <ul class="edv-option">
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/poitypes/edit/'.$poi->trail_id;?>">Edit</a> </li>
                    
                            <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->trail_id)){echo $poi->trail_id;}?>">Delete</a></li>
                      
                        </ul>
                        </td>

                      <?php } ?>
                    </tr>    
               <?php $i++; } } }?>
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">

$(document).ready(function(){
$('#toggleColumn-datatable').DataTable({ 
        "order": [[ 0, "desc" ]] 
    });
/////////////////////////delete kml////////////////
$(document).on('click','.deletekml', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_trail_type_master';
           
if (confirm('Do you want to remove this?'))
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

/////////////////////////change route status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_trail_type_master'},function(data){
    
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
      $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
</script>