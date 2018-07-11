<?php 
if(isset($user_id) && !empty($user_id)) {
	 $arr_notify = array_merge(notification_all_ty($user_id), notification_a($user_id), trailNotification($user_id), notification_e($user_id),trailNewsFeed($user_id),notification_cls($user_id),trailReportNewsFeed($user_id)); 
// print_r($arr_notify);
}

function compare_func($a, $b)
{
    $t1 = strtotime($a["n_date"]);
    $t2 = strtotime($b["n_date"]);
    return ($t2 - $t1);
}
 usort($arr_notify, "compare_func");
?>
<div class="container-fluid">
<div class="top-header">
	<div class="row">
		<div class="col-sm-6">
			<div class="top-tag-line">
				<p>haven for outdoor adventurers and enthusiasts</p>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="top-nav">
<nav class="main-nav">
  <ul>
    <?php
    $info = $this->session->all_userdata();
    $user_id =$info['user_id'];
    if((isset($user_id)) && (!empty($user_id))){
    ?>
    <li><a  href="<?php echo base_url(); ?>user/dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i>  Dashboard</a></li>
    <li>
      <?php
      $info=$this->session->all_userdata();
      if(!empty($info['social_id'])){ ?>
      <a class="glog" href="javascript:void(0);" onClick="signOut();"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out </a>
      <?php }else{ ?>
      <a class="glog" href="<?php echo base_url()?>logout" > <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out </a>
      <?php } ?>
      <?php } ?>
      
      
      <li class="dropdown invite-friend notify-drop">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>
          <span class="noticount">
            <?php  echo count($arr_notify); ?>
          </span>
        </a>
        <ul class="dropdown-menu mCustomScrollbar">
          <?php if( isset($arr_notify) && !empty($arr_notify)){
           foreach ($arr_notify as $r) {
          ?>
          <li>
            <?php 
            if(isset($r['vac_id']) && !empty($r['vac_id'])){
            if($r['n_type'] == 'rental_approved' || $r['n_type'] == 'rental_rejected' || $r['n_type'] == 'rental_expired'){ ?>
            <span class="profile" onclick="notifiupdate('tbl_notification', <?php if(isset($r['n_type_id'])){echo $r['n_type_id'];}?>,<?php if(isset($user_id)){echo $user_id;}?>,'<?php echo base_url().'user/rentals/view/' ?><?php if(isset($r['vac_id'])){echo $r['vac_id'];}?>')">
              <img src="<?php if(isset($r['vac_imag'])){echo base_url().$r['vac_imag'];}else{echo base_url().'assets/images/no-image.jpg';}?>" >
            </span>
            <a onclick="notifiupdate('tbl_notification', <?php if(isset($r['n_type_id'])){echo $r['n_type_id'];}?>,<?php if(isset($user_id)){echo $user_id;}?>, '<?php echo base_url().'user/rentals/view/' ?><?php if(isset($r['vac_id'])){echo $r['vac_id'];}?>')" href="" >
              <span class="p-name" onclick="notifiupdate('tbl_notification', <?php if(isset($r['n_type_id'])){echo $r['n_type_id'];}?>,<?php if(isset($user_id)){echo $user_id;}?>,'<?php echo base_url().'user/rentals/view/' ?><?php if(isset($r['vac_id'])){echo $r['vac_id'];}?>')">
                <?php if(isset($r['n_type'])){ if($r['n_type'] == 'rental_approved' || $r['n_type'] == 'rental_rejected' || $r['n_type'] == 'rental_expired'){ if($r['n_type'] == 'rental_approved'){echo '<h4>Rental Approved</h4>';}else if($r['n_type'] == 'rental_rejected'){echo '<h4>Rental Rejected</h4>';}else if($r['n_type'] == 'rental_expired'){echo '<h4>Rental Expired</h4>';} ?><?php if(isset($r['vac_name'])){ echo $r['vac_name'];} } }?>
                
              </span>
            </a>
            <?php } }


            if(isset($r['vac_id'])){ if($r['notificate_type'] == 'review'){ ?>

            <span class="profile" onclick="notification(<?php if(isset($r['notification_id'])){echo $r['notification_id']; }?>,'<?php echo base_url().'lodging/'.$r['vac_slag']; ?>')">
               <img src="<?php if(isset($r['vac_imag'])){echo base_url().$r['vac_imag'];}else{echo base_url().'assets/images/no-image.jpg';}?>" >
            </span>
            <a onclick="notification(<?php if(isset($r['notification_id'])){echo $r['notification_id']; }?>,'<?php echo base_url().'lodging/'.$r['vac_slag']; ?>')">
              <span class="p-name">
                <h4><?php if(isset($r['vac_name'])){echo $r['vac_name']; }?></h4>
                <p class="p-link">New Review: <?php if(isset($r['comment'])){
                  $words = explode(" ",$r['comment']);
                  $content = implode(" ",array_splice($words,0,8));
                echo $content; }?></p>
              </span>
            </a>
            <?php } }
           
             if(isset($r['notificate_type'])){ if($r['notificate_type'] == 'forum'){ ?>
            <span class="profile">
            <?php if(isset($r['profile_picture']) && !empty($r['profile_picture'])){
              if(strpos($r['profile_picture'], "http://") !== false OR strpos($r['profile_picture'], "https://") !== false){
                $img = $r['profile_picture'];
              }else
              {
               $img = base_url().$r['profile_picture'];
              }
            }
            else
            {
             $img =  base_url().'assets/images/default.png';
            }
            ?>
            <img src="<?php echo $img; ?>">
            </span>
            <span class="p-name"><h4><?php if(isset($r['fname'])){echo ucfirst($r['fname']); }?> <?php if(isset($r['lname'])){echo ucfirst($r['lname']); }?></h4></span>
           <a href="" onclick="notification(<?php if(isset($r['notification_id'])){echo $r['notification_id']; }?>,'<?php echo base_url().'forum/'.$r['forum_cat_url'].'/'.$r['forum_ques_url']; ?>')">
              <span class="p-name">
                <h4><?php if(isset($r['forum_ques_title'])){echo $r['forum_ques_title']; }?></h4>
                <div class="p-link">New Comment: <?php if(isset($r['forum_comment_description'])){
                echo $r['forum_comment_description']; }?></div>
              </span>
            </a>
            <?php } } ?>
            <?php if(isset($r['classified_id']) && !empty($r['classified_id'])){
             if($r['n_type'] == 'classified_rejected' || $r['n_type'] == 'classified_approved' || $r['n_type'] == 'classified_expired'){ ?>
            <span class="profile" onclick="viewnot('tbl_notification', <?php if(isset($r['n_id'])){echo $r['n_id'];}?>, '<?php echo base_url().'classified/details/'; ?><?php if(isset($r['url_slag'])){echo $r['url_slag'];}?>')">
              <img src="<?php base_url();?><?php if(isset($r['cls_imag'])){echo base_url().$r['cls_imag'];}else{echo base_url().'assets/images/no-image.jpg';}?>">
            </span>
           <!--  <a onclick="viewnot('tbl_notification', <?php if(isset($r['n_id'])){echo $r['n_id'];}?>)" href="<?php echo base_url().'classified/details/'; ?><?php if(isset($r['url_slag'])){echo $r['url_slag'];}?>"> -->

            <a onclick="viewnot('tbl_notification', <?php if(isset($r['n_id'])){echo $r['n_id'];}?>, '<?php echo base_url().'classified/details/'; ?><?php if(isset($r['url_slag'])){echo $r['url_slag'];}?>')" href="">

              <span class="p-name">
                <?php if(isset($r['n_type'])){
                if($r['n_type'] == 'classified_rejected'){
                  echo '<h4>Classified Rejected</h4>';
                }else if($r['n_type'] == 'classified_approved'){
                  echo '<h4>Classified Approved</h4>';
                }else if($r['n_type'] == 'classified_expired'){
                  echo '<h4>Classified expired</h4>';
                }
                if(isset($r['classified_created_by'])){ echo $r['classified_created_by'];}
                } 
                ?>
              </span>
            </a>
            <?php } }?>
            <?php  if(isset($r['saveroute'])){
              if(isset($r['profile_picture']) && !empty($r['profile_picture'])){
            if(strpos($r['profile_picture'], "http://") !== false OR strpos($r['profile_picture'], "https://") !== false){
            $img = $r['profile_picture'];
            }else
            {
            $img = base_url().$r['profile_picture'];
            }
            }
            else
            {
            $img =  base_url().'assets/images/default.png';
            }
            ?>
            <span class="profile" onclick="trailnotification(<?php if(isset($r['s_t_id'])){echo $r['s_t_id']; }?>, '<?php if(isset($r['url'])){echo $r['url']; }?>')">
              <img src="<?php echo $img; ?>">
            </span>
            <span class="p-name" onclick="trailnotification(<?php if(isset($r['s_t_id'])){echo $r['s_t_id']; }?>, '<?php if(isset($r['url'])){echo $r['url']; }?>')">
              <h4><?php if(isset($r['fname'])){echo ucfirst($r['fname']); }?> <?php if(isset($r['lname'])){echo ucfirst($r['lname']); }?> shared a trail with you</h4>
              <p class="p-link"><a href="" onclick="trailnotification(<?php if(isset($r['s_t_id'])){echo $r['s_t_id']; }?>, '<?php if(isset($r['url'])){echo $r['url']; }?>')"><?php if(isset($r['t_name'])){echo $r['t_name']; }?></a></p>
            </span>
            <?php } 
            if(isset($r['event_id'])){ if($r['n_type'] == 'event'){ ?>
            <span class="profile" onclick="viewEvent(<?php if(!empty($r['n_id'])){ echo $r['n_id']; } ?>,'<?php echo base_url().'eventdetail/'.$r['event_id']; ?>');">
              <img src="<?php if(isset($r['event_image_path']) && !empty($r['event_image_path'])){echo base_url().$r['event_image_path'];}else{echo base_url().'assets/images/no-image.jpg';}?>">
            </span>
            <a href="" onclick="viewEvent(<?php if( !empty($r['n_id'])){ echo $r['n_id']; } ?>,'<?php echo base_url().'eventdetail/'.$r['event_id']; ?>');" >
              <span class="p-name" onclick="viewEvent(<?php if(!empty($r['n_id'])){ echo $r['n_id']; } ?>,'<?php echo base_url().'eventdetail/'.$r['event_id']; ?>');">
                <h4>
                Event Updated:  <?php if(isset($r['event_title'])){
                $words1 = explode(" ",$r['event_title']);
                $content1= implode(" ",array_splice($words1,0,6));
                echo $content1; }?></h4>
                <b>Location:</b> <?php if(isset($r['venue_address']) && !empty($r['venue_address'])){ echo $r['venue_address']; } ?>
                <b>Date: </b><?php if(isset($r['event_date']) && !empty($r['event_date'])){ echo date('d M Y',strtotime($r['event_date'])); } ?>
                <span class="p-name"><?php if(isset($r['event_description'])){
                  $words = explode(" ",$r['event_description']);
                  $content = implode(" ",array_splice($words,0,5));
                echo $content; }?></p>
              </span>
            </a>
            <?php   }  } if(isset($r['trail_type'])){
                if($r['trail_type'] == 'trail'){
              if(isset($r['profile_picture']) && !empty($r['profile_picture'])){
            if(strpos($r['profile_picture'], "http://") !== false OR strpos($r['profile_picture'], "https://") !== false){
            $img = $r['profile_picture'];
            }else
            {
            $img = base_url().$r['profile_picture'];
            }
            }
            else
            {
            $img =  base_url().'assets/images/default.png';
            }
            ?>
            <div id="news-feed<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>"><span class="profile" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">
              <img src="<?php echo $img; ?>">
            </span>
            <span class="p-name" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">
              <h4><?php if(isset($r['fname'])){echo ucfirst($r['fname']); }?> <?php if(isset($r['lname'])){echo ucfirst($r['lname']); }?></h4>
              <p class="p-link"><a href="#" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">The trail status of <b><?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?></b> has changed
              </a></p>
            </span></div>
            <?php } } if(isset($r['trail_type'])){
                if($r['trail_type'] == 'trail_report'){
              if(isset($r['profile_picture']) && !empty($r['profile_picture'])){
            if(strpos($r['profile_picture'], "http://") !== false OR strpos($r['profile_picture'], "https://") !== false){
            $img = $r['profile_picture'];
            }else
            {
            $img = base_url().$r['profile_picture'];
            }
            }
            else
            {
            $img =  base_url().'assets/images/default.png';
            }
            ?>
            <div id="news-feed<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>"><span class="profile" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">
              <img src="<?php echo $img; ?>">
            </span>
            <span class="p-name" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">
              <h4><?php if(isset($r['fname'])){echo ucfirst($r['fname']); }?> <?php if(isset($r['lname'])){echo ucfirst($r['lname']); }?></h4>
              <p class="p-link"><a href="#" onclick="viewTrail('<?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?>',<?php if(isset($r['subc_id'])){echo $r['subc_id']; } ?>);">The trail report condition of <b><?php if(isset($r['trail_name'])){echo $r['trail_name']; } ?></b> has changed
              </a></p>
            </span></div>
            <?php } } ?>
          </li>
          <?php } }else{ ?>
          <li>
            <span class="no-noti">
              <p>No notification</p>
            </span>
          </li>
          <?php }  ?>
        </ul>
      </li>
      
      <li><a href="#"><i class="fa fa-newspaper-o"></i></a></li>
    </ul>
  </nav>
			</div>
		</div>
	</div>
</div>
</div>

<!--right-popup-->
