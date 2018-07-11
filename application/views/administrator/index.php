<style>
		body {
      background: url('http://dev1.groomedtrail.com/assets/images/home-bkg.png');
      background-size: cover;
      background-position: top left;
      background-repeat: no-repeat;
    }
    .main-login-page {
      height: 100vh;
      width: 100%;
      background: rgba(187, 187, 187, 0.28);
  }
</style>   
<div class="main-login-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="admin_login_frst">
          <h4><?php echo $this->session->flashdata('check_login'); ?></h4>
          <img src="http://dev1.groomedtrail.com/assets/images/logo-main.png" style="height: 66px;">
          <p class="text-center">Sign in to continue to the Administration Panel</p>
          <span id="error"></span>
          <hr class="clean">
          <form role="form" class="cd-form" name="adminlogin" id="adminlogin" method="post" >
            <p class="fieldset">
              <label class="image-replace cd-email" for="signin-email">E-mail</label>
              <input type="email" id="username" name="username" class="full-width has-padding has-border required email"  placeholder="Email Adress">
            </p>
            <p class="fieldset">
              <label class="image-replace cd-password" for="signin-password">Password</label>
              <input type="password" name="password" id="password" class="full-width has-padding has-border required password"  placeholder="Password">
            </p>
            <?php ?>
            <p class="fieldset">
              <input type="submit" class="full-width has-padding submit-btn" value="Sign in" >
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>