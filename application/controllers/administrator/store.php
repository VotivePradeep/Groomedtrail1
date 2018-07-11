<?php $this->load->view('administrator/include/left_sidebar'); ?>

<div class="warper container-fluid">
<span style="color:green; display:none; text-align:center" id="notification"></span>       
<div class="page-header">
<h3>Saved Messages</h3>
       <input type="hidden" name="inbox_ids" id="inbox_ids" value=""/>
</div>
<div class="panel panel-default route-table">
    <div class="panel-heading">
          <a id="move_enquiry" class="btn btn-default btn-sm">Move to Inbox</a>&nbsp;          
          <a id="delete_enquiry" class="btn btn-default btn-sm">Delete</a>
    </div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable">
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
                    <td><?php if(!empty($enquiryrow->created_date)){echo date("M-d-Y", strtotime($enquiryrow->created_date));}else{echo '-';}?></td>
                    </tr>
                <?php }
        }?>
            </tbody>
        </table>

    </div>
</div>

</div>
<!-- Warper Ends Here (working area) -->
<script type="text/javascript">

    $('#select_all').on('click',function(){
        if(this.checked){
            $('.mycheckbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.mycheckbox').each(function(){
                this.checked = false;
            });
        }
    });    


    $('.mycheckbox').on('click',function(){

        if($('.mycheckbox:checked').length > 0){
            $('#select_all').prop('checked',true);
        }
        else{
            $('#select_all').prop('checked',false);
        }
    }); 

    $("#move_enquiry").click(function() {

      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);

      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'move_enquiry';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';

      
                 $.ajax({
                    type: "POST",
                    url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
                    data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
                    dataType: "JSON",
                    success: function(data)
                    {
                       location.reload(); 
                    }
                });                
      
    });


    $("#store_enquiry").click(function() {

      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);

      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'store_enquiry';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';

      
                 $.ajax({
                    type: "POST",
                    url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
                    data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
                    dataType: "JSON",
                    success: function(data)
                    {
                       location.reload(); 
                    }
                });                
      
    });

    $("#delete_enquiry").click(function() {

      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked").each(function() {selectedItems.push($(this).val());});
      var data = selectedItems.join(',');
      $("#inbox_ids").val(data);

      var inbox_ids = $('#inbox_ids').val();
      var inbox_action = 'delete_enquiry';
      var new_url = '<?php echo  base_url().'administrator/admin/contactus_refresh'; ?>';

      
                 $.ajax({
                    type: "POST",
                    url: '<?php echo  base_url().'administrator/admin/contactus_acitities'; ?>',
                    data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
                    dataType: "JSON",
                    success: function(data)
                    {
                       location.reload(); 
                    }
                });                
      
    });


</script>
