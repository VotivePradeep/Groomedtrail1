<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//$route['administrator'] = 'administrator/home/index';

/********** admin Login *********************/
$route['administrator'] = 'logincheck/index';
$route['administrator/login_check'] = "logincheck/sign_in";
$route['administrator/logout'] = "logincheck/signout";
$route['verification_link/(:any)'] = "logincheck/verification_link/$1";
$route['verify/(:any)'] = "logincheck/verification_user/$1";
$route['logout'] = "logincheck/logout";
$route['change_password/(:any)'] = 'login/change_password/$1';
$route['change_password'] = 'login/change_password';

/********** admin Login *********************/




/********** admin Dashboard *********************/
$route['access_denied'] = "administrator/admin/access_denied";
$route['administrator/dashboard'] = "administrator/admin/dashboard";
$route['administrator/changepassword'] = "administrator/admin/changepassword";


///////////////// ********** seo setting  ********* ////////////////
$route['administrator/seo_setting'] = 'administrator/admin/seo_setting';
$route['administrator/seo_setting/add'] = 'administrator/admin/seo_setting/add';
$route['administrator/seo_setting/edit/(:any)'] = 'administrator/admin/seo_setting/edit/$1';

///////////////// ********** CMS PAGE ********* ////////////////

$route['administrator/cmspage'] = 'administrator/admin/cmspage';
$route['administrator/cmspage/addcmspage'] = 'administrator/admin/cmspage/addcmspage';
$route['administrator/cmspage/editcmspage/(:any)'] = 'administrator/admin/cmspage/editcmspage/$1';
$route['administrator/contact'] = 'administrator/admin/cmspage/contact';
$route['administrator/faq'] = 'administrator/admin/faq';
$route['administrator/faq/add'] = 'administrator/admin/faq/add';
$route['administrator/faq/edit/(:any)'] = 'administrator/admin/faq/edit/$1';
$route['administrator/site_map'] = 'administrator/SiteMap/site_map';

$route['administrator/addmenu'] = 'administrator/admin/addmenu';
$route['administrator/googleads'] = 'administrator/admin/googleads';
$route['administrator/set-time-zone'] = 'administrator/admin/timezone';
$route['administrator/googleads_edit/(:any)'] = 'administrator/admin/googleads/$1';
$route['administrator/gmapkey'] = 'administrator/admin/gmapkey';
$route['administrator/paymentcredential'] = 'administrator/admin/paymentcredential';
$route['administrator/facebookcredential'] = 'administrator/admin/facebookcredential';
$route['administrator/googlecredential'] = 'administrator/admin/googlecredential';

///////////////// ********** classifieds List ********* ////////////////
$route['administrator/classifiedslist'] = 'administrator/classifieds/classifiedslist';
$route['administrator/addclassified'] = 'administrator/classifieds/addclassifiedpage';
$route['administrator/editclassified'] = 'administrator/classifieds/editclassifiedpage';
$route['administrator/classifiedslist/(:any)'] = 'administrator/classifieds/classifiedslist/$1';

$route['administrator/classifieds/classifiedcatlist'] = 'administrator/classifieds/classifiedcat/classifiedcatlist';
$route['administrator/classifieds/addclassifiedscat'] = 'administrator/classifieds/classifiedcat/addclassifiedscat';
$route['administrator/classifieds/editclassifiedscat/(:any)'] = 'administrator/classifieds/classifiedcat/editclassifiedscat/$1';
$route['administrator/classifieds/expiration/duration'] = 'administrator/classifieds/classified_expiration_duration/duration';

///////////////// ********** vacation List ********* ////////////////
$route['administrator/rentalslist'] = 'administrator/vacations/vacationlist';
$route['administrator/addrental'] = 'administrator/vacations/addvacationpage';
$route['administrator/editrental/(:any)'] = 'administrator/vacations/editvacationpage/$1';
$route['administrator/viewrental/(:any)'] = 'administrator/vacations/viewvacationpage/$1';
$route['administrator/review'] = 'administrator/vacations/reviews';
$route['administrator/rental/review/(:any)'] = 'administrator/vacations/rental_review_details/$1';
$route['administrator/rental/reviews'] = 'administrator/vacations/rental_review_details';
$route['administrator/rental/reviews/(:any)'] = 'administrator/vacations/rental_review_details/$1';
$route['administrator/rental/review/edit/(:any)'] = 'administrator/vacations/rental_review_details/edit/$1';

$route['administrator/rentalslist/(:any)'] = 'administrator/vacations/vacationlist/$1';

