<?php $this->load->view('include/header_css');?>
 <script  src="<?php echo base_url(); ?>assets/js/jquery.countdownTimer.min.js"></script>
<body>
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
                <h3>Classified List</h3>                
                <!-- -->                
                <div class="nw-bsns-btn"><a href="<?php echo  base_url();?>user/addclassified">Add New Classified</a></div>
                <div class="table_data_main">
                  <div class="table-responsive">
                    <table id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">S.No</th>
                          <th>Category</th>
                          <th>Classified Title</th>
                          <th>Description</th>
                          <th>Expiration Time</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $i =1;
                        if(isset($classifiedList)){
                        foreach ($classifiedList as $classified) {   ?>
                        <tr>
                          <td style="display: none;"><?php echo $i; ?></td>
                          <td><?php if(isset($classified->classified_type)){echo $classified->classified_type;}?></td>
                          <td><?php if(isset($classified->classified_created_by)){echo $classified->classified_created_by;}?></td>
                          <td>
                          <?php
                          $words = explode(" ",$classified->classified_description);
                            $content = implode(" ",array_splice($words,0,5));
                            echo $content; ?>
                          </td>
                           <td><div class="cls_timer"><?php if(isset($classified->classified_expired) && !empty($classified->classified_expired)){ ?>
                          <span id="future_date<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>"></span>
                          <?php } ?>
                        </div>
                        <script>
                        $(function(){
                          $('#future_date<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>').countdowntimer({
                            dateAndTime : "<?php if(isset($classified->classified_expired) && !empty($classified->classified_expired)){
                           // $split = explode("/", $classified->classified_expired);
                            //echo $split[2].'-'.$split[1].'-'.$split[0];
                              echo $classified->classified_expired;
                            }?>",
                            size : "lg",
                            regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                            regexpReplaceWith: "$1<sup class='displayformat'>days</sup> / $2<sup class='displayformat'>hours</sup> / $3<sup class='displayformat'>minutes</sup> / $4<sup class='displayformat'>seconds</sup>"
                          });
                        });
                        </script>
                        </td>
                          <td>                          
                            <?php if($classified->renew_status !=1){ ?>

                            <?php  if(isset($classified->classified_expired) && !empty($classified->classified_expired)){ if(date('Y-m-d') >=  $classified->classified_expired) { ?>
                            
                            <span class="status_expired">Expired</span>
                           <?php 
                           }else{
                               echo (($classified->classified_status)==1)?'<span class="cls_published">Published</span>':'<span class="cls_pending">Pending Approval</span>'; 
                             }
                           }else{ ?>
                              <?php if(isset($classified->classified_status)){

                               echo (($classified->classified_status)==1)?'<span class="cls_published">Published</span>':'<span class="cls_pending">Pending Approval</span>';

                                }

                          }
                          }else{ ?>
                           <?php 
                           if(isset($classified->classified_status)){ 
                                if(($classified->classified_status)==1){
                                  echo '<span class="cls_published">Published</span>';
                                }else{
                                  echo '<span class="cls_pending">Pending Approval</span>'; 
                                }
                            }
                            ?>
                           <?php } ?>                            
                          </td>
                          <td>
                               <?php if($classified->renew_status !=1){ ?>
                            <?php  if(isset($classified->classified_expired) && !empty($classified->classified_expired)){  if(date('Y-m-d') >=  $classified->classified_expired) { ?>                           
                           <button class="cls_status_expired" data-toggle="modal" data-target="#myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>">Renew</button>                  
                              <!-- Modal -->
                              <div id="myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" class="modal fade confirmmodel renew_classified" role="dialog">
                                <div class="modal-dialog modal-sm">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Renew Classified</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div id="succ_msg<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" style="display: none;"></div>
                                      <p class="text-center"><h4>You are renewing classified</h4></p>
                                      <div class="btnmain">
                                        <button type="button"  id="btnYesConfirmYesNo" class="btn ConfirmYes" onclick="classified_renew(<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>);" >Click Here</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- Modal -->
                            <?php 
                           }else{ ?>
                               <ul>

                         <!-- <li><a href="<?php echo base_url()."user/classifiedview/".$classified->classified_id; ?>"><i class="fa fa-eye"></i></a></li> -->
                          <li><a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>"><i class="fa fa-eye"></i></a></li>
                          <?php if($classified->classified_status !=1){ ?>
                          <li><a href="<?php echo base_url()."user/editclassified/".$classified->classified_id; ?>"><i class="fa fa-pencil"></i></a></li>
                           <?php } ?>
                          <li><a onClick="deletefuncClas(<?php if(isset($classified->classified_id)){echo $classified->classified_id;} ?>, 'tbl_classified_list', 'Do you want to remove this classified?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li></ul>
                             <?php }
                             }else{ ?>
                          <ul>

                         <!-- <li><a href="<?php echo base_url()."user/classifiedview/".$classified->classified_id; ?>"><i class="fa fa-eye"></i></a></li> -->
                          <li><a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>"><i class="fa fa-eye"></i></a></li>
                          <?php if($classified->classified_status !=1){ ?>
                          <li><a href="<?php echo base_url()."user/editclassified/".$classified->classified_id; ?>"><i class="fa fa-pencil"></i></a></li>
                           <?php } ?>
                          <li><a onClick="deletefuncClas(<?php if(isset($classified->classified_id)){echo $classified->classified_id;} ?>, 'tbl_classified_list', 'Do you want to remove this classified?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li></ul>
                           <?php  }
                            }else{ ?>
                          <ul>
                          <li><a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>"><i class="fa fa-eye"></i></a></li>
                          <!--<li><a href="<?php echo base_url()."user/classifiedview/".$classified->classified_id; ?>"><i class="fa fa-eye"></i></a></li>-->
                          <?php if($classified->classified_status !=1){ ?>
                          <li><a href="<?php echo base_url()."user/editclassified/".$classified->classified_id; ?>"><i class="fa fa-pencil"></i></a></li>
                           <?php } ?>
                          <li><a onClick="deletefuncClas(<?php if(isset($classified->classified_id)){echo $classified->classified_id;} ?>, 'tbl_classified_list', 'Do you want to remove this classified?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li></ul>
                           <?php } ?>  
                          </td>
                        </tr>
                        <?php $i++;  } } ?>
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

<footer class="main_footer">
  <?php $this->load->view('include/main_footer'); ?>
</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright'); ?>
</div>
</body>
</html>

<script >
  function deletefuncClas(del_id, tablename, message){

if (confirm(message))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>user/delete_cat',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             $('#responseMsg').html('<div class="alert alert-success">Delete record successfully</div>').show().fadeOut(5000);                          
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }
    
}

  $(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>
<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);
<?php } ?>

});
function classified_renew(cl_id){
//alert(cl_id);
$.ajax({
    type: "POST",
    url : "<?php echo base_url();?>ajax/classified_renew",
    data: {cl_id:cl_id},
   success:function(data){
       $('#succ_msg'+cl_id).html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Congratulation!</strong> This classified is successfully renewing for 30 days </div>').show().fadeOut(5000);
       location.reload();
    }

    });
}

</script>