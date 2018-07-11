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
                <h3>My Rental Listings</h3>
                <div class="nw-bsns-btn"><a href="<?php echo  base_url();?>user/rentals/add">Add New Rentals</a></div>
                <div class="table_data_main">
                  <div class="table-main-business">
                    <table id="businessTbl123" class="table table-striped table-bordered" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="display: none;">S. NO.</th>
                          <th>Property Name</th>
                          <th>Rental Rate ($)</th>
                          <th>Created date</th>
                          <th>Expiration date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(isset($businessList)){
                    $i= 1;
                        foreach ($businessList as $buslist) {  


                           $sql1= $this->db->query("SELECT * FROM tbl_update_vacation_list WHERE vac_id=".$buslist->vac_id."");
                           $updatedResult = $sql1->row();

                          ?>

                        <tr>
                          <td style="display: none;"><?php if(isset($buslist->vac_id)){echo $buslist->vac_id;} ?></td>
                          <td><?php if(isset($updatedResult->vac_name)){ 
                            echo $updatedResult->vac_name;
                          }else{
                            if(isset($buslist->vac_name)){echo $buslist->vac_name;} } ?></td>
                          <td>$<?php 
                          if(isset($updatedResult->vac_name)){ echo $updatedResult->vac_price; }else{
                          if(isset($buslist->vac_price)){echo $buslist->vac_price;} } ?></td>
                          <td><?php if(isset($buslist->vac_created_date)){$date = date_create($buslist->vac_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                          <td><?php if(isset($buslist->vac_expiry_date) && !empty($buslist->vac_expiry_date) && $buslist->vac_expiry_date != '0000-00-00'){$date = date_create($buslist->vac_expiry_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                          <td>
                          <?php if($buslist->vac_expiry_date <= date('Y-m-d') && $buslist->vac_expiry_date !="0000-00-00"){ 
                            if($buslist->renew_status !=1){
                            ?>
                            <a <?php if($buslist->update_status == 1){ ?> href="#" <?php }else{ ?> href="<?php echo base_url(); ?>paypal/advert_buy/<?php if(isset($buslist->vac_id)) {echo $buslist->vac_id; }?>" <?php } ?> >Expired</a>
                        <?php   }else{
                          echo 'Pending Approval';
                        }
                      }else{ ?>

                          <?php if(isset($buslist->pl_id)) {
                          $sql= $this->db->query("SELECT * FROM plan_master WHERE pl_id=".$buslist->pl_id."");
                          $planResult = $sql->result();
                          ?>

                    <?php
                    foreach ($planResult as $planRslt) { 
                      if($planRslt->pl_price!=0){
                          if($buslist->vac_payment_status == 0){ 
                            echo ' Payment Pending';
                          }else if($buslist->vac_payment_status == 1 && $buslist->vac_status == 0){
                            echo 'Pending Approval';
                          }else if($buslist->vac_payment_status == 1 && $buslist->vac_status == 1){
                            echo 'Published';
                          }
                       }else{
                          if($buslist->vac_status == 0){
                            echo 'Pending Approval';
                          }else if($buslist->vac_status == 1){
                            echo 'Published';
                          }
                      } 
                     } 
                    ?>
                     <?php  }?>

                   <?php } ?>
                    
                         
                         </td>
                          <td>
                          <ul>
                          <li><a href="<?php echo base_url().'user/rentals/view/'.$buslist->vac_id; ?>"><i class="fa fa-eye"></i></a></li>
                         
                          <li><a  href="<?php echo base_url()."user/rentals/edit/".$buslist->vac_id; ?>" ><i class="fa fa-pencil"></i></a></li>
                         
                          <li><a onClick="deletefunc(<?php if(isset($buslist->vac_id)){echo $buslist->vac_id;} ?>, 'tbl_vacation_list', 'Do you want to remove this?')"  class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                          </ul>

                          </td>
                        </tr>
                        <?php  $i++; }  } ?>
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
<script type="text/javascript">
  
  $(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
});


$("#businessTbl123").DataTable({
"order": [[ 0, "desc" ]]
});
</script> 