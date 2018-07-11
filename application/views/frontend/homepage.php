<?php 

$url = "https:/".$_SERVER['REQUEST_URI'];
$query_str = parse_url($url, PHP_URL_QUERY);
parse_str($query_str, $query_params);

?>
<?php $this->load->view('include/header_css');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/home.css">
<body>
<header class="navigation">
<?php  
//$arr_nt = array_merge(notification_all_ty($user_id), notification_a($user_id), trailNotification($user_id), notification_e($user_id),trailReportNewsFeed($user_id),trailNewsFeed($user_id),notification_cls($user_id)); 
$arr_nt = array_merge(home_trailNotification($user_id),home_trailReportNewsFeed($user_id),home_trailNewsFeed($user_id));
function comp_func($a, $b)
{
    $t1 = strtotime($a["n_date"]);
    $t2 = strtotime($b["n_date"]);
    return ($t2 - $t1);
}
 usort($arr_nt, "comp_func");
?>  <div class="top-bar">
    <?php $this->load->view('include/top_header');?>
  </div>
  <nav class="navbar">
    <?php $this->load->view('include/nav_header.php'); ?>
  </nav>
</header>
<section class="top-link mysubmenu">
  <div class="container">
    <div class="row">
      <div class="center-top-head">
        <div class="col-md-3 col-sm-3">
          <div class="search-form">
            <form id="searchLatLang" name="searchLatLang" method="post">
              <input type="text" class="seach-in" id="country" autocomplete="off" name="country" class="form-control" placeholder="Enter a location for trail info and weather" />
             <!--18-12 <ul class="dropdown-menu txtcountry" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownCountry">
              </ul> 18-12-->
              <input name="lat" class="MapLat" id="lat"  type="hidden" placeholder="Latitude" style="width: 161px;" readonly>
              <input name="lang" class="MapLon" id="lng"  type="hidden" placeholder="Longitude" style="width: 161px;" readonly>
            </form>
          </div>
        </div>
        <div class="col-md-2 col-sm-2">
          <div class="trail-content trail-content-open">
            <select id="region_name_drop">
              <option value="">Select A State</option>
              <?php $query = $this->db->query('SELECT DISTINCT state_name FROM tbl_state where state_status=1');
              $region = $query->result();
              if(isset($region)){
              foreach ($region as $regionName) { ?>
              <option value="<?php echo $regionName->state_name; ?>" <?php if(isset( $query_params['state_name'])){
                if($regionName->state_name==$query_params['state_name']) echo 'selected="selected"';
              }?>><?php echo $regionName->state_name; ?></option>
              <?php } } ?>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-sm-3">
          <ul>
            <li class="chk-head">
              <div class="main-chk">
                <input  type="checkbox" name="trailReportName" id="trailReport" class="trailNameCls check_trail_reena11" onClick="createTrailReport();" />
                <label for="trailReport"></label>
              </div>
              <span class="trail-nm">
                Trail Report
              </span>
            </li>
            <li class="chk-head">
              <div class="main-chk">
                <input  type="checkbox" name="s_h_groomed_trail" id="s_h_groomed_trail"/>
                <label for="s_h_groomed_trail" ></label>
              </div>
              <span class="trail-nm">Show Groomed Trails</span>
            </li>
          </ul>
        </div>
        <div class="col-md-2 col-sm-2">
          <div class="trail-content trail-content-open">
            <select id="boondocking_trails" onChange="location = this.value;"> 
              <option value="">Select Boondocking Trails</option>
              <?php if(isset($boondockingTrails)){
              foreach ($boondockingTrails as $bTrails) { ?>
              <option value="<?php  echo base_url().'home?tid='.base64_encode($bTrails->trail_type_id).'&state_name='.$bTrails->region_name; ?>" <?php if(isset($_GET['tid'])){
                  if($bTrails->trail_type_id == base64_decode($_GET['tid'])) {
                  echo 'selected="selected"';
                  }
                  }?>>
                  <?php if(!empty($bTrails->title)){ echo $bTrails->title;}else{ $bTrails->klm_trail_name;} ?>
                </option>
              <?php } } ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-sm-2">
          <div class="forum-category">
            <div class="trail-content trail-content-open">
              <select name="SavedRoutes" id="mySavedRoutes" onChange="location = this.value;">
                <option value="<?php  echo base_url().'home'; ?>">Saved Routes </option>
                <?php if(isset($routeList)) {
                foreach ($routeList as $myroute) { ?>
                <option value="<?php  echo base_url().'home?id='.base64_encode($myroute->URP_ID).'&state_name='.$myroute->state_name; ?>" <?php if(isset($_GET['id'])){
                  if($myroute->URP_ID==base64_decode($_GET['id'])) {
                  echo 'selected="selected"';
                  }
                  }?>>
                  <?php if(isset($myroute->my_route_name)){echo $myroute->my_route_name; } ?>
                </option>
                <?php }  } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<input type="hidden" name="trailreport" class="trailreport">
