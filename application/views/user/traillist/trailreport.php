<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
.table_data_main {
  overflow-x: scroll;
}

</style>
<header class="navigation">
  <div class="top-bar">
    <?php $this->load->view('include/top_header');?>
  </div>
  
  <nav class="navbar">
  <?php $this->load->view('include/nav_header'); ?>
    </nav>
</header>

<div class="wrapper">
<section class="profile-main-sec">
    <div class="container">
      <div class="pms-bg">
        <div class="row">
         <?php $this->load->view('user/leftsidebar') ?>
          <div class="col-md-9 col-sm-8">
            <div class="business-detail-sec">
            <div class="business-frm">
              <div id="responseMsg"></div>
              <h3>Trail Report List</h3>
            <!-- -->
            
             <div class="table_data_main">
             <div class="table-responsive">
              <table id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
              <thead>
                 <tr>
                    <th>State Name</th>
                    <th>County</th>
                    <th>Trail Description</th>
                </tr>
              </thead>
            
              <tbody>
             <?php 
              //  $i =1;
                if(isset($trailList)){
                    foreach ($trailList as $trail) { 
                            $words = explode(" ",$trail->county_detail);
                            $content = implode(" ",array_splice($words,0,5));
                       ?>
                        <tr>
                            <td><?php if(isset($trail->region_name)){echo $trail->region_name;}?></td>
                            <td><?php if(isset($trail->county_name)){echo $trail->county_name;}?></td>
                            <td><div class="trailDescriptionCls" id="trailDescriptionId"><?php  echo $content; ?>
                            </div></td>
                        <?php } } ?>
              </tbody>
          </table>
            </div>
            </div>
            <!-- -->
            </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>

</div>
    
<footer class="main_footer">
   <?php $this->load->view('include/main_footer'); ?>
</footer>
<div class="copy-right">
<?php $this->load->view('include/copyright'); ?>
</div>

</body>
</html>
