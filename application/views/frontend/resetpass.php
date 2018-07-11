<div class="container">

	<div class="row">

	  <div class="col-lg-4 col-lg-offset-4">

			<div class="admin_login_frst">

        	<h3 class="text-center">Route Planning</h3>

            <p class="text-center">Reset Password</p>

            <hr class="clean">

        	<form role="form" id="admin_login" method="post" action="<?php echo base_url();?>resetpass_form">

              <div class="form-group input-group">

              	<span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="password" name="new_password" class="form-control required password"  placeholder="New Password">
                <input type="hidden" name="post_email" value="<?php echo $email;?>"  placeholder="Email">

              </div>
              
			         <input type="submit" class="btn btn-purple btn-block" name="resetpass_btn" value="Reset Password" >

            </form>

			</div>

    </div>

  </div>

</div>