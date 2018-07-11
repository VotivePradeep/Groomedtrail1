<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/master.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css"> <!-- Gem style -->
<style type="text/css">

 /* .error {
      background: #fff;
      max-width: 550px;
      margin: 0 auto;
      padding: 35px;
      text-align: center;
  }*/
  .error {
    background: #fff;
    max-width: 532px;
    margin: 0 auto;
    padding: 31px;
    text-align: center;
    border-radius: 5px;
  }
  .error img {
      width: 100%;
  }
  .error h3 {
    letter-spacing: 1.2px !important;
    color: red;
  }
  .cntct-header .error h3:before {
    width: 75px;
    height: 2px;
    background-color: #b1b1b1;
    position: absolute;
    bottom: 0;
    content: "";
    left: 41%;
}
  .cntct-header h3 {
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3.6px;
    padding-bottom: 15px;
    position: relative !important;
    margin: 45px 0px 15px;
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
      padding-top: 15%;
      min-height: 96vh;
      background-color: rgba(0, 0, 0, 0.33);
  }
 .error-con a{    
   background-color: #337ab7;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    padding: 10px;
  }
  .lo-logo-dv {
      padding: 10px 0 0;
  }.lo-logo-dv img {
      width: 100%;
      max-width: 160px;
  }
 
</style>
<html>
 <body>
  <div class="wrapper">
    <section class="error-page">
      <div class="overcan">     
        <div class="container">
          <div class="cntct-header">
          <div class="row">
            <div class="col-md-12">
              <div class="error">
        <div class="lo-logo-dv">
            <img src="<?php echo base_url(); ?>assets/images/logo_new.png" class="logo-cls">
          </div>
                <p>Thanks! Your account has been successfully activated. You will now be re-directed to the GroomedTrail.com main login page.</p>
               <div class="error-con">
                  <a href="javascript:void(0);" onclick='window.location.href = "<?php echo base_url(); ?>";'>OK</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="copy-right">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="c-right">© 2017 GroomedTrail All Rights reserved.</div>
      </div>
      <div class="col-sm-6">
        <div class="social-nav">
          <ul>

            <?php $this->load->helper('custom_helper'); $social_setting = my_social_footer(); ?>
          <li><a href="<?php if(isset($social_setting[0]['facebook'])){ echo $social_setting[0]['facebook'];}?>"><i class="fa fa-facebook"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['linkedin'])){ echo $social_setting[0]['linkedin'];}?>"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['twitter'])){ echo $social_setting[0]['twitter'];}?>"><i class="fa fa-twitter"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['google'])){ echo $social_setting[0]['google'];}?>"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
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

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script>
  setTimeout(function() {
    window.location.href = "<?php echo base_url(); ?>";
}, 7000);
</script>