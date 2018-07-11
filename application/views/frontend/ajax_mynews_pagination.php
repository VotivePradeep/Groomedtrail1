<?php if(isset($newList)){
                     foreach ($newList as $news) {
                        $words = explode(" ",$news->news_description);
                        $content = implode(" ",array_splice($words,0,30));

                      ?>
                      
                    <div class="col-md-3 col-sm-6 col-lg-3">
                        <div class="mnm-sub-sec">
                            <div class="mnm-sub-img">
                                <a href="<?php echo base_url().'newdetail/'.$news->news_id; ?>"><img src="<?php if(isset($news->news_image) && !empty($news->news_image)){echo base_url().$news->news_image;}?>"></a>
                              <!--  <div class="news-date">
                                    <p><?php if(isset($news->news_update_date)){$date = date_create($news->news_update_date); 
                            echo date_format($date, 'M Y');}?></p>
                                </div> -->
                            </div>
                            <div class="mnm-sub-txt">
                                <h3><?php if(isset($news->news_title)){echo $news->news_title;}?></h3>
                                <span class="news-tme"><?php if(isset($news->news_update_date)){$date = date_create($news->news_update_date); 
                            echo date_format($date, 'd M Y h:i A');}?></span>
                                <div class="contentD"><?php if(isset($content)){echo $content;}?></div>
                                
                            </div>
                            <div class="mnm-sub-txt">
                              <a href="<?php echo base_url().'newdetail/'.$news->news_id; ?>">Read More</a>
                            </div>
                        </div>
                    </div> 
                    <?php

                    }  
                      } ?>
