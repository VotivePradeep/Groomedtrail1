<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
    <div id="msg"></div>   
    <div id="responseMsg"></div>         
<div class="page-header"><h3>Classifieds List</h3></div>
<div class="panel panel-default POI-table">
    <?php $this->load->view('administrator/classifieds/classified_status_list'); ?>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                   <th style="display: none;">id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Expired Date</th>
                    <th>Last Modifier</th>
                    <th>Last Modify Date</th>
                    <!--<th>Sort Order</th>-->
                    <?php
                        $flag=0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 11) && ($checkper->status_change_permission==1)) { 
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
                            if (($checkper->permission_id == 11) && ($checkper->delete_permission==1) || ($checkper->edit_permission==1) || ($checkper->view_permission==1)) { 
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
                if(isset($classifiedList)){
                    foreach ($classifiedList as $classified) { 
                if($classified->classified_expired > date('Y-m-d') || $classified->classified_expired == ''){ 

                         if($classified->classified_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                        

                      //if($basesegment == 'classifiedslist'){ 
                        if(isset($classified->classified_image) && !empty($classified->classified_image)){ 

                            $img = base_url().$classified->classified_image;                       

                        } else { 
                          $img =  base_url().'assets/images/default.png';
                        }
                        $words = explode(" ",$classified->classified_description);
                        $content = implode(" ",array_splice($words,0,10));
                        ?>
                                    
                    <tr><td style="display: none;"><?php if(isset($classified->classified_id)){echo $classified->classified_id;}?></td>
                        <td><?php if(isset($classified->classified_created_by)){echo $classified->classified_created_by;}?></td>
                        <td><?php if(isset($classified->classified_type)){echo $classified->classified_type;}?></td>
                        <td><?php echo $content; ?></td>
                        <td><?php if(isset($classified->classified_create_date)){
                          $date = date_create($classified->classified_create_date); 
                        echo date_format($date, 'd-M-Y');
                        }?></td>
                        <td><?php if(isset($classified->classified_expired) && !empty($classified->classified_expired) ){$date = date_create($classified->classified_expired); 
                        echo date_format($date, 'd-M-Y');}?></td>
                       <td><?php if(isset($classified->last_modify_user_id) && !empty($classified->last_modify_user_id))
                       {
                            $query = $this->db->query("SELECT fname,lname, user_id from tbl_user_master where user_id=".$classified->last_modify_user_id."");
                            $result = $query->result();
                            echo $result[0]->fname.' '.$result[0]->lname;
                            
                       }else{
                        $query = $this->db->query("SELECT fname,lname, user_id from tbl_user_master where user_id=".$classified->user_ID."");
                            $result = $query->result();
                            echo $result[0]->fname.' '.$result[0]->lname;

                       }?></td>
                        <td><?php if(isset($classified->last_modify_date) && $classified->last_modify_date !='0000-00-00'){$date = date_create($classified->last_modify_date); 
                            echo date_format($date, 'd-M-Y');}else{
                              if(isset($classified->classified_create_date)){
                                $date = date_create($classified->classified_create_date); 
                                echo date_format($date, 'd-M-Y');
                              }
                       }?></td>
                         <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 11) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>  
                        <td>

                        <a href="javascript:void(0);" id="status_<?php echo $classified->classified_id; ?>"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>">
                          <?php if($classified->classified_status == 0){
                                      echo 'Publish';
                                    }else if($classified->classified_status == 1){
                                      echo 'Unpublish';
                                    }else if($classified->classified_status == 2){
                                      echo 'Rejected';
                                    }?></a>

                           <!-- Modal -->
                          <div id="myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Change Classified Status 
                                    </h4>
                                </div>
                                <form name="publishFrm" id="publishFrm">
                                  <div class="modal-body">
                                     <div id="responseMsg"></div>
                          
                                    <p class="vac_msg">
                                      <select name="statusChange" id="statusChange_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" class="change-status-ad">
                                        <option value="">Select a Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                      </select>
                                    </p>
                                    <p class="vac_msg">
                                      <span>Message</span>
                                      <textarea name="vac_message" id="vacmessage_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" placeholder="Please enter Message"></textarea></p>
                                      <input type="hidden" name="id" id="id_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" placeholder="Please enter Message" value="<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" />
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit"  id="status11_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" class="btn btn-default rent_sub">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                              </div>

                            </div>
                          </div>
                           <!-- Modal -->

                        </td>
                        <?php } elseif ($u_id==1) { ?>
                         <td>

                        <a href="javascript:void(0);" id="status_<?php echo $classified->classified_id; ?>"  class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>">
                          <?php if($classified->classified_status == 0){
                                      echo 'Publish';
                                    }else if($classified->classified_status == 1){
                                      echo 'Unpublish';
                                    }else if($classified->classified_status == 2){
                                      echo 'Rejected';
                                    }?></a>

                           <!-- Modal -->
                          <div id="myModal<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" class="publish_rental modal fade" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">
                                     Change Classified Status 
                                    </h4>
                                </div>
                                <form name="publishFrm" id="publishFrm">
                                  <div class="modal-body">
                                     <div id="responseMsg"></div>
                          
                                    <p class="vac_msg">
                                      <select name="statusChange" id="statusChange_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" class="change-status-ad">
                                        <option value="">Select a Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                      </select>
                                    </p>
                                    <p class="vac_msg">
                                      <span>Message</span>
                                      <textarea name="vac_message" id="vacmessage_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" placeholder="Please enter Message"></textarea></p>
                                      <input type="hidden" name="id" id="id_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" placeholder="Please enter Message" value="<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" />
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit"  id="status11_<?php if(isset($classified->classified_id)){echo $classified->classified_id; }?>" class="btn btn-default rent_sub">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                               </form>
                              </div>

                            </div>
                          </div>
                           <!-- Modal -->

                        </td>

                        <?php } ?>
                        <?php
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        if (isset($checkpers)) {
                            foreach ($checkpers as $checkper) {    
                                if (($checkper->permission_id == 11) && ($checkper->delete_permission==1)) {
                                    $flag1 = 1;
                                }
                                 if (($checkper->permission_id == 11) && ($checkper->edit_permission==1)) {
                                    $flag2 = 1;
                                }
                                if (($checkper->permission_id ==11) && ($checkper->view_permission==1)) {
                                    $flag3 = 1;
                                }
                            }
                        } ?>
                       <?php if($flag1 == 1 || $flag2 == 1 || $flag3 == 1){ ?>
                       <td>
                          <ul class="edv-option">
                            <?php 
                            if ($flag3 == 1) { ?>
                             <li><a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php if(isset($classified->classified_id)){echo base_url().'administrator/classifieds/classifiedsview/'.$classified->classified_id;}?>">View</a></li>
                             <?php } ?>
                             <?php if($flag2 == 1){ ?>
                            <li><a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php if(isset($classified->classified_id)){echo base_url().'administrator/classifieds/editclassifiedpage/'.$classified->classified_id;}?>">Edit</a></li>
                            <?php } ?>
                            <?php if($flag1 == 1){ ?>
                           <li><a class="btn btn-default btn-sm deletclassified btn-delete" id="<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" classimg="<?php if(isset($classified->classified_image)){echo $classified->classified_image;}?>" onClick="deletefuncClas(<?php if(isset($classified->classified_id)){echo $classified->classified_id;} ?>, 'tbl_classified_list', 'Do you want to remove this classified?')" >Delete</a></li>
                           <?php }  ?>
                         </ul>
                       
                        </td>
                        <?php }elseif ($u_id==1) { ?>
                        <td>
                          <ul class="edv-option">
                            <li><a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php if(isset($classified->classified_id)){echo base_url().'administrator/classifieds/editclassifiedpage/'.$classified->classified_id;}?>">Edit</a></li>

                            <li><a class="btn btn-default btn-sm btn-edit" id="'.$classified->classified_id.'" href="<?php if(isset($classified->classified_id)){echo base_url().'administrator/classifieds/classifiedsview/'.$classified->classified_id;}?>">View</a></li>

                           <li><a class="btn btn-default btn-sm deletclassified btn-delete" id="<?php if(isset($classified->classified_id)){echo $classified->classified_id;}?>" classimg="<?php if(isset($classified->classified_image)){echo $classified->classified_image;}?>" onClick="deletefuncClas(<?php if(isset($classified->classified_id)){echo $classified->classified_id;} ?>, 'tbl_classified_list', 'Do you want to remove this classified?')" >Delete</a></li>
                         </ul>
                       
                        </td>
                        <?php } ?>
                    </tr>    
               <?php $i++; } } } //} ?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
 $(document).ready(function() { 
    $('#toggleColumn-datatable').DataTable({ 
        "order": [[ 0, "desc" ]] 
    }); 
});

function deletefuncClas(del_id, tablename, message){

if (confirm(message))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>administrator/classifieds/delete_cat',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             $('#responseMsg').html('<div class="alert alert-success">Delete record successfully</div>').show().fadeOut(5000);                          
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }
    
}

$(".rent_sub").click(function() {
  var contentPanelId = $(this).attr("id");
  var arr = contentPanelId.split('_');
  var id = arr[1];
  var vac_message=$('#vacmessage_'+arr[1]).val();
  var tablename = 'tbl_classified_list';
  var statusChange=$('#statusChange_'+arr[1]).val();
  $.ajax({
      type: "POST",
      url: '<?php echo  base_url().'administrator/admin/changeStatus'; ?>',
      data: {id:id, status:status, vac_message:vac_message, tablename:tablename,statusChange:statusChange}, // serializes the form's elements.
      dataType: "JSON",
      success: function(data)
      {
       //location.reload(); 
        $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Change Status Successfully </div>').show().fadeOut(5000);
        $('#publishFrm')[0].reset();
       // $('#myModal'+id).fadeOut(2000,function(){
           $('#myModal'+id).modal('hide');
            location.reload();
       // });
      }
    });
});



</script>