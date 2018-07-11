 $(document).ready(function() {
      $("#owl-demo").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          singleItem : true,
          pagination : false,
          autoPlay : false
      });
});

 ///data table start

$('#businessTbl').DataTable( {
    responsive: true
} );
/// data table end
   // When the browser is ready...
$(function() {
     // Setup form validation on the #register-form element
    $("#register-form").validate({

        // Specify the validation rules
        rules: {
            fname: "required",
            lname: "required",
            username: "required",
            accept_terms: "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: "logincheck/register_email_exists",
                    type: "post"
                }
            },
            password: {
                required: true,
                minlength: 5
            },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            fname: "Please enter your first name",
            lname: "Please enter your last name",
            username: "Please enter your Username",
            accept_terms: "Please check for accept terms and condition.",
            password: {
                required: "Please enter your password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: {
            required: 'Please enter your Email Address',
            email: 'Please enter a valid email address',
            remote: 'Email already used. Log in to your existing account.'
            },
            agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
        
        //var url = "<?php echo base_url(); ?>";
        //$("#ajax_favorite_loddder").show();
        $( "#ajax_favorite_loddder" ).addClass("dis-block");
        $( "#ajax_favorite_loddder" ).removeClass("dis-none");
        $.ajax({
        url: "signup",
        type: 'post',
        dataType: 'json',
        data: $('form#register-form').serialize(),
        success: function(data) {
          
                 if(data == 1){
                   $('#register-form')[0].reset();
                       $('#registerMsg').html('<div class="alert alert-success">Your account has been created successfully, please check your email for the verification link to activate your account.</div>').delay(50000).fadeOut();
                      // location.reload();
                      //$("#ajax_favorite_loddder").hide();
                       $( "#ajax_favorite_loddder" ).removeClass("dis-block");
                       $( "#ajax_favorite_loddder" ).addClass("dis-none");
                     }else{
                       $('#register-form')[0].reset();
                       $('#registerMsg').html('<div class="alert alert-success">Something went wrong!</div>').delay(3000).fadeOut();
                     }
                      
                   
                 }
        });

        return false;
        }
    });



// Setup form validation on the #login-form element
    $("#login-form").validate({

        // Specify the validation rules
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
            agree: "required"
        },
        
        // Specify the validation error messages
        messages: {
            password: {
                required: "Please enter your password",
            },
            email: "Please enter a valid email address",
            agree: "Please accept our policy"
        },
        
        submitHandler: function(form) {
          // var url = "<?php echo base_url();?>";
           var mydata = $("#login-form").serialize();

            if($('#login-form').valid()){
              $.ajax({
                url: "login",
                type: 'post',
                dataType: 'json',
                data: $('form#login-form').serialize(),
                async:false,
                success: function(data)
                 {
                    var typeFlag = "";
                    if(data.b == 1){
                        if(data.c == 1){
                              $('#login-form')[0].reset();
                              $('#userSignin').html('<div class="alert alert-danger">Please Check Email Address.</div>').delay(3000).fadeOut();
                             
                               setTimeout(function(){  location.reload();}, 1000);
                          }
                         if(data.c == 2 || data.c == 3){
                              $('#login-form')[0].reset();
                              $('#userSignin').html('<div class="alert alert-success">Login Successfully.</div>').delay(3000).fadeOut();                       
                              typeFlag = "home";
                              setTimeout(function(){ window.location.href=typeFlag;}, 1000);
                          }
                        
                         
                    }else{
                         $('#userSignin').html('<div class="alert alert-danger">'+ data.a +'</div>').show().fadeOut(20000);
                    }
                 }
              });
            }
       return false;
        }
    });



     /**********forgot Password***************/

$("#forget_password").validate({
rules: {
        forgot_emailid: {
        required: true,
        email: true
    },
    
},
messages: {

  forgot_emailid: {
    required: 'Please enter your Email Address',
    email: 'Please enter a valid email address'
    },
},

submitHandler: function() 
{
  var URl= $('#forgot_url').val();
   $.ajax({

    type: "POST",
    url : "logincheck/forgot_password",
    data: $('#forget_password').serialize(),
    dataType: "JSON",
    async:false,
    success: function(data)
    {
    //alert(data);
        if(data == 1){
            $('#form-error').html('');
            $('#forgotPass').removeClass('alert-danger');
            $('#forgotPass').html('<strong>Please check your email</strong><p> An email with a confirmation link has been sent to your email address.</p>').addClass('alert alert-success').show().fadeOut(5000);
        
            $('#forget_password')[0].reset();                           
        }else if(data == 2){
            $('#forgot_emailid').find("input[type=text]").val("");
            $('#forgotPass').removeClass('alert-success');
            $('#forgotPass').html('<div class="alert alert-danger">Email doesnot exist.</div>').addClass('alert-danger').show().fadeOut(5000); 
            
        }
        else if(data == 3){
            $('#forgot_emailid').find("input[type=text]").val("");
            $('#forgotPass').removeClass('alert-success');
            $('#forgotPass').html('<div class="alert alert-danger">Please first verify your account. Check the email we sent you.</div>').addClass('alert-danger</div>').show().fadeOut(5000); 
            
        }
        else{
            $('#forgot_emailid').find("input[type=text]").val("");
            $('#forgotPass').removeClass('alert-success');
            $('#forgotPass').html('<div class="alert alert-danger">Something going wrong</div>').addClass('alert-danger').show().fadeOut(5000); 

        }
    }
  });
}
});

