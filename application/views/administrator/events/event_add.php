<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <style type="text/css">
     .form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
.div-image img{
    height: 100px;margin: 6px;width: 100px;
}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'addevent'){ echo 'Add Event'; }else{
                       echo 'Edit Event'; 
                    } 
                    ?></div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                    <form name="addevent" id="addevent" method="post" action="<?php if(isset($segment) && $segment == 'addevent'){ echo base_url().'administrator/events/addevent'; }else{
                     echo base_url().'administrator/events/editevent/'.$eventId; } ?>" enctype="multipart/form-data">

                     <input type="hidden" name="event_id" id="event_id" class="form-control" value="<?php if(isset($eventId)) {echo $eventId; }?>" />

                     <div class="col-md-6 form-group">

                      <label for="event_title">Event Title</label>
                      <input type="text" name="event_title" id="event_title" class="form-control" placeholder="Enter Event Title" value="<?php if(isset($eventDetail[0]->event_title)) {echo $eventDetail[0]->event_title; }else{echo set_value('event_title'); }?>"/>
                      <label id="event_title-error" class="error" for="event_title"><?php echo form_error('event_title');?></label>
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="event_venue">Event Venue Name</label>
                      <input type="text" name="event_venue" id="event_venue" class="form-control" placeholder="Enter Event place" value="<?php if(isset($eventDetail[0]->event_venue)) {echo $eventDetail[0]->event_venue; }else{echo set_value('event_venue'); }?>" />
                      <label id="event_venue-error" class="error" for="event_venue"><?php echo form_error('event_venue');?></label>

                    </div>

                    <div class="col-md-6 form-group">
                      <label for="venue_address">Venue Address</label>
                      <input type="text" name="venue_address" id="venue_address" class="form-control" placeholder="Enter Venue Address" value="<?php if(isset($eventDetail[0]->venue_address)) {echo $eventDetail[0]->venue_address; }else{echo set_value('venue_address'); }?>" />
                      <label id="venue_address-error" class="error" for="venue_address"><?php echo form_error('venue_address');?></label>

                    </div>



                    <div class="col-md-6 form-group">
                      <label for="event_date">Event Date</label>
                      <input type="text" name="event_date" id="event_date" class="form-control" placeholder="Enter Event Date" value="<?php if(isset($eventDetail[0]->event_date)) {echo $eventDetail[0]->event_date; }else{echo set_value('event_date'); }?>"/>
                      <label id="event_date-error" class="error" for="event_date"><?php echo form_error('event_date');?></label>

                    </div>
                    

                    <div class="col-md-12 form-group">
                      <label for="event_description">Event Description</label>
                      <textarea  name="event_description" id="event_description" class="form-control" placeholder="Enter event description"  ><?php if(isset($eventDetail[0]->event_description)) {echo $eventDetail[0]->event_description; }else{echo set_value('event_description'); }?></textarea>
                      <label id="event_description-error" class="error" for="event_description"><?php echo form_error('event_description');?></label>

                    </div>

                    <div class="col-md-6 form-group">
                      <label for="event_image">Upload Event Images</label>
                      <input type="hidden" name="event_image_data" id="event_image_data" class="form-control"  />
                      <input type="file" name="event_image[]" id="event_image" class="form-control" multiple accept="image/*" />
                      <label id="event_image_data-error" class="error" for="event_image_data"><?php echo form_error('event_image_data');?></label>
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="event_image">All Day Event</label>
                    
                      <input type="checkbox" name="all_day_event" id="all_day_event" class="form-control" value="1" <?php if(isset($eventDetail[0]->all_day_event)){if($eventDetail[0]->all_day_event !=0){echo "checked"; }}else{ echo set_checkbox('all_day_event', '1'); } ?>/>
                    </div>
                    <div class="col-md-3 form-group">
                      <label for="event_image">Featured Event</label>
                      <input type="checkbox" name="event_type" id="event_type" class="form-control" value="1" <?php if(isset($eventDetail[0]->event_type)){if($eventDetail[0]->event_type !=0){echo "checked"; }}else{ echo set_checkbox('event_type', '1'); } ?>/>
                    </div>
                    <div class="col-md-12 form-group">
                      <?php  if(isset($eventPhotos) && !empty($eventPhotos)){
                        foreach($eventPhotos as $eventPhotos) {?>

                        <div class="item_vac_image" id="cross<?php echo $eventPhotos->event_img_id;?>">
                          <a class="dltBusinessImage" id="<?php echo $eventPhotos->event_img_id;?>" name="<?php echo $eventPhotos->event_image_path;?>">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                          </a>
                          <div style="background-size:cover; height:80px; background-image:url('<?php if(isset($eventPhotos->event_image_path) && !empty($eventPhotos->event_image_path)){ echo base_url().$eventPhotos->event_image_path;}?>')">

                          </div>


                        </div>
                        <?php }}?>

                      </div>
                    <div class="col-md-6 form-group">
                      <label for="event_start_time">Event Start Time</label>
                      <input type="text" name="event_start_time" id="event_start_time" class="form-control" placeholder="Enter Event Start Time" value="<?php if(isset($eventDetail[0]->event_start_time)) {echo $eventDetail[0]->event_start_time; }else{echo set_value('event_start_time'); }?>"/>
                      <label id="event_start_time-error" class="error" for="event_start_time"><?php echo form_error('event_start_time');?></label>

                    </div>
                    <?php //if(isset($eventDetail[0]->all_day_event) && $eventDetail[0]->all_day_event == 1) {
                    //  echo '<div class="col-md-6 form-group" id="event_end_time_all"></div>';
                   // }else{?>
                    <div class="col-md-6 form-group" id="event_end_time_all" style="<?php if(isset($eventDetail[0]->all_day_event) && $eventDetail[0]->all_day_event == 1) {echo 'display: none'; }?>" >
                      <label for="event_end_time">Event End Time</label>
                      <input type="text" name="event_end_time" id="event_end_time" class="form-control" placeholder="Enter Event End Time"  value="<?php if(isset($eventDetail[0]->event_end_time)) {echo $eventDetail[0]->event_end_time; }else{echo set_value('event_end_time'); }?>" />
                      <label id="event_end_time-error" class="error" for="event_end_time"><?php echo form_error('event_end_time');?></label>

                    </div>
                    <?php //} ?>
                     
                      <strong class="Contact Person Details">Contact Person Details</strong>
                      <div class="boader-line-event"></div>
                      <div class="col-md-6 form-group">
                        <label for="event_image">Name</label>
                        <input type="text" name="event_contact_person_name" id="event_contact_person_name" class="form-control" placeholder="Enter contact person name"  value="<?php if(isset($eventDetail[0]->event_contact_person_name)) {echo $eventDetail[0]->event_contact_person_name; }else{echo set_value('event_contact_person_name'); }?>" />
                        <label id="event_contact_person_name-error" class="error" for="event_contact_person_name"><?php echo form_error('event_contact_person_name');?></label>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="event_image">Contact Phone </label>
                        <input type="text" name="event_contact_no" id="event_contact_no" class="form-control" placeholder="Enter contact no" maxlength="14" minlengt="14" value="<?php if(isset($eventDetail[0]->event_contact_no)) {echo $eventDetail[0]->event_contact_no; }else{echo set_value('event_contact_no'); }?>"/>
                        <label id="event_contact_no-error" class="error" for="event_contact_no"><?php echo form_error('event_contact_no');?></label>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="event_image">Email Address </label>
                        <input type="text" name="event_email_id" id="event_email_id" class="form-control" placeholder="Enter email id" value="<?php if(isset($eventDetail[0]->event_email_id)) {echo $eventDetail[0]->event_email_id; }else{echo set_value('event_email_id'); }?>" />
                        <label id="event_email_id-error" class="error" for="event_email_id"><?php echo form_error('event_email_id');?></label>
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="event_image">Web Site</label>
                        <input type="text" name="event_wed_site" id="event_wed_site" class="form-control" placeholder="Enter web site" value="<?php if(isset($eventDetail[0]->event_wed_site)) {echo $eventDetail[0]->event_wed_site; }else{echo set_value('event_wed_site'); }?>" />
                        <label id="event_wed_site-error" class="error" for="event_wed_site"><?php echo form_error('event_wed_site');?></label>
                      </div>


                      <div class="col-md-12 form-group">
                      <button type="submit" id="add-business-btn" name="submit" class="btn btn-default"><?php if(isset($segment) && $segment == 'addevent'){ echo 'Submit'; }else{ echo 'Update'; } ?> </button>
                      <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/eventslist';">Cancel</button>
                    </div>

                    </form>                    
                
                </div>
            </div>
        </div>
    </div>       

