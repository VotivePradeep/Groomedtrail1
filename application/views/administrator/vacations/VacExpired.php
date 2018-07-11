<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>View Expired </h3></div>
<div class="panel panel-default POI-table">
    <div class="panel-heading">
        <?php $this->load->view('administrator/vacations/vac_status_list'); ?>
    </div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Property Type</th>
                    <th>Property Created By</th>
                    <th>Created date</th>
                    <th>Expiration date</th>
                     <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 14) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 14) ) { 

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
                if(isset($businessList)){
                    foreach ($businessList as $business) { 
                      if($business->vac_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                    $date = date_create($business->vac_expiry_date); 
                    $expiryDate = date_format($date, 'd-M-Y');
                    if($business->user_id != 1) { 
                        if($business->vac_expiry_date <= date('Y-m-d') && $business->vac_expiry_date !="0000-00-00"){ 
                            if($business->renew_status !=1){
                      ?>
                                    
                    <tr >
                        <td><?php echo '<a  id="'.$business->vac_id.'" href="'.base_url().'administrator/viewrental/'.$business->vac_id.'">';  

                        if(isset($business->vac_name)){echo $business->vac_name;}?>
                        </a>
                      </td>
                        <td><?php if(isset($business->vac_type)){echo $business->vac_type;}?></td>
                        <td><?php if(isset($business->vac_created_by)){
                            if($business->vac_created_by == 'user' && $business->user_id != 1){
                                echo $business->fname.' '.$business->lname;
                            }else{
                                echo $business->vac_created_by;
                            }
                        }?></td>
                        <td><?php if(isset($business->vac_created_date)){
                          $cdate = date_create($business->vac_created_date); 
                            echo date_format($cdate, 'd-M-Y');
                          }?>
                          </td>
                        <td><?php if(isset($business->vac_expiry_date)){
                            if($business->vac_expiry_date !='0000-00-00'){
                              $date = date_create($business->vac_expiry_date); 
                              echo date_format($date, 'd-M-Y');
                            }
                          }?>
                        </td>
                        <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 14) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1 || $u_id == 1) {  ?>
                        <td>
                          
                          <?php 
                            ?>
                          <!--  <a class="ExpireBus" data-toggle="modal" data-target="#ExpireBusi<?php if(isset($business->vac_id)){echo $business->vac_id;}?>"> -->Expired<!-- </a> -->
                           <!--  <div id="ExpireBusi<?php if(isset($business->vac_id)){echo $business->vac_id;}?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Expired</h4>
                                </div>
                                <form name="ExpiredFrm" id="ExpiredFrm" method="post">
                                  <div class="modal-body">
                                     <div id="ExpMsg"></div>
                                    <p class="vac_msg">
                                      <span>Message</span>
                                      <textarea name="vacexbus" id="vacexbus_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" placeholder="Please enter Message"></textarea></p>
                                      <input type="hidden" name="expiredId_" id="expiredId_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" placeholder="Please enter Message" value="<?php echo $business->vac_id ?>" />
                                  </div>
                                  <div class="modal-footer">
                                    <button  id="expiredstatus_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" class="btn btn-default rent_expired">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                              </div>
                            </div>
                          </div> -->

                        
                        </td>
                         <?php } 
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 14) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 14) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                if (($checkper->permission_id ==14) && ($checkper->view_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 == 1){ ?>
                        <td>
                          <ul class="edv-option">
                          <?php 
                          if ($flag2 == 1) { 
                            echo '<li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/editrental/'.$business->vac_id.'">Edit</a></li>';
                          } ?>

                          <?php 
                         /* if ($flag3 == 1) { 
                            echo ' <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/viewrental/'.$business->vac_id.'">View</a></li>';
                           }*/ ?>
                          <?php 
                          if ($flag1 == 1) { 
                             echo '<li><a class="btn btn-default btn-sm deletvacation btn-delete" id="'.$business->vac_id.'" >Delete</a></li>'; 
                          } ?>

                          </ul>
                           
                        </td>
                       <?php }elseif ($u_id==1) { ?>
                       <td>
                          <ul class="edv-option">
                          <?php 
                            echo '<li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/editrental/'.$business->vac_id.'">Edit</a></li>';
                          /*  echo ' <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/viewrental/'.$business->vac_id.'">View</a></li>';*/
                            echo '<li><a class="btn btn-default btn-sm deletvacation btn-delete" id="'.$business->vac_id.'" >Delete</a></li>'; ?>
                           </ul>
                        </td>
                        <?php } ?>
                    </tr>    
               <?php $i++;   } }  }}}?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
$(document).ready(function() { 
  $('#toggleColumn-datatable').DataTable({ 
      "order": [[ 3, "desc" ]] 
  }); 
});
$(document).ready(function(){

/////////////////////////delete poi////////////////
$(document).on('click','.deletvacation', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_vacation_list';
           
if (confirm('Do you want to remove this Vacation?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
            $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Delete Successfully </div>').show().fadeOut(5000);
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

/////////////////////////change trail status////////////////
function changeStatus(id,status){
//alert(totalCount);
var vac_message = $("#vacmessage_"+id).val();
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_vacation_list','vac_message':vac_message},function(data){
    
    if(data){

      if($('#status_'+id).text() == 'Publish'){      
        $('#status_'+id).text('Unpublish'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Publish');
        $('#status_'+id).removeClass('text-success').addClass('text-danger'); 
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',1)');
      }
      $('#msg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
     location.reload();    
     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
} 


$(".rent_expired").click(function() {
  //alert(1);
  var contentPanelId = $(this).attr("id");
  var arr = contentPanelId.split('_');
  var id = arr[1];
  var vac_message=$('#vacexbus_'+arr[1]).val();
  var tablename = 'tbl_vacation_list';
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/rentalExpired'; ?>',
      data: {id:id, vac_message:vac_message, tablename:tablename}, // serializes the form's elements.
      //dataType: "JSON",
      success: function(data)
      {
        $('#ExpMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Email Sending</div>').show().fadeOut(5000);
        $('#publishFrm')[0].reset();
        $('#ExpireBusi'+id).fadeOut(2000,function(){
           $('#ExpireBusi'+id).modal('hide');
        });
        location.reload(); 
      }
    });
  
  return false;
});
</script>