$("#user_change_password").validate({   
// Specify the validation rules
    rules: {
        
        password: {
            required: true,                     
            minlength:6
        },
        cpassword : {
            required: true,
            minlength:6,
            equalTo : "#password"
        }
    },
    // Specify the validation error messages
    messages: {
       
        password: {
            required: "Please enter Password",
            equalTo :  "Password do not match "
        },
        cpassword: {
            required: "Please enter Confirm Password"
        },
    },
    submitHandler: function() 
    {
       var URl= $('#forgot_url').val();
       //form.submit();       
        $.ajax({
              type: "POST",
              url : URl+"logincheck/change_password",
              data: $('#user_change_password').serialize(),
              dataType:"JSON",
              success:function(data){
                if(data == 1){
                    $('#form-error').html('');
                    $('#responsmsg').removeClass('alert-success');
                    $('#responsmsg').html('<div class="alert alert-success">Successfully changed password!</div>').addClass('alert-success').show().fadeOut(20000);
                     window.location= URl;
                }
            }
        });
        return false;
    }
});
     

  /*      $("#forget_password").validate({
        rules: {
                forgot_emailid: {
                required: true,
                email: true
            },
            
        },
        messages: {

          forgot_emailid: {
            required: 'Please enter your Email Address',
            email: 'Please enter a valid email address'
            },
        },
        
        submitHandler: function() 
        {
          var URl= $('#forgot_url').val();
           $.ajax({

            type: "POST",
            url : "logincheck/request_verify",
            data: $('#forget_password').serialize(),
            dataType: "JSON",
            async:false,
            success: function(data)
            {
            //alert(data);
                    if(data == 1){
                        $('#form-error').html('');
                        $('#forgotPass').removeClass('alert-danger');
                        $('#forgotPass').html('We have sent new password to your email. Please check your email.').addClass('alert alert-success').show().fadeOut(5000);
                    
                        $('#forget_password')[0].reset();                           
                    }else if(data == 2){
                        $('#forgot_emailid').find("input[type=text]").val("");
                        $('#forgotPass').removeClass('alert-success');
                        $('#forgotPass').html('<div class="alert alert-danger">Email doesnot exist.</div>').addClass('alert-danger').show().fadeOut(5000); 
                        
                    }
                    else if(data == 3){
                        $('#forgot_emailid').find("input[type=text]").val("");
                        $('#forgotPass').removeClass('alert-success');
                        $('#forgotPass').html('<div class="alert alert-danger">Please verify your account first.</div>').addClass('alert-danger</div>').show().fadeOut(5000); 
                        
                    }
                    else{
                        $('#forgot_emailid').find("input[type=text]").val("");
                        $('#forgotPass').removeClass('alert-success');
                        $('#forgotPass').html('<div class="alert alert-danger">Something going wrong</div>').addClass('alert-danger').show().fadeOut(5000); 

                    }
            }
          });
        }
    });*/

     /**************************Enquiry Form*****************************************/
// Setup form validation on the #contactfrm element
    $("#contactfrm").validate({

        // Specify the validation rules
        rules: {
                name: {
                    required: true,
                },
                
                email: {
                    required: true,
                    email: true
                },
                mobileNO:{
                required: true,
                //regex: /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})$/
                },
                msg_contact: {
                    required: true,
                },
        },
        
        // Specify the validation error messages
        messages: {
                name: {
                    required: "Please enter name.",
                },
                email: {
                    required: "Please enter email address.",
                },
                mobileNO: {
                    required: "Please enter phone no. ",
                },
                
                msg_contact: {
                    required: "Please enter message.",
                },
                
        },
        
        submitHandler: function(form) {

        $("#ajax_favorite_loddder").show();
          $.ajax({
                    type: "POST",
                    url : "ajax/enquiry",
                    data: $("#contactfrm").serialize(), // serializes the form's elements.
                    dataType: "JSON",
                    success: function(data)
                    {
                        $("#ajax_favorite_loddder").hide();
                        if(data.msg_status == 'msg_success' ){

                           $('#msgContact').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);
                           $('#contactfrm')[0].reset();
                          
                        }else{
                            
                           $('#msgContact').html('<div class="alert alert-success">'+data.msg_message+'</div>').show().fadeOut(5000);

                        }
                        $('.loader').hide();
                    }
                });
                return false;
        }
    });   

    

     /**************************Enquiry Form*****************************************/
// Setup form validation on the #addRouteUser element
    $("#addRouteUser").validate({

        // Specify the validation rules
        rules: {
                name: {
                    required: true,
                },
        },
        
        // Specify the validation error messages
        messages: {
                name: {
                    required: "Please enter Name.",
                },
                
        },
        
        submitHandler: function(form) {

        $("#ajax_favorite_loddder").show();
          $.ajax({
                    type: "POST",
                    url : "logincheck/addRouteUser",
                    data: $("#addRouteUser").serialize(), // serializes the form's elements.
                    dataType: "JSON",
                    success: function(data)
                    {
                        $("#ajax_favorite_loddder").hide();
                        if(data == 1){

                           $('#msgroute').html('<div class="alert alert-success">Route is successfully added</div>').show().fadeOut(5000);
                           $('#addRouteUser')[0].reset();
                          
                        }
                       
                    }
                });
                return false;
        }
    });   


});






/////////////////////////delete function////////////////
function deletefunc(del_id, tablename, message){

if (confirm(message))
{

$.ajax({
        type:'POST',
        url:'deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             $('#responseMsg').html('<div class="alert alert-success">Delete record successfully</div>').show().fadeOut(5000);                          
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }
    
}


/////////////////////////delete function////////////////
function phoneFormatter() {
  $('#mobileNO').on('input', function() {
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

