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
            <div class="business-frm kml-form-main">
              <div id="responseMsg"></div>
              <h3>Add New KML 
              <a href="<?php echo base_url().'user/mymap'; ?>" class="GoTo"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go to uploaded KML List</a></h3>
            <!-- -->
            
             <div class="table_data_main">
             <div class="table-responsive">
              <form  method="post" id="addtrail" action="<?php if(isset($segment) && $segment == 'uploadkml'){echo base_url().'user/mymap/uploadkml'; } ?>"  enctype="multipart/form-data">
                    <input type="hidden" name="trail_name" name="trail_name" class="form-control" value="Trail">
                    <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">State Name</label>
                         <div class="col-sm-8">
                            <select name="region_name" id="region_name" class="form-control">
                                <option value="">Please Select State Name</option>
                                <?php if(isset($getState)){
                                foreach ($getState as $getState) { ?>
                                <option value="<?php if(isset($getState->state_name)){echo $getState->state_name;} ?>" <?php if(isset($poiDetail[0]->region_name)){ if ($poiDetail[0]->region_name == $getState->state_name){ echo ' selected="selected"'; } } ?>><?php if(isset($getState->state_name)){echo $getState->state_name;} ?></option>
                                <?php } } ?>
                            </select>
                            <label id="region_name-error" class="error" for="region_name"><?php echo form_error('region_name');?></label>
                        </div>
                    </div>
                    <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">Title</label>
                         <div class="col-sm-8">
                            <input type="input" class="form-control" name="title" value="" placeholder="Enter Title" />
                            <label id="title-error" class="error" for="title"><?php echo form_error('title');?></label>  
                        </div>
                    </div>
                    <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">Upload File (KML only)</label>
                         <div class="col-sm-8">
                             <input type="hidden" class="form-control" name="kmlpath" id="kmlpath"/>
                             <input type="file" class="form-control" name="trail_kml_path" placeholder="Upload KML File" />
                              <label id="kmlpath-error" class="error" for="kmlpath"><?php echo form_error('kmlpath');?></label>
                        </div>
                    </div>
                    <!--  <div class="form-group">   
                        <label class="col-sm-3 control-label cms-label">Description</label>
                         <div class="col-sm-8">
                             <input type="text" class="form-control" name="description" id="description" placeholder="Enter description" />
                             <label id="description-error" class="error" for="description"><?php echo form_error('description');?></label>                              
                        </div>
                    </div> -->
                     <div class="form-group">   
                         <div class="col-sm-8">
                            <button type="submit" class="btn btn-primary" name="signup" value="Validate">Submit</button>                            
                        </div>
                    </div>
                    </form>
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
<script>
$(document).ready(function() {
  
$('input[type=file]').change(function(e){
   var val = $(this).val();
   //alert(val);
   $('#kmlpath').val(val);
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