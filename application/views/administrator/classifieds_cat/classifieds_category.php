<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
<div id="responseMsg"></div>           
<div class="page-header"><h3>Classifieds Category List</h3></div>
<div class="panel panel-default trail-table POI-table">
    <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 10) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
         <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/classifieds/addclassifiedscat" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add Classified Category</a></li>
        </ul>  
    </div>
    <?php  
    } elseif ($u_id==1) {
    ?>
         <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/classifieds/addclassifiedscat" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add Classified Category</a></li>
        </ul>  
    </div>
    <?php } ?>
    <div id="responseMsg"></div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr><th style="display: none;">s. no</th>
                    <th>Classifieds category name</th>
                    <th>Created Date</th>
                    <th>Sort Order</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 10) && ($checkper->status_change_permission==1)) { 
                                    $flag = 1;
                                }
                            }
                        }
                    if ($flag == 1) {  ?>
                    <th>Status</th>
                    <?php } elseif ($u_id==1) {
                        echo '<th>Status</th>';
                    }
                    
                   $flag1=0;
                    $flag2=0;
                    $flag3=0;
                     if (isset($checkpers)) {
                        foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 10) ) { 

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
                if(isset($classifiedcatlist)){
                    foreach ($classifiedcatlist as $classcatlist) { 
                        if($classcatlist->classified_cat_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                        ?>

                    <tr>
                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($classcatlist->classified_cat_name)){echo $classcatlist->classified_cat_name;}?></td>
                        <td><?php if(isset($classcatlist->classified_cat_created_date)){$date = date_create($classcatlist->classified_cat_created_date); 
                            echo date_format($date, 'd-M-Y');;}?></td>
                        <td><input type="number"  min="1" step="1" id="classified_sort_order_<?php echo $i; ?>"  name="classified_sort_order" value="<?php if(isset($classcatlist->classified_sort_order) && !empty($classcatlist->classified_sort_order)){echo $classcatlist->classified_sort_order;}?>" onchange="sort_order(this.value, <?php if(isset($classcatlist->classified_cat_id)){echo $classcatlist->classified_cat_id;}?>, 'tbl_classified_cat_master');" style="width: 65px;">
                        </td>
                        <td><?php if(isset($classcatlist->last_modify_user_id) && !empty($classcatlist->last_modify_user_id)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$classcatlist->last_modify_user_id."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>
                        <td><?php if(isset($classcatlist->last_modify_date) && $classcatlist->last_modify_date !='0000-00-00'){$date = date_create($classcatlist->last_modify_date); 
                        echo date_format($date, 'd-M-Y');}?></td>
                        
                        <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 10) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>  
                          <td><a href="javascript:void(0);" id="status_<?php echo $classcatlist->classified_cat_id; ?>" onClick="changeStatus(<?php echo $classcatlist->classified_cat_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm class_cat_u_p" style="background-color: #387fcc;color:#fff"><?php echo !empty($classcatlist->classified_cat_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } elseif ($u_id==1) { ?>
                         <td><a href="javascript:void(0);" id="status_<?php echo $classcatlist->classified_cat_id; ?>" onClick="changeStatus(<?php echo $classcatlist->classified_cat_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm class_cat_u_p" style="background-color: #387fcc;color:#fff"><?php echo !empty($classcatlist->classified_cat_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } ?>
                     <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 10) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 10) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                               
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 ){ ?>
                        <td>
                            <ul class="edv-option">
                            
                            <?php if($flag2 == 1){ ?>
                             <li>
                                <a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php echo base_url();?>administrator/classifieds/editclassifiedscat/<?php echo $classcatlist->classified_cat_id; ?>">Edit</a>
                            </li>
                           <?php }  ?>
                            <?php if($flag1 == 1){ ?>
                            <li>
                                <a class="btn btn-default btn-sm deletclassified deletetrail btn-delete" id="<?php echo $classcatlist->classified_cat_id; ?>" classimg="">Delete</a>
                            </li>
                           <?php }  ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                            <ul class="edv-option">
                                <li>
                                <a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php echo base_url();?>administrator/classifieds/editclassifiedscat/<?php echo $classcatlist->classified_cat_id; ?>">Edit</a>
                            </li>
                            <li>
                                <a class="btn btn-default btn-sm deletclassified deletetrail btn-delete" id="<?php echo $classcatlist->classified_cat_id; ?>" classimg="">Delete</a>
                            </li>
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
function sort_order(value, id, tablename){
    $.ajax({
    type:'POST',
    url:'<?php echo base_url();?>administrator/admin/sort_order',
    data:{ id:id, tablename:tablename,value:value },
    success: function(data){
        if(data == 1){
         $('#responseMsg').html('<div class="alert alert-success">Order change successfully</div>').show().fadeOut(5000);  
        }
    }
    });
}
$(document).ready(function(){
$(document).on('click','.deletetrail', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_classified_cat_master';
           
if (confirm('Do you want to remove this Category?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             location.reload();
          }
           }
        });
          
        }

});


/////////////////////////delete trail////////////////



});

/////////////////////////change trail status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_classified_cat_master'},function(data){
    
    if(data){

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