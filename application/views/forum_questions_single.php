<?php $this->load->view('include/header_css');?>
<!-- ckeditor css& js -->
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script>
<!-- ckeditor css& js -->
<style type="text/css">
/* subcrib btn */
div#cbscrb-btn {
float: right;
    margin-top: 23px;
}
.sbcrb-red a i {
    margin-right: 5px;
    font-size: 16px;
}
.sbcrb-red a {
    font-size: 12px;
    color: #fff;
    padding: 10px;
    float: left;
}
.sbcrb-red {
    float: left;
    background-color: #387fcc;
    border-radius: 5px;
}
div#cbscrb-btn-chng {
    float: left;
    display: none;
	float: right;
    margin-top: 23px;
}
.sbcrbed {
    float: left;
}
.sbcrbed a {
    float: left;
}
.sbcrbed a .sbcrbed-dflt {
    float: left;
    border: none;
    padding: 10px;
    color: #fff;
    background-color: #387fcc;
    font-size: 12px;
    border-radius: 5px;
}
.sbcrbed a .sbcrbed-dflt i.fa {
    margin-right: 5px;
    color: #666;
}
.sbcrbed-chang {
    float: left;
    border: none;
    padding: 10px;
    color: #fff;
    background-color: #387fcc;
    font-size: 12px;
    border-radius: 5px;
}


