<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Review Listings <span class="totalrecordvac">Total Records(<?php if(isset($businessList)){ echo count($businessList);  }else{echo 0;} ?>)</span> </h3></div>
<div class="panel panel-default POI-table">
   
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Date</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                
                <?php 
                $i =1;
                if(isset($businessList)){
                    foreach ($businessList as $business) { 

                      ?>
                                    
                    <tr>
                        <td><?php if(isset($business->vac_name)){ echo $business->vac_name;  }?>
                        </td>
                        <td><?php if(isset($business->created_date)){
                        $cdate = date_create($business->created_date); 
                        echo date_format($cdate, 'd-M-Y');
                        }?>
                        </td>
                        <td>
                        <?php  if(isset($business->vac_id)){
                        $query = $this->db->query(" SELECT tbl_review.*, tbl_user_master.fname, tbl_user_master.lname, tbl_user_master.username FROM tbl_review  INNER JOIN tbl_user_master ON tbl_review.user_ID=tbl_user_master.user_id WHERE bus_ID = ".$business->vac_id."");
                        $review = $query->result();
                        if(isset($review) && !empty($review)){ ?>
                        <a href="<?php echo base_url()."administrator/rental/review/".$business->vac_id; ?>">Review Details</a>

                        <?php } else{ ?> <a href="#" data-toggle="modal" data-target="#myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>">Review Details</a><?php } }?>
                          <!-- Modal -->
                          <div id="myModal<?php if(isset($business->vac_id)){echo $business->vac_id;}?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Reviews</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="reviewmsg"></div>
                                  <h4>No any review of this rental.</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>

                            </div>
                          </div>
                          <!-- Modal -->
                        </td>
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
      "order": [[ 1, "desc" ]] 
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
function changeStatus11(id,status){
//alert(totalCount);
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_review'},function(data){
    
    if(data){
        // $("#rejected_"+id).click();    
         $('.reviewmsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Review Rejected Successfully </div>').show().fadeOut(5000);
      }
  }); 
} 
function changeStatus(id,status){
//alert(totalCount);
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_review'},function(data){
    if(data){
       //$("#approved_"+id).click();
       $('.reviewmsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Review Approved Successfully </div>').show().fadeOut(5000);
      }
  }); 
} 
$(".rent_sub").click(function() {
  var contentPanelId = $(this).attr("id");
  var arr = contentPanelId.split('_');
  var id = arr[1];
  var vac_message=$('#vacmessage_'+arr[1]).val();
  var tablename = 'tbl_vacation_list';
  var needcorrection = 'needcorrection';
  var statusChange=$('#statusChange_'+arr[1]).val();
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/changeStatus'; ?>',
      data: {id:id, status:status, vac_message:vac_message, tablename:tablename,needcorrection:needcorrection,statusChange:statusChange}, // serializes the form's elements.
      dataType: "JSON",
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