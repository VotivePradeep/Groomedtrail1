<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
  .form-group {
      overflow: hidden;
  }
  label.col-sm-3.control-label.cms-label {
      text-align: right;
      margin-bottom: 10px;
  }
  .panel.panel-default.add-user-sec form#addroute {
      margin: 0 auto;
      max-width: 708px;
  }
  .pern-status {
      display: inline-block;
      margin: 0 0 0 0;
      position: relative;
      padding: 0 35px 0 0;
  }
  .permission-name {
      text-transform: uppercase;
  }
  .mang-viw-dtl-pg .form-group:nth-child(even) {
      background-color: #e8e8e8;
  }
  .mang-viw-dtl-pg .form-group p {
      margin-bottom: 0;
  }
  .mang-viw-dtl-pg .form-group {
      margin-bottom: 0px;
      padding: 7px;
  }
  .data-pro-table table {
      width: 100%;
      text-align: left;
      border: none;
  }
  .data-pro-table table tr,
  .data-pro-table table td,
  .data-pro-table table th {
      text-align: left !important;
  }
  .data-pro-table table td {
      border: 1px solid #ccc;
  }
  .busns-dscrpsn {
      padding: 15px;
      margin-top: 15px;
      border: 1px solid #cacaca;
  }
  .panel-heading a {
      float: right;
      background: #428bca;
      color: #fff;
      padding: 5px;
      top: -6px;
  }
  p.rental {
    margin: 6px 0 0;
  }
</style>

<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-6"><p class="rental">View News</p></div>
            <div class="col-sm-6">
              <a href="<?php echo base_url(); ?>administrator/newslist" class="backtolist">
<i class="fa fa-arrow-left"></i> Back</a>
            </div>
            
          </div>
        </div>
        
        <div class="panel-body">
          <div id="responseMsg"></div>
          <div class=" mang-viw-dtl-pg">
            <div class="row data-pro-table">
              <table>
                <tr>
                  <td colspan="2">
                    <div class="form-group ">
                      <label for="business_name">Title</label>
                      <p><?php if(isset($newDetail[0]->news_title)){echo $newDetail[0]->news_title;}?></p>
                    </div>
                  </td>
                </tr>
               
                <tr>
                  <td colspan="2">
                    <div class="form-group ">
                      <label for="business_name">Description</label>
                      <p><?php if(isset($newDetail[0]->news_description)){echo $newDetail[0]->news_description; }?></p>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-12 ">
              <div class=" busns-dscrpsn">
                
                <img src="<?php if(isset($newDetail[0]->news_image)){echo base_url().$newDetail[0]->news_image; }?>" style="width: 100px;height: 100px">
                                
                </div>
              </div>
            </div>
          </div>

        </div>        
      </div>
    </div>
  </div>
</div>
