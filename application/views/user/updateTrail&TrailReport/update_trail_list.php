<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
.table_data_main {
  overflow-x: scroll;
}
a.unsubcribe-list-row {
    background-color: #000;
    color: #fff;
    font-size: 11px;
    padding: 5px !important;
    border-radius: 3px;
}

</style>
<header class="navigation">
  <div class="top-bar">
    <?php $this->load->view('include/top_header');?>
  </div>
  
  <nav class="navbar">
  <?php $this->load->view('include/nav_header'); ?>
    </nav>
</header>

<div class="wrapper">
<section class="profile-main-sec">
    <div class="container">
      <div class="pms-bg">
        <div class="row">
         <?php $this->load->view('user/leftsidebar') ?>
          <div class="col-md-9 col-sm-8">
            <div class="business-detail-sec">
            <div class="business-frm">
              <div id="responseMsg"></div>
               <ul class="nav nav-tabs">
                 <li class="active"><a href="#mytrailupdates" data-toggle="tab"><b>My Trail Updates</b></a></li>
                 <li><a href="#mytrailreports" data-toggle="tab"><b>My Trail Reports</b></a></li>
                 <li><a href="#mysubscriptions" data-toggle="tab"><b>My Subscriptions</b></a></li>
                 <li><a href="#myEventSubscriptions" data-toggle="tab"><b>My Event Subscriptions</b></a></li>
                 <li><a href="#MyForumSubscriptions" data-toggle="tab"><b>My Forum Subscriptions</b></a></li>
              </ul>
             <!-- -->
             <div class="table_data_main">
               <div class="table-responsive">
                <div class="tab-content" >
                  <div class="tab-pane fade in active" id="mytrailupdates">
                    <table id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                          <tr><th>Trail Name</th>
                              <th>Trail Description</th>
                              <th>Trail Status</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if(isset($trailList)){
                              foreach ($trailList as $trailList) {
                                      $words = explode(" ",$trailList->trail_description);
                                      $content = implode(" ",array_splice($words,0,10)); ?>
                              <tr>
                                  <td><?php if(isset($trailList->trail_name)){echo $trailList->trail_name;}?></td>
                                  <td><?php if(isset($content)){echo $content;}?></td>
                                  <td><?php if(isset($trailList->trail_status)){
                                    if($trailList->trail_status == 0){
                                       echo 'Open';
                                    }else if($trailList->trail_status == 1){
                                       echo 'Closed';
                                    }else if($trailList->trail_status == 2){
                                       echo 'Caution';
                                    }else if($trailList->trail_status == 3){
                                       echo 'Pending Approval';
                                    }

                                   
                                    }?></td>
                                    <td><?php if(isset($trailList->status)){
                                      if($trailList->status == 0){
                                         echo 'Pending';
                                      }else if($trailList->status == 1){
                                         echo 'Approved';
                                      }
                                    }?></td>

                                  <td>
                                    <ul>
                                      <li><a href="<?php echo base_url(); ?>user/updatetrail/edit/<?php if(isset($trailList->trail_report_id)){echo $trailList->trail_report_id;} ?>" title="Edit"><i class="fa fa-pencil"></i></a></li>
                                      <li><a onClick="deletefunc(<?php if(isset($trailList->trail_report_id)){echo $trailList->trail_report_id;} ?>, 'tbl_trail_report', 'Do you want to remove this trail status?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                 </td>
                              </tr>    
                         <?php } }?>
                          
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="mytrailreports">
                    <table id="businessTbl1" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                          <tr><th>County Name</th>
                              <th>Trail Description</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if(isset($trailReportList)){
                              foreach ($trailReportList as $trailReportList) {
                                      $words = explode(" ",$trailReportList->trail_report_conditions);
                                      $content = implode(" ",array_splice($words,0,10)); ?>
                              <tr>
                                  <td><?php if(isset($trailReportList->CountyID)){echo $trailReportList->CountyID;}?></td>
                                  <td><?php if(isset($content)){echo $content;}?></td>
                                    <td><?php if(isset($trailReportList->trail_report_status)){
                                      if($trailReportList->trail_report_status == 0){
                                         echo 'Pending';
                                      }else if($trailReportList->trail_report_status == 1){
                                         echo 'Approved';
                                      }
                                      else if($trailReportList->trail_report_status == 2){
                                         echo 'Rejected';
                                      }
                                    }?></td>

                                  <td>
                                    <ul>
                                      <li><a href="<?php echo base_url(); ?>user/updatetrailreport/edit/<?php if(isset($trailReportList->ID)){echo $trailReportList->ID;} ?>" title="Edit"><i class="fa fa-pencil"></i></a></li>
                                      <li><a onClick="deletefunc(<?php if(isset($trailReportList->ID)){echo $trailReportList->ID;} ?>, 'trail_report_user_update', 'Do you want to remove this trail report?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                                    </ul>
                                 </td>
                              </tr>    
                         <?php } }?>
                          
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="mysubscriptions">
                    <table id="businessTbl2" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Trail Type</th>
                              <th>Trail/County  Name</th>
                              <th>Subscription Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if(isset($subscriptionsList)){
                              foreach ($subscriptionsList as $subscriptionsList) {
                                     ?>
                              <tr>
                                  <td><?php if(isset($subscriptionsList->trail_type)){
                                    if($subscriptionsList->trail_type =='trail_report'){
                                      echo 'Trail Report';
                                    }else{
                                     echo ucfirst($subscriptionsList->trail_type);
                                    }
                                   }?></td>
                                  <td><?php if(isset($subscriptionsList->trail_name)){echo $subscriptionsList->trail_name;}?></td>
                                  <td><?php if(isset($subscriptionsList->subc_date)){$date = date_create($subscriptionsList->subc_date);  echo date_format($date, 'd-M-Y');}?></td>
                                   <td><ul>
                                      <li><a onClick="deletefunc(<?php if(isset($subscriptionsList->subc_id)){echo $subscriptionsList->subc_id;} ?>, 'tbl_subscribe_user', 'Do you want to remove this?')" class="unsubcribe-list-row">Unsubscribe </a></li>
                                    </ul></td>
                              </tr>    
                         <?php } }?>
                          
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="myEventSubscriptions">
                    <table id="businessTbl3" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Event title</th>
                              <th>Event Date</th>
                              <th>Subscription Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if(isset($eventSubscribeList)){
                              foreach ($eventSubscribeList as $eventSubscribe) {
                                     ?>
                              <tr>
                                  <td><?php if(isset($eventSubscribe->event_title)){ echo $eventSubscribe->event_title; }?></td>
                                  <td><?php if(isset($eventSubscribe->event_date)){ 
                                    $date = date_create($eventSubscribe->event_date);  echo date_format($date, 'd-M-Y');
                                     }?></td>
                                  <td><?php if(isset($eventSubscribe->eve_sub_date)){$date = date_create($eventSubscribe->eve_sub_date);  echo date_format($date, 'd-M-Y');}?></td>
                                   <td><ul>
                                      <li><a onclick="event_sub_fun(<?php if(isset($eventSubscribe->event_id)){ echo $eventSubscribe->event_id; }?>, <?php echo $user_id; ?>, 'unsub');" class="unsubcribe-list-row">Unsubscribe </a></li>
                                    </ul></td>
                              </tr>    
                         <?php } }?>
                          
                      </tbody>
                    </table>
                  </div>
                   <div class="tab-pane fade" id="MyForumSubscriptions">
                    <table id="businessTbl4" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Forum Category</th>
                              <th>Forum Tpoic</th>
                              <th>Subscription Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if(isset($ForumSubscribeList)){
                              foreach ($ForumSubscribeList as $ForumSubscribe) {
                               // print_r($ForumSubscribe); ?>
                              <tr>
                                  <td><?php if(isset($ForumSubscribe->forum_cat_name)){ echo $ForumSubscribe->forum_cat_name; }?></td>
                                  <td><?php if(isset($ForumSubscribe->forum_ques_title)){ echo $ForumSubscribe->forum_ques_title; }?></td>
                                  <td><?php if(isset($ForumSubscribe->date)){$date = date_create($ForumSubscribe->eve_sub_date);  echo date_format($date, 'd-M-Y');}?></td>
                                   <td><ul>
                                      <li><a onclick="forum_sub_fun(<?php if(isset($ForumSubscribe->forum_subscribe_id)){ echo $ForumSubscribe->forum_subscribe_id; }?>, <?php echo $user_id; ?>, 'unsub');" class="unsubcribe-list-row">Unsubscribe </a></li>
                                    </ul></td>
                              </tr>    
                         <?php } }?>
                          
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
              </div>
              <!-- -->
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>

