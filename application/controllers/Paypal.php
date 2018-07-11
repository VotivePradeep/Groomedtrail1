<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller 
{
 	function  __construct(){
		parent::__construct();
		$this->load->library('paypal_lib');
		$this->load->model('product');
		$this->load->helper('url');
	    $this->load->helper('file');
	     $this->load->helper('custom_helper');
 	}


	function advert_buy($id){

    	$returnURL = base_url().'paypal/success';//Reena change redirect url
		$cancelURL = base_url().'paypal/cancel/'.$id; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
		//get particular product data
		$advert = $this->product->getRows($id);
	    $plan_id = $advert['pl_id'];
		$plan_row=$this->model->get_row('plan_master',array('pl_id'=>$plan_id));
	    $price = $plan_row->pl_price;
		$description = $plan_row->pl_description;
		$logo = base_url().'assets/images/logo_new.png';
		$userID = $advert['user_id']; //current user id
     	$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $description);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number', $id);
		$this->paypal_lib->add_field('amount',  $price);		
		$this->paypal_lib->image($logo);
		$this->paypal_lib->paypal_auto_form();
	}

 
function success(){
	    //get the transaction data
	   	$paypalInfo = $this->input->post();
	   	$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']	= $paypalInfo["item_number"];
		$data['txn_id']	= $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']	= $paypalInfo["payment_status"];
     	$inserted = $this->product->insertTransaction($data);
     	//echo $this->db->last_query();
			if($inserted){
        	$updatewhere = array('vac_id' => $data['product_id']);
			$advert1 = $this->product->getRows($data['product_id']);			
			$businessupdate['vac_payment_status']=1;  
			$businessupdate['renew_status']=1;  
			$businessupdate['renew_date']=date('Y-m-d h:i:s');  
		 	$update = $this->model->update('tbl_vacation_list', $businessupdate, $updatewhere);
            $userDetail=$this->model->get_data('*','tbl_user_master',array('user_id'=>$data['user_id']));

            $row1 =  $this->model->get_row('email_templates',array('title'=>'PaymentDone'));
			$subject = $row1->subject;
			$message = $row1->content;
			$userName = $userDetail[0]->fname;
			$pageLike = base_url().'lodging/'.$advert1['vac_slag'];
			$message = str_replace("{username}",ucfirst($userName),$message);
			$message = str_replace("{rental_name}",ucfirst($advert1['vac_name']),$message);
			$message = str_replace("{page_link}",$pageLike,$message);
			$message = str_replace("{user_email_address}",$userDetail[0]->email,$message);
			$this->sendingMail($userDetail[0]->email ,$subject, $message);

			   $query = $this->db->query("SELECT tbl_role_permission.role_permission_id,tbl_role_permission.permission_id,tbl_role_permission.role_id,tbl_user_assign_permission.*,tbl_user_master.fname,tbl_user_master.email,tbl_user_master.lname FROM `tbl_role_permission`JOIN tbl_user_assign_permission ON tbl_role_permission.role_id = tbl_user_assign_permission.role_id JOIN tbl_user_master ON tbl_user_master.user_id = tbl_user_assign_permission.user_id WHERE permission_id=14");

                $subAdminEmail = $query->result();
                if(isset( $subAdminEmail)){
                	foreach ($subAdminEmail as $semail) {

	                    $row1 =  $this->model->get_row('email_templates',array('title'=>'RentalSubmissionAndPayment'));
						$subject = $row1->subject;
						$message = $row1->content;
						$pageLike = base_url().'lodging/'.$advert1['vac_slag'];
						$message = str_replace("{username}",ucfirst($semail->fname),$message);
						$message = str_replace("{user_email_address}",$semail->email,$message);
						$message = str_replace("{page_link}",$pageLike,$message);
						$message = str_replace("{rental_property_name}",$advert1['vac_name'],$message);
						$this->sendingMail($semail->email,$subject, $message);
						//$notify['n_type_id'] = $data['product_id'];
						//$notify['user_id'] = $semail->user_id;
						//$notify['n_type'] = 'rental_payment';
						//$notify['n_date'] = date('Y-m-d h:i:s');
						//$this->model->insert_data('tbl_notification',$notify);

                    }
                }
                 $query = $this->db->query("SELECT email,user_id,fname from tbl_user_master WHERE siterole_id =1 AND user_id=1");
                $adminEmail = $query->result();

				$row1 =  $this->model->get_row('email_templates',array('title'=>'RentalSubmissionAndPayment'));
				$subject = $row1->subject;
				$message = $row1->content;
				$pageLike = base_url().'lodging/'.$advert1['vac_slag'];
				$message = str_replace("{username}",ucfirst($adminEmail[0]->fname),$message);
				$message = str_replace("{user_email_address}",$adminEmail[0]->email,$message);
				$message = str_replace("{page_link}",$pageLike,$message);
				$message = str_replace("{rental_property_name}",$advert1['vac_name'],$message);
				$this->sendingMail($adminEmail[0]->email,$subject, $message);


				$anotify['n_type_id'] = $data['product_id'];
				$anotify['user_id'] = $adminEmail[0]->user_id;
				$anotify['n_type'] = 'rental_payment';
				$anotify['n_date'] = date('Y-m-d h:i:s');
				$anotify['n_cat_type'] = 'rental';
				$this->model->insert_data('tbl_notification',$anotify);
               redirect(base_url().'user/rentals');
	    
 	}
 }
 	function cancel(){
 		$data['pagetitle']='Payment Cancel';
 		 $data["menuList"] = $this->model->get_data('*', 'tbl_cms_pages', array('show_in_menu' => 1, 'status'=>1));
 		 $id = $this->uri->segment(3);
 		 $advert = $this->product->getRows($id);
 		 $data['user_id']= $advert['user_id']; 

    	$this->load->view('paypal/cancel', $data);
 	}
 
 	function ipn(){
		//paypal return transaction details array
		$paypalInfo	= $this->input->post();
		$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']	= $paypalInfo["item_number"];
		$data['txn_id']	= $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']	= $paypalInfo["payment_status"];
		$paypalURL = $this->paypal_lib->paypal_url;		
		$result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
		//check whether the payment is verified
		if(preg_match("/VERIFIED/i",$result)){
		 
			
		}
	}

	 function sendingMail($email, $subject, $msg){
  
   
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $email  = $email;
        $this->email->from(FROM_EMAIL, FROM_NAME);
        
        $this->email->to($email);
        $this->email->subject($subject);       
        $this->email->message($msg);  
        $return = $this->email->send();
        if($return){
            return true;
        }else{
           return false;
        }

} 
}