<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
.table_data_main {

  overflow-x: scroll;

}
.my-drop-list {
    position: relative;
    padding: 10px;
}
.my-drop-list .page_text {
    width: 38px;
    border-radius: 50%;
    height: 38px;
    overflow: hidden;
    float: left;
    margin-left: 10px;
}
.my-drop-list .page_text img {
    width: 100%;
}
.namet {
    float: left;
    padding: 8px 15px;
}
.my-drop-list ul {
    margin: 0 !important;
    padding: 0;
    top: 48px;
    left: 10px;
    right: 10px;
    border-radius: 0;
    border: none;
}
.my-drop-list input {
    width: 100%;
    margin: 0 auto;
    padding: 5px 10px;
    height: 38px;
}
.my-drop-list ul li {
    width: 100%;
    float: left;
}

#ajax_response{
  border: 1px solid #ccc;
  background: #FFFFFF;
  position: absolute;
  display: none;
  padding: 0;
  top: 50px;
  left: 10px;
  right: 10px;
  z-index: 9999;
}
.list {
  padding:0px 0px;
  margin:0px;
  list-style : none;
}
.list li a{
  text-align : left;
  padding:2px;
  cursor:pointer;
  display:block;
  text-decoration : none;
  color:#000000;
}

.bold{
  font-weight:bold;
  color: #131E9F;
}
div#businessTbl1_filter {
float: right;
}
div#businessTbl1_filter label {
font-weight: 600;
margin: 5px 0px;
}
div#businessTbl1_length {
float: left;
margin: 5px 0px;
}
div#businessTbl1_length label {
font-weight: 600;
}
div#businessTbl2_length{
float: left;
margin: 5px;
}
div#businessTbl2_length label {
font-weight: 600;
}
div#businessTbl2_filter{
float: right;
margin: 5px 0px;
}
div#businessTbl2_filter label {
font-weight: 600;
}
div#businessTbl2_filter label input {
height: 30px;
border: 1px solid #ccc;
font-weight: 400;
}
div#businessTbl2_length select {
padding: 3px;
height: 30px;
width: 140px;
border-radius: 0;
border: 1px solid #ccc;
}
div#businessTbl1_length select {
height: 30px;
width: 140px;
border-radius: 0;
border: 1px solid #ccc;
}
div#businessTbl1_filter input {
padding: 3px;
height: 30px;
border: 1px solid #ccc;
font-weight: 400;
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
                <div id="addBusiness"></div>
                <h3>Saved Routes</h3>
                <!--<div class="nw-bsns-btn">
                  <a href="<?php echo  base_url();?>user/sharedroute">Routes Shared With Me</a>
                </div>  -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#MySavedRoutes" data-toggle="tab"><b>My Saved Routes</b></a></li>
                  <li><a href="#RoutesSharedWithMe" data-toggle="tab"><b>Routes Shared With Me</b></a></li>
                </ul>
                <div class="table_data_main">
                  <div class="table-responsive">
                    <div class="tab-content" >
                      <div class="tab-pane fade in active" id="MySavedRoutes">
                        <table id="businessTbl1" class="table table-striped table-bordered" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="display: none;">s. no</th>
                              <th>Date Created</th>
                              <th>My Route Name</th>
                              <th>Trail Name</th>
                              <th>Total Distance</th>
                              <th>Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i= 1;
                            if(isset($routeList)){
                            foreach ($routeList as $routeList) {
                            ?>
                            <tr id="saveRopute<?php if(isset($routeList->URP_ID)){echo $routeList->URP_ID;} ?>">
                              <td style="display: none;"><?php echo $i; ?></td>
                              <td><?php if(isset($routeList->route_created_date)){$date = date_create($routeList->route_created_date);
                              echo date_format($date, 'd-M-Y');}?></td>
                              <td><?php if(isset($routeList->my_route_name)){echo $routeList->my_route_name;}?></td>
                              <td><?php if(isset($routeList->route_name)){echo preg_replace('/(?<!\d),|,(?!\d{3})/', ', ', $routeList->route_name);}?></td>
                              <td><?php
                                $result='';
                                $input = $routeList->route_dist;
                                $res = explode(',',$input);
                                foreach($res as $row)
                                {
                                $result += $row;
                                }
                                echo $result." miles ";
                                //if(isset($routeList->route_dist)){ echo $routeList->route_dist;}
                                ?>
                              </td>
                              <td>
                                <ul>
                                  <li><a href="#" onclick="myRoutePlan('<?php if(isset($routeList->URP_ID)){echo base64_encode($routeList->URP_ID);}?>','<?php if(isset($routeList->state_name)){echo $routeList->state_name;}?>');"><i class="fa fa-eye">
                                  </i></a></li>
                                  <li><a href="#" class="share-list-row" data-toggle="modal" data-target="#myModal<?php if(isset($routeList->URP_ID) && !empty($routeList->URP_ID)) {echo $routeList->URP_ID;} ?>" onClick="shareFriendList(<?php if(isset($routeList->URP_ID) && !empty($routeList->URP_ID)) {echo $routeList->URP_ID;} ?>, <?php echo $user_id; ?>);"><i class="fa fa-share-alt"></i></a> </li>
                                  <li><a onClick="deleteRoutefunc(<?php if(isset($routeList->URP_ID)){echo $routeList->URP_ID;} ?>, 'tbl_user_route_planning', 'Do you want to remove this route?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                                </ul>
                                <!-- Modal -->
                                <div id="myModal<?php if(isset($routeList->URP_ID) && !empty($routeList->URP_ID)) {echo $routeList->URP_ID;} ?>" class="modal fade shartrailcls" role="dialog">
                                  <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Share My Saved Route<span>(<?php if(isset($routeList->my_route_name) && !empty($routeList->my_route_name)) {echo $routeList->my_route_name;} ?>)</span></h4>
                                      </div>
                                      <div class="trailMsg"></div>
                                      <div class="my-drop-list">
                                        <div id="holder">
                                          <input type="text" name="keyword" id="keyword_<?php if(isset($routeList->URP_ID) && !empty($routeList->URP_ID)) {echo $routeList->URP_ID;} ?>" tabindex="0" class="seach-in keywordName" placeholder="Enter a friend name">
                                        </div>
                                        <div id="ajax_response" class="ajax_response"></div>
                                      </div>
                                      <div id="dataimage"></div>
                                      <form id="shareMyTrail_<?php echo $i; ?>" class="shareMyTrail" name="shareMyTrail" method="post">
                                        <div class="modal-body">
                                          <div class="invite-friend mCustomScrollbar">
                                            <div id="erromsg"></div>
                                            <input type="hidden" name="trail_region_name" id="trail_region_name<?php echo $i; ?>" value="<?php if(isset($routeList->state_name) && !empty($routeList->state_name)) {echo $routeList->state_name;} ?>">
                                            <input type="hidden" name="URP_ID" id="URP_ID<?php echo $i; ?>" value="<?php if(isset($routeList->URP_ID) && !empty($routeList->state_name)) {echo $routeList->URP_ID;} ?>">
                                            <input type="hidden" name="trail_name" id="trail_name<?php echo $i; ?>" value="<?php if(isset($routeList->my_route_name) && !empty($routeList->my_route_name)) {echo $routeList->my_route_name;} ?>">
                                            <input type="hidden" name="shared_u_id" id="shared_u_id<?php echo $i; ?>" value="<?php if(isset($user_id)) {echo $user_id;} ?>">
                                          <ul id="UserDetailC" class="user-details UserDetailC"></ul>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button class="share-mytaril-btn">Share</button>
                                        <button type="submit" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <!-- -->
                            </td>
                            
                          </tr>
                          <?php $i++; } } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane fade" id="RoutesSharedWithMe">
                      <table  id="businessTbl2" class="table table-striped table-bordered" cellspacing="0">
                        <thead>
                          <tr>
                            <th>User Name</th>
                            <th>State</th>
                            <th>Trail Name</th>
                           <!--<th>Url</th> -->
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i =1;
                          if(isset($shared_trail_list)){
                          foreach ($shared_trail_list as $shared_trail) {
                          ?>
                          <tr>
                            <td><?php if(isset($shared_trail->shared_u_id)){
                              $query= $this->db->query("SELECT fname, lname,username,user_id FROM tbl_user_master WHERE user_id=".$shared_trail->shared_u_id."");
                              $result = $query->result();
                              //  print_r($result);
                              if(isset($result[0]->fname) || isset($result[0]->lname)){
                              echo $result[0]->fname.' '.$result[0]->lname;
                              }elseif(isset($result[0]->username)){
                              echo $result[0]->username;
                              }
                            }?></td>
                            <td><?php if(isset($shared_trail->region_name)){echo $shared_trail->region_name;}?></td>
                            <td><?php if(isset($shared_trail->t_name)){echo $shared_trail->t_name;}?></td>
                            <!--<td><a href="<?php if(isset($shared_trail->url)){echo $shared_trail->url;}?>">Show Shared Trail</a></td>-->
                            <td><?php if(isset($shared_trail->created_date)){$date = date_create($shared_trail->created_date);
                            echo date_format($date, 'd-M-Y');}?></td>
                            <td>
                              <ul>
                                <li><a onClick="deletefunc('<?php if(isset($shared_trail->s_t_id)){echo $shared_trail->s_t_id; } ?>', 'tbl_share_my_trails', 'Do you want to remove this shared route?')"
                                class="delete-list-row"><i class="fa fa-trash"></i></a>
                              </li>
                              <li><a href="<?php if(isset($shared_trail->url)){echo $shared_trail->url;}?>" class="url-list-row"><i class="fa fa-eye" aria-hidden="true" style="font-weight: bolder;"></i></a></li>
                            </ul>
                          </td>
                        </tr>
                        <?php $i++; } }?>
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
<!-- Modal -->
<div id="deleteuser" class="modal fade confirmmodel" role="dialog">
<div class="modal-dialog modal-sm">
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-body">
    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
    <p class="text-center"> Do you want to remove this friend from this list?</p>
    <div class="btnmain">
      <button type="button"  id="btnYesConfirmYesNo" class="btn ConfirmYes">Yes</button>
      <button type="button" class="btn ConfirmNo" id="btnNoConfirmYesNo">No</button>
    </div>
  </div>
