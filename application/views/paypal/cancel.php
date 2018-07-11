<?php $this->load->view('include/header_css');?>
<style type="text/css">
  .error {
      background: #fff;
      max-width: 550px;
      margin: 0 auto;
      padding: 35px;
      text-align: center;
  }
  .error img {
      width: 100%;
  }
  .error h3 {
    letter-spacing: 1.2px;
  }
  section.error-page {
      background: url(<?php echo base_url(); ?>assets/images/map-bg.jpg);
      padding: 0  0 ;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      position: relative;
      background-repeat: no-repeat;
  }
  .error-con {
      margin: 30px 0 0 0;
      padding: 5px 0 0;
  }
  .overcan {
      padding: 95px 0;
      background-color: rgba(0, 0, 0, 0.33);
  }
 .error-con a{    
   background-color: #337ab7;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    padding: 10px;
  }
</style>
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
    <section class="error-page">
      <div class="overcan">     
    		<div class="container">
          <div class="cntct-header">
    			<div class="row">
    				<div class="col-md-12">
    					<div class="error">
    						<h3>PAYMENT CANCELLATION</h3>
    						<p>You canceled your payment processing. Please try again later.</p>
    						<div class="error-con">
    							<a href="<?php echo base_url(); ?>paypal/advert_buy/<?php echo $this->uri->segment(3); ?>">Make Payment</a>
    						</div>
    					</div>
    				</div>
    			</div>
        </div>
  		</div>
    </div>
  </section>
</div>
<!--<div class="wrapper" style="min-height: 51.7vh;">
  <section class="contact-us-main">
    <div class="container">
      <div class="cntct-header">
        <div class="row">
          <div class="col-lg-offset-2 col-lg-8 col-md-12">
            <h3>PAYMENT CANCELLATION</h3>
            <h5>You cancelled your payment processing. Please try again later.</h5>
            <a href="<?php echo base_url();?>user/rentals">Go Back</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>-->
<footer class="main_footer">
  <?php $this->load->view('include/main_footer.php');?>
</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright.php');?>
</div>
</body>
</html>