$route['administrator/rentalplan'] = 'administrator/admin/rentalplan';
$route['administrator/rentalplan/add'] = 'administrator/admin/rentalplan/add';
$route['administrator/rentalplan/edit/(:any)'] = 'administrator/admin/rentalplan/edit/$1';
///////////////// ********** state List ********* ////////////////
$route['administrator/state'] = 'administrator/admin/state';
$route['administrator/state/add'] = 'administrator/admin/state/add';
$route['administrator/state/edit/(:any)'] = 'administrator/admin/state/edit/$1';

///////////////// Trail management  ********* ////////////////
$route['administrator/pandingtraillist'] = 'administrator/admin/pandingtraillist';
$route['administrator/traillist'] = 'administrator/admin/traillist';
$route['administrator/trailreport'] = 'administrator/admin/trailreport';
$route['administrator/pending_submissions_trailreport'] = 'administrator/admin/pending_submissions_trail_report';
$route['administrator/trailreportedit/(:any)/(:any)'] = 'administrator/admin/trailreport/trailreportedit/$1/$1';
$route['administrator/trails'] = 'administrator/admin/trails';
///////////////// kmlmanagement  ********* ////////////////

$route['administrator/kmlmanagement'] = 'administrator/admin/kmlmanagement';
$route['administrator/kmlmanagement/uploadkml'] = 'administrator/admin/kmlmanagement/uploadkml';

///////////////// ********** poilist ********* ////////////////

$route['administrator/poilist'] = 'administrator/admin/poilist';
$route['administrator/poilist/addpoi'] = 'administrator/admin/poilist/addpoi';
$route['administrator/poilist/editpoi/(:any)'] = 'administrator/admin/poilist/editpoi/$1';



///////////////// ********** poi type ********* ////////////////

$route['administrator/poitypes'] = 'administrator/admin/poi_type';
$route['administrator/poitypes/add'] = 'administrator/admin/poi_type/add';
$route['administrator/poitypes/edit/(:any)'] = 'administrator/admin/poi_type/edit/$1';




///////////////// ********** newslist ********* ////////////////

$route['administrator/newslist'] = 'administrator/admin/news';
$route['administrator/news/addnews'] = 'administrator/admin/news/addnew';
$route['administrator/news/editnews/(:any)'] = 'administrator/admin/news/editnews/$1';
$route['administrator/news/viewnews/(:any)'] = 'administrator/admin/news/viewnews/$1';

///////////////// ********** email templates ********* ////////////////

$route['administrator/emailsetting'] = 'administrator/admin/emailsetting';
$route['administrator/email/edit/(:any)'] = 'administrator/admin/emailsetting/edit/$1';
$route['administrator/email/view/(:any)'] = 'administrator/admin/emailsetting/view/$1';

///////////////// ********** eventslist ********* ////////////////
$route['administrator/eventslist'] = 'administrator/admin/events';
$route['administrator/events/addevent'] = 'administrator/admin/events/addevent';
$route['administrator/events/editevent/(:any)'] = 'administrator/admin/events/editevent/$1';
$route['administrator/events/view/(:any)'] = 'administrator/admin/events/view/$1';

///////////////// ********** businesslist ********* ////////////////

$route['administrator/businesslist'] = 'administrator/admin/business';
$route['administrator/business/addbusiness'] = 'administrator/admin/business/addbusiness';
$route['administrator/business/editbusiness/(:any)'] = 'administrator/admin/business/editbusiness/$1';



///////////////// ********** User List ********* ////////////////
$route['administrator/users'] = 'administrator/admin/users';
$route['administrator/userdetails/(:any)'] = 'administrator/admin/users/userdetails/$1';
//$route['administrator/edituser/(:any)'] = 'administrator/admin/users/edituser/$1';
$route['administrator/useredit/(:any)'] = 'administrator/admin/users/useredit/$1';
//$route['administrator/addsubadmin'] = 'administrator/admin/users/addsubadmin';
$route['administrator/adduser'] = 'administrator/admin/users/adduser';
$route['administrator/subadmins'] = 'administrator/admin/users/subadmins';
$route['administrator/updateprofile'] = 'administrator/admin/updateprofile';

///////////////// ********** role List ********* ////////////////
$route['administrator/roles'] = 'administrator/admin/roles';
$route['administrator/role/add'] = 'administrator/admin/roles/add';
$route['administrator/role/pemission/$1'] = 'administrator/admin/roles/pemission/$1';
$route['administrator/role/edit/(:any)'] = 'administrator/admin/roles/edit/$1';