div#cbscrb-btn-chng .sbcrbed a:hover .sbcrbed-chang {
    display: block;
}
div#cbscrb-btn-chng>.sbcrbed>a>.sbcrbed-chang {
    display: none;
}
div#cbscrb-btn-chng .sbcrbed a:hover .sbcrbed-dflt {
    display: none;
}
.sbcrb-red a:hover {
    color: #fff;
    text-decoration: none;
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
	<?php

	$query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=17 AND tbl_user_assign_permission.user_id =".$this->session->userdata('user_id')."");
	$userType = $query->row();

	if($this->session->userdata('user_d')){
		$notLogin="";
		} else{
	$notLogin="notLogin";
	}
	?>
	<style>
	.btn-file {
	position: relative;
	overflow: hidden;
	}
	.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
	}
	.editTopic1{
		position: absolute;
	    z-index: 1;
	    right: 25px;
	    top: 0;
	    opacity: 0.3;
	    border-radius: 5px;
	    color: #b9b9b9;
	}
	.editTopic1 a {
	    color: #387fcc;
	    padding: 2px 5px;
	    margin-left: 1px;
	    float: left;
	    background: #dedada;
	    /* background: rgba(255, 245, 245, 0.28); */
    }
    span.h-card.cke_widget_element img {
    width: 28px;
}
	</style>
	<div class="main-sec-forum-question wrapper_top">
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="forum-main-ques-single" <?php if(isset($single->abuse_forum)){ if($single->abuse_forum == 1){ ?> style="background: rgba(98, 152, 220, 0.09);"<?php } }?> >
							<div class="row">
								<div class="col-md-2 col-sm-3  forum_single_image_user">
									<div class="fo_image">
									<?php 
						              if(isset($single->profile_picture) && !empty($single->profile_picture)){ 

						              if(strpos($single->profile_picture, "http://") !== false OR strpos($single->profile_picture, "https://") !== false){
						                $img = $single->profile_picture;
						              }else
						              {
						                $img = base_url().$single->profile_picture;
						              }

						              }
						              else
						              { 
						              $img =  base_url().'assets/images/default.png';}

						              ?>

										<img src="<?php echo $img; ?>">
									</div>
								</div>
								<div class="col-md-10 col-sm-9">
									<div class="forum-que-topic-disc">
										<h3><?php echo $single->forum_ques_title; ?>
											<?php
										if($this->session->userdata('user_id')){
												$userid=$this->session->userdata('user_id');
												$user_id=$single->user_id;
												if($userid == $user_id || $userType->role_id==2) {
										?>
										<p class="editTopic1">
											<a href="javascript:" data="<?php echo $single->forum_ques_id; ?>" class="edit_comment_popup12"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a href='javascript:' class='cat_image_remove12' items='1' data='<?php echo $single->forum_ques_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											
										</p>
										<?php }} ?>
										</h3>
										<div class="forum-que-fmtt-text">
										   <?php if(!empty($single->forum_topic_file)) { ?>
											   <div class="topic-img">
											   	<img src="<?php echo base_url(). $single->forum_topic_file; ?>" style="width: 258px; float: left;margin: 0px 27px 8px 0px;"/> 
											   	<?php echo $single->forum_ques_description; ?>
											   </div>
										   <?php }else{ ?>
									   			<div class="topic-dsc"><?php echo $single->forum_ques_description; ?></div> 
										   <?php } ?>
									    </div>
									    
									</div>								
									<div class="post-tag single-user">
									    <div class="fo_text">
										   	<div class="reply_section">
												<ul>
													<li><h5><strong>By </strong><?php echo $single->fname; ?></h5></li>
													
													<li><h5><strong>Date </strong><?php if(isset($single->date)){ $date = date_create($single->date); echo date_format($date, 'd M Y h:i A');}?></h5></li>
													
													<li><h5> <span><i class="fa fa-comments" aria-hidden="true"></i></span><span class="topicTotalcomments"> <?php echo $totalcomment; ?></span></h5></li>
													<li> <h5><a href="javascript:" id="forum_topic_id" class="commentLike12"><i class="fa fa-thumbs-up" aria-hidden="true"></i> like(<span class="topicTotallike">  <?php echo $totallike;?></span>)</a></h5></li>
													
													<li class="pull-right">
														<a href="<?php echo base_url().'forum/'.$this->uri->segment(2);?>" class="cat-link"><?php echo ucfirst(str_replace("-"," ",$this->uri->segment(2)));?></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="fmq-main-topic-text">
							<?php msg_alert(); ?>
						</div>
						<div class="fmq-reply-buttons">
							<div class="row">
								<div class="col-md-6">
									<div class="main-reply-button">
										<ul>
											<li><a href="#myalert"><i class="fa fa-reply"></i> Reply</a></li>
										</ul>
									</div>
								</div>

							<div class="col-md-6">
								<div class="main-reply-button like_section_main">
									<div class="scrcbn-box">
										<?php
										$status_1='display:block';
										$status_0='display:none';
										if(isset($user_subscribe->status)){
											if($user_subscribe->status == 1){
											    $status_1='display:none';
												$status_0='display:block';
											} else{
											    $status_1='display:block';
											    $status_0='display:none';
											}
										}
										?>
										<div id="cbscrb-btn" style="<?php echo $status_1; ?>" class="cbscrb-box">
												<div class="sbcrb-red"><a href="javascript:" class="subcribe_btn" alt="1">Subscribe</a>
											</div>
										</div>
										<div id="cbscrb-btn-chng" style="<?php echo $status_0; ?>" class="cbscrb-box">
											<div class="sbcrbed"><a href="javascript:" alt="0" class="unsubcribe_btn">
												<div class="sbcrbed-dflt">Subscribed</div>
												<div class="sbcrbed-chang">Unsubscribe</div>
											</a>
										   </div>
										</div>
								</div>
						</div>
						
					</div>
				</div>
			</div>
			<input type="hidden" id="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>" name="forum_ques_id">
			<input type="hidden" id="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>" name="forum_cat_id">
			<div class="myalertcomt"></div>
			
			<div class="row">
				<div class="col-md-12 col-md-offset-222">
					<?php echo $pagination; ?>
				</div>
			</div>
			<div class="forum-main-user-comments post-tag">
				<?php
				if(!empty($commentusers)) {	
					foreach($commentusers AS $item) {
				?>
				<div class="fmuc-sub" <?php if(isset($item->abuse_forum)){ if($item->abuse_forum == 1){ ?> style="background: rgba(98, 152, 220, 0.09);"<?php } }?>>
					<div class="row">
						<div class="col-md-2">
							<div class="fo_image">
							<?php 
							if(isset($item->profile_picture) && !empty($item->profile_picture)){ 
								if(strpos($item->profile_picture, "http://") !== false OR strpos($item->profile_picture, "https://") !== false){
									$img = $item->profile_picture;
								}else
								{
									$img = base_url().$item->profile_picture;
								}
							}
							else
							{ 
								$img =  base_url().'assets/images/default.png';
							}

							?>
						<img src="<?php echo $img; ?>" alt="<?php echo $item->fname; ?>" width="50" height="50">
						</div>
						</div>
						<div class="col-md-10">
							<div class="product_dec">
								<div class="comment_box extra_file_add">
									<span class="media_box">
										<?php
										
										if($item->forum_comment_file)
										{
										$path_parts = pathinfo($item->forum_comment_file);
										// print_r($path_parts);
										$extension=$path_parts['extension'];
										$basename=$path_parts['basename'];
										$filename=$path_parts['filename'];
											
										$file_type=array("gif"=>"1" ,"jpg"=>"1" ,"jpeg"=>"1" ,"png"=>"1" ,"bmp"=>"1" ,"GIF"=>"1" ,"JPG"=>"1" ,"PNG"=>"1" ,"JPEG"=>"1" ,"PDF"=>"2" , "pdf"=>"2" , "mp4"=>"3" ,"3gp"=>"3" ,"flv"=>"3" ,"mp3"=>"3" ,"wma"=>"3" ,"wmv"=>"3" ,"docx"=>"4" ,"doc"=>"4" ,"DOC"=>"4" , "DOCX"=>"4" ,"txt"=>"5");
											
											// $file_type=array("jpg"=>'1',"wmv"=>'2',"pdf"=>'3');
										$get_type_file=$file_type[$extension];
										if($get_type_file == 1){
												echo "<img class='comment_file' src='".base_url().'assets/editor_images/'.$basename."'>";
										} else if($get_type_file == 2){
											
										echo "<a target='_blank' href='".base_url().'assets/editor_images/'.$basename."'><img class='file_icon' src='".base_url().'assets/images/pdf.png'."'></a>";
										} else if($get_type_file == 3){
										echo "<video width='320' height='240' controls>
													<source  src='".base_url().'assets/editor_images/'.$basename."' type='video/".$extension."'>
													<source src='".base_url().'assets/editor_images/'.$filename.".ogg' type='video/ogg'>
											Your browser does not support HTML5 video.
										</video>";
										}
										else if($get_type_file == 4){
												echo "<a target='_blank' href='http://docs.google.com/gview?url=".base_url().'assets/editor_images/'.$basename."'><img class='file_icon' src='".base_url().'assets/images/docx.png'."'></a>";
										
										}
										}
										?>
									</span>
									<div class="editComment-manage">
									<?php
									if($this->session->userdata('user_id')){
										
										$userid=$this->session->userdata('user_id');
										$user_id=$item->user_id;
										if($userid == $user_id ||$userType->role_id==2 ) {
									?>
									<p class="editComment">
										<a href="javascript:" data="<?php echo $item->forum_comment_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $item->forum_comment_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
									</p>
									<?php }  } ?>
									<div class="abuse-tag single-forum-ubuse"><a href="javascript:void(0)" class="abuse-cls" title="Abuse" id="abuse_<?php echo $item->forum_comment_id; ?>"  page_url="<?php echo 'forum/'.$this->uri->segment(2).'/'.$this->uri->segment(3);?>" f_que_id="<?php echo $item->forum_comment_id; ?>" forum_title="<?php echo $single->forum_ques_title; ?>"><img src="<?php echo base_url();?>assets/images/Loud_Speaker.png" style="width: 30px;height: 30px;" title="abuse"/></a></div>
								    </div>


									<p><div class="comment_text"><?php echo $item->forum_comment_description; ?></div></p></div>
								</div>
								<div class="fo_text">
									<div class="reply_section">
										<ul>
											<li><h5><strong>By </strong><?php echo $item->fname; ?></h5></li>
											
											<li><h5><strong>Date </strong>
											<?php if(isset($item->cmdate)){ $date = date_create($item->cmdate); echo date_format($date, 'd M Y h:i A');}?>

											<?php
													//echo date_format(date_create($item->cmdate), 'd F, Y H:i:s');
											?></h5></li>
											
											<li><h5><a href="javascript:" id="<?php echo $item->forum_comment_id; ?>" class="commentLike like<?php echo $item->comment_like_me; ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i> like(<span class="topicGridlike"><?php echo $item->comment_likes; ?></span>)</a></h5></li>
											
											<li class="pull-right">
												<?php  if($this->session->userdata('user_id')){ ?>
												<button class="replay-btn" id="post-1"><i class="fa fa-reply"></i> Reply</button>
												<?php } else{ ?>
												<button class="notLogin dftreply" id="post-1"><i class="fa fa-reply"></i> Reply</button>
												<?php } ?>
											</li>
										</ul>
										
										
										<div class="replay-div-con" style="display: none;">
											<form class="comment_form form-horizontal" action="<?php echo base_url().'frontEnd/forum/comment'; ?>" method="post" enctype="multipart/form-data">
												<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
												<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
												<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
												<input type="hidden" name="forum_comment_id" value="<?php echo $item->forum_comment_id; ?>">
												
												<textarea class="editorComment" id="edit_<?php echo $item->forum_comment_id; ?>" name="forum_comment_description"></textarea>
												
												<div class="form-group" style="position: relative;">
												<!-- <label class="col-sm-2 control-label image_label text-left">Upload file </label> -->	
												<a class='btn btn-primary' href='javascript:voide(0);' style="margin-left: 15px;margin-bottom: 10px;position: relative; border-radius: 5px;box-shadow: none;">
												<i class="fa fa-paperclip" aria-hidden="true"></i>
												<input type="file" style='position: absolute;z-index: 99999999;top: 0;left: 13px;filter: alpha(opacity=0);-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity: 0;background-color: transparent;color: transparent;height: 35px;width: 40px;' name="upload" size="40"  onchange='$("#upload-file-info_<?php echo $item->forum_comment_id; ?>").html($(this).val());'>
											    </a>
											    &nbsp;
											    <span class='label label-info' id="upload-file-info_<?php echo $item->forum_comment_id; ?>"></span>	
												</div>
												
												<div class="form-group">
													
													<div class="col-sm-12">
														<input type="Submit" class="reply-btn" value="Post Comment">
													</div>
												</div>
												
											</form>
										</div>
									</div>
									
									<?php
									if(!empty($item->child_comment)) {
									
										foreach($item->child_comment AS $itemch) {
									?>
									
									<div class="row">
										<div class="comment-main">
											<div class="profile_comment_id">
												<!--<a href="<?php if($itemch->user_type == 'user'){  echo base_url().'user-profile/'.base64_encode($itemch->user_id); }else{ echo base_url().'doctor-profile/'.base64_encode($itemch->user_id);} ?>">-->
												<?php 
										          if(isset($itemch->profile_picture) && !empty($itemch->profile_picture)){ 

										          if(strpos($itemch->profile_picture, "http://") !== false OR strpos($itemch->profile_picture, "https://") !== false){
										            $img = $itemch->profile_picture;
										          }else
										          {
										            $img = base_url().$itemch->profile_picture;
										          }

										          }
										          else
										          { 
										          $img =  base_url().'assets/images/default.png';}

										          ?>


												<img src="<?php echo $img; ?>" width="50" height="50" alt="<?php echo $itemch->fname; ?>">
												<!--</a>-->
												<!--<span class='user_status'><i class="fa fa-user"></i> <?php echo $itemch->user_type; ?></span>-->
											</div>
											<div class="comment_box coment-new">
												<span class="media_box">
													<?php
													
													if($itemch->forum_comment_file)
													{
													$path_parts = pathinfo($itemch->forum_comment_file);
													// print_r($path_parts);
													$extension=$path_parts['extension'];
													$basename=$path_parts['basename'];
													$filename=$path_parts['filename'];
													
													$file_type=array("gif"=>"1" ,"jpg"=>"1" ,"jpeg"=>"1" ,"png"=>"1" ,"bmp"=>"1" ,"GIF"=>"1" ,"JPG"=>"1" ,"PNG"=>"1" ,"JPEG"=>"1" ,"PDF"=>"2" , "pdf"=>"2" , "mp4"=>"3" ,"3gp"=>"3" ,"flv"=>"3" ,"mp3"=>"3" ,"wma"=>"3" ,"wmv"=>"3" ,"docx"=>"4" ,"doc"=>"4" ,"DOC"=>"4" , "DOCX"=>"4" ,"txt"=>"5");
													
													// $file_type=array("jpg"=>'1',"wmv"=>'2',"pdf"=>'3');
													$get_type_file=$file_type[$extension];
													
													if($get_type_file == 1){
													echo "<img class='comment_file' src='".base_url().'assets/editor_images/'.$basename."'>";
													} else if($get_type_file == 2){
													/*echo "<object data='".base_url().'assets/editor_images/'.$basename."' type='application/pdf' width='50%' height='100%'>
													<p>Alternative text - include a link <a href='".base_url().'assets/editor_images/'.$basename."'>to the PDF!</a></p>
													</object>";	 */
													echo "<a target='_blank' href='".base_url().'assets/editor_images/'.$basename."'><img class='file_icon' src='".base_url().'assets/images/pdf.png'."'></a>";
													} else if($get_type_file == 3){
													echo "<video width='320' height='240' controls>
														<source  src='".base_url().'assets/editor_images/'.$basename."' type='video/".$extension."'>
														<source src='".base_url().'assets/editor_images/'.$filename.".ogg' type='video/ogg'>
														Your browser does not support HTML5 video.
													</video>";
													}
												    else if($get_type_file == 4){
													echo "<a target='_blank' href='http://docs.google.com/gview?url=".base_url().'assets/editor_images/'.$basename."'><img class='file_icon' src='".base_url().'assets/images/docx.png'."'></a>";
													
												     
													}
													}
													?>
												</span>
												<div class="editComment-manage">
												<?php
												if($this->session->userdata('user_id')){
										             $userid=$this->session->userdata('user_id');
													 $user_id=$itemch->user_id;
													 if($userid == $user_id) {
												?>
												<p class="editComment">
													<a href="javascript:" data="<?php echo $itemch->forum_comment_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $itemch->forum_comment_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</p>
												<?php } } ?>
												<div class="abuse-tag single-forum-ubuse"><a href="javascript:void(0)" class="abuse-cls" id="abuse_<?php echo $itemch->forum_comment_id; ?>" title="Abuse"  page_url="<?php echo 'forum/'.$this->uri->segment(2).'/'.$this->uri->segment(3);?>"  f_que_id="<?php echo $itemch->forum_comment_id; ?>" forum_title="<?php echo $single->forum_ques_title; ?>" ><img src="<?php echo base_url();?>assets/images/Loud_Speaker.png" style="width: 30px;height: 30px;" title="abuse"/></a></div>
												</div>
												<p><div class="comment_text"><?php echo $itemch->forum_comment_description; ?></div></p>
											</div>
											<div class="reply_section">
												<ul>
													<li><h5><strong>By </strong><?php echo $itemch->fname; ?></h5></li>
													<li><h5><strong>Date </strong>
													<?php if(isset($itemch->cmdate)){ $date = date_create($itemch->cmdate); echo date_format($date, 'd M Y h:i A');}?>
													<?php //echo date_format(date_create($itemch->cmdate), 'd F, Y H:i:s');
													?></h5></li>
													<li><h5><a href="javascript:" id="<?php echo $itemch->forum_comment_id; ?>" class="commentLike like<?php echo $itemch->comment_like_me;?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i> like(<span class="topicGridlike"><?php echo $itemch->comment_likes; ?></span>)</a></h5></li>
													<li class="pull-right"><?php  if($this->session->userdata('user_id')){ ?>
														<button class="replay-btn" id="post-1"><i class="fa fa-reply"></i> Reply</button>
														<?php } else{ ?>
														<button class="notLogin dftreply" id="post-1"><i class="fa fa-reply"></i> Reply</button>
													<?php } ?></li>
												</ul>
												<div class="replay-div-con" style="display: none;">
													<form class="comment_form23 form-horizontal" action="<?php echo base_url().'frontEnd/forum/comment'; ?>" method="POST" enctype="multipart/form-data">
														<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
														<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
														<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
														<input type="hidden" name="forum_comment_id" value="<?php echo $item->forum_comment_id; ?>">
														<textarea id="edit_<?php echo $itemch->forum_comment_id; ?>" class="editorComment1" name="forum_comment_description"></textarea>
														<div class="form-group" style="position: relative;">
															<!-- <label class="control-label image_label">Upload file </label> -->

															<a class='btn btn-primary' href='javascript:;' style="margin-left: 15px;margin-bottom: 10px;position: relative; border-radius: 5px;box-shadow: none;">
															<i class="fa fa-paperclip" aria-hidden="true"></i>
															<input type="file" style='position: absolute;z-index: 99999999;top: 0;left: 13px;filter: alpha(opacity=0);-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity: 0;background-color: transparent;color: transparent;height: 35px;width: 40px;' name="upload" size="40"  onchange='$("#upload-file-info_chil_<?php echo $itemch->forum_comment_id; ?>").html($(this).val());'>
															</a>
															&nbsp;
															<span class='label label-info' id="upload-file-info_chil_<?php echo $itemch->forum_comment_id; ?>"></span>

															
														</div>
														<div class="form-group">
															<!-- <label class="col-sm-6 control-label"></label> -->
															<div class="col-sm-6">
																<input type="Submit" class="reply-btn" value="Post Comment">
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									
									<?php }} ?>
								</div>
							</div>
						</div>
					</div>
					
					<?php }
					
					} else{
												
					}?>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-222">
						<?php echo $pagination; ?>
					</div>
				</div>
				
				
				<div class="forum-main-reply-sec">
					<div class="row">
						<div class="col-md-12">
							<?php
							$userId=$this->session->userdata('user_id');
							if(isset($userId)){
							?>
							<form action="<?php echo base_url().'frontEnd/forum/comment'; ?>" method="post" id="comment_form1" novalidate="novalidate" class="comment_form form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
									<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
									<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
									<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
									<div class="col-sm-12">
										<label id="myalert" for="comment">Reply to the thread</label>
									</div>
									
									<section class="sdk-container">
										<div class="xtrafield"><input id="xtrafieldnpt" value="" type="text" name="xtrafieldnpt">
									</div>
									<section class="sdk-contents">
										
										<div class="columns" data-sample="1">
											<div class="editor">
												<textarea id="forum_comment_description" placeholder="Enter enter comments" name="forum_comment_description" >
												
												</textarea>
											</div>
											<div class="contacts">
												<div class="right_smiley mCustomScrollbar">	<h3>Drag and Drop</h3>
												<ul id="contactList"></ul>
											</div>
											<!-- <div class="redmore_box"><a href="javascript:" id="readmore">more</a></div> -->
										</div>
									</div>
								</section>
							</section>
						</div>
						
						<div class="form-group upld-file">
							<?php /*?><label class="col-sm-12">Upload file </label><?php */?>
							<div class="col-sm-8">
								
								<a class='btn btn-primary' href='javascript:;' style="border-radius: 5px;box-shadow: none;">
										<i class="fa fa-paperclip" aria-hidden="true"></i>
										<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
									</a>
									<span class='label label-info' id="upload-file-info"></span>
								
							</div>
						
						</div>
						
						<div class="form-group">
							
							<div id="button-reply"  class="col-sm-3">
								
								<input type="submit" class="btn btn-default" name="submit" value="Post">
							</div>
							<div class="col-sm-9">
								
							</div>
						</div>
					</form>
					
					<?php } else { ?>
					<div class="form-group">
						<div id="myalert"></div>
						<div class="main_login">
							<a href="javascript:" class="notLogin"><i class="fa fa-comments" aria-hidden="true"></i> Post your comments</a>
						</div>
						
					</div>
					
					<?php  }?>
					
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">

			<div class="forum-google-ad">
		    <div class="google-ad" style="width: 100% !important;">
		         <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'Forum Details'));
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
<div class="fo-links">
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
		<div class="fo-links">
			<h3>Newest Topics</h3>
			<ul>
				<?php
				if(!empty($popularforumQuestion)) {
				foreach($popularforumQuestion AS $item) { ?>
				<li><a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>"><?php echo $item->forum_ques_title; ?></a></li>
				<?php } }else{
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
<?php $this->load->view('include/main_footer'); ?>
</footer>
<div class="copy-right">
<?php $this->load->view('include/copyright'); ?>
</div>
</body>
</html>

<div class="modal fade comment-edit-frm" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Edit comment</h4>
</div>
<div class="modal-body">

<form class="comment_form23 form-horizontal" id="comment_form2" action="<?php echo base_url().'frontEnd/forum/comment_update'; ?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
<input type="hidden" id="forum_comment_id" name="forum_comment_id" value="">
<textarea id="returnComment" name="returnComment"></textarea>

<div class="form-group">
	<!-- <label class="col-sm-12 control-label image_label">Upload file</label> -->
	<div class="col-sm-12">
		<!--input type="file" name="upload" value="" placeholder="Required Field" class="form-control" -->
		<div class="uplod-file-btn" style="position:relative;">
			<!-- <a class='btn btn-primary' href='javascript:;'>
				Choose File...
				<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info2").html($(this).val());'>
			</a> -->
			<a class='btn btn-primary' href='javascript:;' style="position: relative;    border-radius: 5px;box-shadow: none; ">
				<i class="fa fa-paperclip" aria-hidden="true"></i>
				<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
			</a>
			&nbsp;
			<span class='label label-info' id="upload-file-info2"></span>
		</div>
		
		<div class="media_output"></div>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-9">
		<input type="Submit" class="reply-btn" value="Post Comment">
	</div>
</div>

</form>

<input type="hidden" id="last_get_url_link1" value="">
</div>

</div>

</div>
</div>
<div class="modal fade comment-edit-frm" id="myModalAbuse" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Abuse Topic <!-- (<span id="abuse-topic-name"></span>) --></h4>
			</div>
			<div class="modal-body">
				 <form class="comment_form23 form-horizontal edit-topic-modl" id="Sign-Up-form1" action="<?php echo base_url().'frontEnd/Forum/abuse_forum';?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="f_que_id" id="f_que_id" value="">
					
					<input name="forum_url" id="forum_url"  type="hidden">
					<input name="forum_type" id="forum_type"  type="hidden" value="Reply">
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


<div class="modal fade comment-edit-frm" id="myModal12" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Topic</h4>
			</div>
			<div class="modal-body">
				<form class="comment_form23 form-horizontal edit-topic-modl" id="Sign-Up-form1" action="<?php echo base_url().'forum_topic_add';?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
					<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="forum_ques_id" id="forum_ques_id12" value="">
					<input name="forum_cat_url" value="<?php echo $this->uri->segment(2); ?>" type="hidden">
					<div class="form-group">
						<label class="col-lg-12 control-label">Topic title:</label>
						<div class="col-lg-12">
							<input class="form-control edit_ques_title"  name="forum_ques_title" id="forum_ques_title" value="<?php echo $single->forum_ques_title; ?>" type="text" style="color:#000">
							<span style="color:red" class="view_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-12 control-label"><strong>Description:</strong></label>
						<div class="col-lg-12">
							<textarea   name="forum_ques_description" id="returnComment12" class="control-label"><?php echo $single->forum_ques_description; ?>
							</textarea>
						</div>
					</div>

<a class='btn btn-primary'  style="margin-bottom: 8px;position: relative;position: relative;    border-radius: 5px;box-shadow: none; ">
<i class="fa fa-paperclip" aria-hidden="true"></i>
<input type="file"  style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info").html($(this).val());' name="upload" size="40" >
</a>
					<div class="form-group">

						<div class="col-sm-9">
							<input type="Submit" class="reply-btn" id="topicsubmit" value="Update Topic">
						</div>
					</div>
				</form>
				<input type="hidden" id="last_get_url_link1" value="">
			</div>
		</div>
		
	</div>
</div>


<script>
$('.edit_ques_title').on("keyup",function(){
var title=$(this).val();
var formAction="<?php echo base_url();?>frontEnd/forum/Already_exit_post_title";
var id = $("#forum_ques_id12").val();
 $.ajax({
	url : formAction,
	type : "POST",
	dataType:"text",
	data : "title="+title+"&id="+id,
	success:function(data) 
	{    
		 if(data==1){
			  $(".view_error").html('This is already exist');
			  $("#topicsubmit").attr("disabled", true);  
		  }else{
		  $(".view_error").html('');
		  $("#topicsubmit").attr("disabled", false); 
		  }
    }
 });
});
</script>

<script>
$(document).ready(function(){
CKEDITOR.replace( 'returnComment', {
	extraPlugins: 'image2,embed,autoembed,uploadwidget,uploadimage,image2,hcard,justify,smiley,pastefromword,link,autolink,adobeair,notification',
	height: 250,
	filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
} );


CKEDITOR.replace( 'returnComment12', {
	height: 250,
	filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
});	

$(".edit_comment_popup12").click(function(e){
	//var data_id= $(this).attr("data");
	$("#forum_ques_id12").val($(this).attr("data"));
	 e.preventDefault();
	 var comment_text=$("#returnComment12").val();
   
	CKEDITOR.instances.returnComment12.setData(comment_text);
	//alert(edit_ques_title);
	//$(".edit_ques_title").val(edit_ques_title);
    $("#myModal12").modal('show');
});

$(".edit_comment_popup").click(function(e){
//var data_id= $(this).attr("data");
$("#forum_comment_id").val($(this).attr("data"));
e.preventDefault();
var media_box=$(this).parent().parent(".comment_box").find('.media_box').html();
var comment_text=$(this).parent().parent(".comment_box").find('.comment_text').html();
//  alert(comment_text);
CKEDITOR.instances.returnComment.setData( comment_text );
//alert(media_box);
$(".media_output").html(media_box);
$("#myModal").modal('show');



});


});
</script>

<!--
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<script src="<?php echo base_url().'assets/js'; ?>/summernote.js"></script>
-->
<script src="<?php echo base_url();?>assets/js/validate.js"></script>

<script>
$(document).ready(function() {
/*
$('#summernote1').summernote({
toolbar: [
// [groupName, [list of button]]
['style', ['bold', 'italic', 'underline', 'clear']],
['font', ['strikethrough', 'superscript', 'subscript']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']]
],
height:240,
callbacks: {
onEnter:function(){}
}
});
// summernote.keydown
$('#summernote1').on('summernote.keyup', function(we, e) {
var markupStr = $('#summernote1').summernote('code');
$("#summernote1").html(markupStr);
$("#xtrafieldnpt").val(markupStr);
});
*/
// for not login
$(".notLogin").click(function(){
	
	$("#myalert").html('<div class="alert alert-danger message-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please login first!</div>');
			$("html, body").animate({ scrollTop: $(document).height() }, 2000);
});
});
</script>

<script src="<?php echo base_url();?>assets/js/validate.js"></script>
<script type="text/javascript">
// When the browser is ready...
$(function() {
$("#comment_form1").validate({
		// Specify the validation rules
		rules: {
	forum_comment_description: "required",
	xtrafieldnpt: "required"
},
// Specify the validation error messages
				messages: {
				forum_comment_description: "Please enter your comment",
				xtrafieldnpt: "Please enter your comment"
},
submitHandler: function(form) {
		form.submit();
	return false;
}
});
$("#comment_form2").validate({
		// Specify the validation rules
		rules: {
	forum_comment_description: "required",
	xtrafieldnpt: "required"
},
// Specify the validation error messages
				messages: {
				forum_comment_description: "Please enter your comment",
				xtrafieldnpt: "Please enter your comment"
},
submitHandler: function(form) {
		form.submit();
	return false;
	
}
});
// like code
$(".forum-main-user-comments").on("click", '.commentLike', function(event){
	
	
	var forum_comment_id=$(this).attr("id");
	var forum_ques_id=$("#forum_ques_id").val();
	var forum_cat_id=$("#forum_cat_id").val();
	$.ajax({
		type:'POST',
			dataType : 'json',
url:"<?php echo base_url().'forumlike'; ?>",
data : 'forum_ques_id='+forum_ques_id+'&forum_cat_id='+forum_cat_id+'&forum_comment_id='+forum_comment_id,
success:function(data){
//	alert(data);

if(data.code=='200'){

$(".topicTotallike").text(data.total);
$('#'+forum_comment_id).html("<i class='fa fa-thumbs-up' aria-hidden='true'></i> like(<span class='topicGridlike'>"+data.commlike+"</span>)").addClass('like1');


}
else if(data.code=='300'){

$(".topicTotallike").text(data.total);
$('#'+forum_comment_id).html("<i class='fa fa-thumbs-down' aria-hidden='true'></i> unlike(<span class='topicGridlike'>"+data.commlike+"</span>)").addClass('like1');


}
else if(data.code=='400'){

$("#myalert").html('<div class="alert alert-danger message-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'+data.msg+'</div>');
$("html, body").animate({ scrollTop: $(document).height() }, 2000);
}


}
});
event.preventDefault();
});



// like code
$(".commentLike12").on("click", function(event){
	
	var forum_comment_id=$(this).attr("id");
	var forum_ques_id=$("#forum_ques_id").val();
	var forum_cat_id=$("#forum_cat_id").val();
	$.ajax({
		type:'POST',
			dataType : 'json',
url:"<?php echo base_url().'frontEnd/forum/forum_topic_like'; ?>",
data : 'forum_ques_id='+forum_ques_id+'&forum_cat_id='+forum_cat_id,
success:function(data){
//	alert(data);

if(data.code=='200'){

$(".topicTotallike").text(data.total);
$('#'+forum_comment_id).html("<i class='fa fa-thumbs-up' aria-hidden='true'></i> like(<span class='topicGridlike'>"+data.total+"</span>)").addClass('like1');


}
else if(data.code=='300'){

$(".topicTotallike").text(data.total);
$('#'+forum_comment_id).html("<i class='fa fa-thumbs-down' aria-hidden='true'></i> unlike(<span class='topicGridlike'>"+data.total+"</span>)").addClass('like1');


}
else if(data.code=='400'){

$("#myalert").html('<div class="alert alert-danger message-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'+data.msg+'</div>');
$("html, body").animate({ scrollTop: $(document).height() }, 2000);
}
}
});
event.preventDefault();
});



});
</script>
<!-- <link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script> -->

<style>
input#xtrafieldnpt {
width: 0px;
height: 0px;
border: 0px;
}