<input type="hidden" name="trailColorMouseOver" class="trailColorMouseOver" value="0">
<input type="hidden" name="trailColorMouseOut" class="trailColorMouseOut" value="0">
<input type="hidden" name="MouseOutColor" class="MouseOutColor" value="0">
<input type="hidden" name="newlat" class="newlat">
<input type="hidden" name="newlng" class="newlng">
<div class="wrapper">
  <section class="map-sec">
    <div id="mySidenav" class="sidenav">      
      <div class="main-boxs">
        <h3> POI </h3>
        <div class="button-opn-cls">
          <a href="javascript:void(0)" class="closebtn dp-no" onClick="closeNav()">
            <i class="fa fa-chevron-left"></i> <label> POI </label>
          </a>
           <span style="font-size:30px;cursor:pointer" onClick="openNav()" id="open-nav-id" class="side-bar">
             <i class="fa fa-chevron-right"></i> <label> POI </label>
          </span>
        </div>
        <div class="alert alert-warning" id="msgBox" style="display: none;"></div>
         
        <div class="side_bar_content mCustomScrollbar">
          <div class="route-select route-normal">
            <?php  
            if(isset($POIList)){
              foreach ($POIList as $trails) { 
                if($trails->trail_name != 'Trail' && $trails->trail_name != 'Trail Report'){
                ?>
              <div class="chk-head">
                <div class="main-chk">
                   <input  type="checkbox" name="trailName[]" id="trail<?php if(isset($trails->trail_id)){ echo $trails->trail_id; }?>" class="trailNameCls check_trail_reena" onClick="trail_detail();" value="<?php if(isset($trails->trail_name)){ echo $trails->trail_name; }?>"/>

                  <label for="trail<?php if(isset($trails->trail_id)){ echo $trails->trail_id; }?>"></label>
                </div>
                <span class="trail-nm"><?php if(isset($trails->trail_name)){ echo $trails->trail_name; }?>
                <img src="<?php echo base_url(); ?><?php if(isset($trails->trail_marker)){ echo $trails->trail_marker; }?>" >
                </span>
              </div>
              <?php } } } ?>
          </div>
        </div>  
      </div>             
    </div>

  <div id="map" class="map-sec-side"></div>
  <div id="infowindow-content" style="display: none;" class="info-windo"><span id="place-address"></span><br></div>
  
  <div id="mySidenav2" class="sidenav2">
    <a href="javascript:void(0)" class="" onClick="closeNav2()" id="clse-nav">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
       <article>News Feed</article>
    </a>
    <span style="cursor:pointer" onClick="openNav2()" id="open-nav-id2" class="side-bar-2">
        <i class="fa fa-chevron-left"></i>
        <article>News Feed</article>
    </span> 
    <div class="side-user-actvi mCustomScrollbar" data-mcs="dark">
      <div class="news-feed-heading">
        <h3>News Feed</h3>
      </div>
      <div class="trail_type_cls">
      </div>
        <div class="panel-body">
          <div class="tab-content">
            <div class="news-feed-sec" >
              <?php 
              if(isset($arr_nt) && !empty($arr_nt)){ 
                 foreach ($arr_nt as $rr) {  ?>
               
        
              <?php /*
                if(isset($rr['classified_status'])){
                  if($rr['classified_status'] != 0){
                    if(isset($rr['n_date']) && !empty($rr['n_date'])){ 
                       if($rr['n_date'] < date('Y-m-d')){

                      }else{
                  ?>    
                      <div class='news-feed-sub classified' id="removeClass_<?php if(isset($rr['classified_id']) && !empty($rr['classified_id'])){ echo $rr['classified_id']; } ?>">
                      <a href="#" onclick="viewClassified(<?php if(isset($rr['classified_id']) && !empty($rr['classified_id'])){ echo $rr['classified_id']; } ?>);" class="remove_noti_classified"><i class="fa fa-times"></i></a>
                      <h3><?php if(isset($rr['classified_created_by']) && !empty($rr['classified_created_by'])){ echo $rr['classified_created_by']; } ?></h3>
                      <?php if($rr['classified_status'] == 1){ ?>
                       <p>
                      <?php echo "Your classified ad has been approved. It will expire on ";?><?php if(isset($rr['n_date']) && !empty($rr['n_date'])){
                           
                           echo $CDate = date('d M Y',strtotime($rr['n_date']));
                            }?> </p> 
                        <?php }
                          if($rr['classified_status'] == 2){ 
                            echo "<p>Your classified ad has been rejected.</p>";
                         } ?>
                      <p><a href="<?php echo base_url().'classified/details/'.$rr['url_slag']; ?>"> View it here</a></p>
                      
                    </div>
              <?php }  }  }  }  ?>

               <?php if(isset($rr['n_type'])){ if($rr['n_type'] == 'rental_approved' || $rr['n_type'] == 'rental_rejected' || $rr['n_type'] == 'rental_expired'){ ?>
           <div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['n_id'])){echo $rr['n_id']; }?>">
               <a href="#" onclick="notifiupdate1('tbl_notification', <?php if(isset($rr['n_type_id'])){echo $rr['n_type_id'];}?>,<?php if(isset($user_id)){echo $user_id;}?>,<?php if(isset($rr['n_id'])){echo $rr['n_id']; }?>)")" class="remove_noti_classified"><i class="fa fa-times"></i></a>
              <div class="news-feed-head">
                <a href="<?php echo base_url().'user/rentals/view/' ?><?php if(isset($rr['vac_id'])){echo $rr['vac_id'];}?>"><div class="profile-pic">
                 <img src="<?php if(isset($rr['vac_imag'])){echo base_url().$rr['vac_imag'];}else{echo base_url().'assets/images/no-image.jpg';}?>" >
                </div></a>
                <div class="main-header">
                  <h3><?php if(isset($rr['vac_name'])){ echo $rr['vac_name'];} ?></h3>
                  <p><span><?php if(isset($rr['fname'])){echo $rr['fname']; } ?> <?php if(isset($rr['lname'])){echo $rr['lname']; } ?></span></p>
                </div>
               </div>
              <div class="news-feed-cont">
               <p  style="color:#000;"><?php if(isset($rr['n_type'])){ if($rr['n_type'] == 'rental_approved' || $rr['n_type'] == 'rental_rejected' || $rr['n_type'] == 'rental_expired'){ if($rr['n_type'] == 'rental_approved'){echo '<b>Rental Approved</b><br>';}else if($rr['n_type'] == 'rental_rejected'){echo '<b>Rental Rejected</b><br>';}else if($rr['n_type'] == 'rental_expired'){echo '<b>Rental Expired</b><br>';} ?><?php if(isset($rr['vac_name'])){ echo $rr['vac_name'];} } }?></p>
              </div>
              <div class="news-feed-date">
                <span><i class="fa fa-calendar"></i> <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span></span>
              </div>
            </div>
            <?php } }



               if(isset($rr['n_type'])){ if($rr['n_type'] == 'event'){ 
                 $words = explode(" ",$rr['event_description']);
                 $content = implode(" ",array_splice($words,0,10));
                 $words1 = explode(" ",$rr['event_title']);
                 $content1 = implode(" ",array_splice($words1,0,6)); ?>              
               <div class='news-feed-sub classified' id="removeEvent_<?php if(isset($rr['n_id']) && !empty($rr['n_id'])){ echo $rr['n_id']; } ?>">
                   <a href="#" onclick="viewEvent(<?php if(isset($rr['n_id']) && !empty($rr['n_id'])){ echo $rr['n_id']; } ?>);" class="remove_noti_classified"><i class="fa fa-times"></i></a>
                   <h3>Updated: <?php if(isset($rr['event_title']) && !empty($rr['event_title'])){ echo $content1; } ?></h3>
                   <p><b>Location:</b> <?php if(isset($rr['venue_address']) && !empty($rr['venue_address'])){ echo $rr['venue_address']; } ?></p>
                   <p><b>Date: </b><?php if(isset($rr['event_date']) && !empty($rr['event_date'])){ echo date('d M Y',strtotime($rr['event_date'])); } ?></p>
                   <p><?php if(isset($rr['event_description']) && !empty($rr['event_description'])){
                       echo $content;
                        }?> </p> 
                  <p><a href="<?php echo base_url().'eventdetail/'.$rr['event_id']; ?>">View it here</a></p>
                      
              </div>
              <?php } } 
              if(isset($rr['notificate_type'])){ if($rr['notificate_type'] == 'review'){ ?>

<div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['notification_id'])){echo $rr['notification_id']; }?>">
  <a href="<?php echo base_url().'lodging/'.$rr['vac_slag']; ?>" onclick="notification(<?php if(isset($rr['notification_id'])){echo $rr['notification_id']; }?>)" class="remove_noti_classified"><i class="fa fa-times"></i></a>
  <div class="news-feed-head">
    <!-- <div class="profile-pic">
      <img src="<?php echo  $img; ?>">
    </div> -->
    <div class="main-header">
      <h3><?php if(isset($rr['vac_name'])){echo $rr['vac_name']; }?></h3>
      <p><span><?php if(isset($rr['fname'])){echo $rr['fname']; } ?> <?php if(isset($rr['lname'])){echo $rr['lname']; } ?></span></p>
    </div>
  </div>
  <div class="news-feed-cont">
    <p  style="color:#000;">New Review: <?php if(isset($rr['comment'])){
      $words = explode(" ",$rr['comment']);
      $content = implode(" ",array_splice($words,0,25));
    echo $content; }?></p>
  </div>
  <div class="news-feed-date">
    <span>
      <i class="fa fa-calendar"></i>
      <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span>
    </span>
  </div>
</div>

            <?php } }
           if(isset($rr['notificate_type'])){ if($rr['notificate_type'] == 'forum'){ ?>
            
            <?php if(isset($rr['profile_picture']) && !empty($rr['profile_picture'])){
              if(strpos($rr['profile_picture'], "http://") !== false OR strpos($rr['profile_picture'], "https://") !== false){
                $img = $rr['profile_picture'];
              }else
              {
               $img = base_url().$rr['profile_picture'];
              }
            }
            else
            {
             $img =  base_url().'assets/images/default.png';
            }
            ?>
          

<div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['notification_id'])){echo $rr['notification_id']; }?>">
  <a href="#" onclick="notification(<?php if(isset($rr['notification_id'])){echo $rr['notification_id']; }?>)" class="remove_noti_classified"><i class="fa fa-times"></i></a>
  <div class="news-feed-head">
    <div class="profile-pic">
      <span class="profile"><img src="<?php echo  $img; ?>"></span>
    </div>
    <div class="main-header">
      <h3><?php if(isset($rr['forum_ques_title'])){echo $rr['forum_ques_title']; }?></h3>
      <p><span><?php if(isset($rr['fname'])){echo $rr['fname']; } ?> <?php if(isset($rr['lname'])){echo $rr['lname']; } ?></span></p>
    </div>
  </div>
  <div class="news-feed-cont">
    <p  style="color:#000;">New Comment:<?php if(isset($rr['forum_comment_description'])){echo $rr['forum_comment_description']; } ?></p>
  </div>
  <div class="news-feed-date">
    <span><i class="fa fa-calendar"></i>
      <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span>
    </span>
  </div>
</div>


            <?php } } */




              ?>
           <?php if(isset($rr['trail_type'])){
                if($rr['trail_type'] == 'trail_report'){
              $wordlimit='';
              if(strlen($rr['trail_report_conditions']) >120 ){
                  $wordlimit ='<span class="trailDescMore'.$rr['subc_id'].'" onClick="readmore('.$rr['subc_id'].');">read more</span><span class="trailDescless'.$rr['subc_id'].'" style="display:none;" onClick="readless('.$rr['subc_id'].');">read less</span>';
              }  
              if(isset($rr['profile_picture']) && !empty($rr['profile_picture'])){ 
                if(strpos($rr['profile_picture'], "http://") !== false OR strpos($rr['profile_picture'], "https://") !== false){
                    $img = $rr['profile_picture'];
                }else
                {
                    $img = base_url().$rr['profile_picture'];
                }
              }
              else
              { 
                    $img =  base_url().'assets/images/default.png';
              }   
             ?>
            <div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>">
               <a href="#" onclick="newsfeed_viewTrail('<?php if(isset($rr['trail_name'])){echo $rr['trail_name']; } ?>',<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>);" class="remove_noti_classified"><i class="fa fa-times"></i></a>
              <div class="news-feed-head">
                <div class="profile-pic">
                  <img src="<?php echo  $img; ?>">
                </div>
                <div class="main-header">
                  <h3><?php if(isset($rr['trail_name'])){echo $rr['trail_name']; } ?></h3>
                  <p><span><?php if(isset($rr['fname'])){echo $rr['fname']; } ?> <?php if(isset($rr['lname'])){echo $rr['lname']; } ?></span></p>
                </div>
               </div>
              <div class="news-feed-cont">
               <p class="trailDes<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>"><!-- <a href="<?php //echo base_url(); ?>details/<?php // if(isset($rr['subc_id'])){echo base64_encode($rr['subc_id']); } ?>/<?php  //if(isset($rr['subc_user_id'])){echo base64_encode($rr['subc_user_id']); } ?>" style="color:#000;"> --><?php if(isset($rr['trail_report_conditions'])){echo $rr['trail_report_conditions']; } ?><!-- </a> --></p><?php echo $wordlimit; ?>
              </div>
              <div class="news-feed-date">
                <span><i class="fa fa-calendar"></i> <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span></span>
              </div>
            </div>
            <?php } } ?>

          <?php if(isset($rr['trail_type'])){
                if($rr['trail_type'] == 'trail'){
              $wordlimit='';
              if(strlen($rr['trail_description']) >120 ){
                  $wordlimit ='<span class="trailDescMore'.$rr['subc_id'].'" onClick="readmore('.$rr['subc_id'].');">read more</span><span class="trailDescless'.$rr['subc_id'].'" style="display:none;" onClick="readless('.$rr['subc_id'].');">read less</span>';
              }  
              if(isset($rr['profile_picture']) && !empty($rr['profile_picture'])){ 
                if(strpos($rr['profile_picture'], "http://") !== false OR strpos($rr['profile_picture'], "https://") !== false){
                    $img = $rr['profile_picture'];
                }else
                {
                    $img = base_url().$rr['profile_picture'];
                }
              }
              else
              { 
                    $img =  base_url().'assets/images/default.png';
              }   
             ?>
            <div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>">
               <a href="#" onclick="newsfeed_viewTrail('<?php if(isset($rr['trail_name'])){echo $rr['trail_name']; } ?>',<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>);" class="remove_noti_classified"><i class="fa fa-times"></i></a>
              <div class="news-feed-head">
                <div class="profile-pic">
                  <img src="<?php echo  $img; ?>">
                </div>
                <div class="main-header">
                  <h3><?php if(isset($rr['trail_name'])){echo $rr['trail_name']; } ?></h3>
                  <p><span><?php if(isset($rr['fname'])){echo $rr['fname']; } ?> <?php if(isset($rr['lname'])){echo $rr['lname']; } ?></span></p>
                </div>
               </div>
              <div class="news-feed-cont">
               <p class="trailDes<?php if(isset($rr['subc_id'])){echo $rr['subc_id']; } ?>"><a href="<?php echo base_url(); ?>details/<?php if(isset($rr['subc_id'])){echo base64_encode($rr['subc_id']); } ?>/<?php if(isset($rr['subc_user_id'])){echo base64_encode($rr['subc_user_id']); } ?>" style="color:#000;"><?php if(isset($rr['trail_description'])){echo $rr['trail_description']; } ?></a></p><?php echo $wordlimit; ?>
              </div>
              <div class="news-feed-date">
                <span><i class="fa fa-calendar"></i> <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span></span>
              </div>
            </div>
            <?php } } ?>

            <?php if(isset($rr['saveroute'])){
                
              
              if(isset($rr['profile_picture']) && !empty($rr['profile_picture'])){ 
                if(strpos($rr['profile_picture'], "http://") !== false OR strpos($rr['profile_picture'], "https://") !== false){
                    $img = $rr['profile_picture'];
                }else
                {
                    $img = base_url().$rr['profile_picture'];
                }
              }
              else
              { 
                    $img =  base_url().'assets/images/default.png';
              }   
             ?>
            <div class="news-feed-sub" id="news-feed-sub<?php if(isset($rr['s_t_id'])){echo $rr['s_t_id']; } ?>">
               <a href="#" onclick="newsfeed_trailnotification(<?php if(isset($rr['s_t_id'])){echo $rr['s_t_id']; }?>)" class="remove_noti_classified"><i class="fa fa-times"></i></a>
              <div class="news-feed-head">
                <div class="profile-pic">
                  <img src="<?php echo  $img; ?>">
                </div>
                <div class="main-header">
                  <a href="<?php if(isset($rr['url'])){echo $rr['url']; }?>" onclick="newsfeed_trailnotification(<?php if(isset($rr['s_t_id'])){echo $rr['s_t_id']; }?>)"><h3><?php if(isset($rr['t_name'])){echo $rr['t_name']; }?></h3></a>
                  <p><span><?php if(isset($rr['fname'])){echo ucfirst($rr['fname']); } ?> <?php if(isset($rr['lname'])){echo ucfirst($rr['lname']); } ?></span> 
                  Shared a route with you </p>
                </div>
               </div>
              
              <div class="news-feed-date">
                <span><i class="fa fa-calendar"></i> <span><?php echo date('d M Y h:i A',strtotime($rr['n_date'])); ?></span></span>
              </div>
            </div>
            <?php } 

             } }else{
              echo '<h5>No record in news feed</h5>';
             } ?>

            </div>
          </div>
        </div>
    </div>
  </div>
</section>
</div>
<footer class="main_footer">
  <?php  $this->load->view('include/main_footer'); ?>
