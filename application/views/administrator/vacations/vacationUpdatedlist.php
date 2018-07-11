<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Rental Listings <span class="totalrecordvac">Total Records(<?php if(isset($businessList)){ echo count($businessList);  }else{echo 0;} ?>)</span> </h3></div>
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
                    
                    <th>Status</th>
                    <?php
                    $flag=0;
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
                                 if (($checkper->permission_id == 14) && ($checkper->status_change_permission==1)) { 
                                    $flag = 1;
                                }

                            }
                        }
                    }
                    if ($flag1 == 1 || $flag2 == 1 ||  $flag3 == 1 || $flag == 1 ) {  ?>
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

                      ?>
                        <tr>    
                        <td><?php echo '<a  id="'.$business->vac_id.'" href="'.base_url().'administrator/viewrental/'.$business->vac_id.'">';  

                        if(isset($business->vac_name)){echo $business->vac_name;}?>
                        </a>
                        </td>
                        <td><?php if(isset($business->vac_type)){echo $business->vac_type;}?></td>
                        <td>
                        <?php 
                          if($business->user_id != 1) { 
                            if($business->vac_expiry_date <= date('Y-m-d') && $business->vac_expiry_date !="0000-00-00"){ 
                              if($business->renew_status !=1){
                                  echo 'Expired';
                              }else{
                                  if(isset($business->pl_id)) {
                                      $sql= $this->db->query("SELECT * FROM plan_master WHERE pl_id=".$business->pl_id."");
                                      $planResult = $sql->result();
                                      foreach ($planResult as $planRslt) {
                                          if($planRslt->pl_price!=0){
                                              if($business->vac_payment_status == 0){
                                                echo  'Payment Pending';
                                              }else if($business->vac_payment_status == 1 && $business->vac_status == 0){
                                                echo 'Paid';
                                              }else if($business->vac_payment_status == 1 && $business->vac_status == 1){
                                                echo 'Published';
                                              }
                                          }else{
                                              if($business->vac_status == 0){
                                                echo 'Free Trial Pending';
                                              }else if($business->vac_status == 1){
                                                echo 'Published';
                                              }
                                          }
                                      }
                                  }
                              }
                            }else{
                              if(isset($business->pl_id)) {
                                $sql= $this->db->query("SELECT * FROM plan_master WHERE pl_id=".$business->pl_id."");
                                $planResult = $sql->result();
                                foreach ($planResult as $planRslt) {
                                    if($planRslt->pl_price!=0){
                                        if($business->vac_payment_status == 0){
                                            echo 'Payment Pending';
                                        }else if($business->vac_payment_status == 1 && $business->vac_status == 0){
                                            echo 'Paid';
                                        }else if($business->vac_payment_status == 1 && $business->vac_status == 1){
                                            echo 'Published';
                                        }
                                    }else{
                                        if($business->vac_status == 0){
                                            echo 'Free Trial Pending';
                                        }else if($business->vac_status == 1){
                                            echo 'Published';
                                        }
                                    }
                                }
                              }
                            } 
                          }else{
                              if($business->vac_status == 0){
                                  echo 'Pending Approval';
                              }else if($business->vac_status == 1){
                                  echo  'Published';
                              }
                          }
                     ?>

                    
                        </td>
                         <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        $flagstatus = 0;
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
                                if (($checkper->permission_id == 14) && ($checkper->status_change_permission==1) ) {
                                        $flagstatus = 1;
                                    }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 ==1 || $u_id==1 ){ ?>
                        <td>
                         <ul class="edv-option">
                         <?php 
                          if ($flag2 == 1 || $u_id==1 ) { 
                            echo '<li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/editrental/'.$business->vac_id.'">Edit</a></li>';
                          } ?>
                        <?php if ($flag == 1 || $u_id==1 ) {  ?>
                        <li>
                        <?php  if($business->vac_status == 0){ ?>
                        <a href="javascript:void(0);"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>">Pending Approval</a>
                         <?php  }else if($business->vac_status == 1){ ?>
                           <a href="javascript:void(0);"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>">Unpublish</a>
                        <?php   } ?>

                     <!-- Modal -->
                          <div id="myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Change  Rentals Submission Status
                                      
                                    </h4>
                                </div>
                                <form name="publishFrm" id="publishFrm" method="post">
                                  <div class="modal-body">
                                     <div id="responseMsg"></div>
                          
                                    <p class="vac_msg">
                                      <select name="statusChange" id="statusChange_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" class="change-status-ad">
                                        <option value="">Select a Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                      </select>
                                    </p>
                                    <p class="vac_msg">
                                      <span>Message</span>
                                      <textarea name="vac_message" id="vacmessage_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" placeholder="Please enter Message"></textarea></p>
                                      <input type="hidden" name="id" id="id_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" placeholder="Please enter Message" value="<?php echo $business->vac_id ?>" />
                                  </div>
                                  <div class="modal-footer">
                                    <button  id="status11_<?php if(isset($business->vac_id)){echo $business->vac_id; }?>" class="btn btn-default rent_sub">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                             
                              </div>

                            </div>
                          </div>
                           <!-- Modal -->

                           </li>

                          <?php } ?>



                          </ul>
                           
                        </td> 
                       <?php }?>
                        
                    </tr>    
               <?php $i++;   } } ?>
                
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


/////////////////////////change trail status////////////////

$(".rent_sub").click(function() {
  //alert(1);
  var contentPanelId = $(this).attr("id");
  var arr = contentPanelId.split('_');
  var id = arr[1];
  var vac_message=$('#vacmessage_'+arr[1]).val();
  var tablename = 'tbl_update_vacation_list';
  var statusChange=$('#statusChange_'+arr[1]).val();
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/updateVacData'; ?>',
      data: {id:id, status:status, vac_message:vac_message, tablename:tablename,statusChange:statusChange}, // serializes the form's elements.
      //dataType: "JSON",
      success: function(data)
      {
        $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Change Status Successfully </div>').show().fadeOut(5000);
        $('#publishFrm')[0].reset();
        //$('#myModal'+id).fadeOut(2000,function(){
           $('#myModal'+id).modal('hide');
      //  });
        location.reload(); 
      }
    });
  
  return false;
});
$(document).ready(function() {
  $('.accordion').find('.accordion-toggle').click(function() {
    $(this).next().slideToggle('600');
    $(".accordion-content").not($(this).next()).slideUp('600');
  });

});
function accordion_toggle(id){
  $('#accordion-toggle'+id).toggleClass('active').siblings().removeClass('active');
}
</script>