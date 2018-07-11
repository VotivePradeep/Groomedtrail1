<?php 
class Template {
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{       
				$this->CI =& get_instance();	
	
				$user_type = $this->CI->session->userdata('user_type');
				$this->set('user_type', $user_type);
	
				$logged_in = $this->CI->session->userdata('logged_in');
				$this->set('logged_in', $logged_in);
				
				$username = $this->CI->session->userdata('username');
				$this->set('username', $username);
				
				$success = $this->CI->session->flashdata('success');
				$this->set('success', $success);

				$error = $this->CI->session->flashdata('error');
				$this->set('error', $error);
	
				$user_id = $this->CI->session->userdata('userId');
				$this->set('userId', $user_id);

				$admin_id = $this->CI->session->userdata('adminId');
				$this->set('adminId', $admin_id);
				
				$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
				return $this->CI->load->view($template, $this->template_data, $return);
		}
}
?>