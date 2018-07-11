<?php $this->load->view('include/header_css');?>

<body>
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
      <div class="row pad-min">
        <div class="col-md-3 col-sm-4 pad-min">
          <div class="hotel-info">
            <div class="dmv-heading">
              <h3 title="<?php if(isset($businessDetail[0]->vac_name)){ echo $businessDetail[0]->vac_name; }?>"><?php if(isset($businessDetail[0]->vac_name)){ echo $businessDetail[0]->vac_name; }?></h3>
            </div>
           
            <div class="hotel-name">
              <p>$<?php if(isset($businessDetail[0]->vac_price)){ echo $businessDetail[0]->vac_price; }?>/night   
               <span class="avgreview"><?php 
                  $starNumber = $avgReview[0]->total;
                  for($x=1;$x<=$starNumber;$x++) { ?>
                     <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
                  <?php  }
                  if (strpos($starNumber,'.')) { ?>
                     <a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a>
                  <?php $x++;
                  } 
                  while ($x<=5) { ?>
                     <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                  <?php $x++;
                  }

                  ?>
                </span></p>
            </div>
           
            <div class="ppv-detl-sub">
              <i class="fa fa-map-marker"></i>
              <span class="add-vac"><?php if(isset($businessDetail[0]->vac_address)){ echo $businessDetail[0]->vac_address; }?></span>
            </div>
            <div class="ppv-detl-sub">
              <i class="fa fa-phone"></i>
              <span class="add-vac">
                <a href="tel:<?php if(isset($businessDetail[0]->vac_contact)){ echo $businessDetail[0]->vac_contact; }?>"><?php if(isset($businessDetail[0]->vac_contact)){ echo $businessDetail[0]->vac_contact; }?></a>
                </span>
            </div>
            <div class="ppv-detl-sub">
              <i class="fa fa-globe"></i>
              <span class="add-vac"><a href="<?php if(isset($businessDetail[0]->vac_wedsite_url)){ echo $businessDetail[0]->vac_wedsite_url; }?>"><?php if(isset($businessDetail[0]->vac_wedsite_url)){ echo $businessDetail[0]->vac_wedsite_url; }?></a></span>
            </div>
            <div class="ppv-detl-sub">
              <i class="fa fa-envelope"></i>
              <span class="add-vac">
                <a href="mailto:<?php if(isset($businessDetail[0]->vac_email)){ echo $businessDetail[0]->vac_email; }?>"><?php if(isset($businessDetail[0]->vac_email)){ echo $businessDetail[0]->vac_email; }?></a>

                </span>
            </div>
            <div class="ppv-detl-sub">
              <button class="add-vac" data-toggle="modal" href="#request-booking-modal">Request Booking</button>
            </div>
          </div>
        </div>
        <!-- model Request Booking -->
        <div class="review-modal modal fade" id="request-booking-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">   
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4>Request Booking</h4>
                </div>
                <div class="modal-body"> 
                <div id="request-booking"></div>
                  <form class="request-booking-frm" name="requestbookingfrm" id="requestbookingfrm" method="post">
                      <input type="hidden" name="user_ID" name="user_ID" value="<?php echo $user_id; ?>">
                      <input type="hidden" name="bus_ID" name="bus_ID" value="<?php if(isset($businessDetail[0]->vac_id)){ echo $businessDetail[0]->vac_id; }?>">
                      <div class="review-details">
                        <div class="title-box">
                          <label>Name</label>
                          <input type="text" name="req_user" id="req_user" placeholder="Enter Name" value="<?php if(isset($userDetailR->fname) || isset($userDetailR->lname) ){echo $userDetailR->fname.' '.$userDetailR->lname;} ?>" readonly>
                        </div>
                        <div class="title-box">
                          <label>Phone Number</label>
                          <input type="text" name="req_phone" id="req_phone" placeholder="Enter Phone Number." maxlength="14" minlengt="14" value="<?php if(isset($userDetailR->contact_no)){echo $userDetailR->contact_no;} ?>" >
                        </div>
                        <div class="title-box">
                          <label>Email Address</label>
                          <input type="text" name="req_email" id="req_email" placeholder="Enter Email Address" value="<?php if(isset($userDetailR->email)){echo $userDetailR->email;} ?>">
                        </div>
                        <div class="description-box">
                          <label>Message</label>
                          <textarea name="request_description" id="request_description" placeholder="Enter Message"></textarea>
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

        <div class="col-md-9 col-sm-8 pad-min">
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
      <div class="row pad-min">
        <div class="col-md-9 col-sm-8 pad-min">            
          <div class="deatils-main-vac">
            <div class="dmv-heading">
              <h3>Rental Details and Features</h3>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Sleeps</p>
                        <h4><?php if(isset($businessDetail[0]->vac_sleep)){ echo $businessDetail[0]->vac_sleep; }?></h4>
                    </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico busi-ico">
                        <i class="fa fa-bed" aria-hidden="true"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Bedrooms</p>
                        <h4><?php if(isset($businessDetail[0]->vac_no_of_bedroom)){ echo $businessDetail[0]->vac_no_of_bedroom; }?></h4>
                    </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico new-let-ico">
                        <i class="fa fa-bath" aria-hidden="true"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Bathrooms</p>
                        <h4><?php if(isset($businessDetail[0]->vac_bathroom)){ echo $businessDetail[0]->vac_bathroom; }?></h4>
                    </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico busi-ico">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Floor Area</p>
                        <h4><?php if(isset($businessDetail[0]->vac_floor_area)){ echo $businessDetail[0]->vac_floor_area; }?> <span>sq. ft.</span></h4>
                    </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico new-let-ico">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Location</p>
                        <h4><?php if(isset($businessDetail[0]->vac_location_type)){ echo $businessDetail[0]->vac_location_type; }?></h4>
                    </div>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="dc-sub">
                    <div class="dc-sub-ico">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    <div class="dc-sub-txt">
                        <p>Property Type</p>
                        <h4><?php if(isset($businessDetail[0]->vac_type)){ echo $businessDetail[0]->vac_type; }?> </h4>
                    </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="lock-boxs">
                  <div class="mai-lock_box">
                    <div class="location">
                      <h3>
                        <span><i class="fa fa-ravelry" aria-hidden="true"></i> Amenities
                      </h3>
                      <div class="location-list">
                        <?php if(isset($businessDetail[0]->adv_filter_fields)) {
                        $valueA = explode(",", $businessDetail[0]->adv_filter_fields);
                        $i =1;
                         echo '<ul>';
                          foreach ($valueA as $valueA) {
                          $query=$this->db->query("select * from advance_filter_fields where f_id=". $valueA."");
                          $result = $query->result();
                         
                          foreach ($result as $value) {
                           echo '<li><i class="fa fa-asterisk" aria-hidden="true"></i> '.$value->f_subcat_name.'</li>';
                         $i++; }
                        
                          }
                       }
                        echo '</ul>';
                       ?>                                   
                      </div>
                    </div>
                  </div>
                </div>                
              </div>
            </div>

          </div>
          <div class="description-sec">
            <div class="dmv-heading">
              <h3>Description</h3>
            </div>
            <div class="descip-txt">
              <p><?php if(isset($businessDetail[0]->vac_description)){ echo $businessDetail[0]->vac_description; }?></p>
            </div>
          </div>
          <div class="description-sec">

             <div class="map-section-vac">
              <div class="dmv-heading">
                <h3>Map</h3>
              </div>
              <div style="width:100%;height: 450px" id="map"></div>
            </div>

            <div class="dmv-heading">
              <h3>Reviews (<?php if(isset($avgReview[0]->total)){ echo number_format((float)$avgReview[0]->total, 1, '.', '');}else{echo 0;} ?>/5)
                <span class="avgreview">
                  <?php 
                  $starNumber = $avgReview[0]->total;
                  for($x=1;$x<=$starNumber;$x++) { ?>
                     <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                  <?php  }
                  if (strpos($starNumber,'.')) { ?>
                     <a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                  <?php $x++;
                  } 
                  while ($x<=5) { ?>
                     <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                  <?php $x++;
                  }

                  ?>
                </span>
              </h3>
            </div>
            <div class="descip-txt">
              <div  class="btns-msg ">

                <div id="reviewDiv">  
                  <a class="rbtn leave_a_review leave_a_review cenl-payt" data-id="leave_a_review" data-toggle="modal" href="#leave_a_review" >Submit a review</a>
                  <div id="ajax_table">
                   
                  </div>
                   <span class="btn" id="load_more" data-val = "0" style="color: #387fcc;border-color: #387fcc;margin-top: 10px;">Load More<img style="display: none" id="loader" src="<?php echo base_url(); ?>assets/images/loader.GIF"> </span>  
                  </div>  
                   
                </div>
              </div>
            </div>

           
          </div>
          <div class="col-md-3 col-sm-4 pad-min">
            <div class="owner-info">
               <div class="dmv-heading">
                 <h3>Owner Information</h3>
               </div>
              <div class="profile-pic-vac">
              <?php 
                  if(isset($businessDetail[0]->profile_picture) && !empty($businessDetail[0]->profile_picture)){ 
                  if(strpos($businessDetail[0]->profile_picture, "http://") !== false OR strpos($businessDetail[0]->profile_picture, "https://") !== false){
                    $img = $businessDetail[0]->profile_picture;
                  }else
                  {
                    $img = base_url().$businessDetail[0]->profile_picture;
                  }
                  }
                  else
                  { 
                     $img =  base_url().'assets/images/default.png';
                  }
              ?>
              
                <img src="<?php echo $img; ?>" >
              </div>
              <div class="ppv-dtls">
                <div class="ppv-detl-head">
                  <h4><?php if(isset($businessDetail[0]->fname)){ echo $businessDetail[0]->fname; }?></h4>
                </div>
               <!--  <div class="ppv-detl-sub">
                  <i class="fa fa-map-marker"></i>
                  <span class="add-vac"><?php if((isset($businessDetail[0]->address)) && (!empty($businessDetail[0]->address))){ echo $businessDetail[0]->address; }else {'Address';}?></span>
                </div> -->
                <div class="ppv-detl-sub">
                  <i class="fa fa-calendar"></i>
                  <span class="add-vac">Posted <?php if(isset($businessDetail[0]->vac_created_date)){$date = date_create($businessDetail[0]->vac_created_date); 
                            echo date_format($date, 'd M Y');}?></span>
                </div>
              </div>
            </div>            
            
          <div class="google-ad-vac" style="float: left">
               <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Lodging Details'));
              ?>
              <style>
              .example_responsive_1 { width: 160px !important; height: 600px !important; }
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
  </section>