</div>
</div>
</div>
<!-- Modal -->
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
   // $('#businessTbl1').dataTable();
    $('#businessTbl1').dataTable({ 
        "order": [[ 0, "asc" ]] 
    }); 
} );
$(document).ready(function() {
    //$('#businessTbl2').dataTable();
    $('#businessTbl2').dataTable({ 
        "order": [[ 3, "desc" ]] 
    }); 
} );
function removeuser(id,u_id,ses_u_id,t_name){

    $("#btnYesConfirmYesNo").click(function () {
        var saveroute = 'saveroute';
        $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>ajax/removeShareFriend',
        data:{ u_id:u_id,ses_u_id:ses_u_id,saveroute:saveroute,t_name:t_name},
        success: function(data){

         $('#usrmain'+id).remove();
         $('#deleteuser').modal("hide");

        }
        });
        
    });  
    $("#btnNoConfirmYesNo").click(function () {
        $('#deleteuser').modal("hide");
    });

}

function shareFriendList(id, ses_u_id){
  $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>ajax/shareFriendList',
      data:{ id:id,ses_u_id:ses_u_id },
      success: function(data){
      
           $('.UserDetailC').html(data);
       
      }
  });
}
function deleteRoutefunc(del_id, tablename, message){
if (confirm(message))
{
$.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>user/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
            var trRemove = $('#saveRopute'+del_id);
            trRemove.remove()
            // location.reload();
           }
         }
        });
           return false;
        }else{
           return true;
        }
}
function myRoutePlan(route_plan_id,state_name){
window.location.href = "<?php echo base_url(); ?>home?id="+route_plan_id+"&state_name="+state_name;  
}

 $(document).on('submit','.shareMyTrail',function(event) {
    event.preventDefault();
    var string = $(this).attr('id')
    var array = string.split('_');

   // var i= $(this).attr('id')
    var routeid = $('#URP_ID'+array[1]).val();
    var trail_name = $('#trail_name'+array[1]).val();
    var shared_u_id = $('#shared_u_id'+array[1]).val();
    var trail_region_name = $('#trail_region_name'+array[1]).val();
    var saveroute = 'saveroute';
    var val = [];
        $('.check_my_trail:checked').each(function(i){
          val[i] = $(this).val();
        });
    if(val.length>0){

         // if (confirm('Are you sure share this trail your friends'))
         // {
          $.ajax({
              type:"POST",
              dataType:"json",
              url:"<?php echo base_url(); ?>ajax/sharePrivateTrail",
              data: {u_id:val,trail_name:trail_name,shared_u_id:shared_u_id,trail_region_name:trail_region_name,saveroute:saveroute,routeid:routeid},
              success: function(data) {
                if(data == 1){
                  $('.trailMsg').html('<div class="alert alert-success">Share trail Successfully</div>').show().fadeOut(3000);
                  $('#myModal'+routeid).modal('hide');
                  // $('#subcri-main-modalID').modal('hide');
                  setTimeout(function(){ $(".close").click(); }, 3000);
                  $('.shareMyTrail')[0].reset();
                   location.reload();
                }
              }

            });
          return false;
       // }else{
       //    return true;
      //  }
    }else{

      $('.trailMsg').html('<div class="alert alert-danger">please enter friend name</div>').show().fadeOut(5000);
    }
    
 });


