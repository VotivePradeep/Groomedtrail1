<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Pending Approvals Rental Listings <span class="totalrecordvac">Total Records(<?php if(isset($businessList)){ echo count($businessList);  }else{echo 0;} ?>)</span></h3></div>
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
                    <th>Status</th>
                    <th>Action</th>
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
                        //if($business->vac_expiry_date > date('Y-m-d') ){ 
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
                        <td>
                        <?php                          
                        if($business->user_id != 1) {
                          if(isset($business->pl_id)) {
                            $sql= $this->db->query("SELECT * FROM plan_master WHERE pl_id=".$business->pl_id."");
                            $planResult = $sql->result();
                            foreach ($planResult as $planRslt) {
                              if($planRslt->pl_price!=0){
                                if($business->vac_payment_status == 0){
                                 echo 'Payment Pending';
                                }else if($business->vac_payment_status == 1 && $business->vac_status == 0){
                                 echo 'Paid';
                                }
                              }else{
                              if($business->vac_status == 0){
                               echo 'Free Trial Pending';
                              }
                              }
                            }
                          }
                        }else{
                          if($business->vac_status == 0){
                            echo 'Pending Approval';
                          }   
                        }
                        ?>
                          <!-- Modal -->
                          <div id="myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Approving Pending Vacation Rentals</h4>
                                </div>
                                <form name="publishFrm" id="publishFrm">
                                <div class="modal-body">

                                  <p class="vac_msg"><span>Message</span>
                                    <textarea name="vac_message" id="vacmessage_<?php echo $business->vac_id; ?>" placeholder="Please enter Message"></textarea></p>
                                    <input type="hidden" name="id" id="id_<?php echo $business->vac_id; ?>" placeholder="Please enter Message" value="<?php echo $business->vac_id ?>"></p>
                                    <input type="hidden" name="status" id="status_<?php echo $business->vac_id; ?>" placeholder="Please enter Message" value="<?php echo $set; ?>"></p>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit"  id="status_<?php echo $business->vac_id; ?>" onClick="changeStatus(<?php if(isset($business->vac_id)){echo $business->vac_id;}?>, <?php if(isset($business->vac_status)){echo $business->vac_status;}?>);"  class="btn btn-default rent_sub">Submit</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                              </div>

                            </div>
                          </div>
                        <!-- Modal -->
                         
                        </td>
                         
                       <td>
                          <ul class="edv-option">
                          <?php 
                            echo '<li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/editrental/'.$business->vac_id.'">Edit</a></li>';
                          /*  echo ' <li><a class="btn btn-default btn-sm editclassified btn-edit mar-b-5" id="'.$business->vac_id.'" href="'.base_url().'administrator/viewrental/'.$business->vac_id.'">View</a></li>';*/
                            echo '<li><a class="btn btn-default btn-sm deletvacation btn-delete" id="'.$business->vac_id.'" >Delete</a></li>'; ?>
                             <li><a href="javascript:void(0);"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>">Pending Approval</a></li>
                           </ul>
                        </td>
                       
                    </tr>    
               <?php $i++;   } } // } ?>
                
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

      if($('#status_'+id).text() == 'Pending Approval'){      
        $('#status_'+id).text('Unpublish'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Pending Approval');
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