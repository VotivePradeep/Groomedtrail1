<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
.form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
.panel.panel-default.add-user-sec form#addroute {
    margin: 0 auto;
    max-width: 708px;
}
.pern-status {
    display: inline-block;
    margin: 0 0 0 0;
    position: relative;
    padding: 0 35px 0 0;
}
.permission-name {
    text-transform: uppercase;
}
 </style>
<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading"><?php if(isset($basesegment) && $basesegment == 'addrental'){ echo 'Add New Rentals'; }else{
              echo 'Edit New Rentals';
              }
              ?></div>
        <div class="panel-body">
          <div id="responseMsg"></div>
          <form name="addvacbusin" id="addvacbusin" method="post" action="<?php if(isset($basesegment) && $basesegment == 'addrental'){ echo base_url().'administrator/addrental'; }else{
            echo base_url().'administrator/editrental/'.$busID; } ?>" enctype="multipart/form-data">
              <input type="hidden" name="vac_id" id="vac_id" class="form-control" value="<?php if(isset($busID)) {echo $busID; }?>" />
              <input type="hidden" name="plan_id" id="plan_id" class="form-control" value="<?php if(isset($businessDetail->pl_id)){echo $businessDetail->pl_id; }else{echo 0;}?>" />
              <div class="row">
              <div class="col-md-6 form-group">
                  <label for="vac_name">Property Name</label>
                  <input type="text" name="vac_name" id="vac_name" class="form-control" placeholder="Enter property name" value="<?php if(isset($businessDetail->vac_name)) {echo $businessDetail->vac_name; }else{echo set_value('vac_name'); }?>"/>
                  <label id="vac_name-error" class="error" for="business_name"><?php echo form_error('vac_name');?></label>
              </div>
              <div class="col-md-6 form-group">
                  <label for="vac_type">Property Type</label>
                  <select class="form-control" name="vac_type" id="vac_type">
                        <option value="">Select Property Type</option>
                        <?php if(isset($propertyList)){
                          foreach ($propertyList as $PropertyType) { 
                            if($PropertyType->f_cat_name == 'Property Type'){ ?>
                          <option value="<?php if(isset($PropertyType->f_subcat_name)){ echo $PropertyType->f_subcat_name; }?>" <?php if(isset($businessDetail->vac_type)){ if($PropertyType->f_subcat_name == $businessDetail->vac_type){ echo "selected"; } }else{ set_select('vac_type', $PropertyType->f_subcat_name); }  ?>><?php if(isset($PropertyType->f_subcat_name)){ echo $PropertyType->f_subcat_name; }?></option>
                        <?php } } } ?>                        
                  </select>
                 <label id="vac_type-error" class="error" for="businvac_typeess_name"><?php echo form_error('vac_type');?></label>
              </div>
              </div>
              <div class="row">
               <div class="col-md-6 form-group">
                  <label for="vac_contact">Property Phone Number</label>
                  <input type="text" name="vac_contact" id="vac_contact" class="form-control" placeholder="Enter property phone number" value="<?php if(isset($businessDetail->vac_contact)) {echo $businessDetail->vac_contact; }else{echo set_value('vac_contact'); }?>" maxlength="14" minlengt="14"/>
                  <label id="vac_contact-error" class="error" for="vac_contact"><?php echo form_error('vac_contact');?></label>                     
              </div>

              <div class="col-md-6 form-group">
                  <label for="vac_email">Email Address</label>
                   <input type="text" name="vac_email" id="vac_email" class="form-control" placeholder="Enter email address" value="<?php if(isset($businessDetail->vac_email)) {echo $businessDetail->vac_email; }else{echo set_value('vac_email'); }?>"/>
                    <label id="vac_email-error" class="error" for="vac_email"><?php echo form_error('vac_email');?></label>
              </div>
              </div>
              <div class="row">
              <div class="col-md-6 form-group">
                  <label for="vac_address">Property Address</label>
                  <input type="text" name="vac_address" id="vac_address" class="form-control" placeholder="Enter property address"  value="<?php if(isset($businessDetail->vac_address)) {echo $businessDetail->vac_address; }else{echo set_value('vac_address'); }?>" />
                  <label id="vac_address-error" class="error" for="vac_address"><?php echo form_error('vac_address');?></label>
                  <input type="hidden" name="pro_add_lat" id="pro_add_lat" placeholder="Latitude" value="<?php if(isset($businessDetail->vac_lat)) {echo $businessDetail->vac_lat; }else{echo set_value('pro_add_lat'); }?>" />
                  <input type="hidden" name="pro_add_lng" id="pro_add_lng" placeholder="Longitude" value="<?php if(isset($businessDetail->vac_lang)) {echo $businessDetail->vac_lang; }else{echo set_value('pro_add_lng'); }?>"/>
               </div>
               <div class="col-md-3 form-group">
                  <label for="vac_address">City</label>
                  <input type="text" name="vac_city" id="vac_city" class="form-control" placeholder="Enter city"  value="<?php if(isset($businessDetail->vac_city)) {echo $businessDetail->vac_city; }else{echo set_value('vac_city'); }?>" />
                  <label id="vac_city-error" class="error" for="vac_city"><?php echo form_error('vac_city');?></label>
               </div>
               <div class="col-md-3 form-group">
                  <label for="vac_address">Zip Code</label>
                  <input type="text" name="vac_zip_code" id="vac_zip_code" class="form-control" placeholder="Enter Zip Code"  value="<?php if(isset($businessDetail->vac_zip_code)) {echo $businessDetail->vac_zip_code; }else{echo set_value('vac_zip_code'); }?>"/>
                  <label id="vac_zip_code-error" class="error" for="vac_zip_code"><?php echo form_error('vac_zip_code');?></label>
               </div>
               
              </div>
              <?php /*?><div class="row">
              
               <div class="col-md-6 form-group">
                  <label for="vac_address">State</label>
                      <select class="form-control" name="vac_state" id="vac_state">
                        <option value="">Select State</option>
                        <?php if(isset($stateList)){
                          foreach ($stateList as $stateList) { ?>
                          <option value="<?php if(isset($stateList->state_name)){ echo $stateList->state_name; }?>" <?php if(isset($businessDetail->vac_type)){ if($businessDetail->state_name == $stateList->state_name){ echo "selected"; } }  ?>><?php if(isset($stateList->state_name)){ echo $stateList->state_name; }?></option>
                        <?php } }?>                        
                      </select>
                  <label id="vac_state-error" class="error" for="vac_state"><?php echo form_error('vac_state');?></label>
               </div>
               <div class="col-md-6 form-group">
                  <label for="vac_address">Zip Code</label>
                  <input type="text" name="vac_zip_code" id="vac_zip_code" class="form-control" placeholder="Enter Zip Code"  value="<?php if(isset($businessDetail->vac_zip_code)) {echo $businessDetail->vac_zip_code; }else{echo set_value('vac_zip_code'); }?>" />
                  <label id="vac_zip_code-error" class="error" for="vac_zip_code"><?php echo form_error('vac_zip_code');?></label>
               </div>
               </div> <?php */ ?>
               <div class="row">
               <div class="col-md-6 form-group">
                  <label for="vac_wedsite_url">Website Address</label>
                  <input type="text" name="vac_wedsite_url" id="vac_wedsite_url" class="form-control" placeholder="Enter website address"  value="<?php if(isset($businessDetail->vac_wedsite_url)) {echo $businessDetail->vac_wedsite_url; }else{echo set_value('vac_wedsite_url'); }?>" />
                  <label id="vac_wedsite_url-error" class="error" for="vac_wedsite_url"><?php echo form_error('vac_wedsite_url');?></label>
              </div>
               <div class="col-md-6 form-group">
                  <label for="vac_no_of_bedroom">Number of bedrooms</label>
                  <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="5" name="vac_no_of_bedroom" id="vac_no_of_bedroom" class="form-control" placeholder="Enter number of bedrooms" value="<?php if(isset($businessDetail->vac_no_of_bedroom)) {echo $businessDetail->vac_no_of_bedroom; }else{echo set_value('vac_no_of_bedroom'); }?>"/>
                  <label id="vac_no_of_bedroom-error" class="error" for="vac_no_of_bedroom"><?php echo form_error('vac_no_of_bedroom');?></label>                     
              </div>
              </div>
              <div class="row">
              <div class="col-md-6 form-group">
                  <label for="vac_bathroom">Number of Bathrooms</label>
                  <input type="text" maxlength="5" name="vac_bathroom" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="5" id="vac_bathroom" class="form-control" placeholder="Enter number of bathrooms" value="<?php if(isset($businessDetail->vac_bathroom)) {echo $businessDetail->vac_bathroom; }else{echo set_value('vac_bathroom'); }?>"/>
                  <label id="vac_bathroom-error" class="error" for="vac_bathroom"><?php echo form_error('vac_bathroom');?></label>                     
              </div>
              <div class="col-md-6 form-group">
                  <label for="vac_sleep">Sleeps</label>
                  <input type="text" maxlength="5"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="vac_sleep" id="vac_sleep" class="form-control" placeholder="Enter number of people it sleeps" value="<?php if(isset($businessDetail->vac_sleep)) {echo $businessDetail->vac_sleep; }else{echo set_value('vac_sleep'); }?>"/>
                  <label id="vac_sleep-error" class="error" for="vac_sleep"><?php echo form_error('vac_sleep');?></label>                     
              </div>     
              </div>
              <div class="row">
              <div class="col-md-6 form-group">
                  <label for="vac_price">Rental Daily Rate ($)</label>
                  <input type="text" name="vac_price" id="vac_price" class="form-control"  placeholder="Enter rental daily rate" value="<?php if(isset($businessDetail->vac_price)) {echo $businessDetail->vac_price; }else{echo set_value('vac_price'); }?>" />
                  <label id="vac_price-error" class="error" for="vac_price"><?php echo form_error('vac_price');?></label>                     
               </div>
               <div class="col-md-6 form-group">
                  <label for="vac_price">Rental Weekly Rate ($)</label>
                  <input type="text" name="vac_weekly_rate" id="vac_weekly_rate" class="form-control"  placeholder="Enter rental Weekly rate" value="<?php if(isset($businessDetail->vac_weekly_rate)) {echo $businessDetail->vac_weekly_rate; }else{echo set_value('vac_weekly_rate'); }?>" />
                  <label id="vac_weekly_rate-error" class="error" for="vac_weekly_rate"><?php echo form_error('vac_weekly_rate');?></label>                     
               </div>
               
               </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="vac_description">Location type</label>
                    <select class="form-control" name="vac_location_type" id="vac_location_type">
                        <option value="">Select Location type</option>
                        <?php if(isset($propertyList)){
                          foreach ($propertyList as $LocationType) { 
                            if($LocationType->f_cat_name == 'Location Type'){ ?>
                          <option value="<?php if(isset($LocationType->f_subcat_name)){ echo $LocationType->f_subcat_name; }?>" <?php if(isset($businessDetail->vac_location_type)){ if($LocationType->f_subcat_name == $businessDetail->vac_location_type){ echo "selected"; } }  ?>><?php if(isset($LocationType->f_subcat_name)){ echo $LocationType->f_subcat_name; }?></option>
                        <?php } } } ?>                        
                   </select>
                    <label id="vac_location_type-error" class="error" for="vac_location_type"><?php echo form_error('vac_location_type');?></label>
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="vac_description">Floor Area</label>
                    <input type="text" name="vac_floor_area" id="vac_floor_area" placeholder="Enter Floor Area" class="form-control" value="<?php if(isset($businessDetail->vac_floor_area)) {echo $businessDetail->vac_floor_area; }else{echo set_value('vac_floor_area'); }?>" >
                    <span>(Note:- sq.ft.)</span>
                    <label id="vac_floor_area-error" class="error" for="vac_floor_area"><?php echo form_error('vac_floor_area');?></label>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label for="vac_imag">Upload Rental Images</label>
                  <label class="upl-label-file" style="width: 100%;">
                    <input type="file" name="userfile[]" id="vac_imag" class="form-control" multiple accept="image/*"  />
                  </label>
                  <input type="text" name="vac_image_data" id="vac_image_data" style="width:0;height: 0;border:none;" value="<?php  if(isset($busPhotos) && !empty($busPhotos)){ echo count($busPhotos);}?>">
                  <div class="col-md-12 form-group">
                    <?php  if(isset($busPhotos) && !empty($busPhotos)){
                    foreach($busPhotos as $busPhotos) {?>
                    <div class="item_vac_image" id="cross<?php echo $busPhotos->vac_img_id;?>">
                    <a class="dltBusinessImage" id="<?php echo $busPhotos->vac_img_id;?>" name="<?php echo $busPhotos->vac_imag;?>">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                    <div style="background-size:cover; height:80px !important; background-image:url('<?php if(isset($busPhotos->vac_imag) && !empty($busPhotos->vac_imag)){ echo base_url().$busPhotos->vac_imag;}?>')">
                    </div>
                    </div>
                    <?php }}?>
                  </div>
               </div>
                <div class="row1">
                  <div class="col-md-12 form-group">
                    <div class="listform-group">
                      <label for="vac_amenities">Amenities</label>
                         <?php if(isset($propertyList)){
                          foreach ($propertyList as $FeaturesType) { 
                            if($FeaturesType->f_cat_name == 'Features'){ ?>
                           <span><input type="checkbox" name="vac_amenities[]" id="vac_amenities" value="<?php if(isset($FeaturesType->f_id)){ echo $FeaturesType->f_id; }?>" 
                              <?php 
                               if(isset($businessDetail->adv_filter_fields)){
                              $valueA = explode(",", $businessDetail->adv_filter_fields);
                              foreach ($valueA as $valueA) { if($valueA ==  $FeaturesType->f_id){  echo $checked='checked';  }   else  { echo $checked = '';   } } }?> > 

                               <?php if(isset($FeaturesType->f_subcat_name)){ echo $FeaturesType->f_subcat_name; }?>  </span>
                         <?php } } } ?>  
                         <label id="vac_amenities-error" class="error" for="vac_amenities"><?php echo form_error('vac_amenities[]');?></label>                      
                  </div>
                </div>
              </div>
               <div class="row1">
               <div class="col-md-12 form-group">
                  <label for="vac_description">Describe the details of your rental property</label>
                  <textarea  name="vac_description" id="vac_description" class="form-control" placeholder="Enter description"  ><?php if(isset($businessDetail->vac_description)) {echo $businessDetail->vac_description; }else{echo set_value('vac_description'); }?></textarea>
                  <label id="vac_description-error" class="error" for="vac_description"><?php echo form_error('vac_description');?></label>
              </div>
              </div>
              <div class="row1">
              <div class="col-sm-12">
              <button type="submit" id="add-business-btn" name="submit" class="btn btn-default">
                <?php 
                if(isset($segment) && $segment == 'add'){ 
                  echo 'Submit Rental Listing';
                 }else{
                       echo 'Update Rental Listing'; 
                 } 
                 ?> 
              </button>         
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Load jQuery UI Main JS  -->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
  $(document).ready(function() {
    $("#datepicker1").datepicker();
  });
