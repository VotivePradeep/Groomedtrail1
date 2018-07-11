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
<section class="profile-main-sec">
    <div class="container">
      <div class="pms-bg">
        <div class="row">
         <?php $this->load->view('user/leftsidebar') ?>
          <div class="col-md-9 col-sm-8">
            <div class="pro-pic-detail-sec summary-count">
              <div class="row">
                <div class="col-md-3">
                  <div class="user-dash">
                    <div class="main-heading"><h3>Rentals</h3></div>
                    <p><?php if(isset($businessList)){ echo count($businessList); }?></p>
                    <a href="<?php echo base_url(); ?>user/rentals">View Details <i class="fa fa-arrow-right pull-right"></i></a>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="user-dash">
                    <div class="main-heading"><h3>Classifieds Listing</h3></div>
                    <p><?php if(isset($classifiedCount)){ echo count($classifiedCount); }?></p>
                    <a href="<?php echo base_url(); ?>user/classifiedslist">View Details <i class="fa fa-arrow-right pull-right"></i></a>
                  </div>
                </div>
                <div class="col-md-3">
                   <div class="user-dash">
                      <div class="main-heading"><h3>Saved Routes</h3></div>
                      <p><?php if(isset($routeList)){ echo count($routeList); }?></p>
                      <a href="<?php echo base_url(); ?>user/savedroutes">View Details <i class="fa fa-arrow-right pull-right"></i></a>
                   </div>
                </div>
                <div class="col-md-3">
                   <div class="user-dash">
                      <div class="main-heading"><h3>Updated Trail Status/Trail Report </h3></div>
                      <p><?php if(isset($trailList)){ echo count($trailList); }?>/<?php if(isset($trailReportList)){ echo count($trailReportList); }?></p>
                      <a href="<?php echo base_url(); ?>user/updatetrail">View Details <i class="fa fa-arrow-right pull-right"></i></a>
                   </div>
                </div>
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
 