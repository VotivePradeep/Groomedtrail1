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
  <div class="custom-cutainer">
    <section id="mainContent">      
      <div class="content_bottom">
        <div class="row">
          <div class="col-lg-9 col-md-9 col-sm-9">            
            <div class="main-dashboard-sec">
              <div class="search-section">
                <h3>Classified Search</h3>
                <div class="search-box-1">
                  <input type="text" name="searchclassified" id="searchclassified" placeholder="Search Classified">
                  <button class="search-clas-btn" id="searchclassifiedbtn"><i class="fa fa-search"></i></button>
                </div>
              </div>
              <section class="main-prof-sec">
                <div class="other-main-details">
                <div class="main-tabs-dash">
                  <div class="panel with-nav-tabs panel-default">
                    <div class="row">
                      <div class="s-panel-body">
                        <div class="main-list">
                          <div class="result-m">
                            <div class="row">
                          <?php 
                          //print_r($classifiedList);
                          // print_r($classifiedList);
                           foreach ($classifiedList as $classified){  
                            ?>
                           <div class="col-sm-12 main-li-detail">
                             <p>
                               <a href="<?php echo base_url().'classified/'.str_replace(" ","-",$classified->classified_cat_name); ?>">
                                <?php if(isset($classified->classified_cat_name)) {echo $classified->classified_cat_name;}?></a>
                             </p>
                                <ul>
                                    <?php
                                     if(!empty($classified->subs)) { 
                                     foreach ($classified->subs as $sub)  { 
                                     if($sub->classified_status == 1){
                                     if($sub->classified_expired >= date("Y-m-d")){
                                    ?>
                                     <li>
                                      <a href="<?php echo base_url().'classified/details/'.$sub->url_slag; ?>" class="media-left">
                                      <?php 
                                         $query = $this->db->query("SELECT * FROM tbl_classified_images where cls_id='".$sub->classified_id."'" );
                                          $clsImage = $query->result();
                                         
                                         ?>
                                         <img alt="img" src="<?php if(isset($clsImage[0]->cls_imag) && !empty($clsImage[0]->cls_imag)){echo base_url().$clsImage[0]->cls_imag;}else{echo base_url().'assets/images/no-image.jpg'; }?>"> 
                                      </a>
                                      <a href="<?php echo base_url().'classified/details/'.$sub->url_slag; ?>" class="text-containt"><span class="classified_created_by"> <?php if(isset($sub->classified_created_by)){echo $sub->classified_created_by; } ?></span>
                                      <span class="cls_date"><b>Posted</b> <?php if(isset($sub->classified_create_date)){$date = date_create($sub->classified_create_date);  
                                        echo date_format($date, 'd M Y');
                                        }?></a>
                                     </li>
                                    <?php } } } } ?>
                               
                                </ul>
                                <div class="more-classified text-right">
                                  <a href="<?php echo base_url().'classifiedcategory/'.str_replace(" ","-",$classified->classified_cat_name); ?>" class="more-link">View All</a>
                                </div>
                           </div>
                           <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="classify-buttons">
              <ul>
                <li><a href="<?php echo base_url(); ?>user/classifiedslist">My Listings</a></li>
                <li><a href="<?php echo base_url(); ?>user/addclassified">Create Listing</a></li>
              </ul>
            </div>
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
  $('#searchclassifiedbtn').click(function(){
    var searchkey = $('#searchclassified').val().replace(/ /g,'-');
    window.location.href = "<?php echo base_url(); ?>classified/"+searchkey; 

  })
</script>