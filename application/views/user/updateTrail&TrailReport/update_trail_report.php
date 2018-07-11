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
                  <h3>Edit Trail Status</h3>
                  <div class="table_data_main">
                    <div class="table-responsive">
                      <form  method="post" id="addtrail" action="<?php if(isset($basesegment) && $basesegment == 'updatetrail'){echo base_url().'user/updatetrail/edit/'.$trailDetail[0]->trail_report_id; } ?>" class="main-form"  enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="trail_name">County Name</label>
                            <div><?php if(isset($trailDetail[0]->CountyID)){ echo $trailDetail[0]->CountyID; } ?></div>
                            <!--<input type="text" name="CountyID" id="CountyID" class="form-control" placeholder="Enter county name" value="<?php if(isset($trailDetail[0]->CountyID)){ echo $trailDetail[0]->CountyID; } ?>" readonly>-->
                            <label id="trail_name-error" class="error" for="trail_name"></label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="trail_name">Description</label>
                            <textarea type="text" name="trail_report_conditions" id="trail_report_conditions" class="form-control" placeholder="Enter county name"><?php if(isset($trailDetail[0]->trail_report_conditions)){ echo $trailDetail[0]->trail_report_conditions; } ?></textarea>
                            <label id="trail_description-error" class="error" for="trail_description"></label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <button type="submit" id="add-business-btn" name="submit" class="btn btn-default">
                            Update Trail Report
                            </button>
                          </div>
                        </div>
                      </form>
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