<?php include('include/left_sidebar.php'); ?>
<style type="text/css">
	span.pull-left.dashbord-view-btn {
    background-color: #428bca;
    color: #fff;
    padding: 5px;
}
</style>
    <div class="warper container-fluid">
        <div class="page-header dash_pg_head">
            <h1>Dashboard <small>Let's get a quick overview...</small></h1>
        </div>
		<div class="dash_whole_body_wrap">
			<div class="row">
				<?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/users">						
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-users"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Users</h2>
										<p class="total-cls"><?php if(isset($userCount)){echo count($userCount); } ?></p>
										<p>Number of new users </p>
										<p>(last 24 hours) - 
											<?php if(isset($userCountNowDate)){ 
											echo count($userCountNowDate); 
										} ?></p> </div>
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==1) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/users">						
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-users"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Users</h2>
										<p class="total-cls"><?php if(isset($userCount)){echo count($userCount); } ?></p>
										<p>Number of new users </p>
										<p>(last 24 hours) - 
											<?php if(isset($userCountNowDate)){ 
											echo count($userCountNowDate); 
										} ?></p> </div>
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } }?>
              <?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/trailreport">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-globe"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Update Trail Report</h2>
										 <p class="total-cls"><?php if(isset($TrailReport)){ 
											echo count($TrailReport); 
										} ?></p>
										<p>Pending Trail Report - <?php if(isset($pandingTrailReport)){ 
											echo count($pandingTrailReport); 
										} ?></p>
										<p>Approve Trail Report - <?php if(isset($ApproveTrailReport)){ 
											echo count($ApproveTrailReport); 
										} ?></p>
										</div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==5) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/trailreport">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-globe"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Update Trail Report</h2>
										 <p class="total-cls"><?php if(isset($TrailReport)){ 
											echo count($TrailReport); 
										} ?></p>
										<p>Pending Trail Report - <?php if(isset($pandingTrailReport)){ 
											echo count($pandingTrailReport); 
										} ?></p>
										<p>Approve Trail Report - <?php if(isset($ApproveTrailReport)){ 
											echo count($ApproveTrailReport); 
										} ?></p>
										</div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
                  <?php } }?>
                  <?php if ($u_id==1 && ($role==1)) { ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/traillist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-bars"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Update Trail Status </h2>
										<p class="total-cls"><?php if(isset($TrailStatus)){ 
											echo count($TrailStatus); 
										} ?></p>
										<p>Pending Trail Status - <?php if(isset($pandingTrailStatus)){ 
											echo count($pandingTrailStatus); 
										} ?></p>
										<p>Approve Trail Status - <?php if(isset($ApproveTrailStatus)){ 
											echo count($ApproveTrailStatus); 
										} ?></p>
										</div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

                  <?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==4) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/traillist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-bars"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Update Trail Status </h2>
										<p class="total-cls"><?php if(isset($TrailStatus)){ 
											echo count($TrailStatus); 
										} ?></p>
										<p>Pending Trail Status - <?php if(isset($pandingTrailStatus)){ 
											echo count($pandingTrailStatus); 
										} ?></p>
										<p>Approve Trail Status - <?php if(isset($ApproveTrailStatus)){ 
											echo count($ApproveTrailStatus); 
										} ?></p>
										</div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
                  <?php } }?>
                   <?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/contactus">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-envelope"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Enquiries </h2>
										<p class="total-cls"><?php if(isset($enquiry)){ 
											echo count($enquiry); 
										} ?></p>
										<p>Number of unread - <?php if(isset($enquiryunread)){ 
											echo count($enquiryunread); 
										} ?></p>
										<p>Number of un-responded - <?php if(isset($enquiryUnresponded)){ 
											echo count($enquiryUnresponded); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } ?>
				 <?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/rentalslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-university"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Rentals  </h2>
										<p class="total-cls"><?php if(isset($rentalList)){ 
											echo count($rentalList); 
										} ?></p>
										<p>New Reviews - <?php if(isset($newReview)){ 
											echo count($newReview); 
										} ?></p>
										<p>New Rentals- <?php if(isset($newRental)){ 
											echo count($newRental); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div> 
				<?php } ?>
				<?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/classifiedslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-file-text-o"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Classifieds</h2>
										<p class="total-cls"><?php if(isset($classifiedCount)){ 
											echo count($classifiedCount); 
										} ?></p>
										<p>New Classifieds- <?php if(isset($newclassifiedCount)){ 
											echo count($newclassifiedCount); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				 <?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==11) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/classifiedslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-file-text-o"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Classifieds</h2>
										<p class="total-cls"><?php if(isset($classifiedCount)){ 
											echo count($classifiedCount); 
										} ?></p>
										<p>New Classifieds- <?php if(isset($newclassifiedCount)){ 
											echo count($newclassifiedCount); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>

                <?php } } ?>
                <?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/newslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-newspaper-o"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>News</h2>
										<p class="total-cls"><?php if(isset($NewsCount)){ 
											echo count($NewsCount); 
										} ?></p>
										<p>New News- <?php if(isset($newNews)){ 
											echo count($newNews); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==7) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/newslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="white-link fa fa-newspaper-o"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>News</h2>
										<p class="total-cls"><?php if(isset($NewsCount)){ 
											echo count($NewsCount); 
										} ?></p>
										<p>New News- <?php if(isset($newNews)){ 
											echo count($newNews); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
                <?php } } ?>
                <?php if ($u_id==1 && ($role==1)) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/forum_category">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="fa fa-comments" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Forums</h2>
										<p class="total-cls"><?php if(isset($forumCount)){ 
											echo count($forumCount); 
										} ?></p>
										<p>New Topics- <?php if(isset($Newforum)){ 
											echo count($Newforum); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } else if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==9) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/forum_category">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="fa fa-comments" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Forums</h2>
										<p class="total-cls"><?php if(isset($forumCount)){ 
											echo count($forumCount); 
										} ?></p>
										<p>New Topics- <?php if(isset($Newforum)){ 
											echo count($Newforum); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
                  <?php } } ?>
				
				<?php if($role==3) {
                      $flag=0;
                      if (isset($checkpers)) {
                          foreach ($checkpers as $checkper) {    
                              if ($checkper->permission_id==8) { 
                                  $flag = 1;
                              }
                          }
                      }
                  if ($flag == 1) {  ?>
                  	<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/eventslist">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="fa fa-calendar" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Events</h2>
										<p class="total-cls"><?php if(isset($EventCount)){ 
											echo count($EventCount); 
										} ?></p>
										<p>New Events- <?php if(isset($NewEventCount)){ 
											echo count($NewEventCount); 
										} ?></p>

									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
                  <?php } } if($role==3) { ?>

                  <div class="col-md-3 col-sm-6 col-xs-12">
					<div class="panel panel-info">
						<a href="<?php echo base_url(); ?>administrator/changepassword">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="user-logo">
											<i class="fa fa-cog" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="head-name"><h2>Setting</h2>
										<a href="<?php echo base_url(); ?>administrator/changepassword"><p>Change Password</p></a>
										<a href="<?php echo base_url(); ?>administrator/updateprofile"><p>Update Profile</p></a>
									    </div>
																	
									</div>
								</div>
							</div>
							<div class="panel-footer gray-gradient">
								<span class="pull-left dashbord-view-btn">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<?php } ?>


			</div>

	</div>
</div>

</div>
</div>
</div>

      

