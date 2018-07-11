<?php $this->load->view('administrator/include/left_sidebar'); ?>



<div class="warper container-fluid">

  <div id="responseMsg"></div>    
  <div id="msg"></div>           

<div class="page-header"><h3>FAQ List</h3></div>

<div class="panel panel-default POI-table">
    <?php
    $add_flag=0;
    $edit_flag=0;
    $delete_flag=0;
    $status_flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 31) && ($checkper->add_permission==1)) { 
                $add_flag = 1;
            }
            if (($checkper->permission_id == 31) && ($checkper->edit_permission==1)) { 
                $edit_flag = 1;
            }
            if (($checkper->permission_id == 31) && ($checkper->delete_permission==1)) { 
                $delete_flag = 1;
            }
            if (($checkper->permission_id == 31) && ($checkper->status_change_permission==1)) { 
                $status_flag = 1;
            }
        }
    }
if ($add_flag == 1 || $u_id==1) {  ?>
<div class="panel-heading">
    <a href="<?php echo base_url();?>administrator/faq/add" class="btn btn-default btn-sm">Add FAQ</a>
</div>
<?php } ?>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th style="display: none;">s. no</th>
                    <th>Questions</th>
                    <th>Answers</th>
                    <th>Created Date</th>
                    <?php if ($status_flag == 1 || $u_id==1) {  ?>
                    <th>Status</th>
                    <?php } ?>
                    <?php if ($edit_flag == 1 ||  $delete_flag==1 || $u_id==1) {  ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i =1;
                if(isset($faqList)){
                    foreach ($faqList as $cmspage) { 
                        if($cmspage->faq_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$cmspage->faq_ans);
                            $content = implode(" ",array_splice($words,0,10));
                        ?>
                    <tr>
                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($cmspage->faq_que)){echo $cmspage->faq_que;}?></td>
                        <td><?php if(isset($content)){echo $content;}?></td>
                        
                        <td><?php if(isset($cmspage->faq_created_date)){$date = date_create($cmspage->faq_created_date);
                            echo date_format($date, 'd-M-Y');;}?></td>
                       
                       <?php if ($status_flag == 1 || $u_id==1) {  ?>
                        <td><a href="javascript:void(0);" id="status_<?php echo $cmspage->faq_id; ?>" onClick="changeStatus(<?php echo $cmspage->faq_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($cmspage->faq_status)? 'Unpublish':'Publish' ?></a></td>
                        <?php } ?>
                         <?php if ($edit_flag == 1 || $delete_flag == 1 || $u_id==1) {  ?>
                        <td>
                            <ul class="edv-option">
                            <?php if ($edit_flag == 1 || $u_id==1) {  ?>
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/faq/edit/'.$cmspage->faq_id;?>">Edit</a></li>
                            <?php } ?>
                            <?php if ($delete_flag == 1 || $u_id==1) {  ?>
                            <li><a class="btn btn-default btn-sm deleteCmsPage btn-delete" id="<?php echo $cmspage->faq_id; ?>">Delete</a></li>
                            <?php } ?>
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
/////////////////////////delete poi////////////////
$(document).on('click','.deleteCmsPage', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_faq';
if (confirm('Do you want to remove this Question and Answer?'))
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
           return false;
        }else{
           return true;
        }
});

/////////////////////////delete poi////////////////
});
/////////////////////////change poi status////////////////
function changeStatus(id,status){
//alert(totalCount);
$.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_faq'},function(data){
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
      $('#msg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
    } //success if close here
    else{
    console.log(data);    
    }

  }); 
}

</script>