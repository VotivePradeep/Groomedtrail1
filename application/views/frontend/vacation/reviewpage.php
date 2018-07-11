 <?php if(isset($totalReview)){
        foreach ($totalReview as $totalReview) { ?>
      <div class="get-riview" >
        <div class="reviewStar">
          <?php 
            $starNumber = $totalReview->rating;
            for($x=1;$x<=$starNumber;$x++) { ?>
              <a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
              <?php  }
              if (strpos($starNumber,'.')) { ?>
              <a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
               <?php $x++;
              } 
              while ($x<=5) { ?>
              <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
              <?php $x++;
            }                              
          ?>
        </div>
    
        <div id="dumpallmsg" class="message_body_main">
          <div class="booking_detail_main_bottom_one_zeerba">
            <div class="booking_detail_main_bottom_one_zeerba_l">
              <?php 
              if(isset($totalReview->profile_picture) && !empty($totalReview->profile_picture)){ 

                if(strpos($totalReview->profile_picture, "http://") !== false OR strpos($totalReview->profile_picture, "https://") !== false){
                   $img = $totalReview->profile_picture;
                }else
                {
                   $img = base_url().$totalReview->profile_picture;
                }
              }
              else
              { 
                $img =  base_url().'assets/images/default.png';}

              ?> 
              <img src="<?php echo $img; ?>">
              <p title="<?php if(isset($totalReview->fname) ){echo $totalReview->fname; }?>"><?php if(isset($totalReview->fname) ){echo $totalReview->fname; }?></p>
            </div>  
            <div class="booking_detail_main_bottom_one_zeerba_r">
              <p><strong><?php if(isset($totalReview->review_title) ){echo $totalReview->review_title; }?></strong>
                <span class="date_book">
                  <?php if(isset($totalReview->created_date)){
                    $createdDate = date('d M Y h:i A',strtotime($totalReview->created_date));
                    echo $createdDate; }?>
                </span>
              </p> 
               <span class="book_sp">
                <?php if(isset($totalReview->comment)){echo $totalReview->comment; }?>
                </span>
                 
            </div> 
            <!-- <p><?php if(isset($totalReview->fname) ){echo $totalReview->fname; }?> <?php if(isset($totalReview->lname) ){echo $totalReview->lname; }?></p> -->
          </div>
        </div> 
      </div>                      
<?php } } ?>