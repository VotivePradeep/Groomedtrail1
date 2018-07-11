<?php $this->load->view('include/header_css');?>

<body>
<style type="text/css">
  .business-frm h3 span.alert.paymentsts {
      float: none;
  }
  .business-frm h3 span.alert.paymentsts {
    padding: 0;
    color: #387fcc;
    font-weight: 500;
    font-size: 16px;
    float: left;
    width: 100%;
    margin: 0;
}
 .vac_city {
    width: 50%;
    float: left;
    padding: 6px;
  }
  .vac_city label {
    margin-top: 10px;
  }
  .gm-style .gm-style-iw {
    width: 300px !important;
  }
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
                <h3>New Rental Details
                   <button onClick="window.location.href='<?php echo base_url(); ?>user/rentals'" style="margin-left: 10px;">My Rentals </button>
                   

                    <?php if(isset($businessDetail->pl_id)) {
                    $sql= $this->db->query("SELECT * FROM plan_master WHERE pl_id=".$businessDetail->pl_id."");
                    $planResult = $sql->result(); ?>
                    <?php if($businessDetail->vac_expiry_date <= date('Y-m-d') && $businessDetail->vac_expiry_date != '0000-00-00'){ 
                      if($planResult[0]->pl_price!=0){

                        if($businessDetail->renew_status !=1){ ?>
                        <button onClick="window.location.href='<?php echo base_url(); ?>paypal/advert_buy/<?php if(isset($businessDetail->vac_id)) {echo $businessDetail->vac_id; }?>'">Make Payment</button>

                      <?php   }else{ ?>
                      
                      <span class="alert paymentsts">Thank you for your listing! We will review it shortly for approval</span>

                     <?php }
                    
                    } }else{ ?>
                    <?php if($planResult[0]->pl_price!=0){
                     if($businessDetail->vac_payment_status == 0){ ?>
                     <button onClick="window.location.href='<?php echo base_url(); ?>paypal/advert_buy/<?php if(isset($businessDetail->vac_id)) {echo $businessDetail->vac_id; }?>'">Payment Pending</button>

                    <?php }else if($businessDetail->vac_payment_status == 1 && $businessDetail->vac_status == 0){
                            echo  '<span class="alert paymentsts">Thank you for your listing! We will review it shortly for approval</span>';
                          }else if($businessDetail->vac_payment_status == 1 && $businessDetail->vac_status == 1){
                            echo '<button>Published</button>';
                          } 
                    }else{ if($businessDetail->vac_status == 0){ ?>
                      <span class="alert paymentsts">Thank you for your listing! We will review it shortly for approval</span>
                    <?php }else if($businessDetail->vac_status == 1){
                            echo '<button>Published</button>';
                          } 
                  } ?>
                     <?php  }    } ?>
                </h3>
              <?php if(isset($updateList->update_status)){ if($updateList->update_status == 1){ ?><br/>
                <div class="alert alert-info">
                  after admin approval rental update information will show on the front-end.
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                </div>
              <?php } } ?>
                <div class="row">
                  <div class="form-group col-sm-12 ">
                    <div class=" busns-dscrpsn">
                      <label for="business_description">Rentals Image</label>
                    <div class="image-gallery thum-gallery">
                        <div class="my-slider-demo">
                          <div id="demo">
                            <div id="sync1" class="owl-carousel">
                              <?php if(isset($businessImage)) {  
                                  foreach ($businessImage as $image) { ?>
                              <div class="item">
                                <div class="img-gallery-lt">
                                  <img src="<?php if(isset($image->vac_imag) && !empty($image->vac_imag)) { echo base_url().$image->vac_imag; } ?>">
                                </div>
                              </div>
                            <?php  } } ?>
                            </div>

                            <div id="sync2" class="owl-carousel">
                           <?php if(isset($businessImage)) {  
                                  foreach ($businessImage as $image1) { ?>
                              <div class="item">
                                <div class="slide-thumb-img">
                                  <img src="<?php if(isset($image1->vac_imag) && !empty($image1->vac_imag)) { echo base_url().$image1->vac_imag; } ?>">
                                </div>
                              </div>
                           <?php  } } ?>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" mang-viw-dtl-pg">
                  <div class="row data-pro-table">
                    <table>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Property Name</label>
                          <p>
                            <?php if(isset($businessDetail->vac_name)) {echo $businessDetail->vac_name; }?>
                              </p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Property Type</label>
                              <p>
                                <?php if(isset($businessDetail->vac_type)) {echo $businessDetail->vac_type; }?>
                              </p>
                          </div>
                        </td>
                    </tr>

                    <tr>
                      <td>
                            <div class="form-group ">
                              <label for="business_contant_no">Property Phone Number</label>
                              <p>
                                <?php if(isset($businessDetail->vac_contact)) {echo $businessDetail->vac_contact; }?>
                              </p>
                            </div>
                    
                      </td>
                      <td>
                        <div class="form-group ">
                              <label for="business_address">Email Address</label>
                              <p>
                                <?php if(isset($businessDetail->vac_email)) {echo $businessDetail->vac_email; }?>
                              </p>
                            </div>
                      </td>
                    </tr>

                     <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Property Address</label>
                      <p>
                        <?php if(isset($businessDetail->vac_address)) {echo $businessDetail->vac_address; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">City</label>
                      <p>
                        <?php if(isset($businessDetail->vac_city)) {echo $businessDetail->vac_city; }?>
                      </p>
                    </div>
                   <!-- <div class="vac_city">
                      <label for="business_address">City</label>
                      <p>
                        <?php if(isset($businessDetail->vac_city)) {echo $businessDetail->vac_city; }?>
                      </p>
                    </div>
                    <div class="vac_city zip-code">
                      <label for="business_address">Zip Code</label>
                      <p>
                        <?php if(isset($businessDetail->vac_zip_code)) {echo $businessDetail->vac_zip_code; }?>
                      </p>
                    </div> -->
                  </td>
                </tr>
                 <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">State</label>
                      <p>
                        <?php if(isset($businessDetail->state_name)) {echo $businessDetail->state_name; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Zip Code</label>
                      <p>
                        <?php if(isset($businessDetail->vac_zip_code)) {echo $businessDetail->vac_zip_code; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                    <tr>
                      <td>
                        <div class="form-group ">
                              <label for="vac_no_of_bedroom">Website Address</label>
                              <p>
                               <a href="<?php if(isset($businessDetail->vac_wedsite_url)) {echo $businessDetail->vac_wedsite_url; }?>" target="_blanck"><?php if(isset($businessDetail->vac_wedsite_url)) {echo $businessDetail->vac_wedsite_url; }?></a> 
                              </p>
                          </div>
                      </td>
                      <td>
                        <div class="form-group ">
                              <label for="vac_bathroom">Number of Bedrooms</label>
                              <p>
                                <?php if(isset($businessDetail->vac_no_of_bedroom)) {echo $businessDetail->vac_no_of_bedroom; }?>
                              </p>
                          </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="form-group ">
                              <label for="vac_sleep">Number of Bathrooms</label>
                              <p>
                                <?php if(isset($businessDetail->vac_bathroom)) {echo $businessDetail->vac_bathroom; }?>
                              </p>
                          </div>
                      </td>
                      <td>
                        <div class="form-group ">
                              <label for="vac_sleep">Number of sleeping person</label>
                              <p>
                                <?php if(isset($businessDetail->vac_sleep)) {echo $businessDetail->vac_sleep; }?>
                              </p>
                          </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div class="form-group ">
                              <label for="business_address">Rental Daily Rate</label>
                              <p>
                                $<?php if(isset($businessDetail->vac_price)) {echo $businessDetail->vac_price; }?>
                              </p>
                          </div>
                        </td>
                         <td>
                        <div class="form-group ">
                              <label for="business_address">Rental Weekly Rate</label>
                              <p>
                                $<?php if(isset($businessDetail->vac_weekly_rate)) {echo $businessDetail->vac_weekly_rate; }?>
                              </p>
                          </div>
                      </td>
                    
                    </tr>

                    <tr>
                      <td>
                        <div class="form-group ">
                              <label for="business_address">floor area</label>
                              <p>
                                <?php if(isset($businessDetail->vac_floor_area)) {echo $businessDetail->vac_floor_area; }?>
                                sq.ft.</p>
                          </div>
                      </td>
                      <td>
                        <div class="form-group ">
                              <label for="business_address">Amenities</label>
                              <p><ul class="bus-ameniti">
                                <?php if(isset($businessDetail->adv_filter_fields)) {
                                $valueA = explode(",", $businessDetail->adv_filter_fields);
                                    foreach ($valueA as $valueA) {
                                    $query=$this->db->query("select * from advance_filter_fields where f_id=". $valueA."");
                                    $result = $query->result();
                                    foreach ($result as $value) {
                                     echo '<li>'.$value->f_subcat_name.'</li>';
                                    }
                                    }
                                 }?></ul>
                              </p>
                          </div>
                      </td>
                       
                    </tr>
                   
                    </table>
                  </div>
                </div>
                
                <!--<div class="col-sm-6">

                  <div class="form-group ">

                      <label for="bus_image">Business logo</label>

                      <img src="<?php if((isset($businessDetail->vac_bus_logo)) && (!empty($businessDetail->vac_bus_logo))){echo base_url().$businessDetail->vac_bus_logo;}else{ echo base_url().'assets/images/NoImg.jpg'; } ?>">

                  </div>

                </div>-->
                
                <div class="row">
                  <div class="form-group col-sm-12 ">
                    <div class=" busns-dscrpsn">
                      <label for="business_description">Description</label>
                      <p>
                        <?php if(isset($businessDetail->vac_description)) {echo $businessDetail->vac_description; }?>
                      </p>
                    </div>
                  </div>
                  <div class="form-group col-sm-12"> 
                    
                    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d90807.93852472464!2d-84.71074523349883!3d44.6634984256526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1494568416819" frameborder="0" style="border:0;height: 286px; width: 820px;" allowfullscreen></iframe> -->
                    <div id="busMap" style="border:0;height: 286px; width: 100%;"></div>
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
</html><script type="text/javascript">

  

 function businessMap() {



  var latitude = <?php if(isset($businessDetail->vac_lat)) {echo $businessDetail->vac_lat; }?>;

  var longitude = <?php if(isset($businessDetail->vac_lang)) {echo $businessDetail->vac_lang; }?>;

        var myLatLng = {lat: latitude, lng: longitude};

        var map = new google.maps.Map(document.getElementById('busMap'), {

          zoom: 8,

          center: myLatLng,

          fullscreenControl: true,

          fullscreenControlOptions: {

                    position: google.maps.ControlPosition.LEFT_TOP

          }

        });

     var icon = {

      url: "<?php echo base_url().'assets/images/location.png'; ?>", // url

      scaledSize: new google.maps.Size(25, 30), // scaled size
      
      };

      var marker = new google.maps.Marker({

        position: new google.maps.LatLng(latitude, longitude),

        map: map,

        icon: icon

      });


      var contentString = '<div id="content1" class="map-deta" style="width: 100%;">'+
        '<div class="row">'+
        '<div id="siteNotice" class="col-sm-12">'+
        '</div>'+
        '<div id="bodyContent" class="col-sm-6">'+
        '<p class="imag-loc"><img src="<?php if(isset($businessImage[0]->vac_imag) && !empty($businessImage[0]->vac_imag)) { echo base_url().$businessImage[0]->vac_imag; } ?>" style="width:100%;" ></p>'+   
        '</div>'+
        '<div class="col-sm-6 text-left"><h2 id="firstHeading" class="firstHeading" style="font-size: 16px;margin: 0;"><?php if(isset($businessDetail->vac_name)){ echo $businessDetail->vac_name; }?></h2>'+
        '<div class="review-details"><ul class="review-map"> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li><li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li>(0)</li></ul></div>'+
        '<p><?php if(isset($businessDetail->vac_address)){ echo $businessDetail->vac_address; }?></p><p><a href=""><?php if(isset($businessDetail->vac_wedsite_url)){ echo $businessDetail->vac_wedsite_url; }?></a></p></div>'+        
        '</div>'+
        '</div>';

      var infowindow = new google.maps.InfoWindow({

      content: contentString

      });
      infowindow.open(map, marker); 

     marker.addListener('click', function() { 
              infowindow.open(map, marker); 
  });



}

 </script>
  <script>
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
<?php $g_key =google_mapkey(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&callback=businessMap"></script>