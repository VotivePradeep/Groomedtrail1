<?php $this->load->view('administrator/include/left_sidebar'); ?>
<div class="warper container-fluid">
    <div id="responseMsg"></div>
    <div class="page-header"><h3>Menu List</h3></div>
    <div class="panel panel-default POI-table">
        <?php
        $flag=0;
        $edit_flag = 0;
        $delete_flag = 0;
        $status_flag = 0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {
                if (($checkper->permission_id == 29) && ($checkper->add_permission==1)) {
                    $flag = 1;
                }
                if (($checkper->permission_id == 29) && ($checkper->edit_permission==1)) {
                    $edit_flag = 1;
                }
                if (($checkper->permission_id == 30) && ($checkper->delete_permission==1)) {
                    $delete_flag = 1;
                }
                 if (($checkper->permission_id == 30) && ($checkper->status_change_permission==1)) {
                    $status_flag = 1;
                }
            }
        }
        if ($flag == 1 ||  $u_id==1) {  ?>
        <div class="panel-heading">
            <a href="<?php echo base_url();?>administrator/cmspage/addcmspage" class="btn btn-default btn-sm">Add Page</a>
        </div>
        <?php  }  ?>
        <div class="panel-body">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
                <thead>
                    <tr>
                        <th>Page Name</th>
                        <?php if ($edit_flag == 1 ||  $u_id==1) {  ?>
                        <th>Edit Menu</th>
                        <?php } ?>
                         <?php if ($delete_flag == 1 ||  $u_id==1) {  ?>
                        <th>Delete Menu</th>
                        <?php } ?>
                         <?php if ($status_flag == 1 ||  $u_id==1) {  ?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i =1;
                    if(isset($cmsPageList)){
                    foreach ($cmsPageList as $cmspage) {
                        if($cmspage->status == 1){
                            $st='Deactivate'; $set=0;
                        }else{
                            $st='Activate'; $set=1;
                        }
                        if($cmspage->show_in_menu == 1){
                            $st1='Deactivate'; $set1=0;
                        }else{
                            $st1='Activate'; $set1=1;
                        }
                    ?>
                    <tr>
                        <td><?php if(isset($cmspage->page_name)){echo $cmspage->page_name;}?></td>
                        <?php if ($edit_flag == 1 ||  $u_id==1) {  ?>
                        <td><a class="btn btn-default btn-sm" href="<?php echo base_url().'administrator/cmspage/editcmspage/'.$cmspage->id;?>">Edit</a> </td>
                        <?php } ?>
                        <?php if ($delete_flag == 1 ||  $u_id==1) {  ?>
                        <td><a href="javascript:void(0);" id="status_<?php echo $cmspage->id; ?>" onClick="changeStatus(<?php echo $cmspage->id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm btn-delete"><?php echo !empty($cmspage->status)? 'Delete':'Publish' ?></a></td>
                        <?php } ?>
                        <?php if ($status_flag == 1 ||  $u_id==1) {  ?>
                        <td><a href="javascript:void(0);" id="status1_<?php echo $cmspage->id; ?>" onClick="changeMenuStatus(<?php echo $cmspage->id ?> ,<?php echo $set1; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($cmspage->show_in_menu)? 'Unpublish':'Publish' ?></a></td>
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
/////////////////////////change Menu Status////////////////
function changeMenuStatus(id,status){
//alert(totalCount);
$.post("<?php echo base_url(); ?>administrator/admin/changeMenuStatus",{'id':id ,'status':status,'tablename':'tbl_cms_pages'},function(data){

if(data){
if($('#status1_'+id).text() == 'Unpublish'){
$('#status1_'+id).text('Publish');
$('#status1_'+id).removeClass('text-danger').addClass('text-success');
$('#status1_'+id).attr('onClick', 'changeMenuStatus('+id+',0)');
}else{
$('#status1_'+id).text('Unpublish');
$('#status1_'+id).removeClass('text-success').addClass('text-danger');
$('#status1_'+id).attr('onClick', 'changeMenuStatus('+id+',1)');
}
$('#responseMsg').html('<div class="alert alert-success"><?php echo 'Change Menu status successfully'; ?> </div>').show().fadeOut(5000);

} //success if close here
else{
console.log(data);
}

});
}
/////////////////////////delete menu////////////////
function changeStatus(id,status){
//alert(totalCount);
var RedirectUrl = ""+window.location.href+"";
if (confirm('Do you want to remove this menu?'))
{
$.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_cms_pages'},function(data){

if(data){
if($('#status_'+id).text() == 'Delete'){
$('#status_'+id).text('Publish');
$('#status_'+id).removeClass('text-danger').addClass('text-success');
$('#status_'+id).attr('onClick', 'changeStatus('+id+',0)');
}else{
$('#status_'+id).text('Delete');
$('#status_'+id).removeClass('text-success').addClass('text-danger');
$('#status_'+id).attr('onClick', 'changeStatus('+id+',1)');
}
$('#responseMsg').html('<div class="alert alert-success"><?php echo 'Menu Delete Successfully'; ?> </div>').show().fadeOut(5000);
window.location= RedirectUrl;
} //success if close here
else{
console.log(data);
}

});
}
}
</script>