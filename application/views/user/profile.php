<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
 .go-dash {
  font-size: 11px;
  margin-top: 0;
  text-align: left;
}
.pro-fname button#pro-cancel {
    background: #387fcc none repeat scroll 0 0;
    border: medium none;
    color: #fff;
    display: block;
    height: 36px;
    /*margin: 0 auto;*/
    min-width: 120px;
}
label.error {
    bottom: -25px;
    left: 0;
    position: initial !important;
    width: 100%;
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
      <div class="pms-bg" style="background-color: #fff !important;">
        <div class="row">
          <div class="col-md-9 col-sm-8 no-paddng">
            <div class="pro-pic-detail-sec">
            <h6 class="go-dash"><a href="<?php echo base_url().'user/dashboard'; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>go to dashboard</a></h6>

              <div class="row">
                <div class="col-sm-4">
                  <div class="m-pro-pic">
                      <div class="pro-image">
                      <?php 
                      if(isset($userDetail->profile_picture) && !empty($userDetail->profile_picture)){ 

                      if(strpos($userDetail->profile_picture, "http://") !== false OR strpos($userDetail->profile_picture, "https://") !== false){
                        $img = $userDetail->profile_picture;
                      }else
                      {
                        $img = base_url().$userDetail->profile_picture;
                      }

                      }
                      else
                      { 
                      $img =  base_url().'assets/images/default.png';}

                      ?>
                      
                        <img src="<?php echo $img; ?>" id="pro-image-up">

                        <div class="pro-fname">
                          <label class="main-file-input">
                          <form id="uploadimgfrm" name="uploadimgfrm" method="post" enctype="multipart/form-data">
                              <input type="file" name="pro_image" id="pro_image" value="<?php if(isset($userDetail->profile_picture)){echo $userDetail->profile_picture; } ?>" >
                          </form>
                          </label>
                        </div>
                      </div>      .

                      <div class="pro-name">
                        <h3 id="name-head"><?php if(isset($userDetail->fname)){echo $userDetail->fname; } ?> <?php if(isset($userDetail->lname)){echo $userDetail->lname; } ?> </h3>                        
                      </div>                
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="pro-details">
                    <span id="fname-pro"><i class="fa fa-user"></i> <?php if(isset($userDetail->fname)){echo $userDetail->fname; } ?> <?php if(isset($userDetail->lname)){echo $userDetail->lname; } ?></span>
                    <span id="mail-pro"><i class="fa fa-envelope" aria-hidden="true"></i> <?php if(isset($userDetail->email)){echo $userDetail->email; } ?></span>
                    <span id="address-pro"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php if(isset($userDetail->address)){echo $userDetail->address; } ?></span>
                    <span id="mail-pro"><i class="fa fa-user" aria-hidden="true"></i> <?php if(isset($userDetail->gender)){echo $userDetail->gender; } ?></span>
                    <span id="mail-pro"><i class="fa fa-calendar" aria-hidden="true"></i> <?php if(isset($userDetail->dob)){echo $userDetail->dob; } ?></span>
                    <span id="mail-pro"><i class="fa fa-phone-square" aria-hidden="true"></i> <?php if(isset($userDetail->contact_no)){echo $userDetail->contact_no; } ?></span>
                      <span id="mail-pro"><i class="fa fa-align-justify" aria-hidden="true"></i> <?php if(isset($userDetail->occupation)){echo $userDetail->occupation; } ?></span>
                      <span>
                        <div class="pro-name edit">
                          <button id="edit-pro-btn"><i class="fa fa-edit"></i> Edit Profile</button>                        
                        </div>
                      </span>
                  </div>
                </div>
              </div>

              <div class="personal-dtl" id="pro-detail-edit" style="display:none;">
              <h3>Profile Edit</h3>
               <div class="alert alert-success" id="responsMsg" style="display:none;">
               Your Profile update successfully
               </div>
                    <form id="personalDetails" name="personalDetails" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>First Name:</label> <input type="text" name="fname" id="fname" value="<?php if(isset($userDetail->fname)){echo $userDetail->fname; } ?>" placeholder="Enter First Name">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>Last Name:</label> <input type="text" name="lname" id="lname" value="<?php if(isset($userDetail->lname)){echo $userDetail->lname; } ?>" placeholder="Enter Last Name">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="pro-fname">
                        <div class="gender-cls">
                          <label>Sex:</label><span class="male-g">Male<input type="radio" name="gender" id="gender" value="male" <?php echo ($userDetail->gender =='male')?'checked':'' ?>></span>
                          <span class="female-g">
                           Female<input type="radio" name="gender" id="gender" value="female" <?php echo ($userDetail->gender =='female')?'checked':'' ?>></span>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>Date of Birth:</label> <input type="text" name="dob" id="dob" value="<?php if(isset($userDetail->dob)){echo $userDetail->dob; } ?>" placeholder="Enter Date of Birth">
                         
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>Phone Number:</label> <input type="text" name="contact_no" id="contact_no" value="<?php if(isset($userDetail->contact_no)){echo $userDetail->contact_no; } ?>" maxlength="14" minlengt="14" placeholder="Enter Phone Number">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>Address:</label> <input type="text" name="address" id="address" value="<?php if(isset($userDetail->address)){echo $userDetail->address; } ?>" placeholder="Enter Address">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-sm-4">
                        <div class="pro-fname">
                          <label>Occupation:</label> <input type="text" name="occupation" id="occupation" value="<?php if(isset($userDetail->occupation)){echo $userDetail->occupation; } ?>" placeholder="Enter Occupation">
                        </div>
                      </div>                      
                    </div>
                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pro-fname">
                          <button id="pro-submit">Update</button>
                        </div>      
                      </div>
                    </div>
                       
                    
                  </form>

                        <div class="pro-fname cancl-btn">
                          <button id="pro-cancel"><i class="fa fa-close"></i></button>
                        </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4 no-paddng">
            <div class="advertise-class">
            <div class="google-ad" style="width: 100%  !important;">
             <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Profile'));
            ?>
            <style>
            .example_responsive_1 { width: 100% !important; height: 600px !important; }
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
            <!-- <div class="chng-pass-sec">
              <div class="cps-head">

                <h3>Change Password</h3>
              </div>
              <div id="msgchangepass"></div>
              <div class="cps-form">
               <form name="dochangepassword" id="dochangepassword" method="post" action="<?php echo base_url(); ?>user/changepassword">
                  <label for="current_password">Old Password</label>
                 <input type="password" name="current_password" id="current_password" class="form-control"  required/>
                
            
              <div class="form-group">
                  <label for="first_password">New Password</label>
                    <input type="password" title="Please enter password" name="first_password" id="first_password" class="form-control" onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.second_password.pattern = this.value; " required />
                       
              </div>

              <div class="form-group">
                  <label for="second_password">Confirm Password</label>
                   <input type="password" title="Please enter the same Password as above" onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); " name="second_password" id="second_password" class="form-control" required/>
                     
              </div>
             
              <button type="submit" id="chng-pswd-btn" name="chng-pswd-btn" class="btn btn-default">
              Change Password</button>
              
           </form>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
    
