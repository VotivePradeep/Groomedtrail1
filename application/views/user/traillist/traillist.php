<?php $this->load->view('include/header_css');?>
<!-- facebbok share --> 
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
            <div class="business-frm kml-form-main">
              <div id="responseMsg"></div>
              <h3>My Trails</h3>
               <div class="nw-bsns-btn">
                <a href="<?php echo  base_url();?>user/mymap/uploadkml">Upload New KML</a>
               <!--  <a href="<?php echo  base_url();?>user/mymap">My KML Files</a> -->
                <a href="<?php echo  base_url();?>user/sharedtrail">Boondocking Shared With Me</a></div>
               
            <!-- -->
               <div class="table_data_main">
               <div class="table-responsive">
                <table  id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                   <tr>
                      
                      <th>State</th>
                      <th>Title</th>
                      <th>Trail Name</th>
                      <th>Description</th>
                      <th>Upload Date</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php 
                  $i =1;
                  if(isset($kmlList)){
                      foreach ($kmlList as $poi) { 
                         ?>
                      <tr id="dele<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>">
                           
                           <td><?php if(isset($poi->region_name)){echo $poi->region_name;}?></td>
                           <td><?php if(isset($poi->trail_id)){
                            $gettrailTitle = $this->model->get_row('tbl_trail_master', array('trail_type_id' => $poi->trail_id));
                            if(isset($gettrailTitle->title)){echo $gettrailTitle->title; }

                          }?></td>
                           <td><?php if(isset($poi->klm_trail_name)){echo $poi->klm_trail_name;}?></td>
                           <td><p class="trailDescriptionCls" id="<?php echo $i.'trailDesc'.$i;?>" >
                           <?php if(isset($poi->status) && $poi->status == 1){
                              echo $poi->trail_description;
                            }else{
                                  if(isset($poi->trail_dscrptn)){ echo $poi->trail_dscrptn; }
                              }?>
                           </p></td>
                           <td><?php if(isset($poi->trail_created_date)){$date = date_create($poi->trail_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                           <td>
                          <ul>
                            <li><a href="#" onclick="myRoutePlan('<?php if(isset($poi->trail_id)){echo base64_encode($poi->trail_id);}?>','<?php if(isset($poi->region_name)){echo $poi->region_name;}?>');"><i class="fa fa-eye"></i></a></li>

                            <li><a href="#" onclick="delete_trail('<?php if(isset($poi->trail_id)){ echo $poi->trail_id;}?>');" class="delete-list-row"><i class="fa fa-trash"></i></a></li>

                            <li><a href="#" class="share-list-row" data-toggle="modal" data-target="#myModal<?php echo $i; ?>"  onClick="shareFriendList('<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>', <?php echo $user_id; ?>);" ><i class="fa fa-share-alt"></i></a></li>
                            
                         </ul>

                          <!-- Modal -->
                          <div id="myModal<?php echo $i; ?>" class="modal fade shartrailcls" role="dialog"> 
                         <!-- <div id="myModal<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo str_replace(' ', '', str_replace("'","",$poi->klm_trail_name));} ?>" class="modal fade shartrailcls" role="dialog"> -->
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Share My Trail <span>(<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>)</span></h4>
                                </div>
                                
                                <div class="my-drop-list">

                                <div id="holder"> 
                                <input type="text" name="keyword" id="keyword_<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo str_replace(' ', '', str_replace("'","",$poi->klm_trail_name));} ?>" tabindex="0" class="seach-in keywordName" placeholder="Enter a friend name">
                                </div>
                                <div id="ajax_response" class="ajax_response"></div>
                                </div>
                                <div id="dataimage"></div>
                                <form id="shareMyTrail_<?php echo $i; ?>" class="shareMyTrail" name="shareMyTrail" method="post">
                                  <div class="modal-body">
                                    <div class="trailMsg"></div>
                                    <div class="invite-friend mCustomScrollbar">
                                      <div id="erromsg"></div>
                                      <input type="hidden" name="trail_region_name" id="trail_region_name<?php echo $i; ?>" value="<?php if(isset($poi->region_name) && !empty($poi->region_name)) {echo $poi->region_name;} ?>">
                                        <input type="hidden" name="trail_name" id="trail_name<?php echo $i; ?>" value="<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>">
                                        <input type="hidden" name="trail_id" id="trail_id<?php echo $i; ?>" value="<?php if(isset($poi->id) && !empty($poi->id)) {echo $poi->id;} ?>">
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
                 <?php $i++; } }?>
                </tbody>
               </table>
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
        <p class="text-center">Do you want to remove this friend from this list?</p>
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
$(document).on('click', '.removeuser',function(){
  var arr = $(this).attr('id').split('_');
  $("#btnYesConfirmYesNo").click(function () {
    $('#usrmain'+arr[1]).remove();
    $('#deleteuser').modal("hide");
  });
});

function delete_trail(trail_id){
   $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>user/delete_trail',
        data:{ trail_id:trail_id},
        success: function(data){
          if(data == 1){
            location.reload();
          }
        }
    });
}
function removeuser(id,u_id,ses_u_id,t_name){

    $("#btnYesConfirmYesNo").click(function () {
    var saveroute = 'privatetrail';
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
function shareFriendList(t_name, ses_u_id){
  $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>ajax/shareFriendListPrivateTrail',
      data:{ t_name:t_name,ses_u_id:ses_u_id },
      success: function(data){
      
           $('.UserDetailC').html(data);
       
      }
  });
}
function myRoutePlan(route_plan_id,state_name){
  window.location.href = "<?php echo base_url(); ?>home?tid="+route_plan_id+"&state_name="+state_name;  
}

function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>user/changeStatus",{'id':id ,'status':status,'tablename':'tbl_news'},function(data){
    
    if(data){

      if($('#status_'+id).text() == 'Publish'){      
        $('#status_'+id).text('Unpublish'); 
        $('#status_'+id).css( "background-color", "#ff471a" );
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Publish');
        $('#status_'+id).css( "background-color", "#009933" );
        $('#status_'+id).removeClass('text-success').addClass('text-danger'); 
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',1)');
      }
      $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}

