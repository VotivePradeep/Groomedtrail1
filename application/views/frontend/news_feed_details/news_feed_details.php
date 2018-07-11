<?php $this->load->view('include/header_css');?>
<style type="text/css" media="screen">
  .pms-bg {
  background: #ecf0f1;
  margin-top: 25px;
  box-shadow: none;
  }
</style>
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
            <div class="col-md-9 col-sm-8 no-paddng">
              <div class="pro-pic-detail-sec">
                <h6 class="go-dash"><a href="<?php echo base_url().'home'; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>go to home</a></h6>
                
                <div class="row">
                  <div class="col-sm-12">
                    <div class="panel with-nav-tabs panel-default">
                    <!-- <div class="panel-heading"> -->
                      <div class="trail-deta-head">
                      
                        <?php if(isset($trailDetail[0]['trail_type']) && $trailDetail[0]['trail_type'] == 'trail'){ ?>
                        <h4 ><b>Trail Updates</b></h4>
                        <?php } ?>
                        <?php if(isset($trailDetail[0]['trail_type']) && $trailDetail[0]['trail_type'] == 'trail_report'){ ?>
                        <h4><b>Trail Report Updates</b></h4>
                        <?php } ?>
                          
                      
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab1primary">
                              <?php if(isset($trailDetail)){
                                
                                  $i=1;
                                     foreach ($trailDetail as $trailD) { 

                                    if($trailD['trail_type'] =='trail'){ ?>
                                     
                              <div class="row profile-traildetail">
                                <div class="col-md-2 trail-user-photo">
                                  <div class="pro-image" style="width: 73px !important;height: 73px !important;">
                                    <?php
                                if(isset($trailD['profile_picture']) && !empty($trailD['profile_picture'])){
                                if(strpos($trailD['profile_picture'], "http://") !== false OR strpos($trailD['profile_picture'], "https://") !== false){
                                  $img = $trailD['profile_picture'];
                                }else
                                {
                                  $img = base_url().$trailD['profile_picture'];
                                }
                                }
                                else
                                {
                                  $img =  base_url().'assets/images/default.png';
                                }
                                ?>
                                <img src="<?php echo $img; ?>" id="pro-image-up" style="width: 65px !important;height: 65px !important;min-height: 65px !important;">
                                </div>
                                <div class="pro-name" style="padding: 0px 0 !important;">
                                <h5 id="name-head"><?php if(isset($trailD['fname'])){echo $trailD['fname']; } ?> <?php if(isset($trailD['lname'])){echo $trailD['lname']; } ?> </h5>
                                <!-- <h4 id="name-head"><?php //if(!empty($trailDetail['address'])){echo '<i class="fa fa-map-marker" aria-hidden="true"></i> '.$trailDetail['address']; } ?></h4> -->
                                </div>
                                </div>
                                <div class="col-md-10">
                               
                                <h3><?php if(isset($trailD['trail_name'])){echo $trailD['trail_name']; } ?></h3>
                                <p class="profiletrailDesi"><?php if(isset($trailD['trail_description'])){echo $trailD['trail_description']; } ?>
                                </p>
                                <span><i class="fa fa-calendar"></i> <span><?php if(isset($trailD['subc_date'])){ $date = date_create($trailD['subc_date']);
                                echo date_format($date, 'd M Y h:i A'); } ?></span></span>
                              
                              </div>
                            </div>
                      
                                      
                                     <?php }
                                     if($trailD['trail_type'] =='trail_report'){ 
                                     //$trailReportD = $trailD;
                                      ?>
                                     <div class="profile-traildetail">
                                       <h3><?php if(isset($trailD['CountyID'])){echo $trailD['CountyID']; } ?></h3>
                                       <p class="profiletrailDesi"><?php if(isset($trailD['trail_report_conditions'])){echo $trailD['trail_report_conditions']; } ?>
                                       </p>
                                       <span><i class="fa fa-calendar"></i> <span><?php if(isset($trailD['subc_date'])){
                                        $date = date_create($trailD['subc_date']); 
                                        echo date_format($date, 'd M Y h:i A');
                                        } ?></span></span>
                                     </div>
                                     <?php } ?>

                              <?php $i++; } } ?>
                             </div>
                            <!-- <div class="tab-pane fade" id="tab2primary">
                              <?php if(isset($trailDetail)){
                                $j=4;
                                     foreach ($trailDetail as $trailReportD) {
                                      print_r($trailReportD);
                                      ?>
                                     <div class="profile-traildetail">
                                       <h3><?php if(isset($trailReportD['CountyID'])){echo $trailReportD['CountyID']; } ?></h3>
                                       <p class="profiletrailDesi"><?php if(isset($trailReportD['trail_report_conditions'])){echo $trailReportD['trail_report_conditions']; } ?>
                                       </p>
                                       <span><i class="fa fa-calendar"></i> <span><?php if(isset($trailReportD['trail_report_created_date'])){
                                        $date = date_create($trailReportD['trail_report_created_date']); 
                                        echo date_format($date, 'd M Y h:i A');
                                        } ?></span></span>
                                     </div>
                              <?php $j++; } } ?>
                            </div> -->
                        </div>
                    </div>
                   </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 col-sm-4 fron_profile">
              
               <div class="advertise-class">
            <div class="google-ad" style="width: 100%  !important;">
             <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Profile'));
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
