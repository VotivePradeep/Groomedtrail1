<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_default($post_string)
{
    
  return $post_string == '0' ? FALSE : TRUE;
}

    
$config = array(
   'addsubadmin' => array(
                array(
                    'field'     => 'username',
                    'label'     => 'User name',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'email',
                    'label'     => 'Email',
                    'rules'     => 'trim|required|valid_email|is_unique[tbl_user_master.email]'
                ),
                 array(
                    'field'     => 'password',
                    'label'     => 'Password',
                    'rules'     => 'trim|required'
                ),
        
     ),
   'editPoiType' => array(
                array(
                    'field'     => 'poi_type',
                    'label'     => 'POI type',
                    'rules'     => 'trim|required'
                ),
                
     ),
   'timezone' => array(
                array(
                    'field'     => 'zone_name',
                    'label'     => 'zone name',
                    'rules'     => 'trim|required'
                ),
                
     ),
    'addseo'=> array(
                  
                   array(
                        'field'=>'page_name',
                        'label'=>'page name',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'meta_title',
                        'label'=>'meta title',
                        'rules'=>'trim|required'
                    ),
                    array(
                        'field'=>'mata_viewport',
                        'label'=>'mata viewport',
                        'rules'=>'trim|required'
                    ),
                  
                    array(
                        'field'=>'mata_keywords',
                        'label'=>'mata keywords',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'mata_author',
                        'label'=>'mata author',
                        'rules'=>'trim|required'
                    ),
                  
              ),
   'addpermission' => array(
                array(
                    'field'     => 'roles',
                    'label'     => 'Role',
                    'rules'     => 'trim|required'
                ),
        
     ),
   'editsubadmin' => array(
                array(
                    'field'     => 'username',
                    'label'     => 'User name',
                    'rules'     => 'trim|required'
                ),
                
               
        
     ),
   'subcription_form' => array(
                array(
                    'field'     => 'html',
                    'label'     => 'form html',
                    'rules'     => 'trim|required'
                ),
            ),
   'role_add' => array(
                array(
                    'field'     => 'role_name',
                    'label'     => 'Role name',
                    'rules'     => 'trim|required|is_unique[ tbl_user_role.role_name]'
                ),
     ),
    'editEmailTemplate' => array(
                array(
                    'field'     => 'subject',
                    'label'     => 'Subject',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'content',
                    'label'     => 'Content',
                    'rules'     => 'trim|required'
                ),
                
     ),
       'forum_heading' => array(
                array(
                    'field'     => 'title',
                    'label'     => 'title',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'description',
                    'label'     => 'description',
                    'rules'     => 'trim|required'
                ),
                
     ),
   'state_add' => array(
                array(
                    'field'     => 'state_name',
                    'label'     => 'State name',
                    'rules'     => 'trim|required|is_unique[tbl_state.state_name]'
                ),
     ),
   'facebookcredential' => array(
                array(
                    'field'     => 'facebook_oauth_key',
                    'label'     => 'Facebook oAuth Key',
                    'rules'     => 'trim|required'
                ),
     ),
   'googlecredential' => array(
                array(
                    'field'     => 'gm_oauth_key',
                    'label'     => 'Google oAuth Key',
                    'rules'     => 'trim|required'
                ),
     ),
   'classified_expiration' => array(
                array(
                    'field'     => 'cl_ex_time',
                    'label'     => '>Classified Expiration Duration',
                    'rules'     => 'trim|required'
                ),
     ),
     'review' => array(
                array(
                    'field'     => 'review_title',
                    'label'     => 'title',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'comment',
                    'label'     => 'comment',
                    'rules'     => 'trim|required'
                ),
                 
        
     ),
   'plan_add' => array(
                array(
                    'field'     => 'pl_name',
                    'label'     => 'Plan Name',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'pl_description',
                    'label'     => 'Plan Description',
                    'rules'     => 'trim|required'
                ),
                  
                   array(
                    'field'     => 'pl_price',
                    'label'     => 'Plan Price',
                    'rules'     => 'trim|required'
                ),
                 
        
     ),
    'addtrailcat' => array(
                array(
                    'field'     => 'trail_name',
                    'label'     => 'Trail name',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'trail_name',
                    'label'     => 'Trail name',
                    'rules'     => 'trim|required'
                ),
               
                
     ), 
    'addclassifiedscat' => array(
                array(
                    'field'     => 'classified_cat_name',
                    'label'     => 'classified category name',
                    //'rules'     => 'trim|required|is_unique[tbl_classified_cat_master.classified_cat_name]'
                    'rules'     => 'trim|required'
                ),
               
                
     ),
    'editclassifiedscat' => array(
                array(
                    'field'     => 'classified_cat_name',
                    'label'     => 'classified category name',
                    'rules'     => 'trim|required'
                ),
                
                
     ),
     'updatetrail' => array(
                array(
                    'field'     => 'trail_status',
                    'label'     => 'trail status',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'trail_description',
                    'label'     => 'trail description',
                    'rules'     => 'trim|required'
                ),
                 
        
     ),
     'updatetrailreport' => array(
              
                array(
                    'field'     => 'trail_report_conditions',
                    'label'     => 'trail report description',
                    'rules'     => 'trim|required'
                ),
                 
        
     ),
     'faqadd' => array(
                array(
                    'field'     => 'faq_que',
                    'label'     => 'Questions',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'faq_ans',
                    'label'     => 'Answers',
                    'rules'     => 'trim|required'
                ),
                
                
     ),
    'editfaq' => array(
                array(
                    'field'     => 'faq_que',
                    'label'     => 'Questions',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'faq_ans',
                    'label'     => 'Answers',
                    'rules'     => 'trim|required'
                ),
                
                
     ),
    'edittrailcat' => array(
                array(
                    'field'     => 'trail_name',
                    'label'     => 'Trail name',
                    'rules'     => 'trim|required'
                ),
                
                
     ),
      /*'addclassified'=> array(
                  
                   array(
                        'field'=>'classified_type',
                        'label'=>'Type',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_created_by',
                        'label'=>'Classified Name',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_end_date',
                        'label'=>'classified end date',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_start_date',
                        'label'=>'classified start date',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_description',
                        'label'=>'Description',
                        'rules'=>'trim|required'
                    ),
                  
              ),
        'editclassified'=> array(
                  
                   array(
                        'field'=>'classified_type',
                        'label'=>'Type',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_created_by',
                        'label'=>'Created By',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'classified_description',
                        'label'=>'Description',
                        'rules'=>'trim|required'
                    ),
                  
              ),
*/         'classifiedsadd' => array(
                array(
                    'field'     => 'classified_type',
                    'label'     => 'classified Category',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'classified_ads',
                    'label'     => 'classified ads',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'classified_price',
                    'label'     => 'classified price',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'classified_description',
                    'label'     => 'classified description',
                    'rules'     => 'trim|required'
                ),
                  array(
                    'field'     => 'classified_created_by',
                    'label'     => 'Classified Title',
                    'rules'     => 'trim|required'
                    //'rules'     => 'trim|required|is_unique[tbl_classified_list.classified_created_by]'
                ),
                  array(
                    'field'     => 'classified_state',
                    'label'     => 'classified state',
                    'rules'     => 'trim|required'
                ),
                  array(
                    'field'     => 'classified_image_data',
                    'label'     => 'classified image',
                    'rules'     => 'trim|required'
                ),
                  
               
               
                
     ),
        'classifiedsedit' => array(
                array(
                    'field'     => 'classified_type',
                    'label'     => 'classified Category',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'classified_ads',
                    'label'     => 'classified ads',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'classified_price',
                    'label'     => 'classified price',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'classified_description',
                    'label'     => 'classified description',
                    'rules'     => 'trim|required'
                ),
                  array(
                    'field'     => 'classified_created_by',
                    'label'     => 'Classified Title',
                    'rules'     => 'trim|required'
                ),
                  array(
                    'field'     => 'classified_state',
                    'label'     => 'classified state',
                    'rules'     => 'trim|required'
                ),
                  array(
                    'field'     => 'classified_image_data',
                    'label'     => 'classified image',
                    'rules'     => 'trim|required'
                ),
               
               
                
     ),
       'googlemapkey' => array(
           array(
               'field'     => 'google_key',
               'label'     => 'Google map key',
               'rules'     => 'trim|required'
           ),
           
    ),
       'paymentcredential' => array(
         array(
               'field'     => 'config_type',
               'label'     => 'payment mode',
               'rules'     => 'trim|required'
            ),
           array(
               'field'     => 'paypal_email',
               'label'     => 'paypal email',
               'rules'     => 'trim|required'
           ),
           array(
               'field'     => 'paypal_default_currency',
               'label'     => 'paypal default currency',
               'rules'     => 'trim|required'
           ),
           
    ),
     'googleads' => array(
          array(
               'field'     => 'pagename',
               'label'     => 'Page Name',
               'rules'     => 'trim|required'
           ),
           array(
               'field'     => 'script_url',
               'label'     => 'Script Url',
               'rules'     => 'trim|required'
           ),
           array(
               'field'     => 'client_id',
               'label'     => 'Client Id',
               'rules'     => 'trim|required'
           ),
           array(
               'field'     => 'slot_id',
               'label'     => 'Slot Id',
               'rules'     => 'trim|required'
           ),           
    ),
    'editpoi' => array(
                array(
                    'field'     => 'trail_type_id',
                    'label'     => 'POI trail type',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'region_name',
                    'label'     => 'state name',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field'     => 'kml_data_name',
                    'label'     => 'Trail Name',
                    'rules'     => 'trim|required'
                ),
     ),

    'addtrail' => array(
                array(
                    'field'     => 'trail_name',
                    'label'     => 'KML category',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'region_name',
                    'label'     => 'state name',
                    'rules'     => 'trim|required'
                ),
              /*  array(
                    'field'     => 'title',
                    'label'     => 'title',
                    'rules'     => 'trim|required'
                ),*/
               /* array(
                    'field'     => 'description',
                    'label'     => 'description',
                    'rules'     => 'trim|required'
                ),*/
                /*array(
                    'field'     => 'kmlpath',
                    'label'     => 'upload KML file',
                    'rules'     => 'trim|required'
                ),*/
     ),
    'edittrail' => array(
                 array(
                    'field'     => 'trail_name',
                    'label'     => 'trail name',
                    'rules'     => 'trim|required'
                ),
                array(
                    'field'     => 'region_name',
                    'label'     => 'region name',
                    'rules'     => 'trim|required'
                ),
              /*  array(
                    'field'     => 'title',
                    'label'     => 'title',
                    'rules'     => 'trim|required'
                ),*/
                /*array(
                    'field'     => 'description',
                    'label'     => 'description',
                    'rules'     => 'trim|required'
                ),*/
                /* array(
                    'field'     => 'kmlpath',
                    'label'     => 'KML file',
                    'rules'     => 'trim|required'
                ),
              */
                
     ),
    'addcmspage'=> array(
                  
                   array(
                        'field'=>'title',
                        'label'=>'page title',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'menu_name',
                        'label'=>'menu title',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'content',
                        'label'=>'Description',
                        'rules'=>'trim|required'
                    ),
                    array(
                        'field'=>'mata_viewport',
                        'label'=>'mata viewport',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'mata_description',
                        'label'=>'mata description',
                        'rules'=>'trim|required'
                    ),
                    array(
                        'field'=>'mata_keywords',
                        'label'=>'mata keywords',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'mata_author',
                        'label'=>'mata author',
                        'rules'=>'trim|required'
                    ),
                  
              ),
        'editcmspage'=> array(
                  
                   array(
                        'field'=>'title',
                        'label'=>'Title',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'menu_name',
                        'label'=>'Menu Name',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'content',
                        'label'=>'Description',
                        'rules'=>'trim|required'
                    ),
                    array(
                        'field'=>'mata_viewport',
                        'label'=>'mata viewport',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'mata_description',
                        'label'=>'mata description',
                        'rules'=>'trim|required'
                    ),
                    array(
                        'field'=>'mata_keywords',
                        'label'=>'mata keywords',
                        'rules'=>'trim|required'
                    ),
                   array(
                        'field'=>'mata_author',
                        'label'=>'mata author',
                        'rules'=>'trim|required'
                    ),
                  
              ),
  
     'changepassword' => array(
        array(
            
                    'field'     => 'current_password',
                    'label'     => 'Current Password',
                    'rules'     => 'trim|required'
                ),
        array(
                    'field'     => 'first_password',
                    'label'     => 'New Password',
                    'rules'     => 'trim|required'
                ),
        array(
                    'field'     => 'second_password',
                    'label'     => 'Confirm New Password',
                    'rules'     => 'trim|required|matches[first_password]'
                )

            ),
      'addnews' => array(
                array(
                    'field'     => 'news_title',
                    'label'     => 'news title',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field' => 'news_description',
                    'label' => 'news description',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'news_image11',
                    'label' => 'news image',
                    'rules' => 'required'
                ),
       
     ),
   'editnews' => array(
                array(
                    'field'     => 'news_title',
                    'label'     => 'news title',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field' => 'news_description',
                    'label' => 'news description',
                    'rules' => 'required'
                ),

     ),
      'addvacbusin' => array(
                array(
                    'field' => 'plan_id',
                    'label' => 'Plan select',
                    'errors' => array('required' => 'Please select a plan'),
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'vac_name',
                    'label' => 'property name',
                   // 'rules' => 'trim|required|is_unique[tbl_vacation_list.vac_name]'
                    'rules'     => 'trim|required'
                ),
                
                 array(
                    'field' => 'vac_type',
                    'label' => 'property type',
                    'rules' => 'required'
                ),
                  array(
                    'field' => 'vac_weekly_rate',
                    'label' => 'rental weekly rate',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_contact',
                    'label' => 'property phone number',
                    'rules' => 'required'
                ),
                 array(
                    'field'  => 'vac_email',
                    'label'  => 'email address',
                    'rules'  => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'vac_address',
                    'label' => 'property address',
                    'rules' => 'required'
                ),
                /*array(
                    'field' => 'vac_city',
                    'label' => 'city',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_state',
                    'label' => 'state',
                    'rules' => 'required'
                ),*/
               
                array(
                    'field' => 'vac_image_data',
                    'label' => 'image',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_zip_code',
                    'label' => 'zip code',
                    'rules' => 'required'
                ),
                
                 array(
                    'field' => 'vac_no_of_bedroom',
                    'label' => 'no. of bedrooms',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_bathroom',
                    'label' => 'no. of bathrooms',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_sleep',
                    'label' => 'number of people it sleeps',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_price',
                    'label' => 'rental daily rate',
                    'rules' => 'required'
                ), 
                array(
                    'field' => 'vac_location_type',
                    'label' => 'location type',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_floor_area',
                    'label' => 'floor area',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_amenities[]',
                    'label' => 'amenities',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_description',
                    'label' => 'description',
                    'rules' => 'required'
                ),
                

       
     ),
     'editvacbusin' => array(
                array(
                    'field' => 'plan_id',
                    'label' => 'Plan select',
                    'errors' => array('required' => 'Please select a plan'),
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'vac_name',
                    'label' => 'property name',
                    'rules' => 'trim|required'
                ),
                
                 array(
                    'field' => 'vac_type',
                    'label' => 'property type',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_weekly_rate',
                    'label' => 'rental weekly rate',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_contact',
                    'label' => 'property phone number',
                    'rules' => 'required'
                ),
                 array(
                    'field'  => 'vac_email',
                    'label'  => 'email address',
                    'rules'  => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'vac_address',
                    'label' => 'property address',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_image_data',
                    'label' => 'image',
                    'rules' => 'required'
                ),
                 /*array(
                    'field' => 'vac_city',
                    'label' => 'city',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_state',
                    'label' => 'state',
                    'rules' => 'required'
                ),*/
                
                array(
                    'field' => 'vac_zip_code',
                    'label' => 'zip code',
                    'rules' => 'required'
                ),
                 
                 array(
                    'field' => 'vac_no_of_bedroom',
                    'label' => 'no. of bedrooms',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_bathroom',
                    'label' => 'no. of bathrooms',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_sleep',
                    'label' => 'no. of sleep persons',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'vac_price',
                    'label' => 'rental daily rate',
                    'rules' => 'required'
                ), 
                array(
                    'field' => 'vac_location_type',
                    'label' => 'location type',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_floor_area',
                    'label' => 'floor area',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_amenities[]',
                    'label' => 'amenities',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'vac_description',
                    'label' => 'description',
                    'rules' => 'required'
                ),
                
       
       
     ),
  'addevent' => array(
               array(
                    'field'     => 'event_title',
                    'label'     => 'event title',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field' => 'event_venue',
                    'label' => 'event venue',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'venue_address',
                    'label' => 'venue address',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'event_description',
                    'label' => 'event description',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'event_date',
                    'label' => 'event date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'event_start_time',
                    'label' => 'event start date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'event_image_data',
                    'label' => 'event image',
                    'rules' => 'required'
                ),
                
                 array(
                    'field' => 'event_contact_person_name',
                    'label' => 'contact person name',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'event_contact_no',
                    'label' => 'contact no',
                    'rules' => 'required'
                ),array(
                    'field' => 'event_email_id',
                    'label' => 'email id',
                    'rules' => 'required|valid_email'
                ),array(
                    'field' => 'event_wed_site',
                    'label' => 'web site',
                    'rules' => 'required|valid_url'
                ),
       
     ),
         'editevent' => array(
               array(
                    'field'     => 'event_title',
                    'label'     => 'event title',
                    'rules'     => 'trim|required'
                ),
                 array(
                    'field' => 'event_venue',
                    'label' => 'event venue',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'venue_address',
                    'label' => 'venue address',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'event_description',
                    'label' => 'event description',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'event_date',
                    'label' => 'event date',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'event_start_time',
                    'label' => 'event start date',
                    'rules' => 'required'
                ),
               
                 array(
                    'field' => 'event_contact_person_name',
                    'label' => 'contact person name',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'event_contact_no',
                    'label' => 'contact no',
                    'rules' => 'required'
                ),array(
                    'field' => 'event_email_id',
                    'label' => 'email id',
                    'rules' => 'required|valid_email'
                ),array(
                    'field' => 'event_wed_site',
                    'label' => 'web site',
                    'rules' => 'required|valid_url'
                ),
     ),
          'trailreportedit' => array(
              array(
                  'field'     => 'county_name',
                  'label'     => 'County name',
                  'rules'     => 'trim|required'
             ),
              array(
                  'field'     => 'zipcode',
                  'label'     => 'Zip Code',
                  'rules'     => 'trim|required'
             ),
             /*  array(
                  'field'     => 'cities',
                  'label'     => 'Cities',
                  'rules'     => 'trim|required'
             ),
                array(
                  'field'     => 'trail_conditions',
                  'label'     => 'Trail Conditions',
                  'rules'     => 'trim|required'
             ),
                 array(
                  'field'     => 'submitted_by',
                  'label'     => 'Submitted By',
                  'rules'     => 'trim|required'
             ),
                 array(
                  'field'     => 'maintainedBy',
                  'label'     => 'Maintained By',
                  'rules'     => 'trim|required'
             ),*/

     ),
          'contactUs' => array(
                array(
                    'field'     => 'title',
                    'label'     => 'Title',
                    'rules'     => 'trim|required'
                ),
        array(
                    'field'     => 'address',
                    'label'     => 'Address',
                    'rules'     => 'trim|required'
                ),
        array(
                    'field'     => 'phone',
                    'label'     => 'Contact Number',
                    'rules'     => 'trim|required'
                ),
        array(
                    'field'     => 'email',
                    'label'     => 'Email',
                    'rules'     => 'trim|required|valid_email'
                ),
        ),
           'mediaSetting' => array(
                array(
                    'field'     => 'facebook',
                    'label'     => 'Facebook',
                    'rules'     => 'trim'
                ),
                 array(
                    'field'     => 'google',
                    'label'     => 'Google',
                    'rules'     => 'trim'
                ),
                 array(
                    'field'     => 'twitter',
                    'label'     => 'Twitter',
                    'rules'     => 'trim'
                ),
                array(
                    'field'     => 'linkrdin',
                    'label'     => 'Linkrdin',
                    'rules'     => 'trim'
                ),
              
                
     ),
    
    
    
)

?>