</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright'); ?>
</div>
<!--Save Route Modal -->
<div class="main-modal theame" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" id="trl-pln-cls">&times;</button>
    <h4 class="modal-title">Route Planning : <span style="font-size: 14px;"><?php if(isset($_GET['id'])){
    $query1= $this->db->query("SELECT * from tbl_user_route_planning where URP_ID= ".base64_decode($_GET['id'])."");
    $routePlanList2 = $query1->result();
    foreach ($routePlanList2 as $routeplan2) {
    echo ucfirst($routeplan2->my_route_name);
    }
    } ?><span></h4>
  </div>
  <div class="modal-body listing-body mCustomScrollbar">
     <?php if(isset($_GET['id'])){ ?><div class="alert alert-info" style="font-size: 11px;">
      Your saved route will appear on the map, in white. Zoom in to view the route. <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="margin-top: -27px;font-size: 15px;">×</a>
    </div>
    <?php } ?>
    <div class="trailDetail" id="MyRouteplan">
      <?php
      if(isset($_GET['id'])){
      $query= $this->db->query("SELECT * from tbl_user_route_planning where URP_ID= ".base64_decode($_GET['id'])."");
      $routePlanList1 = $query->result();
      if(isset($routePlanList1)){
      foreach ($routePlanList1 as $routeplan) {
      $route_name = explode(',', $routeplan->route_name);
      $route_dist = explode(',', $routeplan->route_dist); ?>
      
      <?php for($i=0;$i<count($route_name);$i++){  ?>
      <div class="trailReport<?php if(isset($route_name[$i])){echo str_replace(' ', '', strip_tags($route_name[$i])); }?> trailreportcls" id="trailReport<?php if(isset($route_name[$i])){echo $route_name[$i];}?>">
        <p id="myRouteValue">
          <input type="hidden" id="URP_ID" name="URP_ID" value="<?php if(isset($routeplan->URP_ID)){echo $routeplan->URP_ID; } ?>">
          <span class="head"><?php echo $route_name[$i]; ?><input type="hidden" name="route[routeName][]" value="<?php echo $route_name[$i]; ?>"> </span>: <span class="routeDis"> <?php echo $route_dist[$i];?><input type="hidden" name="route[routeDistance][]" value="<?php echo $route_dist[$i];?>"></span><span> Miles</span>
          <?php if(isset($query_params['saveroute'])){
          }else{ ?>
          <button class="trlPlningRmve" id="remove_<?php echo str_replace(' ', '', strip_tags($route_name[$i])); ?>"><i class="fa fa-times"></i></button>
          <?php } ?>
        </p>
      </div>
      <?php } ?>
      
      <?php }   }  } ?>
    </div>
    <p class="total-count1" style="display: none;" id="allrouteplan">
      <span class="head"><b>Route Total :</b></span>
    </p>
    <p class="total-count" id="routeplanadd">
      <span class="head"><b>Route Total :</b></span>
      <b>
      <span class="totlaDis">0.0</span>
      <span class="totlaDis1"> Miles</span>
      </b>
    </p>
  </div>
  <?php if(isset($query_params['saveroute'])){ ?>
  <?php }else{ ?>
  <div class="modal-footer">
    <button class="saveTrail" id="routePlnSve"><?php  if(isset($_GET['id'])){ echo 'Update'; }else {echo 'Save';}?> Route</button>
    <a class="viewSavedRoutes" id="viewSavedRoutes" href="<?php echo base_url()?>user/savedroutes">View Saved Routes</a>
  </div>
   <?php }?>

</div>
<div class="main-modal1 theame" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" id="trl-pln-cls1">&times;</button>
    <h4 class="modal-title">Route Name</h4>
  </div>
  <form id="routePlanningFrm" name="routePlanningFrm" method="post">
    <div class="modal-body">
      <div id="succMsg"></div>
      <div class="trailDetailroute">
        <div id="saveRouteNewData" style="display:none;"></div>
        <input type="hidden" id="statenameroute" name="statenameroute">
        <input type="hidden" name="user_id" value="<?php if(isset($user_id)){echo $user_id; } ?>">
        <?php if(isset($_GET['id'])){
        $trail_name = $this->model->get_row('tbl_user_route_planning', array('URP_ID' =>base64_decode($_GET['id'])));
        }?>
        My route name: <input type="text" name="my_route_name" id="my_route_name" value="<?php if(isset($trail_name->my_route_name)){echo $trail_name->my_route_name;} ?>">
        <span style="display: none;color:red;margin-top: 3px;" id="error-msg">Please enter route name</span>
      </div>
    </div>
    <div class="modal-footer">
      <button class="saveTrail" id="routePlnSve1"><?php  if(isset($_GET['id'])){ echo 'Update'; }else {echo 'Save';}?></button>
    </div>
  </form>
</div>
<!--update trail Status -->
<div class="update-trail-modal1 theame" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" id="trl-update-cls1">&times;</button>
    <h4 class="modal-title">Update Trail Status</h4>
  </div>
  <form id="updatetrailstsFrm" name="updatetrailstsFrm" method="post">
    <div class="modal-body">
      <div id="updateSuccMsg"></div>
      <div id="errorupdatetrailstsFrm"></div>
      <div class="trail-des">
        <p><b>Trail Name:</b><span id="trail_name_span"></span></p>
        <p><b>Trail Distance:</b><span class="u-t-miles">Miles</span><span id="trail_Distance_span"></span></p>
        <input type="hidden" name="user_id" value="<?php if(isset($user_id)){echo $user_id; } ?>">
        <input type="hidden" name="trail_name" id="trail_name">
        <input type="hidden" name="trail_disc" id="trail_disc">
        <p><b>Reason for status change:</b></p>
        <textarea type="text" name="trail_description" id="trail_description"></textarea>
        <div class="s-l-box">
          <select id="update_status" name="update_status" >
            <option value="">Update Status</option>
            <option value="0">Open</option>
            <option value="1">Closed</option>
            <option value="2">Caution</option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="saveTrail" id="updateTrailSve1">Submit</button>
    </div>
  </form>
</div>
<!-- subcri model-->
<div id="subcri-main-modalID" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="subcri-main-modal1 theame">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subscribe</h4>
        </div>
        <div class="modal-body">
          <div id="subcMsg"></div>
          <p id="updateSubEmail" style="display: none;" >
            <span id="alreadySubcMsg" class="alert alert-success" style="display: none;"></span>
            <input type="text" id="subEmail" name="subEmail" />
            <button id="subEmailBtn" onclick ='updateSubc(<?php echo $user_id; ?>);'>Submit</button>
          </p>
          <p id="unsubscribeEmail" style="display: none;" >
            <span id="alreadyUnsubscribeMsg" class="alert alert-success" style="display: none;"></span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- subcri model -->
<!-- Modal show Groomed Trails -->
<div id="myGroomed" class="show_groomed_trail modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p>Please select state</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default myGroomedBtn" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal myModelSharedRouteView Trails -->
<div id="myModelSharedRouteView" class="show_groomed_trail modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p>The route is deleted by the user</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default myGroomedBtn" data-dismiss="modal" onclick="window.location.href = '<?php echo base_url(); ?>';">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->
</body>

<input type="hidden" id="userID1" name="userID1" value="<?php echo $user_id; ?>">
<input type="hidden" id="showGroomTrailFlage" name="showGroomTrailFlage">

</html>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script async src="//www.google-analytics.com/analytics.js"></script>
<?php $g_key =google_mapkey(); ?>
 <script src="https://maps.googleapis.com/maps/api/js?key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&libraries=geometry,places"></script>
<script type="text/javascript">
$(document).on('click','#trl-pln-cls', function(){
    $('.main-modal').hide();
});
var showGroomTrailFlage = $('#showGroomTrailFlage').val();
var map, infowindow;
var polylines = [];
var poly;
var flightPath;
var linePoly = [];
var linePolygon=[];
var path;
var locations=[];
var customZoom;
var oldlat;
var oldlng;
var geocoder = new google.maps.Geocoder();
function initialize() {
  if(sessionStorage.getItem('zoomLevel')){
     customZoom =sessionStorage.getItem('zoomLevel');
     parseInt(customZoom);
  }

<?php if(isset($_GET['id'])){ ?>
 customZoom =7;
    oldlat='<?php if(isset($routelatlang)){echo $routelatlang->route_lat; } ?>';
    oldlng='<?php if(isset($routelatlang)){echo $routelatlang->route_lang; } ?>';

<?php }

else{ ?>
   customZoom =7;
    if(($('.newlat').val() != '') &&  ($('.newlng').val() != '')){
      oldlat=$('.newlat').val();
      oldlng=$('.newlng').val();
    }else{
      oldlat = 44.314844;
      oldlng = -85.602364;
    }
<?php } ?>


  var latlng = new google.maps.LatLng(parseFloat(oldlat),parseFloat(oldlng));
  map = new google.maps.Map(document.getElementById('map'), {
  center: {lat:parseFloat(oldlat) , lng: parseFloat(oldlng)},
  zoom: parseInt(customZoom),
  disableDefaultUI: true,
  scrollwheel: false,
  zoomControl: true,
  zoomControlOptions: {
    position: google.maps.ControlPosition.LEFT_BOTTOM
  },
  scaleControl: true,
  streetViewControl: true,
  streetViewControlOptions: {
    position: google.maps.ControlPosition.RIGHT_TOP
  },
  fullscreenControl: true,
  fullscreenControlOptions: {
          position: google.maps.ControlPosition.RIGHT_TOP
  },
  mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
          position: google.maps.ControlPosition.LEFT_BOTTOM
      },
  mapTypeId: google.maps.MapTypeId.HYBRID,

  });
    var marker = new google.maps.Marker({
      map: map
   });
    var input = document.getElementById('country');
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    var searchCountyName;
    infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(12);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);   
        searchCountyName = place.name; 
    });
  // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'click', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {  
              var contentIndowidow = '<div class="search-main-div">'+
              '<div class="search-conty-name">'+searchCountyName+'</div>'+
              '<div class="inner-search-div">'+
              '<p>Details from Google Maps</p>'+
              '<p>' +$('#country').val()+'</p>'+
              '<p><a href="https://www.google.com/maps/?q='+marker.getPosition().lat()+','+marker.getPosition().lng()+'" target="_blank">View in Google Maps</a></p>'+
              '</div>'+
              '</div>';
              infowindow.setContent(contentIndowidow);
              infowindow.open(map, marker);
          }
        }
        });
    });
<?php if(isset($_GET['id'])){ ?>
$('#s_h_groomed_trail').attr('checked', true); 
<?php }else{ ?>
    if($('#showGroomTrailFlage').val() != 1){
        var regionNameDropval =  readCookie('regionNameDropSes');
        var trailReportval = readCookie('trailReportValSes');
        var trailSes = readCookie('trailSes');
        if(regionNameDropval != null && regionNameDropval != ''){
            $('#region_name_drop').val(regionNameDropval);
             geocodeAddress(regionNameDropval, geocoder, map);
          
        }
        if(trailReportval != null && trailReportval != '') {
            $('input[name=trailReportName]').prop('checked', true).triggerHandler('click');
            trailReportSes11(readCookie('trailReportRegionSes'));
            //geocodeAddress(regionNameDropval, geocoder, map);
        }
        if(trailSes != null && trailSes != '') {
            $('input[name=s_h_groomed_trail]').prop('checked', true).triggerHandler('click');
            regionNameDropfun(trailSes);
            //geocodeAddress(regionNameDropval, geocoder, map);
        }
        else{
           $('#s_h_groomed_trail').prop('checked', false).triggerHandler('click');
       }
        
    }

<?php } ?>
$(document).on('change','#region_name_drop', function(){
   var address = $("#region_name_drop :selected")[0].text;
   if($('#region_name_drop').val() !=''){
       geocodeAddress(address, geocoder, map);
     }else{
      geocodeAddress('Michigan', geocoder, map);
      $("#boondocking_trails").val($("#boondocking_trails option:first").val());
      $('input[name=s_h_groomed_trail]').prop('checked', false).triggerHandler('click');
     }
 });
 
  map.addListener('zoom_changed', function() {
        sessionStorage.setItem('zoomLevel',map.getZoom());
  });
}