</script>
<script>
/*
 cc:scriptime.blogspot.in
 edited by :midhun.pottmmal
*/
$(document).ready(function(){
  $(document).click(function(){
    $(".ajax_response").fadeOut('slow');
  });
 $(".keywordName").focus();
 // var offset = $(".keywordName").offset();
  //console.log(offset);
 // var width = $("#keyword").width()-2;
 // $("#ajax_response").css("left",offset.left); 
 // $("#ajax_response").css("width",width);
  $(".keywordName").keyup(function(event){
    var tt =  $('#'+$(this).attr('id')).val();

   //alert(event.keyCode);
     var keyword = tt;
     if(keyword.length)
     {
       if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
       {
         $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>ajax/GetUserList",
           data: "data="+keyword,
           success: function(msg){  
          if(msg != 0)
            $(".ajax_response").fadeIn("slow").html(msg);
          else
          {
            $(".ajax_response").fadeIn("slow"); 
            $(".ajax_response").html('<div style="text-align:left;color:#000">No Matches Found</div>');
          }
           }
         });
       }
       else
       {
        switch (event.keyCode)
        {
         case 40:
         {
            found = 0;
            $("li").each(function(){
             if($(this).attr("class") == "selected")
              found = 1;
            });
            if(found == 1)
            {
            var sel = $("li[class='selected']");
            sel.next().addClass("selected");
            sel.removeClass("selected");
            }
            else
            $("li:first").addClass("selected");
           }
         break;
         case 38:
         {
            found = 0;
            $("li").each(function(){
             if($(this).attr("class") == "selected")
              found = 1;
            });
            if(found == 1)
            {
            var sel = $("li[class='selected']");
            sel.prev().addClass("selected");
            sel.removeClass("selected");
            }
            else
            $("li:last").addClass("selected");
         }
         break;
         case 13:
          $(".ajax_response").fadeOut("slow");
          $(".keywordName").val($("li[class='selected'] a").text());
         break;
        }
       }
     }
     else
      $(".ajax_response").fadeOut("slow");
  });


  $(".ajax_response").mouseover(function(){
    $(this).find("li a:first-child").mouseover(function () {
        $(this).addClass("selected");
    });
    $(this).find("li a:first-child").mouseout(function () {
        $(this).removeClass("selected");
    });
    $(this).find("ul").click(function () {
      $(this).find("li a:first-child").click(function () {
        $(".keywordName").val($(this).text());
      });
        //$('.UserDetailC').html($(this).html());
        $(".ajax_response").fadeOut("slow");
    });
  });
  $(document).on('click','.list', function(){
        $('.UserDetailC').append($(this).html());
       // $(".ajax_response").fadeOut("slow");
    });

});
</script>