 <?php  if(isset($ViewPendingUpdates)){
                    foreach ($ViewPendingUpdates as $PendingUpdates) { 
                       ?>
                    <tr class="dele<?php if(isset($PendingUpdates->klm_trail_name)){echo $PendingUpdates->klm_trail_name;}?>"><td ><input type="checkbox" name="checkTrail" id="checkTrail"></td>
                        <td>Trail</td>
                        <td><?php if(isset($PendingUpdates->klm_trail_name)){echo $PendingUpdates->klm_trail_name;}?></td>
                       
                        <td><p class="trailDescriptionCls" id="trailDescriptionId">
                        <?php if(isset($PendingUpdates->status) && $PendingUpdates->status == 1){
                                echo $PendingUpdates->trail_description;
                                }else{
                                if(isset($PendingUpdates->trail_dscrptn)){ echo $PendingUpdates->trail_dscrptn; }
                                }?>
                      
                        <td>
                        <?php if($PendingUpdates->trail_name == $PendingUpdates->klm_trail_name){
                                if($PendingUpdates->status == 0){
                                    echo '<span class="pendingApprovalCls" >Pending Approval</span>';
                                }
                            } ?>
                        
                        </td>
                        <td>
                        <?php if($PendingUpdates->trail_name == $PendingUpdates->klm_trail_name){
                            if($PendingUpdates->status == 0){
                              echo  '<button data-toggle="modal" class="adminReviewCls" data-target="#myModal'.$PendingUpdates->trail_report_id.'">Review Change</button>'; ?>
                              <a class="btn btn-default btn-sm deletetrailreport btn-delete" id="<?php if(isset($PendingUpdates->trail_report_id)){echo $PendingUpdates->trail_report_id;}?>">Delete</a>
                           <!-- Modal -->
                          <div class="modal fade" id="myModal<?php if(isset($PendingUpdates->trail_report_id)){echo $PendingUpdates->trail_report_id;}?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Review Change</h4>
                                </div>
                                <div class="modal-body">
                                <div id="respMsg"></div>
                                <?php if(isset($PendingUpdates->trail_description)){echo $PendingUpdates->trail_description;}?>
                                <hr/>
                              <p><b>previous status : </b><?php if($PendingUpdates->previous_trail_status == 0){ 
                                    echo '<span class="OpenCls OpenStatus'.$PendingUpdates->klm_trail_name.' commencls" >Open</span>';
                                }else if($PendingUpdates->previous_trail_status == 1){
                                   echo '<span class="ClosedCls ClosedStatus'.$PendingUpdates->klm_trail_name.' commencls" >Closed</span>'; 
                                }else if($PendingUpdates->previous_trail_status == 2){
                                    echo '<span class="CautionCls CautionStatus'.$PendingUpdates->klm_trail_name.' commencls" >Caution</span>';
                                } ?></p>
                              <p><b>New status : </b><?php if($PendingUpdates->trail_status == 0){ 
                                        echo '<span class="OpenCls OpenStatus'.$PendingUpdates->klm_trail_name.' commencls" >Open</span>';
                                    }else if($PendingUpdates->trail_status == 1){
                                       echo '<span class="ClosedCls ClosedStatus'.$PendingUpdates->klm_trail_name.' commencls" >Closed</span>'; 
                                    }else if($PendingUpdates->trail_status == 2){
                                        echo '<span class="CautionCls CautionStatus'.$PendingUpdates->klm_trail_name.' commencls" >Caution</span>';
                                    } ?></p>
                                </div>
                                <div class="modal-footer">

<button class="approveCls"  onclick='changestatus2(1,"tbl_trail_report","status","trail_report_id","<?php if(isset($PendingUpdates->trail_report_id)){echo $PendingUpdates->trail_report_id;}?>",0,"tbl_kml_data_trail","flag","klm_trail_name","<?php if(isset($PendingUpdates->klm_trail_name)){echo $PendingUpdates->klm_trail_name;}?>","<?php echo $PendingUpdates->trail_status; ?>","previous_trail_status");'>Approve</button>

<button class="rejectCls" onclick='changestatus1(2,"tbl_trail_report","status","trail_report_id","<?php if(isset($PendingUpdates->trail_report_id)){echo $PendingUpdates->trail_report_id;}?>",1,"tbl_kml_data_trail","flag","klm_trail_name","<?php if(isset($PendingUpdates->klm_trail_name)){echo $PendingUpdates->klm_trail_name;}?>");'>Reject</button>
                                </div>
                              </div>
                            </div>
                          </div>
                           <!-- Modal -->

                         <?php }else{ ?>
                        <select id="update_status" name="update_status" onchange="changestatus('tbl_kml_data_trail','previous_trail_status','klm_trail_name','<?php if(isset($PendingUpdates->klm_trail_name)){ echo $PendingUpdates->klm_trail_name; }?>',this.value)" >
                            <option value="">Update Status</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                            <option value="2">Caution</option>
                        </select>
                        <?php  } }else{ ?>
                        <select id="update_status" name="update_status"  onchange="changestatus('tbl_kml_data_trail','previous_trail_status','klm_trail_name','<?php if(isset($PendingUpdates->klm_trail_name)){ echo $PendingUpdates->klm_trail_name; }?>', this.value)" >
                            <option value="">Update Status</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                            <option value="2">Caution</option>
                        </select>
                        <?php } ?>
                        </td>
                    </tr>   
            
               <?php  } }
echo "*****";
echo $this->ajax_pagination->create_links();


               ?>