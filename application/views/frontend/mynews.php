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
<div class="wrapper">
    <section class="my-news-sec">
        <div class="container">
        	<div class="row">
        	<div class="col-md-9">
        	<div class="heading-news">
                <h4>Latest News</h4>
            </div>
            <div id="demo" class="">
                <div id="owl-demo" class="owl-carousel">
                <?php if(isset($latestNewsList)){
                     foreach ($latestNewsList as $latestNews) {
                        $words = explode(" ",$latestNews->news_description);
                        $content = implode(" ",array_splice($words,0,50));

                      ?>
                  <div class="item">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="news-img">
                                <img src="<?php if(isset($latestNews->news_image) && !empty($latestNews->news_image)){echo base_url().$latestNews->news_image;}?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="news-txt">
                                <h2><?php if(isset($latestNews->news_title)){echo $latestNews->news_title;}?></h2>
                                <p><?php if(isset($latestNews->news_update_date)){$date = date_create($latestNews->news_update_date); 
                            echo date_format($date, 'd M Y h:i A');}?></p>
                                <p><?php if(isset($content)){echo $content;}?></p>
                                <button onclick="window.location.href='<?php echo base_url().'newdetail/'.$latestNews->news_id; ?>'">Read More</button>
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
                <div class="row" id="postList"></div>
                <div id="loader_image"><img src="<?php echo base_url(); ?>assets/images/loading11.gif" alt="" width="24" height="24"> Loading please wait...</div>
             <div id="loader_message"></div>
          </div>

        	</div>
        	<div class="col-md-3">
             <div class="forum-google-ad">
                <div class="google-ad" style="width: 100% !important;">
                  <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'News'));
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
    <!-- <section class="my-news-main">
        <div class="container">
        	<div class="row">
        	<div class="col-md-9">
             <div class="main-nws-head">                
            </div>
            <div class="mnm-sub">
                <div class="row" id="postList"></div>
                <div id="loader_image"><img src="<?php echo base_url(); ?>assets/images/loading11.gif" alt="" width="24" height="24"> Loading please wait...</div>
             <div id="loader_message"></div>
         	</div> 
         	</div>
         	<div class="col-md-3">
             <div class="forum-google-ad">
              <div class="google-ad" style="width: 100% !important;">
                <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'News'));
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
              $("#loader_message").html('<button class="btn btn-default" type="button">No more records.</button>').show()
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