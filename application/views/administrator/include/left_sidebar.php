<?php $this->load->helper('custom_helper'); ?>
<aside class="left-panel">
            <div class="site-logo">
             <img src="<?php echo base_url(); ?>assets/images/logo.png" class="one">
             <img src="<?php echo base_url(); ?>assets/images/2017-05-11 (2).png" class="two">
            </div>
            <nav class="navigation">
              <ul class="list-unstyled">
                <li class="<?php echo (isset($active_tab_dashboard)? $active_tab_dashboard :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/dashboard"><i class="fa fa-home"></i><span class="nav-label">Dashboard</span></a></li> 

               <?php if ($u_id==1 && ($role==1)) { ?>

                <li class="<?php echo (isset($active_tab_user)? $active_tab_user :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-users"></i><span class="nav-label">User Management</span></a>
                  <ul class="list-unstyled">
                    <li class="<?php if((isset($basesegment)) && ($basesegment == 'users') || ($basesegment == 'userdetails')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-location-arrow"></i> User List</a></li>
                    <li class="<?php if((isset($basesegment)) && ($basesegment == 'roles') || ($basesegment == 'roles')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/roles"><i class="fa fa-location-arrow"></i> Roles List</a></li>
                    <li class="<?php if((isset($basesegment)) && ($basesegment == 'permissions') || ($basesegment == 'permissions')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/permissions/add"><i class="fa fa-location-arrow"></i>Add Permissions</a></li>
                   <!--  <li class="<?php if((isset($basesegment)) && ($basesegment == 'subadmins') || ($basesegment == 'subadmins')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/subadmins"><i class="fa fa-location-arrow"></i> Sub Admin List</a></li> -->
                  </ul>
                </li>

                <li class="<?php if(isset($active_cms_page) || isset($active_tab_menu)){ echo 'active'; }?>"><a href=""><i class="fa fa-file-powerpoint-o"></i><span class="nav-label">Page Management</span></a>
                 <ul class="list-unstyled">
                    <li class="<?php echo (isset($active_tab_menu)? $active_tab_menu :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/addmenu"><i class="fa fa-location-arrow"></i> Menu Management</a></li>
                    <li <?php if(isset($basesegment)){if($basesegment == 'cmspage'){?>class="active"<?php }} ?>><a href="<?php echo base_url(); ?>administrator/cmspage"><i class="fa fa-location-arrow"></i> Frontend Pages</a></li>
                    <li <?php if(isset($basesegment)){if($basesegment == 'faq'){?>class="active"<?php }} ?>><a href="<?php echo base_url(); ?>administrator/faq"><i class="fa fa-location-arrow"></i> FAQ</a></li>
                    <li <?php if(isset($basesegment)){if($basesegment == 'contact'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contact"><i class="fa fa-location-arrow"></i> Contactus Page</a></li>
                   
                  </ul>

                </li>
                <li class="<?php echo (isset($active_tab_contact)? $active_tab_contact :"") ; ?>"><a href="javascript:void(0);"><i class="fa fa-th-list"></i> 
                      <span class="nav-label">Messaging</span></a>
                        <ul class="list-unstyled">
                          <li <?php if(isset($segment)){if($segment == 'contactus'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus"><i class="fa fa-location-arrow"></i> Inbox</a></li>
                          <li <?php if(isset($segment)){if($segment == 'contactus_store'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus_store"><i class="fa fa-location-arrow"></i> Archives</a></li>
                          <li <?php if(isset($segment)){if($segment == 'contactus_move'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus_move"><i class="fa fa-location-arrow"></i> Deleted Messages</a></li>
                        </ul>
               </li>
                <li class="<?php if(isset($active_tab_kml) || isset($active_tab_poi) || isset($active_tab_trail) || isset($active_tab_trail_report) || isset($active_tab_state)){ echo 'active'; }?>"><a href=""><i class="fa fa-tasks" aria-hidden="true"></i><span class="nav-label">MAP Management</span></a>
                     <ul class="list-unstyled">
                          <li class="<?php echo (isset($active_tab_kml)? $active_tab_kml :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/kmlmanagement"><i class="fa fa-map-marker"></i>KML Management</a></li>
                          <li class="<?php echo (isset($active_tab_poi)? $active_tab_poi :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/poilist"><i class="fa fa-map-marker"></i>POI Management</a></li>
                          <li class="<?php echo (isset($active_tab_trail)? $active_tab_trail :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/traillist"><i class="fa fa-map-marker"></i>Trail Management</a></li>
                          <li class="<?php echo (isset($active_tab_trail_report)? $active_tab_trail_report :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/trailreport"><i class="fa fa-map-marker"></i>Trail Reporting Management</a></li>
                           <li class="<?php if((isset($basesegment)) && ($basesegment == 'state')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/state"><i class="fa fa-home"></i>State Management</a></li> 

                     </ul>     

                 </li> 

                <li class="<?php echo (isset($active_tab_news)? $active_tab_news :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/newslist" onclick="view_notification('tbl_news')"><i class="fa fa-newspaper-o"></i><span class="nav-label">News Management</span> 
                  <?php 
                      if(!empty(view_news_admin())){
                      echo '<span class="view_count_cls">';
                      echo count(view_news_admin());
                      echo '</span>';
                  } ?> </a></li> 
                <li class="<?php echo (isset($active_tab_event)? $active_tab_event :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/eventslist"><i class="fa fa-calendar" aria-hidden="true"></i><span class="nav-label">Event Management</span></a></li> 

                <li class="<?php echo (isset($active_tab_forum)? $active_tab_forum :"") ; ?>"><a href=""><i class="fa fa-comments" aria-hidden="true"></i><span class="nav-label">Forum Management</span>
                  <?php 
                      if(!empty(view_forum_admin())){
                      echo '<span class="view_count_cls">';
                      echo count(view_forum_admin());
                      echo '</span>';
                  } ?>


                  </a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'forum_category')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/forum_category" onclick="view_notification('forum_question')"><i class="fa fa-location-arrow"></i>Forum Category List 
                         <?php 
                              if(!empty(view_forum_admin())){
                              echo '<span class="view_count_cls">';
                              echo count(view_forum_admin());
                              echo '</span>';
                          } ?>

                        </a></li>
                      <li class="<?php if((isset($basesegment)) && ($basesegment == 'forum_heading')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/forum_heading" ><i class="fa fa-location-arrow"></i>Forum Heading
                      </a></li>
                     </ul>     

                 </li> 
                              
                  <li class="<?php echo (isset($active_tab_classifieds)? $active_tab_classifieds :"") ; ?>"><a href=""><i class="fa fa-file-text-o"></i><span class="nav-label">Classifieds Management</span>
                    <?php 
                      if(!empty(view_classified_admin())){
                      echo '<span class="view_count_cls">';
                      echo count(view_classified_admin());
                      echo '</span>';
                    } ?>
                  </a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($segment)) && ($segment == 'classifiedcatlist')) { ?>active<?php } ?>"><a href="<?php echo base_url();?>administrator/classifieds/classifiedcatlist" ><i class="fa fa-location-arrow"></i>Classifieds Category List 
                          </a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'classifiedslist')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/classifiedslist" onclick="view_notification('tbl_classified_list')"><i class="fa fa-location-arrow"></i>Classifieds List 
                        <?php 
                          if(!empty(view_classified_admin())){
                          echo '<span class="view_count_cls">';
                          echo count(view_classified_admin());
                          echo '</span>';
                        } ?>
                      </a></li>
                     </ul>     

                 </li>  

                 <li class="<?php echo (isset($active_tab_vacation)? $active_tab_vacation :"") ; ?>"><a href="">
                  <i class="fa fa-university"></i><span class="nav-label">Vacation Rentals</span> <?php 
                            if(!empty(view_vaction_admin()) || !empty(view_review_admin())){
                              echo '<span class="view_count_cls">';
                              echo count(view_vaction_admin()) + count(view_review_admin());
                              echo '</span>';
                             } ?></a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'rentalslist')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rentalslist" onclick="view_notification('tbl_vacation_list')"><i class="fa fa-location-arrow"></i>Rental Listings <?php $rentalResult = view_vaction_admin();
                            if(!empty($rentalResult)){
                              echo '<span class="view_count_cls">';
                              echo count($rentalResult);
                              echo '</span>';
                             } ?></a></li>
                          <li class="<?php $act = $this->uri->segment(3); if((isset($act)) && ($act == 'reviews')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rental/reviews" onclick="view_notification('tbl_review')"><i class="fa fa-location-arrow"></i>Rentals Reviews 
                            <?php $reviewsResult = view_review_admin();
                            if(!empty($reviewsResult)){
                              echo '<span class="view_count_cls">';
                              echo count($reviewsResult);
                              echo '</span>';
                             } ?>
                          </a></li>
                           <li class="<?php if((isset($basesegment)) && ($basesegment == 'rentalplan')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rentalplan"><i class="fa fa-location-arrow"></i>Rental Plan</a></li>
                     </ul>     

                 </li>
                 <li class="<?php if(isset($active_tab_password) || isset($active_tab_google_ads) || isset($paymentcredential) || isset($active_tab_timezone) || isset($active_tab_site_map)){ echo 'active'; }?>"><a href=""><i class="fa fa-cog"></i><span class="nav-label">Setting Management</span></a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'changepassword')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/changepassword"><i class="fa fa-key"></i>Change password</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'updateprofile')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/updateprofile"><i class="fa fa-user"></i>Update Profile</a></li>
                            <li class="<?php if((isset($basesegment)) && ($basesegment == 'googleads')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/googleads"><i class="fa fa-location-arrow"></i>Google Ads</a></li> 
                            <li class="<?php if((isset($basesegment)) && ($basesegment == 'googlecredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/googlecredential"><i class="fa fa-location-arrow"></i>Google  oAuth Settings</a></li>
                           <li class="<?php if((isset($basesegment)) && ($basesegment == 'facebookcredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/facebookcredential"><i class="fa fa-location-arrow"></i>Facebook oAuth Settings</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'gmapkey')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/gmapkey"><i class="fa fa-location-arrow"></i>Google Map Key</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'paymentcredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/paymentcredential"><i class="fa fa-location-arrow"></i>Payment Settings</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'emailsetting')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/emailsetting"><i class="fa fa-location-arrow"></i>Email Settings</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'subcription_form')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/subcription_form"><i class="fa fa-location-arrow"></i>Subscription Details</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'socialmedia')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/socialmedia"><i class="fa fa-location-arrow"></i>Social Media Setting</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'seo_setting')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/seo_setting"><i class="fa fa-location-arrow"></i>SEO Settings</a></li>

                          <!-- <li class="<?php if((isset($basesegment)) && ($basesegment == 'site_map')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/site_map"><i class="fa fa-location-arrow"></i>Generat Sitemap </a></li> -->


                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'set-time-zone')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/set-time-zone"><i class="fa fa-location-arrow"></i>Time Zone Setting</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'cmspage')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cmspage/editcmspage/6"><i class="fa fa-location-arrow"></i>Terms and Condition</a></li>
                     </ul>
                 </li>
            <?php } else if($role==3) { ?>
                  <?php
                      $flag=0;$flag25=0;$flag26=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==1) { 
                                  $flag = 1;
                              }
                              if ($checkper->permission_id==25) { 
                                  $flag25 = 1;
                              }
                              if ($checkper->permission_id==26) { 
                                  $flag26 = 1;
                              }
                          }
                      }
                   if ($flag == 1 || $flag25 == 1 || $flag26 == 1  ) {  ?>
                      <li class="<?php echo (isset($active_tab_user)? $active_tab_user :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-users"></i><span class="nav-label">User Management</span></a>
                        <ul class="list-unstyled">
                         <?php if($flag == 1){ ?>
                            <li class="<?php if((isset($basesegment)) && ($basesegment == 'users')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-location-arrow"></i> User List</a></li>
                            <?php } ?>
                            <?php if($flag25 == 1){ ?>
                            <li class="<?php if((isset($basesegment)) && ($basesegment == 'roles') || ($basesegment == 'roles')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/roles"><i class="fa fa-location-arrow"></i> Roles List</a></li>
                            <?php } ?>
                            <?php if($flag26 == 1){ ?>
                            <li class="<?php if((isset($basesegment)) && ($basesegment == 'permissions') || ($basesegment == 'permissions')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/permissions/add"><i class="fa fa-location-arrow"></i>Add Permissions</a></li>
                            <?php } ?>
                        </ul>
                      </li>
                       <?php } ?>
                       <?php
                      $flag29=0;
                      $flag30=0;
                      $flag31=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==29) { 
                                  $flag29 = 1;
                              }
                               if ($checkper->permission_id==30) { 
                                  $flag30 = 1;
                              }
                               if ($checkper->permission_id==31) { 
                                  $flag31 = 1;
                              }
                          }
                      }
                   if ($flag29 == 1 ||$flag30 == 1 || $flag31 == 1  ) {  ?>
                    <li class="<?php if(isset($active_cms_page) || isset($active_tab_menu)){ echo 'active'; }?>"><a href=""><i class="fa fa-file-powerpoint-o"></i><span class="nav-label">Page Management</span></a>
                    <ul class="list-unstyled">
                      <?php if($flag30 == 1){ ?>
                      <li class="<?php echo (isset($active_tab_menu)? $active_tab_menu :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/addmenu"><i class="fa fa-location-arrow"></i> Menu Management</a></li>
                      <?php } ?>
                      <?php if($flag29 == 1){ ?>
                      <li <?php if(isset($basesegment)){if($basesegment == 'cmspage'){?>class="active"<?php }} ?>><a href="<?php echo base_url(); ?>administrator/cmspage"><i class="fa fa-location-arrow"></i> Frontend Pages</a></li>
                      <?php } ?>
                      <?php if($flag31 == 1){ ?>
                      <li <?php if(isset($basesegment)){if($basesegment == 'faq'){?>class="active"<?php }} ?>><a href="<?php echo base_url(); ?>administrator/faq"><i class="fa fa-location-arrow"></i> FAQ</a></li>
                      <?php } ?>
                      <?php if($flag29 == 1){ ?>
                      <li <?php if(isset($basesegment)){if($basesegment == 'contact'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contact"><i class="fa fa-location-arrow"></i> Contactus Page</a></li>
                      <?php } ?>
                     
                    </ul>

                    </li>
                    <?php } ?>
                     <?php
                      $flag32=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==32) { 
                                  $flag32 = 1;
                              }
                          }
                      }
                   if ($flag32 == 1) {  ?>

                    <li class="<?php echo (isset($active_tab_contact)? $active_tab_contact :"") ; ?>"><a href="javascript:void(0);"><i class="fa fa-th-list"></i> 
                      <span class="nav-label">Messaging</span></a>
                        <ul class="list-unstyled">
                          <li <?php if(isset($segment)){if($segment == 'contactus'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus"><i class="fa fa-location-arrow"></i> Inbox</a></li>
                          <li <?php if(isset($segment)){if($segment == 'contactus_store'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus_store"><i class="fa fa-location-arrow"></i> Archives</a></li>
                          <li <?php if(isset($segment)){if($segment == 'contactus_move'){?>class="active"<?php }} ?>><a href="<?php echo base_url();?>administrator/contactus_move"><i class="fa fa-location-arrow"></i> Deleted Messages</a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php $flag1 = 0;
                    $flag2 = 0;
                    $flag3 = 0;
                    $flag4 = 0;
                    $flag6 = 0;
                    if (isset($checkpers)) {
                    foreach ($checkpers as $checkper) {  
                    if ($checkper->permission_id==2){
                       $flag1 = 1;
                    }
                     if ($checkper->permission_id==3){
                       $flag2 = 1;
                    }
                    if ($checkper->permission_id==4){
                       $flag3 = 1;
                    }
                    if ($checkper->permission_id==5){
                       $flag4 = 1;
                    }
                    if ($checkper->permission_id==6){
                       $flag6 = 1;
                    }

                     } ?>

                         <?php   
                              if ($flag1==1 || $flag2==1 || $flag3==1 || $flag4==1 || $flag6==1) { ?>

                      <li class="<?php if(isset($active_tab_kml) || isset($active_tab_poi) || isset($active_tab_trail) || isset($active_tab_trail_report) || isset($active_tab_state)){ echo 'active'; }?>"><a href=""><i class="fa fa-file-text-o"></i><span class="nav-label">MAP Management</span></a>
                     <ul class="list-unstyled">
                     <?php 

                     if ($flag1 == 1 ) {  ?>
                          <li class="<?php echo (isset($active_tab_kml)? $active_tab_kml :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/kmlmanagement"><i class="fa fa-map-marker"></i>KML Management</a></li>
                      <?php } ?>
                       <?php 
                       if ($flag2 == 1 ) {  ?>
                         <li class="<?php echo (isset($active_tab_poi)? $active_tab_poi :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/poilist"><i class="fa fa-map-marker"></i>POI Management</a></li>
                      <?php } ?>
                      <?php 
                      if ($flag3 == 1 ) {  ?>
                          <li class="<?php echo (isset($active_tab_trail)? $active_tab_trail :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/traillist"><i class="fa fa-map-marker"></i>Trail Management</a></li>
                      <?php } ?>
                      <?php
                       if ($flag4 == 1 ) {  ?>
                        <li class="<?php echo (isset($active_tab_trail_report)? $active_tab_trail_report :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/trailreport"><i class="fa fa-map-marker"></i>Trail Reporting Management</a></li>
                      <?php } ?>
                      <?php 
                      if ($flag6 == 1 ) {  ?>
                         <li class="<?php if((isset($basesegment)) && ($basesegment == 'state')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/state"><i class="fa fa-home"></i>State Management</a></li> 
                      <?php } ?>
                     </ul>  
                 </li> 
                 <?php  }  } ?>
                 <?php
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==7) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                     <li class="<?php echo (isset($active_tab_news)? $active_tab_news :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/newslist"><i class="fa fa-newspaper-o"></i><span class="nav-label">News Management</span></a></li> 
                <?php }  ?>
                 <?php
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==8) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                     <li class="<?php echo (isset($active_tab_event)? $active_tab_event :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/eventslist"><i class="fa fa-calendar" aria-hidden="true"></i><span class="nav-label">Event Management</span></a></li> 
                <?php }  ?>
                 <?php
                      $flag=0;$flag1 = 0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==9) { 
                                  $flag = 1;
                              }
                              if ($checkper->permission_id==27) { 
                                  $flag1 = 1;
                              }
                          }
                      }
                  if ($flag == 1 || $flag1 == 1) {  ?>
                 <li class="<?php echo (isset($active_tab_forum)? $active_tab_forum :"") ; ?>"><a href=""><i class="fa fa-comments" aria-hidden="true"></i><span class="nav-label">Forum Management</span>
                  </a>
                     <ul class="list-unstyled">
                      <?php if ($flag == 1) {  ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'forum_category')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/forum_category" ><i class="fa fa-location-arrow"></i>Forum Category List  </a></li>
                      <?php } ?>
                      <?php if ($flag1 == 1) {  ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'forum_heading')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/forum_heading" ><i class="fa fa-location-arrow"></i>Forum Heading
                          </a></li>
                      <?php } ?>
                     </ul>     

                 </li> 
                <?php }  ?>
                 <?php 
                 $flag10 = 0; 
                 $flag11= 0;
                 if (isset($checkpers)) {
                       
                          foreach ($checkpers as $checkper1) {    
                              if ($checkper1->permission_id==10) { 
                                 $flag10 = 1;
                               } 
                               if ($checkper1->permission_id==11) { 
                                 $flag11 = 1;
                               }
                          }  
                          if($flag10 == 1 || $flag11 == 1){
                          ?>

                     <li class="<?php echo (isset($active_tab_classifieds)? $active_tab_classifieds :"") ; ?>"><a href=""><i class="fa fa-file-text-o"></i><span class="nav-label">Classifieds Management </span>
                    <?php  
                      if(!empty(view_classified_admin())){
                      echo '<span class="view_count_cls">';
                      echo count(view_classified_admin());
                      echo '</span>';
                    } ?>
                  </a>
                     <ul class="list-unstyled">
                     <?php 
                     if ($flag10 == 1 ) {  ?>
                          <li class="<?php if((isset($segment)) && ($segment == 'classifiedcatlist')) { ?>active<?php } ?>"><a href="<?php echo base_url();?>administrator/classifieds/classifiedcatlist" ><i class="fa fa-location-arrow"></i>Classifieds Category List 
                          </a></li>
                      <?php } 
                      if ($flag11 == 1 ) {  ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'classifiedslist')) { ?>active<?php } ?>">
                          <a href="<?php echo base_url(); ?>administrator/classifiedslist" onclick="view_notification('tbl_classified_list')"><i class="fa fa-location-arrow"></i>Classifieds List 
                            <?php 
                              if(!empty(view_classified_admin())){
                              echo '<span class="view_count_cls">';
                              echo count(view_classified_admin());
                              echo '</span>';
                            } ?>
                          </a>
                       </li>
                      <?php } ?>
                      
                     </ul>  
                 </li> 
                 <?php } }  ?>

                 <?php 
                $flag14= 0;
                $flag15= 0;
                $flag16= 0;
                 if (isset($checkpers)) {
                       
                          foreach ($checkpers as $checkper1) {    
                              if ($checkper1->permission_id==14) { 
                                 $flag14 = 1;
                               } 
                               if ($checkper1->permission_id==15) { 
                                 $flag15 = 1;
                               }
                               if ($checkper1->permission_id==16) { 
                                 $flag16 = 1;
                               } 
                          }  
                          if($flag14 == 1 || $flag15 == 1 || $flag16 == 1){
                          ?>

                 <li class="<?php echo (isset($active_tab_vacation)? $active_tab_vacation :"") ; ?>"><a href="">
                  <i class="fa fa-university"></i><span class="nav-label">Vacation Rentals</span> <?php 
                            if(!empty(view_vaction_admin()) || !empty(view_review_admin())){
                              echo '<span class="view_count_cls">';
                              echo count(view_vaction_admin()) + count(view_review_admin());
                              echo '</span>';
                             } ?></a>
                     <ul class="list-unstyled">
                      <?php if ($flag14 == 1 ) {  ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'rentalslist')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rentalslist" onclick="view_notification('tbl_vacation_list')"><i class="fa fa-location-arrow"></i>Rental Listings <?php $rentalResult = view_vaction_admin();
                            if(!empty($rentalResult)){
                              echo '<span class="view_count_cls">';
                              echo count($rentalResult);
                              echo '</span>';
                             } ?></a></li>
                      <?php } ?>
                      <?php if ($flag15 == 1 ) {  ?>
                           <li class="<?php if((isset($basesegment)) && ($basesegment == 'reviews')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rental/reviews" onclick="view_notification('tbl_review')"><i class="fa fa-location-arrow"></i>Rentals Reviews 
                            <?php $reviewsResult = view_review_admin();
                            if(!empty($reviewsResult)){
                              echo '<span class="view_count_cls">';
                              echo count($reviewsResult);
                              echo '</span>';
                             } ?>
                          </a></li>
                      <?php } ?>
                      <?php if ($flag16 == 1 ) {  ?>
                       <li class="<?php if((isset($basesegment)) && ($basesegment == 'rentalplan')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/rentalplan"><i class="fa fa-location-arrow"></i>Rental Plan</a></li>
                       <?php } ?>
                     </ul>     

                 </li>
                 <?php } } ?>

                 <li class="<?php if(isset($active_tab_password) || isset($active_profile_page)  || isset($active_tab_timezone)){ echo 'active'; }?>"><a href=""><i class="fa fa-cog"></i><span class="nav-label">Setting Management</span></a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'changepassword')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/changepassword"><i class="fa fa-key"></i>Change password</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'updateprofile')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/updateprofile"><i class="fa fa-user"></i>Update Profile</a></li>
                           <?php 
                          $flag18= 0; $flag19= 0;$flag20= 0;$flag21= 0; $flag22= 0;$flag23= 0;$flag24= 0;$flag33= 0;$flag34= 0;$flag30=0;
                          if (isset($checkpers)) {
                          foreach ($checkpers as $checkper1) {    
                               if ($checkper1->permission_id==18) { 
                                 $flag18 = 1;
                               } 
                               if ($checkper1->permission_id==19) { 
                                 $flag19 = 1;
                               } 
                               if ($checkper1->permission_id==20) { 
                                 $flag20 = 1;
                               }
                               if ($checkper1->permission_id==21) { 
                                 $flag21 = 1;
                               }
                               if ($checkper1->permission_id==22) { 
                                 $flag22 = 1;
                               }
                               if ($checkper1->permission_id==23) { 
                                 $flag23 = 1;
                               }
                               if ($checkper1->permission_id==24) { 
                                 $flag24 = 1;
                               }
                               if ($checkper1->permission_id==33) { 
                                 $flag33 = 1;
                               }
                               if ($checkper1->permission_id==34) { 
                                 $flag34 = 1;
                               }
                               if ($checkper1->permission_id==30) { 
                                 $flag30 = 1;
                               }
                          }  
                           if($flag19 == 1 || $flag20 == 1 || $flag21 == 1 || $flag22 == 1 || $flag23 == 1 || $flag33 = 1 || $flag34 = 1 || $flag30 =1){
                          ?>
                           <?php if($flag18 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'googleads')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/googleads"><i class="fa fa-location-arrow"></i>Google Ads</a></li>
                          <?php } ?> 
                          <?php if($flag20 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'googlecredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/googlecredential"><i class="fa fa-location-arrow"></i>Google  oAuth Settings</a></li>
                         <?php } ?>
                         <?php if($flag19 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'facebookcredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/facebookcredential"><i class="fa fa-location-arrow"></i>Facebook oAuth Settings</a></li>
                         <?php } ?>
                         <?php if($flag21 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'gmapkey')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/gmapkey"><i class="fa fa-location-arrow"></i>Google Map Key</a></li>
                         <?php } ?>
                         <?php if($flag22 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'paymentcredential')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/paymentcredential"><i class="fa fa-location-arrow"></i>Payment Settings</a></li>
                         <?php } ?>
                         <?php if($flag23 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'emailsetting')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/emailsetting"><i class="fa fa-location-arrow"></i>Email Settings</a></li>
                         <?php } ?>
                         <?php if($flag24 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'socialmedia')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/socialmedia"><i class="fa fa-location-arrow"></i>Social Media Setting</a></li>
                          <?php } ?>
                          <?php if($flag33 == 1) { ?>
                         <li class="<?php if((isset($basesegment)) && ($basesegment == 'seo_setting')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/seo_setting"><i class="fa fa-location-arrow"></i>SEO Settings</a></li>
                         <!-- <li class="<?php if((isset($basesegment)) && ($basesegment == 'site_map')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/site_map"><i class="fa fa-location-arrow"></i>Generat Sitemap </a></li> -->
                          <?php } ?>
                           <?php if($flag34 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'set-time-zone')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/set-time-zone"><i class="fa fa-location-arrow"></i>Time Zone Setting</a></li>

                          <?php } ?>
                          <?php if($flag30 == 1) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'cmspage')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cmspage/editcmspage/6"><i class="fa fa-location-arrow"></i>Terms and Condition</a></li>
                         <?php } ?>
                          <?php } } ?>

                     </ul>
                 </li>
                   
                   <?php }  //role else close ?>
              </ul>
            </nav>

    </aside>

    <!-- Aside Ends-->

   <section class="content">
    <header class="top-head container-fluid">
      <div class="col-sm-6">
        <button type="button" class="navbar-toggle pull-left">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="col-sm-6">
        <div class="user text-center">
          <div class="dropdown user-login">
            <ul class="log-out">
              <li>
                 <?php 
                    $result1 = notification_a($u_id);

                    //print_r( $result1);
                ?>

                <a role="menuitem" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <span class="notcount"><?php if(isset($result1)){echo count($result1);}?></span></a>
                
                 
                  <ul class="dropdown-menu notification-menu">
                    <?php    if(isset($result1) && !empty($result1)){ ?>
                    <?php foreach ($result1 as $r) { ?>
                      <li onclick="viewnot('tbl_notification', <?php if(isset($r['n_id'])){echo $r['n_id'];}?>)"><a href="<?php echo base_url().'administrator/viewrental/' ?><?php if(isset($r['vac_id'])){echo $r['vac_id'];}?>" onclick="viewnot('tbl_notification', <?php if(isset($r['n_id'])){echo $r['n_id'];}?>)"><?php if(isset($r['n_type'])){if($r['n_type'] == 'add_rental'){echo '<h4>Rentals</h4>';}else if($r['n_type'] == 'rental_payment'){echo '<h4>Rental Payment Done</h4>';} } ?><?php if(isset($r['vac_name'])){ echo $r['vac_name'];}?>
                        Date : <?php if(isset($r['n_date'])){ $date = date_create($r['n_date']); 
                            echo date_format($date, 'd M Y');}?>
                      </a>
                      </li>
                    <?php  } } else{?>
                    <li><span class="no-noti-cls">No Notification</span></li>
                    <?php }?>
                      
                  </ul>
                  
              </li>
              <li role="presentation">
                
                <a role="menuitem" href="<?php echo base_url(); ?>administrator/logout"><i class="fa fa-sign-out status-icon signout" style="font-size: 15px;color :red !important;"></i></a>
              </li>
            </ul>
          </div>   
        </div>
      </div>
    </header>

<!-- Header Ends -->    
<script>
  function viewnot(tablename,id){
   $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/viewnot'; ?>',
      data: { tablename:tablename,id:id },
      success: function(data)
      {

      }
    });
  }
  function view_notification(tablename){
   $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/view_notification'; ?>',
      data: { tablename:tablename },
      success: function(data)
      {
      }
    });
  }
</script>