$(document).on('change','#region_name_drop', function(){
  $('.main-modal').hide(); 
  var region_name = $('#region_name_drop').val();
  if(region_name!=''){
      createCookie('regionNameDropSes', region_name, 1);
      createCookie('trailSes','', -1); 
      geocodeAddress(region_name, geocoder, map);
      $('input[name=s_h_groomed_trail]').prop('checked', false).triggerHandler('click');
      $('input[name=trailReportName]').prop('checked', false).triggerHandler('click');
      initialize();
      $("#mySavedRoutes").val($("#mySavedRoutes option:first").val());
  }else{
    geocodeAddress('Michigan', geocoder, map);
    createCookie('regionNameDropSes','', -1);
    createCookie('trailSes','', -1);
    deleteTrail();
    $("#boondocking_trails").val($("#boondocking_trails option:first").val());
    $('#s_h_groomed_trail').prop('checked', false).triggerHandler('click');
  }  
});

$(document).on('change','#s_h_groomed_trail', function(){
<?php if(isset($_GET['id'])){ ?>
  var url = window.location.href;  
  var  arr = url.split("?");
  RefreshPageUrl('test', arr[0]);
  $(".trailreportcls").remove();
  $(".routePlnSve").html('Save');
<?php } ?>
<?php if(isset($_GET['tid'])){ ?>
  var url = window.location.href;  
  var  arr = url.split("?");
  RefreshPageUrl('test', arr[0]);
 
<?php } ?>
var checkBoxValue = $('input:checkbox[name=s_h_groomed_trail]').is(':checked');
var region_name = $('#region_name_drop').val();
if($('#region_name_drop').val()!= '' ){
    if(checkBoxValue == true){
      <?php if(isset($_GET['uid'])){ ?>
      var url = window.location.href;  
      var  arr = url.split("?");
      RefreshPageUrl('test', arr[0]);
      deleteTrail();
      <?php } ?>


       $('#showGroomTrailFlage').val(0);
        if(readCookie('regionNameDropSes') !=null){
          regionNameDropval = readCookie('regionNameDropSes');
          $('#region_name_drop').val(regionNameDropval);
          createCookie('trailSes', $('#region_name_drop').val(), 1);
          regionNameDropfun($('#region_name_drop').val());
        } 
      }else{
        $('.main-modal').hide();
        $("#mySavedRoutes").val($("#mySavedRoutes option:first").val());
        $("#boondocking_trails").val($("#boondocking_trails option:first").val());
       // $('#showGroomTrailFlage').val(1);
        createCookie('trailSes','', -1);
        deleteTrail();
   }

  }else{
    deleteTrail();
    $('#myGroomed').modal('show');
    $("#boondocking_trails").val($("#boondocking_trails option:first").val());
    $('#s_h_groomed_trail').prop('checked', false).triggerHandler('click');

  }
   
});
function regionNameDropfun(region_name){
 $('#statenameroute').val(region_name);
         $("#ajax_favorite_loddder").show();
         $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>ajax/region_name_drop",
                data:{region_name: region_name},
                success: function(data){
                   $("#ajax_favorite_loddder").hide();
                    var data1 =$.parseJSON(data);
                    createTrail(data1);
                }
            });
         //var address = region_name;
        // geocodeAddress(address, geocoder, map);
}

function RefreshPageUrl(title, url) {
  if (history.pushState) {
      history.pushState(null, title, url);
  } else {
      alert("Your Browser will not Support HTML5");
  }
}



function mymap(upload_by_id, traildet){
<?php if(isset($_GET['id'])){
  ?>
  var url = window.location.href;  
  var  arr = url.split("?");
  //alert(arr[0]);
  RefreshPageUrl('test', arr[0]);
  $(".trailreportcls").remove();
<?php } ?>
  $('.main-modal').hide();
  $("#mySavedRoutes").val($("#mySavedRoutes option:first").val());
  if($('#boondocking_trails').val() != ''){
  var res = traildet.split("_");
  var trailID = res[0];
  var region_name = res[1];
  $('#region_name_drop').val(region_name);
  createCookie('regionNameDropSes', region_name, 1);
  $("#ajax_favorite_loddder").show();
   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/mymap",
          data:{upload_by_id: upload_by_id,trailID:trailID},
         success: function(data){
             $("#ajax_favorite_loddder").hide();
             deleteAllcountyTrail();
             $('input[name=trailReportName]').prop('checked', false).triggerHandler('click');
             deleteTrail();
             var data1 =$.parseJSON(data);
             createTrail(data1);
             if(readCookie('regionNameDropSes') !=null){
                 regionNameDropval = readCookie('regionNameDropSes');
                 $('#region_name_drop').val(regionNameDropval);
                  createCookie('trailSes', $('#region_name_drop').val(), 1);
                  regionNameDropfun($('#region_name_drop').val());
                  //var address = $('#region_name_drop').val();
                  geocodeAddress(region_name, geocoder, map);
                 // $('#boondocking_trails').text($('#boondocking_trails').val());


             } 
              $('input[name=s_h_groomed_trail]').prop('checked', true).triggerHandler('click');
                 
             
          }
      });
 }else{
  $('input[name=s_h_groomed_trail]').prop('checked', false).triggerHandler('click');
  createCookie('trailSes', '', -1);
  deleteTrail();
 }
}
function createTrail(data){
  for (var i = 0; i < data.length; i++) {
   var cc =data.length - 1;
   var ii =0;
   var str_old = data[i]['lat_lang'].replace(/\s/g, '');
   var latValue;
   var lngValue;
   var separated = str_old.split(",0");
    var temp =[];
   for (var j = 0, length = separated.length; j < length; j++) {
    var chunk = separated[j];
    var separated1 = chunk.split(",");
    lngValue = separated1[0];
    latValue = separated1[1];
    if((lngValue != '') && (latValue != '') && (lngValue !== 'undefined') && (latValue !== 'undefined')){
      temp.push({lat: parseFloat(latValue) , lng: parseFloat(lngValue)});    
    }
   }
   var Linecolor;
   var openvalue ='';
   var sesvalue = $('#userID1').val();
 
  if(data[i]['upload_by_id'] != 1){
        if(data[i]['previous_trail_status'] == 3){
          Linecolor = "#0099ff";
        }else if(data[i]['previous_trail_status'] == 2){
          Linecolor = "#ffcc00";
        }else if(data[i]['previous_trail_status'] == 1){
          Linecolor = "#ff1a1a";
        }else if(data[i]['previous_trail_status'] == 0){
          Linecolor = "#fc6b02";
        }
  }else{
      if(data[i]['previous_trail_status'] == 3){
        Linecolor = "#0099ff";
      }else if(data[i]['previous_trail_status'] == 2){
        Linecolor = "#ffcc00";
      }else if(data[i]['previous_trail_status'] == 1){
        Linecolor = "#ff1a1a";
      }else if(data[i]['previous_trail_status'] == 0){
        Linecolor = "#39e600";
      }
  }

 var url = window.location.href;  
var  arr = url.split("?");
  if(arr[1]){
    <?php  if(isset($_GET['id'])){
      $query3= $this->db->query("SELECT * from tbl_user_route_planning where URP_ID= ".base64_decode($_GET['id'])."");
      $routePlanList3 = $query3->result();
      if(isset($routePlanList3)){ 
        foreach ($routePlanList3 as $routeplan3) { 
          $route_name = explode(',', $routeplan3->route_name);
              for($i=0;$i<count($route_name);$i++){ ?>
                var MyRouteplanName = '<?php echo  $route_name[$i]; ?>';
                  if(MyRouteplanName == data[i]['klm_trail_name']){
                     Linecolor = "#FFFFFF";
                  }
  <?php } } } } ?>
  <?php  if(isset($_GET['tid'])){
      $query3= $this->db->query("SELECT * from tbl_kml_data_trail where trail_id= ".base64_decode($_GET['tid'])."");
      $routeList3 = $query3->result(); ?>
         var MyRouteName = "<?php echo $routeList3[0]->klm_trail_name; ?>";
         if(MyRouteName == data[i]['klm_trail_name']){
          Linecolor = "#fc6b02";
         }
  <?php }?>
}else{

      if(data[i]['previous_trail_status'] == 3){
        Linecolor = "#0099ff";
      }else if(data[i]['previous_trail_status'] == 2){
        Linecolor = "#ffcc00";
      }else if(data[i]['previous_trail_status'] == 1){
        Linecolor = "#ff1a1a";
      }else if(data[i]['previous_trail_status'] == 0){
        Linecolor = "#39e600";
      }

}
    
  
 flightPath = new google.maps.Polyline({
    path: temp,
    geodesic: true,
    strokeColor:Linecolor,
    strokeOpacity: 1.0,
    strokeWeight: 5
  });

 flightPath.setMap(map);
 linePoly.push(flightPath);

 if(data[i]['previous_trail_status']){
       if(data[i]['previous_trail_status'] == 0){
         openvalue = 'open';
       }else if(data[i]['previous_trail_status'] == 1){
         openvalue = 'closed';
       }else if(data[i]['previous_trail_status'] == 2){
         openvalue = 'caution';
       }else{
         openvalue = 'pendingApproval';
       }
  }
 var description_old = '';
 var description = '';
  if(data[i]['new_status'] == 1) {
     description_old = data[i]['trail_description'];
    // description = description_old.replace(/'/g, "");
     description = description_old;
  }else{
    var trail_dscrptn = data[i]['trail_dscrptn'];
     //description = trail_dscrptn.replace(/'/g, "");
     description = trail_dscrptn;
  }
if($('.trailColorMouseOut').val() !=10){
   google.maps.event.addListener(flightPath, 'mouseover', function (event) {
          var flightPath1 = {
            geodesic: true,
            strokeColor: '#FFFFFF',
            strokeOpacity: 1.0,
            strokeWeight: 6
          };
           this.setOptions(flightPath1);
  });
}
 if($('.trailColorMouseOver').val() !=20){
     mouseouttrail(flightPath,Linecolor);
 }
 createInfoWindow(flightPath, data[i]['klm_trail_name'], data[i]['id'], description, openvalue,Linecolor);
}
}
function mouseouttrail(flightPath,Linecolor){
   google.maps.event.addListener(flightPath, 'mouseout', function (event) {
         var flightPath1 = {
            geodesic: true,
            strokeColor: Linecolor,
            strokeOpacity: 1.0,
            strokeWeight: 5
          };
           this.setOptions(flightPath1);
  });
}
function deleteTrail() {
  if(linePoly){
     for (i=0; i<linePoly.length; i++) 
    {                           
        linePoly[i].setMap(null); //or line[i].setVisible(false);
    }
  }
}
function createTrailReport(){
var region_name;
var region_name = $('#region_name_drop :selected').val();  
if(region_name != ''){
  var val = [];
   $('.check_trail_reena11:checked').each(function(i){
   val[i] = $(this).val();
});
if(val.length>0){
  $('.trailreport').val(val);
   $("#ajax_favorite_loddder").show();
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/AllCountyTrail",
        data:{region_name: region_name},
        success: function(data){
          $("#ajax_favorite_loddder").hide();
           if(data != ''){
             var data1 =$.parseJSON(data);
             createCookie('trailReportRegionSes', region_name, 1); 
             createCookie('trailReportValSes', val, 1); 
             countyTrail(data1);
             trail_detail();
           }else{
             alert('trail report is not available in this state');
           }
        }
    }); 

  }else{
    if(val ==''){
      createCookie('trailReportValSes', "", -1); 
      deleteAllcountyTrail();
    }
    
  }

}else{
   $('#myGroomed').modal('show');
   $('input[name=trailReportName]').prop('checked', false).triggerHandler('click');
}
}

