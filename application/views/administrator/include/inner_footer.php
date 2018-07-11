 <!-- Warper Ends Here (working area) -->

        <footer class="container-fluid footer">

        	Copyright &copy; 2017 <?php /*?><a href="http://freakpixels.com/" target="_blank">FreakPixels</a><?php */?>

            <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>

        </footer>

    </section>

    <!-- Content Block Ends Here (right box)-->

   <!-- <script src="<?php echo base_url(); ?>assets_admin/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>-->
  	

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/underscore/underscore-min.js"></script>

    <!-- Bootstrap -->

    <script src="<?php echo base_url(); ?>assets_admin/js/bootstrap/bootstrap.min.js"></script>

    

    <!-- Globalize -->

    <script src="<?php echo base_url(); ?>assets_admin/js/globalize/globalize.min.js"></script>

    

    <!-- NanoScroll -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>

    

    <!-- Chart JS -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/DevExpressChartJS/dx.chartjs.js"></script>

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/DevExpressChartJS/world.js"></script>

   	<!-- For Demo Charts -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/DevExpressChartJS/demo-charts.js"></script>

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/DevExpressChartJS/demo-vectorMap.js"></script>

    

    <!-- Sparkline JS -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- For Demo Sparkline -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/sparkline/jquery.sparkline.demo.js"></script>

    

    <!-- Angular JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.14/angular.min.js"></script>

    <!-- ToDo List Plugin -->

    <script src="<?php echo base_url(); ?>assets_admin/js/angular/todo.js"></script>

    

    <!-- Calendar JS -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/calendar/calendar.js"></script>

    <!-- Calendar Conf 

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/calendar/calendar-conf.js"></script>-->

	

    

	<!-- Data Table -->

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/datatables/jquery.dataTables.js"></script>

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/datatables/DT_bootstrap.js"></script>

    <script src="<?php echo base_url(); ?>assets_admin/js/plugins/datatables/jquery.dataTables-conf.js"></script>

    <!-- Custom JQuery -->

	<script src="<?php echo base_url(); ?>assets_admin/js/moment/moment.js"></script>

	<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

	<script src="<?php echo base_url(); ?>assets_admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

	<script src="<?php echo base_url(); ?>assets_admin/js/app/custom.js" type="text/javascript"></script>

	

	<script src="<?php echo base_url(); ?>assets_admin/js/plugins/ckeditor/ckeditor.js"></script>

	<script src="<?php echo base_url(); ?>assets_admin//js/plugins/ckeditor/adapters/jquery.js"></script>


<?php $g_key =google_mapkey(); ?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>
<script type="text/javascript">
        $(document).ready(function() { 
             $('#toggleColumn-datatable11').DataTable();
        });
       /* google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('poi_address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                //alert(mesg);
            });
        });*/
 function addressAndzipcode() {
  var input = document.getElementById('poi_address');
  var options = {
    types: ['address'],
    componentRestrictions: {
      country: 'us'
    }
  };
  autocomplete = new google.maps.places.Autocomplete(input, options);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    document.getElementById('lat').value = place.geometry.location.lat();
    document.getElementById('lng').value = place.geometry.location.lng();
    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
         if (place.address_components[i].types[j] == "administrative_area_level_1") {
          $('#region_name').val(place.address_components[i].long_name);
        }
      }
    }
  })
}
google.maps.event.addDomListener(window, "load", addressAndzipcode);

function vacaddress() {
  var input = document.getElementById('vac_address');
  var options = {
    types: ['address'],
    componentRestrictions: {
      country: 'us'
    }
  };
  autocomplete = new google.maps.places.Autocomplete(input, options);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    document.getElementById('pro_add_lat').value = place.geometry.location.lat();
    document.getElementById('pro_add_lng').value = place.geometry.location.lng();
    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          $('#vac_zip_code').val(place.address_components[i].long_name);
        }
         if (place.address_components[i].types[j] == "locality") {
          $('#vac_city').val(place.address_components[i].long_name);
        }
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          $('#vac_state').val(place.address_components[i].long_name);
        }
      }
    }
  })
}
google.maps.event.addDomListener(window, "load", vacaddress);

// Setup form validation on the #login-form element
    $("form[name='publishFrm']").validate({

        // Specify the validation rules
        rules: {
            statusChange: {
                required: true
            },
            vac_message: {
                required: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            statusChange: {
                required: "Please select status"
            },
            vac_message: "Please enter message"
        },
        
        submitHandler: function(form) {
            alert(1);
         form.submit();
        }
    });

    </script>
<script type="text/javascript">
    
     google.maps.event.addDomListener(window, 'load', function () {
        
            //var poi_address = new google.maps.places.Autocomplete(document.getElementById('poi_address'));
            var route_from = new google.maps.places.Autocomplete(document.getElementById('route_from'));
            var route_to = new google.maps.places.Autocomplete(document.getElementById('route_to'));
            var business_address = new google.maps.places.Autocomplete(document.getElementById('business_address'));

            var places = [ route_from, route_to, business_address ];
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                
            });
        });
// assumes you're using jQuery
$(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>

});

/*$("#toggleColumn-datatable").DataTable({
"order": [[ 4, "desc" ]]
}); */

</script>
   

	

    

    


<style>	     

label.error{

	color:#FF0000;

	font-weight:300;

}
.pac-container:after {
    /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */

    background-image: none !important;
    height: 0px;
}
</style>

</body>

</html>