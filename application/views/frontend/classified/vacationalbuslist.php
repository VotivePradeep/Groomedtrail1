<?php $this->load->view('include/header_css');?>
<style type="text/css">
.pac-container {
background-color: #fff;
position: absolute!important;
z-index: 1000;
border-radius: 2px;
border-top: 1px solid #d9d9d9;
font-family: Arial,sans-serif;
box-shadow: 0 2px 6px rgba(0,0,0,0.3);
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
overflow: hidden;
width: 100% !important;
max-width: 300px;
}
  
</style>
<?php $g_key =google_mapkey(); ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php if(isset($g_key[0]->google_key)){echo $g_key[0]->google_key;}?>"></script>
<body>
<header class="navigation">
    <div class="top-bar">
        <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
    </div>

    <nav class="navbar">
        <?php $this->load->view('include/nav_header'); ?>
    </nav>
</header>
<div class="wrapper">
  <section class="top-link" id="top-link">
        <div class="container">
            <div class="row">
              <form class="navbar-form hotal-search" role="search" method="get"  id="serachFrom" name="serachFrom">
                <div class="col_20">
                    <div class="forum-srch">                       
                        <div class="input-group">
                           <input type="text" class="form-control" id="businessSearch" placeholder="Search Location.." name="businessSearch" >                           
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"  id="searchbtn1" ><i class="fa fa-search"></i></button>
                            </div>
                        </div>                        
                    </div>
                </div>
                
                <div class="col_20">
                    <div class="forum-category">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle price-toggle" data-toggle="dropdown">Any Price<i class="fa fa-angle-down pull-right"></i></a>
                          </li>
                        </ul>
                    </div>

                    <div id="price-show" style="display: none;">      
                      <div>
                          <span>$ </span>                     
                          <select class=" form-control" id="hotel-min-price" name="hotel-min-price">
                            <option value="">Minimum</option>
                            <option value="75"> 75 </option>
                            <option value="100"> 100 </option>
                            <option value="125"> 125 </option>
                            <option value="150"> 150 </option>
                            <option value="200"> 200 </option>
                            <option value="300"> 300 </option>
                            <option value="400"> 400 </option>
                            <option value="500"> 500 </option>
                            <option value="600"> 600 </option>
                            <option value="700"> 700 </option>
                            <option value="800"> 800 </option>
                            <option value="900"> 900 </option>
                          </select>
                      </div>
                      <div>
                          <span>$ </span>
                          <select class="form-control" id="hotel-max-price" name="hotel-max-price">
                            <option value="">Maximum</option>
                            <option value="75"> 75 </option>
                            <option value="100"> 100 </option>
                            <option value="125"> 125 </option>
                            <option value="150"> 150 </option>
                            <option value="200"> 200 </option>
                            <option value="300"> 300 </option>
                            <option value="400"> 400 </option>
                            <option value="500"> 500 </option>
                            <option value="600"> 600 </option>
                            <option value="700"> 700 </option>
                            <option value="800"> 800 </option>
                            <option value="900"> 900 </option>
                            <option value="1000"> 1,000 </option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default"  id="searchbtn2">Apply Filter</button>    
                   </div>
                </div>

                <div class="col_20">
                     <div class="forum-category">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle bedrooms-toggle" data-toggle="dropdown">Any Bedrooms <i class="fa fa-angle-down pull-right"></i></a>
                          </li>
                        </ul>
                    </div>
                    <div id="bedrooms-show" style="display: none;">
                       <input  name="bedrooms_min" id="bedrooms_min" placeholder="Minimum" type="text">
                       <input  name="bedrooms_max" id="bedrooms_max" placeholder="Maximum" type="text">
                       <button type="submit" class="btn btn-default"  id="searchbtn3">Apply Filter</button>                        
                     </div>
                   </div>
                </form>

                <div class="scnd_form">
                  <div class="col_20 more-filters-cls">
                      <div class="forum-category">
                          <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" id="moreFilters">More Filters </a>
                            </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col_20 rentel-list-cls">
                      <div class="forum-category">
                          <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <a href="<?php echo base_url().'user/rentals/add' ?>" >List Your Rental </a>
                            </li>
                          </ul>
                      </div>
                  </div> 
                </div> 
            </div>
        </div>   
    </section>

    <section class="advancefilter" style="display:none;" id="advFilter">
      <div class="container">
        <div class="row">
           <form id="advSerchFrm" action="<?php echo base_url(); ?>vacationrentals" method="get">
          <div class="col-sm-3">
            <h4>Search by Location</h4>  
           <input type="text" class="form-control" id="adv_ft_loc" placeholder="Search Location.." name="businessSearch"  value="<?php if(isset($_GET['businessSearch'])) {echo $_GET['businessSearch']; } ?>">
           <h4>Any Price</h4>
           <div class="sele-main">
          <span>$</span>
           <select class=" form-control" id="adv-min-price" name="hotel-min-price">
              <option value="">Minimum</option>
              <option value="75"> 75 </option>
              <option value="100"> 100 </option>
              <option value="125"> 125 </option>
              <option value="150"> 150 </option>
              <option value="200"> 200 </option>
              <option value="300"> 300 </option>
              <option value="400"> 400 </option>
              <option value="500"> 500 </option>
              <option value="600"> 600 </option>
              <option value="700"> 700 </option>
              <option value="800"> 800 </option>
              <option value="900"> 900 </option>
            </select>
            </div>
            <div class="sele-main">
            <span>$</span>
             <select class="form-control" id="adv-max-price" name="hotel-max-price">
                <option value="">Maximum</option>
                <option value="75"> 75 </option>
                <option value="100"> 100 </option>
                <option value="125"> 125 </option>
                <option value="150"> 150 </option>
                <option value="200"> 200 </option>
                <option value="300"> 300 </option>
                <option value="400"> 400 </option>
                <option value="500"> 500 </option>
                <option value="600"> 600 </option>
                <option value="700"> 700 </option>
                <option value="800"> 800 </option>
                <option value="900"> 900 </option>
                <option value="1000"> 1,000 </option>
            </select>
            </div>
            <div class="inputs-main"> 
            <h4>Any Bedrooms</h4>           
            <p> <input  name="bedrooms_min" id="adv_bedrooms_min" placeholder="Minimum" type="text">
             <input  name="bedrooms_max" id="adv_bedrooms_max" placeholder="Maximum" type="text"></p>
            </div>
            
          </div>
          <?php //print_r($advanceFilter);
          foreach ($advanceFilter as $advF){  ?>
          <div class="col-sm-3"><h4><?php if(isset($advF->f_cat_name)){echo $advF->f_cat_name; } ?></h4>
            <div class="main-check-sel mCustomScrollbar">
            <?php
            if(!empty($advF->subs)) { ?>             
            <?php foreach ($advF->subs as $sub)  { ?>
              <div class="subcatMain"> 
                 <?php if(isset($advF->f_cat_name)){ 
                  if($advF->f_cat_name == 'Features') {?>
                <div class="main-chk">
                  <input type="checkbox" name="advfilterpro[]" id="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>" value="<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>"  >
                   <label for="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>"></label>
                </div>
                <span class="subcatName"> 
                  <?php if(isset($sub->f_subcat_name)){echo $sub->f_subcat_name; } ?>
                </span>
                 <?php }
                 if($advF->f_cat_name == 'Location Type') {?>
                <div class="main-chk">
                  <input type="checkbox" name="vac_location_type[]" id="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>" value="<?php if(isset($sub->f_subcat_name)){echo $sub->f_subcat_name; } ?>">
                   <label for="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>"></label>
                </div>
                <span class="subcatName"> 
                  <?php if(isset($sub->f_subcat_name)){echo $sub->f_subcat_name; } ?>
                </span>
                 <?php }
               if($advF->f_cat_name == 'Property Type') {?>
                <div class="main-chk">
                  <input type="checkbox" name="vac_type[]" id="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>" value="<?php if(isset($sub->f_subcat_name)){echo $sub->f_subcat_name; } ?>">
                   <label for="trailReport<?php if(isset($sub->f_id)){echo $sub->f_id; } ?>"></label>
                </div>
                <span class="subcatName"> 
                  <?php if(isset($sub->f_subcat_name)){echo $sub->f_subcat_name; } ?>
                </span>
                 <?php }
                  } ?>
                
                
              </div>
            <?php } } ?>
          </div>
          </div>
          <?php } ?>          
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="filter-bts">
              <button class="app" id="moreSearch" type="submit"><i class="fa fa-check"></i> Apply Filter</button>
              <div class="clr"><i class="fa fa-refresh"></i> Clear Filter</div>
              <div class="cncl"><i class="fa fa-times"></i> Cancel</div>
            </div>
          </div>
        </div>
         </form>
      </div>
    </section>

