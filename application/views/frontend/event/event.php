<style type="text/css">
#owl-demo .item img{
display: block;
width: 100%;
height: auto;
}
.ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
</style>
<?php $this->load->view('include/header_css');?>
<body>
    <header class="navigation">
        <div class="top-bar">
            <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
        </div>
        
        <nav class="navbar">
            <?php $this->load->view('include/nav_header.php'); ?>
        </nav>
    </header>
    <div class="wrapper event-wrap">
        <section class="my-news-sec">
            <div class="container">
              <div class="row">
                <div class="col-md-9">
                <div class="heading-news">
                    <h4>Featured Events</h4>
                </div>
                <div id="demo" class="">
                    <div id="owl-demo" class="owl-carousel">
                        <?php if(isset($latestEventsList)){
                        foreach ($latestEventsList as $latestEvents) {
                        $words = explode(" ",$latestEvents->event_description);
                        $content = implode(" ",array_splice($words,0,50));
                        ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="news-img">
                                        <?php
                                        if(isset($latestEvents->event_id)){ $eventID = $latestEvents->event_id;}
                                        $query =$this->db->query("select DISTINCT event_id, event_image_path from tbl_event_image where event_id = ".$eventID."");
                                        $eventsImages = $query->result();
                                        foreach ($eventsImages as $eventsImage) { ?>
                                        <img src="<?php if(isset($eventsImage->event_image_path) && !empty($eventsImage->event_image_path)){echo base_url().$eventsImage->event_image_path;}?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="news-txt">
                                        <h3 class="evnt-title"><?php if(isset($latestEvents->event_title)) {echo $latestEvents->event_title; }?></h3>
                                        <p class="evnt-dec">
                                            <?php if(isset($latestEvents->event_description)){echo $latestEvents->event_description;} ?>
                                        </p>
                                        
                                        <div class="event-details-add">
                                            <div class="ppv-detl-sub">
                                                <i class="fa fa-map-marker"></i>
                                                <span class="add-vac">
                                                <?php //if(isset($latestEvents->event_venue)){echo $latestEvents->event_venue;} ?>  <?php if(isset($latestEvents->venue_address)){echo $latestEvents->venue_address;} ?></span>
                                            </div>
                                            <div class="ppv-detl-sub">
                                                <i class="fa fa-clock-o"></i>
                                                <span class="add-vac"><?php if(isset($latestEvents->event_start_time)){echo $latestEvents->event_start_time;} ?> to
                                                 <?php if(isset($latestEvents->all_day_event) && $latestEvents->all_day_event == 1) { 
                                                  echo 'All Day Event';
                                                 }else{
                                                  ?>
                                                <?php if(isset($latestEvents->event_end_time)){echo $latestEvents->event_end_time;} ?>
                                                <?php } ?></span>
                                            </div>
                                            <div class="ppv-detl-sub">
                                                <i class="fa fa-calendar"></i>
                                                <span class="add-vac"><?php if(isset($latestEvents->event_date)){$date = date_create($latestEvents->event_date);
                                                echo date_format($date, 'd M Y');}?></span>
                                            </div>
                                        </div>
                                        <p><a class="view-btn-event" href="<?php echo base_url().'eventdetail/'.$latestEvents->event_id; ?>">Read More</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }   } ?>
                        
                    </div>
                </div>
                <div class="main-nws-head">
                </div>
                <div class="mnm-sub">
                  <div class="row" >
                    <div class="col-md-12" id="postList">
                      <!--<?php //$this->load->view('frontend/event/event_data', $eventList); ?>-->
                    </div>
                  </div>
                  <div id="loader_image"><img src="<?php echo base_url(); ?>assets/images/loading11.gif" alt="" width="24" height="24"> Loading please wait...</div>
                  <div id="loader_message"></div>
                </div>
                <?php if(isset($segment)) {
                if($segment == 'events'){ ?>
                      <div class="post-event-cls"><a href="<?php echo base_url(); ?>pastevents">See Past Events</a></div>
                <?php }else{ ?>
                      <div class="post-event-cls"><a href="<?php echo base_url(); ?>events">See Upcoming Events</a></div>
                <?php }  }?>
                </div>
                <div class="col-md-3">
                  <div class="forum-google-ad">
                    <div class="google-ad" style="width: 100% !important;">
                      <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Forum'));
                      ?>
                      <style>
                      .example_responsive_1 { width: 100% !important; height: 600px !important; }
                      </style>
                      <script async src="<?php if(isset($googleAds->script_url)){ echo $googleAds->script_url; }else{echo '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';} ?>"></script>
                      <ins class="adsbygoogle example_responsive_1"
                      style="display:inline-block"
                      data-ad-client="<?php if(isset($googleAds->google_ad_client)){ echo $googleAds->google_ad_client; }else{echo 'ca-pub-2773616400896769';} ?>"
                      data-ad-slot="<?php if(isset($googleAds->slot_id)){ echo $googleAds->slot_id; }else{echo '3977017541';} ?>"></ins>
                      <script>
                      (adsbygoogle = window.adsbygoogle || []).push({});
                      </script>
                    </div>
                  </div>
                </div>
              </div>
                
            </div>
        </section>
        <div class="ajax-load text-center" style="display:none">
           <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>
        
      
       <!--  <section class="my-news-main">
            <div class="container">
                <div class="row">
                  <div class="col-md-9">
                    <div class="main-nws-head">                    
                    </div>
                    <div class="mnm-sub">
                        <div class="row" >
                            <div class="col-md-12" id="postList">
                            <?php //$this->load->view('frontend/event/event_data', $eventList); ?>
                           </div>
                        </div>
                        <div id="loader_image"><img src="<?php echo base_url(); ?>assets/images/loading11.gif" alt="" width="24" height="24"> Loading please wait...</div>
                        <div id="loader_message"></div>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                </div>

            </div>
        </section> -->
        
      
    </div>
    
    <footer class="main_footer">
        <?php $this->load->view('include/main_footer.php'); ?>
    </footer>
    <div class="copy-right">
        <?php $this->load->view('include/copyright.php'); ?>
    </div>
    
</body>
</html>
<script type="text/javascript">
      var busy = false;
      var limit = 4;
      var offset = 0;

      function displayRecords(lim, off) {
        var pageName = '<?php echo $segment; ?>';
        $.ajax({
          type: "GET",
          async: false,
          url: "<?php echo base_url().'ajax/load_more_pagination'; ?>",
          data: "limit=" + lim + "&offset=" +off+ "&pageName=" + pageName,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html) {
            $("#postList").append(html);
            $('#loader_image').hide();
            if (html == "") {
              $("#loader_message").html('<button class="btn btn-default" type="button">No more events to show.</button>').show()
            } else {
             // $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
              $('#loader_image').show();
            }
            window.busy = false;


          }
        });
      }

      $(document).ready(function() {
       // alert(1);
        // start to load the first set of data
        if (busy == false) {
          busy = true;
          // start to load the first set of data
          displayRecords(limit, offset);
        }


        $(window).scroll(function() {
          // make sure u give the container id of the data to be loaded in.
          if ($(window).scrollTop() + $(window).height() > $("#postList").height() && !busy) {
            busy = true;
            offset = limit + offset;

            // this is optional just to delay the loading of data
            setTimeout(function() { displayRecords(limit, offset); }, 500);

            // you can remove the above code and can use directly this function
            // displayRecords(limit, offset);

          }
        });

      });

    </script>