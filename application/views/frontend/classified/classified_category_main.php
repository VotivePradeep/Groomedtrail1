 <?php
  if(isset($classified_list) && !empty($classified_list)){
  foreach ($classified_list as $classified) { 
    if($classified->classified_expired >= date("Y-m-d")){ ?>
  <div class="mobile-classified col-sm-4 col-md-3">
    <div class="main-div-clas">
      <div class="img-classified">
        <a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>">
          <?php 
          $query = $this->db->query("SELECT * FROM tbl_classified_images where cls_id='".$classified->classified_id."' GROUP BY cls_id" );
          
          $clsImage = $query->result();
          if(isset($clsImage) && !empty($clsImage)) {  
          foreach ($clsImage as $image) { ?>
          <img src="<?php if(isset($image->cls_imag) && !empty($image->cls_imag)) { echo base_url().$image->cls_imag; }else{echo base_url().'assets/images/no-image.jpg'; }?>">
          <?php } }else{ ?>
             <img src="<?php echo base_url().'assets/images/no-image.jpg'; ?>">
         <?php } ?>
        </a>
      </div>
      <div class="main-classified-dis">
        <a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>"><div class="desicriprion-classi">
          <h3><?php if(isset($classified->classified_created_by)){echo $classified->classified_created_by;}?></h3>
          <div class="cls_des"><?php if(isset($classified->classified_description)){
             $words = explode(" ",$classified->classified_description);
                      echo  $content = implode(" ",array_splice($words,0,20));
           }?></div>
          <!--<a href="#">Read More</a> -->
        </div></a>
        <div class="price-details">
          <!--<div class="price-clas">
            <p>$120</p>
          </div> -->
          <a href="<?php echo base_url().'classified/details/'.$classified->url_slag; ?>">Read More</a>
          <div class="clas-rating">
            <!--<ul>
              <li><a href="#">4.5</a></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star-half-o"></i></li>
              <li><i class="fa fa-star-o"></i></li>
            </ul>-->
            <ul>
              <li><?php if(isset($classified->classified_create_date)){$date = date_create($classified->classified_create_date);
              echo date_format($date, 'M d');}?></li>
              <li><i class="fa fa-star-o"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } } }else{ ?>
  <h4 class="cls-no-srch-record">No record found</h4>
  <?php } ?>