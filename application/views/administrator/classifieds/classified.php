<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
.cls_classified_ads input {
    margin-right: 35px;
    margin-left: 14px;
}

 </style>
<div class="warper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default add-user-sec">
                <div class="panel-heading"><?php if(isset($segment) && $segment == 'addclassifiedpage'){ echo'Add'; }else{
                    echo "Edit"; } ?> Classified </div>
                <div class="panel-body">
                 <div id="responseMsg"></div>
                 
                    <form class="ng-pristine ng-valid" enctype="multipart/form-data" id="addclassified" name="addclassified" method="post" action="<?php if(isset($segment) && $segment == 'addclassifiedpage'){echo base_url().'administrator/classifieds/addclassifiedpage'; }else{
                    echo base_url().'administrator/classifieds/editclassifiedpage/'.$pageID; } ?>">

                    <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Classified Title<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="classified_created_by" id="classified_created_by" class="form-control" placeholder="Enter classified title" value="<?php if(isset($classified->classified_created_by)) {echo $classified->classified_created_by; }else{echo set_value('classified_created_by'); }?>"  />
                           <label id="classified_created_by-error" class="error" for="classified_created_by"><?php echo form_error('classified_created_by');?><?php echo $this->session->flashdata('error_classified_created_by'); ?></label>
                        </div>
                      </div>
                      <div class="form-group <?php if(form_error('mata_author')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Category<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                           <select name="classified_type" id="classified_type" class="form-control">
                            <option value=""> Please select a category</option>
                            <?php if(isset($catList)){
                            
                              foreach ($catList as $lists) { ?>
                              <option value="<?php if(isset($lists->classified_cat_name)){echo $lists->classified_cat_name;} ?>" <?php if(isset($classified->classified_type)) { if ($classified->classified_type == $lists->classified_cat_name){ echo ' selected="selected"'; }  }else{ echo set_select('classified_type', $lists->classified_cat_name); } ?>>
                              <?php if(isset($lists->classified_cat_name)){echo $lists->classified_cat_name;} ?>
                                
                              </option>
                              <?php } } ?>
                            </select>
                            <label id="classified_type-error" class="error" for="classified_type"><?php echo form_error('classified_type');?></label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label"></label>
                          <div class="col-sm-8 cls_classified_ads">
                              <label for="classified_ads " >For Sale</label>
                              <input type="radio" name="classified_ads" id="for_sale" value="for_sale" onclick="show_price_classified();" <?php if(isset($classified->classified_ads)){
                                if($classified->classified_ads == "for_sale"){ echo 'checked'; }  }else{ echo set_checkbox('classified_ads', 'for_sale'); } ?>/> 
                     
                              <label for="classified_ads"> Wanted</label>
                              <input type="radio" name="classified_ads" id="wanted" value="wanted" onclick="hide_price_classified();" <?php if(isset($classified->classified_ads)){
                                if($classified->classified_ads == "wanted"){ echo 'checked'; }  }else{ echo set_checkbox('classified_ads', 'wanted'); } ?>/>  
                              <label id="classified_ads-error" class="error" for="classified_ads"><?php echo form_error('classified_ads');?></label>  
                          </div>    
                                      
                      </div>
                   
                        
                      <div id="for_Sale_item" <?php if(isset($classified->classified_ads)){  if($classified->classified_ads == "wanted"){ ?>style="display:none"<?php } } ?>>
                        <div class="form-group">
                          <label class="col-sm-3 control-label cms-label">Price ($)<span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                          <input type="text" name="classified_price" id="classified_price" class="form-control" placeholder="Enter price" value="<?php if(isset($classified->classified_price)) {echo $classified->classified_price; }else{ echo set_value('classified_price'); }?>"  />
                          <label id="classified_price-error" class="error" for="classified_price"><?php echo form_error('classified_price');?></label> 
                          </div>
                        </div>
                      </div>
                     
                      <div class="form-group">
                          <label class="col-sm-3 control-label cms-label">Location (City and State)<span class="text-danger">*</span></label>
                          <div class="col-sm-8">
                           <input type="text" name="classified_state" id="classified_state" class="form-control" placeholder="Enter location" value="<?php if(isset($classified->classified_state)) {echo $classified->classified_state; }else{echo set_value('classified_state'); }?>" />
                             <label id="classified_state-error" class="error" for="classified_state"><?php echo form_error('classified_state');?></label> 
                          </div>
                        </div>
                      <div class="form-group <?php if(form_error('classified_image')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Classified Image</label>
                        <div class="col-sm-8">
                        <span>(Hold the Ctrl key and select 10 images maximum)</span>
                        
                       <input type="file" name="userfile[]" id="classified_image" class="form-control"  multiple accept="image/gif, image/jpg, image/png, image/jpeg, image/BMP, image/TIFF, image/GIF, image/JPG, image/PNG, image/JPEG, image/bnp, image/tiff"/>
                       <input type="hidden" id="classified_image_data" name="classified_image_data" value="<?php if(isset($clsImg) && !empty($clsImg)){ echo count($clsImg); } ?>">
                       <label id="classified_image_data-error" class="error" for="classified_image_data"><?php echo form_error('classified_image_data');?></label>
                       <div class="clas_images">
                        <?php  if(isset($clsImg) && !empty($clsImg)){
                            foreach($clsImg as $clsImg) {?>
                            <div class="item_vac_image" id="cross<?php echo $clsImg->cls_img_id;?>">
                              <a class="dltBusinessImage" id="<?php echo $clsImg->cls_img_id;?>" name="<?php echo $clsImg->cls_imag;?>">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                              <div style="background-size:cover; height:80px !important; background-image:url('<?php if(isset($clsImg->cls_imag) && !empty($clsImg->cls_imag)){ echo base_url().$clsImg->cls_imag;}?>')">
                              </div>
                            </div>
                         <?php }}?>
                       </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label cms-label">Detailed Description<span class="text-danger">*</span></label>
                        <div class="col-sm-8"> 
                           <textarea cols="100" id="ckeditor"  rows="50"><?php if(isset($classified->classified_description)) { echo $classified->classified_description; }else{echo set_value('classified_description'); } ?></textarea>
                        <input type="text" name="classified_description" id="editerdata" style="width: 0;height: 0; border: 0;" >
                       <label id="classified_description-error" class="error" for="lawsContent"><?php echo form_error('classified_description');?></label>
                          
                        </div>
                      </div>
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" id="add-business-btn" value="Validate">Submit</button>
                        <button id="resetBtn" class="btn btn-info" type="button" onclick="location.href='<?php echo base_url(); ?>administrator/classifiedslist';">Cancel</button>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>       

