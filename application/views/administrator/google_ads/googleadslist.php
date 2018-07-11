<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
<div id="responseMsg"></div>           
<div class="page-header"><h3>Google Ads List</h3></div>
<div class="panel panel-default trail-table">
    
    <div id="responseMsg"></div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr><th style="display: none;">s. no</th>
                    <th>Page Name</th>
                    <th>Script Url</th>
                    <th>Client Id</th>
                    <th>Slot Id</th>
                    <?php
                    $flag1=0;
                    $flag2=0;
                    $flag3=0;
                     if (isset($checkpers)) {
                        foreach ($checkpers as $checkper) {    
                            if (($checkper->permission_id == 18) ) { 

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
                if(isset($googleads)){
                    foreach ($googleads as $googleads_item) {  ?>

                    <tr>
                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php echo $googleads_item->pagename; ?></td>
                        <td><?php echo $googleads_item->script_url; ?></td>
                        <td><?php echo $googleads_item->google_ad_client; ?></td>
                        <td><?php echo $googleads_item->slot_id; ?></td>
                        
                        
                     <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 18) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 18) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                               
                            }
                        } ?>
                       <?php if($flag2 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                                <?php if($flag2 == 1){ ?>
                                 <li>
                                    <a class="btn btn-default btn-sm btn-edit" id="'.$googleads_item->script_id.'" href="<?php echo base_url();?>administrator/googleads_edit/<?php echo $googleads_item->script_id; ?>">Edit</a>
                                </li>
                               <?php }  ?>
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                            <ul class="edv-option">
                                <li>
                                    <a class="btn btn-default btn-sm btn-edit" id="'.$googleads_item->script_id.'" href="<?php echo base_url();?>administrator/googleads_edit/<?php echo $googleads_item->script_id; ?>">Edit</a>
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

$(document).ready(function(){

$('.deletetrail').click(function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_google_ads';
           
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