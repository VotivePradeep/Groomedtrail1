<?php $this->load->view('include/header_css');?>
<style>

#ajax_favorite_loddder {

position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background:rgba(27, 26, 26, 0.48);
z-index: 999999999;
}
#ajax_favorite_loddder img {
    left: 0;
    margin: 0 auto;
    position: absolute;
    right: 0;
    top: 38vh;
}

.footer-wrapper {
   float: left;
   width: 100%;
   /*display: none;*/
}
#addons-modal.modal {
z-index: 999;
}
.modal-backdrop {

z-index: 998 !important;
}
.dis-none{
  display: none;
}
.dis-block{
  display: block !important;
}
</style>
<body>
<div class="wrapper">
  <section class="log-main-sec">
    <div class="map-overlay">

      <div class="cd-user-modal is-visible">
        <div class="cd-user-modal-container">
          <div class="lo-logo-dv">
            <img src="<?php echo base_url();?>assets/images/logo_new.png" class="logo-cls">
            <!-- <ul class="cd-switcher">
              <li><a href="#0" class="selected">Change</a></li>
              <li><a href="#0">New account</a></li>
            </ul> -->
          </div>
          <div id="cd-login" class="is-selected">
            <div class="form-dv" id="login-frm-div">
            <h3>Choose your new password</h3>
            <div id="responsmsg"></div>
              <form id="user_change_password" name="user_change_password" class="cd-form" method="post">
                <div class="error" id="logerror"></div>
                <p class="fieldset">
                   <input type="hidden" class="form-control" name="userid" id="userid" value="<?php echo $this->uri->segment(2); ?>"  >
                  <label class="image-replace cd-password" for="signin-email">Password</label>
                  <input class="full-width has-padding has-border" name="password" id="password" type="password" placeholder="Password">
                </p>

                <p class="fieldset">
                  <label class="image-replace cd-password" for="signin-password">>Confirm Password</label>
                  <input class="full-width has-padding has-border" name="cpassword" id="cpassword" type="password"  placeholder="Confirm Password">
                   <input type="hidden" name="forgot_url" id="forgot_url" value="<?php echo base_url()?>" />

                </p>
              
                <p class="fieldset">
                  <button type="submit" class="btn btn btn-primary">Submit</button>
                </p>
              </form>
            </div>
          </div>

     
               
        </div>
      </div>
    </div>
        
  </section>
</div>

<div class="copy-right">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="c-right">© 2017 GroomedTrail All Rights reserved.</div>
      </div>
      <div class="col-sm-6">
        <div class="social-nav">
          <ul>
            <?php $social_setting = my_social_footer(); ?>
          <li><a href="<?php if(isset($social_setting[0]['facebook'])){ echo $social_setting[0]['facebook'];}?>"><i class="fa fa-facebook"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['linkedin'])){ echo $social_setting[0]['linkedin'];}?>"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['twitter'])){ echo $social_setting[0]['twitter'];}?>"><i class="fa fa-twitter"></i></a></li>
          <li><a href="<?php if(isset($social_setting[0]['google'])){ echo $social_setting[0]['google'];}?>"><i class="fa fa-google-plus"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="ajax_favorite_loddder" class="dis-none">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/custom.js"></script> 
<script src="<?php echo base_url()?>assets/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<!--<script  type="text/javascript" src="http://www.tutorialrepublic.com/examples/js/typeahead.min.js"></script>--> 

<script src="<?php echo base_url()?>assets/js/main.js"></script> 
<script src="<?php echo base_url()?>assets/js/lightslider.min.js"></script> 
<script type="text/javascript">
 var flag=false;
 // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      getUserInfo();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      /*document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';*/
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  
  // Load the SDK asynchronously

  window.fbAsyncInit = function() {
    <?php 
    $resultFb = facebook_credential();
   ?>
    FB.init({
      appId      : '<?php if(isset($resultFb[0]->oauth_key)){echo $resultFb[0]->oauth_key;}?>', //1068492099877422 App ID (1776946472525281)
    // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
      version    : 'v2.8'
    });
        
  FB.Event.subscribe('auth.authResponseChange', function(response) 
  {
   if (response.status === 'connected') 
      {
      console.log("Connected to Facebook");      //SUCCESS      
    }  
  else if (response.status === 'not_authorized') 
    {
      console.log("Failed to Connect");

    //FAILED
    } else 
    {
    console.log("Logged Out");      //UNKNOWN ERROR
    }
  });   
  };
  function Login()
  {
    //alert(1)
     FB.login(function(response) {
       if (response.authResponse) 
       {
          getUserInfo();
        } else 
        {
           console.log('User cancelled login or did not fully authorize.');
        }
     }, {scope: 'email,user_birthday,user_location'});
  
  }

  function getUserInfo() {//alert(1)
      
      FB.api('/me',{fields: 'id,email,name,picture.width(800).height(800),gender,location,birthday'}, function(response) {
  
       console.log(response); 
     
            $.ajax({
            method: "POST",
            url: "<?php echo base_url();?>ajax/fblogin",
            dataType: 'json',
            data: {'id':response.id,'name':response.name,'email': response.email, 'picture': response.picture.data.url, 'gender': response.gender,
                    'birthday':response.birthday,'education': response.education,'location': response.location},
            success:function(data){
               if(data.flag==1){
                   window.location.href = '<?php echo base_url('home');?>';
                   // window.location.href = '<?php echo base_url();?>';
                   return false;  
                 }
               else if(data.flag==2){

                   // window.location.href = '<?php echo base_url();?>';
                    $('#form-error').html('Email Id already exist');
                   return false;  
                 }
               else{
                   console.log(data); 
                }
              }
            }); 
     });
    
    
    }
  
  function Logout()
  {
    FB.logout(function(){ window.location.replace("<?php echo base_url(); ?>ajax/logout");});
  }

  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));


  ////////////////////////////////////////Gmail Login////////////////////////////////////////////////

   /*Google signup*/




function onSignIn(googleUser) {
  
  profile = googleUser.getBasicProfile();
  // console.log(profile);
  var userId = profile.getId(); // Do not send to your backend! Use an ID token instead.
  var userName = profile.getName();
  var userEmail =  profile.getEmail();
  var picture = profile.getImageUrl();
  //var DOB = profile.getBirthday()

  if(flag==false){
     
    $.ajax({
        method:"POST",
        url:'<?php echo base_url();?>ajax/googlelogin',
        dataType: 'json',
        data: {'id':userId ,'email': userEmail, 'name':userName,'picture':picture},
        success:function(data){
             if(data.flag == 1){
            //console.log(data);   
            window.location.href = '<?php echo base_url('home');?>';
            flag=true;
            return false;                  
                    
            }else{
                  console.log(data); 
            }
        }
    });
  } 
}

$("glog").click(function(){
    gp_signOut();
});

function gp_signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}
</script> 
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script> 
<script>
$("glog").click(function(){
    gp_signOut();
});

function gp_signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}

  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
      disassociate();
           $.ajax({
            method: "POST",
            url: "<?php echo base_url();?>ajax/logout",
            success:function(data){
               if(data){
                 document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url();?>";  
                   
               }
            }
            }); 
    
      // document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url();?>userlogin";
    });
  }
  
  function onLoad() {
      gapi.load('auth2', function() {
        gapi.auth2.init();
      });
    }
    function disassociate() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.disconnect().then(function () {
            console.log('User disconnected from association with app.');
        });
    }
  ////////////////////////////////////////////////////////////////////////////////////////////// 
</script> 

</body>
</html>