</div>
<?php $g_key =google_mapkey(); ?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>

<script type="text/javascript">
 function show_price_classified()
{
  $('#for_Sale_item').slideDown();
  $('#classified_price').val("<?php if(isset($classified->classified_price)) {echo $classified->classified_price; }?>");
}
function hide_price_classified()
{
  $('#for_Sale_item').slideUp();
  $('#classified_price').val(0);
  
}
$(document).on('click','.dltBusinessImage',function(){

var cls_img_id = this.id;
var cls_img =   this.name;
<?php if(isset($pageID)){ ?>
var cls_id =   <?php if(isset($pageID)) {echo $pageID; } ?>;
<?php }else{ ?>
var cls_id;
<?php } ?>
//alert(garage_img);
var link_url = "<?php echo base_url(); ?>administrator/classifieds/classifiedImgUnlink?cls_img="+cls_img+"&cls_img_id="+cls_img_id+"&cls_id="+cls_id;
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
$(function() {
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
  $("#ajax_favorite_loddder").show();
     form.submit();
   }
 });
});


$('#add-business-btn').click(function(){
   var editorData = CKEDITOR.instances['ckeditor'].getData();
   var editerValue =  $('#editerdata').val(editorData); 
    
/*<?php if(isset($segment) && $segment == 'addclassifiedpage'){ ?>

$('#classified_image').rules('add', {
          required: true,
          accept: "image/jpeg, image/pjpeg",
          messages: {
             required: "The classified image field is required."
          }
});
<?php } ?>*/

});
    
$("#classified_image").on("change", function(){
    var $fileUpload = $("input[type='file']");
    $("#classified_image_data").val($fileUpload.get(0).files.length);
    if (parseInt($fileUpload.get(0).files.length)><?php if(isset($clsImg) && !empty($clsImg)){ echo 10-count($clsImg); }else{ echo 10; } ?>){
     alert("You can select only 10 images");
     this.form.reset();
    }
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
</script>
