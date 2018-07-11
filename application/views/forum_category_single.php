<?php
$query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=17 AND tbl_user_assign_permission.user_id =".$this->session->userdata('user_id')."");
$userType = $query->row();

$this->load->view('include/header_css');?>
<!-- ckeditor css& js -->
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script>
<!-- ckeditor css& js -->
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
<div class="container-fluid">
<div class="row">
	<div class="parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url().'/assets/category_images/large/'.$category->forum_cat_image; ?>" ></div>
</div>
</div>
</div>
<div class="main-sec-forum-list">
<section class="forum_main">
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<?php msg_alert(); ?>
			<div id="myalert"></div>
			<div class="main-forum-list-page">
				<div class="main-heading-forum-list">
					<div class="row">
						<div class="col-md-12">
							<div class="forum-list-head-main">
								<h3><?php echo $category->forum_cat_name; ?><!--Topics--></h3>
							</div>
							<div class="forum-category-description"><?php echo $category->category_description; ?></div>
						</div>
						<div class="col-md-12">
							<div class="question_tab">
								<?php
								$userId=$this->session->userdata('user_id');
								if(isset($userId)){	?>
								<a class="minus-square" <?php if(isset($_GET['start_new_topic'])){ ?> style="display: block; float: right; width: 100px;" <?php }else{ ?> style="display: none;" <?php } ?>>
								<i class="fa fa-minus-square" aria-hidden="true"></i> Add topic</a>
								<a class="plus-square" <?php if(isset($_GET['start_new_topic'])){ ?> style="display: none;" <?php }else{ ?> style="display: block;float: right; width: 100px;" <?php } ?> ><i class="fa fa-plus-square" aria-hidden="true"></i> Add topic</a>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class="main_forum_inner">
					<div class="forum_sub_sub1" id="questionBox" <?php if(isset($_GET['start_new_topic'])){ ?> style="display: block" <?php }else{ ?> style="display: none" <?php } ?>>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12 personal-info">
								<div class="doc-prfl-left">
									<h3>Add New Topic</h3>
									<form class="form-horizontal" method="POST" action="<?php echo base_url().'forum_topic_add';?>" id="Sign-Up-form" role="form"  enctype="multipart/form-data">
										<input name="forum_cat_id" id="forum_cat_id" value="<?php echo $category->forum_cat_id; ?>" type="hidden">
										<input name="forum_cat_url" value="<?php echo $category->forum_cat_url; ?>" type="hidden">
										<div class="form-group">
											<label class="col-lg-12 control-label" style="margin-bottom:5px;">Topic title:</label>
											<div class="col-lg-12">
												<input class="form-control" name="forum_ques_title" id="forum_ques_title" value="" type="text">
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-12"><strong>Description:</strong></label>
											<div class="col-lg-12">
												<!-- <textarea   name="forum_ques_description" id="texteditor10" class="control-label"  data-sample="2" data-sample-short="">
												</textarea> -->
												<section class="sdk-container main-text-ck">
												<div class="xtrafield">
													<input id="xtrafieldnpt" value="" type="text" name="xtrafieldnpt">
												</div>
												<section class="sdk-contents">
													<div class="columns" data-sample="1">
														<div class="editor">
															<textarea id="forum_ques_description" placeholder="Enter enter comments" name="forum_ques_description" ></textarea>
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
								</div>
								<a class='btn btn-primary'  style="margin-bottom: 10px;position: relative;    border-radius: 5px;box-shadow: none;">
								<i class="fa fa-paperclip" aria-hidden="true"></i>
								<input type="file"  style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="upload" size="40"  onchange='$("#upload-file-info").html($(this).val());' name="upload" size="40" >
							    </a>
								<div class="form-group">
									<!-- <label class="col-md-2 control-label"></label> -->
									<div class="col-md-9">
										<input class="btn btn-primary" value="Post" type="submit">
										<span></span>
										<!--<input class="btn btn-default" value="Cancel" type="reset"> -->
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
			<div id="cat_notify"></div>
			<?php
			if(!empty($forumQuestions)) {
			foreach($forumQuestions AS $item) {
			$userid=$this->session->userdata('user_id');
		    $user_id=$item->user_id;
			if($userid == $user_id  || $userType->role_id==2) { ?>
			<div class="forum_sub_sub" <?php if(isset($item->abuse_forum)){ if($item->abuse_forum == 1){ ?> style="  background: rgba(98, 152, 220, 0.09);"<?php } }?>>
				<div class="row">
					<?php
					if($this->session->userdata('user_id')){
					$userid=$this->session->userdata('user_id');
					$user_id=$item->user_id;
					if($userid == $user_id || $userType->role_id==2) {
					?>
					<p class="editTopic">
						<a href="javascript:" data="<?php echo $item->forum_ques_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $item->forum_ques_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<?php if($item->forum_ques_status == 'Aproved'){ ?>
						<a href='javascript:' class='cat_aproved_panding'  data='<?php echo $item->forum_ques_id; ?>_Panding' title="Unpublish"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
						<?php }else{ ?>
						<a href='javascript:' class='cat_aproved_panding' data='<?php echo $item->forum_ques_id; ?>_Aproved' title="Publish"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
						<?php } ?>
						
					</p>
					<?php }} ?>
					
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
							<img src="<?php echo $img; ?>">
						</div>
					</div>
					<div class="col-md-7">
						<div class="fo_text">
							<a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>"><h3 class="topicTitle"><?php echo $item->forum_ques_title; ?></h3></a>
							<div class="desc_topic" id="reena" >
								<?php $forum_ques_description=$item->forum_ques_description;
								echo $forum_ques_description;
								?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="postinfo pull-left">
							<div class="abuse-tag single-forum-ubuse"><a href="javascript:void(0)" class="abuse-cls" id="abuse_<?php echo $item->forum_ques_id; ?>" title="Abuse" page_url="<?php echo 'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>" f_que_id="<?php echo $item->forum_ques_id; ?>" forum_title="<?php echo $item->forum_ques_title; ?>"><img src="<?php echo base_url();?>assets/images/Loud_Speaker.png" style="width: 30px;height: 30px;" title="Abuse" /></a></div>
							<div class="detail-forum">
								<span>by <?php if(isset($item->fname) && !empty($item->fname)){echo $item->fname; } ?></span> <br/>
								<span><?php if(isset($item->date)){ $date = date_create($item->date); echo date_format($date, 'd M Y h:i A');}?></span>
							</div>
							<div class="comments">
								<div class="commentbg"><i class="fa fa-comments"></i> <?php echo $item->total_comment; ?>
								</div>
							</div>
							<div class="views"><i class="fa fa-eye"></i> <?php echo $item->total_view; ?></div>
							<div class="time"><i class="fa fa-clock-o"></i> <?php   $item->last_comment_time;
											
								$from=date_create(get_current_datetime());
								$to=date_create($item->last_comment_time);
								$diff=date_diff($to,$from);
								// echo  $diff->format('%a D and %h h and %i m %s s');
								//echo "<br>...";
								$day=$diff->format('%a');
								$hour=$diff->format('%h');
								$minute=$diff->format('%i');
								$second=$diff->format('%s');
								if($day > 0){
								echo $day=$diff->format('%a days');
								} else if($day <= 0 && $hour > 0){
								echo $day=$diff->format('%h hr');
								} else if($day <= 0 && $hour <= 0 && $minute > 0){
								echo $day=$diff->format('%i min');
								}else if($day <= 0 && $hour <= 0 && $minute <= 0 && $second > 0){
								echo $day=$diff->format('%s sec');
								}else{
									
								}
								
							?></div>
						</div>
					</div>
				</div>
			</div>
			<?php	}else{
			if($item->forum_ques_status == 'Aproved'){ ?>
			
			<div class="forum_sub_sub" <?php if(isset($item->abuse_forum)){ if($item->abuse_forum == 1){ ?> style="background-color: #387fcc2e;"<?php } }?>>
				<div class="row">
					<?php
					if($this->session->userdata('user_id')){
					$userid=$this->session->userdata('user_id');
					$user_id=$item->user_id;
					if($userid == $user_id || $userType->role_id==2) {
					?>
					<p class="editTopic">
						<a href="javascript:" data="<?php echo $item->forum_ques_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $item->forum_ques_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<?php if($item->forum_ques_status == 'Aproved'){ ?>
						<a href='javascript:' class='cat_aproved_panding'  data='<?php echo $item->forum_ques_id; ?>_Panding' title="Unpublish"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
						<?php }else{ ?>
						<a href='javascript:' class='cat_aproved_panding' data='<?php echo $item->forum_ques_id; ?>_Aproved' title="Publish"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
						<?php } ?>
						
					</p>
					<?php }} ?>
					
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
							<img src="<?php echo $img; ?>">
						</div>
					</div>
					<div class="col-md-7">
						<div class="fo_text">
							<a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>"><h3 class="topicTitle"><?php echo $item->forum_ques_title; ?></h3></a>
							<div class="desc_topic" id="reena" >
								<?php $forum_ques_description=$item->forum_ques_description;
								echo $forum_ques_description;
								?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="postinfo pull-left">
							<div class="abuse-tag single-forum-ubuse"><a href="javascript:void(0)" class="abuse-cls" id="abuse_<?php echo $item->forum_ques_id; ?>" title="ubuse"><img src="<?php echo base_url();?>assets/images/Loud_Speaker.png" style="width: 30px;height: 30px;" title="Abuse" page_url="<?php echo 'forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>" f_que_id="<?php echo $item->forum_ques_id; ?>" forum_title="<?php echo $item->forum_ques_title; ?>"/></a></div>
							<div class="detail-forum">
								<span>by <?php if(isset($item->fname) && !empty($item->fname)){echo $item->fname; } ?></span> <br/>
								<span><?php if(isset($item->date)){ $date = date_create($item->date); echo date_format($date, 'd M Y h:i A');}?></span>
							</div>
							<div class="comments">
								<div class="commentbg"><i class="fa fa-comments"></i> <?php echo $item->total_comment; ?>
								</div>
							</div>
							<div class="views"><i class="fa fa-eye"></i> <?php echo $item->total_view; ?></div>
							<div class="time"><i class="fa fa-clock-o"></i> <?php   $item->last_comment_time;
											
								$from=date_create(get_current_datetime());
								$to=date_create($item->last_comment_time);
								$diff=date_diff($to,$from);
								// echo  $diff->format('%a D and %h h and %i m %s s');
								//echo "<br>...";
								$day=$diff->format('%a');
								$hour=$diff->format('%h');
								$minute=$diff->format('%i');
								$second=$diff->format('%s');
								if($day > 0){
								echo $day=$diff->format('%a days');
								} else if($day <= 0 && $hour > 0){
								echo $day=$diff->format('%h hr');
								} else if($day <= 0 && $hour <= 0 && $minute > 0){
								echo $day=$diff->format('%i min');
								}else if($day <= 0 && $hour <= 0 && $minute <= 0 && $second > 0){
								echo $day=$diff->format('%s sec');
								}else{
									
								}
								
							?></div>
						</div>
					</div>
				</div>
			</div>
			
			<?php  } } ?>
			
			
			<?php	} } else{
			echo "<div class='fmuc-sub'>
				<div class='row'>
						<div class='col-md-12'>Empty</div></div></div>";
					}?>
				</div>
				
				
				<div class="row">
					<div class="col-md-12 col-md-offset-222">
						<?php echo $pagination; ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
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
			<div class="side-topics">
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
<div class="modal fade comment-edit-frm" id="myModal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Edit Topic</h4>
</div>
<div class="modal-body">
<form class="comment_form23 form-horizontal edit-topic-modl" id="Sign-Up-form1" action="<?php echo base_url().'forum_topic_add';?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="forum_cat_id" value="<?php echo $category->forum_cat_id; ?>">
	<input type="hidden" name="url" value="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
	<input type="hidden" name="forum_ques_id" id="forum_ques_id" value="">
	<input name="forum_cat_url" value="<?php echo $category->forum_cat_url; ?>" type="hidden">
	<div class="form-group">
		<label class="col-lg-12 control-label">Topic title:</label>
		<div class="col-lg-12">
			<input class="form-control edit_ques_title"  name="forum_ques_title" id="forum_ques_title" value="" type="text">
			<span style="color:red" class="view_error"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-12 control-label"><strong>Description:</strong></label>
		<div class="col-lg-12">
			<textarea   name="forum_ques_description" id="returnComment" class="control-label">
			</textarea>
		</div>
	</div>
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
<!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
<script src="<?php echo base_url().'assets/js'; ?>/summernote.js"></script>
-->
<script data-sample="2">
$(document).ready(function(){
	CKEDITOR.replace( 'abuse_message', {
	height: 250,
	filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
	});

});
CKEDITOR.replace( 'texteditor10', {
		height: 250,
filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
});
</script>  <script src="<?php echo base_url();?>assets/js/validate.js"></script>
<script>
// When the browser is ready...
$(function() {
var formActional="<?php echo base_url();?>frontEnd/forum/topiccheckAlready";
// Setup form validation on the #register-form element
$("#Sign-Up-form").validate({
// Specify the validation rules
rules: {
forum_ques_title: {
required: true,
remote: {
url: formActional,
type: "post"
}
}
},
// Specify the validation error messages
messages: {
forum_ques_title: {
required: "Please provide a topic",
remote: "topic already in use!"
}
},
submitHandler: function(form) {

form.submit();

}
});
});
</script>

