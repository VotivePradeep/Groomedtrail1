<?php $this->load->view('include/header_css');?>
<style>
a.hrefcls {
    background: transparent !important;
    color: #000 !important;
    float: none !important;
    box-shadow: none !important;
}
a.hrefcls:hover {
    transform: translateY(0%) !important;
    color: #387fcb !important;
}
.top-news-side .main-nws-head {
    border-color: #292929;
    margin-top: 10px !important;
}	
</style>
<body>
	<header class="navigation">
		<div class="top-bar">
			<?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
		</div>
		
		<nav class="navbar">
			<?php $this->load->view('include/nav_header'); ?>
		</nav>
	</header>
	<div class="wrapper">
		<section class="news-img-inner">
			<div class="container">
				<div class="col-md-8">
					<div class="image-gallery thum-gallery">
			            <div class="my-slider-demo">
			              <div id="demo">
			                <div id="sync1" class="owl-carousel">
								<?php
								if(isset($events->event_id)){ $eventId = $events->event_id;}
								$query =$this->db->query("select * from tbl_event_image where event_id = ".$eventId."");
								$eventsImagesSlider = $query->result();
								foreach ($eventsImagesSlider as $image) { ?>
			                  <div class="item">
			                    <div class="img-gallery-lt">
			                      <img src="<?php if(isset($image->event_image_path) && !empty($image->event_image_path)){echo base_url().$image->event_image_path;}?>">
			                    </div>
			                  </div>
			                <?php  } ?>
			                </div>

			                <div id="sync2" class="owl-carousel">
			               <?php if(isset($eventsImagesSlider)) {  
			                      foreach ($eventsImagesSlider as $image1) { ?>
			                  <div class="item">
			                    <div class="slide-thumb-img">
			                      <img src="<?php if(isset($image1->event_image_path) && !empty($image1->event_image_path)) { echo base_url().$image1->event_image_path; } ?>">
			                    </div>
			                  </div>
			               <?php  } } ?>

			                </div>
			              </div>
			            </div>
			          </div>
					<div class="details">
						<div class="news-main-txt">
							<h3><?php if(isset($eventDetail[0]->event_title)){echo $eventDetail[0]->event_title;}?>
								<?php if(isset($eventDetail[0]->user_id)){
									$query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$eventDetail[0]->user_id."");
                      $result = $query->result();
                      echo '<span style="float:right;font-size: 12px;">'.$result[0]->fname.'</span>';
								}?>
								
							</h3>
							
							<p><?php if(isset($eventDetail[0]->event_description)){echo $eventDetail[0]->event_description;}?></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="top-news-side">
						<div class="main-nws-head">
							<div class="heading-news">
								<h3>Event Details</h3>
							</div>
						</div>
						<ul>
							<li>
								<div id="responseMsg"></div>
								<p><b>Date: </b><?php if(isset($eventDetail[0]->event_date)){$date = date_create($eventDetail[0]->event_date);
								echo date_format($date, 'd M Y');}?></p>
								<p><b>Time: </b><?php if(isset($eventDetail[0]->event_start_time)){ echo $eventDetail[0]->event_start_time; }?> 
									<?php if(isset($eventDetail[0]->all_day_event) && $eventDetail[0]->all_day_event == 1) { 
                                     }else{
                                      ?>
                                      to
                                    <?php if(isset($eventDetail[0]->event_end_time)){echo$eventDetail[0]->event_end_time;} ?>
                                    <?php } ?></p>
								<p><b>Location: </b></p>
								<p><?php if(isset($eventDetail[0]->event_venue)){ echo $eventDetail[0]->event_venue; }?></p>
                                <p><?php if(isset($eventDetail[0]->venue_address)){ echo $eventDetail[0]->venue_address; }?></p>
								<div class="right-side-text" ><a href="https://www.google.com/maps/?q=<?php if(isset($eventDetail[0]->event_lat)){ echo $eventDetail[0]->event_lat; }?>,<?php if(isset($eventDetail[0]->event_lang)){ echo $eventDetail[0]->event_lang; }?>" target="_black">Google Map</a> 
									<span id="eventSub"><?php
									$result = $this->model->get_row('tbl_event_subscribe', array('eve_id' =>$eventDetail[0]->event_id,'eve_sub_user_id' =>$user_id));
									if(isset($result) && !empty($result)){
									if(($result->eve_id == $eventDetail[0]->event_id) && ($result->eve_sub_user_id == $user_id) ) { ?>

									<a href="#" onclick="event_sub_fun(<?php if(isset($eventDetail[0]->event_id)){ echo $eventDetail[0]->event_id; }?>, <?php echo $user_id; ?>, 'unsub');"> Unsubscribe </a>

									<?php } }else{ ?>

                                    <a href="#" onclick="event_sub_fun(<?php if(isset($eventDetail[0]->event_id)){ echo $eventDetail[0]->event_id; }?>, <?php echo $user_id; ?>,'sub');"> Subscribe </a> 
									 

									<?php } ?>
								   </span>
								</div>

							</li>
						</ul>
					</div>
					<div class="top-news-side">
						<div class="main-nws-head">
							<div class="heading-news">
								<h3>Organizer Contact</h3>
							</div>
						</div>
						<ul>
							<li>
								<p><b>Name: </b><?php if(isset($eventDetail[0]->event_contact_person_name)){echo ucfirst($eventDetail[0]->event_contact_person_name); }?></p>
								<p><b>Phone: </b><?php if(isset($eventDetail[0]->event_contact_no)){ echo $eventDetail[0]->event_contact_no; }?> </p>
								<p><b>Email: </b><?php if(isset($eventDetail[0]->event_email_id)){ echo $eventDetail[0]->event_email_id; }?></p>
                                <p><b>Web: </b><a href="<?php if(isset($eventDetail[0]->event_wed_site)){ echo $eventDetail[0]->event_wed_site; }?>" class="hrefcls" target="_blank"><?php if(isset($eventDetail[0]->event_wed_site)){ echo $eventDetail[0]->event_wed_site; }?></a></p>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</section>
	</div>
	
	<footer class="main_footer">
		<?php $this->load->view('include/main_footer');?>
	</footer>
	<div class="copy-right">
		<?php $this->load->view('include/copyright');?>
	</div>
