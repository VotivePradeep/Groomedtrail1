<div class="footer-main">
  <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-2">
      <div class="f_heading">
        <h2>INFORMATION</h2>
        <ul>
          <?php 
          $menuList = footer_menu();
          //print_r($menuList);
          if(isset($menuList)){
                foreach ($menuList as $menu) { ?>
                  <li>
                   <?php if($menu->id == 12) { ?> 
                       <a href="<?php echo base_url('contact'); ?>">Contact Us</a>
                   <?php }else if($menu->id == 13){ ?>
                       <a href="<?php echo base_url('faq'); ?>">FAQ</a>
                   <?php }else{ ?>
                       <a href="<?php echo base_url('home/'.$menu->slag); ?>"><?php echo $menu->menu_name; ?></a>
                   <?php } ?>
                 </li>
            <?php } } ?>
            <!--<li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
          <li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>-->
        </ul>
      </div>
    </div>
    <div class="col-sm-4 col-md-3 col-lg-4">
      <div class="new-letter">
        <h2>NEWSLETTER</h2>
        <p>There are many variations of passages of Lorem Ipsum available, but the alteration.</p>
        <div class="new-fild">
          <!-- <form action="https://groomedtrail.us17.list-manage.com/subscribe/post?u=b3fcd6f5a31b69300f72eb756&amp;id=f022f18704" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter Email">
           <button type="submit" name="subscribe" id="mc-embedded-subscribe">SUBSCRIBE</button>
         </form> -->
         <?php $sub_detail = subcription_datail(); ?>
           <?php if(isset($sub_detail->html)){echo $sub_detail->html; } ?>
        </div>
      </div>
    </div>
    <div class="col-sm-5 col-md-6 col-lg-6">
      <div class="f_fot-img"> <img src="<?php echo base_url()?>assets/images/footer-banner.jpg"> </div>
    </div>
  </div>
</div>
<div id="ajax_favorite_loddder" style="display:none;">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
</div>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url()?>assets/js/custom.js"></script> 
<script src="<?php echo base_url()?>assets/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script> 
<script src="<?php echo base_url()?>assets/js/main.js"></script> 
<script>
   function viewnot(tablename,id,url){
   $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'ajax/viewnot'; ?>',
      data: { tablename:tablename,id:id },
      success: function(data)
      {
        if(data == 1 ){
             window.location.href = url;
        }

      }
    });
  }
   function notifiupdate(tablename,n_type_id,user_id,url){
   $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'ajax/notifiupdate'; ?>',
      data: { tablename:tablename,n_type_id:n_type_id,user_id:user_id },
      success: function(data)
      {
          if(data == 1 ){
           
             window.location.href = url;
        }
      }
    });
  }
   function notifiupdate1(tablename,n_type_id,user_id,n_id){
 
   $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'ajax/notifiupdate'; ?>',
      data: { tablename:tablename,n_type_id:n_type_id,user_id:user_id },
      success: function(data)
      {
         $('#news-feed-sub'+n_id).remove();
      }
    });
  }


function viewEvent(id, url){
$.ajax({
    type: 'POST',
    url: "<?php echo base_url(); ?>ajax/viewEvent",
    data:{id: id},
    success: function(data){
      $('#removeEvent_'+id).remove();
       window.location.href = url;
    }
});

}
function viewTrail(trail_name,sub_id){

$.ajax({
    type: 'POST',
    url: "<?php echo base_url(); ?>ajax/viewTrail",
    data:{trail_name: trail_name},
    success: function(data){
      location.reload();
    }
});

}

 wow = new WOW(
   {
     animateClass: 'animated',
     offset: 100
   }
 );
 wow.init();
$("#ajax_favorite_loddder").show();
$("body").addClass('loaderCls');
$(document).ready(function(){
$("#ajax_favorite_loddder").hide();
$("body").removeClass('loaderCls');
});
jQuery(window).scroll(function() {  
       if (jQuery(window).scrollTop() >=50) { 
          if(jQuery('.map-main').hasClass( "map-top" ))
  {
  //jQuery('#header').removeClass("fixed-theme");
  }
  else
  {
  jQuery('.map-main').addClass("map-top");
  }
       }
else{
jQuery('.map-main').removeClass("map-top");
}
   });
</script> 
<script>
/*$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop: true,
    slideMargin: 0,
    thumbItem: 9
}); */
$(".cd-signup").click(function(){
var currentId = $(this).attr("id");  
// alert("#"+currentId+"_div");
$("#user_type").val(currentId);
});
</script> 
<script>
$(document).ready(function(){
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');
    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');        
    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
})
</script> 
<script type="text/javascript">
    $('.select-my-profile').on('click', 'li', function() {
    $('.select-my-profile li.active').removeClass('active');
    $(this).addClass('active');
});
</script> 
<script type="text/javascript">
$(".info-box .fa-times").click(function(){
    $(".select-my-profile li").removeClass("active");
});
</script> 
<script type="text/javascript">
    jQuery(window).scroll(function() {   
       if (jQuery(window).scrollTop() >=60) { 
          if(jQuery('#header').hasClass( "fixed-theme" ))
  {
  //jQuery('#header').removeClass("fixed-theme");
  }
  else
  {
  jQuery('.navbar').addClass("navbar-fixed-top");
  jQuery('.info-box').addClass("info-box-h");
  }
       }
else{
jQuery('.navbar').removeClass("navbar-fixed-top");
jQuery('.info-box').removeClass("info-box-h");
}
   }) 
</script> 
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<style>

</style>
<script type="text/javascript">
function Logout()
{
  FB.logout(function(){ window.location.replace("<?php echo base_url(); ?>ajax/logout");});
}
 ////////////////////////////////////////Gmail Login////////////////////////////////////////////////
 /*Google signup*/
function gp_signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}
</script> 
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script> 
<script>
$("glog").click(function(){
    gp_signOut();
});

function gp_signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
    });
}

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
    disassociate();
         $.ajax({
          method: "POST",
          url: "<?php echo base_url();?>ajax/logout",
          success:function(data){
             if(data){
               document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo base_url();?>";  
                 
             }
          }
          }); 
  });
}
  
function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }
  function disassociate() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.disconnect().then(function () {
          console.log('User disconnected from association with app.');
      });
  }
////////////////////////////////////////////////////////////////////////////////////////////// 
$(document).ready(function() {    
   $(".event-slider").owlCarousel({
       navigation : true,
       slideSpeed : 300,
       pagination : false,
       singleItem:true,
       autoPlay:true
   });

});
</script>
<script>
function trailnotification(s_t_id,url){

$.ajax({
    type:'POST',
    url:'<?php echo base_url(); ?>ajax/trail_notification',
    data:{ s_t_id:s_t_id},
    success: function(data){
      if(data == 1){
        $('#news-feed-sub'+s_t_id).remove();
         window.location.href = url;
       
      }
    }
});

}
function notification(notification_id, url){
$.ajax({
    type:'POST',
    url:'<?php echo base_url(); ?>ajax/all_notification',
    data:{ notification_id:notification_id},
    success: function(data){
      if(data == 1){
        $('#news-feed-sub'+notification_id).remove(); 
          window.location.href = url;
      }
    }
});
}


  $(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
});
</script>