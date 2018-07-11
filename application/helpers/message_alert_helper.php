<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('msg_alert')) {
	function msg_alert(){
      $CI =& get_instance(); ?>
      <?php if($CI->session->flashdata('msg_success')): ?>	
          <div class="alert alert-success message-alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <?php echo $CI->session->flashdata('msg_success'); ?></div>
      <?php endif; ?>
	  
      <?php if($CI->session->flashdata('msg_info')): ?>	
          <div class="alert alert-info message-alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <?php echo $CI->session->flashdata('msg_info'); ?></div>
      <?php endif; ?>
	  
      <?php if($CI->session->flashdata('msg_warning')): ?>	
          <div class="alert alert-warning message-alert">
		  	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <?php echo $CI->session->flashdata('msg_warning'); ?></div>
      <?php endif; ?>
	  
      <?php if($CI->session->flashdata('msg_error')): ?>	
          <div class="alert alert-danger message-alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		  <?php echo $CI->session->flashdata('msg_error'); ?></div>
		  
      <?php endif; ?>
	<?php }					
}



?>