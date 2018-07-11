<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <style type="text/css">
.preview-sitmap {
float: left;
width: 100%;
margin-top: 15px;
}
.preview-sitmap .xml-preview {

min-width: 600px;
max-width: 600px;

max-height: 315px;
min-height: 315px;
-webkit-appearance: none;
outline: none;
border: 2px solid #428bca;
padding: 8px;
resize: none;
}
.sitemap-table{
  margin-bottom: 20px;
  height: 407px;
  overflow: auto;
}
.sitemap-table table tr {
border-bottom: 1px solid #ccc;
}
.sitemap-table table tr td{
padding-right:30px;
padding-top: 5px;
padding-bottom: 5px;

}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
                <div class="panel-heading">Create Sitemap XML</div>
                <div class="panel-body">
                 <div id="responseMsg"></div>

                  <button type="submit" class="btn btn-primary" name="signup" value="Validate" onclick="create_site_map();">Create Sitemap XML</button>
                  <div class="preview-sitmap"></div>
                  <div class="dwonload-sitmap"></div>
                    <!-- <form class="ng-pristine ng-valid" id="addseo" name="addseo" method="post" action="<?php echo base_url().'administrator/site_map';  ?>">
                    <div class="form-group <?php if(form_error('site_url')){?>has-error<?php }?>">
                        <label class="col-sm-3 control-label cms-label">Web Site Url<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                        <input type="text" name="site_url" class="form-control" placeholder="Enter site url..."  />
                           <label id="site_url-error" class="error" for="site_url"><?php echo form_error('site_url');?></label>
                        </div>
                      </div> 
                       <div class="form-group buton-edit">
                        <hr class="dotted">
                       <label class="col-sm-3"></label>
                       <div class="col-sm-8 buton-edit">
                        <button type="submit" class="btn btn-primary" name="signup" value="Validate">Submit</button>
                        <button id="resetBtn" name="resetBtn" class="btn btn-info" type="submit" onclick="location.href='<?php echo base_url(); ?>administrator/site_map';">Cancel</button>
                        </div>
                       </div>
                    </form> -->
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
<!-- Warper Ends Here (working area) -->
<div id="ajax_favorite_loddder" style="display:none;">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
</div>
<script type="text/javascript">
$('#xml-preview').hide();

 function create_site_map(){
$('#ajax_favorite_lodder').show();
 $.ajax({
        url: "<?php echo base_url(); ?>administrator/SiteMap/create_site_map",
        success: function(data){
          $('#xml-preview').show();
          $('#xml-preview').addClass('xml-preview');
          $('.preview-sitmap').html(data);
          //$('.preview-sitmap').html('<textarea id="xml-preview" class="xml-preview">'+data+'</textarea>');
          $('.dwonload-sitmap').html('<a class="btn btn-primary" href="<?php echo base_url().'site_map.xml'?>" download><i class="fa fa-download" aria-hidden="true"></i> Download  XML sitemap file</a> <a class="btn btn-primary" href="<?php echo base_url().'site_map.xml'?>" target="_black"><i class="fa fa-file-text-o" aria-hidden="true"></i> Preview XMLsitemap file</a>');
          $('#ajax_favorite_lodder').hide();
        }
    });

}
</script>