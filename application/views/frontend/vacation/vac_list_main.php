<div id="reena" >
<div class="map-main sticky" >
     <div id="mapCanvas" style="width: 100%; height: 100%"></div></div>

    <div class="main-listing-sec content-holder" >
    <?php
    $t=0; $i=1;
    if(isset($businessList) && !empty($businessList)){
        foreach ($businessList as $businessLst) { ?>

        <div id="pin_<?php echo $t; ?>" class="hover-anim" onmouseover="hover(<?php echo $i; ?>)" onmouseout="out(<?php echo $i; ?>)">
        
            <div class="listing-sub" id="businessListingxx">
                <div class="image-lis-carouroul">
                    <div id="demo" class="">
                        <div id="owl-demo-2" class="owl-carousel list-carosel">
                        <?php
                        if(isset($businessLst->vac_address)){
                            $vac_ID = $businessLst->vac_id;
                        }
                        $query = $this->db->query('select * from tbl_vacation_list_images where vac_id = '. $vac_ID.'');
                        $vacImage = $query->result();
                        if(isset($vacImage)){
                            foreach ($vacImage as $vacImage) {
                         ?>
                          <div class="item">
                            <div class="img-car-list">
                                <img src="<?php if(isset($vacImage->vac_imag) && !empty($vacImage->vac_imag)){ echo $vacImage->vac_imag;} ?>">
                            </div>
                          </div>
                        <?php }} ?>              
                        </div>
                    </div>
                </div> 
                <div class="image-txt-sub" >
                    <div onclick="window.location.href='<?php echo base_url().'lodging/'.$businessLst->vac_slag; ?>'">
                    <div class="img-txt-subhead">
                        <h3><?php if(isset($businessLst->vac_name)){
                          $vac_name_old = $businessLst->vac_name;

$words = explode(" ",$vac_name_old);
echo $content = implode(" ",array_splice($words,0,5));
                          
                        } ?></h3>
                    </div>
                    <p><i class="fa fa-map-marker"></i>
                      <b><?php if(isset($businessLst->vac_address)){
                           //echo $businessList->vac_address;
                           if(isset($businessLst->vac_city)){
                              $rentalcity = $businessLst->vac_city;
                           }else{
                              $rentalcity = '';
                           }
                           echo $address = str_replace( $rentalcity.',','', $businessLst->vac_address);
                         } 
                        ?></b>
                     <b> <span class="property-city" style="display: block;margin-left: 19px;">  <?php if(isset($businessLst->vac_city)){echo ucfirst($businessLst->vac_city); } ?></span> </b>
                    </p>
                    <div class="details_listing">
                      <ul>
                        <li><span>Sleeps</span> <span><?php if(isset($businessLst->vac_sleep)){echo $businessLst->vac_sleep; } ?></span></li>
                        <li><span>Bedroom </span><span><?php if(isset($businessLst->vac_no_of_bedroom)){echo $businessLst->vac_no_of_bedroom; } ?></span></li>
                        <li><span>Bathroom</span><span><?php if(isset($businessLst->vac_bathroom)){echo $businessLst->vac_bathroom; } ?></span></li>
                      </ul>
                    </div>
                    <p class="excep"><a href="#"><?php if(isset($businessLst->vac_wedsite_url)){echo $businessLst->vac_wedsite_url; } ?> </a></p>
                    </div>
                    
                    <div class="review-p">
                      <div class="col-sm-6">
                        <h2>$<?php if(isset($businessLst->vac_price)){echo $businessLst->vac_price; } ?> <span>avg/night</span></h2>
                      </div>
                      <div class="col-sm-6">
                        <div class="review-main">
                            <ul>
                            <?php 
                              $starNumber = $businessLst->totalrating;

                              for($x=1;$x<=$starNumber;$x++) { ?>
                              
                                <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                <?php  }
                                if (strpos($starNumber,'.')) { ?>
                                <li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                                <?php $x++;
                                 } 
                                 while ($x<=5) { ?>
                                 <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                  <?php $x++;
                                } ?>
                                <li>(<?php if(!empty($starNumber)){ echo round($starNumber, 2); }else{ echo 0;} ?>)</li>
                              </ul>
                        </div>
                      </div>
                    </div>
                </div> 
            </div>
        </div>
           
     <?php  $i++; $t++;} }else{  ?>
     <p>We couldn't find any match for your search.<br>
     <?php } ?>
  
    </div>    

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/owl.carousel.min.js"></script> 
<script>
$(document).ready(function(){
slider();
});

//Function called when hover the div
function hover(id) {
    for ( var i = 0; i< allMarkers.length; i++) {
        if (id === allMarkers[i].id) {
           allMarkers[i].setIcon(icon2);
           map.setCenter(allMarkers[i].getPosition());
           break;
        }
   }
}

//Function called when out the div
function out(id) {  
    for ( var i = 0; i< allMarkers.length; i++) {
        if (id === allMarkers[i].id) {
           allMarkers[i].setIcon(icon1);
           break;
        }
   }
}

    $(document).ready(function() {
      loadmap();
    });

