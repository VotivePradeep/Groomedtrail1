<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteMap extends CI_Controller {
    public function __construct(){


		parent::__construct();
		/* Load the libraries and helpers */        
		$this->load->model('model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper('custom_helper');
		$this->load->library('excel');
		$this->load->helper('resize');
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
	 * SiteMap for this controller.
	 */


function site_map(){

	$data['u_id'] = $this->data['user_id'];
	$info=$this->session->all_userdata();
	$data['userinfo']=$info;	
	if($data['u_id'] !=1){
	$result = role_permission($data['u_id'],33);
		if (empty($result)) {
			 redirect(base_url().'access_denied');
		}
    }	
	$data['active_tab_site_map'] = 'active';
	$data['basesegment']= $this->uri->segment(2);
	$data['checkpers'] = $this->model->join_where('*', 'tbl_role_permission','tbl_user_assign_permission','role_id','role_id',array('tbl_user_assign_permission.user_id'=>$data['u_id']),'tbl_user_assign_permission.p_id','desc');
	$data['role'] = $this->data['siterole_id'];
    $data['title'] = 'Site Map';

	$this->load->view('administrator/include/inner_header',$data);
	$this->load->view('administrator/seo/site_map',$data);
	$this->load->view('administrator/include/inner_footer');

	/*if($this->form_validation->run('site_map') == FALSE)
	{

		$this->load->view('administrator/include/inner_header',$data);
		$this->load->view('administrator/seo/site_map',$data);
		$this->load->view('administrator/include/inner_footer');

	} else {
		if($_POST['resetBtn']){
		//$sitemap['site_url'] = $this->input->post('site_url');
		$objDateTime = new DateTime('NOW');
		$sitemap['date'] = $objDateTime->format('c'); // ISO8601 formated datetime
		$xmlString = '<?xml version="1.0" encoding="UTF-8"?>
		    <urlset 
		    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
		    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
		    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		        <url>
		            <loc>'.base_url().'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>1.00</priority>
		        </url>
		    </urlset>';

		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = FALSE;
		$dom->loadXML($xmlString);
		//Save XML as a file
		$dom->save('site_map.xml');

		$this->session->set_flashdata('success', 'Sitemap XML File create successfully');	
		redirect(base_url().'administrator/site_map');	
	}*/
}

function create_site_map(){


	$priority = '1.0';
	$objDateTime = new DateTime('NOW');
		$sitemap['date'] = $objDateTime->format('c'); // ISO8601 formated datetime
		$start ='<?xml version="1.0" encoding="UTF-8"?>'.
		    '<urlset 
		    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" 
		    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" 
		    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$section1 = '<url>
		            <loc>'.base_url().'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>'.$priority.'</priority>
		        </url>
		        <url>
		            <loc>'.base_url().'home</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>'.$priority.'</priority>
		        </url>';
        $tr1 = '<tr><td>'.base_url().'</td><td>'.$sitemap['date'].'</td><td>always</td><td>'.$priority.'</td></tr><tr><td>'.base_url().'home</td><td>'.$sitemap['date'].'</td><td>always</td><td>'.$priority.'</td></tr>';

		$section2 = '<url>
		            <loc>'.base_url().'classified</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		$tr2 = '<tr><td>'.base_url().'classified</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
		/////////Classified Detail Pages 
		$section3 ='';
		$tr3 ='';
		$classifiedList = $this->model->get_categories();
        if(!empty($classifiedList)){
			foreach ($classifiedList as $clsList) {
             if(!empty($clsList->subs)) { 
             foreach ($clsList->subs as $sub)  { 
             if($sub->classified_status == 1){
             
			$section3 .= '<url>
		            <loc>'.base_url().'classified/details/'.$sub->url_slag.'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.65</priority>
		        </url>';
		        $tr3 = '<tr><td>'.base_url().'classified/details/'.$sub->url_slag.'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.65</td></tr>';
			 } } } }
	    }


		$section4 ='<url>
		            <loc>'.base_url().'community-forum</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		$tr4 = '<tr><td>'.base_url().'community-forum</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
        /////////forum Details Page
        $section5 = '';
        $tr5 = '';
        $forumList = $this->model->get_data('*','forum_category',array('forum_cat_status'=>"Aproved"
       ));
        if(!empty($forumList)){
			foreach ($forumList as $fList) {
				$section5 .= '<url>
		            <loc>'.base_url().'forum/'.$fList->forum_cat_url.'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.65</priority>
		        </url>';
		        $tr5 .= '<tr><td>'.base_url().'forum/'.$fList->forum_cat_url.'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.65</td></tr>';
			}
	    }
       		

		$section6 = '<url>
		            <loc>'.base_url().'news</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
        $tr6 = '<tr><td>'.base_url().'news</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
		$section7 ='';/////////news Details Page
        $tr7='';
		 $newsList = $this->model->get_data('*','tbl_news',array('news_status'=>1));
        if(!empty($newsList)){
			foreach ($newsList as $nList) {
				$section7 .= '<url>
		            <loc>'.base_url().'newdetail/'.$nList->news_id.'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.65</priority>
		        </url>';
		        $tr7 .= '<tr><td>'.base_url().'newdetail/'.$nList->news_id.'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.65</td></tr>';
			}
	    }	

		$section8 = '<url>
		            <loc>'.base_url().'lodging</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
        $tr8 = '<tr><td>'.base_url().'lodging</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';

		$section9 ='';/////////lodging Details Page
        $tr9='';
		$lodgingList = $this->model->get_data('*','tbl_vacation_list',array('vac_status'=>1));
        if(!empty($lodgingList)){
			foreach ($lodgingList as $RList) {
				$section9 .= '<url>
		            <loc>'.base_url().'lodging/'.$RList->vac_slag.'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.65</priority>
		        </url>';
		         $tr9 .= '<tr><td>'.base_url().'lodging/'.$RList->vac_slag.'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.65</td></tr>';

			}
	    }
		$section10 ='<url>
		            <loc>'.base_url().'events</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		$tr10 = '<tr><td>'.base_url().'events</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';

		$section11 ='';/////////events Details Page
        $tr11 ='';
		$eventsList = $this->model->get_data('*','tbl_event',array('event_status'=>1));
        if(!empty($eventsList)){
			foreach ($eventsList as $eList) {
				$section11 .= '<url>
		            <loc>'.base_url().'eventdetail/'.$eList->event_id.'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.65</priority>
		        </url>';
		        $tr11 .= '<tr><td>'.base_url().'eventdetail/'.$eList->event_id.'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.65</td></tr>';
			}
	    }
          $section12 ='';
          $tr12 = '';
          $menuList = footer_menu();
          //print_r($menuList);
          if(isset($menuList)){
                foreach ($menuList as $menu) { 
                 if($menu->id == 12) { 
                $section12 .='<url>
		            <loc>'.base_url().'contact</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		        $tr12 .= '<tr><td>'.base_url().'contact</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
                 }else if($menu->id == 13){ 
                $section12 .='<url>
		            <loc>'.base_url().'faq</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		        $tr12 .= '<tr><td>'.base_url().'faq</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
                   }else{ 
                $section12 .='<url>
		            <loc>'. base_url('home/'.$menu->slag).'</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>0.85</priority>
		        </url>';
		        $tr12 .= '<tr><td>'. base_url('home/'.$menu->slag).'</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>';
                   } 
                }
            } 
		   $section13 ='<url>
		            <loc>'.base_url().'terms/terms</loc>
		            <lastmod>'.$sitemap['date'].'</lastmod>
		            <changefreq>always</changefreq>
		            <priority>'.$priority.'</priority>
		        </url>';

		   $tr13 = '<tr><td>'.base_url().'terms/terms</td><td>'.$sitemap['date'].'</td><td>always</td><td>0.85</td></tr>'; 
		    $end =    '</urlset>';


		$xmlString = $start.$section1.$section12.$section13.$section2.$section3.$section4.$section5.$section6.$section7.$section8.$section9.$section10.$section11.$end;

        $html = $tr1.$tr12.$tr13.$tr2.$tr3.$tr4.$tr5.$tr6.$tr7.$tr8.$tr9.$tr10.$tr11;

		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = FALSE;
		$dom->loadXML($xmlString);
		//Save XML as a file
		$dom->save('site_map.xml');
		//echo $xmlString;

		echo '<div class="sitemap-table"><table>
		<tbody>
			<th>URL</th>
			<th>Last modificaton Date</th>
			<th>Action </th>
			<th>Priority</th>
		</tbody>
		<tbody>
             '.$html.'
		</tbody>
		</table></div>';
}

}// class close