.right_smiley{
height:342px;
overflow:auto;
}
.contacts_full{
height:342px;
overflow-y: scroll;
}
.xtrafield {
position: absolute;
left: 25px;
}
</style>
<script>
$(document).ready(function(){
/*$("#readmore").click(function(){
$('.right_smiley').toggleClass('contacts_full');
});*/
});
</script>
<script>
	'use strict';
		var CONTACTS = [
		<?php $query11 = $this->db->query("select * from emoticons");
		$result11 = $query11->result();
		if(isset($result11)) {
		foreach ($result11 as $r) { ?>
		{  avatar: '<?php  echo str_replace(".png","",$r->name); ?>' },
		<?php } } ?>];
	// Implements a simple widget that represents contact details (see http://microformats.org/wiki/h-card).
	CKEDITOR.plugins.add( 'hcard', {
		requires: 'widget',
		init: function( editor ) {
			editor.widgets.add( 'hcard', {
				allowedContent: 'span(!h-card); a[href](!u-email,!p-name); span(!p-tel)',
				requiredContent: 'span(h-card)',
				pathName: 'hcard',
				upcast: function( el ) {
					return el.name == 'span' && el.hasClass( 'h-card' );
				}
			} );
			// This feature does not have a button, so it needs to be registered manually.
			editor.addFeature( editor.widgets.registered.hcard );
			// Handle dropping a contact by transforming the contact object into HTML.
			// Note: All pasted and dropped content is handled in one event - editor#paste.
			editor.on( 'paste', function( evt ) {
				var contact = evt.data.dataTransfer.getData( 'contact' );
				if ( !contact ) {
					return;
				}
// view smiley
				evt.data.dataValue =
					'<span class="h-card">' +
'<img src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/draganddrop/img/' + contact.avatar + '.png" alt="avatar" class="u-photo" /></span>';
} );
}
} );
CKEDITOR.on( 'instanceReady', function() {
// When an item in the contact list is dragged, copy its data into the drag and drop data transfer.
// This data is later read by the editor#paste listener in the hcard plugin defined above.
CKEDITOR.document.getById( 'contactList' ).on( 'dragstart', function( evt ) {
// The target may be some element inside the draggable div (e.g. the image), so get the div.h-card.
var target = evt.data.getTarget().getAscendant( 'div', true );
// Initialization of the CKEditor data transfer facade is a necessary step to extend and unify native
// browser capabilities. For instance, Internet Explorer does not support any other data type than 'text' and 'URL'.
// Note: evt is an instance of CKEDITOR.dom.event, not a native event.
CKEDITOR.plugins.clipboard.initDragDataTransfer( evt );
var dataTransfer = evt.data.dataTransfer;
// Pass an object with contact details. Based on it, the editor#paste listener in the hcard plugin
// will create the HTML code to be inserted into the editor. You could set 'text/html' here as well, but:
// * It is a more elegant and logical solution that this logic is kept in the hcard plugin.
// * You do not know now where the content will be dropped and the HTML to be inserted
// might vary depending on the drop target.
dataTransfer.setData( 'contact', CONTACTS[ target.data( 'contact' ) ] );
// You need to set some normal data types to backup values for two reasons:
// * In some browsers this is necessary to enable drag and drop into text in the editor.
// * The content may be dropped in another place than the editor.
dataTransfer.setData( 'text/html', target.getText() );
// You can still access and use the native dataTransfer - e.g. to set the drag image.
// Note: IEs do not support this method... :(.
if ( dataTransfer.$.setDragImage ) {
dataTransfer.$.setDragImage( target.findOne( 'img' ).$, 0, 0 );
}
} );
} );

