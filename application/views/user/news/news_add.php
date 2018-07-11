<?php $this->load->view('include/header_css');?>

<body>
<style type="text/css">

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
          <div class="col-md-9 col-sm-8 no-paddng">
           <div class="business-detail-sec">
            <div class="business-frm">
              <div id="responseMsg"></div>
              <h3><?php if(isset($segment) && $segment == 'addnews'){ echo 'Add News'; }else{
                       echo 'Edit News'; 
                    } 
                    ?></h3>
            <form id="addnews" name="addnews" method="post" action="<?php if(isset($segment) && $segment == 'addnews'){echo base_url().'user/news/addnews'; }else{
                    echo base_url().'user/news/editnews/'.$newsId; } ?>" enctype="multipart/form-data">

              <input type="hidden" name="event_id" id="event_id" class="form-control" value="<?php if(isset($eventID)) {echo $eventID; }?>" />
            
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="event_title">Title</label>
                   <input type="text" name="news_title" class="form-control" placeholder="Enter your News title..." value="<?php if(isset($newDetail[0]->news_title)){echo $newDetail[0]->news_title;}else{echo set_value('news_title'); }?>"/>
                    <label id="news_title-error" class="error" for="news_title"><?php echo form_error('news_title');?></label>
                </div>

                 <div class="col-md-6 form-group">
                    <label for="event_image">Images</label>
                    <input type="hidden" class="form-control" name="news_image11" id="news_image11" />
                    <input type="file" class="form-control" name="news_image" id="news_image" accept="image/*" />
                    <label id="news_image11-error" class="error" for="news_image11"><?php echo form_error('news_image11');?></label>
                    <?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){ ?>
                    <div class="pictures-show" id="dvPreview">
                      <img src="<?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){echo base_url().$newDetail[0]->news_image;}?>" <?php if(isset($newDetail[0]->news_image) && !empty($newDetail[0]->news_image)){ ?>style="height: 100px;margin: 6px;width: 100px;" <?php } ?> />
                    </div>  
                    <?php } ?>                   
                 </div>
              </div>
               
              <div class="row">
                <div class="col-md-12 form-group <?php if(form_error('news_description')){?>has-error<?php }?>">
                    <label for="event_image">Description</label>
                      <textarea  id="ckeditor" name="news_description" ><?php if(isset($newDetail[0]->news_description)){echo $newDetail[0]->news_description; }else{echo set_value('news_description'); }?></textarea>
                    <label id="news_description-error" class="error" for="news_description"><?php echo form_error('news_description');?></label>
                  </div>
              </div>
           
               
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" id="add-business-btn" name="submit" class="btn btn-default"><?php if(isset($segment) && $segment == 'addnews'){echo 'Submit'; }else{ echo 'Update';} ?></button>
                </div>
              </div>
              
           </form>
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
  <!-- Warper Ends Here (working area) -->
<script>
$(document).ready(function() {

  $('#news_image').change(function(){
   var url = $(this).val();
   $('#news_image11').val(url);
  });



$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
});

  

</script>