function trailReportSes11(region_name){
$("#ajax_favorite_loddder").show();
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/AllCountyTrail",
        data:{region_name: region_name},
        success: function(data){
          $("#ajax_favorite_loddder").hide();
            var regionNameDropval = readCookie('regionNameDropSes');
            $('#region_name_drop').val(regionNameDropval);
            if(data != ''){
                var data1 =$.parseJSON(data);
                 countyTrail(data1);
            }else{
                alert('trail report is not available in this state');
            }

        }
    });
         
}
function deleteAllcountyTrail(){
  if(linePolygon){
     for (i=0; i<linePolygon.length; i++) 
    {                           
        linePolygon[i].setMap(null); //or line[i].setVisible(false);
    }
  }
}
var sum ;
var totals = 0.0;
function createInfoWindow(poly, content, idqq, description, trail_status,Linecolor) {

google.maps.event.addListener(poly, 'click', function(event) {
    if(content){
   google.maps.event.addListener(poly, 'mouseover', function (event) {
          var flightPath1 = {
            geodesic: true,
            strokeColor: '#FFFFFF',
            strokeOpacity: 1.0,
            strokeWeight: 6
          };
           this.setOptions(flightPath1);
  });
}
 if(content){
   google.maps.event.addListener(poly, 'mouseout', function (event) {
          var flightPath1 = {
            geodesic: true,
            strokeColor: '#FFFFFF',
            strokeOpacity: 1.0,
            strokeWeight: 6
          };
           this.setOptions(flightPath1);
  });
 }
$('.trailColorMouseOver').val(20);
$('.trailColorMouseOut').val(10);
       var trailColor = '';
      if(trail_status == 'closed'){
         trailColor = '#ff1a1a';
      }else{
         trailColor = '#FFFFFF';
      }
      poly.setOptions({strokeColor: trailColor,
        strokeOpacity: 1.5,
        strokeWeight: 6
      });
      infowindow.setPosition(event.latLng);
      infowindow.open(map);
      polylines.push(poly);
      var polylinePath = poly.getPath();
      var lengthInMeters = google.maps.geometry.spherical.computeLength(polylinePath);
      var lineDisInMiles = lengthInMeters/1609.344;
      var trail_type = 'trail';
      infowindow.setContent('<div class="tra-in-wndo">'+content+
        '<p class="contentTrail1">'+description+'</p>'+
        '<div style="padding: 7px 0;">'+
        '<i class="fa fa-arrows-h" aria-hidden="true"></i>'+
        ' '+'<span class="dismitr">'+lineDisInMiles.toFixed(2)+'</span>'+
        ' '+'<span>mi</span>'+
        '</div>'+
         <?php if(isset($query_params['saveroute'])){ 
          }else{ ?>
         '<button type="button" class="btn btn-info btn-sm" id="update_trail_status">Update Trail Status</button>'+
        '<button type="button" id="route-btn" class="btn btn-info btn-sm"><?php if(isset($_GET['id'])){ echo 'Update'; }else{ echo 'Add'; }?> Route</button>'+
        '<span class="sucIcon1" onclick="userSubc(\''+trail_type+'\',<?php echo $user_id; ?>,\''+content+'\');">Subscribe</span>'+
       <?php } ?>
         '<span class="closeTrailWindow" id="'+ content +'_info_'+idqq+'""><i class="fa fa-close"><i><span></div>');
       // $(".main-modal").show();
        
        $("#route-btn").click(function(){
          $(".listing-body").mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});
           $(".main-modal").show();
            poly.setOptions({
                strokeColor: "#FFFFFF",
                strokeOpacity: 1.5,
                strokeWeight: 6
            });
            infowindow.close();
             $(".update-trail-modal1").hide();
          

              if (!$('.trailReport'+idqq+'').hasClass('trailReport'+idqq+'')) {
                  $('.trailDetail').append('<div class="trailReport'+idqq+' trailreportcls" id="trailReport'+idqq+'">'+'<p>'+
                  '<span class="head">'+ content +
                  '</span>: <span class="routeDis">'+lineDisInMiles.toFixed(2) +'</span>'+
                  '<span> Miles</span>'+
                  '<button class="trlPlningRmve" id="'+ content +'_'+lineDisInMiles.toFixed(2)+'_'+idqq+'"" ><i class="fa fa-times" ></i></button>'+
                  '</p>'+'</div>');

                  $('.trailDetailroute').append('<input type="hidden" name="route[routeName][]" value="'+content+'">'+'<input type="hidden" name="route[routeDistance][]" value="'+lineDisInMiles.toFixed(2)+'">');

                 sum = 0.0;
                  $('.routeDis').each(function()
                 {
                   sum += parseFloat($(this).text());
                 });
                if($('.trailreportcls').length != 0){
                     $('.totlaDis').show();
                     if(sum.toFixed(2) == 'NaN'){
                      $('.totlaDis').html('0.0');
                    }else{
                      $('.totlaDis').html(sum.toFixed(2));
                    }
                }else{
                    $('.totlaDis').html('0.0');
                }
                 $('#polLnClr').val(0);
             }

             

          });
          $(document).on('click','#update_trail_status', function(){
            poly.setOptions({strokeColor: '#FFFFFF'});
            infowindow.close();               
              $(".main-modal").hide();
              $(".main-modal1").hide();
              $(".update-trail-modal1").show();
              $('#polLnClrTrl').val(0);
              $('#trail_name').val(content);
              $('#trail_disc').val(lineDisInMiles.toFixed(2));
              $('#trail_name_span').html(content);
              $('#trail_Distance_span').html(lineDisInMiles.toFixed(2));
          });
});
$(document).on('click','.trlPlningRmve', function(){
  var IDtrlPlningRmve =  $(this).attr('id');  
//  alert(IDtrlPlningRmve);
  var arr = IDtrlPlningRmve.split('_');
    if(content == arr[0]){
        var flightPath1 = {
          geodesic: true,
          strokeColor: Linecolor,
          strokeOpacity: 1.0,
          strokeWeight: 5
        };
        poly.setOptions(flightPath1);
        google.maps.event.addListener(poly, 'mouseout', function (event) {
        var flightPath1 = {
          geodesic: true,
          strokeColor: Linecolor,
          strokeOpacity: 1.0,
          strokeWeight: 5
        };
        poly.setOptions(flightPath1);
        });

        $('.trailReport'+ arr[2]+'').remove(); 
        if($('.trailreportcls').length != 0){
            totals = (sum - arr[1]).toFixed(2)
            $('.totlaDis').show();
            if(totals == 'NaN'){
               $('.totlaDis').html('0.0');
            }else{
               $('.totlaDis').html(totals); }
        }else{
           $('.totlaDis').html('0.0');
        }
    }
});

$(document).on('click','.closeTrailWindow', function(){
  var IDtrlPlningRmve =  $(this).attr('id');  
  var arr = IDtrlPlningRmve.split('_');
  if(content == arr[0]){
  mouseOutTrail(Linecolor,poly);
  }
});
$(document).on('click','#trl-pln-cls', function(){
     $(".main-modal").hide();
    <?php if(isset($_GET['id'])){ }else{ ?>
     $(".trailreportcls").remove();
     $('.totlaDis').html('0.0');
     mouseOutTrail(Linecolor,poly);
    <?php } ?>
});

$(document).on('click','#trl-update-cls1', function(){
    $(".main-modal").hide();
    <?php if(isset($_GET['id'])){ }else{ ?>
    $(".trailreportcls").remove();
    $('.totlaDis').html('0.0');
   mouseOutTrail(Linecolor,poly);
   <?php } ?>
});
}

function mouseOutTrail(Linecolor,poly){
     infowindow.close();
       var flightPath1 = {
            geodesic: true,
            strokeColor: Linecolor,
            strokeOpacity: 1.0,
            strokeWeight: 5
          };
           poly.setOptions(flightPath1);
      google.maps.event.addListener(poly, 'mouseout', function (event) {
          var flightPath1 = {
            geodesic: true,
            strokeColor: Linecolor,
            strokeOpacity: 1.0,
            strokeWeight: 5
          };
           poly.setOptions(flightPath1);
      });
}


function execute_chart(chart_data, reee) {
  //console.log(chart_data);
  var chart_obj = {
      xAxis: {
        categories: reee
      },
      yAxis: {
        title: {
          text: 'Temperature (°F)'
        }
      },
      tooltip: {
        valueSuffix: '°F'
      },
      legend: {
        layout: 'vertical',
        align: 'buttom',
        verticalAlign: 'middle',
        borderWidth: 0,

      },
      series: chart_data
    };
    $('#forcostChat').highcharts(chart_obj);
}

