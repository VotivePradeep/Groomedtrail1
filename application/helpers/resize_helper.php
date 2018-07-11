<?php
 function resize_image($image_data,$thumbpath,$width,$height) {
	  $ci=& get_instance();
	  $ci->load->library("image_lib");
$img = substr($image_data['full_path'], 51);
$config['image_library'] = 'gd2';
$config['source_image'] = $image_data['full_path'];
$config['new_image'] = $thumbpath;//'./uploads/new_' . $img;
$config['width'] = $width;
$config['height'] = $height;

//send config array to image_lib's  initialize function
$ci->image_lib->initialize($config);
$src = $config['new_image'];
$data['new_image'] = substr($src, 2);
$data['img_src'] = base_url() . $data['new_image'];
// Call resize function in image library.
$ci->image_lib->resize();
// Return new image contains above properties and also store in "upload" folder.
return $data;

}

function checkuser_loginY(){
$ci=& get_instance();
   if($ci->session->userdata('userId')){
     // redirect(base_url().'dashboard');
    redirect(base_url());
   
    }

}
function checkuser_loginN(){
$ci=& get_instance();
   if(!$ci->session->userdata('userId')){
      redirect(base_url().'login');
   
    }

}
?>