</div>
<footer id="footer" class="main_footer">
  <?php $this->load->view('include/main_footer');?>
</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright');?>
</div>
<!-- model review -->
<div class="review-modal modal fade" id="leave_a_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>REVIEW</h4>
        </div>
        <div class="modal-body"> 
        <div id="after-comment"></div>
          <form class="offer-create-frm" name="reviewfrm" id="reviewfrm" method="post">
            <div class="review-formation">
              <input type="hidden" name="user_ID" name="user_ID" value="<?php echo $user_id; ?>">
              <input type="hidden" name="bus_ID" name="bus_ID" value="<?php if(isset($businessDetail[0]->vac_id)){ echo $businessDetail[0]->vac_id; }?>">
                <div class="review-div"><label>Rating</label>
                  <fieldset id='demo1' name="demo1" class="rating">
                    <input class="stars" type="radio" id="star1" name="rating" value="5" />
                    <label class = "full" for="star1" data="" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="star2" name="rating" value="4" />
                    <label class = "full" for="star2" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="star3" name="rating" value="3" />
                    <label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="star4" name="rating" value="2" />
                    <label class = "full" for="star4" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="star5" name="rating" value="1" />
                    <label class = "full" for="star5" title="Sucks big time - 1 star"></label>
                </fieldset>
              </div>
              <div class="review-details">
                <div class="one-review-box"><label>Name</label></div>
                <div class="one-review-box"><input type="text" name="req_user" id="req_user" placeholder="Enter Name" value="<?php if(isset($userDetailR->fname) || isset($userDetailR->lname) ){echo $userDetailR->fname.' '.$userDetailR->lname;} ?>" readonly style="width: 100%; height: 38px; padding: 8px 12px; margin-bottom: 10px;"></div>
                <div class="one-review-box"><label>Title</label></div>
                <div class="one-review-box"><input type="text" name="review_title" id="review_title"></div>
                <div class="one-review-box"><label>Comment</label></div>
                <div class="one-review-box"><textarea name="comment" id="comment" placeholder="Enter Comment"></textarea></div>
                <div class="s-btn"><button name="reviewbtn" id="reviewbtn" type="submit">Submit</button></div>
              </div>
            </form>
          </div>   
        </div>
      </div>
  </div>
