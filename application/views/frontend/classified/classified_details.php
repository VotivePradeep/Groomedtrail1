<?php $this->load->view('include/header_css');?>
<body>
  <div id="ajax_favorite" style="display:none;">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
</div>
<header class="navigation">
  <div class="top-bar">
    <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
  </div>
  <nav class="navbar">
    <?php $this->load->view('include/nav_header'); ?>
  </nav>
</header>
<div class="wrapper">
  <section class="vac-details-sec">
    <div class="container">
      <div class="search-section">
        <div class="col-sm-12">
          <h3><?php if(isset($classified->classified_created_by)){echo $classified->classified_created_by;}?> - 
            <?php if(isset($classified->classified_ads)){
                    if($classified->classified_ads == 'for_sale'){
                      echo 'For Sale';
                    }else{
                      echo ucfirst($classified->classified_ads);
                    }
                }
              ?><?php if(isset($classified->classified_ads)){
                 if($classified->classified_ads == 'for_sale'){ ?>
              <?php if(isset($classified->classified_price) && !empty($classified->classified_price)) {echo ' - $'.$classified->classified_price; }?> <?php } } ?>
            </h3>
               <?php if(isset($classified->classified_state) && !empty($classified->classified_state)) {echo '('.$classified->classified_state.')'; }?>
             <!--<span class="classified-price">$<?php if(isset($classified->classified_price)) {echo $classified->classified_price; }?></span>,
             <span class="classified-city-state"><?php if(isset($classified->classified_state)) {echo $classified->classified_state; }?></span>-->
          </h3>
        </div>
      </div>
       
      <div class="">
        <div class="col-md-9 col-sm-12">
          <div class="image-gallery thum-gallery">
            <div class="my-slider-demo">
              <div id="demo">
                <div id="sync1" class="owl-carousel">
                  <?php 
                  $query = $this->db->query("SELECT * FROM tbl_classified_images where cls_id='".$classified->classified_id."'" );
                  $clsImage = $query->result();
                  if(isset($clsImage)) {  
                      foreach ($clsImage as $image) { ?>
                  <div class="item">
                    <div class="img-gallery-lt">
                      <img src="<?php if(isset($image->cls_imag) && !empty($image->cls_imag)) { echo base_url().$image->cls_imag; } ?>">
                    </div>
                  </div>
                <?php  } } ?>
                </div>

                <div id="sync2" class="owl-carousel">
               <?php if(isset($clsImage)) {  
                      foreach ($clsImage as $image1) { ?>
                  <div class="item">
                    <div class="slide-thumb-img">
                      <img src="<?php if(isset($image1->cls_imag) && !empty($image1->cls_imag)) { echo base_url().$image1->cls_imag; } ?>">
                    </div>
                  </div>
               <?php  } } ?>

                </div>
              </div>
            </div>
          </div>
          <div class="main-dashboard-sec">
            <div class="search-section">
               <div class="main-classified-dis">
                  <div class="desicriprion-classi">
                    <h3><?php if(isset($classified->classified_type)){echo $classified->classified_type;}?>
                      <span> 
                        <ul>
                          <li><?php if(isset($classified->classified_create_date)){$date = date_create($classified->classified_create_date);  echo date_format($date, 'd M Y');}?></li>
                          <!--<li><span><i class="fa fa-star-o"></i></span></li>-->
                        </ul>
                      </span>
                    </h3>
                    <!--<a href="#">Read More</a> -->
                  </div>
                  <div class="price-details">
                    <!--<div class="price-clas">
                      <p>$120</p>
                    </div> --> 
                     <div class="clas-rating">
                      <!--<ul>
                        <li><a href="#">4.5</a></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>                      
                      </ul>-->
                    </div>
                  </div>
                    <p><?php if(isset($classified->classified_description)){echo $classified->classified_description;}?></p>

                </div>
              
            </div>               
          </div> 
        </div>
        <div class="col-md-3 col-sm-12 cls-sec-user-info classified">
          <div class="hotel-info ">
            <div class="ppv-detl-sub">
              
              <?php if(isset($classified->user_ID)){

               $query = $this->db->query('SELECT * from tbl_user_master where user_id = '.$classified->user_ID.'');
               $result = $query->result();
              // print_r($result);
             }?>
            <?php 
            if(isset($result[0]->profile_picture) && !empty($result[0]->profile_picture)){ 
                if(strpos($result[0]->profile_picture, "http://") !== false OR strpos($result[0]->profile_picture, "https://") !== false){
                      $img = $result[0]->profile_picture;
                }else
                {
                     $img = base_url().$result[0]->profile_picture;
                }
            }
            else
            { 
                   $img =  base_url().'assets/images/default.png';
            }

            ?> 
             <img src="<?php echo $img;?>" style="width: 100px; height: 100px;border-radius: 50px;" class="classified-seller-details">

              <span class="add-vac user-na">

                <?php if(isset($result[0]->user_id)) {
                  $user_id = $result[0]->user_id;
                  if($user_id !=1){
                    if(isset($result[0]->fname) || isset($result[0]->lname)){
                        echo $result[0]->fname.' '.$result[0]->lname;
                      }
                    }else{
                        echo 'Admin';
                    }
                  

                }
                    ?></span>
            </div>
            <!--<div class="ppv-detl-sub">
              <i class="fa fa-phone"></i>
              <span class="add-vac">
                <a href="tel:<?php if(isset($result->contact_no)){echo$result->contact_no;} ?>"><?php if(isset($result[0]->contact_no)){echo $result[0]->contact_no;} ?></a>
              </span>
            </div>
            <div class="ppv-detl-sub">
              <i class="fa fa-envelope"></i>
              <span class="add-vac">
                <a href="mailto:<?php if(isset($result->email)){echo$result->email;} ?>"><?php if(isset($result[0]->email)){echo $result[0]->email;} ?></a>
              </span>
            </div> -->
            <div class="ppv-detl-sub">
              <button class="add-vac" data-toggle="modal" href="#request-sale-modal"><?php if(isset($classified->classified_ads)){
                 if($classified->classified_ads == 'for_sale'){
                  echo "Contact Seller";
                 }else{
                  echo "Contact Buyer";
                 }
                } ?></button>
            </div>
          </div>
          <!-- model Request Booking -->
        <div class="review-modal modal fade" id="request-sale-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">   
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" id="reqClose" data-dismiss="modal">&times;</button>
                  <h4><?php if(isset($classified->classified_ads)){
                 if($classified->classified_ads == 'for_sale'){
                  echo "Contact Seller";
                 }else{
                  echo "Contact Buyer";
                 }
                } ?></h4>
                </div>
                <div class="modal-body"> 
                <div id="request-booking"></div>
                  <form class="request-booking-frm" name="requestbookingfrm" id="requestbookingfrm" method="post">
                      <input type="hidden" name="user_ID" name="user_ID" value="<?php if(isset($userDetailR->user_id)){echo $userDetailR->user_id; } ?>">
                      <input type="hidden" name="bus_ID" name="bus_ID" value="<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>">
                      <div class="review-details">
                        <div class="title-box"><label>Name</label></div>
                        <div class="title-box">
                          <input type="text" name="req_user" id="req_user" placeholder="Enter Name" value="<?php if((isset($userDetailR->fname) || isset($userDetailR->lname)) && (!empty($userDetailR->fname) || !empty($userDetailR->lname))){echo $userDetailR->fname.' '.$userDetailR->lname;}else{
                            echo $userDetailR->username;
                          } ?>" readonly>
                        </div>
                        <div class="title-box"><label>Phone Number</label></div>
                        <div class="title-box">
                          <input type="text" name="req_phone" id="req_phone" placeholder="Enter Phone Number." maxlength="14" minlengt="14" value="<?php if(isset($userDetailR->contact_no)){echo $userDetailR->contact_no; } ?>">
                        </div>
                        <div class="title-box"><label>Email Address</label></div>
                        <div class="title-box">
                          <input type="text" name="req_email" id="req_email" placeholder="Enter Email Address" value="<?php if(isset($userDetailR->email)){echo $userDetailR->email; } ?>">
                        </div>
                        <div class="description-box"><label>Message</label></div>
                        <div class="description-box">
                          <textarea name="request_description" id="request_description" placeholder="Enter Message"></textarea>
                          <div id="request_booking_desc" style="display: none;color:red"></div>
                        </div>
                        <div class="s-btn">
                          <button name="reviewbtn" id="reviewbtn" type="submit">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>   
                </div>
              </div>
          </div>
        </div>
        <!-- model Request Booking -->

          <div class="right-side-map" id="map" style="height: 260px;"></div>
          <div class="right-side-text" ><a href="https://www.google.com/maps/?q=44.314844,-85.602364" target="_black">(Google Map)</a></div>
          <div class="advertise-class">
            <div class="google-ad" style="width: 100%  !important;">
              <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Classifieds Details'));
                  ?>
                  <style>
                  .example_responsive_1 { width: 100% !important; height: 250px !important; }
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
      <div class="row pad-min">
        <div class="col-md-9 col-sm-8 pad-min">  
         
          </div>
      </div>

    </div>
  </section>