</div>
<?php $g_key =google_mapkey(); ?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/wickedpicker.min.css">
<script src="<?php echo base_url(); ?>assets/js/wickedpicker.min.js"></script>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
 $('#all_day_event').change(function() {
        if($(this).is(":checked")) {
          $('#event_end_time_all').hide();
        }else{
          $('#event_end_time_all').show();
        }
             
    });
 
  ///********************Bootstrap FROM_TO calendar Script*//////////////
/*******************/
$("#event_image").on("change", function(){

    var $fileUpload = $("input[type='file']");
    $('#event_image_data').val($fileUpload.get(0).files.length);
    if (parseInt($fileUpload.get(0).files.length)><?php if(isset($clsImg) && !empty($clsImg)){ echo 10-count($clsImg); } else{ echo 10; } ?>){
     alert("You can select only 10 images");
     this.form.reset();
    }
});
$(function() {
var date = new Date();
date.setDate(date.getDate()); 
$("#event_date").datepicker({
dateFormat: "yy-mm-dd",
onSelect: function(selected) {  
 var date1 = $('#event_date').datepicker('getDate', '+1d'); 
 date1.setDate(date1.getDate()+1);
},
minDate: 0,
autoclose: true,

});

$('#event_end_time').timepicker();
$('#event_start_time').timepicker();
/*$('#event_start_time').wickedpicker({now: $('#event_start_time').val("<?php if(isset($eventDetail[0]->event_start_time)) {echo $eventDetail[0]->event_start_time; }?>")});
$('#event_end_time').wickedpicker(); */
});    
google.maps.event.addDomListener(window, 'load', function () {


var business_address = new google.maps.places.Autocomplete(document.getElementById('venue_address'));

var places = [ business_address ];
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



 $('#add-business-btn').submit(function() {
       $("#ajax_favorite_loddder").show();
        return true;
    }); 
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

var event_id = this.id;
var event_img =   this.name;
//alert(garage_img);
var link_url = "<?php echo base_url(); ?>administrator/admin/eventImgUnlink?event_img="+event_img+"&event_id="+event_id;
    //alert(link_url);
if (confirm('Do you want to remove this image?'))
  {
  $.ajax({
      url: link_url,
      success: function(data) {
           var myobj = eval('('+data+')');
           if(myobj.a == 1)
           {
              $( "#cross"+event_id).remove();
              //location.reload();
           }
          }
  });
    return false;
  }else {
     return true;
  }

});
function phoneFormatter() {
  $('#event_contact_no').on('input', function() {
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



  </script>
