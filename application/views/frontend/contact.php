<?php $this->load->view('include/header_css');?>
<body>

<header class="navigation">
    <div class="top-bar">
        <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
    </div>
    
    <nav class="navbar">
        <?php $this->load->view('include/nav_header.php'); ?>
    </nav>
</header>

<div class="wrapper">
    <section class="contact-us-main">
        <div class="container">
            <div class="cntct-header">
                <div class="row">
                    <div class="col-sm-9">
                    	<div class="contact-Us">
	                        <h3>Contact Us</h3>
	                        <p><?php if(isset($contactUs->content)){echo $contactUs->content; } ?></p>
	                        <div class="cntc-details">
	                            <ul>
	                                <li>
	                                    <span class="ctct-icon">
	                                        <i class="fa fa-phone" aria-hidden="true"></i>
	                                    </span>
	                                    <span class="ctct-txt">
	                                        <a href="tel:<?php if(isset($contactUs->phone)){echo $contactUs->phone; } ?>"><?php if(isset($contactUs->phone)){echo $contactUs->phone; } ?></a>
	                                    </span>
	                                </li>
	                                <li>
	                                    <span class="ctct-icon">
	                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
	                                    </span>
	                                    <span class="ctct-txt">
	                                       <?php if(isset($contactUs->address)){echo $contactUs->address; } ?>
	                                    </span>
	                                </li>
	                                <li>
	                                    <span class="ctct-icon">
	                                        <i class="fa fa-envelope" aria-hidden="true"></i>
	                                    </span>
	                                    <span class="ctct-txt">
	                                        <a href="mailto:<?php if(isset($contactUs->email)){echo $contactUs->email; } ?>" target="_top"><?php if(isset($contactUs->email)){echo $contactUs->email; } ?></a>
	                                    </span>
	                                </li>
	                            </ul>
	                        </div>
	                        <div class="cntc-form-main">
	                       <div id="msgContact"></div>
	                            <form method="post" id="contactfrm" name="contactfrm">
	                                <div class="row">
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Name </label>
	                                            <input type="text" class="form-control" id="name" name="name" type="text" placeholder="Enter Your name">
	                                        </div>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <div class="input-group">
	                                            <label>Phone </label>
	                                            <input type="text" class="form-control"  id="mobileNO" name="mobileNO" placeholder="Enter Your Phone" maxlength="14" minlengt="14">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Email </label>
	                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your email">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-12">
	                                        <div class="input-group">
	                                            <label>Message </label>
	                                            <textarea class="form-control" class="form-control" rows="4" id="msg_contact" name="msg_contact" placeholder="Enter Your Message Here"></textarea>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-md-12">
	                                        <button type="submit" class="btn btn-default">Send Message</button>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
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
    </section>
</div>
    
<footer class="main_footer">
	<?php $this->load->view('include/main_footer.php');?>
</footer>
<div class="copy-right">
	<?php $this->load->view('include/copyright.php');?>
</div>

</body>
</html>
<script>

</script>