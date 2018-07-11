<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_category extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		$this->load->model('model');
		$this->load->model('Common_model1');
		$this->load->library('pagination');		
		$this->load->helper('resize');
		$this->load->library(array('layout', 'form_validation','messages')); // Load layout library
        $this->load->helper(array('url','utility','message_alert'));
        $this->load->helper('custom_helper');
		$this->load->model(array('Common_model1','common_socialviralposts')); // Load models
		$this->load->library('session');
		$info=$this->session->all_userdata();
	
		$data['userinfo']=$info;
		
		if(isset($info['admin_siterole']))
		{
		
			if( ($info['admin_siterole']==1) || ($info['admin_siterole']==3))
			{
				$this->data['siterole_id'] = $info['admin_siterole'];
		        $this->data['user_id'] = $info['admin_id'];	
		        
			}else{
				redirect(base_url()."administrator");
			}
			
		}
		if(isset($data['userinfo']['admin_id'])=='')
		{
			redirect(base_url()."administrator");
		}
	 }
	/**
	 * Index Page for this controller.
	 */
public function index()
	{

		$info=$this->session->all_userdata();
		$data['basesegment']= $this->uri->segment(2);
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],9);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
		}
		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_forum'] = "active";
		$data['title'] = "Admin | Forum Category";

		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		$data['categories']=$this->Common_model1->getAllwhere('forum_category','forum_cat_id','DESC');
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/forum_category', $data);	 
		$this->load->view('administrator/include/inner_footer');	
	}
	public function add_category()
	{
		$info=$this->session->all_userdata();
		$data['basesegment']= $this->uri->segment(2);
		$data['userinfo']=$info;
		$data['u_id'] = $this->data['user_id'];
		if($data['u_id'] !=1){
			$result = role_permission($data['u_id'],9);
			if (empty($result)) {
				 redirect(base_url().'access_denied');
			}
		}
		if (isset($result)) {
		  	if($result[0]->permission_id == 9){
		  		if($result[0]->view_permission !=1){
		  		 	redirect(base_url().'access_denied');
		  		}
		  	}
		  }
		$data['role'] = $this->data['siterole_id'];
		$data['active_tab_forum'] = "active";
		$data['title'] = "Admin | Add Forum Category";

		$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
		if(isset($_GET['forum_cat_id'])){
			
			$where=array('forum_cat_id' => $_GET['forum_cat_id']);
			$table="forum_category";		
			$data['category']=$this->Common_model1->get_single_data($table,$where);
			
		} else{
			$data['category']='';
		}
		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/add_forum_category',$data);
		$this->load->view('administrator/include/inner_footer');
       
	 
	}
	public function add_edit_category(){
		
		$data['u_id'] = $this->data['user_id'];
		if ($_POST)
        {    $forum_cat_id = $this->input->post('forum_cat_id', true);
             $forum_cat_status = $this->input->post('forum_cat_status', true);
             $forum_cat_name = $this->input->post('forum_cat_name', true);
             $forum_cat_name=trim($forum_cat_name);
             $forum_cat_url=$this->clean_string($this->input->post('forum_cat_url'));
			 $category_description=$this->input->post('discription',true);
            $table = 'forum_category';
			
            $data = array('forum_cat_name' => $forum_cat_name,
				'forum_cat_status' => $forum_cat_status,
				'forum_cat_url'=> $forum_cat_url,
				'category_description'=> $category_description,
				'date' => get_current_datetime(),
				'user_id' => $data['u_id'],	
				'last_modify_user_id' => $data['u_id'],				
				'last_modify_date' =>  date("Y-m-d")
		   );
		   
		   // article image
		   if(!empty($_FILES['userfile']['name'])){
		    $post_name_img_name =str_replace(' ', '-', $forum_cat_name);
		    $post_name_img_name=$time=$post_name_img_name.'_'.time();
		   
			$path_parts = pathinfo($_FILES["userfile"]["name"]);
            $image_path = $post_name_img_name.'.'.$path_parts['extension'];
			
			 $responce_image=$this->do_upload1($image_path,'userfile');
			 //echo $image_path ;
			//print_r($responce_image);
			// die;
			if($responce_image==1){
			
               $this->session->set_flashdata('msg_error',"The filetype you are attempting to upload is not allowed.");
				  
				   if (!empty($image_id))
				{
					return redirect('administrator/add_forum_category?post_id='.$post_id);
				}else{
				
					return redirect('administrator/add_forum_category');
				}
            			
			} else{
				$data['forum_cat_image']=$responce_image;
			}
		   }
		 
		   
            if (!empty($forum_cat_id))
            {   
                $res = $this->Common_model1->update($table, $data, array('forum_cat_id' => $forum_cat_id));
                if ($res)
                {
					
                    $this->session->set_flashdata('msg_success', messages::CATEGORY_UPDATE);
					return redirect('administrator/forum_category', 'refresh');

                }
                else
                {
					return redirect('administrator/add_forum_category?forum_cat_id='.$forum_cat_id, 'refresh');

                    $this->session->set_flashdata('msg_error', messages::CATEGORY_UPDATE_ERROR);                  
                }
				

            }
            else
            {
				if(empty($data['forum_cat_image'])){
					$data['forum_cat_image']="default.jpg";
				}
             $res = $this->Common_model1->insertdata($table, $data);
              
			    if ($res)
                {    

  			    	
					$this->session->set_flashdata('msg_success', messages::CATEGORY_CREATED); 
					
						return redirect('administrator/forum_category', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('msg_error', messages::CATEGORY_CREATE_ERROR);
                   $this->layout->view('administrator/add_forum_category');
                }
				
				
            }
        }
		
	}
	public function do_upload1($image_path,$name){
		    $Path='./assets/category_images/large/';
		    $Path_icon='./assets/category_images/icon/';
		    $Path_thumb='./assets/category_images/thumbnail/';
			
		
			$config['upload_path']    = $Path;
			$config['file_name'] = $image_path;
            $config['file_path'] = $Path.$image_path;
            $config['allowed_types']        = 'gif|GIF|jpg|jpeg|png';
            $config['max_size']             = 100000000;          
            $this->load->library('upload', $config);
			
  
                if ( ! $this->upload->do_upload($name))
                {
                $error = array('error' => $this->upload->display_errors());
                return 1;
                }
                else
                {
                  
				$data =$this->upload->data();
                $icon = $Path_icon.$data['file_name'];
			    resize_image($data,$icon,140,90);
                
				$thumb = $Path_thumb.$data['file_name'];
			    resize_image($data,$thumb,240,175);
                
				return $data['file_name'];
             
                }
	
	}
	function clean_string($str){
	    $string=trim($str);
	    $string=preg_replace('/\s\s+/', ' ',$string);
	    $string = str_replace(' ', '-',$string); // Replaces all spaces with hyphens.
        $string=preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.		
	    return   strtolower($string);	
    }

    public function Already_exit_post_title(){
		
		 $title=$_POST['title'];
		 $id=$_POST['id'];
		 $title = $this->clean_string($title);
		 
		$table='forum_category';
		 if(empty($id) or $id ==''){
		  
		 $where=array('forum_cat_url'=>$title);
		 }else{
		  
		 $where=array('forum_cat_id !='=>$post_tid,'forum_cat_url'=>$title);
		 }
		 
		 
		 $post=$this->Common_model1->get_single_data($table,$where);
	 
		 
		 if($post){
			 echo '1';
		 }else{
			echo '0';
		 }
		 
	}
		  public function delete_cat($id)
    {
		
			$id=array('forum_cat_id'=>$id);
			$table='forum_category';
			$dataunlikn = $this->Common_model1->get_single_data($table,$id);
            $user_delete = $this->Common_model1->delete($table,$id);
           
			  if ($user_delete)
                {
					$Path='./assets/category_images/large/'.$dataunlikn->forum_cat_image;
					$Path_icon='./assets/category_images/icon/'.$dataunlikn->forum_cat_image;
					$Path_thumb='./assets/category_images/thumbnail/'.$dataunlikn->forum_cat_image;
					if($dataunlikn->forum_cat_image !== "default.jpg")
					{	
					unlink($Path);
					unlink($Path_icon);
					unlink($Path_thumb);
					}
                    $this->session->set_flashdata('msg_success', messages::DELETE_ITEM);
                }
                else
                {
                    $this->session->set_flashdata('msg_error', messages::DELETE_ERROR);
  
                }

               return redirect('administrator/forum_category','refresh');

    }

	}