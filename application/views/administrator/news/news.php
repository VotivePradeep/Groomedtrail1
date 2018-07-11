<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
 <div id="responseMsg"></div>             
<div class="page-header"><h3>News List</h3></div>
<div class="panel panel-default route-table">

    <?php
        $flag=0;
        if (isset($checkpers)) {
            foreach ($checkpers as $checkper) {    
                if (($checkper->permission_id == 7) && ($checkper->add_permission==1)) { 
                    $flag = 1;
                }
            }
        }
    if ($flag == 1) {  ?>
        <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/news/addnews" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add News</a></li>
        </ul>  
    </div>
    <?php  
    } elseif ($u_id==1) {
    ?>
        <div class="panel-heading">
        <ul class="cls-status-list">
             <li><a href="<?php echo base_url();?>administrator/news/addnews" class="btn btn-default btn-sm" style="background-color: #000;color: #fff">Add News</a></li>
        </ul>  
    </div>
    <?php } ?>

    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th>News Title</th>
                    <th>New Created By</th>
                    <th>Created Date</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 7) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 7) ) { 

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
                if(isset($newList)){
                    foreach ($newList as $news) { 
                        if($news->news_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$news->news_description);
                            $content = implode(" ",array_splice($words,0,10));
                        ?>

                    <tr>
                        <td><?php if(isset($news->news_title)){echo $news->news_title;}?></td>
                        <td><?php if(isset($news->news_created_by)){
                            if($news->news_created_by =='admin'){
                                echo 'Admin';
                            }else if($news->news_created_by =='sub admin'){
                                echo 'Sub Admin';
                            }else{
                                if(isset($news->fname) || isset($news->lname)){
                                    echo $news->fname.' '.$news->lname;
                                }else{
                                    echo $news->username;
                                }
                            }
                        }?></td>
                        <td><?php if(isset($news->news_created_date)){$date = date_create($news->news_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                        
                        <td><?php if(isset($news->last_modify_user_id) && !empty($news->last_modify_user_id)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$news->last_modify_user_id."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>
                        <td><?php if(isset($news->last_modify_date) && $news->last_modify_date !='0000-00-00'){$date = date_create($news->last_modify_date); 
                        echo date_format($date, 'd-M-Y');}?></td>
                                
                              
                        <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 7) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>  
                           <td><a href="javascript:void(0);" id="status_<?php echo $news->news_id; ?>" onClick="changeStatus(<?php echo $news->news_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm" style="background-color: #387fcc"><?php echo !empty($news->news_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } elseif ($u_id==1) { ?>
                          <td><a href="javascript:void(0);" id="status_<?php echo $news->news_id; ?>" onClick="changeStatus(<?php echo $news->news_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm" style="background-color: #387fcc"><?php echo !empty($news->news_status)? 'Unpublish':'Publish' ?></a></td>
                     <?php } ?>

                     <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 7) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 7) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                if (($checkper->permission_id == 7) && ($checkper->view_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 == 1){ ?>
                        <td>
                            <ul class="edv-option">
                            <?php 
                            if ($flag3 == 1) { ?>
                            <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/news/viewnews/<?php echo $news->news_id; ?>">View</a></li>
                           <?php }?>
                            <?php if($flag2 == 1){ ?>
                             <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/news/editnews/<?php echo $news->news_id; ?>">Edit</a></li>
                           <?php }  ?>
                            <?php if($flag1 == 1){ ?>
                             <li><a class="btn btn-default btn-sm deletenews btn-delete" id="<?php echo $news->news_id; ?>" href="">Delete</a></li>
                           <?php }  ?>
                           
                            </ul>
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                         <td>
                            <ul class="edv-option">
                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/news/editnews/<?php echo $news->news_id; ?>">Edit</a></li>

                                <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/news/viewnews/<?php echo $news->news_id; ?>">View</a></li>

                                <li><a class="btn btn-default btn-sm deletenews btn-delete" id="<?php echo $news->news_id; ?>" href="">Delete</a></li>
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
$(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 2, "desc" ]] 
    }); 
});
$(document).ready(function(){
$(document).on('click','.deletenews', function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_news';
           
if (confirm('Do you want to remove this news?'))
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

/////////////////////////change route status////////////////
function changeStatus(id,status){
//alert(totalCount);
  
   $.post("<?php echo base_url(); ?>administrator/admin/changeStatus",{'id':id ,'status':status,'tablename':'tbl_news'},function(data){
    
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