<script>
$('.edit_ques_title').on("keyup",function(){
var title=$(this).val();

var formAction="<?php echo base_url();?>frontEnd/forum/Already_exit_post_title";
var id = $("#forum_ques_id").val();
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
$(document).ready(function() {
$(".minus-square").click(function(){
$("#questionBox").toggle();
$('.minus-square').hide();
$('.plus-square').show();
});
$(".plus-square").click(function(){
$("#questionBox").toggle();
$('.plus-square').hide();
$('.minus-square').show();
});
$(".notLogin").click(function(){

$("#myalert").html('<div class="alert alert-danger message-alert"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>Please login first!</div>');
});
// delete forum comments
$('.cat_image_remove').on("click", function(){
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
location.reload();
}
});
}
else {
return false;
}
});
$('.cat_aproved_panding').on("click", function(){
var str=$(this).attr("data");
var arry = str.split("_");
var id = arry[0];
var forum_ques_status=arry[1];
var forum_status;
if(forum_ques_status == 'Aproved'){
forum_status = 'Publish';
}else{
forum_status = 'Unpublish';
}
//$(this).parent().parent().parent('forum_sub_sub').remove();
var formAction="<?php echo base_url().'frontEnd/forum/cat_aproved_panding'; ?>";
$.ajax({
url : formAction,
type : "POST",
dataType:"text",
data : 'id='+id+'&forum_ques_status='+forum_ques_status,
success:function(data)
{
$('#cat_notify').html('<div class="alert alert-success"><strong>Success!</strong> Forum Topic '+forum_status+' Successfully</div>');
location.reload();
}
});
});
});
</script>
<script>
$(document).ready(function(){
CKEDITOR.replace( 'returnComment', {
height: 250,
filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
} );
$(".edit_comment_popup").click(function(e){
//var data_id= $(this).attr("data");
$("#forum_ques_id").val($(this).attr("data"));
e.preventDefault();
var comment_text=$(this).parent().parent().parent(".forum_sub_sub").find('.desc_topic').html() ;
var edit_ques_title=$(this).parent().parent().parent(".forum_sub_sub").find('.topicTitle').text();
CKEDITOR.instances.returnComment.setData(comment_text);
//alert(edit_ques_title);
$(".edit_ques_title").val(edit_ques_title);
$("#myModal").modal('show');
});
});
</script>
<input type="hidden" id="last_get_url_link1" value="">
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
});