$(document).ready(function (){
    var table = $('#businessTbl').DataTable();
    $('#businessTbl .dataTables_empty').text('No trails uploaded yet');
});
 $(document).on('submit','.shareMyTrail',function(event) {
    event.preventDefault();
    var string = $(this).attr('id')
    var array = string.split('_');

   // var i= $(this).attr('id')
    var trail_name = $('#trail_name'+array[1]).val();
    var shared_u_id = $('#shared_u_id'+array[1]).val();
    var trail_region_name = $('#trail_region_name'+array[1]).val();
    var trail_id = $('#trail_id'+array[1]).val();
    var saveroute = 'privatetrail';
    var val = [];
        $('.check_my_trail:checked').each(function(i){
          val[i] = $(this).val();
        });
         //if (confirm('Are you sure share this trail your friends'))
         // {
    $.ajax({
          type:"POST",
          dataType:"json",
          url:"<?php echo base_url(); ?>ajax/sharePrivateTrail",
          data: {u_id:val,trail_name:trail_name,shared_u_id:shared_u_id,trail_region_name:trail_region_name,saveroute:saveroute,trail_id:trail_id},
          success: function(data) {
            if(data == 1){
              $('.trailMsg').html('<div class="alert alert-success">Share trail Successfully</div>').show().fadeOut(2000);
              $('#myModal'+array[1]).modal('hide');
              // $('#subcri-main-modalID').modal('hide');
              setTimeout(function(){ $(".close").click(); }, 3000);
              $('.shareMyTrail')[0].reset();
               location.reload();
            }
          }

        });
         return false;
        //}else{
        //   return true;
        //}
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
  $(".keywordName").keyup(function(event){
    var tt =  $('#'+$(this).attr('id')).val();
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