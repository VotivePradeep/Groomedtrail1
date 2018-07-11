<?php $this->load->view('include/header_css');?>
<body>

<?php if((isset($user_id)) && (!empty($user_id))){ ?>
<header class="navigation">
    <div class="top-bar">
        <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
    </div>
    
    <nav class="navbar">
        <?php $this->load->view('include/nav_header.php'); ?>
    </nav>
</header>

<?php }?>

<div class="wrapper">
	<div class="contact-us-main">
		<div class="container">
			<div class="cntct-header">
				<div class="row">
					<div class="col-sm-9">
						<div><?php if(isset($pageDetail[0]->content)){echo $pageDetail[0]->content; } ?></div>
					</div>
					<div class="col-sm-3">
						<div class="cms-ads" >
						<div class="google-ad" >
						 <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'CMS Pages'));
						?>
						<style>
						.example_responsive_1 { width: 160px !important; height: 600px !important; }
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 <?php if((isset($user_id)) && (!empty($user_id))){ ?>   
 
<footer class="main_footer">
	<?php $this->load->view('include/main_footer.php');?>
</footer>

<?php } ?>
<div class="copy-right">
	<?php $this->load->view('include/copyright.php');?>
</div>

</body>
</html>
