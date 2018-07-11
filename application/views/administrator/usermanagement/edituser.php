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
#ajax_favorite_loddder {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:rgba(255, 255, 255, 0.5);
    z-index: 9999999;
}
#ajax_favorite_loddder img {
    top: 42vh;
    left: 0;
    position: absolute;
    right: 0;
    margin: 0 auto;
    max-width: 120px;
    z-index: 9999999;
}
 </style>
<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading"><?php if(isset($segment) && $segment == 'useredit') { echo 'Update';
        }else if(isset($segment) && $segment == 'adduser'){echo 'Add';}else{echo 'Update';} ?> Profile</div>
        <div class="panel-body">
          <div id="responseMsg"></div>
          <form name="personalDetails" id="personalDetails" method="post" enctype="multipart/form-data">
              <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php if(isset($userID)) {echo $userID; }?>" />
              <div class="row">
              <div class="col-md-6 form-group">
                <label for="fname">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($userDetail->username)){echo $userDetail->username; } ?>" />
                    <label id="Username-error" class="error" for="Username"><?php echo form_error('Username');?></label>
              </div>
               <div class="col-md-6 form-group">
                  <label for="fname">First Name</label>
                  <input type="text" name="fname" id="fname" value="<?php if(isset($userDetail->fname)){echo $userDetail->fname; } ?>" placeholder="Enter First Name" class="form-control">
                  <label id="vac_contact-error" class="error" for="vac_contact"><?php echo form_error('vac_contact');?></label>                     
              </div>

              <div class="col-md-6 form-group">
                  <label for="lname">Last Name</label>
                   <input type="text" name="lname" id="lname" value="<?php if(isset($userDetail->lname)){echo $userDetail->lname; } ?>" placeholder="Enter Last Name" class="form-control">
                    <label id="lname-error" class="error" for="lname"><?php echo form_error('lname');?></label>
              </div>
              
                <?php if(isset($basesegment) && $basesegment != 'updateprofile') { ?>
              <div class="col-md-6 form-group">
                  <label for="lname">Role </label>
                  <?php if($userDetail->user_id != 1) { ?>
                  <select name="roles" id="roles" class="form-control">
                      <option value="">Select Role</option>
                      <?php if(isset($roleList)){
                        foreach ($roleList as $roleList) { 
                          if(isset($userID)){
                            $query = $this->db->query("select * from tbl_user_assign_permission where role_id = ".$roleList->role_id." and user_id=".$userID."");
                            $result = $query->result();
                          }
                          ?>
                      <option value="<?php if(isset($roleList->role_id)){echo $roleList->role_id;}?>" <?php if(isset($result[0]->role_id)) {if($result[0]->role_id == $roleList->role_id){echo 'selected';}} ?> ><?php if(isset($roleList->role_name)){echo $roleList->role_name;}?></option>
                      <?php } } ?>
                  </select>
                  <label id="roles-error" class="error" for="roles"><?php echo form_error('roles');?></label>

                  <?php }else{ ?>
                  <span class="form-control" style="background-color: #eee;cursor: no-drop;">Admin</span>
                 <?php }?>
                  
              </div>
              <?php } ?>
              <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php if(isset($userDetail->email)){echo $userDetail->email; } ?>" placeholder="Enter email" class="form-control">
                <label id="email-error" class="error" for="email"><?php echo form_error('email');?></label>                     
              </div>
              <?php if($this->uri->segment(2) == 'adduser'){ ?>
              <div class="col-md-6 form-group">
                <label for="email">Password</label>
                <input type="password" name="password" id="password" value="" placeholder="Enter Password" class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label for="email">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" value="" placeholder="Enter Confirm Password" class="form-control">
              </div>
              <?php } ?>
              
                <div class="col-md-6 form-group">
                  <label for="dob">Date of Birth</label>
                  <input type="text" name="dob" id="dob" value="<?php if(isset($userDetail->dob)){echo $userDetail->dob; } ?>" placeholder="Enter Date of Birth" class="form-control" >
                  <label id="dob-error" class="error" for="dob"><?php echo form_error('dob');?></label>
               </div>
              <div class="col-md-6 form-group">
                  <div class="gender-cls">
                  <label>Sex</label><br/>
                  <span class="male-g">Male <input type="radio" name="gender" id="gender" value="male" <?php if(isset($userDetail->gender)){?><?php echo ($userDetail->gender =='male')?'checked':'' ?> <?php } ?>></span>
                  <span class="female-g">
                   Female <input type="radio" name="gender" id="gender" value="female"<?php if(isset($userDetail->gender)){?><?php echo ($userDetail->gender =='female')?'checked':'' ?> <?php } ?> ></span>
                  </div>
                  <label id="gender-error" class="error" for="gender"><?php echo form_error('gender');?></label>
               </div>
                
              
               <div class="col-md-6 form-group">
                  <label for="contact_no">Phone Number</label>
                 <input type="text" name="contact_no" id="contact_no" value="<?php if(isset($userDetail->contact_no)){echo $userDetail->contact_no; } ?>" maxlength="14" minlengt="14" placeholder="Enter Phone Number"  class="form-control" >
                  <label id="contact_no-error" class="error" for="contact_no"><?php echo form_error('contact_no');?></label>
              </div>
               <div class="col-md-6 form-group">
                  <label for="address">Address</label>
                 <input type="text" name="address" id="address" value="<?php if(isset($userDetail->address)){echo $userDetail->address; } ?>" placeholder="Enter Address" class="form-control">
                  <label id="address-error" class="error" for="address"><?php echo form_error('address');?></label>                     
              </div>
              <div class="col-md-6 form-group">
                  <label for="address">Occupation</label>
                 <input type="text" name="occupation" id="occupation" value="<?php if(isset($userDetail->occupation)){echo $userDetail->occupation; } ?>" placeholder="Enter Occupation" class="form-control">
                  <label id="occupation-error" class="error" for="occupation"><?php echo form_error('occupation');?></label>                     
              </div>
              </div>
              
              
                <div class="row">
                  <div class="col-md-6 form-group">
                  <label for="vac_imag">Upload Profile Image</label>
                  <label class="upl-label-file" style="width: 100%;">
                    <input type="file" name="pro_image" id="pro_image" class="form-control" multiple accept="image/*"  />
                  </label>
                  
                  <div class="col-md-12 form-group">
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
                      
                        <img src="<?php echo $img; ?>" id="pro-image-up" width="100" height="100">
                  </div>
               </div>
               
               
              <div class="row1">
              <div class="col-sm-12">
              <button id="add-business-btn" name="submit" class="btn btn-default">
        <?php if(isset($segment) && $segment == 'useredit') { echo 'Update';
        }else if(isset($segment) && $segment == 'adduser'){echo 'Submit'; }else{echo 'Update';} ?>

              </button>  
             
            </form>      
        </div>
      </div>
    </div>
  </div>
