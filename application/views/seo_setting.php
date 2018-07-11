<?php $this->load->view('administrator/include/left_sidebar'); ?>



<div class="warper container-fluid">

  <div id="responseMsg"></div>           

<div class="page-header"><h3>SEO settings</h3></div>

<div class="panel panel-default POI-table">

<?php
    $add_flag=0;
    $edit_flag=0;
    $view_flag=0;
    $delete_flag=0;
    $status_flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 33) && ($checkper->add_permission==1)) { 
                $add_flag = 1;
            }
            if (($checkper->permission_id == 33) && ($checkper->edit_permission==1)) { 
                $edit_flag = 1;
            }
            if (($checkper->permission_id == 33) && ($checkper->view_permission==1)) { 
                $view_flag = 1;
            }
             if (($checkper->permission_id == 33) && ($checkper->delete_permission==1)) { 
                $delete_flag = 1;
            }
            if (($checkper->permission_id == 33) && ($checkper->status_change_permission==1)) { 
                $status_flag = 1;
            }
        }
    }
if ($add_flag == 1 || $u_id==1) {  ?>
    <div class="panel-heading">
        <a href="<?php echo base_url();?>administrator/seo_setting/add" class="btn btn-default btn-sm">Add SEO</a>

         <a href="<?php echo base_url(); ?>administrator/site_map" class="btn btn-default btn-sm">Generate Sitemap</a>
    </div>
<?php } ?>


    <div class="panel-body">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">

            <thead>

                <tr>

                    <th style="display: none;">s. no</th>
                    <th>Page Name</th>
                    <th>Meta Title</th>
                    <th>Meta Author</th>
                    <th>Meta Keywords</th>
                    <th>Meta Description</th>
                    <th>Meta Viewport</th>
                    <th>Created Date</th>
                    <?php if ($status_flag == 1 || $u_id==1) {  ?>
                    <th>Status</th>
                    <?php } ?>
                    <?php if ($edit_flag == 1 || $view_flag==1 || $delete_flag==1 || $u_id==1) {  ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>

            </thead>
            <tbody>
                <?php 

                $i =1;

                if(isset($seoSettingList)){

                    foreach ($seoSettingList as $cmspage) { 

                        if($cmspage->meta_status == 1){

                                $st='Deactivate'; $set=0;

                            }else{

                                $st='Activate'; $set=1;

                            }

                        ?>



                    <tr>

                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($cmspage->page_name)){echo $cmspage->page_name;}?></td>
                        <td><?php if(isset($cmspage->meta_title)){echo $cmspage->meta_title;}?></td>
                        <td><?php if(isset($cmspage->meta_author)){echo $cmspage->meta_author;}?></td>
                        <td><?php if(isset($cmspage->meta_keyword)){echo $cmspage->meta_keyword;}?></td>
                        <td><?php if(isset($cmspage->meta_viewport)){echo $cmspage->meta_viewport;}?></td>
                        <td><?php if(isset($cmspage->meta_description)){echo $cmspage->meta_description;}?></td>
                        <td><?php if(isset($cmspage->date)){$date = date_create($cmspage->date); 
                            echo date_format($date, 'd-M-Y');;}?></td>
                        <?php if ($status_flag == 1 || $u_id==1) {  ?>
                        <td><a href="javascript:void(0);" id="status_<?php echo $cmspage->meta_id; ?>" onClick="changeStatus(<?php echo $cmspage->meta_id; ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($cmspage->meta_status)? 'Unpublish':'Publish' ?></a></td>
                        <?php } 
                        $flag1=0;
                        $flag2=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 33) && ($checkper->edit_permission==1)) { 
                                    $flag1 = 1;
                                }
                                if (($checkper->permission_id == 33) && ($checkper->delete_permission==1)) {
                                    $flag2 = 1;
                                }
                            }
                        } 
                        if($flag1 == 1 || $flag2 == 1 || $u_id == 1 ){
                        ?>
                        <td>
                            <ul class="edv-option">
                        <?php
                       
                        if ($flag1 == 1) { ?> 

                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/seo_setting/edit/'.$cmspage->meta_id;?>">Edit</a></li>
                            <li><a class="btn btn-default btn-sm deletenews btn-delete" id="<?php echo $news->meta_id; ?>" href="">Delete</a></li>
                        <?php } elseif ($u_id==1) { ?>
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/seo_setting/edit/'.$cmspage->meta_id;?>">Edit</a></li>
                            <li><a class="btn btn-default btn-sm deletenews btn-delete" id="<?php echo $cmspage->meta_id; ?>" href="">Delete</a></li>
                        <?php   }

                          
                        ?> 
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#toggleColumn-datatable').DataTable( {
      "order": [[ 0, "ASC" ]]
    } );
} );

$(document).ready(function(){
$(document).on('click','.deletenews', function(){
 var del_id= $(this).attr('id');
 var tablename= 'seo_setting';
           
if (confirm('Do you want to remove this?'))
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


/////////////////////////delete route////////////////

});



/////////////////////////change poi status////////////////

function changeStatus(id,status){

//alert(totalCount);

  

   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'seo_setting'},function(data){

    

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

      $('#responseMsg').html('<div class="alert alert-success">Status change successfully</div>').show().fadeOut(5000);



     

    } //success if close here

    else{

    console.log(data);    

    }

       

  }); 

}

</script>