</body>
</html>
<script>
	function event_sub_fun(event_id,user_id,sub_type) {
		$("#ajax_favorite_loddder").show();
		jQuery.ajax({
		type: "POST",
		url : "<?php echo base_url();?>ajax/event_sub_fun",
		data: { event_id: event_id,user_id:user_id,sub_type:sub_type },
		success:function(data){
			$("#ajax_favorite_loddder").hide();
			if(data == 1){
		       $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully added to this event.You will now receive updates on the latest news.</div>').show().fadeOut(10000);
		       $('#eventSub a').text('Unsubscribe');
		       
		    }else{
		      $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your email address has been successfully unsubscribe for this event.</div>').show().fadeOut(10000);
		      $('#eventSub a').text('Subscribe');

		    }
		}

		});
		
	}

	  $(document).ready(function() {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    sync1.owlCarousel({
      singleItem : true,
      slideSpeed : 1000,
      navigation: true,
      pagination:false,
      afterAction : syncPosition,
      responsiveRefreshRate : 200,
    });
    sync2.owlCarousel({
      items : 10,
      itemsDesktop      : [1199,10],
      itemsDesktopSmall     : [979,7],
      itemsTablet       : [768,5],
      itemsMobile       : [479,4],
      pagination:false,
      responsiveRefreshRate : 100,
      afterInit : function(el){
        el.find(".owl-item").eq(0).addClass("synced");
      }
    });

    function syncPosition(el){
      var current = this.currentItem;
      $("#sync2")
        .find(".owl-item")
        .removeClass("synced")
        .eq(current)
        .addClass("synced")
      if($("#sync2").data("owlCarousel") !== undefined){
        center(current)
      }

    }

    $("#sync2").on("click", ".owl-item", function(e){
      e.preventDefault();
      var number = $(this).data("owlItem");
      sync1.trigger("owl.goTo",number);
    });

  });
</script>