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
  .vac_city {
    width: 50%;
    float: left;
    padding: 6px;
  }
  .vac_city label {
    margin-top: 10px;
  }
  td.width-class {
    min-width: 250px;
  }
  .main-data .busns-dscrpsn {
    border: none;
    overflow-x: auto;
  }
  .main-data .busns-dscrpsn td {
    padding: 10px 15px;
  }
</style>

<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-6"><p class="rental">View New Rentals</p></div>
            <div class="col-sm-6">
              <?php if(isset($businessDetail->vac_payment_status)){  
                if($businessDetail->vac_payment_status != 0) { ?>
              <a href="#" data-toggle="modal" data-target="#myModalneedcorrection" class="needcorrect" ><i class="fa fa-retweet""></i> Need Correction </a>
               <?php } } ?>
              <a href="javascript:void(0);" onclick="history.go(-1);" class="backtolist">
              <i class="fa fa-arrow-left"></i> Back</a>
             
            </div>
          </div>
        </div>

        <div id="myModalneedcorrection" class="publish_rental modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Needs Correction Rental</h4>
              </div>
              <form name="publishFrm" id="publishFrm">
                <div class="modal-body">
                   <div id="responseMsg"></div>
        
                  <p class="vac_msg">
                    <select name="statusChange" id="statusChange" class="change-status-ad">
                      <option value="">Select a Status</option>
                      <option value="Approved">Approved</option>
                      <option value="Correction">Needs Correction</option>
                      <option value="Rejected">Rejected</option>
                    </select>
                  </p>
                  <p class="vac_msg">
                    <span>Message</span>
                    <textarea name="vac_message" id="vacmessage_<?php if(isset($businessDetail->vac_id)){echo $businessDetail->vac_id; }?>" placeholder="Please enter Message"></textarea></p>
                    <input type="hidden" name="id" id="id_<?php if(isset($businessDetail->vac_id)){echo $businessDetail->vac_id; }?>" placeholder="Please enter Message" value="<?php echo $businessDetail->vac_id ?>" />
                </div>
                <div class="modal-footer">
                  <button type="submit"  id="status_<?php if(isset($businessDetail->vac_id)){echo $businessDetail->vac_id; }?>" class="btn btn-default rent_sub">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="panel-body">
           <div class=" mang-viw-dtl-pg">
            <div class="row data-pro-table">
              <table>
                <tr>
                  <td class="width-class">
                    <div class="form-group">
                      <label for="business_name">Property Name</label>
                      <p>
                        <?php if(isset($businessDetail->vac_name)) {echo $businessDetail->vac_name; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <label for="business_type">Property Type</label>
                      <p>
                        <?php if(isset($businessDetail->vac_type)) {echo $businessDetail->vac_type; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label for="business_contant_no">Property Phone Number</label>
                      <p>
                        <?php if(isset($businessDetail->vac_contact)) {echo $businessDetail->vac_contact; }?>
                      </p>
                    </div>
                    
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Email Address</label>
                      <p>
                        <a href="mailto:<?php if(isset($businessDetail->vac_email)) {echo $businessDetail->vac_email; }?>" target="_top"><?php if(isset($businessDetail->vac_email)) {echo $businessDetail->vac_email; }?></a>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Property Address</label>
                      <p>
                        <?php if(isset($businessDetail->vac_address)) {echo $businessDetail->vac_address; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="vac_city">
                      <label for="business_address">City</label>
                      <p>
                        <?php if(isset($businessDetail->vac_city)) {echo $businessDetail->vac_city; }?>
                      </p>
                    </div>
                    <div class="vac_city zip-code">
                      <label for="business_address">Zip Code</label>
                      <p>
                        <?php if(isset($businessDetail->vac_zip_code)) {echo $businessDetail->vac_zip_code; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="vac_no_of_bedroom">Website Address</label>
                      <p>
                        <a href="<?php if(isset($businessDetail->vac_wedsite_url)) {echo $businessDetail->vac_wedsite_url; }?>" target="_blanck"><?php if(isset($businessDetail->vac_wedsite_url)) {echo $businessDetail->vac_wedsite_url; }?></a>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="vac_bathroom">Number of Bedrooms</label>
                      <p>
                        <?php if(isset($businessDetail->vac_no_of_bedroom)) {echo $businessDetail->vac_no_of_bedroom; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="vac_sleep">Number of Bathrooms</label>
                      <p>
                        <?php if(isset($businessDetail->vac_bathroom)) {echo $businessDetail->vac_bathroom; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="vac_sleep">Number of sleeping person</label>
                      <p>
                        <?php if(isset($businessDetail->vac_sleep)) {echo $businessDetail->vac_sleep; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Rental Daily Rate</label>
                      <p>
                        $<?php if(isset($businessDetail->vac_price)) {echo $businessDetail->vac_price; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Rental Weekly Rate</label>
                      <p>
                        $<?php if(isset($businessDetail->vac_weekly_rate)) {echo $businessDetail->vac_weekly_rate; }?>
                      </p>
                    </div>
                  </td>
                  
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">floor area</label>
                      <p>
                        <?php if(isset($businessDetail->vac_floor_area)) {echo $businessDetail->vac_floor_area; }?>
                      sq.ft.</p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Amenities</label>
                      <p>
                        <?php if(isset($businessDetail->adv_filter_fields)) {
                        $valueA = explode(",", $businessDetail->adv_filter_fields);
                        foreach ($valueA as $valueA) {
                        $query=$this->db->query("select * from advance_filter_fields where f_id=". $valueA."");
                        $result = $query->result();
                        foreach ($result as $value) {
                        echo $value->f_subcat_name.', ';
                        }
                        }
                        }?>
                      </p>
                    </div>
                  </td>
                  
                </tr>
                
              </table>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-12 ">
              <div class=" busns-dscrpsn">
                <label for="business_description">Description</label>
                <p>
                  <?php if(isset($businessDetail->vac_description)) {echo $businessDetail->vac_description; }?>
                </p>
              </div>
            </div>
          </div>

          <div class="row main-data data-pro-table">
              <div class=" busns-dscrpsn">
                <label for="business_description">Payment Details</label>

                <table>
                  <?php 
                  if(isset($PaymentDetails)){
                    foreach ($PaymentDetails as $PDetails) {
                  ?>
                  <tr>
                    <td class="form-group">
                        <label for="business_description">Transaction ID</label>
                        <p><?php if(isset($PDetails->txn_id)) {echo $PDetails->txn_id; }else{echo '-';}?></p>
                    </td>
                    <td class="form-group">
                        <label for="business_description">Amount</label>
                        <p><?php if(isset($PDetails->payment_gross)) {echo $PDetails->payment_gross; }else{echo '-';}?></p>
                    </td>
                    <td class="form-group">
                        <label for="business_description">Payment Status</label>
                        <p><?php if(isset($PDetails->payment_status)) {echo $PDetails->payment_status; }else{echo '-';}?></p>
                    </td>
                    <td class="form-group">
                        <label for="business_description">Payment Date</label>
                        <p><?php if(isset($PDetails->payment_date)) {
                          $date = date_create($PDetails->payment_date); 
                            echo date_format($date, 'd-M-Y');
                          }else{echo '-';}?></p>
                    </td>
                    <td class="form-group">
                        <label for="business_description">User Detail</label>
                        <p>
                          <?php if(isset($PDetails->user_id)) { ?>
                            <a href="<?php echo base_url().'administrator/userdetails/'.$PaymentDetails->user_id; ?>" target="_blank">Show User Details</a>
                         <?php  }else{echo '-';}?>
                          
                        </p>
                    </td>
                  </tr>
                  <?php } } ?>
                </table>
              </div>
            
          </div>
          <div class="row">
            <div class="col-md-12 form-group">
              <label for="vac_imag">Upload Rental Images</label><br/>
              <?php  if(isset($busPhotos) && !empty($busPhotos)){
              foreach($busPhotos as $busPhotos) {?>
              <div class="item_vac_image" id="cross<?php echo $busPhotos->vac_imag;?>">
                <div style="background-size:cover; height:80px !important; background-image:url('<?php if(isset($busPhotos->vac_imag) && !empty($busPhotos->vac_imag)){ echo base_url().$busPhotos->vac_imag;}?>')">
                </div>
              </div>
              <?php } } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(".rent_sub").click(function() {
  var contentPanelId = $(this).attr("id");
  var arr = contentPanelId.split('_');
  //alert(arr[1]);
  var id = arr[1];
  var vac_message=$('#vacmessage_'+arr[1]).val();
  var tablename = 'tbl_vacation_list';
  var needcorrection = 'needcorrection';
  var statusChange=$('#statusChange').val();
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/changeStatus'; ?>',
      data: {id:id, status:status, vac_message:vac_message, tablename:tablename,needcorrection:needcorrection,statusChange:statusChange}, // serializes the form's elements.
      dataType: "JSON",
      success: function(data)
      {
       //location.reload(); 
        $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Change Status Successfully </div>').show().fadeOut(5000);
        $('#publishFrm')[0].reset();
        $('#myModalneedcorrection').fadeOut(2000,function(){
           $('#myModalneedcorrection').modal('hide');
        });
      }
    });
});

</script>