///////////////// ********** permission List ********* ////////////////
$route['administrator/permissions'] = 'administrator/admin/permissions';
$route['administrator/permissions/add'] = 'administrator/admin/permissions/add';
$route['administrator/permissions/edit/(:any)'] = 'administrator/admin/permissions/edit/$1';


///////////////// ********** enquiry list ********* ////////////////
$route['administrator/contactus_store'] = 'administrator/admin/contactus_store';
$route['administrator/contactus'] = 'administrator/admin/contactus';
$route['administrator/contactus_move'] = 'administrator/admin/contactus_move';
$route['administrator/view/(:any)'] = 'administrator/admin/view_enquiry/$1';

///////////////// ********** socialmedia ********* ////////////////
$route['administrator/socialmedia'] = 'administrator/admin/socialmedia';
$route['administrator/subcription_form'] = 'administrator/admin/subcription_form';

///////////////// ********** Forum ********* ////////////////
$route['administrator/forum_heading'] = 'administrator/admin/forum_heading';
$route['administrator/forum_category'] = "administrator/forum_category/index";
$route['administrator/add_forum_category'] = "administrator/forum_category/add_category";
$route['administrator/forum/(:any)'] = "administrator/forum/categoryPost/$1";
$route['administrator/forum/(:any)/(:num)'] = "administrator/forum/categoryPost/$1/$2";
$route['administrator/forum/(:any)/(:any)/(:num)'] = "administrator/forum/index/$1/$2/$3";
$route['administrator/forum/(:any)/(:any)'] = "administrator/forum/index/$1/$2";
$route['administrator/forum_topic_add'] = "administrator/forum/addnewTopic"; 
$route['administrator/comment'] = "administrator/forum/comment"; 
$route['administrator/comment_update'] = "administrator/forum/comment_update"; 
$route['administrator/forumlike'] = "administrator/forum/like";
$route['administrator/topiccheckAlready'] = "administrator/forum/topiccheckAlready"; 
$route['administrator/already_exit_post_title'] = "administrator/forum/already_exit_post_title"; 

/********** admin Dashboard *********************/

/****************front end *********************/
$route['mymap'] = 'home/mymap';
$route['faq'] = 'home/faq';
$route['home'] = 'home/index';
$route['news'] = 'home/mynews';
$route['events'] = 'home/event';
$route['pastevents'] = 'home/pastevents';
$route['newdetail/(:any)'] = 'home/newdetail/$1';
$route['eventdetail/(:any)'] = 'home/eventdetail/$1';
$route['contact'] = 'home/contact';
$route['home/(:any)'] = 'home/cmspage/$1';
$route['forums'] = 'home/forums';
$route['lodgingdetail/(:any)'] = 'home/businessdetail/$1';
$route['forumdetail'] = 'home/forumdetail';
$route['trailreport'] = 'home/trailreport';
$route['classified'] = 'home/classified';
$route['classified/(:any)'] = 'home/classifiedcategory/$1';
$route['classifiedcategory/(:any)'] = 'home/classifiedcategory1/$1';
$route['classified/details/(:any)'] = 'home/classifiedetails/$1';
$route['report/(:any)'] = 'home/report/$1';
$route['details/(:any)/(:any)'] = 'home/news_feed_details/$i/$2';
$route['terms/(:any)'] = 'terms/cmspage/$1';

$route['lodging'] = 'home/vacationallist';
$route['lodging/(:any)'] = 'home/vacationalbusiness/$1';
//$route['vacationrentals'] = 'home/vacationrentals';




$route['signup'] = 'logincheck/signup';
$route['login'] = 'logincheck/login';
$route['login1'] = 'login/index';


/****************front end *********************/

/*******************User Side******************************/

/****************forum*********************/

$route['forum/(:any)'] = "frontEnd/forum/categoryPost/$1";
$route['forum/(:any)/(:num)'] = "frontEnd/forum/categoryPost/$1/$2";
$route['forum/(:any)/(:any)/(:num)'] = "frontEnd/forum/index/$1/$2/$3";
$route['forum/(:any)/(:any)'] = "frontEnd/forum/index/$1/$2";
$route['forum_test'] = "frontEnd/forum/forum_comm_order";
$route['forumlike'] = "frontEnd/forum/like";
$route['community-forum'] = "frontEnd/forum/categoryList";
$route['forum_topic_add'] = "frontEnd/forum/addnewTopic";
$route['editorfile'] = "frontEnd/forum/editorfile";



/****************forum*********************/
