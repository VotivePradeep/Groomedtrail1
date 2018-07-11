<script data-sample="2">
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
</script>