<section id="contentHolder" class="main-map-sec">
<div id="sticky-anchor"></div>
    <div class="map-main sticky" >
        <div class="google-ad" style="float: right; !important">
        <style>
        .example_responsive_1 { width: 160px !important; height: 600px !important; }
        </style>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- example_responsive_1 -->
          <ins class="adsbygoogle example_responsive_1"
          style="display:inline-block"
          data-ad-client="ca-pub-2773616400896769"
          data-ad-slot="3977017541"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
      </div>
      <div id="toggle-map-button">
          <a href="javascript:void(0)" id="mapZoom"><i class="fa fa-expand" aria-hidden="true"></i></a>
      </div>
    </div>
<?php $this->load->view('frontend/vacation/vac_list_main'); ?>
</div>
            

<footer id="footer" class="main_footer">

  <?php $this->load->view('include/main_footer');?>

<script type="text/javascript">
  $( "#businessSearch" ).keyup(function( event ) {
    $('#adv_ft_loc').val($(this).val());
  });
  $( "#adv_ft_loc" ).keyup(function( event ) {
    $('#businessSearch').val($(this).val());
  });
  $( "#hotel-min-price" ).change(function( event ) {
    $('#adv-min-price :selected').text($(this).val());
  });
  $( "#adv-min-price" ).change(function( event ) {
    $('#hotel-min-price :selected').text($(this).val());
  });
   $( "#hotel-max-price" ).change(function( event ) {
    $('#adv-max-price :selected').text($(this).val());
  });
  $( "#adv-max-price" ).change(function( event ) {
    $('#hotel-max-price :selected').text($(this).val());
  });
  $( "#bedrooms_min" ).keyup(function( event ) {
    $('#adv_bedrooms_min').val($(this).val());
  });
  $( "#bedrooms_max" ).keyup(function( event ) {
    $('#adv_bedrooms_max').val($(this).val());
  });
