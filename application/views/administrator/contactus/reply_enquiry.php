<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
  .form-group {
      overflow: hidden;
  }
  label.col-sm-3.control-label.cms-label {
      text-align: right;
      margin-bottom: 10px;
  }
  .panel.panel-default.add-user-sec form#addroute {
      margin: 0 auto;
      max-width: 708px;
  }
  .pern-status {
      display: inline-block;
      margin: 0 0 0 0;
      position: relative;
      padding: 0 35px 0 0;
  }
  .permission-name {
      text-transform: uppercase;
  }
  .mang-viw-dtl-pg .form-group:nth-child(even) {
      background-color: #e8e8e8;
  }
  .mang-viw-dtl-pg .form-group p {
      margin-bottom: 0;
  }
  .mang-viw-dtl-pg .form-group {
      margin-bottom: 0px;
      padding: 7px;
  }
  .data-pro-table table {
      width: 100%;
      text-align: left;
      border: none;
  }
  .data-pro-table table tr,
  .data-pro-table table td,
  .data-pro-table table th {
      text-align: left !important;
  }
  .data-pro-table table td {
      border: 1px solid #ccc;
  }
  .busns-dscrpsn {
      padding: 15px;
      margin-top: 15px;
      border: 1px solid #cacaca;
  }
  .panel-heading a {
      float: right;
      background: #428bca;
      color: #fff;
      padding: 5px;
      top: -6px;
  }
  p.rental {
    margin: 6px 0 0;
  }
  .busns-dscrpsn {
    padding: 15px;
    margin-top: 15px;
    border: 1px solid #cacaca;
    overflow: hidden;
}
.mang-viw-dtl-pg .data-pro-table table td .form-group.reply-enquiry {
/* border: none; */
margin-left: 25px;
/* border-bottom: 1px solid #ddd; */
background-color: #fff;
}
.mang-viw-dtl-pg .data-pro-table table td .form-group {
/* border: 1px solid #ddd; */
/* border-bottom: none; */
background-color: #f5f5f5;
}
</style>

<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-6"><p class="rental">View Enquiry </p></div>
            <div class="col-sm-6">
              <a href="<?php echo base_url(); ?>administrator/contactus" class="backtolist">
               <i class="fa fa-arrow-left"></i> Back</a>
              <a class="backtolist replyEnquiry" data-toggle="modal" data-target="#myModalImport_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" style="cursor: pointer;"><i class="fa fa-reply"></i> Reply</a>

               <div class="example-modal adminpopup">
                <div class="modal reply-modal" id="myModalImport_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" role="dialog">
                  <div class="vertical-alignment-helper">
                    <div class="modal-dialog vertical-align-center">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Reply Message</h4>
                        </div>
                        <form id="contactfrm_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="contactfrm_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" method="post">
                          <div class="modal-body">
                            <div id="notification"></div>
                            <div class="form-group">
                              <label>Name</label>
                              <input type="hidden" class="" id="enquiryid_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="enquiry_id" value="<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="enquiryid" >
                              <input type="text" placeholder="Name" class="" id="name_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="name" value="<?php if(!empty($enquiryDetails->name)){echo $enquiryDetails->name;}else{echo '-';}?>" >
                              <input type="hidden" placeholder="Email" class="" id="email_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="email" value="<?php if(!empty($enquiryDetails->email)){echo $enquiryDetails->email;}else{echo '-';}?>" >
                            </div>
                            <div class="form-group">
                              <label>Subject</label>
                              <input type="text" placeholder="Enter subject" class="" id="subject_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="subject" value="Groomedtrail Enquiry" >
                            </div>
                            <div class="form-group">
                              <label>Message</label>
                              <textarea placeholder="Enter message" id="msg_contact_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" name="msg_contact"></textarea>
                            </div>
                          </div>
                          <div class="modal-footer"> <a id="submit_<?php if(!empty($enquiryDetails->id)){echo $enquiryDetails->id;}else{echo '-';}?>" class="btn btn-primary mybuutonclick">Send</a>
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




            </div>
            
          </div>
        </div>
        
        <div class="panel-body">
          <div id="responseMsg"></div>
          <div class=" mang-viw-dtl-pg">
            <div class="row data-pro-table">
              <table>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_type">Message</label>
                      <p>
                        <?php if(isset($enquiryDetails->message)) {echo $enquiryDetails->message; }?>
                      </p>
                      <p style="font-size: 11px;"><span><i class="fa fa-users"></i> <?php if(isset($enquiryDetails->name)){echo $enquiryDetails->name; }?> </span>  <span><i class="fa fa-calendar"></i> <?php if(isset($enquiryDetails->created_date)){$date = date_create($enquiryDetails->created_date); 
                            echo date_format($date, 'd M Y');}?> </span></p>

                    </div>
                     <?php if(isset($replyDetails)) {
                      foreach ($replyDetails as $details) {
                       ?>
                      <div class="form-group reply-enquiry">
                      <p><?php if(isset($details->msg)) {echo $details->msg; }?></p>
                      <p style="font-size: 11px;"><i class="fa fa-calendar"></i> <?php if(isset($details->date)){$date = date_create($details->date); 
                            echo date_format($date, 'd M Y');}?></p>
                    </div>
                     <?php } } ?>
                  </td>
                </tr>
               
                 <?php if(isset($replyDetails)) {
                      foreach ($replyDetails as $details) {
                       ?>
                <tr>
                  <td>
                    
                  </td>
                
                </tr>
                 <?php } } ?>
                <tr>
              </table>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(".mybuutonclick").click(function() {
  var contentPanelId = jQuery(this).attr("id");
 // alert(contentPanelId);
  var arr = contentPanelId.split('_');
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
             $('#msg_contact_'+arr[1]).val('');
             location.reload();
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
</script>