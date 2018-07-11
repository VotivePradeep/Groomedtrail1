<?php $this->load->view('include/header_css');?>
<!-- ckeditor css& js -->
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<!-- <link href="<?php echo base_url().'assets/'; ?>css/custom_style.css" rel="stylesheet"> -->
<script src="<?php echo base_url();?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script>
<!-- ckeditor css& js -->
<style type="text/css">
	.forum-cat-sub h3 {
		display: block;
	}
	a.forum-topic-add {
	    float: right;
	    font-size:  15px;
	    padding: 7px;
	    border: 1px solid #fff;
	    border-radius: 3px;
	    margin: -6px;
	}
	a.clr-forum {
		position: absolute;
		color: #000;
		width: 20px;
		height: 40px;
		z-index: 9;
		text-align: center;
		font-size: 14px;
		line-height: 40px;
		top: 0;
		right: 40px;
		cursor: pointer;
	}
	.forum-srch {
		position: relative;
	}
</style>
<body>
	<header class="navigation">
		<div class="top-bar">
			<?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
		</div>
		
		<nav class="navbar">
			<?php $this->load->view('include/nav_header'); ?>
		</nav>
	</header>
	<div class="inner_banner">
		<div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url().'assets/';?>images/banner.jpg" >
			<div class="prfl-dtl"></div>
		</div>
	</div>
	<section class="top-link">
		<div class="container">
			<div class="row">

				 <div class="col-md-5 col-sm-5">
					<div class="forum-srch">
						<form class="navbar-form" role="search" method="get"  id="serachFrom" name="serachFrom">
					        <div class="input-group">
					            <input type="text" class="form-control" placeholder="Search Topics.." name="searchKey">
					            <div class="input-group-btn">
					                <button class="btn btn-default" type="submit" id="searchforum"><i class="fa fa-search"></i></button>
					            </div>
					            <a class="clr-forum" id="Clear-filter" ><i class="fa fa-repeat"></i></a>
					        </div>
				        </form>
					</div>
				</div> 
				
				<div class="col-md-5 col-sm-5">
					<div class="forum-category">
						<ul class="nav navbar-nav">
						  <li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Select Category <i class="fa fa-angle-down pull-right"></i></a>
						    <ul class="dropdown-menu">
						    	<?php if(!empty($categories)) {
							    foreach($categories AS $Citem) {
							?>
						      <li><a href="<?php echo base_url().'forum/'.$Citem->forum_cat_url; ?>"><?php echo $Citem->forum_cat_name; ?></a></li>
						      <li class="divider"></li>
						      <?php } } ?>
						    </ul>
						  </li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<section class="inner_sec_two forum-sec">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-12">
					<div class="welcm-txt">
						<h3><?php if(isset($forum_heading[0]->title)){echo $forum_heading[0]->title; } ?></h3>
						<p><?php if(isset($forum_heading[0]->description)){echo $forum_heading[0]->description; } ?></p>
					</div>
					<br>
					<?php msg_alert(); ?>
					<div class="form-ful-sec">
						<?php $this->load->view('forum_category_list'); ?>
						<!-- Post Info -->
					</div>
				</div>
				<div class="col-md-3 hidden-xs hidden-sm">
					<div class="forum-google-ad">
			            <div class="google-ad" style="width: 100% !important;">
		                   <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Forum'));
							?>
							<style>
							.example_responsive_1 { width: 100% !important; height: 600px !important; }
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
			         <div class="clearfix"></div>
					<div class="side-topics">
						<h3>Popular Topics</h3>
						<ul>
							<?php
							if(!empty($popularTopics)) {
							foreach($popularTopics AS $itempt) { ?>
							<li><a href="<?php echo base_url().'forum/'.$itempt->forum_cat_url.'/'.$itempt->forum_ques_url;?>"><?php echo $itempt->forum_ques_title; ?></a></li>
							<?php } }else{
								echo "<li>empty!</li>";
							}
							?>
						</ul>
					</div>
                    <div class="clearfix"></div>
			        <div class="side-topics">
						<h3>Newest Topics</h3>
						<ul><?php
				if(!empty($popularforumQuestion)) {
				foreach($popularforumQuestion AS $item) { ?>
							<li>
								<a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>"><?php echo $item->forum_ques_title; ?></a>
							</li>
						<?php } }else{
						echo "<li>empty!</li>";
						}
						?>
						</ul>
					</div>
		        </div>
	</section>
	<div class="modal fade comment-edit-frm" id="myModal12" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Abuse Topic (<span id="abuse-topic-name"></span>)</h4>
			</div>
			<div class="modal-body">
				 <form class="comment_form23 form-horizontal edit-topic-modl" id="Sign-Up-form1" action="<?php echo base_url().'frontEnd/Forum/abuse_forum';?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="f_que_id" id="f_que_id" value="">
					
					<input name="forum_url" id="forum_url"  type="hidden">
					<input name="forum_type" id="forum_type"  type="hidden" value="Topic">
					<input name="forum_title" id="forum_title"  type="hidden">
					<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
					<div class="form-group">
						<label class="col-lg-12 control-label"><strong>Description:</strong></label>
						<div class="col-lg-12">
							<textarea   name="abuse_message" id="abuse_message" class="control-label">
							</textarea>
						</div>
					</div>


					<div class="form-group">

						<div class="col-sm-9">
							<input type="Submit" class="reply-btn" id="topicsubmit" value="Submit">
						</div>
					</div>
				</form> 
			</div>
		</div>
		
	</div>
</div>
	<footer class="main_footer">
		<?php $this->load->view('include/main_footer'); ?>
	</footer>
	<div class="copy-right">
		<?php $this->load->view('include/copyright'); ?>
	</div>
</body>
</html>
<script>
$(document).ready(function(){
CKEDITOR.replace( 'abuse_message', {
height: 250,
filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
} );

});
	$('#searchforum').click(function(evt) {
      evt.preventDefault();
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/forumSearch",
          data: $('#serachFrom').serialize(),
         
          success: function(data){
          // alert(data);
          $('#accordion').html(data);
      
        //  slider();
          }
       });
      
    });
    $('#Clear-filter').click(function() {
    	location.reload();
    });

    $('.abuse-cls').click(function() {
    	$("#myModal12").modal('show');
    	$('#f_que_id').val($(this).attr('f_que_id'));
    	$('#forum_url').val($(this).attr('page_url'));
    	$('#forum_title').val($(this).attr('forum_title'));
    	$('#abuse-topic-name').text($(this).attr('forum_title'));
     /*	var ubuse = $(this).attr('id').split("_");
     	var id = ubuse[1];
     	var forum_type = 'Topic';
        $.ajax({
	        type: 'POST',
	        url: "<?php echo base_url(); ?>frontEnd/forum/abuse_forum",
	        data:{id: id, forum_type: forum_type},
	        success: function(data){
	        	//if(data ==1){
	        		location.reload();
	        	//}
	        }
        });
        return false;*/
    });
</script>