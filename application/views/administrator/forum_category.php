<?php $this->load->view('administrator/include/left_sidebar'); ?>
<link href="<?php echo base_url();?>assets/css/forum.css" rel="stylesheet">
<div class="warper container-fluid">
 <div id="responseMsg"></div>  
 <?php msg_alert(); ?>           
<div class="page-header"><h3>Forum Category List</h3></div>
<div class="panel panel-default route-table">
    <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 9) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
         <div class="panel-heading">
		        <ul class="cls-status-list">
		             <li> <a href="<?php echo base_url(). BASE_FOLDER_PATH ?>add_forum_category" class="btn btn-default btn-sm">Add Forum Category</a></li>
		        </ul> 
         </div>
    <?php  
    } elseif ($u_id==1) {
    ?>
         <div class="panel-heading">
		        <ul class="cls-status-list">
		             <li> <a href="<?php echo base_url(). BASE_FOLDER_PATH ?>add_forum_category" class="btn btn-default btn-sm">Add Forum Category</a></li>
		        </ul> 
        </div>
    <?php } ?>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead><tr>
                    <th style="display: none">S. No</th>
					<th>Category Name</th>
					<th>Category Image</th>
					<th>Sort Order</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
					<?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 9) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 9) ) { 

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
				if(!empty($categories)) {
				$i=1;
				foreach($categories AS $category) { 
					$image = '';
					if(isset($category->forum_cat_image) && !empty($category->forum_cat_image)){
						$image = base_url()."assets/category_images/icon/".$category->forum_cat_image;
					}else{
						$image = base_url()."assets/images/no-image.jpeg";
					}
					if($category->forum_cat_status == 'Aproved'){
                                $st='Deactivate'; $set= 'Panding';
                            }else{
                                $st='Activate'; $set='Aproved';
                            }
				echo "<tr class='gradeX'>";
				echo "<td style='display: none'>".$category->forum_cat_id."</td><td>".$category->forum_cat_name."</td>";
				echo "<td><a href='".$image."'><img class='admin_icon' src='".$image."' style='width:100px;height:100px'></a></td>"; ?>
	           <td><input type="number"  min="1" step="1" id="forum_sort_order_<?php echo $i; ?>"  name="forum_sort_order" value="<?php if(isset($category->forum_sort_order) && !empty($category->forum_sort_order)){echo $category->forum_sort_order;}?>" onchange="sort_order(this.value, <?php if(isset($category->forum_cat_id)){echo $category->forum_cat_id;}?>, 'forum_category');" style="width: 65px;"></td>
                <td><?php if(isset($category->last_modify_user_id) && !empty($category->last_modify_user_id)){
                $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$category->last_modify_user_id."");
                $result = $query->result();
                echo $result[0]->fname;

                }?></td>
                <td><?php if(isset($category->last_modify_date) && $category->last_modify_date !='0000-00-00'){$date = date_create($category->last_modify_date); 
                echo date_format($date, 'd-M-Y');}?></td>

	             <?php $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 9) && ($checkper->status_change_permission==1) ) {
                                    $flag = 1;
                                }
                            }
                        }
                    if ($flag == 1) {  ?>  
                       <td><a href="javascript:void(0);" id="status_<?php echo $category->forum_cat_id; ?>" onClick="changeStatus(<?php echo $category->forum_cat_id ?> ,'<?php echo $set; ?>');"  class="btn btn-default btn-sm class_cat_u_p">
			           	<?php if(isset($category->forum_cat_status)){
			           		if($category->forum_cat_status == 'Panding'){
			           			echo 'Publish';
			           		}else{
			           			echo 'Unpublish';
			           		}

			           	}?></a></td>
                 <?php } elseif ($u_id==1) { ?>
                       <td><a href="javascript:void(0);" id="status_<?php echo $category->forum_cat_id; ?>" onClick="changeStatus(<?php echo $category->forum_cat_id ?> ,'<?php echo $set; ?>');"  class="btn btn-default btn-sm class_cat_u_p">
	           	<?php if(isset($category->forum_cat_status)){
	           		if($category->forum_cat_status == 'Panding'){
	           			echo 'Publish';
	           		}else{
	           			echo 'Unpublish';
	           		}

	           	}?></a></td>
                <?php } ?>
                <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 9) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 9) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                if (($checkper->permission_id == 9) && ($checkper->view_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                            <?php 
                            if ($flag3 == 1) {
                             echo  "<li><a class='btn btn-default btn-sm btn-edit' href='". base_url(). BASE_FOLDER_PATH ."forum/".$category->forum_cat_url."'> View</a></li>";
                             }?>
                            <?php if($flag2 == 1){ 
                             echo "<li><a class='btn btn-default btn-sm btn-edit' href='". base_url(). BASE_FOLDER_PATH ."add_forum_category?forum_cat_id=".$category->forum_cat_id."'><i class='ti ti-pencil'></i> Edit</a></li>";
                             }  ?>
                            <?php if($flag1 == 1){ 
                             echo "<li><a class='btn btn-default btn-sm deletenews btn-delete'"; ?> onclick="return confirm('Are you sure you want to delete this item!')" <?php echo "href='".base_url().BASE_FOLDER_PATH."forum_category/delete_cat/".$category->forum_cat_id."'><i class='ti ti-trash'></i> Delete</a></li>";
                            }  ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { 
		                echo "<td><ul class='edv-option'>
						 <li><a class='btn btn-default btn-sm btn-edit' href='". base_url(). BASE_FOLDER_PATH ."forum/".$category->forum_cat_url."'> View</a></li>
		                 <li><a class='btn btn-default btn-sm btn-edit' href='". base_url(). BASE_FOLDER_PATH ."add_forum_category?forum_cat_id=".$category->forum_cat_id."'><i class='ti ti-pencil'></i> Edit</a></li>";
		               
						echo "<li><a class='btn btn-default btn-sm deletenews btn-delete'"; ?> onclick="return confirm('Are you sure you want to delete this item!')" <?php echo "href='".base_url().BASE_FOLDER_PATH."forum_category/delete_cat/".$category->forum_cat_id."'><i class='ti ti-trash'></i> Delete</a></li>";
						   
		                echo" </ul></td>";
		                 } ?>

		             <?php  echo "</tr>";
						$i++;
						} } else{
							echo "<tr> <td  style='text-align: center'>No records found.</td><td></td><td></td><td></td><td></td></tr>";
						}
						?>
						</tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->

<script>
    $(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 0, "desc" ]] 
    }); 
});
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


function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'forum_category'},function(data){
    
    if(data){

      /*if($('#status_'+id).text() == 'Unpublish'){      
        $('#status_'+id).text('Publish'); 
        $('#status_'+id).removeClass('text-danger').addClass('text-success');
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',"Panding")');
      }else{       
        $('#status_'+id).text('Unpublish');
        $('#status_'+id).removeClass('text-success').addClass('text-danger'); 
        $('#status_'+id).attr('onClick', 'changeStatus('+id+',"Aproved")');
      }*/
      $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);

     location.reload();
    } //success if close here
    else{
    console.log(data);    
    }
       
  }); 
}
</script>