<div class="panel-heading">
      <ul class="cls-status-list">
      <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id ==11) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        } ?>
      <li><a href="<?php echo base_url();?>administrator/classifiedslist" class="btn btn-default btn-sm">All Classified</a></li>
      <li><a href="<?php echo base_url();?>administrator/classifiedslist/pending" class="btn btn-default btn-sm">View Pending Classifieds</a></li>
      <li><a href="<?php echo base_url();?>administrator/classifiedslist/approve" class="btn btn-default btn-sm">View Approved Classifieds</a></li>
      <li><a href="<?php echo base_url();?>administrator/classifiedslist/expired" class="btn btn-default btn-sm">View Expired Classifieds</a></li>
      <li><a href="<?php echo base_url();?>administrator/classifiedslist/reject" class="btn btn-default btn-sm">View Rejected  Classifieds</a></li>
      <?php if ($flag == 1) {  ?>
      <li><a href="<?php echo base_url();?>administrator/classifieds/addclassifiedpage" class="btn btn-default btn-sm">Add Classifieds</a></li>
      <?php }elseif ($u_id==1) { ?>
       <li><a href="<?php echo base_url();?>administrator/classifieds/addclassifiedpage" class="btn btn-default btn-sm">Add Classifieds</a></li>
      <?php } ?>
      <?php if ($u_id==1) { ?>
      <li><a href="<?php echo base_url();?>administrator/classifieds/expiration/duration" class="btn btn-default btn-sm">Add Expiration Duration </a></li>
      <?php } ?>
      </ul>         
</div>