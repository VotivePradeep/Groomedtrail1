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
              <h3>News Details <button onClick="window.location.href='<?php echo base_url(); ?>/user/news'" style="margin-left: 10px;">Back </button></h3>

              <div class="row">
                
                <div class="form-group col-sm-12 ">
                    <div class=" busns-dscrpsn">
                    <label for="business_description">News Image</label>
                    <img src="<?php if(isset($newDetail[0]->news_image)){echo base_url().$newDetail[0]->news_image;} ?>" />
                   </div>  
                </div>
              </div>
              <div class=" mang-viw-dtl-pg">
                  <div class="row data-pro-table">
                    <table>
                    <tr>
                      <td>
                        <div class="form-group ">
                          <label for="business_name">Title</label>
                          <p><?php if(isset($newDetail[0]->news_title)) {echo $newDetail[0]->news_title; }?></p>
                          </div>
                        </td>
                        <td>
                          <div class="form-group ">
                            <label for="business_type">News Create Date</label>
                              <p><?php if(isset($newDetail[0]->news_created_date)){$date = date_create($newDetail[0]->news_created_date); 
                            echo date_format($date, 'd-M-Y');}?></p>
                          </div>
                        </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <div class="form-group ">
                          <label for="business_name">News Description</label>
                          <p><?php if(isset($newDetail[0]->news_description)) {echo $newDetail[0]->news_description; }?></p>
                          </div>
                        </td>
                    </tr>
                    </table>
                  </div>
                </div>
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
<script type="text/javascript">
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>user/changeStatus",{'id':id ,'status':status,'tablename':'tbl_news'},function(data){
    
    if(data){

      if($('#status_'+id).text() == 'Publish'){      
        $('#status_'+id).text('Unpublish'); 
        $('#status_'+id).css( "background-color", "#ff471a" );
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Publish');
        $('#status_'+id).css( "background-color", "#009933" );
        $('#status_'+id).removeClass('text-success').addClass('text-danger'); 
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',1)');
      }
      $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
 </script>
