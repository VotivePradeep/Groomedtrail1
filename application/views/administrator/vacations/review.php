<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css" media="screen">
  .vac_msg select {
    width: 100% !important;
}

.vac_msg textarea {
    width: 100%;
    height: 90px;
}
.review_approve_rejected .modal-dialog {
    max-width: 420px;
}
.rent_sub {
    background-color: #387fcc !important;
    color: #fff !important;
    border: none !important;
}
</style>
<div class="warper container-fluid">
  <div id="responseMsg"></div>  
  <div id="msg"></div>            
<div class="page-header"><h3>Review List <span class="totalrecordvac">(Total Reviews <?php if(isset($review)){echo count($review);}else{echo 0; } ?>)</span></h3></div>
<div class="panel panel-default POI-table">

      <div class="panel-heading">
        <!-- <a href="<?php echo base_url();?>administrator/rentalplan/add" class="btn btn-default btn-sm">Add Review</a>-->
      <ul class="vac_status_list">
      <li><a href="<?php echo base_url();?>administrator/rentalslist" class="btn btn-default btn-sm">Rental List</a></li>
      <li><a href="<?php echo base_url()?>administrator/rental/reviews" class="btn btn-default btn-sm" id="viewAll">View All Reviews</a></li>
      <li><a href="<?php echo base_url()?>administrator/rental/reviews/publish" class="btn btn-default btn-sm" id="viewPaymentPending">View Published Reviews</a></li>
      <li><a href="<?php echo base_url()?>administrator/rental/reviews/pendingapprovals" class="btn btn-default btn-sm" id="viewPandingAppv">View Pending Approvals Reviews</a></li>
      <li><a href="<?php echo base_url()?>administrator/rental/reviews/rejected" class="btn btn-default btn-sm" id="viewPandingAppv">View Rejected Reviews</a></li>
      </ul>

      </div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th style="display: none">s. no</th> 
                    <th>User Name</th>
                    <th>Property Name</th>
                    <th>Review Title</th>
                    <th>Review Description</th>
                    <th>Review Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 15) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 15) ) { 

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
                if(isset($review)){
                    foreach ($review as $review) { 
                      if($review->status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$review->comment);
                        $content = implode(" ",array_splice($words,0,10));
                        
                             ?>
                        <tr>
                         <td style="display: none"><?php echo $i; ?></td>
                         <td><a href="#" data-toggle="modal" data-target="#myModal<?php if(isset($review->review_ID)){echo $review->review_ID;}?>"><?php if(isset($review->fname)){echo $review->fname;}?></a></td>
                         <td><?php if(isset($review->vac_name)){echo $review->vac_name;}?></td>
                         <td><?php if(isset($review->review_title)){echo $review->review_title;}?></td>
                         <td><?php if(isset($content)){echo $content;}?></td>
                         <td><?php if(isset($review->created_date)){$date = date_create($review->created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                          <?php
                          $flag=0;
                          if (isset($checkpers)) {
                              foreach ($checkpers as $checkper) {    
                                  if (($checkper->permission_id == 15) && ($checkper->status_change_permission==1) ) {
                                      $flag = 1;
                                  }
                              }
                          }
                        if ($flag == 1) {  ?> 
                        <td>

                         <?php if($review->status == 0){ ?>
                            <a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>">Pending Approvals</a>
                          <?php }else{ ?>
                          <?php if($review->status == 1){ ?>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>"  class="btn btn-default btn-sm">Approved</a>
                          <?php }else if($review->status == 2){ ?>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>"  class="btn btn-default btn-sm">Rejected</a>
                          <?php } ?>

                         <?php } ?>

                         <!-- Modal -->
                            <div id="review_approve_rejected<?php echo $review->review_ID; ?>" class="modal fade review_approve_rejected" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Reviews <?php if(isset($review->vac_name)){ ?>(<?php echo $review->vac_name; ?>) <?php } ?></h4>
                                  </div>
                                  <form name="publishFrm" id="publishFrm">
                                  <div class="modal-body">
                                    <div id="responseMsg"></div>  
                                    <div class="vac_msg">
                                      <b>Status</b>
                                      <select name="r_status" id="r_status_<?php echo $review->review_ID; ?>" class="change-status-ad">
                                        <option value="">Select a Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                      </select>
                                      
                                    </div>
                                    <div class="vac_msg">
                                      <b>Message</b>
                                      <textarea name="r_msg" id="r_msg_<?php echo $review->review_ID; ?>" placeholder="Please enter Message"></textarea>
                                    </div>

                                  </div>
                                </form>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default rent_sub" id="reviewsubmit_<?php echo $review->review_ID; ?>" onclick="review_submit_approver(<?php echo $review->review_ID; ?>);">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>

                        <?php } elseif ($u_id==1) { ?>
                        <td>

                         <?php if($review->status == 0){ ?>
                            <a href="javascript:void(0);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>">Pending Approvals</a>
                          <?php }else{ ?>
                          <?php if($review->status == 1){ ?>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>"  class="btn btn-default btn-sm">Approved</a>
                          <?php }else if($review->status == 2){ ?>
                           <a href="javascript:void(0);" data-toggle="modal" data-target="#review_approve_rejected<?php echo $review->review_ID; ?>"  class="btn btn-default btn-sm">Rejected</a>
                          <?php } ?>

                         <?php } ?>

                         <!-- Modal -->
                            <div id="review_approve_rejected<?php echo $review->review_ID; ?>" class="modal fade review_approve_rejected" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Reviews <?php if(isset($review->vac_name)){ ?>(<?php echo $review->vac_name; ?>) <?php } ?></h4>
                                  </div>
                                  <form name="publishFrm" id="publishFrm">
                                  <div class="modal-body">
                                    <div id="responseMsg"></div>  
                                    <div class="vac_msg">
                                      <b>Status</b>
                                      <select name="r_status" id="r_status_<?php echo $review->review_ID; ?>" class="change-status-ad">
                                        <option value="">Select a Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                      </select>
                                      
                                    </div>
                                    <div class="vac_msg">
                                      <b>Message</b>
                                      <textarea name="r_msg" id="r_msg_<?php echo $review->review_ID; ?>" placeholder="Please enter Message"></textarea>
                                    </div>

                                  </div>
                                </form>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default rent_sub" id="reviewsubmit_<?php echo $review->review_ID; ?>" onclick="review_submit_approver(<?php echo $review->review_ID; ?>);">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </td>
                        <?php } ?>
                        <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 15) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 15) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1){ ?>
                       <td>
                          <ul class="edv-option">
                           <?php if ($flag2 == 1) { ?>
                              <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/rental/review/edit/'.$review->review_ID;?>">Edit</a></li>
                            <?php } ?>
                            <?php if ($flag1 == 1) { ?>
                              <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($review->review_ID)){echo $review->review_ID;}?>">Delete</a></li>
                            <?php } ?>
                          </ul>
                        </td> 
                       <?php }elseif ($u_id==1) { ?>
                        <td>
                          <ul class="edv-option">
                              <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/rental/review/edit/'.$review->review_ID;?>">Edit</a></li>
                              <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($review->review_ID)){echo $review->review_ID;}?>">Delete</a></li>
                          </ul>
                        </td>  

                       <?php } ?>
                    </tr>   
                    <!-- Modal -->
                          <div id="myModal<?php if(isset($review->review_ID)){echo $review->review_ID;}?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                     <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Reviews <?php if(isset($review->vac_name)){ ?>(<?php echo $review->vac_name; ?>) <?php } ?></h4>
                                </div>
                                <div class="modal-body">
                                  <div class="reviewmsg"></div>
                                   
                                    <p><b>Title:- <?php if(isset($review->review_title)){echo $review->review_title;}?></b></p>
                                    <p>Comment:- <?php echo $review->comment; ?></p>
                                    <p>User Name:- <?php if((isset($review->fname) && !empty($review->fname)) || (isset($review->lname) && !empty($review->lname))){echo $review->fname.' '.$review->lname; }else{echo $review->username;} ?></p>
                                    </div>

                                  
                                
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                          <!-- Modal --> 
               <?php $i++;  } }?>
                
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

$('.deletekml').click(function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_review';
           
if (confirm('Do you want to remove this review?'))
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

function review_submit_approver(id){
  var r_msg = $('#r_msg_'+id).val();
  var tablename = 'tbl_review';
  var r_status=$('#r_status_'+id).val();
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/changeStatus'; ?>',
      data: {id:id, r_msg:r_msg, tablename:tablename,r_status:r_status}, // serializes the form's elements.
      //dataType: "JSON",
      success: function(data)
      {
       //location.reload(); 
        $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Change Status Successfully </div>').show().fadeOut(5000);
        $('#publishFrm')[0].reset();
        $('#myModal'+id).fadeOut(2000,function(){
           $('#myModal'+id).modal('hide');
            location.reload();
        });
      }
    });
}

</script>

