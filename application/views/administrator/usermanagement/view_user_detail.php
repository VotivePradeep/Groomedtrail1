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
</style>

<div class="warper container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default add-user-sec">
        <div class="panel-heading">
          <div class="row">
            <div class="col-sm-6"><p class="rental">View User Details</p></div>
            <div class="col-sm-6">
              <a href="<?php echo base_url(); ?>administrator/users" class="backtolist">
              <i class="fa fa-arrow-left"></i> Back</a>
             
            </div>
          </div>
        </div>

        <div class="panel-body">
           <div class=" mang-viw-dtl-pg">
            <div class="row">
            <div class="col-md-12 form-group">
              <?php 
              if(isset($userDetail->profile_picture) && !empty($userDetail->profile_picture)){ 
                  if(strpos($userDetail->profile_picture, "http://") !== false OR strpos($userDetail->profile_picture, "https://") !== false){
                       $img = $userDetail->profile_picture;
                  }else
                  {
                       $img = base_url().$userDetail->profile_picture;
                  }
              }
              else
              { 
                  $img =  base_url().'assets/images/default.png';
              }

              ?>
              <img src="<?php echo $img; ?>" style="width:200px" />
            </div>
          </div>
            <div class="row data-pro-table">
              <table>
                <tr>
                  <td class="width-class">
                    <div class="form-group">
                      <label for="business_name">username</label>
                      <p>
                        <?php if(isset($userDetail->username) && !empty($userDetail->username)) {echo $userDetail->username; }else{ echo '-'; }?>
                       
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                       <div class="vac_city">
                      <label for="business_address">First Name</label>
                      <p>
                        <?php if(isset($userDetail->fname) && !empty($userDetail->fname)) {echo $userDetail->fname; }else{ echo '-'; }?>
                      </p>
                    </div>
                    <div class="vac_city zip-code">
                      <label for="business_address">Last Name</label>
                      <p>
                        <?php if(isset($userDetail->lname) && !empty($userDetail->lname)) {echo $userDetail->lname; }else{ echo '-'; }?>
                      </p>
                    </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group">
                      <label for="business_contant_no">Gender</label>
                      <p>
                        <?php if(isset($userDetail->gender) && !empty($userDetail->gender)) {echo $userDetail->gender; }else{ echo '-'; } ?>
                      </p>
                    </div>
                    
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">DOB</label>
                      <p>
                        <?php if(isset($userDetail->dob) && !empty($userDetail->dob)) {echo $userDetail->dob; }else{ echo '-'; } ?>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Phone Number</label>
                      <p>
                        <?php if(isset($userDetail->contact_no) && !empty($userDetail->contact_no)) {echo $userDetail->contact_no; }else{ echo '-'; } ?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="business_address">Email Address</label>
                      <p>
                        <?php if(isset($userDetail->email) && !empty($userDetail->contact_no)) {echo $userDetail->email; }else{ echo '-'; } ?>
                      </p>
                    </div>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="vac_no_of_bedroom">Address</label>
                      <p>
                        <?php if(isset($userDetail->address) && !empty($userDetail->address)) {echo $userDetail->address; }else{ echo '-'; }?>
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <label for="vac_bathroom">Occupation</label>
                      <p>
                        <?php if(isset($userDetail->occupation) && !empty($userDetail->occupation)) {echo $userDetail->occupation; }else{ echo '-'; }?>
                      </p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-group ">
                      <label for="vac_sleep">Login Type</label>
                      <p>
                        <?php if(isset($userDetail->login_type) && !empty($userDetail->login_type)) {
                          if($userDetail->login_type == 'NM'){
                            echo 'Normal Login';

                          }else if($userDetail->login_type == 'FB'){
                            echo 'Facebook Login';
                          
                           }else if($userDetail->login_type == 'GP'){
                            echo 'Gmail Login';
                           }
                         }else{echo '-'; }
                           ?>
                         
                      </p>
                    </div>
                  </td>
                  <td>
                    <div class="form-group ">
                      <div class="vac_city">
                      <label for="vac_sleep">Status</label>
                      <p>
                        <?php if(isset($userDetail->status) && !empty($userDetail->status)) {
                          if($userDetail->status == 0){
                            echo 'Unpublished';
                          }else{
                             echo 'Published';
                          }
                        }else{echo '-';}?>
                         
                      </p>
                    </div>
                    <div class="vac_city zip-code">
                      <label for="business_address">Created Date</label>
                      <p>
                        <?php if(isset($userDetail->created_date) && !empty($userDetail->created_date)) {
                          $date = date_create($userDetail->created_date); 
                            echo date_format($date, 'd-M-Y'); 
                          }else{ echo '-'; }?>
                      </p>
                    </div>
                    </div>
                  </td>
                </tr>
               
              </table>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

