<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
 <div id="responseMsg"></div>             
<div class="page-header"><h3>Emails Setting</h3></div>
<div class="panel panel-default route-table">

    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
            <thead>
                <tr>
                    <th style="display: none;">s. no</th>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Update Date</th>
                    <th>Action</th>
                </tr>
            </thead>
     
     
            <tbody>
                
                <?php 
                $i =1;
                if(isset($emailList)){
                    foreach ($emailList as $email) {
                           
                        ?>

                    <tr>
                        <td style="display: none;"><?php echo $i; ?></td>
                        <td><?php if(isset($email->title)){echo $email->title;}?></td>
                        <td><?php if(isset($email->subject)){echo $email->subject;}?></td>
                        <td><?php if(isset($email->updated_date)){$date = date_create($email->updated_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                        <td>
                        <ul class="edv-option">
                        <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/email/edit/<?php echo $email->id; ?>">Edit</a></li>

                        <li><a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url();?>administrator/email/view/<?php echo $email->id; ?>">View</a></li>
                        
                        </ul>
                        </td>
                    </tr>    
               <?php $i++; } }?>
                
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