</div>
<footer id="footer" class="main_footer">
  <?php $this->load->view('include/main_footer');?>
</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright');?>
</div>

<script>
    $(document).ready(function() {


/*$(".full").click(function(){
alert($(this).parent().val());
});*/

      $("#owl-demo-3").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          singleItem : true,
          pagination : false,
          autoPlay : true
      });
    });
</script>
<?php $g_key =google_mapkey(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>"></script> 
<script>
  function initMap() {
var uluru = {lat: <?php if(isset($classified->classified_lat) && !empty($classified->classified_lat)){echo $classified->classified_lat ;}else{ echo '44.314844';}?>, lng: <?php if(isset($classified->classified_lang) && !empty($classified->classified_lat)){echo $classified->classified_lang;}else{ echo '-85.602364';}?>};
var map = new google.maps.Map(document.getElementById('map'), {
zoom: 4,
center: uluru
});
var iconicon = {
    url: "<?php echo base_url().'assets/images/location1.png'; ?>", // ur
    };
var mapTitle = 'Michigan';
var marker = new google.maps.Marker({
position: uluru,
map: map,
icon: iconicon,
title: mapTitle
});
  var contentString = '<div id="content1" class="map-deta">'+'<p><?php if(isset($classified->classified_created_by)){echo $classified->classified_created_by;}?></p><p><?php if(isset($classified->classified_state)){echo $classified->classified_state;}?></p>'+'</div>';

var infowindow = new google.maps.InfoWindow({
  content: contentString
});

marker.addListener('click', function() {
  infowindow.open(map, marker);
});
}
$(document).ready(function() {
initMap();
});

  /******************* review form. *************************/


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


   function phoneFormatter() {
  $('#req_phone').on('input', function() {
    var number = $(this).val().replace(/[^\d]/g, '')
    if (number.length == 7) {
     number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
    } else if (number.length == 10) {
      number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
    }
    $(this).val(number)
  });
};

$(phoneFormatter);


$("#requestbookingfrm").submit(function(e) {
e.preventDefault();
var formData = new FormData();

var frmdata = $(requestbookingfrm).serializeArray();
$.each(frmdata, function (key, input) {
formData.append(input.name, input.value);
});
var req_user = $('#req_user').val();
var request_description = $('#request_description').val();
var req_phone = $('#req_phone').val();
var req_email = $('#req_email').val();
        
if(request_description !=""){
  $('#ajax_favorite').show();
    jQuery.ajax({
    type: "POST",
    url : "<?php echo base_url();?>ajax/contactseller",
    data: formData,
    dataType: "JSON",
    contentType: false,
    processData: false,
    success:function(data){
        if(data == 1){
            $('#request-booking').html('Information sent successfully').addClass('alert alert-success').show().fadeOut(3000);
            $('#ajax_favorite').hide();
            $('#requestbookingfrm')[0].reset();
            setTimeout(function(){ $('#reqClose').click(); }, 3000);
        }
    }

    });

}else{
   $('#request_booking_desc').html('Please enter description').show().fadeOut(3000);
}
return false;

}); 
</script>
</body>
</html>