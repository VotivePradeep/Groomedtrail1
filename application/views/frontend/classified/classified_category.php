  <?php $this->load->view('include/header_css');?>
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
      <div class="custom-cutainer classified-searc">

        <section class="classified-searc-sec">
          <div class="container">
            <div class="row">
              <div class="col-sm-8">
                <div class="main-dashboard-sec">
                  <div class="search-section">
                    <h3>Classified Search</h3>
                    <div class="search-box-1">
                      <form method="get" id="SerchFrm" name="SerchFrm">
	                     <input type="text" name="searchclassified" id="searchclassified" value="<?php echo $basesegment;  ?>" placeholder="Search <?php echo $basesegment;  ?>">
	                     <button class="search-clas-btn" id="searchclassifiedbtn"><i class="fa fa-search"></i></button>
                     </form>
                    </div>
                  </div>               
                </div>              
              </div>
              <div class="col-sm-4">
              	<div class="grid-list">
				    <ul>
				      <li>
				        <a href="#" id="my-grid">Grid</a>
				      </li>
				      <li>
				        <a href="#" id="my-list">List</a>
				      </li>
				    </ul>
				</div> 
              </div>
            </div>
          </div>
        </section>

         <section class="my-classified">
          <div class="container">
            <div class="row">
               <div class="col-sm-9">
                  <div class="row">
                    <div id="classified_main_section"> 
                    <!-- <?php //$this->load->view('frontend/classified/classified_category_main'); ?>--> 
                     </div>
                   </div>
                   <div id="loader_image"><img src="<?php echo base_url(); ?>assets/images/loading11.gif" alt="" width="24" height="24"> Loading please wait...</div>
                   <div id="loader_message"></div>
               </div>
               <div class="col-sm-3">
                  <div class="advertise-class">
                  <div class="google-ad" style="width: 100% !important;">
                   <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Classifieds'));
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

      </div>
    </div>
    <footer class="main_footer">
      <?php $this->load->view('include/main_footer'); ?>
    </footer>
    <div class="copy-right">
      <?php $this->load->view('include/copyright'); ?>
    </div>
  </body>
</html>
<script>
$('#searchclassifiedbtn').click(function(evt) {
     evt.preventDefault();
       $.ajax({
         type: 'POST',
         url: "<?php echo base_url(); ?>ajax/classifiedsearch",
         data: $('#SerchFrm').serialize(),
         success: function(data){
           $('#classified_main_section').html(data);
         }
      });    
   });
</script>
<script type="text/javascript">
 $(document).ready(function(){
   	$("#my-list").click(function(){
      	$(".mobile-classified").addClass('col-sm-12 listing');
      	$(".mobile-classified").removeClass('col-sm-4 col-md-3');
   	});
    $("#my-grid").click(function(){
      	$(".mobile-classified").addClass('col-sm-4 col-md-3');
      	$(".mobile-classified").removeClass('col-sm-12 listing');
   	});
 });
</script>
<script type="text/javascript">
      var busy = false;
      var limit = 4;
      var offset = 0;

      function displayRecords(lim, off) {
        var classified_type = '<?php echo $basesegment; ?>';
        var pageName = '<?php echo $segment2; ?>';
        $.ajax({
          type: "GET",
          async: false,
          url: "<?php echo base_url().'ajax/classified_pagination'; ?>",
          data: "limit=" + lim + "&offset=" + off+ "&classified_type=" + classified_type+ "&pageName=" + pageName,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html) {
            $("#classified_main_section").append(html);
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
          if ($(window).scrollTop() + $(window).height() > $("#classified_main_section").height() && !busy) {
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