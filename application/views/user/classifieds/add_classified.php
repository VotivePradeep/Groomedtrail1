<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
/* progress bar */
#progress-wrp {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #387ec9;
    border-radius: 3px;
    box-shadow: 1px 3px 6px rgba(0, 0, 0, 0.12) inset;
    height: 26px;
    padding: 2px;
    position: fixed;
    top: 42vh;
    left: 0;
    right: 0;
    max-width: 500px;
    margin: 0 auto;
    text-align: left;
    width: 100%;
}
#progress-wrp .progress-bar {
    height: 20px;
    border-radius: 3px;
    background-color: #387fcc;
    width: 0;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
#progress-wrp .status{
    top:2px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}
#progress_bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.5);
    z-index: 9999999;
    display: none;
}
#progress-wrp .progress-bar-striped {
    background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;   
}
.thumbnail 
    {
        width: 100px ;
        height: 100px ;
    }
  #result{
      display: block;
  }
  #result1{
      display: block;
  }
.previewImage {
    position: relative;
    margin-left: 10px;
    float: left;
}
.previewImage .removeimg{
    background-color: #fb665e;
    color: #fff;
    font-size: 11px;
    font-weight: bold;
    height: 20px !important;
    line-height: 20px;
    position: absolute !important;
    right: 0;
    text-align: center;
    top: 0;
    width: 20px !important;
    z-index: 2147483647;
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
                  <h3>Add Classified</h3>
                  <form name="addclassified" id="addclassified" method="post"  enctype="multipart/form-data">
                 <!--  <form name="addclassified" id="addclassified" method="post" action="<?php //if(isset($segment) && $segment == 'addclassified'){// echo base_url().'user/addclassified'; }else{ //echo base_url().'user/editclassified/'.$pageID; }?>" enctype="multipart/form-data"> -->
                    <div class="row">
                       <div class="col-md-6 form-group">
                        <label for="vac_bus_logo">Classified Title</label>
                          <input type="text" name="classified_created_by" id="classified_created_by" class="form-control" placeholder="Enter classified title" value="<?php if(isset($classified->classified_created_by)) {echo $classified->classified_created_by; }else{echo set_value('classified_created_by'); }?>"  />
                           <input type="hidden" name="classified_id" id="classified_id" class="form-control"  value="<?php if(isset($pageID)) {echo $pageID; }?>"  />
                          <label id="classified_created_by-error" class="error" for="classified_created_by"><?php echo form_error('classified_created_by');?></label>                           
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="classified_type">Category</label>
                        <select name="classified_type" id="classified_type" class="form-control">
                          <option value="">
                            Please select a category
                          </option>
                            <?php if(isset($catList)){
                            foreach ($catList as $lists) { ?>
                          <option value="<?php if(isset($lists->classified_cat_name)){echo $lists->classified_cat_name;} ?>"<?php if(isset($classified->classified_type)) { if ($classified->classified_type == $lists->classified_cat_name){ echo ' selected="selected"'; }  }else{ echo set_select('classified_type', $lists->classified_cat_name); } ?>>
                            <?php if(isset($lists->classified_cat_name)){echo $lists->classified_cat_name;} ?>
                          </option>
                          <?php } } ?>
                        </select>
                        <label id="classified_type-error" class="error" for="classified_type"><?php echo form_error('classified_type');?></label>                           
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label for="vac_bus_logo">Item Image</label>
                        <span>(Hold the Ctrl key and select 10 images maximum)</span>
                          <label class="upl-label-file">
                            <input type="file" name="userfile[]" id="classified_image" class="form-control"  multiple  accept="image/*" />
                          </label>
                          <input type="text" id="classified_image_data" name="classified_image_data" value="<?php if(isset($clsImg) && !empty($clsImg)){ echo count($clsImg); } ?>" style="width:0;height: 0;border:none">
                           <label id="classified_image_data-error" class="error" for="classified_image_data"><?php echo form_error('classified_image_data');?></label>
                      </div>
                      <div class="col-md-6 form-group">
                          <div class="classified_ads">
                              <label for="classified_ads">For Sale</label>
                              <input type="radio" name="classified_ads" id="for_sale" value="for_sale" onclick="show_price_classified();" <?php if(isset($classified->classified_ads)){
                                if($classified->classified_ads == "for_sale"){ echo 'checked'; }  }else{ echo set_checkbox('classified_ads', 'for_sale'); } ?>/> 
                          </div>
                          <div class="classified_ads">

                              <label for="classified_ads"> Wanted</label>
                              <input type="radio" name="classified_ads" id="wanted" value="wanted" onclick="hide_price_classified();" <?php if(isset($classified->classified_ads)){
                                if($classified->classified_ads == "wanted"){ echo 'checked'; }  }else{ echo set_checkbox('classified_ads', 'wanted'); } ?>/>  
                          </div>    
                          <label id="classified_ads-error" class="error" for="classified_ads"><?php echo form_error('classified_ads');?></label>              
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                       <?php  if(isset($clsImg) && !empty($clsImg)){ ?>
                        <div id="result1" >
                           
                             <?php foreach($clsImg as $clsImgItem) {?>
                            <div class="previewImage" id="cross<?php echo $clsImgItem->cls_img_id;?>">
                              <a class="removeimg" id="<?php echo $clsImgItem->cls_img_id;?>" name="<?php echo $clsImgItem->cls_imag;?>">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                              <img name='img["<?php echo $clsImgItem->cls_img_id;?>"]' class='thumbnail' src='<?php if(isset($clsImgItem->cls_imag) && !empty($clsImgItem->cls_imag)){ echo base_url().$clsImgItem->cls_imag;}?>' style='width:100px;height:100px;'/>
                             
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div  id="result" >
                        </div>
                      </div>
                      </div>
                    <div class="row">
                     <div class="col-md-6 form-group">
                            <label for="vac_bus_logo">Location (City and State)</label>
                             <input type="text" name="classified_state" id="classified_state" class="form-control" placeholder="Enter location" value="<?php if(isset($classified->classified_state)) {echo $classified->classified_state; }else{ echo set_value('classified_state'); }?>" />
                             <label id="classified_state-error" class="error" for="classified_state"><?php echo form_error('classified_state');?></label>
                      </div>  
                             
                      <div class="col-md-6 form-group" id="for_Sale_item" <?php if(isset($classified->classified_ads)){  if($classified->classified_ads == "wanted"){ ?>style="display:none"<?php } } ?>>
                        <label for="vac_bus_logo">Price ($)</label>
                            <input type="text" name="classified_price" id="classified_price" class="form-control" placeholder="Enter price" value="<?php if(isset($classified->classified_price)) {echo $classified->classified_price; }else{ echo set_value('classified_price'); }?>"  />
                            <label id="classified_price-error" class="error" for="classified_price"><?php echo form_error('classified_price');?></label>
                      </div>
                    </div>
                    
                      <div class="row">
                      <div class="col-md-12 form-group">
                          <label for="vac_description">Detailed Description</label>
                            <textarea  name="classified_description" id="classified_description" class="form-control" placeholder="Enter classified detailed description"  ><?php if(isset($classified->classified_description)) {echo $classified->classified_description; }else{echo set_value('classified_description'); }?></textarea>
                            <label id="classified_description-error" class="error" for="classified_description"><?php echo form_error('classified_description');?></label>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-sm-12">                 
                          <button type="submit" id="add-business-btn" name="submit" class="btn btn-default __web-inspector-hide-shortcut__">Submit</button>

                          <a id="add-business-btn" onclick="window.location.href='<?php echo base_url().'user/classifiedslist'; ?>'" class="btn cancel_btn  __web-inspector-hide-shortcut__">Cancel</a>
                         <div id="progress_bg"> 
                              <div id="progress-wrp">
                                  <div class="progress-bar progress-bar-striped"></div ><div class="status">0%</div>
                              </div>
                         </div>
                        </div>
                      </div>
                    </form>
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
<?php $g_key =google_mapkey(); ?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>
<script type="text/javascript">


$("#classified_image").change(function () {
if (typeof (FileReader) != "undefined") {
var dvPreview = $("#result");
    dvPreview.html("");
    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
     var random = Math.floor(Math.random() * 90 + 10);
    $($(this)[0].files).each(function () {
        var file = $(this);
        if (regex.test(file[0].name.toLowerCase())) {
            var reader = new FileReader();
            reader.onload = function (e) {
              var p_div = document.createElement("div");
              p_div.className = "previewImage";
              p_div.id = "cross"+random;
              p_div.innerHTML = "<img  class='thumbnail' src='" + e.target.result + "'" +
                      " style='width:100px;height:100px;'/>"; 

              dvPreview.append(p_div);
            }
            reader.readAsDataURL(file[0]);
        } else {
            alert(file[0].name + " is not a valid image file.");
            dvPreview.html("");
            return false;
        }
    });
} /*else {
    alert("This browser does not support HTML5 FileReader.");
}*/
});

</script>
<script>
 function show_price_classified()
{
  $('#for_Sale_item').slideDown();
  $('#classified_price').val("<?php if(isset($classified->classified_price)) {echo $classified->classified_price; } ?>");
}
function hide_price_classified()
{
  $('#for_Sale_item').slideUp();
  $('#classified_price').val(0);
  
}
    
    $("#classified_image").on("change", function(){
    
        var $fileUpload = $("input[type='file']");
        $("#classified_image_data").val($fileUpload.get(0).files.length);
        if (parseInt($fileUpload.get(0).files.length) > <?php if(isset($clsImg) && !empty($clsImg)){ echo 10-count($clsImg); } else{ echo 10; } ?>)
        {
         alert("You can select only 10 images");
         this.form.reset();
        }
    });

$(function() {
   var progress_bar_id = '#progress_bg';
$("#addclassified").validate({
 rules: {
 classified_created_by:{required: true },
 classified_type:{ required: true },
 classified_state:{ required: true },
 classified_price:{ required: true },
 classified_image_data:{ required: true },
 classified_description:{ required: true },
 classified_ads:{ required: true }
},
messages: {

  classified_created_by:{ required: "The Classified Title field is required." },
  classified_type:{ required: "The classified Category field is required." },
  classified_state:{ required: "The classified state field is required." },
  classified_price:{ required: "The classified price field is required." },
  classified_image_data:{ required: "The classified image field is required." },
  classified_description:{ required: "The classified description field is required." },
  classified_ads:{ required: "The classified ads field is required." }

},
submitHandler: function(form) {
 $(progress_bar_id +" .progress-bar").css("width", "0%");
 $(progress_bar_id + " .status").text("0%");
 $("#progress_bg").show();
  var formData = new FormData();
  //formData.append('it_image', $('#it_image')[0].files[0]);

  var current=0;
  $.each($("input[name^='userfile']")[0].files, function(i, file) {
    formData.append('userfile['+i+']', file);
    current++;
  });

  var frmdata = $("#addclassified").serializeArray();
  $.each(frmdata, function (key, input) {
    formData.append(input.name, input.value);
  });
  var action_url
  var vac_id = $('#classified_id').val();
  if(vac_id != '' ){
     action_url = "<?php echo base_url(); ?>user/classified_edit_submit";
  }else{
     action_url = "<?php echo base_url(); ?>user/submit_classified";
  }
  $.ajax({
    type:'POST',
    url: action_url,
    dataType: "JSON",
    data:formData,
    contentType: false,
    processData: false,
    xhr: function(){
        //upload Progress
        var xhr = $.ajaxSettings.xhr();
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', function(event) {
                var percent = 0;
                var position = event.loaded || event.position;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }
                //update progressbar
                $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                $(progress_bar_id + " .status").text(percent +"%");
            }, true);
        }
        return xhr;
    },

   /* beforeSend: function() {
    $('#ajax_favorite_loddder').show(); 
          
    },  */      
    success:function(data){
      var page_url = "<?php echo base_url(); ?>";
      window.location.href = page_url+"/user/classifiedslist";
      return false;
    } 
  }); 


  
     

     //form.submit();
   }
 });
});


  
</script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">

  ///********************Bootstrap FROM_TO calendar Script*//////////////