$(document).ready(function(){
slider();
});

function slider(){
    $(".list-carosel").owlCarousel({
        navigation : true,
        slideSpeed : 300,
        singleItem : true,
        pagination : false,
        autoPlay : true
    });
}
jQuery(window).scroll(function() {  
       if (jQuery(window).scrollTop() >=50) { 
          if(jQuery('.top-link').hasClass( "link-top" ))
  {
  //jQuery('#header').removeClass("fixed-theme");
  }
  else
  {
  jQuery('.top-link').addClass("link-top");
  }
       }
else{
jQuery('.top-link').removeClass("link-top");
}
   });


 
</script> 

<script type="text/javascript">
   $(document).ready(function() {
  
    $(".price-toggle").click(function(e) {

          $("#price-show").slideToggle(500);
      });
    $(".bedrooms-toggle").click(function(e) {

          $("#bedrooms-show").slideToggle(500);
      });
    $("#moreFilters").click(function(e) {

          $("#advFilter").slideToggle(500);
          $("#contentHolder").toggle(400);
      });
    $(".cncl").click(function(e) {
          e.preventDefault();
          $("#advFilter").slideUp(500);
          $("#contentHolder").slideDown(400);
         // $("#contentHolder").toggle(400);
      });
    $('.clr').click(function(e){
         e.preventDefault();
        $('#advSerchFrm')[0].reset();
    });



     $('#searchbtn1').click(function(evt) {
      evt.preventDefault();
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/vacationrentals",
          data: $('#serachFrom').serialize(),
         
          success: function(data){
          // alert(data);
          $('#reena').html(data);
          loadmap();
        //  slider();
          }
       });
      
    });
     $('#searchbtn2').click(function(evt) {
      evt.preventDefault();
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/vacationrentals",
          data: $('#serachFrom').serialize(),
         
          success: function(data){
          // alert(data);
          $('#reena').html(data);
          loadmap();
          //slider();
          }
       });
       
    });

     $('#searchbtn3').click(function(evt) {
      evt.preventDefault();
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/vacationrentals",
          data: $('#serachFrom').serialize(),
         
          success: function(data){
          // alert(data);
          $('#reena').html(data);
          loadmap();
          //slider();
          }
       });
     
    });

     $('#moreSearch').click(function(evt) {
      evt.preventDefault();
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url(); ?>ajax/vacationrentals",
          data: $('#advSerchFrm').serialize(),
          success: function(data){
            $("#advFilter").slideUp(500);
            $("#contentHolder").slideDown(400);
            $('#reena').html(data);
            loadmap();
           // slider();
          }
       });
     
    }); 
   });
   

</script>


 

</footer>
<div class="copy-right">
  <?php $this->load->view('include/copyright');?>
</div>
</body>
</html>