</div>
    
<footer class="main_footer">
   <?php $this->load->view('include/main_footer'); ?>


</footer>
<div class="copy-right">
<?php $this->load->view('include/copyright'); ?>
</div>

</body>
</html>
<script type="text/javascript">

$(document).ready(function() {
    $('#businessTbl1').dataTable();
} );
$(document).ready(function() {
    $('#businessTbl2').dataTable();
} );
$(document).ready(function() {
    $('#businessTbl3').dataTable();
} );
$(document).ready(function() {
    $('#businessTbl4').dataTable();
} );

function event_sub_fun(event_id,user_id,sub_type) {
    $("#ajax_favorite_loddder").show();
    jQuery.ajax({
    type: "POST",
    url : "<?php echo base_url();?>ajax/event_sub_fun",
    data: { event_id: event_id,user_id:user_id,sub_type:sub_type },
    success:function(data){
      $("#ajax_favorite_loddder").hide();
      if(data == 1){
           //$('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully added to this event.You will now receive updates on the latest news.</div>').show().fadeOut(10000);
         //  $('#eventSub a').text('Unsubscribe');
         location.reload();
        }else{
          //$('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully unsubscribe for this event.</div>').show().fadeOut(10000);
        //  $('#eventSub a').text('Subscribe');
        location.reload();
//
        }
    }

    });
    
  }

  function forum_sub_fun(forum_subscribe_id,user_id,sub_type) {
    $("#ajax_favorite_loddder").show();
    jQuery.ajax({
    type: "POST",
    url : "<?php echo base_url();?>ajax/forum_sub_fun",
    data: { forum_subscribe_id: forum_subscribe_id,user_id:user_id,sub_type:sub_type },
    success:function(data){
      $("#ajax_favorite_loddder").hide();
      if(data == 1){
           //$('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully added to this event.You will now receive updates on the latest news.</div>').show().fadeOut(10000);
         //  $('#eventSub a').text('Unsubscribe');
         location.reload();
        }else{
          //$('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully unsubscribe for this event.</div>').show().fadeOut(10000);
        //  $('#eventSub a').text('Subscribe');
        location.reload();
//
        }
    }

    });
    
  }
</script>