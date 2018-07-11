<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css" media="screen">
  .read-class td{
    background-color: #f3c2c0 !important;
    color:#000;
  }
</style>
<div class="warper container-fluid"> 
  <span id="notification"></span>
  <div class="page-header">
    <h3>Messaging</h3>
    <input type="hidden" name="inbox_ids" id="inbox_ids" value=""/>
  </div>
  <div class="panel panel-default route-table">
    <div class="panel-heading"> 
      <a id="move_enquiry" class="btn btn-default btn-sm">Move to Trash</a>&nbsp; 
      <a id="store_enquiry" class="btn btn-default btn-sm">Archive  messages</a>&nbsp; 
     <!-- <a id="delete_enquiry" class="btn btn-default btn-sm">Delete</a> -->
      <a data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm GroupMail" >Group Mail</a> 
    </div>
    <div class="panel-body">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
        <thead>
          <tr>
             <th><input type="checkbox" class="mail-checkbox mail-group-checkbox" id="select_all">
            </th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php  
               $i =1;

                if(isset($enquiry)){

                    foreach($enquiry as $enquiryrow) { ?>
          <tr <?php if($enquiryrow->read_status == 0){ ?>class="read-class" id="read_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>"<?php }?> >
           <td><input type="checkbox" name="inbox_id[]" class="mail-checkbox mycheckbox" value="<?php if(isset($enquiryrow->id) && !empty($enquiryrow->id)) {echo $enquiryrow->id;} ?>" ></td>
            <td> <a href="" class="equiryRead" id="equiryRead_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" data-toggle="modal" data-target="#myModal<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>"> 
              <?php if(!empty($enquiryrow->name)){echo $enquiryrow->name;}else{echo '-';}?>
               </a> </td>
            <td><?php if(!empty($enquiryrow->email)){echo $enquiryrow->email;}else{echo '-';}?></td>
            <td><?php if(!empty($enquiryrow->message)){  $words = explode(" ",$enquiryrow->message);
              $content = implode(" ",array_splice($words,0,5)); 
              echo chunk_split($content, 30, "\n\r"); }else{echo '-';}?>
              <!-- Modal -->
              <div class="modal fade enquiryDetail" id="myModal<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" role="dialog">
                <div class="modal-dialog"> 
                  
                  <!-- Modal content-->
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">View Enquiry Detail</h4>
                    </div>
                    <div class="modal-body">
                      <p>
                        <label>Name:-</label>
                        <?php if(!empty($enquiryrow->name)){echo $enquiryrow->name;}else{echo '-';}?>
                      </p>
                      <p>
                        <label>Email:-</label>
                        <?php if(!empty($enquiryrow->email)){echo $enquiryrow->email;}else{echo '-';}?>
                      </p>
                      <p>
                        <label>Message:- </label>
                        <?php if(!empty($enquiryrow->message)){ echo chunk_split($enquiryrow->message, 30, "\n\r"); }else{echo '-';}?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div></td>
            <td><?php if(!empty($enquiryrow->created_date)){echo date("d-M-Y", strtotime($enquiryrow->created_date));}else{echo '-';}?></td>
            <?php
  
    $delete_flag=0;
    $view_flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
           
            if (($checkper->permission_id == 32) && ($checkper->delete_permission==1)) { 
                $delete_flag = 1;
            }
            if (($checkper->permission_id == 32) && ($checkper->view_permission==1)) { 
                $view_flag = 1;
            }
        }
    } ?>
            <td><!-- model code for import csv file-->
                <ul class="edv-option">
                <li><a class="btn btn-default btn-sm btn-edit replyEnquiry" data-toggle="modal" data-target="#myModalImport_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>">Reply</a></li>
                <?php if($view_flag == 1 || $u_id == 1){ ?>
                <li><a class="btn btn-default btn-sm btn-edit equiryRead" id="equiryRead_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" href="<?php echo base_url().'administrator/view/'.$enquiryrow->id; ?>">View</a></li> 
                <?php } ?>
                <?php if($delete_flag == 1 || $u_id == 1){ ?>
                <li><a class="btn btn-default btn-sm deleteenquiry btn-delete" id="<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" href="">Delete</a></li>
                <?php } ?>
                </ul>
              
            </td>
            <div class="example-modal adminpopup">
                <div class="modal reply-modal" id="myModalImport_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" role="dialog">
                  <div class="vertical-alignment-helper">
                    <div class="modal-dialog vertical-align-center">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Reply Message</h4>
                        </div>
                        <form id="contactfrm_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="contactfrm_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" method="post">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="hidden" class="" id="enquiryid_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="enquiry_id" value="<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="enquiryid" >
                              <input type="text" placeholder="Name" class="" id="name_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="name" value="<?php if(!empty($enquiryrow->name)){echo $enquiryrow->name;}else{echo '-';}?>" >

                              <input type="hidden" placeholder="Email" class="" id="email_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="email" value="<?php if(!empty($enquiryrow->email)){echo $enquiryrow->email;}else{echo '-';}?>" >
                            </div>
                            <div class="form-group">
                              <label>Subject</label>
                              <input type="text" placeholder="Enter subject" class="" id="subject_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="subject" value="Groomedtrail Enquiry" >
                            </div>
                            <div class="form-group">
                              <label>Message</label>
                              <textarea placeholder="Enter message" id="msg_contact_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" name="msg_contact"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer"> <a id="submit_<?php if(!empty($enquiryrow->id)){echo $enquiryrow->id;}else{echo '-';}?>" class="btn btn-primary mybuutonclick">Send</a>
                            <a type="button" class="close btn btn-close close_btn" data-dismiss="modal" aria-label="Close">close</a>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->                       
                    </div>                    
                    <!-- /.modal-dialog -->                     
                  </div>                  
                  <!-- /.vertical-alignment-helper -->                   
                </div>                
                <!-- /.modal -->                
              </div>              
              <!-- model code for import csv file end-->
          </tr>
          <?php $i++; }

                }?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Warper Ends Here (working area) --> 

