<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
  <div id="responseMsg"></div>            
<div class="page-header"><h3>POIs List</h3></div>
<div class="panel panel-default POI-table">
  <?php
    $flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 3) && ($checkper->add_permission==1)) { 
                $flag = 1;
            }
        }
    }
if ($flag == 1) {  ?>
    <div class="panel-heading">
      <ul class="cls-status-list">
        <li> <a href="<?php echo base_url(); ?>administrator/poilist/addpoi" class="btn btn-default" style="background-color: #000;color: #fff">Add POIs</a></li>
        <li> <a href="<?php echo base_url(); ?>administrator/poitypes" class="btn btn-default" style="background-color: #000;color: #fff">POI Types</a></li>
      </ul>
    </div>
    <?php } elseif ($u_id==1) { ?>
    <div class="panel-heading">
      <ul class="cls-status-list">
        <li> <a href="<?php echo base_url(); ?>administrator/poilist/addpoi" class="btn btn-default" style="background-color: #000;color: #fff">Add POIs</a></li>
        <li> <a href="<?php echo base_url(); ?>administrator/poitypes" class="btn btn-default" style="background-color: #000;color: #fff">POI Types</a></li>
      </ul>
    </div>
<?php } ?> 
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>POI Type</th>
                    <th>State Name</th>
                    <th>POIs Name</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                   <?php $flag1=0;
                    $flag2=0;
                    $flag3=0;
                     if (isset($checkpers)) {
                        foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 3) ) { 

                                if($checkper->delete_permission==1){
                                   $flag1 = 1; 
                                }
                                if($checkper->edit_permission==1){
                                   $flag2 = 1; 
                                }
                                if($checkper->view_permission==1){
                                   $flag3 = 1; 
                                }

                            }
                        }
                    }
                    if ($flag1 == 1 || $flag2 == 1 ||  $flag3 == 1) {  ?>
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
                    foreach ($kmlList as $poi) { 
                        //if($poi->trail_type_name != 'Trail'){ 
                             ?>
                    <tr>
                        <td><?php if(isset($poi->poi_type)){echo $poi->poi_type;}?></td>
                        <td><?php if(isset($poi->region_name)){echo $poi->region_name;}?></td>
                        <td><?php if(isset($poi->kml_data_name)){echo $poi->kml_data_name;}?></td>
                         <td><?php if(isset($poi->last_modify_user_id) && !empty($poi->last_modify_user_id)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$poi->last_modify_user_id."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>
                        <td><?php if(isset($poi->last_modify_date) && $poi->last_modify_date !='0000-00-00'){$date = date_create($poi->last_modify_date); 
                        echo date_format($date, 'd-M-Y');}?></td>
                       <?php
                          if (isset($checkpers) && !empty($checkpers)) {
                              foreach ($checkpers as $checkper) {  


                                 if (($checkper->permission_id == 3)){
                                  if(($checkper->edit_permission==1) || ($checkper->delete_permission==1)){
                                 // && ($checkper->edit_permission==1) || ($checkper->delete_permission==1) ) { 
                                ?>
                        <td>
                        <ul class="edv-option">

                          <?php
                        $flag=0;
                        $flag1=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 3) && ($checkper->edit_permission==1)) { 
                                    $flag = 1;
                                }
                                if (($checkper->permission_id == 3) && ($checkper->delete_permission==1)) { 
                                    $flag1 = 1;
                                }

                            }
                        }
                         if ($flag == 1) {  ?>
                         
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/poilist/editpoi/'.$poi->kml_data_id;?>">Edit</a> </li>
                        <?php } 
                        if ($flag1 == 1) {  ?>
                            <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->kml_data_id)){echo $poi->kml_data_id;}?>">Delete</a></li>
                        <?php } ?>  
                        </ul>
                        </td>
                        
                      <?php } } } }
                      else if($u_id==1){ ?>

                      <td>
                        <ul class="edv-option">
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/poilist/editpoi/'.$poi->kml_data_id;?>">Edit</a> </li>
                    
                            <li><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->kml_data_id)){echo $poi->kml_data_id;}?>">Delete</a></li>
                      
                        </ul>
                        </td>

                      <?php } ?>
                    </tr>    
               <?php $i++; } }?>
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
 var tablename= 'tbl_kml_data';
           
if (confirm('Do you want to remove this?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
            $('#responseMsg').html('<div class="alert alert-success">Delete successfully</div>').show().fadeOut(5000);
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});
});
</script>