// Initialize the editor with the hcard plugin.
CKEDITOR.replace( 'forum_comment_description', {
extraPlugins: 'image2,embed,autoembed,uploadwidget,uploadimage,image2,hcard,justify,smiley,pastefromword,link,autolink,adobeair,notification',
height: 250,
filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
} );
var e = CKEditor.instances['forum_comment_description'];
editor.once( 'instanceReady', function() {
// Create and show the notification.
var notification1 = new CKEDITOR.plugins.notification( editor, {
message: 'Error occurred',
type: 'warning'
} );
notification1.show();
// Use shortcut - it has the same result as above.
var notification2 = editor.showNotification( 'Error occurred', 'warning' );
} );

</script>

<script>

	'use strict';
	addItems(
		CKEDITOR.document.getById( 'contactList' ),
		new CKEDITOR.template(
			'<div class="contact h-card" data-contact="{id}">' +
'<img src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/draganddrop/img/{avatar}.png" alt="avatar" class="u-photo" /> </div>'
),
CONTACTS
);
function addItems( listElement, template, items ) {
for ( var i = 0, draggable, item; i < items.length; i++ ) {
item = new CKEDITOR.dom.element( 'li' );
draggable = CKEDITOR.dom.element.createFromHtml(
template.output( {
id: i,
name: items[ i ].name,
avatar: items[ i ].avatar
} )
);
draggable.setAttributes( {
draggable: 'true',
tabindex: '0'
} );
item.append( draggable );
listElement.append( item );
}
}