/*******************/

$(function() {

var date = new Date();
date.setDate(date.getDate()); 
$("#classified_start_date").datepicker({
dateFormat: "yy-mm-dd",
onSelect: function(selected) {  
 var date1 = $('#classified_start_date').datepicker('getDate', '+1d'); 
 date1.setDate(date1.getDate()+1);  

 var date2 = $('#classified_start_date').datepicker('getDate', '+1d'); 
 date2.setDate(date2.getDate()+30); 

  $("#classified_end_date").datepicker("option","minDate", date1);
  $("#classified_end_date").datepicker("option","maxDate", date2);
},
minDate: 0,
autoclose: true,

});
$("#classified_end_date").datepicker({

  dateFormat: "yy-mm-dd",
  onSelect: function(selected) {
  $("#classified_start_date").datepicker("option","maxDate", selected)
},
minDate: 0 ,
autoclose: true, 
});  



});

/*************END********************/</script>-->

<script type="text/javascript">
$(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>

});


$(document).on('click','.removeimg',function(){

var cls_img_id = this.id;
var cls_img =   this.name;
<?php if(isset($pageID)){ ?>
var cls_id =   <?php if(isset($pageID)) {echo $pageID; } ?>;
<?php }else{ ?>
var cls_id;
<?php } ?>
var link_url = "<?php echo base_url(); ?>user/classifiedImgUnlink?cls_img="+cls_img+"&cls_img_id="+cls_img_id+"&cls_id="+cls_id;
    //alert(link_url);
if (confirm('Do you want to remove this image?'))
  {
  $.ajax({
      url: link_url,
      success: function(data) {
             $( "#cross"+cls_img_id).remove();
             if(data != 0){
                $("#classified_image_data").val(data);
             }else{
                  $("#classified_image_data").val('');
             }
          }
  });
    return false;
  }else {
     return true;
  }

});
google.maps.event.addDomListener(window, 'load', function () {


var business_address = new google.maps.places.Autocomplete(document.getElementById('classified_state'));

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
$("input:text#classified_price").keyup(function(){
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