<!--send mail to selected model-->

<div class="example-modal adminpopup">
  <div class="modal reply-modal" id="myModal" role="dialog">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Group Mail</h4>
          </div>
          <form id="contactfrm" name="contactfrm" method="post">
            <div class="modal-body">
              <div class="form-group">
              <label>Subject</label>
                 <input type="text" placeholder="Enter subject" class="" id="subjectall" name="subjectall" >
              </div>
              <div class="form-group">
              <label>Message</label>
                 <textarea placeholder="Enter message" id="msg_contactall" name="msg_contactall"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <a type="button" class="close btn btn-default close_btn" data-dismiss="modal" aria-label="Close">close</a>
              <a id="submit_all" class="btn btn-primary mybuttonclickall">Send</a>
            </div>
          </form>
        </div>
                <!-- /.modal-content -->         
      </div>      
      <!-- /.modal-dialog -->       
    </div>
        <!-- /.vertical-alignment-helper -->     
  </div>  
  <!-- /.modal -->   
</div>
<!-- model code for import csv file end--> 
<!--send mail to selected model end--> 
<script type="text/javascript">
  $(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 4, "desc" ]] 
    }); 
$(document).on('click','.deleteenquiry', function(){
 var id= $(this).attr('id');
 var tablename= 'tbl_enquiry';
           
if (confirm('Are you sure to delete this message?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/changeStatus',
        data:{ id:id, tablename:tablename },
        success: function(data){
          if(data == 1){
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
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.mycheckbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.mycheckbox').each(function(){
                this.checked = false;
            });
        }
    });    
    $('.equiryRead').on('click',function(){
       var userID = $(this).attr('id');
       var arr = userID.split('_');
       var inbox_ids= arr[1];
       var inbox_action = 'equiry_read';
      $.ajax({
        type: "POST",
        url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
        data: {inbox_ids:inbox_ids,inbox_action:inbox_action}, // serializes the form's elements.
        dataType: "JSON",
        success: function(data)
        {
          $("#read_"+inbox_ids).removeClass("read-class");
        }
    });
    });
    $('.mycheckbox').on('click',function(){
        if($('.mycheckbox:checked').length > 0){
            $('#select_all').prop('checked',true);
        }
        else{
            $('#select_all').prop('checked',false);
        }
    }); 
    $("#move_enquiry").click(function() {
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);
      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'move_to_trash';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';
     $.ajax({
        type: "POST",
        url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
        data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
        dataType: "JSON",
        success: function(data)
        {
          $('#notification').html('<div class="alert alert-success">Inquiry moved in the trash</div>').show().fadeOut(5000);
           location.reload(); 
        }
    });                
    });
    $("#store_enquiry").click(function() {
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);
      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'store_enquiry';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';
       $.ajax({
          type: "POST",
          url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
          data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
          dataType: "JSON",
          success: function(data)
          {
             $('#notification').html('<div class="alert alert-success">Store enquiry successfully</div>').show().fadeOut(5000);
             location.reload(); 
          }
      });  
    });
    $("#delete_enquiry").click(function() {
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);
      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'delete_enquiry';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';
       $.ajax({
          type: "POST",
          url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
          data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
          dataType: "JSON",
          success: function(data)
          {
            $('#notification').html('<div class="alert alert-success">Delete successfully</div>').show().fadeOut(5000);
             location.reload(); 
          }
      });
    });
    
