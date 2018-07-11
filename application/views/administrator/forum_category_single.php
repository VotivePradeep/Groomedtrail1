<?php $this->load->view('administrator/include/left_sidebar'); ?>
<link href="<?php echo base_url(); ?>assets/ckeditor_sdk/theme/css/fonts.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/ckeditor_sdk/theme/css/sdk.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/ckeditor_sdk/vendor/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>assets_admin/js/plugins/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url(); ?>assets/ckeditor_sdk/samples/assets/beautify-html.js"></script>
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<div class="warper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default add-user-sec">
                <div class="panel-heading admin-forum-heading"><?php echo $category->forum_cat_name; ?> 
			    <?php
			        $flag1=0;
			        $flag2=0;
			        $flag3=0;
			        $flag4=0;
			        $flag5=0;

			        if (isset($checkpers)) {
			            foreach ($checkpers as $checkper) {    
			                if (($checkper->permission_id == 17) && ($checkper->add_permission==1)) { 
			                    $flag1 = 1;
			                }
			                if (($checkper->permission_id == 17) && ($checkper->edit_permission==1)) { 
			                    $flag2 = 1;
			                }
			                if (($checkper->permission_id == 17) && ($checkper->view_permission==1)) { 
			                    $flag3= 1;
			                }
			                if (($checkper->permission_id == 17) && ($checkper->delete_permission==1)) { 
			                    $flag4 = 1;
			                }
			                if (($checkper->permission_id == 17) && ($checkper->status_change_permission==1)) { 
			                    $flag5 = 1;
			                }
			            }
			        }
			    if ($flag1 == 1 || $u_id==1) {  ?>
                <!-- <a href="javascript:" id="openBox" class="add-topic-cat">
				    <i class="fa fa-plus-square" aria-hidden="true"></i> Add New Topic
				</a> -->
				<a class="minus-square add-topic-cat" ><i class="fa fa-minus-square" aria-hidden="true"></i> Add topic</a><a class="plus-square add-topic-cat"  style="display: none;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add topic</a>
				<?php   } ?>
                </div>
                <div class="panel-ctrls"></div> 
                <div class="panel-body no-padding">
				
				<div id="myalert"></div>
	        		<div class="main-forum-list-page">
		        		
		            	
						<div class="main_forum_inner">
                       <?php if ($flag1 == 1 || $u_id==1) {  ?>
						<div class="forum_sub_sub1" id="questionBox">
		                    	<div class="row">
							   <div class="col-md-12 col-sm-6 col-xs-12 personal-info">
									 <div class="doc-prfl-left"> 
									  <h3>Add new topic</h3>
									  <form class="form-horizontal" method="POST" action="<?php echo base_url().'administrator/forum_topic_add';?>" id="Sign-Up-form" role="form">
						          <input name="forum_cat_id" id="forum_cat_id" value="<?php echo $category->forum_cat_id; ?>" type="hidden">
						                <input name="forum_cat_url" value="<?php echo $category->forum_cat_url; ?>" type="hidden">
										<div class="form-group">
										  <label class="col-lg-2 control-label">Topic title:</label>
										  <div class="col-lg-10">
											<input class="form-control" name="forum_ques_title" id="forum_ques_title" value="" type="text">
										  </div>
										</div>
									
									 <div class="form-group">
									  <label class="col-lg-2 control-label"><strong>Description:</strong></label>
										<div class="col-lg-10">
										
										
										<textarea   name="forum_ques_description" id="texteditor10" class="control-label"  data-sample="2" data-sample-short="">
                                      </textarea>
										
									  </div>
									</div>
									
										<div class="form-group">
										  <label class="col-md-3 control-label"></label>
										  <div class="col-md-8">
											<input class="btn btn-primary" value="Save" type="submit">
											         
										  </div>
										</div>        
									  </form>
									 </div>

									</div>
  
								</div>
								</div>
								<?php } ?>
						
						    <div id="cat_notify"></div>
						
		                	<?php
                             if(!empty($forumQuestions)) {
							foreach($forumQuestions AS $item) { ?>
							<div class="forum_sub_sub forum_single-cat-lst">
		                    	<div class="row">
		                    	
								<p class="editTopic">
								<?php if ($flag2 == 1 || $u_id==1) {  ?>	
								<a href="javascript:" data="<?php echo $item->forum_ques_id; ?>" class="edit_comment_popup"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                <?php } if ($flag4 == 1 || $u_id==1) {  ?>

								<a href='javascript:' class='cat_image_remove' items='1' data='<?php echo $item->forum_ques_id; ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								<?php } if ($flag5 == 1 || $u_id==1) {  ?>

								<?php if($item->forum_ques_status == 'Aproved'){ ?>
								<a href='javascript:' class='cat_aproved_panding'  data='<?php echo $item->forum_ques_id; ?>_Panding' title="Unpublish"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
								<?php }else{ ?>
								<a href='javascript:' class='cat_aproved_panding' data='<?php echo $item->forum_ques_id; ?>_Aproved' title="Publish"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
								<?php }  }?>
										   
								
								</p>
		                        	<div class="col-md-2">
		                            	<div class="fo_image">
		                                	<!-- <img src="<?php echo base_url().'assets/user_images/photo/'.$item->profile_picture; ?>"> -->
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
		                            <div class="col-md-7">
		                            	<div class="fo_text">
		                            		<?php if ($flag3 == 1 || $u_id==1) {  ?>
		                                	<a href="<?php echo base_url().'administrator/forum/'.$item->forum_cat_url.'/'.$item->forum_ques_url;?>">
                                            <?php } ?>
		                                		<h3 class="topicTitle"><?php echo $item->forum_ques_title; ?></h3>
                                           <?php if ($flag3 == 1 || $u_id==1) {  ?>
		                                	</a>
		                                	<?php } ?>
		                                    <p class="desc_topic">
											<?php $forum_ques_description=strip_tags($item->forum_ques_description); 
					                            echo mb_strimwidth($forum_ques_description, 0, 150,"...");
					                               ?>
										    </p>
		                                </div>
		                            </div>
		                            <div class="col-md-3">
		                            	<div class="postinfo pull-left">
													<div class="detail-forum">
														<span>by <?php if(isset($item->fname) && !empty($item->fname)){echo $item->fname; } ?> <?php if(isset($item->date)){ $date = date_create($item->date); echo date_format($date, 'd M Y h:i A');}?></span>
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
        
			<form class="comment_form23 form-horizontal edit-topic-modl" id="Sign-Up-form1" action="<?php echo base_url().'administrator/forum_topic_add';?>" method="POST" enctype="multipart/form-data">
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
								    <input type="Submit" class="reply-btn" id="topicsubmit" value="Post Comment">
								   </div> 
						  </div>
		
		  </form>
		
		<input type="hidden" id="last_get_url_link1" value="">
        </div>
     
      </div>
      
    </div>
  </div>

  
 <script src="<?php echo base_url();?>assets/js/validate.js"></script> 
<script>
// When the browser is ready...
$(function() {

var formActional1="<?php echo base_url();?>administrator/topiccheckAlready"; 
// Setup form validation on the #register-form element
$("#Sign-Up-form").validate({
		// Specify the validation rules
		rules: {
		forum_ques_title: {
		required: true,
		remote: {
                    url: formActional1,
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
$(document).ready(function(){
		$('.edit_ques_title').on("keyup",function(){


		var title=$(this).val();
		
	var formAction="<?php echo base_url(); ?>administrator/already_exit_post_title";
    var id = $("#forum_ques_id").val();
	 $.ajax({		
		url : formAction,
		type : "POST",
		dataType: "text",
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
		});
	</script>
	
	<script data-sample="2">
	CKEDITOR.replace( 'texteditor10', {
					height: 250,
					filebrowserUploadUrl:'<?php echo base_url().'editorfile'; ?>'
				});					
</script>
  
  <script>
    $(document).ready(function() {
       // onKeydown callback
/*
$('#summernote1').summernote({

  height:200,
  callbacks: {
  onEnter:function(){}
  }
});
// summernote.keydown
$('#summernote1').on('summernote.keyup', function(we, e) {
   var markupStr = $('#summernote1').summernote('code');
  $("#summernote1").html(markupStr);
});
*/
/*
$("#openBox").click(function(){
	$("#questionBox").toggle();
	$(".fa-plus-square, .fa-minus-square").toggleClass("fa-minus-square");
});*/


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



// delete forum comments
$('.cat_image_remove').on("click", function(){
		
	var check = confirm("Are you sure you want to delete?");
	if (check == true) {
	var image_id=$(this).attr("data");
	
	var formAction="<?php echo base_url().'administrator/Forum/delete_topic'; ?>";
		$.ajax({		
			url : formAction,
			type : "POST",
			data : "image_id="+image_id,
			success:function(data) 
			{           
				location.reload();
		    }
		});
		return true;   
	}else {
        return false;   
    }
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
     var comment_text=$(this).parent().parent().parent(".forum_sub_sub").find('.desc_topic').html();
     var edit_ques_title=$(this).parent().parent().parent(".forum_sub_sub").find('.topicTitle').text();
	
		CKEDITOR.instances.returnComment.setData(comment_text);
		//alert(edit_ques_title);
		$(".edit_ques_title").val(edit_ques_title);
        $("#myModal").modal('show');
		
		
  
});
	
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

</script>