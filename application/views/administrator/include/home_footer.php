<script src="<?php echo base_url(); ?>assets_admin/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets_admin/js/jquery/jquery.validate.js" type="text/javascript"></script>

<script src="assets/js/plugins/underscore/underscore-min.js"></script>

<script>

  $(document).ready(function(){

	  $('#admin_login').validate();

 });

/*function validatelogin(path)
{
  var username=$("#username").val();
  var pass=$("#password").val();
  var link_url = path+"administrator/login_check?useremail="+username+"&password="+pass;
  //alert(link_url);
  $.ajax({
    url: link_url,
    success: function(data) {
          var myobj = eval('('+data+')');
          if(myobj.c!=4){
            $('#error').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong>The email address and password you entered do not match.</div>').show().fadeOut(5000);
           if(myobj.b==1)
           {
             $('#error').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Login Successfully </div>').show().fadeOut(5000);
              window.location= path+"administrator/dashboard";
           }
           if(myobj.b==3)
           {
             $('#error').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Login Successfully</div>').show().fadeOut(5000);
             window.location= path+"administrator/dashboard";
           }
           }else{
             window.location= path+"logincheck/access_denied";
           }
      }
    
    });
  return false;
}*/

// Setup form validation on the #login-form element
    $("#adminlogin").validate({

        // Specify the validation rules
        rules: {
            username: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        
        // Specify the validation error messages
        messages: {
            password: {
                required: "Please enter password",
            },
            email: "Please enter a valid email address"
        },
        
        submitHandler: function(form) {
           var url = "<?php echo base_url();?>";
           //var mydata = $("#adminlogin").serialize();

          //  if($('#adminlogin').valid()){
              $.ajax({
                
                url: "<?php echo base_url(); ?>Logincheck/sign_in",
                type: 'post',
                dataType: 'json',
                data: $('form#adminlogin').serialize(),
                async:false,
                success: function(data)
                 { 
                     if(data.c!=4){
            $('#error').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a>The email address and password you entered do not match.</div>').show().fadeOut(5000);
           if(data.b==1)
           {
             $('#error').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Login Successfully </div>').show().fadeOut(5000);
              window.location= url+"administrator/dashboard";
           }
           if(data.b==3)
           {
             $('#error').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Login Successfully</div>').show().fadeOut(5000);
             window.location= url+"administrator/dashboard";
           }
           }else{
             window.location= url+"logincheck/access_denied";
           }
                 }
              });
            //}
       return false;
        }
    });

</script>

<style>	     

label.error{

	color:#FF0000;

	font-weight:300;

}

.new_erroe_one{

	  color:#FF0000;

	}		

</style>

</body>

</html>