</script>


<script>
CKEDITOR.instances.forum_comment_description.on('change', function() {
var value = CKEDITOR.instances['forum_comment_description'].getData();
$("#xtrafieldnpt").val(value);
$("#forum_comment_description").val(value);
});
CKEDITOR.instances.forum_comment_description.on('contentDom', function() {
CKEDITOR.instances.forum_comment_description.document.on('keyup', function() {

var value = CKEDITOR.instances['forum_comment_description'].getData();
///var edt=$('#editor2').getData();
$("#xtrafieldnpt").val(value);
$("#forum_comment_description").val(value);
// event.preventDefault();



//url to match in the text field
var match_url = /\b(https?):\/\/([\-A-Z0-9.]+)(\/[\-A-Z0-9+&@#\/%=~_|!:,.;]*)?(\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/i;

//returns true and continue if matched url is found in text field
if (match_url.test(value)) {
	$("#results").hide();
	$("#loading_indicator").show(); //show loading indicator image
	
	var extracted_url = value.match(match_url)[0]; //extracted first url from text filed

	//alert(extracted_url);
var Post_url="<?php echo base_url().'frontEnd/extracturl_content_like_facebook/index'; ?>";


//ajax request to be sent to extract-process.php
$.post(Post_url,{'url': extracted_url}, function(data){

extracted_images = data.images;
total_images = parseInt(data.images.length-1);
img_arr_pos = total_images;

if(total_images>0){
inc_image = '<div class="extracted_thumb" id="extracted_thumb"><img src="'+data.images[img_arr_pos]+'" width="400" height="200"></div>';
}else{
inc_image ='';
}
//content to be loaded in #results element
var content = '<div class="extracted_url">'+ inc_image +'<div class="extracted_content"><h4><a href="'+extracted_url+'" target="_blank">'+data.title+'</a></h4><p>'+data.content+'</p><div class="thumb_sel"></div></div>';
//CKEDITOR.instances.editor1.append(content);
var old_data = CKEDITOR.instances['forum_comment_description'].getData();
last_get_url_link=$("#last_get_url_link").val();
if(data.get_url != last_get_url_link){
$("#last_get_url_link").val(data.get_url);
CKEDITOR.instances['forum_comment_description'].setData(old_data+''+ content);
}
//load results in the element
//$("#results").html(content); //append received data into the element
//$("#results").slideDown(); //show results with slide down effect
$("#loading_indicator").hide(); //hide loading indicator image
},'json');

} else{ $("#last_get_url_link").val(''); }

});

});

CKEDITOR.replaceAll('editorComment');
CKEDITOR.replaceAll('editorComment1');

</script>

<script type="text/javascript">
$(document).ready(function(){

$(".post-tag").on("click", ".replay-btn", function(){

var textClass=$(this).parent().parent().parent().find(".replay-div-con");
textClass.fadeToggle("slow");
$('.replay-div-con').not(textClass).hide();
});

// delete forum comments
$('.cat_image_remove').on("click", function(){

var check = confirm("Are you sure you want to delete?");
if (check == true) {
var image_id=$(this).attr("data");
var items=$(this).attr("items");

if(items =='0'){
$(this).parent().parent().parent().parent('.row').remove();
} else{
	$(this).parent().parent().parent().parent().parent('.row').remove();
}


var formAction="<?php echo base_url().'frontEnd/forum/delete_comment'; ?>";
$.ajax({
url : formAction,
type : "POST",
dataType:"text",
data : "image_id="+image_id,
success:function(data)
{
location.reload();
}
});
}
else {
return false;
}
});


$('.cat_image_remove12').on("click", function(){
	var check = confirm("Are you sure you want to delete?");
	if (check == true) {
		var image_id=$(this).attr("data");
		var items=$(this).attr("items");
		$(this).parent().parent().parent('forum_sub_sub').remove();
		var formAction="<?php echo base_url().'frontEnd/forum/delete_topic'; ?>";
		$.ajax({		
			url : formAction,
			type : "POST",
			dataType:"text",
			data : "image_id="+image_id,
			success:function(data) 
			{    
			 window.location.href = '<?php echo base_url()."forum/".$this->uri->segment(2); ?>';
			//location.reload();
			}
		});
	}
	else {
    	return false;   
	}

	});

});

</script>
<input type="hidden" id="last_get_url_link" value="">

<script type="text/javascript">
$(document).ready(function() {
	var getUrl  = $('#returnComment'); //url to extract from text field
	CKEDITOR.instances.returnComment.on('contentDom', function() {
    CKEDITOR.instances.returnComment.document.on('keyup', function(e) {
	var value = CKEDITOR.instances['returnComment'].getData();
	//url to match in the text field
	var match_url = /\b(https?):\/\/([\-A-Z0-9.]+)(\/[\-A-Z0-9+&@#\/%=~_|!:,.;]*)?(\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/i;
	
	//returns true and continue if matched url is found in text field
	if (match_url.test(value)) {
			$("#results").hide();
			$("#loading_indicator").show(); //show loading indicator image
			
			var extracted_url = value.match(match_url)[0]; //extracted first url from text filed
		
			//alert(extracted_url);
			var Post_url="<?php echo base_url().'frontEnd/extracturl_content_like_facebook/index'; ?>";


			//ajax request to be sent to extract-process.php
			$.post(Post_url,{'url': extracted_url}, function(data){

			extracted_images = data.images;
			total_images = parseInt(data.images.length-1);
			img_arr_pos = total_images;

			if(total_images>0){
			inc_image = '<div class="extracted_thumb" id="extracted_thumb"><img src="'+data.images[img_arr_pos]+'" width="400" height="200"></div>';
			}else{
			inc_image ='';
			}
			//content to be loaded in #results element
			var content = '<div class="extracted_url">'+ inc_image +'<div class="extracted_content"><h4><a href="'+extracted_url+'" target="_blank">'+data.title+'</a></h4><p>'+data.content+'</p><div class="thumb_sel"></div></div>';
			//CKEDITOR.instances.editor1.append(content);
			var old_data = CKEDITOR.instances['returnComment'].getData();
			last_get_url_link=$("#last_get_url_link1").val();
			if(data.get_url != last_get_url_link){
			$("#last_get_url_link1").val(data.get_url);
			CKEDITOR.instances['returnComment'].setData(old_data+''+ content);
			}
			//load results in the element
			//$("#results").html(content); //append received data into the element
			//$("#results").slideDown(); //show results with slide down effect
			$("#loading_indicator").hide(); //hide loading indicator image
			},'json');

			} else{ $("#last_get_url_link").val(''); }

			e.preventDefault();

			});
		});

});
</script>


<script>
$(document).ready(function() {
	
	var forum_ques_id=$("#forum_ques_id").val();
	var forum_cat_id=$("#forum_cat_id").val();
	
    $('.subcribe_btn').click(function() {
		var subcribe=$('.subcribe_btn').attr('alt');
		 $.ajax({
		    type:'POST',
			dataType : 'text',
            url:"<?php echo base_url().'frontEnd/forum/subscribe'; ?>",			
            data : 'forum_ques_id='+forum_ques_id+'&forum_cat_id='+forum_cat_id+'&subcribe='+subcribe,		
		 success:function(data){	
		location.reload();
	        if(data == 'not') {
		//$('.count-sbscrb').text(data);
	        
			} else{
				$('.count-sbscrb').text(data);
				//$(this).closest('.scrcbn-box').find("div#cbscrb-btn").hide();
			  //$(this).closest('.scrcbn-box').find("div#cbscrb-btn-chng").show();
			 $("#cbscrb-btn").hide();
			  $("#cbscrb-btn-chng").show();
			}
		 } 
		 
		 });
		   
    });
	$('.unsubcribe_btn').click(function() {
		
		var subcribe=$('.unsubcribe_btn').attr('alt');
		 $.ajax({
		    type:'POST',
			dataType : 'text',
            url:"<?php echo base_url().'frontEnd/forum/subscribe'; ?>",			
            data : 'forum_ques_id='+forum_ques_id+'&forum_cat_id='+forum_cat_id+'&subcribe='+subcribe,		
		 success:function(data){	
		location.reload();
		//$('.count-sbscrb').text(data);
	       
		 } 
		   
          });
		   $(this).closest('.scrcbn-box').find("div#cbscrb-btn-chng").hide();
			$(this).closest('.scrcbn-box').find("div#cbscrb-btn").show();
   });
});
  /* $('.abuse-cls').click(function() {

     	var ubuse = $(this).attr('id').split("_");
     	var id = ubuse[1];
     	var forum_type = 'Reply';
     	var topic_name = "<?php echo $single->forum_ques_title; ?>";
        $.ajax({
	        type: 'POST',
	        url: "<?php echo base_url(); ?>frontEnd/forum/abuse_forum",
	        data:{id: id, forum_type: forum_type,topic_name:topic_name},
	        success: function(data){
	        	if(data ==1){
	        		location.reload();
	        	}
	        }
        });
        return false;
    });*/
    $('.abuse-cls').click(function() {
    	$("#myModalAbuse").modal('show');
    	$('#f_que_id').val($(this).attr('f_que_id'));
    	$('#forum_url').val($(this).attr('page_url'));
    	$('#forum_title').val($(this).attr('forum_title'));
    	/*$('#abuse-topic-name').text($(this).attr('forum_title'));*/
    });
$(document).ready(function(){
	CKEDITOR.replace( 'abuse_message', {
	height: 250,
	filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
	});

});
</script>