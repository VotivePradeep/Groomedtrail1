<div class="col-md-3 col-sm-4 right no-paddng">
   <div class="usr-sd-bar">
        <ul class="user-side-bar">
            <li class="<?php if(isset($basesegment)){ if($basesegment == 'dashboard') {  ?>active<?php } } ?>"><a href="<?php echo base_url().'user/dashboard'; ?>"><i class="fa fa-tachometer"></i> Dashboard</a></li> 
            <li><a href="<?php echo base_url().'user/profile'; ?>"><i class="fa fa-user-o" aria-hidden="true"></i> User Profile</a></li>
            <li class="<?php if(isset($basesegment)){ if($basesegment == 'rentals') { ?>active<?php } } ?>"><a href="<?php echo base_url().'user/rentals'; ?>"><i class="fa fa-list-ul"></i> Rental Listings</a></li>
            <li class="<?php if(isset($basesegment)){ if($basesegment == 'classifiedslist') {  ?> active<?php } } ?>"><a href="<?php echo base_url().'user/classifiedslist'; ?>"><i class="fa fa-list-alt"></i> Classifieds Listings</a></li>
            <!-- <li class="<?php if(isset($basesegment)){ if($basesegment == 'news') { ?>active<?php } } ?>"><a href="<?php echo base_url().'user/news'; ?>"><i class="fa fa-newspaper-o"></i> News</a></li> -->
           <li class="<?php if(isset($basesegment)){ if($basesegment == 'savedroutes' || $basesegment == 'sharedroute') { ?>active<?php } } ?>"><a href="<?php echo base_url().'user/savedroutes'; ?>"><i class="fa fa-bookmark-o"></i> Saved Routes</a></li>
            <li class="<?php if(isset($basesegment)){ if($basesegment == 'mymap' || $basesegment == 'traillist' || $basesegment == 'sharedtrail') { ?>active<?php } } ?>"><a href="<?php echo base_url().'user/traillist'; ?>"><i class="fa fa-map-o" aria-hidden="true"></i> My Boondocking </a> </li>
            <li class="<?php if(isset($basesegment)){ if($basesegment == 'updatetrail') { ?>active<?php } } ?>"><a href="<?php echo base_url().'user/updatetrail'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i>Subscriptions and Updates</a></li>
        </ul>
    </div>
</div>