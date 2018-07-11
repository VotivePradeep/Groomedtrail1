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
            <div class="col-sm-6"><p class="rental">View Event</p></div>
            <div class="col-sm-6">
              <a href="<?php echo base_url(); ?>administrator/eventslist" class="backtolist">
                 <i class="fa fa-arrow-left"></i> Back</a>
            </div>
          </div>
        </div>
        <div class="panel-body">
           <div class=" mang-viw-dtl-pg">
            <div class="row data-pro-table">
              <table>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Event Title</label>
                          <p><?php if(isset($eventDetail->event_title)) {echo $eventDetail->event_title; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Event Venue Name</label>
                              <p>
                               <?php if(isset($eventDetail->event_venue)) {echo $eventDetail->event_venue; }?>
                              </p>
                          </div>
                        </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Venue Address</label>
                          <p><?php if(isset($eventDetail->venue_address)) {echo $eventDetail->venue_address; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Event Date</label>
                              <p><?php if(isset($eventDetail->event_date)) {echo $eventDetail->event_date; }?></p>
                          </div>
                        </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Event Start Time</label>
                          <p><?php if(isset($eventDetail->event_start_time)) {echo $eventDetail->event_start_time; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Event End Time</label>
                              <p><?php if(isset($eventDetail->event_end_time) && !empty($eventDetail->event_end_time)) {echo $eventDetail->event_end_time; }else{echo 'All Day Event';}?></p>
                          </div>
                        </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <div class="form-group ">
                          <label for="business_name">Event Description</label>
                          <p><?php if(isset($eventDetail->event_description)) {echo $eventDetail->event_description; }?></p>
                          </div>
                        </td>
                    </tr>
                    </table>
                    <div class="row">
                      <div class="col-md-12 form-group">
                        <strong class="Contact Person Details">Contact Person Details</strong>
                      </div>
                    </div>
                    <table>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Name</label>
                          <p><?php if(isset($eventDetail->event_contact_person_name)) {echo $eventDetail->event_contact_person_name; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Contact Phone</label>
                              <p>
                               <?php if(isset($eventDetail->event_contact_no)) {echo $eventDetail->event_contact_no; }?>
                              </p>
                          </div>
                        </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Email Address</label>
                          <p><?php if(isset($eventDetail->event_contact_person_name)) {echo $eventDetail->event_contact_person_name; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">Web Site</label>
                              <p>
                               <?php if(isset($eventDetail->event_wed_site)) {echo $eventDetail->event_wed_site; }?>
                              </p>
                          </div>
                        </td>
                    </tr>
                    </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label for="vac_imag">Event Images</label><br/>
              <?php  if(isset($eventImage) && !empty($eventImage)){
              foreach($eventImage as $eventImage) {?>
              <div class="item_vac_image" id="cross<?php echo $eventImage->event_image_path;?>">
                <div style="background-size:cover; height:80px !important; background-image:url('<?php if(isset($eventImage->event_image_path) && !empty($eventImage->event_image_path)){ echo base_url().$eventImage->event_image_path;}?>')">
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
  