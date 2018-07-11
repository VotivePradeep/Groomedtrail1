<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>  
  <div id="msg"></div>            
<div class="page-header"><h3>Plan List</h3></div>
<div class="panel panel-default POI-table">
 <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 16) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
    <div class="panel-heading">
         <a href="<?php echo base_url();?>administrator/rentalplan/add" class="btn btn-default btn-sm">Add Plan</a>
    </div>     
    <?php } elseif ($u_id==1){ ?>
     <div class="panel-heading">
         <a href="<?php echo base_url();?>administrator/rentalplan/add" class="btn btn-default btn-sm">Add Plan</a>
    </div>
    <?php } ?>    
    
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr><th>s. no</th>
                    <th>Plan Name</th>
                    <th>Plan Description</th>
                    <th>Plan Duration</th>
                    <th>Plan Price</th>
                    <th>Plan Created Date</th>
                    <th>Set Order</th>
                   <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 16) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 16) ) { 

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
                if(isset($PlanList)){
                    foreach ($PlanList as $PlanList) { 
                      if($PlanList->pl_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                        
                             ?>
                        <tr>
                         <td ><?php echo $i; ?></td>
                         <td><?php if(isset($PlanList->pl_name)){echo $PlanList->pl_name;}?></td>
                         <td><?php if(isset($PlanList->pl_description)){echo $PlanList->pl_description;}?></td>
                         <td><?php if(isset($PlanList->pl_days) && !empty($PlanList->pl_days)){
                          echo $PlanList->pl_days.' '.'Days';} ?>

                          <?php if(isset($PlanList->pl_months) && !empty($PlanList->pl_months)){
                          echo $PlanList->pl_months.' '.'Months';} ?>

                          <?php if(isset($PlanList->pl_year) && !empty($PlanList->pl_year)){
                             
                          echo $PlanList->pl_year.' '.'Year';} ?></td>
                         <td><?php if(isset($PlanList->pl_price)){echo $PlanList->pl_price;}?></td>
                         <td><?php if(isset($PlanList->pl_created_date)){$date = date_create($PlanList->pl_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                         <td>
                           <select name="orderList" id="orderList" onchange="orderStatus(<?php if(isset($PlanList->pl_id)){echo $PlanList->pl_id;}?>, this.value)">
                             <option value="">Select Order</option>
                             <option value="1" <?php if(isset($PlanList->order)){
                              if($PlanList->order == 1){
                                echo 'selected';
                              } }?> >1</option>
                             <option value="2" <?php if(isset($PlanList->order)){
                              if($PlanList->order == 2){
                                echo 'selected';
                              } }?>>2</option>
                             <option value="3" <?php if(isset($PlanList->order)){
                              if($PlanList->order == 3){
                                echo 'selected';
                              } }?>>3</option>
                           </select>
                         </td>
                         <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 16) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?> 
                             <td><a href="javascript:void(0);" id="status_<?php echo $PlanList->pl_id; ?>" onClick="changeStatus(<?php echo $PlanList->pl_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($PlanList->pl_status)? 'Unpublish':'Publish' ?></a>
                            </td>
                        <?php } elseif ($u_id==1) { ?>                        
                             <td><a href="javascript:void(0);" id="status_<?php echo $PlanList->pl_id; ?>" onClick="changeStatus(<?php echo $PlanList->pl_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($PlanList->pl_status)? 'Unpublish':'Publish' ?></a>
                            </td>
                        <?php } ?>
                        <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 16) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 16) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                
                            }
                        } ?>
                      <?php if($flag1 == 1 || $flag2 == 1 ){ ?>
                          <td>
                            <ul class="edv-option">
                               <?php if($flag2 == 1){ ?>
                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/rentalplan/edit/'.$PlanList->pl_id;?>">Edit</a></li>
                                <?php } ?>
                                <?php if($flag1 == 1){ ?>
                                <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($PlanList->pl_id)){echo $PlanList->pl_id;}?>">Delete</a></li>
                                <?php } ?>
                            </ul>
                          </td>
                      <?php }elseif ($u_id==1) { ?>
                          <td>
                            <ul class="edv-option">
                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/rentalplan/edit/'.$PlanList->pl_id;?>">Edit</a></li>
                                <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($PlanList->pl_id)){echo $PlanList->pl_id;}?>">Delete</a></li>
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
 var tablename= 'plan_master';
           
if (confirm('Do you want to remove this plan?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             $('#msg').html('<div class="alert alert-success">Delete successfully</div>').show().fadeOut(5000);
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

function orderStatus(id,order_id){
///var order_id = $('select#orderList option:selected').val();
var tablename = 'plan_master';
 $.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/changeStatus',
        data:{ id:id, tablename:tablename,order_id:order_id },
        success: function(data){
          $('#msg').html('<div class="alert alert-success"><?php echo 'Change Order successfully'; ?> </div>').show().fadeOut(5000);
        }
        });
} 


function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeMemberShipStatus",{'id':id ,'status':status,'tablename':'plan_master'},function(data){
    
    if(data){

    //  if(data == 'FALSE')
    //  {
    //    $('#msg').html('<div class="alert alert-danger"><?php echo 'You can only 2 tab active'; ?> </div>').show().fadeOut(5000);
    //  }else{

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

     // }
     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
} 



</script>