  <?php 
                $i =1;
                if(isset($kmlList)){
                    foreach ($kmlList as $kml) { 
                        if($kml->trail_type_status == 1){
                                $st='Deactivate'; $set=0;
                            }else{
                                $st='Activate'; $set=1;
                            }
                            $words = explode(" ",$kml->description);
                            $content = implode(" ",array_splice($words,0,10));
                        ?>

                    <tr><td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($kml->trail_type_name)){echo $kml->trail_type_name;}?></td>
                        <td><?php if(isset($kml->region_name)){echo $kml->region_name;}?></td>
                        <td><?php if(isset($content)){echo $content;}?></td>
                        <td>
                        <a href="<?php if(isset($kml->trail_kml_path)){echo $kml->trail_kml_path;}?>">
                          <?php 
                             if(isset($kml->trail_kml_path)){
                               $kml_path = str_replace(base_url()."upload/","",$kml->trail_kml_path);
                               $arr = explode("/",$kml_path);
                               echo $arr[1];
                            }?>

                        </a>
                        <!-- <a href="<?php if(isset($kml->trail_kml_path)){ echo base_url().$kml->trail_kml_path;}?>">
                            <?php 
                             if(isset($kml->trail_kml_path)){ echo str_replace("upload/","",$kml->trail_kml_path);
                            }?>
                        </a> --></td> 
                        <td><?php if(isset($kml->trail_type_create_date)){$date = date_create($kml->trail_type_create_date); 
                            echo date_format($date, 'd-M-Y');;}?></td>
                        <td><?php if(isset($kml->trail_kml_upload_by) && !empty($kml->trail_kml_upload_by)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$kml->trail_kml_upload_by."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>

                         <?php
                            $flag=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 2) && ($checkper->status_change_permission==1) ) {
                                        $flag = 1;
                                    }
                                }
                            }
                        if ($flag == 1) {  ?>    
                       <td>
                        <ul class="edv-option"><li ><a href="javascript:void(0);" id="status_<?php echo $kml->trail_type_id; ?>" onClick="changeStatus(<?php echo $kml->trail_type_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm buttonhid"><?php echo !empty($kml->trail_type_status)? 'Unpublish':'Publish' ?></a></li></ul></td>
                        <?php } elseif ($u_id==1) { ?>
                        <td>
                        <ul class="edv-option"><li ><a href="javascript:void(0);" id="status_<?php echo $kml->trail_type_id; ?>" onClick="changeStatus(<?php echo $kml->trail_type_id ?> ,<?php echo $set; ?>);"  class="btn btn-default btn-sm buttonhid"><?php echo !empty($kml->trail_type_status)? 'Unpublish':'Publish' ?></a></li></ul></td>
                        <?php } ?>
                       <?php
                            $flag1=0;
                            if (isset($checkpers)) {
                                foreach ($checkpers as $checkper) {    
                                    if (($checkper->permission_id == 2) && ($checkper->delete_permission==1)) { 
                                        $flag1 = 1;
                                    }
                                }
                            }
                        if ($flag1 == 1) {  ?>  
                        <td> <ul class="edv-option"><li ><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($kml->trail_type_id)){echo $kml->trail_type_id;}?>">Delete</a></li></ul></td>
                        <?php }  elseif ($u_id==1) { ?>
                          <td> <ul class="edv-option"><li ><a class="btn btn-default btn-sm deletekml btn-delete" id="<?php if(isset($kml->trail_type_id)){echo $kml->trail_type_id;}?>">Delete</a></li></ul></td>
                        <?php } ?>
                        
                    </tr>    
               <?php $i++; } } ?>

               <div class="row">
                          <div class="col-sm-12">
                              <div class="text-center paginate">
                                  <?php echo $this->ajax_pagination->create_links(); ?>
                                  <div class="loading" style="display: none;"><div class="content">
                                    <img src="<?php echo base_url().'assets/images/route-loader.svg'; ?>"/>
                                  </div>
                              </div>
                          </div>
                      </div>