<footer class="main_footer">
   <?php $this->load->view('include/main_footer'); ?>
      <?php $g_key =google_mapkey(); ?>
<script src="http://maps.googleapis.com/maps/api/js?key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&amp;libraries=places" type="text/javascript"></script> 
 <script type="text/javascript">
function initialize() {
	autocomplete = new google.maps.places.Autocomplete(
	(document.getElementById('address')),
	{types: ['geocode'], componentRestrictions: {country: 'us'}});
	autocomplete.addListener('place_changed', fillInAddress);
}                         
google.maps.event.addDomListener(window, 'load', initialize);

</script>
<script type="text/javascript">
  $(document).ready(function(){

        $("#edit-pro-btn").click(function(e) {
              $("#pro-detail-edit").slideDown();
        });

        $("#pro-cancel").click(function(e) {
              $("#pro-detail-edit").slideUp();
        });  
        $('#dob').datepicker({
            format: "dd/mm/yyyy"
        });


});

</script>
<script type="text/javascript">
// assumes you're using jQuery
$(document).ready(function() {
$('#msgchangepass').hide();
<?php if($this->session->flashdata('msg_error')){ ?>
  
  $('#msgchangepass').html('<div class="alert alert-danger"><?php echo $this->session->flashdata('msg_error') ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('msg_success')){ ?>
  $('#msgchangepass').html('<div class="alert alert-success"><?php echo $this->session->flashdata('msg_success') ?> </div>').show().fadeOut(5000);
<?php } ?>

});

$(function() {
  
    // Setup form validation on the #change password-form element
    $("#dochangepassword").validate({
    
        // Specify the validation rules
        rules: {
            current_password: "required",
            first_password: "required",
            second_password: {
            required: true,
            equalTo: "#first_password"
            }
        },
        
        // Specify the validation error messages
        messages: {
            current_password: "Please enter old password",
            first_password: "Please enter new password",
           // second_password: "Please enter confirm password"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Setup form validation on the #edit profile-form element
    $("#personalDetails").validate({
    
        // Specify the validation rules
        rules: {
            fname: "required",
            lname: "required"
            //address: "required",
            //gender: "required",
            //dob: "required",
            //contact_no: "required",
            //occupation: "required",
           
        },
        
        // Specify the validation error messages
        messages: {
            fname: "Please enter first name",
            lname: "Please enter last name"
            //address: "Please enter address",
            //gender: "Please enter gender",
            //dob: "Please enter dob",
            //contact_no: "Please enter contact no",
            //occupation: "Please enter occupation",
        },
        
        submitHandler: function(form) {
        var formData = new FormData();
       // formData.append('pro_image', $('#pro_image')[0].files[0]);
        var frmdata = $(personalDetails).serializeArray();
        $.each(frmdata, function (key, input) {
        formData.append(input.name, input.value);
        });

        $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>user/editPersonalDatail",
        data:formData,
       // enctype: 'multipart/form-data',
        dataType:'json',
        processData: false,
        contentType: false,
       
        success: function(data){

          //alert(data.fname);
              $('#name-head').html(data.fname+' '+data.lname);
              $('#fname-pro').html('<i class="fa fa-user"></i> '+data.fname+' '+data.lname);
              $('#country-pro').html('<i class="fa fa-map-marker" aria-hidden="true"></i> '+data.country);
              //$('#pro-image-up').attr('src',data.profile_picture);
              $('#responsMsg').show().fadeOut(5000);

          }
       });

        return false;
            }
        });

  });
$("#pro_image").on('change', function () {
        var formData = new FormData();

        formData.append('pro_image', $('#pro_image')[0].files[0]);

        var frmdata = $(uploadimgfrm).serializeArray();
        $.each(frmdata, function (key, input) {
        formData.append(input.name, input.value);
        });
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>user/profile_img_upload',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data){ 
             // alert(1);
               location.reload();
            }

        });
 });
function phoneFormatter() {
  $('#contact_no').on('input', function() {
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
</footer>
<div class="copy-right">
<?php $this->load->view('include/copyright'); ?>
</div>

</body>
</html>
 