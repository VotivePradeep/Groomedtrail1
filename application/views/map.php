 <?php 
      /* if(isset($mapdata)){
        foreach ($mapdata as $mapPoint) { 
        
         $str_old =  str_replace(' ', '', $mapPoint->lat_lang);
         $str =  str_replace(',0', '#', $str_old);
         $strarr = explode('#', $str);
          foreach ($strarr as $value) {
            $latlng = explode(',', $value);
            if( count($latlng) < 2 ){
                   continue;
            }
           
         //  echo $latlng[1].'lat <br/>';
          // echo $latlng[0].'lang <br/>';
          
          }
          echo  $mapPoint->kml_trail_name;
        }
    }*/
    

?>            


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    #map { height: 100%; width: 100% }
</style>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEDVd3ns05bhTmlTSlS_zopAJxkbkp5hw"></script>
    
<script type="text/javascript">

var map, infowindow;
var polylines = [];
function initialize() {
    var mapOptions = {
        center: {lat: 44.314844, lng: -85.602364},
        zoom:8
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    infowindow = new google.maps.InfoWindow();
    var src = 'http://dev1.groomedtrail.com/upload/Oakland1517249272/1517249272.kml';

var kmlLayer = new google.maps.KmlLayer(src, {
          suppressInfoWindows: true,
          preserveViewport: false,
          map: map
        });
        kmlLayer.addListener('click', function(event) {
          var content = event.featureData.infoWindowHtml;
          var testimonial = document.getElementById('capture');
          testimonial.innerHTML = content;
        });

}



google.maps.event.addDomListener(window, 'load', initialize);  
</script>
</head>

<body>
    <div id='map'></div>
    <input type="text" id="polLnClr" />
</body>
</html>