editor.addFeature( editor.widgets.registered.hcard );
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
	CKEDITOR.document.getById( 'contactList' ).on( 'dragstart', function( evt ) {
	var target = evt.data.getTarget().getAscendant( 'div', true );
	CKEDITOR.plugins.clipboard.initDragDataTransfer( evt );
	var dataTransfer = evt.data.dataTransfer;
	dataTransfer.setData( 'contact', CONTACTS[ target.data( 'contact' ) ] );
	dataTransfer.setData( 'text/html', target.getText() );
	if ( dataTransfer.$.setDragImage ) {
		dataTransfer.$.setDragImage( target.findOne( 'img' ).$, 0, 0 );
	}
	});
});
CKEDITOR.replace( 'forum_ques_description', {
	extraPlugins: 'image2,embed,autoembed,uploadwidget,uploadimage,image2,hcard,justify,smiley,pastefromword,link,autolink,adobeair,notification',
	height: 250,
	filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
});
var e = CKEditor.instances['forum_ques_description'];
editor.once( 'instanceReady', function() {
	// Create and show the notification.
	var notification1 = new CKEDITOR.plugins.notification( editor, {
	message: 'Error occurred',
	type: 'warning'
	});
	notification1.show();
	// Use shortcut - it has the same result as above.
	var notification2 = editor.showNotification( 'Error occurred', 'warning' );
});
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
CKEDITOR.instances.forum_ques_description.on('change', function() {
var value = CKEDITOR.instances['forum_ques_description'].getData();
$("#xtrafieldnpt").val(value);
$("#forum_ques_description").val(value);
});
CKEDITOR.instances.forum_ques_description.on('contentDom', function() {
CKEDITOR.instances.forum_ques_description.document.on('keyup', function() {
var value = CKEDITOR.instances['forum_ques_description'].getData();
///var edt=$('#editor2').getData();
$("#xtrafieldnpt").val(value);
$("#forum_ques_description").val(value);
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
var old_data = CKEDITOR.instances['forum_ques_description'].getData();
last_get_url_link=$("#last_get_url_link").val();
if(data.get_url != last_get_url_link){
$("#last_get_url_link").val(data.get_url);
CKEDITOR.instances['forum_ques_description'].setData(old_data+''+ content);
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

  /* $('.abuse-cls').click(function() {
     	var ubuse = $(this).attr('id').split("_");
     	var id = ubuse[1];
     	var forum_type = 'Topic';
        $.ajax({
	        type: 'POST',
	        url: "<?php echo base_url(); ?>frontEnd/forum/abuse_forum",
	        data:{id: id, forum_type: forum_type},
	        success: function(data){
	        	if(data ==1){
	        		location.reload();
	        	}
	        }
        });
        return false;
    });*/
     $('.abuse-cls').click(function() {
    	$("#myModal12").modal('show');
    	$('#f_que_id').val($(this).attr('f_que_id'));
    	$('#forum_url').val($(this).attr('page_url'));
    	$('#forum_title').val($(this).attr('forum_title'));
    	$('#abuse-topic-name').text($(this).attr('forum_title'));
    
    });
</script>