</script>
<?php $g_key =google_mapkey(); ?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>
<script>

$("#vac_imag").on("change", function(){
    var $fileUpload = $("input[type='file']");
    $("#vac_image_data").val($fileUpload.get(0).files.length);
    if (parseInt($fileUpload.get(0).files.length)><?php if(isset($busPhotos) && !empty($busPhotos)){ echo 10-count($busPhotos); } else{ echo 10; } ?>){
     alert("You can select only 10 images");
     //this.form.reset();
     $(this).val('');
    }
});
</script>
<script type="text/javascript">
 $("#vac_city").on("change", function(){
  var aaaa = document.getElementById('vac_address').value+' '+document.getElementById('vac_city').value;
  var geocoder =  new google.maps.Geocoder();
    geocoder.geocode( { 'address': aaaa}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            document.getElementById('pro_add_lat').value =  results[0].geometry.location.lat();
            document.getElementById('pro_add_lng').value = results[0].geometry.location.lng();
          }
   });
}); 

function addressAndzipcode() {
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
      }
    }
  })
}
google.maps.event.addDomListener(window, "load", addressAndzipcode);

$(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
});


$(document).on('click','.dltBusinessImage',function(){

var img_id = this.id;
var business_img =   this.name;
<?php if(isset($busID) && !empty($busID)){ ?>
 var vac_id =   <?php if(isset($busID)){echo $busID;}?>;
<?php }else{ ?>
  var vac_id;
<?php } ?>
var link_url = "<?php echo base_url(); ?>administrator/vacations/businessImgUnlink?business_img="+business_img+"&img_id="+img_id+"&vac_id="+vac_id;
if (confirm('Do you want to remove this image?'))
  {
  $.ajax({
      url: link_url,
      success: function(data) {
            $( "#cross"+img_id).remove();
             if(data != 0){
                $("#vac_image_data").val(data);
             }else{
                  $("#vac_image_data").val('');
             }
          }
  });
    return false;
  }else {
     return true;
  }

});