function createInfoWindowTrailReport(poly, content,zipcode, idqq) {

         google.maps.event.addListener(poly, 'mouseover', function (event) {
            this.setOptions({
                  strokeColor: '#FFFFFF',
                  strokeOpacity: 1.0,  
                  strokeWeight: 4,
                  fillColor: '#FFFFFF',
                  fillOpacity: 0.25
              });

         });
         google.maps.event.addListener(poly, 'mouseout', function (event) {
              this.setOptions({
                  strokeColor: '#FF0000',
                  strokeOpacity: 0.8,
                  strokeWeight: 2,
                  fillColor: '#FF0000',
                  fillOpacity: 0
              });
          }); 

          google.maps.event.addListener(poly, 'click', function(event) {
          polylines.push(poly);
          var polylinePath = poly.getPath();
          var lengthInMeters = google.maps.geometry.spherical.computeLength(polylinePath);
          var lineDisInMiles = lengthInMeters/1609.344;
         poly.setOptions({
              strokeColor: '#FFFFFF',
              strokeOpacity: 1.0,  
              strokeWeight: 4,
              fillColor: '#FFFFFF',
              fillOpacity: 0.25
         });

        // var hightchat = $.getJSON("http://api.openweathermap.org/data/2.5/forecast?q=" + content + "&units=metric&cnt=7&appid=0fe84ad577e0d18b086b9bf4c00be983",function(hightchatResult){
         var hightchat = $.getJSON("http://api.openweathermap.org/data/2.5/forecast?zip=" + zipcode + "&units=metric&cnt=7&appid=0fe84ad577e0d18b086b9bf4c00be983",function(hightchatResult){
          var timeHight ='';  
          var MainTemp =''; 
          for (var i = 0; i < hightchatResult['list'].length; i++) {           
              var strTime = / (.+)/.exec(hightchatResult['list'][i]['dt_txt'])[1];
              var timeString = strTime;
              var H = +timeString.substr(0, 2);
              var h = (H % 12) || 12;
              var ampm = H < 12 ? "AM" : "PM";
              timeString = h + timeString.substr(2, 3) + ampm;
              timeHight += timeString+',';
              var tempChartCelsius = hightchatResult['list'][i]['main']['temp'].toString().split(".")[0];
              var tempvalue = tempChartCelsius * 1.8000 + 32.00;
              MainTemp += tempvalue.toString() +',';
          }
         
          var mailTimeValue = timeHight.slice(0, -1);
          var reee = mailTimeValue.split(',');
         
          var mailTempValue = MainTemp.slice(0, -1);
          var arr = mailTempValue.split(',').map(Number);

        //alert(mailTempValue);
          var d = [{
                name: content,
                data: arr
            }];
           execute_chart(d,reee); 

       });

       var geocoder =  new google.maps.Geocoder();
       geocoder.geocode( { 'address': content}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
            
        $.getJSON("http://api.openweathermap.org/data/2.5/weather?zip=" + zipcode + "&appid=0fe84ad577e0d18b086b9bf4c00be983",function(result){
          
          timestamp =  result['dt'];
          var jsDate = new Date(timestamp*1000);
          var TodayDays = jsDate.toDateString();
          var tempCelsius = (result['main']['temp_min'] - 273.15).toFixed(2);
          var tempFahrenheit = tempCelsius * 1.8000 + 32.00;
               var weatherData = "<div class='weatherReport'>"+
            
                 "<div class='half-div'>"+
                 "<div class='countyHeading'> <p><h4>" + content+ "</h4></p></div>"+
               "<div class='todayDay'> <p>" +TodayDays+"</p></div>"+
                 "<div class='icon'> <p><img src='http://openweathermap.org/img/w/" + result['weather'][0]['icon']+ ".png'><span class='Temperaturecls'>" + tempFahrenheit.toFixed(2) +
                " <span>°F</span></span></p>"+"</div>" +
                 "</div>" +
                 
                 "<div class='half-div'>"+

                 "<div class='half-div-r'><div class='description'> <p>Weather Info: " + result['weather'][0]['main'] + "</p></div>" +
               "<div class='description'> <p>Description: " + result['weather'][0]['description'] + "</p></div>" +
               "<div class='wind'> <p>Wind Speed: " + result['wind']['speed']+ "</p></div>" +
               "<div class='humidity'> <p>Humidity: " + result['main']['humidity'] + "%</p></div>" +
               "<div class='pressure'> <p>Pressure: " + result['main']['pressure'] + " hpa</p></div></div></div>"

                 "</div>"+
                 "</div>";

               $('#container12').append(weatherData);
          
           //infowindow.setContent("<div id='container' style='width:100%; height:400px;'></div>");
        }); 

         var forcost = $.getJSON("http://api.openweathermap.org/data/2.5/forecast/daily?zip=" + zipcode + "&units=metric&cnt=7&appid=0fe84ad577e0d18b086b9bf4c00be983",function(result){

            $(result).each(function() {
                //alert(result['list'].length);
                for (var i = 0; i < result['list'].length; i++) {
            
          timestamp1 =  result['list'][i]['dt'];
          var jsDate1 = new Date(timestamp1*1000);
          var TodayDays1 = jsDate1.toDateString();

          if(TodayDays1.length > 3) TodayDays1 = TodayDays1.substring(0,3);
        
          var forcastTempFahrenheitMax = result['list'][i]['temp']['max'] * 1.8000 + 32.00;
          var forcastTempFahrenheitMin = result['list'][i]['temp']['min'] * 1.8000 + 32.00;

             var forcostData = 
            "<div class='forcastcls'><div class='days_detail'> <p>" +TodayDays1+ "</p></div>" +
                "<div class='icon_forcast'> <p>"+
                "<img src='http://openweathermap.org/img/w/" + result['list'][i]['weather'][0]['icon']+ ".png'></p></div>" +
                "<div class='temp_detail'> <p><span><b>" + forcastTempFahrenheitMax.toFixed(2) + " °</b></p><p><span>"+' '+"" + forcastTempFahrenheitMin.toFixed(2) + " °</p></div></div>";
                
                $('#container123').append(forcostData);
                }
        
            });

      }); 
       } else {
              alert("Something got wrong " + status);
            }
      });
       $("countryID"+idqq).trigger("click");
        infowindow.setPosition(event.latLng);
        infowindow.open(map,poly);
       // infowindow.setPosition(event.center);
       // map.panTo(event.latLng);
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);
        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);
        var trail_type = 'trail_report';
        var allWeatherinfo = 
        '<button id="countryID'+idqq+'" class="countryCls active" onClick="getCountyInfo('+idqq+',\''+content+'\',\''+trail_type+'\',<?php echo $user_id; ?>,);">Trail Conditions</button>'+
        "<button class='wetherInfobtn' onClick='getWetherInfo("+idqq+");'>Weather</button>"+
       
        '<button class="btn btn-info btn-lg updateTrailReport"  onClick="updateTrailReport('+idqq+',\''+content+'\',\''+readCookie('regionNameDropSes')+'\'); showUpdatePendingTrailReport('+idqq+',\''+content+'\',<?php echo $user_id; ?>,\''+readCookie('regionNameDropSes')+'\');">Update Trail Report</button>'+ 
        "<div  id='countyDetailId"+idqq+"' style='width:450px;height:auto;'>"+
        "<div class='countyDetail'></div>"+
        '<div id="weather_footer"><span class="sucIcon1" onclick="userSubc(\''+trail_type+'\',<?php echo $user_id; ?>,\''+content+'\');">Subscribe For Alerts</span></div>'+
        "</div>"+
        "<div id='weatherDetail"+idqq+"' style='display:none;'>"+
        "<div id='container12'></div>"+
        "<div id='forcostChat' style='width:450px;height:150px'></div>"+
        "<div id='container123'></div>"+
        '</div>'+
        
        "<div class='updateTrailReportform' id='updateTrailReportform"+idqq+"' style='display:none;width:450px;height:auto'></div>";

        infowindow.setContent(allWeatherinfo);
       $('#updateTrailCountryID').val(idqq);
       $('.countryCls').trigger('click');
    });
  
}


function showUpdatePendingTrailReport(CountryID,CountyName,userID,state_name){
  $('#weatherDetail'+CountryID).hide();
  $('#countyDetailId'+CountryID).hide();
  $('#updateTrailReportform'+CountryID).show();
  $('.wetherInfobtn').removeClass('active');
  $('.countryCls').removeClass('active');
  $('.updateTrailReport').addClass('active');

   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/showUpdatePendingTrailReport",
          data:{ CountyName: CountyName,userID: userID,state_name:state_name},
          success: function(data){
            if(data!=''){
              var data = JSON.parse(data);
              $('.updateTrailReportform').html(' <div id="updateSuccMsgRepot"></div><div id="updateerr"></div>'+
              '<form name="updateTrailReportFrm" id="updateTrailReportFrm" method="post">'+
                  '<input type="hidden" name="updateTrailCountryID" id="updateTrailCountryID" value="'+CountyName+'">'+
                  '<input type="hidden" name="userID" id="userID" value="<?php echo $user_id; ?>">'+
                  '<input type="hidden" name="state_name_trail_report" id="state_name_trail_report" value="'+state_name+'">'+
                      '<p><b>Trail Conditions:</b></p>'+
                      '<div class="filed"><textarea col="5" rol="50" name="updateTrailReportTxtar" id="updateTrailReportTxtar"> '+data.trail_report_conditions+'</textarea></div>'+
                      '<div class="filed"><button type="" name="updateTrailReportBtn" id="updateTrailReportBtn" value="Submit">Submit</button></div>'+
                  '</form>');
            }
          }
      });

  
}


function updateTrailReport(CountryID,CountryName,state_name){
  $('#weatherDetail'+CountryID).hide();
  $('#countyDetailId'+CountryID).hide();
  $('#updateTrailReportform'+CountryID).show();
  $('.wetherInfobtn').removeClass('active');
  $('.countryCls').removeClass('active');
  $('.updateTrailReport').addClass('active');
   $('.updateTrailReportform').html(' <div id="updateSuccMsgRepot"></div><div id="updateerr"></div>'+
    '<form name="updateTrailReportFrm" id="updateTrailReportFrm" method="post">'+
        '<input type="hidden" name="updateTrailCountryID" id="updateTrailCountryID" value="'+CountryName+'">'+
        '<input type="hidden" name="userID" id="userID" value="<?php echo $user_id; ?>">'+
         '<input type="hidden" name="state_name_trail_report" id="state_name_trail_report" value="'+state_name+'">'+
            '<p><b>Trail Conditions:</b></p>'+
            '<div class="filed"><textarea col="5" rol="50" name="updateTrailReportTxtar" id="updateTrailReportTxtar"> </textarea></div>'+
            '<div class="filed"><button type="" name="updateTrailReportBtn" id="updateTrailReportBtn" value="Submit">Submit</button></div>'+
        '</form>');
}
function CenterControl(controlDiv, map) {
   var controlUI = document.createElement('div'); 
   controlUI.style.marginBottom = '22px';
   controlUI.style.padding = '22px';
   controlDiv.appendChild(controlUI);

}
function getWetherInfo(CountryID){
  $('#weatherDetail'+CountryID).show();
  $('#countyDetailId'+CountryID).hide();
  $('#updateTrailReportform'+CountryID).hide();
  $('.wetherInfobtn').addClass('active');
  $('.countryCls').removeClass('active');
  $('.updateTrailReport').removeClass('active');
}

function getCountyInfo(CountryID, country_name) {
  $('#weatherDetail'+CountryID).hide();
  $('#countyDetailId'+CountryID).show();
  var region_name = readCookie('regionNameDropSes');
  $('#updateTrailReportform'+CountryID).hide();
  $('.wetherInfobtn').removeClass('active');
  $('.countryCls').addClass('active');
  $('.updateTrailReport').removeClass('active');
   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/getCountyInfo",
          data:{ CountryID: CountryID,country_name: country_name,region_name:region_name},
          success: function(data){
              var data = JSON.parse(data);
             $('.countyDetail').html('<div class="county-heading"><div class="county_name"><h4>'+data.county_name+'</h4></div>'+
              '<div class="cities">'+data.trail_conditions+'</div>'+
              '<div class="cities">'+data.maintainedBy+'</div>'+
              '<div class="maintainedBy">'+data.submitted_by+'</div></div>'+
              '<div class="county_detail">'+data.county_detail+'</div>'+
              '<div class="cities">'+data.cities+'</div>');
          }
      });
}

function userSubc(trail_type,userID,trail_name) {
  $('#subcMsg').show();
  $('#unsubscribeEmail').hide();
   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/userSubc",
          data:{userID: userID,trail_name:trail_name,trail_type:trail_type},
          success: function(data){
             if(data == 1){
              $('#subcMsg').show();
               $('#subcri-main-modalID').modal('show');
               $('#subcMsg').html(data);
               $('#unsubscribeEmail').hide();
             }else{
               $('#subcMsg').html(data);
               $('#subcri-main-modalID').modal('show');
             }
          }
      });
}
function updateSubc(userID) {
 var subEmail = $('#subEmail').val();
 $('#subcMsg').show();
   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/updateSubc",
          data:{subEmail: subEmail, userID:userID},
          success: function(data){
            $('#updateSubEmail').html(data).show();
             setTimeout(function(){$('#alreadySubcMsg').fadeOut();},
        5000);
             $('#subcEmailID').html(subEmail);
            $('#subEmail').val('');
          }
      });
}

function Unsubscribe(email,trail_name) {
 if (confirm('Are you sure you want to unsubscribe email for this trail?')) {
   $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/unsubscribe",
          data:{trail_name:trail_name},
          success: function(data){
             $('#unsubscribeEmail').html(data).show();
             $('#subcMsg').hide();
          
          }
      });
 }
}
function showFormUpdateSubc() {

$('#updateSubEmail').toggle();
}

function geocodeAddress(address, geocoder, resultsMap) {
 customZoom = 7;
map.setZoom(customZoom);
//alert();
 geocoder.geocode({
   'address': address
 }, function(results, status) {
   if (status === google.maps.GeocoderStatus.OK) {
     resultsMap.fitBounds(results[0].geometry.viewport);
     $('.newlat').val(results[0].geometry.location.lat());
     $('.newlng').val(results[0].geometry.location.lng());
       map.setZoom(customZoom);
    }
 });
}

