<?php $this->load->view('administrator/include/left_sidebar'); ?>

<style type="text/css">
    .trailDescriptionCls{
        display: table-row-group;
        text-align: justify;
    }
     #trailDescriptionId br {
       display: none;
    }
    #trailDescriptionId p br {
       display: none;
    }
   
</style>
<div class="warper container-fluid">
  <div id="responseMsg"></div>            
<div class="page-header"><h3>Trail Reporting</h3></div>
<div class="panel panel-default POI-table">
  <div class="panel-body">
 
    <button  class="ViewPendingUpdates"  onclick="window.location.href='<?php echo base_url(); ?>administrator/pending_submissions_trailreport';">View Pending Submissions</button>
   <!--  <button  class="OpenSelectedTrails OpenALLTrails" > Approve Selected Submissions</button>
    <button  class="CloseSelectedTrails CloseALLTrails">Reject Selected Submissions</button> -->
    
    <div id="AllTrailData">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="toggleColumn-datatable" >
        <thead>
          <tr>
            <!-- <th><input type="checkbox" class="mail-checkbox mail-group-checkbox" value="1" id="select_all1"/></th> -->
            <th>State Name</th>
            <th>County</th>
            <th>Zip Code</th>
            <th>Cities</th>
            <th>Trail Conditions</th>
            <th>Maintained By</th>
            <th>Submitted By</th>
            <th>Last Modifier</th>
            <th>Last Modify Date</th>

           <?php 
              $flag1=0;
              $flag2=0;
              $flag3=0;
               if (isset($checkpers)) {
                  foreach ($checkpers as $checkper) {    
                      if (($checkper->permission_id == 5) ) { 

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
        <tbody >
          <?php
          //  $i =1;
          if(isset($trailList)){
          foreach ($trailList as $trail) {
          $words = explode(" ",$trail->county_detail);
          $content = implode(" ",array_splice($words,0,5));
          $words1 = explode(" ",$trail->trail_conditions);
          $content1 = implode(" ",array_splice($words1,0,5));
          $words2 = explode(" ",$trail->cities);
          $content2 = implode(" ",array_splice($words2,0,5));
          ?>
          <tr>
            <!--  <td><input type="checkbox" name="inbox_id1[]" class="mail-checkbox mycheckbox" value="<?php if(isset($trail->county_name) && !empty($trail->county_name)) {echo $trail->county_name;} ?>" > </td>-->
            <td><?php if(isset($trail->region_name)){echo $trail->region_name;}?></td>
            <td><?php if(isset($trail->county_name)){echo $trail->county_name;}?></td>
             <td><?php if(isset($trail->zipcode) && !empty($trail->zipcode)){echo $trail->zipcode;}?></td>
            <td><p class="cities"><?php if(isset($content2)){echo $content2;}?></p></td>
            
            <td><p class="trail_conditions">
              <?php echo $content1; ?>
            </p></td>
            <td><p class="maintainedBy"><?php if(isset($trail->maintainedBy)){echo $trail->maintainedBy;}?></p></td>
            <td><p class="submitted_by">
              <?php if(isset($trail->submitted_by)){echo $trail->submitted_by;}?>
            </p>
          </td>
           <td><?php if(isset($trail->last_modify_user_id) && !empty($trail->last_modify_user_id)){
                            $query = $this->db->query("SELECT fname,user_id from tbl_user_master where user_id=".$trail->last_modify_user_id."");
                            $result = $query->result();
                            echo $result[0]->fname;
                            
                       }?></td>
                        <td><?php if(isset($trail->last_modify_date) && $trail->last_modify_date !='0000-00-00'){$date = date_create($trail->last_modify_date); 
                        echo date_format($date, 'd-M-Y');}?></td>

          <?php 
              $flag1=0;
              $flag2=0;
              $flag3=0;
               if (isset($checkpers)) {
                  foreach ($checkpers as $checkper) {    
                      if (($checkper->permission_id == 5) ) { 

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
                <td>
                <ul class="edv-option">
                  <?php if($flag3 == 1){ ?>
                  <li><a class="btn btn-default btn-sm btn-edit" data-toggle="modal"  data-target="#trail_newupadate<?php if(isset($trail->county_name)){echo str_replace(' ', '', $trail->county_name);}?>">View</a></li>
                  <?php } ?>
                  <?php if($flag2 == 1){ ?>
                   <li>
                    <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url(); ?>administrator/trailreportedit/<?php if(isset($trail->region_name)){echo str_replace(' ', '-', $trail->region_name);}?>/<?php if(isset($trail->county_name)){echo str_replace(' ', '-', $trail->county_name);}?>">Edit</a>
                  </li>
                  <?php } ?>
                  <ul>
                    <div class="modal fade updateTrail text-left" id="trail_newupadate<?php if(isset($trail->county_name)){echo str_replace(' ', '', $trail->county_name);}?>" role="dialog" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title">Trail Report Details</h4>
                          </div>
                          <div class="modal-body">
                            <div id="respMsgtrail"></div>
                            <p><label>County</label> <span><?php if(isset($trail->county_name)){echo $trail->county_name;}?></span></p>
                            <p><label>State Name</label> <span><?php if(isset($trail->region_name)){echo $trail->region_name;}?></span></p>
                            <p><label>Cities</label> <span><?php  echo $trail->cities; ?></span></p>
                            <p><label>Trail Description</label> <span><?php  echo $trail->county_detail; ?></span></p>
                            <p><label>Trail Conditions</label> <span><?php  echo $trail->trail_conditions;  ?></span>
                        </p>
                        <p><label>Maintained By</label> <span><p class="maintainedBy"><?php if(isset($trail->maintainedBy)){echo $trail->maintainedBy;}?></p></span></p>
                        <p><label>Submitted By</label> <span>
                          <?php if(isset($trail->submitted_by) && !empty($trail->submitted_by)){
                           echo $trail->submitted_by;
                         } else{ echo 'admin'; }?> </span></p>
                    </div>
                  </div>
                </div>
              </div>
            </td>
              <th>Action</th>
              <?php } elseif ($u_id==1) {?>
               <td>
            <ul class="edv-option">
              <li><a class="btn btn-default btn-sm btn-edit" data-toggle="modal"  data-target="#trail_newupadate<?php if(isset($trail->county_name)){echo str_replace(' ', '', $trail->county_name);}?>">View</a></li>
               <li>
                <a class="btn btn-default btn-sm btn-edit" href="<?php echo base_url(); ?>administrator/trailreportedit/<?php if(isset($trail->region_name)){echo str_replace(' ', '-', $trail->region_name);}?>/<?php if(isset($trail->county_name)){echo str_replace(' ', '-', $trail->county_name);}?>">Edit</a>
              </li>
              <ul>
                <div class="modal fade updateTrail text-left" id="trail_newupadate<?php if(isset($trail->county_name)){echo str_replace(' ', '', $trail->county_name);}?>" role="dialog" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Trail Report Details</h4>
                      </div>
                      <div class="modal-body">
                        <div id="respMsgtrail"></div>
                        <p><label>County</label> <span><?php if(isset($trail->county_name)){echo $trail->county_name;}?></span></p>
                        <p><label>State Name</label> <span><?php if(isset($trail->region_name)){echo $trail->region_name;}?></span></p>
                        <p><label>Cities</label> <span><?php  echo $trail->cities; ?></span></p>
                        <p><label>Trail Description</label> <span><?php  echo $trail->county_detail; ?></span></p>
                        <p><label>Trail Conditions</label> <span><?php  echo $trail->trail_conditions;  ?></span>
                    </p>
                    <p><label>Maintained By</label> <span><p class="maintainedBy"><?php if(isset($trail->maintainedBy)){echo $trail->maintainedBy;}?></p></span></p>
                    <p><label>Submitted By</label> <span>
                      <?php if(isset($trail->submitted_by) && !empty($trail->submitted_by)){
                       echo $trail->submitted_by;
                     } else{ echo 'admin'; }?> </span></p>
                </div>
              </div>
            </div>
          </div>
          
        </td>
              <?php } ?>

         
      </tr>
      <?php //$i++;
      } }?>
    </tbody>
  </table>
</div>

</div>



<!-- Warper Ends Here (working area) -->
<script type="text/javascript">
  $(document).ready(function () {

    $('.content3close').click(function(){
      var ID = $(this).attr('data-dismiss');
      //alert(ID);
        $(ID).modal('hide');
    });

      /*$(".ViewPendingUpdates").click(function(){
        $("#PendingUpdates").show();
        $("#AllTrailData").hide();
    });*/
    /*$(".AllData").click(function(){
        $("#PendingUpdates").hide();
        $("#AllTrailData").show();
    });*/
    var table = $('#toggleColumn-datatable1').DataTable({});
   $('#select_all').on('click', function(){
     
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]',rows).prop('checked', this.checked);
     
    });
    $('.mycheckbox').on('click',function(){
         $('#select_all1').prop('checked', true).triggerHandler('click');
         $('.OpenALLTrails').addClass('selectedCheckBox');
         $('.selectedCheckBox').removeClass('OpenALLTrails');

         $('.CloseALLTrails').addClass('selectedCheckBoxClose');
         $('.selectedCheckBox').removeClass('CloseALLTrails');
    }); 

    /*var table1 = $('#toggleColumn-datatable').DataTable({});
    $(document).on('click','.selectedCheckBox',function() {
   // $(".selectedCheckBox").click(function() {
      var rows = table1.rows({ 'search': 'applied' }).nodes();
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id1[]']:checked",rows).each(function() {
       
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data = selectedItems.join(',');
      var inbox_ids = data;
     
      var inbox_action = 'OpenALLTrails';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_report_acitities1'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
              
               location.reload(); 
            }
      });                

    });

        $(document).on('click','.selectedCheckBoxClose',function() {
   // $(".selectedCheckBox").click(function() {
      var rows = table1.rows({ 'search': 'applied' }).nodes();
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id1[]']:checked",rows).each(function() {
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data = selectedItems.join(',');
      var inbox_ids = data;
     
      var inbox_action = 'OpenALLTrails';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_report_acitities1'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
               location.reload(); 
            }
      });                

    });


    $(".OpenALLTrails").click(function() {
      var rows = table.rows({ 'search': 'applied' }).nodes();
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked",rows).each(function() {
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data = selectedItems.join(',');
      var inbox_ids = data;
      
      var inbox_action = 'OpenALLTrails';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_report_acitities'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
              
               location.reload(); 
            }
      });                

    });
     $(".CloseALLTrails").click(function() {
      var rows = table.rows({ 'search': 'applied' }).nodes();
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked",rows).each(function() {
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data = selectedItems.join(',');
      var inbox_ids = data;
      var inbox_action = 'CloseALLTrails';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_report_acitities'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
               location.reload(); 
            }
      });    
    });*/

  });

  function changestatus2(tablename,ID){
  
 // alert(value);var row = $(this).parent().parent(); 
    $.ajax({
    url: "<?php echo base_url();?>administrator/admin/TrailReportApprove",
    type: "post",
    data:({tablename:tablename,ID:ID}),
    success: function (data) {
        $('#respMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
        $('#PendingUpdates').show();
       $('#AllTrailData').hide();
        location.reload();

    }
    });
}

function changestatus1(value,table,field,wherefield,wherevalue){
  
 // alert(value);var row = $(this).parent().parent(); 
    $.ajax({
    url: "<?php echo base_url();?>administrator/admin/changeTrailReportStatus",
    type: "post",
    data:({value:value,table:table,field:field,wherefield:wherefield,wherevalue:wherevalue}),
    success: function (data) {
        $('#respMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
        $('#PendingUpdates').show();
       $('#AllTrailData').hide();
        location.reload();

    }
    });
}

</script>

<style type="text/css">
  div#content3 .modal-header button.content3close {
    position: absolute;
    right: 0;
    top: 0;
    background: none;
    border: none;
    font-size: 18px;
}  
</style>