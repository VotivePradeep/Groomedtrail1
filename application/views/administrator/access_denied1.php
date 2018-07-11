<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo @$title; ?></title>
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/ico" size="16x16">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets_admin/css/bootstrap/bootstrap.css" /> 
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets_admin/css/app/app.v1.css" />
</head>
<body data-ng-app>
<style type="text/css">
  .error {
      background: #fff;
      max-width: 550px;
      margin: 0 auto;
      padding: 35px;
      text-align: center;
  }
  .error img {
      width: 100%;
  }
  .error h3 {
    letter-spacing: 1.2px !important;
    color: red;
  }
  .cntct-header h3 {
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3.6px;
    padding-bottom: 15px;
    position: relative !important;
    margin: 45px 0px 15px;
}
 .cntct-header .error h3:before {
    width: 75px;
    height: 2px;
    background-color: #b1b1b1;
    position: absolute;
    bottom: 0;
    content: "";
    left: 41%;
}
  section.error-page {
      background: url(<?php echo base_url(); ?>assets/images/map-bg.jpg);
      padding: 0  0 ;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      position: relative;
      background-repeat: no-repeat;
  }
  .error-con {
      margin: 30px 0 0 0;
      padding: 5px 0 0;
  }
  .overcan {
      padding-top: 15%;
      min-height: 91vh;
      background-color: rgba(0, 0, 0, 0.33);
  }
 .error-con a{    
   background-color: #337ab7;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    padding: 10px;
  }
</style>

 
  <div class="wrapper">
    <section class="error-page">
      <div class="overcan">     
        <div class="container">
          <div class="cntct-header">
          <div class="row">
            <div class="col-md-12">
              <div class="error">
                <h3>Access Denied</h3>
                <p>You do not have permission to access this link.</p>
               <div class="error-con">
                  <a href="javascript:void(0);" onclick="history.go(-1);">OK</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
 <footer class="container-fluid footer">
          Copyright &copy; 2017 
            <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
 </footer>

