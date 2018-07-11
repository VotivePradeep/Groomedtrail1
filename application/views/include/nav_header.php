<style type="text/css">
  .myroutebtn{
    background-color: #387fcc;
    margin: 10px;
    padding: 10px;
    border: none;
    color: #fff;
  }
</style>
<div class="main-header container-fluid">
	<div class="navbar-header">
      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
        	<span class="sr-only">Toggle navigation</span>
       		<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      	</button>
      	<a class="navbar-brand" href="<?php echo base_url()?>home"><img src="<?php echo base_url()?>assets/images/logo.png"></a>
    </div>
    <div class="text-center collapse navbar-collapse" id="navbar-collapse-1">
    	<ul class="nav navbar-nav">
            <li class="<?php if(isset($segment)){ if($segment == 'home'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>home">Map</a></li>
            <li><a href="<?php echo base_url() ?>user/savedroutes">MY ROUTES</a></li>
            <li class="<?php if(isset($segment)){ if($segment == 'classified'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>classified">Classifieds</a></li>
            <li class="<?php $forum = $this->uri->segment(1); if(isset($forum)){ if($forum == 'community-forum'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>community-forum">Forum</a></li>
            <li class="<?php if(isset($segment)){ if($segment == 'news'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>news">News</a></li>
            <li class="<?php if(isset($segment)){ if($segment == 'lodging'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>lodging">Lodging</a></li>
            <li class="<?php if(isset($segment)){ if($segment == 'event'){ ?>active <?php } } ?>"><a href="<?php echo base_url()?>events">Events</a></li>
            <!--<li class="<?php if($segment == 'event'){ ?>active <?php } ?>"><a href="<?php echo base_url()?>event">Event</a></li>-->
            </li>
      	</ul>
          	
	</div>
</div>

