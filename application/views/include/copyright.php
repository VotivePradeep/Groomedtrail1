<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6">
			<div class="c-right">© 2017 GroomedTrail All Rights reserved.</div>
		</div>
		<div class="col-sm-6">
			<div class="social-nav">
				<ul>
					<?php $social_setting = my_social_footer(); ?>
					<li><a href="<?php if(isset($social_setting[0]['facebook'])){ echo $social_setting[0]['facebook'];}?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<li><a href="<?php if(isset($social_setting[0]['linkedin'])){ echo $social_setting[0]['linkedin'];}?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="<?php if(isset($social_setting[0]['twitter'])){ echo $social_setting[0]['twitter'];}?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					<li><a href="<?php if(isset($social_setting[0]['google'])){ echo $social_setting[0]['google'];}?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>