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
            <div class="business-frm">
              <div id="responseMsg"></div>
              <h3>POIs List</h3>
            <!-- -->
            <div class="nw-bsns-btn"><a href="<?php echo  base_url();?>user/news/addnews">Add New News</a></div>
            
             <div class="table_data_main">
             <div class="table-responsive">
              <table id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
              <thead>
                 <tr>
                    <th>s. no</th>
                    <th>POI Type</th>
                    <th>State Name</th>
                    <th>POIs Name</th>
                </tr>
              </thead>
            
              <tbody>
                  <?php 
                $i =1;
                if(isset($kmlList)){
                    foreach ($kmlList as $poi) { 
                        if($poi->trail_type_name != 'Trail'){ 
                             ?>
                    <tr><td ><?php echo $i; ?></td>
                        <td><?php if(isset($poi->trail_type_name)){echo $poi->trail_type_name;}?></td>
                        <td><?php if(isset($poi->region_name)){echo $poi->region_name;}?></td>
                        <td><?php if(isset($poi->kml_data_name)){echo $poi->kml_data_name;}?></td>
                    </tr>    
               <?php $i++; } }?>

                       <?php }?>
                      
              </tbody>
          </table>
            </div>
            </div>
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
<script type="text/javascript">
 function deleteNewsfunc(del_id, tablename, message){

if (confirm(message))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>user/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }
    
}

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