</div>
<div id="ajax_favorite_loddder" style="display:none;">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
</div>

<!-- Load jQuery UI Main JS  -->
<?php $g_key =google_mapkey(); ?>
<link href="<?php echo base_url()?>assets/css/datepicker.min.css" rel="stylesheet"/>
<script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>&sensor=false&libraries=places"></script>

<script type="text/javascript">
 

function addressAndzipcode() {
  var input = document.getElementById('address');
  var options = {
    types: ['address'],
    componentRestrictions: {
      country: 'us'
    }
  };
  autocomplete = new google.maps.places.Autocomplete(input, options);
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    //document.getElementById('pro_add_lat').value = place.geometry.location.lat();
   // document.getElementById('pro_add_lng').value = place.geometry.location.lng();
    for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        
      }
    }
  })
}
google.maps.event.addDomListener(window, "load", addressAndzipcode);

 $(document).ready(function(){
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
$('#dob').datepicker({
            format: "dd/mm/yyyy"
 });

$("#personalDetails").validate({
    
        // Specify the validation rules
        rules: {
            fname: "required",
            lname: "required",
            <?php if($userDetail->profile_picture != 1){ ?>
            roles: "required",
            <?php } ?>
            email: {
                required: true,
                <?php if(isset($segment) && $segment == 'useredit') { ?>
                <?php }else if(isset($segment) && $segment == 'adduser'){ ?>
                remote: {
                    url: "<?php echo base_url(); ?>administrator/admin/register_email_exists",
                    type: "post"
                }, 
                <?php } ?>
                 email: true
            }<?php if($this->uri->segment(2) == 'adduser'){ ?>,
            password: {
            required: true,                     
            minlength:6
            },
            cpassword : {
            required: true,
            minlength:6,
            equalTo : "#password"
            }
            <?php } ?>
        },
        
        // Specify the validation error messages
        messages: {
            fname: "Please enter first name",
            lname: "Please enter last name",
            roles: "Please enter role",
            email: {
            required: 'Please enter your Email Address',
            <?php if(isset($segment) && $segment == 'useredit') { ?>
            <?php }else if(isset($segment) && $segment == 'adduser'){ ?>
            remote: 'Email already used.', 
            <?php } ?>
            email: 'Please enter a valid email address'
            } <?php if($this->uri->segment(2) == 'adduser'){ ?>,
            password: {
            required: "Please enter Password",
            equalTo :  "Password do not match "
            },
            cpassword: {
                required: "Please enter Confirm Password"
            },<?php } ?>
          
        },
        
        submitHandler: function(form) {
       // $('#add-business-btn').prop('disabled', true);
        var formData = new FormData();
        formData.append('pro_image', $('#pro_image')[0].files[0]);
        var frmdata = $(personalDetails).serializeArray();
        $.each(frmdata, function (key, input) {
        formData.append(input.name, input.value);
        });
        var URL;
        <?php if(isset($segment) && $segment == 'useredit') { ?>
           URL= "<?php echo base_url(); ?>administrator/admin/editPersonalDatail";
        <?php }else if(isset($segment) && $segment == 'adduser'){ ?>
           URL = "<?php echo base_url(); ?>administrator/admin/addPersonalDatail";
        <?php }else{?>
           URL= "<?php echo base_url(); ?>administrator/admin/Editprofile";
        <?php } ?>
        $("#ajax_favorite_loddder").show();
        $.ajax({
        type: 'POST',
        url: URL,
        data:formData,
       // enctype: 'multipart/form-data',
        dataType:'json',
        processData: false,
        contentType: false,
       
        success: function(data){
           if(data ==1){
            <?php if(isset($segment) && $segment == 'useredit') { ?>
                $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> User Update Successfully </div>').show().fadeOut(10000);
                  window.location.replace("<?php echo base_url(); ?>administrator/users");
            <?php }else if(isset($segment) && $segment == 'adduser'){ ?>
                $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> User Add Successfully </div>').show().fadeOut(10000);
                  window.location.replace("<?php echo base_url(); ?>administrator/users");
            <?php }else{?>
                $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong>Update Profile Successfully </div>').show().fadeOut(10000);
            <?php } ?>
            $("#ajax_favorite_loddder").hide();
           }
          }
       });

        return false;
            }
        });




});


</script>
<script>


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
