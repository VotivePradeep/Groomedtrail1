<div class="panel-group" id="accordion">						
		<?php if(!empty($categories)) {
		foreach($categories AS $item) {
		?>
		<div class="forum-cat-sub" id="panel1">
			 <div class="forum-cat-sub-head">
				<h3 class="panel-title"><a
				class="detail-category" href="<?php echo base_url().'forum/'.$item->forum_cat_url; ?>" ><?php echo $item->forum_cat_name; ?></a>
				
				<a class="forum-topic-add"
				    href="<?php echo base_url().'forum/'.$item->forum_cat_url.'?start_new_topic=1'; ?>" >Start New Topic </a>
				</h3>

			</div> 
			
			<div id="collapseOne<?php echo $item->forum_cat_id;?>" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="forum-list">
						<?php
						$i = 1;
						if(!empty($item->topic)) {
										
										foreach($item->topic AS $topic ) {
											//print_r($topic);
											if($i<= 5){
						?>
						<div class="post" <?php if(isset($topic->abuse_forum)){ if($topic->abuse_forum == 1){ ?> style="background-color: #387fcc2e;"<?php } }?> >
							<div class="wrap-ut pull-left">
								
								<div class="userinfo pull-left">
									
									<div class="avatar">
									<?php 
						              if(isset($topic->profile_picture) && !empty($topic->profile_picture)){ 

						              if(strpos($topic->profile_picture, "http://") !== false OR strpos($topic->profile_picture, "https://") !== false){
						                $img = $topic->profile_picture;
						              }else
						              {
						                $img = base_url().$topic->profile_picture;
						              }

						              }
						              else
						              { 
						              $img =  base_url().'assets/images/default.png';}

						              ?>


									<img src="<?php echo $img; ?>" alt="">
										<div class="status green">&nbsp;</div>
									</div>
								</div>
								<div class="posttext pull-left">
									<h2><a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$topic->forum_ques_url;?>"><?php echo $topic->forum_ques_title; ?></a></h2>
									<p><?php $forum_ques_description=strip_tags($topic->forum_ques_description);
															echo mb_strimwidth($forum_ques_description, 0, 150);
									?></p>
									<a href="<?php echo base_url().'forum/'.$item->forum_cat_url.'/'.$topic->forum_ques_url;?>" class="pull-right readmorefourm">Read More</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="postinfo pull-left">
								<div class="abuse-tag"><a href="javascript:void(0)" class="abuse-cls" id="abuse_<?php echo $topic->forum_ques_id; ?>" page_url="<?php echo 'forum/'.$item->forum_cat_url.'/'.$topic->forum_ques_url;?>" f_que_id="<?php echo $topic->forum_ques_id; ?>" forum_title="<?php echo $topic->forum_ques_title; ?>" title="ubuse"><img src="<?php echo base_url();?>assets/images/Loud_Speaker.png" style="width: 30px;height: 30px;" title="abuse"/></a></div>
								<div class="detail-forum">
									<span>by <?php if(isset($topic->fname) && !empty($topic->fname)){echo $topic->fname; } ?> </span><br><span><?php if(isset($topic->date)){ $date = date_create($topic->date); echo date_format($date, 'd M Y h:i A');}?></span>
								</div>
								<div class="comments">
									<div class="commentbg"><i class="fa fa-comments"></i> <?php echo $topic->total_comment; ?>
										<div class="mark"></div>
									</div>
								</div>
								<div class="views"><i class="fa fa-eye"></i> <?php echo $topic->total_view; ?></div>
								<div class="time"><i class="fa fa-clock-o"></i> <?php $topic->last_comment_time;
													
									$from=date_create(get_current_datetime());
									$to=date_create($topic->last_comment_time);
									$diff=date_diff($to,$from);
									// echo  $diff->format('%a D and %h h and %i m %s s');
										//echo "<br>...";
									$day=$diff->format('%a');
									$hour=$diff->format('%h');
									$minute=$diff->format('%i');
									$second=$diff->format('%s');
										if($day > 0){
										echo $day=$diff->format('%a days');
										} else if($day <= 0 && $hour > 0){
										echo $day=$diff->format('%h hr');
										} else if($day <= 0 && $hour <= 0 && $minute > 0){
										echo $day=$diff->format('%i min');
										}else if($day <= 0 && $hour <= 0 && $minute <= 0 && $second > 0){
										echo $day=$diff->format('%s sec');
										}else{
											
										}
										
								?></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<?php $i++;} } } ?>
						
					</div>
				</div>
			</div>
		</div>
		
		<?php } }else{ ?>
          <h4>We couldn't find any match for your search.</h4>
		<?php } ?>
		
	</div>