/************************Distance Calculat*****************************************/
function calcDistance(p1, p2) {
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
var markers =[];          
var allMyMarkers = [];
var allMyMarkers2 = [];
var infoWindow;
$(document).on('click','#trail3',function(event) {
  if($(this).prop('checked') == false){
    for (var i = 0; i < allMyMarkers2.length; i++ ) {
        allMyMarkers2[i].setMap(null);
    }
    allMyMarkers2.length = 0;
    createCookie('LodgingCheckboxValue', $(this).prop('checked'), -1);
  }
});  
$(document).on('click','#trail3',function(event) {
  var val = [];
  $('.check_trail_reena:checked').each(function(i){
  val[i] = $(this).val();
  });
  var statename = $('#region_name_drop :selected').val();
  if($(this).prop('checked') == true){
    $.ajax({
        type: "POST",
        dataType:"json",
        url: '<?php echo base_url(); ?>ajax/lodging_poi',
        //data: $(this).serialize(),
        data: {statename:statename},
        success: function(data){
          createCookie('LodgingCheckboxValue', $(this).prop('checked'), 1);
          //remove_poi();
            if($('#region_name_drop :selected').val() != ''){ 
           markers = data.markers_detail1;

          infoWindow = new google.maps.InfoWindow(); 
           for (var i = 0; i < markers.length; i++) {
              var data = markers[i];
              var iconicon1 = {
              url: "<?php echo base_url();?>"+data.markerImage, // url
               scaledSize: new google.maps.Size(23, 29), // scaled size
              };
              var myLatlng = new google.maps.LatLng(data.kml_data_lat, data.kml_data_lang);
              var marker = new google.maps.Marker({
                  position: myLatlng,
                  map: map,
                  icon: iconicon1,
                  id: i,
                  title: data.title
              });
              allMyMarkers2.push(marker);
              //Attach click event to the marker
              (function (marker, data) {
                  google.maps.event.addListener(marker, "click", function (e) {
                    var reviewLi ='';
                    var vacID = data.vac_id;
                     $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>ajax/poiLodgingImage',
                        data: {'vacID' : vacID},
                        success: function(data){
                           $('.busImage').append('<img src='+data.replace(/\s/g, '')+' style="height:80px;width:80px;">');
                        }
                    });
                    
                   for(u=0;u<5;u++){

                    if(u<data.totalrating){
                       reviewLi += '<span><i class="fa fa-star"></i></span>';
                    }else{
                      reviewLi += '<span><i class="fa fa-star-o"></i></span>';
                    }
                   }
                     //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    // if(vacID != null){
                      infoWindow.setContent("<div style = 'width:300px;min-height:60px' class='MainPoiDetail'>" +
                        '<h5>'+ data.kml_data_name +'</h5>'+
                        '<div class="reviewRating">'+ reviewLi +'</div>'+
                        '<div class="withImgPoi"><div class="busImage"></div>'+
                        '<div class="mainInfoPoi"><div class="vac_address">'+ data.vac_address +'</div>'+
                        '<div class="sleepbus"><span>Sleeps</span><p>'+data.vac_sleep+'</p></div>'+
                        '<div class="sleepbus"><span>Bedroom</span><p>'+data.vac_no_of_bedroom+'</p></div>'+
                        '<div class="sleepbus"><span>Bathroom</span><p>'+data.vac_bathroom+'</p></div></div></div>'+
                        '<div class="viewBusDetail">'+
                        '<a href="<?php echo base_url(); ?>lodging/'+data.vac_slag+'" target="_blank">View Detail</a>'+
                        '</div>'+
                        "</div>");
                   // }
                      
                      infoWindow.open(map, marker);
                  });

                  
              })(marker, data);
          }
        }else{
           $('#msgBox').html('<p>Please select state</p>').show().fadeOut(5000);
        }
      }
    });
  }
 });


var LodgingCheckboxValue = readCookie('LodgingCheckboxValue');
if(LodgingCheckboxValue != null){
$( window ).on( "load",function(){
var statename = readCookie('regionNameDropSes');
var LodgingCheckboxValue = readCookie('LodgingCheckboxValue');
if(LodgingCheckboxValue != '' ){

var markers =[];
    if(LodgingCheckboxValue.length>= 0)
     {

      $.ajax({
        type: "POST",
        dataType:"json",
        url: '<?php echo base_url(); ?>ajax/lodging_poi',
       // data: $(this).serialize(),
        data: {statename:statename},
        success: function(data){
          //remove_poi();
        if($('#region_name_drop :selected').val() != ''){ 
          markers = data.markers_detail1;
          infoWindow = new google.maps.InfoWindow(); 
           for (var i = 0; i < markers.length; i++) {
              var data = markers[i];
              var iconicon1 = {
              url: "<?php echo base_url();?>"+data.markerImage, // url
               scaledSize: new google.maps.Size(23, 29), // scaled size
              };
              var myLatlng = new google.maps.LatLng(data.kml_data_lat, data.kml_data_lang);
              var marker = new google.maps.Marker({
                  position: myLatlng,
                  map: map,
                  icon: iconicon1,
                  id: i,
                  title: data.title
              });
              allMyMarkers2.push(marker);
              //Attach click event to the marker
              (function (marker, data) {
                  google.maps.event.addListener(marker, "click", function (e) {
                    var reviewLi ='';
                    var vacID = data.vac_id;
                     $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>ajax/poiLodgingImage',
                        data: {'vacID' : vacID},
                        success: function(data){
                           $('.busImage').append('<img src='+data.replace(/\s/g, '')+' style="height:80px;width:80px;">');
                        }
                    });
                    
                   for(u=0;u<5;u++){

                    if(u<data.totalrating){
                       reviewLi += '<span><i class="fa fa-star"></i></span>';
                    }else{
                      reviewLi += '<span><i class="fa fa-star-o"></i></span>';
                    }
                   }
                     //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    // if(vacID != null){
                      infoWindow.setContent("<div style = 'width:300px;min-height:60px' class='MainPoiDetail'>" +
                        '<h5>'+ data.kml_data_name +'</h5>'+
                        '<div class="reviewRating">'+ reviewLi +'</div>'+
                        '<div class="withImgPoi"><div class="busImage"></div>'+
                        '<div class="mainInfoPoi"><div class="vac_address">'+ data.vac_address +'</div>'+
                        '<div class="sleepbus"><span>Sleeps</span><p>'+data.vac_sleep+'</p></div>'+
                        '<div class="sleepbus"><span>Bedroom</span><p>'+data.vac_no_of_bedroom+'</p></div>'+
                        '<div class="sleepbus"><span>Bathroom</span><p>'+data.vac_bathroom+'</p></div></div></div>'+
                        '<div class="viewBusDetail">'+
                        '<a href="<?php echo base_url(); ?>lodging/'+data.vac_slag+'" target="_blank">View Detail</a>'+
                        '</div>'+
                        "</div>");
                   // }
                      
                      infoWindow.open(map, marker);
                  });

                  
              })(marker, data);
          }
         }else{
           $('#msgBox').html('<p>Please select state</p>').show().fadeOut(5000);
         }
        }
    });
    
    }

}
});
}






/***********************POI Data Load ****************************/

function trail_detail()
{
var statename;
var regionNameDropval = readCookie('regionNameDropSes');
if(regionNameDropval){
  statename = regionNameDropval;
}else{
  statename = $('#region_name_drop :selected').val();
}

var markers =[];
var val = [];
        $('.check_trail_reena:checked').each(function(i){
          val[i] = $(this).val();
        });
 var seseionvalue = 'main';
   if(val.length>= 0)
   {
   $.ajax({
          type:"POST",
          dataType:"json",
          url:"<?php echo base_url(); ?>ajax/getKmlByPoi",
          data: {trail_ID:val,statename:statename,seseionvalue:seseionvalue},
          success: function(data) {
          createCookie('checkboxValue', val, 1);  
          remove_poi();
          if($('#region_name_drop :selected').val() != ''){ 
            markers = data.markers_detail;
            infoWindow = new google.maps.InfoWindow(); 
           for (var i = 0; i < markers.length; i++) {
              var data = markers[i];
              var iconicon1 = {
              url: "<?php echo base_url();?>"+data.markerImage, // url
               scaledSize: new google.maps.Size(23, 29), // scaled size
              };
              var myLatlng = new google.maps.LatLng(data.kml_data_lat, data.kml_data_lang);
              var marker = new google.maps.Marker({
                  position: myLatlng,
                  map: map,
                  icon: iconicon1,
                  id: i,
                  title: data.title
              });
              allMyMarkers.push(marker);
              //Attach click event to the marker
              (function (marker, data) {
                  google.maps.event.addListener(marker, "click", function (e) {
                  
                       infoWindow.setContent("<div style = 'width:300px;min-height:60px'>" +
                        '<h5>'+ data.kml_data_name +'</h5>'+
                        "</div>");
                      infoWindow.open(map, marker);
                  });

                  
              })(marker, data);
          }

          }else{
             // alert('Please select state');
              $('#msgBox').html('<p>Please select state</p>').show().fadeOut(5000);
          }
      }
    });
 }
 else {
     remove_poi();
  } 
 }

var readCheckboxval = readCookie('checkboxValue');

if(readCheckboxval != null){
var array = readCheckboxval.split(",");
for (i=0;i<array.length;i++){
    $inputs = $('input[name^=trailName]');
    $inputs.filter('[value="'+array[i]+'"]').attr('checked','checked');
}

$( window ).on( "load",function(){
var regionNameDropval = readCookie('regionNameDropSes');
var trailReportRegionSes = readCookie('trailReportRegionSes');
var region_name = regionNameDropval;
var readCheckboxval = readCookie('checkboxValue');
var val = [];
        $('.check_trail_reena:checked').each(function(i){
          val[i] = $(this).val();
        });
if(regionNameDropval != '' && val != ''){

var statename = readCookie('regionNameDropSes');
$('#region_name_drop').val(statename);
//var statename = sessionStorage.getItem('regionNameDropSes');
var markers =[];
var seseionvalue = 'sessionData';
    if(val.length>= 0)
     {
     $.ajax({
            type:"POST",
            dataType:"json",
            url:"<?php echo base_url(); ?>ajax/getKmlByPoi",
            data: {trail_ID:val,statename:statename, seseionvalue: seseionvalue},
            success: function(data) {

            remove_poi();
            if($('#region_name_drop :selected').val() != ''){ 
              markers = data.markers_detail;
            var infoWindow = new google.maps.InfoWindow(); 
             for (var i = 0; i < markers.length; i++) {
                var data = markers[i];
                var iconicon1 = {
                url: "<?php echo base_url();?>"+data.markerImage, // url
                 scaledSize: new google.maps.Size(23, 29), // scaled size
                };
                var myLatlng = new google.maps.LatLng(data.kml_data_lat, data.kml_data_lang);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    icon: iconicon1,
                    id: i,
                    title: data.title
                });
                allMyMarkers.push(marker);
                //Attach click event to the marker
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                       //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                         infoWindow.setContent("<div style = 'width:300px;min-height:60px'>" +
                          '<h5>'+ data.kml_data_name +'</h5>'+
                          "</div>");
                        
                        infoWindow.open(map, marker);
                    });

                    
                })(marker, data);
            }

            }else{
               // alert('Please select state');
                $('#msgBox').html('<p>Please select state</p>').show().fadeOut(5000);
            }
        }
      });
    }

}


});
}
function remove_poi(){
  for (var i = 0; i < allMyMarkers.length; i++ ) {
    allMyMarkers[i].setMap(null);
  }
  allMyMarkers.length = 0;
}

