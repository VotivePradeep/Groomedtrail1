<aside class="left-panel">

            <div class="user text-center">

                  <!--<img src="<?php //echo base_url(); ?>assets_admin/images/avtar/user.png" class="img-circle" alt="...">-->

                  <h4 class="user-name"><?php echo $this->session->userdata('adminname'); ?></h4>

                  <div class="dropdown user-login">

                  <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" aria-expanded="true">

                    <i class="fa fa-circle status-icon available"></i> Available <i class="fa fa-angle-down"></i>

                  </button>

                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

                    <li role="presentation"><a role="menuitem" href="<?php echo base_url(); ?>administrator/logout"><i class="fa fa-circle status-icon signout"></i> Sign out</a></li>

                  </ul>

                  </div>	 

            </div>

            <nav class="navigation">

            	<ul class="list-unstyled">

                <li class="<?php echo (isset($active_tab_dashboard)? $active_tab_dashboard :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/dashboard"><i class="fa fa-home"></i><span class="nav-label">Dashboard</span></a></li>	

                <li class="<?php echo (isset($active_tab_user)? $active_tab_user :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-users"></i><span class="nav-label">User Management</span></a>
                      <ul class="list-unstyled">
                       <?php if(isset($role) && $role!=3) { ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'subadmins')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/subadmins"><i class="fa fa-list-alt"></i>Sub Admins</a></li>
                        <?php } ?>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'users')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/users"><i class="fa fa-list-alt"></i>User List</a></li>
                      </ul>   


                </li>
                <li class="<?php echo (isset($active_cms_page)? $active_cms_page :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/cmspage"><i class="fa fa-file-powerpoint-o"></i><span class="nav-label">Page Management</span></a></li> 

                <li class="<?php echo (isset($active_tab_menu)? $active_tab_menu :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/addmenu"><i class="fa fa-align-justify"></i><span class="nav-label"> Menu Management</span></a></li> 

                <!--<li class="<?php echo (isset($active_tab_cms)? $active_tab_cms :"") ; ?>"><a href="JavaScript:Void(0);"><i class="fa fa-list"></i><span class="nav-label">CMS Management</span></a>
                      <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'aboutus')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/aboutus"><i class="fa fa-list-alt"></i> About us</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'contactus')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/contactus"><i class="fa fa-envelope"></i> Contact us</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'involved')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/involved"><i class="fa  fa-hand-o-right"></i> Get Involved</a></li>
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'volunteering')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/volunteering"><i class="fa fa-database"></i> Volunteering</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'permits_ordering')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/permits_ordering"><i class="fa fa-file-text-o"></i> Permits & Ordering</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'privacy_policy')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/privacy_policy"><i class="fa fa-unlock-alt"></i> Privacy Policy</a></li>

                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'terms')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/cms/terms"><i class="fa fa-files-o" \></i> Terms</a></li>
                         
                      </ul>
                </li>-->
                  <li class="<?php echo (isset($active_tab_route)? $active_tab_route :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/trails"><i class="fa fa-location-arrow"></i><span class="nav-label">Trail Management</span></a></li> 

                <li class="<?php echo (isset($active_tab_poi)? $active_tab_poi :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/poilist"><i class="fa fa-map-marker"></i><span class="nav-label">POIs Management</span></a></li> 

                <li class="<?php echo (isset($active_tab_news)? $active_tab_news :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/newslist"><i class="fa fa-file-text-o"></i><span class="nav-label">News Management</span></a></li> 

                <!--<li class="<?php echo (isset($active_tab_business)? $active_tab_business :"") ; ?>"><a href="<?php echo base_url(); ?>administrator/businesslist"><i class="fa fa-btc"></i><span class="nav-label">Rentals Management</span></a></li>-->

                 <li class="<?php echo (isset($active_tab_password)? $active_tab_password :"") ; ?>"><a href=""><i class="fa fa-cog"></i><span class="nav-label">Setting Management</span></a>
                     <ul class="list-unstyled">
                          <li class="<?php if((isset($basesegment)) && ($basesegment == 'changepassword')) { ?>active<?php } ?>"><a href="<?php echo base_url(); ?>administrator/changepassword"><i class="fa fa-key"></i>Change password</a></li>
                     </ul>     

                 </li>   
					


				

                </ul>

            </nav>

    </aside>

    <!-- Aside Ends-->

	 <section class="content">

        <header class="top-head container-fluid">

            <button type="button" class="navbar-toggle pull-left">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

        </header>

        <!-- Header Ends -->		