</script>
<script>
  $.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var check = false;
        return this.optional(element) || regexp.test(value);
    },
    "Please check your input."
);
$(function() {
$("#addvacbusin").validate({
 rules: {
 vac_contact:{
    required: true,
    //regex: /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})$/
  },
 /* vac_wedsite_url:{
    url: true
  },*/
  vac_name:{ required: true },
  vac_type:{ required: true },
  vac_email:{ required: true },
  vac_address:{ required: true },
  vac_zip_code:{ required: true },
  vac_no_of_bedroom:{ required: true },
  vac_bathroom:{ required: true },
  vac_sleep:{ required: true },
  vac_price:{ required: true },
  vac_weekly_rate:{ required: true },
  vac_location_type:{ required: true },
  vac_floor_area:{ required: true },
  vac_image_data:{ required: true },
  vac_description:{ required: true }
},
messages: {
vac_contact:{
     required: "Please enter phone number",
     //regex:'Please enter valid phone number'
     //regex: "e.g. (123) 456 7899 (123).456.7899 (123)-456-7899 123-456-7899 123 456 7899 1234567899"   
   },
   /*vac_wedsite_url:{
     url:"Please enter a valid website address. <span class='exap-error' style='color:#000'>Example:  http://example.com</span>"
   },*/
  vac_name:{ required: "Please enter property name" },
  vac_type:{ required: "Please enter property type" },
  vac_email:{ required: "Please enter email address" },
  vac_address:{ required: "Please enter property address" },
  vac_zip_code:{ required: "Please enter zip code" },
  vac_no_of_bedroom:{ required: "Please enter number of bedrooms" },
  vac_bathroom:{ required: "Please enter number of bathrooms" },
  vac_sleep:{ required: "Please enter number of people it sleeps" },
  vac_price:{ required: "Please enter rental daily rate" },
  vac_weekly_rate:{ required: "Please enter rental weekly rate" },
  vac_location_type:{ required: "Please enter location type" },
  vac_floor_area:{ required: "Please enter floor area" },
  vac_image_data:{ required: "Please upload image" },
  vac_description:{ required: "Please enter details of your rental property" }

},
submitHandler: function(form) {
  $("#ajax_favorite_loddder").show();
     form.submit();
   }
 });
});

