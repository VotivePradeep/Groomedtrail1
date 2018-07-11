<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">

</style>
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
          <div class="col-md-9 col-sm-8 no-paddng">
            <div class="business-detail-sec">
              <div class="business-frm">
                <div id="responseMsg"></div>
                <h3>Packages</h3>
                <div class="pricing-plans">
                  <div class="wrap">
                    <div class="pricing-grids">
                      <?php
                      $i= 1;
                      if(isset($packagesPlan)){
                        foreach ($packagesPlan as $plan) { ?>
                      <div class="pricing-grid<?php echo $i; ?>">
                        <div class="price-value <?php if(isset($plan->number)){echo $plan->number;}?>">
                          <h2><a href="#">
                            <?php if(isset($plan->pl_name)){echo $plan->pl_name;}?>
                            </a></h2>
                          <h5><span>$
                            <?php if(isset($plan->pl_price)){echo $plan->pl_price;}?>
                            </span>
                            <lable> / year</lable>
                          </h5>
                          <div class="sale-box <?php if(isset($plan->number)){echo $plan->number;}?>"> <span class="on_sale title_shop">NEW</span> </div>
                        </div>
                        <div class="price-bg">
                          <ul>
                            <li class="whyt"><a href="#">
                              <?php if(isset($plan->pl_description)){echo $plan->pl_description;}?>
                              </a></li>
                            <li><a href="#">Show on google map</a></li>
                          </ul>
                          <div class="cart1"> <a  class="popup-with-zoom-anim" id="purchaseBtn" onclick="purchaseSelect(<?php echo $segment; ?>,<?php if(isset($plan->pl_id)){echo $plan->pl_id;}?>)">Purchase</a> </div>
                          
                        </div>
                      </div>
                      <?php $i++; } } ?>
                    </div>
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
<script type="text/javascript">
function purchaseSelect(bus_id, pl_id){
 // alert(1);
  $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/purchaseSelect",
        data:{bus_id: bus_id,pl_id:pl_id },
        success: function(data){
         // alert(1);
         setTimeout(function(){ window.location = "<?php echo base_url() ?>"+'paypal/advert_buy/'+bus_id; }, 500);
        }
    });
}
</script>