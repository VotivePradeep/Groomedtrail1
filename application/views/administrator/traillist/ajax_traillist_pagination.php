<?php 
                $i =1;
                if(isset($kmlList)){
                    foreach ($kmlList as $poi) { 
                        $name ='';

                       ?>
                    <tr id="dele<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>">
                        <td><input type="checkbox" name="inbox_id[]" class="mail-checkbox mycheckbox" value="<?php if(isset($poi->klm_trail_name) && !empty($poi->klm_trail_name)) {echo $poi->klm_trail_name;} ?>" ></td>
                        <td style="display: none;"><?php if(isset($poi->id)){echo $poi->id;}?></td>
                         <td><?php if(isset($poi->region_name)){echo $poi->region_name;}?></td>
                         <td><a data-toggle="modal" data-target="#trailnameModal<?php if(isset($poi->klm_trail_name)){echo preg_replace('/[^A-Za-z0-9\-]/', '', strip_tags(str_replace(' ', '', str_replace(':', '', $poi->klm_trail_name))));}?>" id="<?php echo $i.'trailname'.$i;?>"><?php if(isset($poi->klm_trail_name)){echo $poi->klm_trail_name;}?></a>
                         <!-- Modal  klm_trail_name-->
                          <div class="modal fade updateTrail" id="trailnameModal<?php if(isset($poi->klm_trail_name)){echo preg_replace('/[^A-Za-z0-9\-]/', '', strip_tags(str_replace(' ', '', str_replace(':', '', $poi->klm_trail_name))));}?>" role="dialog" >
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Update Trail Detail</h4>
                                </div>
                                <div class="modal-body">
                                <div id="respMsgtrail"></div>
                                <label>Trail Name</label>
                               
                                <p><input type="text" class="klm_trail_name" name="klm_trail_name" id="trail_name<?php echo $i;?>" value="<?php if(isset($poi->klm_trail_name)){echo strip_tags($poi->klm_trail_name);}?>"></p>
                                <label>Trail Description</label>
                                <p><textarea id="trailDesc<?php echo $i;?>" class="trailDesc" name="trailDesc" cols="35" row="40"> 

                                 <?php /*if(isset($poi->status) && $poi->status == 1){
                            echo $poi->trail_description;
                            }else{*/
                                if(isset($poi->trail_dscrptn)){ echo $poi->trail_dscrptn; }
                            //}?>
                                </textarea></p>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="trailDetailBtn" onClick="trailDetailEdit(<?php echo $i ?>, '<?php if(isset($poi->klm_trail_name)){echo $poi->klm_trail_name;}?>');">Update</button>
                                </div>
                               
                              </div>
                            </div>
                          </div>
                           <!-- Modal  klm_trail_name--></td>

                         
                        <td><p class="trailDescriptionCls" id="<?php echo $i.'trailDesc'.$i;?>" >
                            <?php /*if(isset($poi->status) && $poi->status == 1){
                            echo $poi->trail_description;
                            }else{*/
                                if(isset($poi->trail_dscrptn)){ echo $poi->trail_dscrptn; }
                            //}?>
                          
                        </p>
                      </td>
                        <td>
                        <?php 
                        if(isset($poi->previous_trail_status)){
                            if($poi->previous_trail_status == 0){ 
                                echo '<span class="OpenCls open0 OpenStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Open</span>';
                            }else if($poi->previous_trail_status == 1){
                               echo '<span class="ClosedCls close1 ClosedStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Closed</span>'; 
                            }else if($poi->previous_trail_status == 2){
                                echo '<span class="CautionCls caution2 CautionStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Caution</span>';
                            }
                        } ?>
                        </td>
                        <td>
                        <?php if($poi->trail_name == $poi->klm_trail_name){
                            if($poi->status == 0){ ?>
                            <button data-toggle="modal" class="adminReviewCls" data-target="#myModal<?php if(isset($poi->klm_trail_name)){echo strip_tags(str_replace(' ', '', str_replace(':', '', $poi->klm_trail_name)));}?>">Review Change</button>
                           <!-- Modal -->
                          <div class="modal fade" id="myModal<?php if(isset($poi->klm_trail_name)){echo strip_tags(str_replace(' ', '', str_replace(':', '', $poi->klm_trail_name)));}?>" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Review Change</h4>
                                </div>
                                <div class="modal-body">
                                <div id="respMsg"></div>
                                <?php if(isset($poi->trail_description)){echo $poi->trail_description;}?>
                                <hr/>
                              <p><b>previous status : </b><?php if($poi->previous_trail_status == 0){ 
                                    echo '<span class="OpenCls open0 OpenStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Open</span>';
                                }else if($poi->previous_trail_status == 1){
                                   echo '<span class="ClosedCls close1 ClosedStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Closed</span>'; 
                                }else if($poi->previous_trail_status == 2){
                                    echo '<span class="CautionCls caution2 CautionStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Caution</span>';
                                } ?></p>
                              <p><b>New status : </b><?php if($poi->trail_status == 0){ 
                                        echo '<span class="OpenCls open0 OpenStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Open</span>';
                                    }else if($poi->trail_status == 1){
                                       echo '<span class="ClosedCls close1 ClosedStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'">Closed</span>'; 
                                    }else if($poi->trail_status == 2){
                                        echo '<span class="CautionCls caution2 CautionStatus'.$poi->klm_trail_name.' commencls" id="commenID'.$poi->klm_trail_name.'" >Caution</span>';
                                    } ?></p>
                                </div>
                                <div class="modal-footer">
<button class="approveCls"  onclick="changestatus2(1,'tbl_trail_report','status','trail_report_id','<?php if(isset($poi->trail_report_id)){echo $poi->trail_report_id;}?>',0,'tbl_kml_data_trail','flag','klm_trail_name','<?php if(isset($poi->klm_trail_name)){echo $poi->klm_trail_name;}?>','<?php echo $poi->trail_status; ?>','previous_trail_status');">Approve</button>

<button class="rejectCls" onclick="changestatus1(2,'tbl_trail_report','status','trail_report_id','<?php if(isset($poi->trail_report_id)){echo $poi->trail_report_id;}?>',1,'tbl_kml_data_trail','flag','klm_trail_name','<?php if(isset($poi->klm_trail_name)){echo $poi->klm_trail_name;}?>');">Reject</button>

                                </div>
                              </div>
                            </div>
                          </div>
                           <!-- Modal -->

                         <?php }else{ ?>
                        <select id="update_status" name="update_status" onchange="changestatus('tbl_kml_data_trail','previous_trail_status','klm_trail_name','<?php if(isset($poi->klm_trail_name)){ echo $poi->klm_trail_name; }?>',this.value)" >
                            <option value="">Update Status</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                            <option value="2">Caution</option>
                        </select>
                        <a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->klm_trail_name)){ echo $poi->klm_trail_name; }?>">Delete</a>
                        <?php  } }else{ ?>
                        <select id="update_status" name="update_status"  onchange="changestatus('tbl_kml_data_trail','previous_trail_status','klm_trail_name','<?php if(isset($poi->klm_trail_name)){ echo $poi->klm_trail_name; }?>',this.value)" >
                            <option value="">Update Status</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                            <option value="2">Caution</option>
                        </select>
                        <a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($poi->klm_trail_name)){ echo $poi->klm_trail_name; }?>">Delete</a>
                        <?php } ?>
                        </td>
                    </tr>  

            
               <?php $i++; } }

echo "*****";
echo $this->ajax_pagination->create_links();


               ?>
