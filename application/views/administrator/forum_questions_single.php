<?php $this->load->view('administrator/include/left_sidebar'); ?>
<!-- ckeditor css& js -->
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<link href="<?php echo base_url().'assets/'; ?>css/custom_style.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script>
<!-- ckeditor css& js -->
<style>

/*.editComment {
   width: 64px !important;
   
    padding: 0px 4px;
	
}
p.editTopic a {
		    background:none !important;
	       }
.cat_image_remove {
    top: 1px;
    right: 1px;
    width: 21px;
    height: 20px;
    color: #03a9f4 !important;
}
a.cat_image_remove {
    margin-right: 7px;
	   background:none !important;
}
.static-content-wrapper{    clear: both;
    padding-top: 50px;}

.sidebar nav.widget-body > ul.acc-menu li a {
    font-size: 12px;
}
*/
</style>

<div class="warper container-fluid">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default add-user-sec">
<div class="panel-heading">
	<h3><?php echo ucfirst(str_replace("-"," ",$this->uri->segment(3)));?></h3>
</div>
<div class="panel-body">
	
	<div id="responseMsg"></div>
	<?php msg_alert(); ?>
	
	<div data-widget-group="group1">
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel-body no-padding">
					
					<?php
								$flag3=0;
								$flag=0;
								$flag1=0;
								$flag2=0;
								$flag4=0;
								if (isset($checkpers)) {
								foreach ($checkpers as $checkper) {
								
								if (($checkper->permission_id == 17) && ($checkper->view_permission==1)) {
								$flag3= 1;
								}
								if (($checkper->permission_id == 28) && ($checkper->view_permission==1)) {
								$flag4= 1;
								}
								if (($checkper->permission_id == 28) && ($checkper->add_permission==1)) {
								$flag= 1;
								}
								if (($checkper->permission_id == 28) && ($checkper->edit_permission==1)) {
								$flag1= 1;
								}
								if (($checkper->permission_id == 28) && ($checkper->delete_permission==1)) {
								$flag2= 1;
								}
								
								}
								}
								
					if ($flag3 == 1 || $u_id==1) {  ?>
					<div class="forum-main-ques-single">
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
									<h3><?php echo $single->forum_ques_title; ?></h3>
									<div class="forum-que-fmtt-text">
										<?php echo $single->forum_ques_description; ?>
									</div>
								</div>
								<div class="post-tag single-user">
									<div class="fo_text">
										<div class="reply_section">
											<ul>
												<li><h5><strong>By </strong><?php echo $single->fname; ?></h5></li>
												
												<li><h5><strong>Date </strong><?php if(isset($single->date)){ $date = date_create($single->date); echo date_format($date, 'd M Y h:i A');}?></h5></li>
												<li><h5> <span><i class="fa fa-eye" aria-hidden="true"></i></span><span class="topicTotalcomments"> <?php echo $total_view; ?></span></h5></li>
												<li><h5> <span><i class="fa fa-comments" aria-hidden="true"></i></span><span class="topicTotalcomments"> <?php echo $totalcomment; ?></span></h5></li>
												<li> <span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span><span class="topicTotallike">  <?php echo $totallike;?></span></li>
												
												<li class="pull-right">
													<a href="<?php echo base_url().'administrator/forum/'.$this->uri->segment(3);?>" class="cat-link"><?php echo ucfirst(str_replace("-"," ",$this->uri->segment(3)));?></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if (($flag3 == 1 && $flag == 1) || $u_id==1 ) {  ?>
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
									
									
								</div>
								
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if ($flag2 == 1 || $flag == 1 || $u_id==1 || $flag4 == 1) {  ?>
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
						<div class="fmuc-sub">
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
											$img =  base_url().'assets/images/default.png';}
										?>
										<img src="<?php echo $img; ?>" width="50" height="50" alt="<?php echo $item->fname; ?>">
										
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
											<?php if ((($flag3 == 1) && ($flag == 1 || $flag1 == 1 || $flag2 == 1)) || $u_id==1 ) {  ?>
											<p class="editComment" style="top:1px !important">
												<?php if($flag1 == 1 || $u_id==1){ ?>
												<a href="javascript:" data="<?php echo $item->forum_comment_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<?php } ?>
												<?php if($flag2 == 1 || $u_id==1){ ?>
												<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $item->forum_comment_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												<?php } ?>
											</p>
											<?php } ?>
											
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
														<?php if($flag == 1 || $u_id == 1) {?>
														<button class="replay-btn" id="post-1"><i class="fa fa-reply"></i> Reply</button>
														<?php } ?>
														
													</li>
												</ul>
												<div class="replay-div-con" style="display: none;">
													<form class="comment_form form-horizontal" action="<?php echo base_url().'administrator/comment'; ?>" method="post" enctype="multipart/form-data">
														<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
														<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
														<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
														<input type="hidden" name="forum_comment_id" value="<?php echo $item->forum_comment_id; ?>">
														
														<textarea class="editorComment" id="edit_<?php echo $item->forum_comment_id; ?>" name="forum_comment_description"></textarea>
														
														<div class="form-group">
															<label class="col-sm-2 control-label image_label text-left">Upload file </label>
															<a class='btn btn-primary' href='javascript:void(0)'>
																<i class="fa fa-paperclip" aria-hidden="true"></i>
																<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info_<?php echo $item->forum_comment_id; ?>").html($(this).val());'>
															</a>
															
														</div>
														<div class="form-group"  style="margin-left: 18px;">
															<input type="Submit" class="reply-btn" value="Post Comment">
														</div>
													</form>
												</div>
											</div>
											<?php  if(!empty($item->child_comment)) {
											foreach($item->child_comment AS $itemch) { 	?>
											<div class="row">
												<div class="comment-main">
													<div class="profile_comment_id">
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
														
														<?php if ((($flag3 == 1) && ($flag == 1 || $flag1 == 1 || $flag2 == 1)) || $u_id==1 ) {  ?>
														<p class="editComment">
															<?php if($flag1 == 1 || $u_id==1){ ?>
															<a href="javascript:" data="<?php echo $itemch->forum_comment_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
															<?php } ?>
															<?php if($flag2 == 1 || $u_id==1){ ?>
															<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $itemch->forum_comment_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
															<?php } ?>
														</p>
														<?php } ?>
														
														<p><div class="comment_text"><?php echo $itemch->forum_comment_description; ?></div></p>
													</div>
													<div class="reply_section">
														<ul>
															<li><h5><strong>By </strong><?php echo $itemch->fname; ?></h5></li>
															<li><h5><strong>Date </strong>
																<?php if(isset($itemch->cmdate)){ $date = date_create($itemch->cmdate); echo date_format($date, 'd M Y h:i A');}?>
																<?php
																					// echo date_format(date_create($itemch->cmdate), 'd F, Y H:i:s');
															?></h5></li>
															<li><h5><a href="javascript:" id="<?php echo $itemch->forum_comment_id; ?>" class="commentLike like<?php echo $itemch->comment_like_me;?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i> like(<span class="topicGridlike"><?php echo $itemch->comment_likes; ?></span>)</a></h5></li>
															<li class="pull-right">
																<?php if($flag == 1 || $u_id == 1) {?>
																<button class="replay-btn" id="post-1"><i class="fa fa-reply"></i> Reply</button>
																<?php } ?>
																
															</li>
														</ul>
														<div class="replay-div-con" style="display: none;">
															<form class="comment_form23 form-horizontal" action="<?php echo base_url().'administrator/comment'; ?>" method="POST" enctype="multipart/form-data">
																<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
																<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
																<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
																<input type="hidden" name="forum_comment_id" value="<?php echo $item->forum_comment_id; ?>">
																<textarea id="edit_<?php echo $itemch->forum_comment_id; ?>" class="editorComment1" name="forum_comment_description"></textarea>
																<div class="form-group">
																	<label class="col-sm-3 control-label image_label">Upload file </label>
																	<div class="col-sm-9">
																		<!--input type="file" name="upload" value="" placeholder="Required Field" class="form-control" -->
																		<div class="uplod-file-btn" style="position:relative;">
																			<a class='btn btn-primary' href='javascript:;'>
																				Choose File...
																				<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info_chil_<?php echo $itemch->forum_comment_id; ?>").html($(this).val());'>
																			</a>
																			&nbsp;
																			<span class='label label-info' id="upload-file-info_chil_<?php echo $itemch->forum_comment_id; ?>"></span>
																		</div>
																		
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 control-label"></label>
																	<div class="col-sm-9">
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
						<?php } ?>
						
						<?php if (($flag3 == 1 && $flag == 1) || $u_id==1 ) {  ?>
						<div class="forum-main-reply-sec">
							<div class="row">
								<div class="col-md-12">
									<form action="<?php echo base_url().'administrator/comment'; ?>" method="post" id="comment_form1" novalidate="novalidate" class="comment_form form-horizontal" enctype="multipart/form-data">
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
														<textarea id="forum_comment_description" placeholder="Enter enter comments" name="forum_comment_description" ></textarea>
													</div>
													<div class="contacts">
														<div class="right_smiley">	<h3>Drag and Drop</h3>
														<ul id="contactList"></ul>
													</div>
													<div class="redmore_box">	<a href="javascript:" id="readmore">more</a></div>
												</div>
											</div>
										</section>
									</section>
								</div>
								
								<div class="form-group upld-file">
									<div class="col-sm-8">
										<div class="uplod-file-btn" style="position:relative;">
											<a class='btn btn-primary' href='javascript:;'>
												Choose File...
												<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
											</a>
											&nbsp;
											<span class='label label-info' id="upload-file-info"></span>
										</div>
									</div>
									<div class="col-md-4">
										<sup>*</sup>image,video(mp4),pdf,docx
									</div>
								</div>
								
								<div class="form-group">
									<?php /*?><label class="col-sm-3 control-label"></label><?php */?>
									<div id="button-reply"  class="col-sm-3">
										
										<input type="submit" class="btn btn-default" name="submit" value="Comment">
									</div>
									<div class="col-sm-9">
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
<!-- Warper Ends Here (working area) -->



<div class="modal fade comment-edit-frm" id="myModal" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit comment</h4>
			</div>
			<div class="modal-body">
				
				<form class="comment_form23 form-horizontal" id="comment_form2" action="<?php echo base_url().'administrator/comment_update'; ?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="forum_cat_id" value="<?php echo $single->forum_cat_id; ?>">
					<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="forum_ques_id" value="<?php echo $single->forum_ques_id; ?>">
					<input type="hidden" id="forum_comment_id" name="forum_comment_id" value="">
					<textarea id="returnComment" name="returnComment"></textarea>
					
					<div class="form-group">
						<label class="col-sm-12 control-label image_label">Upload file <sup>*</sup>image,video(mp4),pdf,docx</label>
						<div class="col-sm-12">
							<!--input type="file" name="upload" value="" placeholder="Required Field" class="form-control" -->
							<div class="uplod-file-btn" style="position:relative;">
								<a class='btn btn-primary' href='javascript:;'>
									Choose File...
									<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info2").html($(this).val());'>
								</a>
								&nbsp;
								<span class='label label-info' id="upload-file-info2"></span>
							</div>
							
							<div class="media_output"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
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
<script>
$(document).ready(function(){
	//alert(1)
	CKEDITOR.replace( 'returnComment', {
					extraPlugins: 'image2,embed,autoembed,uploadwidget,uploadimage,image2,hcard,justify,smiley,pastefromword,link,autolink,adobeair,notification',
					height: 250,
					filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
				} );	
	
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
<!--   <script src="<?php echo base_url();?>assets/js/validate.js"></script> -->
  
  <script>
    $(document).ready(function() {
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
            url:"<?php echo base_url().'administrator/forumlike'; ?>",			
            data : 'forum_ques_id='+forum_ques_id+'&forum_cat_id='+forum_cat_id+'&forum_comment_id='+forum_comment_id,		
            success:function(data){	
		//	alert(data);
			 
		 if(data.code=='200'){
				  
		  $(".topicTotallike").text(data.total);
			$('#'+forum_comment_id).html("<i class='fa fa-thumbs-up' aria-hidden='true'></i> like(<span class='topicGridlike'>"+data.commlike+"</span>)").addClass('like1');
    
        
		 }else if(data.code=='300'){
				  
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


});


</script>





	<style>
	input#xtrafieldnpt {
    width: 0px;
    height: 0px;   
	border: 0px;
}
	
.right_smiley{
height:342px; 
 overflow: hidden;
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
    $("#readmore").click(function(){
    $('.right_smiley').toggleClass('contacts_full');  

    });
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
		
	
	var formAction="<?php echo base_url().'administrator/Forum/delete_comment'; ?>";
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

<script data-sample="2">
	CKEDITOR.replace( 'texteditor10', {
					height: 250,
					filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
				});					
</script>