</script> 
<script type="text/javascript">
$(".mybuutonclick").click(function() {
  var contentPanelId = jQuery(this).attr("id");
 // alert(contentPanelId);
  var arr = contentPanelId.split('_');
  //alert(arr[1]);
  var Id = arr[1];
  var e_name=$('#name_'+arr[1]).val();
  var email=$('#email_'+arr[1]).val();
  var subject=$('#subject_'+arr[1]).val();
  var msg_contact=$('#msg_contact_'+arr[1]).val();
  var enquiry_id=$('#enquiryid_'+arr[1]).val();
  var inbox_action = 'mail_single';
  if(msg_contact != ''){
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/contactus_reply'; ?>',
      data: {e_name:e_name, enquiry_id:enquiry_id, Id:Id, email:email, subject:subject, msg_contact:msg_contact, inbox_action:inbox_action}, // serializes the form's elements.
      dataType: "JSON",
      success: function(data)
      {
           if(data.msg_status == 'msg_success' ){
             $('#notification').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);
              setTimeout($(".modal").modal('hide'), 5000); 
          }else{           
             $('#notification').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);
             setTimeout($(".modal").modal('hide'), 5000);
             //location.reload();
          }
          $('.loader').hide();
      }
  });
  }else{
    alert('Please enter Message');
  }
});
$(".mybuttonclickall").click(function() {
 // var email=$('#emailall'.val();
  var selectedItems = new Array();
  $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
  var data = selectedItems.join(',');
  $("#inbox_ids").val(data);
  var inbox_ids = $('#inbox_ids').val();
  var subject=$('#subjectall').val();
  var msg_contact=$('#msg_contactall').val();
  var inbox_action = 'mail_multiple';
  if(inbox_ids != ''){
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/contactus_reply'; ?>',
      data: {email:inbox_ids, subject:subject, msg_contact:msg_contact, inbox_action:inbox_action}, // serializes the form's elements.
      dataType: "JSON",
      success: function(data)
      {
         if(data.msg_status == 'msg_success' ){
            $('#notification').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);
              setTimeout($(".modal").modal('hide'), 40000); 
          }else{              

             $('#notification').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);
             setTimeout($(".modal").modal('hide'), 40000); 
          }
          $('.loader').hide();
      }
  });
  }else{
    alert('Please checked checkbox then send group email');

  }
});
</script> 
