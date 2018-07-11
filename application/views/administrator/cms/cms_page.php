<?php $this->load->view('administrator/include/left_sidebar'); ?>



<div class="warper container-fluid">

  <div id="responseMsg"></div>           

<div class="page-header"><h3>Page List</h3></div>

<div class="panel panel-default POI-table">

<?php
    $add_flag=0;
    $edit_flag=0;
    $view_flag=0;
    $delete_flag=0;
    $status_flag=0;
    if (isset($checkpers)) {
        foreach ($checkpers as $checkper) {    
            if (($checkper->permission_id == 29) && ($checkper->add_permission==1)) { 
                $add_flag = 1;
            }
            if (($checkper->permission_id == 29) && ($checkper->edit_permission==1)) { 
                $edit_flag = 1;
            }
            if (($checkper->permission_id == 29) && ($checkper->view_permission==1)) { 
                $view_flag = 1;
            }
             if (($checkper->permission_id == 29) && ($checkper->delete_permission==1)) { 
                $delete_flag = 1;
            }
            if (($checkper->permission_id == 29) && ($checkper->status_change_permission==1)) { 
                $status_flag = 1;
            }
        }
    }
if ($add_flag == 1 || $u_id==1) {  ?>
    <div class="panel-heading">
        <a href="<?php echo base_url();?>administrator/cmspage/addcmspage" class="btn btn-default btn-sm">Add Page</a>
    </div>
<?php } ?>


    <div class="panel-body">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">

            <thead>

                <tr>

                    <th style="display: none;">s. no</th>
                    <th>Menu Title</th>
                    <th>Page Title</th>
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

                if(isset($cmsPageList)){

                    foreach ($cmsPageList as $cmspage) { 

                        if($cmspage->status == 1){

                                $st='Deactivate'; $set=0;

                            }else{

                                $st='Activate'; $set=1;

                            }

                        ?>



                    <tr>

                        <td style="display: none;"><?php echo $i; ?></td>
                       <td><?php if(isset($cmspage->menu_name)){echo $cmspage->menu_name;}?></td>
                        <td><?php if(isset($cmspage->page_name)){echo $cmspage->page_name;}?></td>

                        <td><?php if(isset($cmspage->mata_author)){echo $cmspage->mata_author;}?></td>

                        <td><?php if(isset($cmspage->mata_keywords)){echo $cmspage->mata_keywords;}?></td>

                        <td><?php if(isset($cmspage->mata_description)){echo $cmspage->mata_description;}?></td>

                        <td><?php if(isset($cmspage->mata_viewport)){echo $cmspage->mata_viewport;}?></td>

                        <td><?php if(isset($cmspage->crated_date)){$date = date_create($cmspage->crated_date); 

                            echo date_format($date, 'd-M-Y');;}?></td>
                       <?php if ($status_flag == 1 || $u_id==1) {  ?>
                            <td><a href="javascript:void(0);" id="status_<?php echo $cmspage->id; ?>" onClick="changeStatus(<?php echo $cmspage->id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm"><?php echo !empty($cmspage->status)? 'Unpublish':'Publish' ?></a></td>
                        <?php } 
                         $flag1=0;
                        $flag2=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 29) && ($checkper->edit_permission==1)) { 
                                    $flag1 = 1;
                                }
                                if (($checkper->permission_id == 29) && ($checkper->delete_permission==1)) {
                                    $flag2 = 1;
                                }
                            }
                        } 
                        if($flag1 == 1 || $flag2 == 1 || $u_id == 1 ){
                        ?>
                        <td>
                            <ul class="edv-option">
                        <?php
                       
                        if($cmspage->id != 12 && $cmspage->id != 13) {
                        if ($flag1 == 1) { ?>  
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/cmspage/editcmspage/'.$cmspage->id;?>">Edit</a></li>
                        <?php } elseif ($u_id==1) {
                            echo '<li><a class="btn btn-default btn-sm btn-edit" href="'.base_url().'administrator/cmspage/editcmspage/'.$cmspage->id.'">Edit</a></li>';
                        }
                       } else{ 
                        if ($flag1 == 1) { ?> 

                            <li>
                               <?php  if($cmspage->id == 12){ ?>
                                <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/contact';?>"> Edit </a>
                                <?php }else if($cmspage->id == 13){ ?>
                              
                                <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/faq';?>">Edit</a>
                                <?php } else { ?>
                                 <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/cmspage/editcmspage/'.$cmspage->id;?>">Edit</a>
                                <?php } ?>
                            </li>
                        <?php } elseif ($u_id==1) { ?>
                        <li>
                             <?php  if($cmspage->id == 12){ ?>
                                <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/contact';?>"> Edit </a>
                                <?php }else if($cmspage->id == 13){ ?>
                              
                                <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/faq';?>">Edit</a>
                                <?php } else { ?>
                                 <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url().'administrator/cmspage/editcmspage/'.$cmspage->id;?>">Edit</a>
                                <?php } ?>
                        </li>
                        <?php   }

                        }  
                        if($cmspage->id != 12 && $cmspage->id != 13) {
                        if ($flag2 == 1) { 
                           ?>  
                            <li><a class="btn btn-default btn-sm deleteCmsPage btn-delete" id="<?php echo $cmspage->id; ?>">Delete</a></li>
                        <?php } elseif ($u_id==1) {
                            echo '<li><a class="btn btn-default btn-sm deleteCmsPage btn-delete" id="'.$cmspage->id.'">Delete</a></li>';
                            }
                        }?> 
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



/////////////////////////delete poi////////////////
$(document).on('click','.deleteCmsPage', function(){

 var del_id= $(this).attr('id');

 var tablename= 'tbl_cms_pages';

           

if (confirm('Do you want to remove this page?'))

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





/////////////////////////delete poi////////////////







});



/////////////////////////change poi status////////////////

function changeStatus(id,status){

//alert(totalCount);

  

   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_cms_pages'},function(data){

    

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