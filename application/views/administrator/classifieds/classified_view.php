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
  .busns-dscrpsn {
    padding: 15px;
    margin-top: 15px;
    border: 1px solid #cacaca;
    overflow: hidden;
}
</style>

<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-6"><p class="rental">View Ad (<?php if(isset($classifiedList->classified_created_by)) {if($classifiedList->classified_ads == 'for_sale'){ echo 'For Sale';}else{ echo 'Wanted'; } }?>)</p></div>
            <div class="col-sm-6">
              <a href="<?php echo base_url(); ?>administrator/classifiedslist" class="backtolist">
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
                  <td>
                    <div class="form-group ">
                      <label for="business_type">Classified Title</label>
                      <p>
                        <?php if(isset($classifiedList->classified_created_by)) {echo $classifiedList->classified_created_by; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_name">Category</label>
                      <p><?php if(isset($classifiedList->classified_type)) {echo $classifiedList->classified_type; }?></p>
                    </div>
                  </td>
                  
                </tr>
                <tr>
                    <td>
                      <div class="form-group ">
                        <label for="business_type">Classified ads</label>
                        <p><?php if(isset($classifiedList->classified_ads)) {
                             if( $classifiedList->classified_ads == 'for_sale'){
                                echo 'For Sale';
                             }else{
                                echo ucfirst($classifiedList->classified_ads);
                             }
                           }?></p>
                      </div>
                    </td>
                    <td>
                    <div class="form-group ">
                      <label for="business_type">Location (City and State)</label>
                      <p><?php if(isset($classifiedList->classified_state)) {echo $classifiedList->classified_state; }?></p>
                    </div>
                  </td>
                 </tr>
                 <?php if(isset($classifiedList->classified_ads)) {
                      if( $classifiedList->classified_ads == 'for_sale'){ ?>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_name">Price ($)</label>
                      <p><?php if(isset($classifiedList->classified_price)) {echo $classifiedList->classified_price; }?></p>
                    </div>
                  </td>
                 <td></td>
                </tr>
                 <?php } } ?>
                <tr>

                <tr>
                  <td colspan="2">
                    <div class="form-group ">
                      <label for="business_name">Classified Description</label>
                      <p><?php if(isset($classifiedList->classified_description)) {echo $classifiedList->classified_description; }?></p>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-12 ">
              <div class=" busns-dscrpsn">
                <?php  if(isset($clsImg) && !empty($clsImg)){
                foreach($clsImg as $clsImg) {?>
                  <div class="item_vac_image">
                    <div style="background-size:cover; height:80px !important; background-image:url('<?php if(isset($clsImg->cls_imag) && !empty($clsImg->cls_imag)){ echo base_url().$clsImg->cls_imag;}else{ echo base_url().'assets/images/no-image.jpg'; }?>')">
                    </div>
                  </div>
                <?php }}?>    
                </div>
              </div>
            </div>
         
        </div>        
      </div>
    </div>
  </div>
</div>
