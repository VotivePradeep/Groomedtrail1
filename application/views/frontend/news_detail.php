<?php $this->load->view('include/header_css');?>
<body>

<header class="navigation">
    <div class="top-bar">
        <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
    </div>
    
    <nav class="navbar">
        <?php $this->load->view('include/nav_header'); ?>
    </nav>
</header>

<div class="wrapper">
	<section class="news-img-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="news-img-main">
						<img src="<?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){echo base_url().$newDetail[0]->news_image;}?>">
					</div>		
					<div class="news-main-txt">
						<h3><?php if(isset($newDetail[0]->news_title)){echo $newDetail[0]->news_title;}?></h3>
						<span class="nws-dt-tme">
							<span class="news-dt"><?php if(isset($newDetail[0]->news_update_date)){$date = date_create($newDetail[0]->news_update_date); 
                            echo date_format($date, 'd M Y h:i A');}?></span>
                             <span class="created_vy_news" style="float: right;"><?php if(isset($newDetail[0]->user_id)){
                                if($newDetail[0]->user_id !=0){
                                	echo $newDetail[0]->fname.' '.$newDetail[0]->lname;
                                }else{
                                	echo 'Admin';
                                }
                            	
                            }?></span>
						</span>
						<p><?php if(isset($newDetail[0]->news_description)){echo $newDetail[0]->news_description;}?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="google-ad-main">
		              <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'	News Details'));
						?>
						<style>
						.example_responsive_1 { width: 100% !important; height: 250px !important; }
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
					<div class="top-news-side">
						<div class="main-nws-head">
							<div class="heading-news">
								<h3>Latest News</h3>
							</div>
						</div>
						<ul>
						 <?php if(isset($latestNewsList)){
                           foreach ($latestNewsList as $latestNews) {?>
							<li>
								<img src="<?php if(isset($latestNews->news_image) && !empty($latestNews->news_image)){echo base_url().$latestNews->news_image;}?>">
								<h4><?php if(isset($latestNews->news_title)){echo $latestNews->news_title;}?></h4>
								<a href="<?php echo base_url().'newdetail/'.$latestNews->news_id; ?>">Read More</a>
							</li>
						  <?php }   } ?>

						</ul>
					</div>
					<div class="top-news-side">
						<div class="main-nws-head">
							<div class="heading-news">
								<h3>Latest Classifieds</h3>
							</div>
						</div>
						<ul>
						 <?php if(isset($latestClsList)){
                           foreach ($latestClsList as $latestcls) {?>
							<li>
								<img src="<?php if(isset($latestcls->cls_imag) && !empty($latestcls->cls_imag)){echo base_url().$latestcls->cls_imag;}?>">
								<h4><?php if(isset($latestcls->classified_created_by)){echo $latestcls->classified_created_by;}?></h4>
								<a href="<?php echo base_url().'classified/details/'.$latestcls->url_slag; ?>">Read More</a>
							</li>
						  <?php }   } ?>

						</ul>
					</div>
					
					 <div class="top-news-side">
						<div class="main-nws-head">
							<div class="heading-news">
								<h3>Latest Forum Topics</h3>
							</div>
						</div>
						<ul>
						 <?php
						 if(!empty($popularforumQuestion)) {
									foreach($popularforumQuestion AS $item) { ?>
							<li>
								
								<h4><b><?php echo $item->forum_ques_title; ?></b></h4>
								<p><?php 
								$words = explode(" ", $item->forum_ques_description);
                                $content = implode(" ",array_splice($words,0,15));

								echo $content; ?></p>
								<a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>">Read More</a>
							</li>
						  <?php }   } else{
					echo "<li>empty!</li>";
					}
					?>

						</ul>
					</div> 
				</div>
			</div>
		</div>
	</section>
</div>
    
<footer class="main_footer">
	<?php $this->load->view('include/main_footer');?>
</footer>
<div class="copy-right">
	<?php $this->load->view('include/copyright');?>
</div>

</body>
</html>