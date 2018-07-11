<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>            
<div class="page-header"><h3>KML Management</h3></div>
<div class="panel panel-default kml-table">
<?php
    $flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 2) && ($checkper->add_permission==1)) { 
                $flag = 1;
            }
        }
    }
if ($flag == 1) {  ?>
   <div class="panel-heading">
       <ul class="cls-status-list">
        <li><a href="<?php echo base_url();?>administrator/kmlmanagement/uploadkml" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Upload KML File</a></li>
    </ul>
    </div>
<?php  
} elseif ($u_id==1) {
?>
    <div class="panel-heading">
        <ul class="cls-status-list">
        <li><a href="<?php echo base_url();?>administrator/kmlmanagement/uploadkml" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Upload KML File</a></li>
    </ul>
<?php } ?>  
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr><th style="display: none;">s. no</th>
                    <th>Category</th>
                    <th>State Name</th>
                    <th>Description</th>
                    <th>Kml File Path</th>
                    <th>Upload Date</th>
                    <th>Uploaded By</th>
                     <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 2) && ($checkper->status_change_permission==1)) { 
                                    $flag = 1;
                                }
                            }
                        }
                    if ($flag == 1) {  ?>
                    <th>Status</th>
                    <?php } elseif ($u_id==1) {
                        echo '<th>Status</th>';
                    }
                    
                    $flag=0;
                    if (isset($checkpers)) {
                        foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 2) && ($checkper->delete_permission==1)) { 
                                $flag = 1;
                            }
                        }
                    }
                    if ($flag == 1) {  ?>
                    <th>Action</th>
                    <?php } elseif ($u_id==1) {
                        echo '<th>Action</th>';
                    } ?>

                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($kmlList)){
                    foreach ($kmlList as $kml) { 
                        if($kml->trail_type_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$kml->description);
                            $content = implode(" ",array_splice($words,0,10));
                        ?>

                    <tr><td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($kml->trail_type_name)){echo $kml->trail_type_name;}?></td>
                        <td><?php if(isset($kml->region_name)){echo $kml->region_name;}?></td>
                        <td><?php if(isset($content)){echo $content;}?></td>
                        <td>
                        <a href="<?php if(isset($kml->trail_kml_path)){echo $kml->trail_kml_path;}?>">
                          <?php 
                             if(isset($kml->trail_kml_path)){
                               $kml_path = str_replace(base_url()."upload/","",$kml->trail_kml_path);
                               $arr = explode("/",$kml_path);
                               echo $arr[1];
                            }?>

                        </a>
                        <!-- <a href="<?php if(isset($kml->trail_kml_path)){ echo base_url().$kml->trail_kml_path;}?>">
                            <?php 
                             if(isset($kml->trail_kml_path)){ echo str_replace("upload/","",$kml->trail_kml_path);
                            }?>
                        </a> --></td> 
                        <td><?php if(isset($kml->trail_type_create_date)){$date = date_create($kml->trail_type_create_date); 
                            echo date_format($date, 'd-M-Y');;}?></td>
                        <td><?php if(isset($kml->trail_kml_upload_by) && !empty($kml->trail_kml_upload_by)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$kml->trail_kml_upload_by."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>

                         <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 2) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>    
                       <td>
                        <ul class="edv-option"><li ><a href="javascript:void(0);" id="status_<?php echo $kml->trail_type_id; ?>" onClick="changeStatus(<?php echo $kml->trail_type_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm buttonhid"><?php echo !empty($kml->trail_type_status)? 'Unpublish':'Publish' ?></a></li></ul></td>
                        <?php } elseif ($u_id==1) { ?>
                        <td>
                        <ul class="edv-option"><li ><a href="javascript:void(0);" id="status_<?php echo $kml->trail_type_id; ?>" onClick="changeStatus(<?php echo $kml->trail_type_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm buttonhid"><?php echo !empty($kml->trail_type_status)? 'Unpublish':'Publish' ?></a></li></ul></td>
                        <?php } ?>
                       <?php
                            $flag1=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 2) && ($checkper->delete_permission==1)) { 
                                        $flag1 = 1;
                                    }
                                }
                            }
                        if ($flag1 == 1) {  ?>  
                        <td> <ul class="edv-option"><li ><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($kml->trail_type_id)){echo $kml->trail_type_id;}?>">Delete</a></li></ul></td>
                        <?php }  elseif ($u_id==1) { ?>
                          <td> <ul class="edv-option"><li ><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($kml->trail_type_id)){echo $kml->trail_type_id;}?>">Delete</a></li></ul></td>
                        <?php } ?>
                        
                    </tr>    
               <?php $i++; } } ?>
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
$(document).ready(function(){

/////////////////////////delete kml////////////////
$(document).on('click','.deletekml', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_trail_master';
           
if (confirm('Do you want to remove this?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Delete successfully'; ?> </div>').show().fadeOut(5000);
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});


/////////////////////////delete kml////////////////



});

/////////////////////////change kml status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_trail_master'},function(data){
    
    if(data){
      location.reload();
      if($('#status_'+id).text() == 'Unpublish'){      
        $('#status_'+id).text('Publish'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
      }else{       
        $('#status_'+id).text('Unpublish');
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