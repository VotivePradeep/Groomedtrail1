<!doctype html>
<html>
<head>
<link rel="canonical" href="<?php echo base_url(uri_string()); ?>">
<meta charset="utf-8">
<meta name="keywords" content="<?php if(isset($meta_setting[0]->meta_keyword)){echo $meta_setting[0]->meta_keyword; }?><?php if(isset($pageDetail[0]->mata_keywords)){echo $pageDetail[0]->mata_keywords; }?>">
<meta name="author" content="<?php if(isset($meta_setting[0]->meta_author)){echo $meta_setting[0]->meta_author; }?><?php if(isset($pageDetail[0]->mata_author)){echo $pageDetail[0]->mata_author; }?>">
<meta name="viewport" content="<?php if(isset($meta_setting[0]->meta_viewport)){echo $meta_setting[0]->meta_viewport; }?><?php if(isset($pageDetail[0]->mata_viewport)){echo $pageDetail[0]->mata_viewport; }?>">
<meta name="description" content="<?php if(isset($meta_setting[0]->meta_description)){echo strip_tags($meta_setting[0]->meta_description); }?><?php if(isset($pageDetail[0]->mata_viewport)){echo $pageDetail[0]->mata_viewport; }?><?php if(isset($pageDetail[0]->mata_description)){echo $pageDetail[0]->mata_description; }?><?php if(isset($segment)){ if($segment == 'classified' && $segment2 == 'details'){ if(isset($classified->classified_description)){$words = explode(" ",$classified->classified_description); echo $content = implode(" ",array_splice($words,0,30)); } } } ?><?php if(isset($pageDetail[0]->mata_description)){echo $pageDetail[0]->mata_description; }?>">
<meta name="title" content="<?php if(isset($meta_setting[0]->page_name)){echo strip_tags($meta_setting[0]->page_name); }?><?php if(isset($segment)){ if($segment == 'classified' && $segment2 == 'details'){ if(isset($classified->classified_created_by)){echo $classified->classified_created_by; } } } ?><?php if(isset($pageDetail[0]->page_name)){echo $pageDetail[0]->page_name; }?>">
<meta name="site_name" content="<?php echo 'Groomedtrail'; ?>">
<meta name="url" content="<?php echo base_url(uri_string()); ?>">
<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/ico" size="16x16">
<title><?php if(isset($eventDetail[0]->event_title) && !empty($eventDetail[0]->event_title)){echo $eventDetail[0]->event_title;}else if(isset($newDetail[0]->news_title)){echo $newDetail[0]->news_title;}else{ echo $pagetitle; }?></title>
<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="<?php echo base_url()?>assets/css/datepicker.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/master.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/style.css"> <!-- Gem style -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/lightslider.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<meta name="google-signin-scope" content="profile email">
<?php $googleCred = google_credential();?>
<meta name="google-signin-client_id" content="<?php if(isset($googleCred[0]->oauth_key)){echo $googleCred[0]->oauth_key;}?>">
<!-- <meta name="google-signin-client_id" content="783581350026-b86d04i2ou5j9igcud8aual8ioed85oq.apps.googleusercontent.com"> -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="<?php echo base_url()?>assets/js/modernizr.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
</head>