</div>
<!-- model review -->
<script>
    $(document).ready(function(){
        getcountry(0);

        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');
            getcountry(page);

        });
        //getcountry();
    });

    var getcountry = function(page){
       $("#loader").show();
        var busID = '<?php if(isset($businessDetail[0]->vac_id)){ echo $businessDetail[0]->vac_id; }?>';
        $.ajax({
            url:"<?php echo base_url() ?>ajax/getReview",
            type:'GET',
            dataType:'html',
            data: {page:page,busID:busID}
        }).done(function(response){
           
            $("#loader").hide();
            if (response == 1) {
              $("#load_more").html('<span>No more records.</span>').show();
              } else {
             // $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
              $("#ajax_table").append(response);
              $('#load_more').data('val', ($('#load_more').data('val')+1));
              scroll();
            }
            
        });
    };

   var scroll  = function(){
        $('#ajax_table').animate({
            scrollTop: $('#load_more').offset().top
        }, 1000);
    };
</script>
<script>
    $(document).ready(function() {


/*$(".full").click(function(){
alert($(this).parent().val());
});*/

     /* $("#owl-demo-3").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          singleItem : true,
          pagination : false,
          autoPlay : true
      });*/
    });
</script>
<?php $g_key =google_mapkey(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>"></script> 
<script>
  function readmore(i){
    $('.trailDescMore'+i+'').hide();
    $('.trailDescless'+i+'').show();
    $('.trailDes'+i+'').addClass('readmore');
}
function readless(i){
    $('.trailDescless'+i+'').hide();
    $('.trailDescMore'+i+'').show();
    $('.trailDes'+i+'').removeClass('readmore');
}
  function initMap() {
  var uluru = {lat: <?php if(isset($businessDetail[0]->vac_lat)){ echo $businessDetail[0]->vac_lat; }?>, lng: <?php if(isset($businessDetail[0]->vac_lang)){ echo $businessDetail[0]->vac_lang; }?>};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: uluru
  });


   var iconicon = {
        url: "<?php echo base_url().'assets/images/location.png'; ?>", // url
        scaledSize: new google.maps.Size(25, 28), // scaled size
     
        };
  var mapTitle = '<?php if(isset($businessDetail->vac_address)) {echo $businessDetail->vac_address; }?>';
  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
    icon: iconicon,
    title: mapTitle
  });


      var contentString = '<div id="content1" class="map-deta">'+
        '<div class="row">'+
        '<div id="siteNotice" class="col-sm-12">'+
        '</div>'+
        '<div id="bodyContent" class="col-sm-6">'+
        '<p class="imag-loc"><img src="<?php if(isset($businessImage[0]->vac_imag) && !empty($businessImage[0]->vac_imag)) { echo base_url().$businessImage[0]->vac_imag; } ?>" style="width:100%;" ></p>'+   
        '</div>'+
        '<div class="col-sm-6 text-left"><h2 id="firstHeading" class="firstHeading" style="font-size: 16px;margin: 0;"><?php if(isset($businessDetail[0]->vac_name)){ echo $businessDetail[0]->vac_name; }?></h2>'+
        '<div class="review-details"><ul class="review-map"> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li><li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li> <li>(0)</li></ul></div>'+
        '<p><?php if(isset($businessDetail[0]->vac_address)){ echo $businessDetail[0]->vac_address; }?></p><p><a href=""><?php if(isset($businessDetail[0]->vac_wedsite_url)){ echo $businessDetail[0]->vac_wedsite_url; }?></a></p></div>'+        
        '</div>'+
        '</div>';

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

    $("#reviewfrm").submit(function(e) {
      e.preventDefault();
      var formData = new FormData();
      
      var frmdata = $(reviewfrm).serializeArray();
      $.each(frmdata, function (key, input) {
      formData.append(input.name, input.value);
      });
   var rating = $('input[name=rating]:checked').val();
   var comment = $('#comment').val();
   if(rating!==undefined && comment !='' ){
     jQuery.ajax({
      type: "POST",
      url : "<?php echo base_url();?>ajax/review",
      data: formData,
      dataType: "JSON",
      contentType: false,
      processData: false,
      success:function(data){
          if(data == 1){
              $('#form-error').html('');
              $('#after-comment').removeClass('alert alert-danger');
              $('#after-comment').html('Review successfully completed').addClass('alert alert-success').show().fadeOut(15000);
              $('#reviewfrm')[0].reset();
              location.reload();
               //$('#leave_a_review').delay(1000).fadeOut(1000);
           //   $("#reviewDiv").load(location.href + " #reviewDiv");

          }
     }

    });

   }else{
    alert('Please select a star rating');
   }
  return false;

  }); 

/******************* request booking form. *************************/
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


$(function() {
 $("#requestbookingfrm").validate({
    rules: {
      req_phone: "required",
      request_description: "required",
      req_email: {
        required: true,
        email: true
      }
      
    },
   messages: {
      req_phone: "Please enter your contact no",
      request_description: "Please enter description",
      req_email: {
        required: "Please enter your email id",
        email: "Please enter valid email id"
      }
    },
   submitHandler: function() {
    var formData = new FormData();
    var frmdata = $(requestbookingfrm).serializeArray();
    $.each(frmdata, function (key, input) {
       formData.append(input.name, input.value);
    });
    jQuery.ajax({
    type: "POST",
    url : "<?php echo base_url();?>ajax/requestbooking",
    data: formData,
    dataType: "JSON",
    contentType: false,
    processData: false,
    success:function(data){
        if(data == 1){
           $('#request-booking').removeClass('alert alert-danger');
            $('#request-booking').html('Booking request send successfully').addClass('alert alert-success').show().fadeOut(3000);
            $('#requestbookingfrm')[0].reset();
            setTimeout(function(){ $('#request-booking-modal').hide(); }, 3000);
        }
    }

    });
       return false;
    }
  });
});


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
</body>
</html>