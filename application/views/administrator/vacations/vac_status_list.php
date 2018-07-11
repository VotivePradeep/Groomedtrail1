<ul class="vac_status_list">
	<?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id ==14) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
	<li><a href="<?php echo base_url();?>administrator/addrental" class="btn btn-default btn-sm">Add New Rentals</a> 
	<?php }elseif ($u_id==1) { ?>
	<li><a href="<?php echo base_url();?>administrator/addrental" class="btn btn-default btn-sm">Add New Rentals</a>
	<?php } ?>	
	<li><a href="<?php echo base_url()?>administrator/rentalslist" class="btn btn-default btn-sm" id="viewAll">View All</a></li>
	<li><a href="<?php echo base_url()?>administrator/rentalslist/publish" class="btn btn-default btn-sm" id="viewPaymentPending">View Published</a></li>
	<li><a href="<?php echo base_url()?>administrator/rentalslist/paid" class="btn btn-default btn-sm" id="viewPaymentPending">Paid Listings Pending Approval</a></li>
	<li><a href="<?php echo base_url()?>administrator/rentalslist/paymentpending" class="btn btn-default btn-sm" id="viewPaymentPending">Payment Pending</a></li>
	<li><a href="<?php echo base_url()?>administrator/rentalslist/free_trial_pending" class="btn btn-default btn-sm" id="viewPaymentPending">Free Trial Pending Approval</a></li>
	<li><a href="<?php echo base_url()?>administrator/rentalslist/expired" class="btn btn-default btn-sm" id="viewPaymentPending">View Expired</a></li>

	<li><a href="<?php echo base_url()?>administrator/rentalslist/updatedlist" class="btn btn-default btn-sm" id="viewPaymentPending" style="background: #f59506 !important; border: 1px solid #f59506 !important;">Updated List</a></li>

	
<!-- 
	<li><a href="<?php echo base_url()?>administrator/rentalslist/pendingapprovals" class="btn btn-default btn-sm" id="viewPandingAppv">View Pending Approvals</a></li> -->
	

	
</ul>