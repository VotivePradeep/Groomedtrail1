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
              <h3>My Uploaded KML Files</h3>
            <!-- -->
            <div class="nw-bsns-btn"><a href="<?php echo  base_url();?>user/mymap/uploadkml">Upload New KML</a>

            <a href="<?php echo base_url().'user/traillist'; ?>">My Trails</a>
          </div>
            
             <div class="table_data_main">
             <div class="table-responsive">
              <table id="businessTbl11" class="table table-striped table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th style="display: none;">s. no</th>
                    <th>State</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>KML File Name</th>
                    <th>Upload Date</th>
                    <th>Action</th>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                if(isset($kmlList)){
                  $i= 1;
                    foreach ($kmlList as $kml) {
                            $words = explode(" ",$kml->description);
                            $content = implode(" ",array_splice($words,0,10)); ?>
                    <tr>

                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($kml->region_name)){echo $kml->region_name;}?></td>
                        <td><?php if(isset($kml->title)){echo $kml->title;}?></td>
                        <td><?php if(isset($content)){echo $content;}?></td>
                        <td><a href="<?php if(isset($kml->trail_kml_path)){echo $kml->trail_kml_path;}?>">
                        	<?php 
                             if(isset($kml->trail_kml_path)){
                               $kml_path = str_replace(base_url()."upload/","",$kml->trail_kml_path);
                               $arr = explode("/",$kml_path);
                               echo $arr[1];
                            }?>

                        </a></td> 
                        <td><?php if(isset($kml->trail_type_create_date)){$date = date_create($kml->trail_type_create_date); 
                            echo date_format($date, 'd-M-Y');;}?></td>
                        <td>
                          <ul>
                            <li><a href="#" onclick="myRoutePlan('<?php if(isset($kml->trail_type_id )){echo base64_encode($kml->trail_type_id);}?>','<?php if(isset($kml->region_name)){echo $kml->region_name;}?>');"><i class="fa fa-eye"></i></a></li>
                          <li><a onClick="deletefunc(<?php if(isset($kml->trail_type_id)){echo $kml->trail_type_id;} ?>, 'tbl_trail_master', 'Are you sure you want to remove this KML file and its associated trails?')" title="Delete" class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                          </ul>
                          <!--<a  class="de-list-row">Delete</a></td>-->
                        </td>
                    </tr>    
               <?php $i++; } }?>
                
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
function myRoutePlan(route_plan_id,state_name){
  window.location.href = "<?php echo base_url(); ?>home?tid="+route_plan_id+"&state_name="+state_name;  
}
$(document).ready(function() {
   // $('#businessTbl1').dataTable();
    $('#businessTbl11').dataTable({ 
        "order": [[ 0, "desc" ]] 
    }); 
});
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