function phoneFormatter() {
  $('#vac_contact').on('input', function() {
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
$("input:text#vac_price").keyup(function(){
    var num = $(this).val().match(/[0-9,]*/g)[0];
    var decimalNum = $(this).val().match(/[.][0-9]*/) || "";
      if(num) {
        var wholeNum = num.match(/[0-9]/g).reverse().join("").match(/[0-9]{1,3}/g).join(",").match(/./g).reverse().join("");
        var resultNum = wholeNum + decimalNum;
        $(this).val(resultNum);
    }
    else
    {
        $(this).val(num);
    }
});
$("input:text#vac_weekly_rate").keyup(function(){
    var num = $(this).val().match(/[0-9,]*/g)[0];
    var decimalNum = $(this).val().match(/[.][0-9]*/) || "";
      if(num) {
        var wholeNum = num.match(/[0-9]/g).reverse().join("").match(/[0-9]{1,3}/g).join(",").match(/./g).reverse().join("");
        var resultNum = wholeNum + decimalNum;
        $(this).val(resultNum);
    }
    else
    {
        $(this).val(num);
    }
});
$("input:text#vac_floor_area").keyup(function(){
    var num = $(this).val().match(/[0-9,]*/g)[0];
    var decimalNum = $(this).val().match(/[.][0-9]*/) || "";
      if(num) {
        var wholeNum = num.match(/[0-9]/g).reverse().join("").match(/[0-9]{1,3}/g).join(",").match(/./g).reverse().join("");
        var resultNum = wholeNum + decimalNum;
        $(this).val(resultNum);
    }
    else
    {
        $(this).val(num);
    }
});
  </script>