var currCenter;
var allMarkers = [];
var map;
var icon2 = {
      url: "<?php echo base_url().'assets/images/map_icon/Lodging-hover.png'; ?>", // url
      scaledSize: new google.maps.Size(23, 29), // scaled size
    
      };
var icon1 = {
      url: "<?php echo base_url().'assets/images/map_icon/Lodging.png'; ?>", // url
      scaledSize: new google.maps.Size(23, 29), // scaled size
     
      };
      function loadmap(){
//$(document).ready(function() {
// LoadMap();
// google.maps.event.addDomListener(window, 'load', function () {
//Create the map
map = new google.maps.Map(document.getElementById("mapCanvas"), {
    center: new google.maps.LatLng(44.314844, -85.602364),
    zoom: 5,
    mapTypeId: google.maps.MapTypeId.ROADMAP
});
  //Create and open InfoWindow.
var infoWindow = new google.maps.InfoWindow();  
<?php 
///$businessMarker = $businessList;
if(isset($businessList)){
$r=1;
foreach ($businessList as $businessL) {
$description_old = $businessL->vac_description;
$description = str_replace("'", "", $description_old);
$words = explode(" ",$description);
$content1 = implode(" ",array_splice($words,0,10));
$content =trim(preg_replace('/\s+/',' ', $content1));

$businessImage = $this->model->get_data('*','tbl_vacation_list_images', array('vac_id'=>$businessL->vac_id));
 ?>
//Create the marker 1
var marker<?php echo $r; ?> = new google.maps.Marker({
    position: new google.maps.LatLng(<?php if(isset($businessL->vac_lat)){echo $businessL->vac_lat;}?>,<?php if(isset($businessL->vac_lang)){echo $businessL->vac_lang;}?>),
    map: map,
    id: <?php echo $r; ?>,
    icon: icon1,
    title: "<?php if(isset($businessL->vac_name)){echo $businessL->vac_name;}?>"
});
allMarkers.push(marker<?php echo $r; ?>); //Add it to allMarkers
//Attach click event to the marker.
   
        google.maps.event.addListener(marker<?php echo $r; ?>, "click", function (e) {

       var contentString =  "<div style = 'width:300px;min-height:60px' class='MainPoiDetail'>" +
                        '<h2 id="firstHeading" class="firstHeading" style="font-size: 16px;margin: 0;"><?php if(isset($businessL->vac_name)){ echo $businessL->vac_name; }?></h2>'+
                        '<div class="reviewRating"><ul class="review-map"><?php $starNumber = $businessL->totalrating; for($x=1;$x<=$starNumber;$x++) { ?><li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li><?php  } if (strpos($starNumber,'.')) { ?><li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li><?php $x++; }  while ($x<=5) { ?><li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li><?php $x++; } ?><li>(<?php if(!empty($starNumber)){ echo round($starNumber, 2); }else{ echo 0;} ?>)</li></ul></div>'+
                        '<div class="withImgPoi"><div class="busImage"><img src="<?php if(isset($businessImage[0]->vac_imag) && !empty($businessImage[0]->vac_imag)) { echo base_url().$businessImage[0]->vac_imag; } ?>" style="height:80px;width:80px;"></div>'+
                        '<div class="mainInfoPoi"><div class="vac_address"><?php if(isset($businessL->vac_address)){ echo $businessL->vac_address; }?></div>'+
                        '<div class="sleepbus"><span>Sleeps</span><p><?php if(isset($businessL->vac_sleep)){ echo $businessL->vac_sleep; }?></p></div>'+
                        '<div class="sleepbus"><span>Bedroom</span><p><?php if(isset($businessL->vac_no_of_bedroom)){ echo $businessL->vac_no_of_bedroom; }?></p></div>'+
                        '<div class="sleepbus"><span>Bathroom</span><p><?php if(isset($businessL->vac_bathroom)){ echo $businessL->vac_bathroom; }?></p></div></div></div>'+
                        '<div class="viewBusDetail">'+
                        '<button><a href="<?php echo base_url().'lodging/'.$businessL->vac_slag; ?>" target="_blank">View Detail</a></button>'+
                        '</div>'+
                        "</div>";






            //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
            infoWindow.setContent(contentString);
            infoWindow.open(map, marker<?php echo $r; ?>);
        });
 

<?php $r++; } }?>    

/*var business_address = new google.maps.places.Autocomplete(document.getElementById('businessSearch'));
var adv_ft_loc = new google.maps.places.Autocomplete(document.getElementById('adv_ft_loc'));

var places = [ business_address,adv_ft_loc ];
google.maps.event.addListener(places, 'place_changed', function () {
    var place = places.getPlace();
    var address = place.formatted_address;
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    var mesg = "Address: " + address;
    mesg += "\nLatitude: " + latitude;
    mesg += "\nLongitude: " + longitude; 
});*/

 //Get current center
 


}
 $(document).on("click", "#mapZoom", function(){

    $(".map-main").toggleClass("stretch-m");
    //$(".main-listing-sec").toggleClass("stretch-l");
    $('.map').toggleClass('fullsize');
    google.maps.event.trigger(map, 'resize');
    map.setCenter(currCenter);

    
});

</script>