$("#routePlnSve").click(function(event) {
   event.preventDefault();
   $('.main-modal1').show();
   $('.main-modal').hide();

});
$("#my_route_name").change(function(event) {
    $('#error-msg').hide();
});
$("#trl-pln-cls1").click(function(event){
   event.preventDefault();
    $(".main-modal1").hide(); 
});

$("#trl-update-cls1").click(function(event){
   event.preventDefault();
    $(".update-trail-modal1").hide(); 
});

$("#updateTrailSve").click(function(event) {
   event.preventDefault();
   $('.update-trail-modal1').show();  
});
$("#routePlanningFrm").submit(function(event) {
  event.preventDefault();
  if($('#my_route_name').val() == ''){
     $('#error-msg').show();
  }else{
     $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>ajax/saverouteplanning',
        data: $(this).serialize(),
        async: false,
        success: function(data){
             
              //$('#routePlanningFrm')[0].reset();
              <?php if(isset($_GET['id'])){ ?>
                if(data == 1){
                  $('#succMsg').html('<div class="alert alert-success">Update route successfully</div>').show().fadeOut(10000);
                   location.reload();
                }
              <?php }else{ ?>
                $('#my_route_name').val('');
                $('.trailDetail').html('');
                $('.totlaDis').html('0.0');
                  $('#succMsg').html('<div class="alert alert-success">Add route name successfully</div>').show().fadeOut(10000);
              <?php }?>
             $(".main-modal1").fadeOut(10000);
            

        }
    });
  }
 
 });

$("#updatetrailstsFrm").submit(function(event) {
  event.preventDefault();
  if($('#trail_description').val() == ''){
     //$('#errorupdatetrailstsFrm').show();
     $('#errorupdatetrailstsFrm').html('<div class="alert alert-danger">Please enter trail description</div>').show().fadeOut(10000);
  }else if($('#update_status').val() == ''){
    $('#errorupdatetrailstsFrm').html('<div class="alert alert-danger">Please select update status</div>').show().fadeOut(10000);
  }else{
     $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>ajax/updatetrailsts',
        data: $(this).serialize(),
        success: function(data){
          if(data == 1){
            $('#updateSuccMsg').html('<div class="alert alert-success">Thanks! Your update is pending review.</div>').show().fadeOut(10000);
              $('#updatetrailstsFrm')[0].reset();
              $(".update-trail-modal1").fadeOut(5000);
          }
               
        }
    });
  }
 
 });
 $(document).on('submit','#updateTrailReportFrm',function(event) {
  event.preventDefault();
  if(!$.trim($("#updateTrailReportTxtar").val())){
    $('#updateerr').html('<div class="alert alert-danger">Please enter Trail Report description</div>').show().fadeOut(10000);
  }else{
     $("#ajax_favorite_loddder").show();
     $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>ajax/updateTrailReport',
        data: $(this).serialize(),
        success: function(data){
          if(data == 1){
              $("#ajax_favorite_loddder").hide();
              $('#updateSuccMsgRepot').html('<div class="alert alert-success">Thanks! Your update is pending review.</div>');
              $('#updateTrailReportFrm')[0].reset();
              $("#updateTrailReport").fadeOut(5000); 
          }else if(data == 2){
              $("#ajax_favorite_loddder").hide();
              $('#updateSuccMsgRepot').html('<div class="alert alert-success">Thanks! Your update is pending review.</div>');
          }
        }
    });
   }
  return false;
 });

function countyTrail(data){
      for (var i = 0; i < data.length; i++) {
      var str_old = data[i]['lat_lang'].replace(/\s/g, '');
      var latValue;
      var lngValue;
      var separated = str_old.split(",0");
      var locations =[];
      for (var j = 0, length = separated.length; j < length; j++) {
          var chunk = separated[j];

          var separated1 = chunk.split(",");
          lngValue = separated1[0];
          latValue = separated1[1];
          if((lngValue != '') && (latValue != '') && (lngValue !== 'undefined') && (latValue !== 'undefined')){
            locations.push([parseFloat(latValue) , parseFloat(lngValue)]); 
          }
      }
       
        var polyOptions = {
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0
        }
        poly = new google.maps.Polygon(polyOptions);
        poly.setMap(map); 
        linePolygon.push(poly);  

         path = poly.getPath();    
         for (var k= 0; k < locations.length; k++) {
           var loc = locations[k];
         path.push(new google.maps.LatLng(loc[0], loc[1]));
       }
       
      createInfoWindowTrailReport(poly, data[i]['county_name'],data[i]['zipcode'], data[i]['id'] );
      }
} 


function deleteCountyTrail() {
  if (poly) {
    poly.setMap(null);
   
  }
}
function readmore(i){
    $('.trailDescMore'+i+'').hide();
    $('.trailDescless'+i+'').show();
    $('.trailDes'+i+'').addClass('readmore');
}
function readless(i){
    $('.trailDescless'+i+'').hide();
    $('.trailDescMore'+i+'').show();
    $('.trailDes'+i+'').removeClass('readmore');
}

function openNav() {
    document.getElementById("mySidenav").style.left = "0px";
    $(".route-select").removeClass("route-normal");
    $(".trail-content").removeClass("trail-content-open");
    $("#open-nav-id").addClass("dp-no");
    $(".closebtn").removeClass("dp-no");
}
function closeNav() {
    document.getElementById("mySidenav").style.left = "-290px";
    $(".route-select").addClass("route-normal");
    $(".trail-content").addClass("trail-content-open");
    $("#open-nav-id").removeClass("dp-no");
    $(".closebtn").addClass("dp-no");
}
function openNav2() {
   document.getElementById("mySidenav2").style.right = "0px";
    document.getElementById("open-nav-id2").style.right = "310px";
    document.getElementById("open-nav-id2").style.display = "none";
    document.getElementById("clse-nav").style.display = "block";
    
}

function closeNav2() {
    document.getElementById("mySidenav2").style.right = "-320px";
    document.getElementById("open-nav-id2").style.display = "block";
    document.getElementById("clse-nav").style.display = "none";
}
$('#subcri-cls1').click(function(){
//  $(".subcri-main-modal1").hide();
  $('#subcri-main-modalID').modal('hide');
});
<?php if(isset($_GET['id'])){ ?>
$( window ).on( "load",function(){
  $(".main-modal").show();
$('#region_name_drop').val('<?php echo $query_params['state_name'];?>');
var pageURL = $(location).attr("href");
var split11 = location.search.replace('?', '').split('&')
var id = split11[0].replace('id=', '');
$("#ajax_favorite_loddder").show();
var region_name1 = split11[1].replace('state_name=', '');
var region_name=region_name1.replace("%20", " ");
//$('#region_name_drop').val('');
createCookie('regionNameDropSes', '<?php echo $query_params['state_name'];?>', 1);
readCookie('regionNameDropSes');
$.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/routePlanningData",
        data:{region_name: region_name,id:id},
        success: function(data){
         if(data == 1){
            $("#ajax_favorite_loddder").hide();
              $('#myModelSharedRouteView').modal('show');
              $('.main-modal').hide();
              $('input[name=s_h_groomed_trail]').prop('checked', false).triggerHandler('click');
              var url = window.location.href;  
              var  arr = url.split("?");
              //alert(arr[0]);
              RefreshPageUrl('test', arr[0]);
              $(".trailreportcls").remove();
            }else{
                $("#ajax_favorite_loddder").hide();

              var data1 =$.parseJSON(data);
              createTrail(data1);
              trail_detail();
              var sum = 0;
              $('.routeDis').each(function() {
              sum += +$(this).text()||0;
              });
              $(".totlaDis").text(sum.toFixed(2));
            }
          
         //geocodeAddress(region_name, geocoder, map);
        }
    });
});



<?php } if(isset($_GET['uid'])){

  ?>
$( window ).on( "load",function(){

var pageURL = $(location).attr("href");
var split11 = location.search.replace('?', '').split('&')
var id = split11[0].replace('uid=', '');
//alert(id);
$("#ajax_favorite_loddder").show();
var region_name1 = split11[1].replace('state_name=', '');
var region_name=region_name1.replace("%20", " ");
//alert(region_name);
var trail_name1 = split11[2].replace('trail=', '');
var trail1= trail_name1.replace(/-/g,' ');
//alert(trail1);
$.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/shareDatatrail",
        data:{region_name: region_name,trail1:trail1,id:id},
        success: function(data){
          $("#ajax_favorite_loddder").hide();

         var data1 =$.parseJSON(data);
         createTrail(data1);
         trail_detail();
         var sum = 0;
         $('.routeDis').each(function() {
           sum += +$(this).text()||0;
          });
         $(".totlaDis").text(sum.toFixed(2));
        geocodeAddress(region_name, geocoder, map);
        }
    });
});

<?php }
if(isset($_GET['tid'])){ ?>
$( window ).on( "load",function(){
var pageURL = $(location).attr("href");
var split11 = location.search.replace('?', '').split('&')
var id = split11[0].replace('tid=', '');
$("#ajax_favorite_loddder").show();
var region_name1 = split11[1].replace('state_name=', '');
var region_name=region_name1.replace("%20", " ");
 createCookie('regionNameDropSes', region_name, 1);
$.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/mysaveroute",
        data:{region_name: region_name,id:id},
        success: function(data){
          $("#ajax_favorite_loddder").hide();

         var data1 =$.parseJSON(data);
         createTrail(data1);
         trail_detail();
         $('input[name=s_h_groomed_trail]').prop('checked', true).triggerHandler('click');
        // trail_detail();
        // var sum = 0;
        // $('.routeDis').each(function() {
        //   sum += +$(this).text()||0;
        //  });
        // $(".totlaDis").text(sum.toFixed(2));
       // geocodeAddress(region_name, geocoder, map);
        }

    });

});
<?php } ?>

$(document).on('click', '.trlPlningRmve',function(){
  var r_name = $(this).attr('id');
  var arr = r_name.split('_')
  $('.trailReport'+arr[1]).remove();
  var sum = 0.0;
         $('.routeDis').each(function() {
           sum += +$(this).text()||0;
          });
         $(".totlaDis").text(sum.toFixed(2));
});


$(document).on('click', '#routePlnSve',function(){
var x = $('#MyRouteplan').html();
$('#saveRouteNewData').append(x);

});
function createCookie(name, value, days) {
   var expires;
   if (days) {
       var date = new Date();
       date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
       expires = "; expires=" + date.toGMTString();
   } else {
       expires = "";
   }
   document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}
function readCookie(name) {
   var nameEQ = encodeURIComponent(name) + "=";
   var ca = document.cookie.split(';');
   for (var i = 0; i < ca.length; i++) {
       var c = ca[i];
       while (c.charAt(0) === ' ') c = c.substring(1, c.length);
       if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
   }
   return null;
}
function viewClassified(id){
 $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/viewClassified",
        data:{id: id},
        success: function(data){
          $('#removeClass_'+id).remove();
        }
    });

}

function newsfeed_viewTrail(trail_name,sub_id){
 $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/newsfeed_viewTrail",
        data:{trail_name: trail_name},
        success: function(data){
          $('#news-feed-sub'+sub_id).remove();
        }
    });

}
function newsfeed_trailnotification(s_t_id,url){

$.ajax({
    type:'POST',
    url:'<?php echo base_url(); ?>ajax/newsfeed_trail_notification',
    data:{ s_t_id:s_t_id},
    success: function(data){
      if(data == 1){
        $('#news-feed-sub'+s_t_id).remove();
        
      }
    }
});

}

</script>
