
        <div class="table-responsive">
          <table id="dataTable1" class="table table-bordered table-striped-col">
            <thead>
                <tr>
                    <th><input type="checkbox" class="mail-checkbox mail-group-checkbox" id="select_all"> </th>               
                    <th>Name</th>                    
                    <th>Email</th>                    
                    <th>Message</th>
                    <th>Date</th>

                </tr>
            </thead>
            <tbody>
        <?php  
        if(isset($enquiry)){
                  foreach($enquiry as $enquiryrow) { 
                ?>
                    <tr>
                   
                    <td> <input type="checkbox" name="inbox_id[]" class="mail-checkbox mycheckbox" value="<?php if(isset($enquiryrow->id) && !empty($enquiryrow->id)) {echo $enquiryrow->id;} ?>" > </td>                 
                    <td><?php if(!empty($enquiryrow->name)){echo $enquiryrow->name;}else{echo '-';}?></td>
                    <td><?php if(!empty($enquiryrow->email)){echo $enquiryrow->email;}else{echo '-';}?></td>                   
                    <td><?php if(!empty($enquiryrow->message)){ echo chunk_split($enquiryrow->message, 30, "\n\r"); }else{echo '-';}?></td>
                    <td><?php if(!empty($enquiryrow->created_date)){echo $enquiryrow->created_date;}else{echo '-';}?></td>
                    </tr>
                <?php }
        }?>
            </tbody>
          </table>
        </div>

      <!-- panel-body --> 
   