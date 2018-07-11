<?php $this->load->view('administrator/include/left_sidebar'); ?>
<style type="text/css">
    #ajax_favorite_loddder {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background:rgba(255, 255, 255, 0.5);
    z-index: 9999;
}
#ajax_favorite_loddder img {
    top: 42vh;
    left: 0;
    position: absolute;
    right: 0;
    margin: 0 auto;
    max-width: 120px;
}
/*************pagination start************/
div#data_page_record_box .pagination {
    text-align: right;
    display: block;
    margin: 20px 0 0px;
}
div#data_page_record_box .pagination ul li:first-child {
    float: left;
    text-align: left;
}
div#data_page_record_box .pagination ul {
    display: block;
    margin-bottom: 0;
    margin-left: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    padding: 0px;
}
div#data_page_record_box .pagination ul li {
    display: inline-block;
}
div#data_page_record_box div.pagination li.act a {
    padding: 3px 7px;
    background-color: #000;
    color: #fff !important;
    text-decoration: none;
    border: none;
    border-right: 1px solid #ccc;
    margin: 0;
}
div#data_page_record_box .pagination a:hover,
div#data_page_record_box .pagination a:focus {
    background: #eee;
}
div#data_page_record_box .pagination a,
div#data_page_record_box .pagination span {
    border-left-width: 0;
    position: relative;
    float: left;
    padding: 2px 6px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #000;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.main_top_section .trail-no-page,
.main_top_section .trail_search,
.main_top_section .top_state {
    clear: both;
    overflow: hidden;
}
.main_top_section .trail-no-page label {
    padding-left: 0;
    padding-top: 7px;
    margin-bottom: 0;
}
.main_top_section .trail-no-page ul {
    margin: 0;
    padding-right: 10px;
}
.main_top_section .trail-no-page ul li {
    list-style-type: none;
}
.main_top_section .trail-no-page ul select {
    height: 30px;
    line-height: 30px;
    padding: 0 8px;
}
.main_top_section .trail_search label {
    text-align: right;
    padding-top: 7px;
    margin-bottom: 0;
}
.main_top_section .trail_search input {
    height: 30px;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.main_top_section .top_state {
    padding: 20px 0;
    text-align: right;
}
.main_top_section .top_state select {
    height: 30px;
    padding: 5px 7px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
div#data_page_record_box .pagination ul li:last-child a {
    border-radius: 0px 4px 4px 0px;
}
div#data_page_record_box .pagination ul li:nth-child(2) a {
    border-radius: 4px 0px 0px 4px;
}
/*************pagination end************/
</style>
<div class="warper container-fluid">
  <div id="responseMsg"></div>            
  <div id="responseMsg1"  style="display: none"></div>  
<div class="page-header"><h3>Trail List</h3></div>
<div class="panel panel-default POI-table">
  
    <div class="panel-body">
   
    <button  class="AllData" onclick="window.location.href='<?php echo base_url(); ?>administrator/traillist'">All</button>
    <button  class="ViewPendingUpdates" onclick="window.location.href='<?php echo base_url(); ?>administrator/pandingtraillist'" <?php if($this->uri->segment(2) == 'pandingtraillist'){ ?> style="box-shadow: 2px 2px 2px 2px #cccfd2  !important;" <?php } ?>>View Pending Updates</button>
    <button  class="CloseSelectedTrails" id="CloseALLTrails">Close Selected Trails</button>
    <button  class="OpenSelectedTrails" id="OpenALLTrails">Open Selected Trails</button>
    <button  class="CloseALLTrails" id="seletAllClose">Close ALL Trails</button>
    <button  class="OpenALLTrails" id="seletAllOpen">Open ALL Trails</button>
      <div class="main_top_section">
        <div class="row">
            <div class="col-sm-6">
                <div class="trail-no-page">
                    <label class="col-sm-3 control-label" style="text-align:left;">Show  entries</label>
                    <ul class="col-sm-2">
                        <li>
                          <select class="form-control" onchange="searchFilter()" id="pagination_qty">
                            <option value="">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                          </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="trail_search">
                    <div class="row">
                        <label class="col-sm-7 control-label">Search:</label> 
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="keywords" onkeyup="searchFilter()"/>
                        </div>
                    </div>
                </div>
                <div class="top_state">
                    <div class="row">
                        <div class="col-sm-5 pull-right">
                            <select class="form-control" id="state" name="state" onchange="searchFilter()">
                                <option value="">Select A State</option>
                             <?php $query = $this->db->query('SELECT DISTINCT region_name FROM tbl_kml_data_trail');
                              $region = $query->result();
                              if(isset($region)){
                                foreach ($region as $regionName) { ?>
                                  <option value="<?php echo $regionName->region_name; ?>" ><?php echo $regionName->region_name; ?></option>
                             <?php } } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <textarea name="inbox_ids" id="inbox_ids" value="" style="display: none"></textarea>
        <div id="PendingUpdates">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="toggleColumn-datatable11" >
            <thead >
                <tr><th class="no-sort"><input type="checkbox" class="mail-checkbox mail-group-checkbox" value="1" id="select_all"></th>
                    <th>Trail Type</th>
                    <th>Trail Name</th>
                    <th>Trail Description</th>
                    <th>Trail Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="postList">
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
            
               <?php  } }?> </tbody>
        </table>
          
        <div id="data_page_record_box">
                <?php echo $this->ajax_pagination->create_links(); ?>
              </div>
        <div>
    </div>
</div>
</div>
 <div id="ajax_favorite_loddder" style="display:none;">
  <div align="center" style="vertical-align:middle;"> <img src="<?php echo base_url();?>assets/images/white_loader.svg" /> </div>
<!-- Warper Ends Here (working area) -->

<script>


function searchFilter(page_num) {
  page_num = page_num?page_num:0;
  var keywords =$('#keywords').val(); 
  var state =$('#state').val(); 
  var per_page =$('#pagination_qty').val();
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url(); ?>administrator/admin/ajaxpandingtraillistPaginationData/'+page_num,
    data:'page='+page_num+'&per_page='+per_page+'&keywords='+keywords+'&state='+state,
    beforeSend: function () {
       $("#ajax_favorite_loddder").show();
    },
    success: function (html) {
      $("#ajax_favorite_loddder").hide();
      $dats=html.split('*****');
      $('#postList').html($dats[0]);
      $('#data_page_record_box').html($dats[1]);
      $('.loading').fadeOut("slow");
    }
  });
}

</script>


<script type="text/javascript">

 function changestatus(table,field,wherefield,wherevalue,value){
   $.ajax({
    url: "<?php echo base_url();?>administrator/admin/changeTrailReportStatus",
    type: "post",
    data:({value:value,table:table,field:field,wherefield:wherefield,wherevalue:wherevalue}),
    success: function (data) {
        $('#responseMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
        location.reload();
    }
    });
}

 function changestatus1(value,table,field,wherefield,wherevalue,value2,table2,field2,wherefield2,wherevalue2){

    $.ajax({
    url: "<?php echo base_url();?>administrator/admin/changeTrailStatus",
    type: "post",
    data:({value:value,table:table,field:field,wherefield:wherefield,wherevalue:wherevalue,value2:value2,table2:table2,field2:field2,wherefield2:wherefield2,wherevalue2:wherevalue2}),
    success: function (data) {
        $('#respMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
        $('#PendingUpdates').show();
       $('#AllTrailData').hide();
        //location.reload();

    }
    });
}

function changestatus2(value,table,field,wherefield,wherevalue,value2,table2,field2,wherefield2,wherevalue2,wherefield4,wherevalue4){

 // alert(value);var row = $(this).parent().parent(); 
    $.ajax({
    url: "<?php echo base_url();?>administrator/admin/changeTrailStatusChange",
    type: "post",
    data:({value:value,table:table,field:field,wherefield:wherefield,wherevalue:wherevalue,value2:value2,table2:table2,field2:field2,wherefield2:wherefield2,wherevalue2:wherevalue2,wherevalue4:wherevalue4,wherefield4:wherefield4}),
    success: function (data) {
        $('#respMsg').html('<div class="alert alert-success"><?php echo 'Status change successfully'; ?> </div>').show().fadeOut(5000);
        $('#PendingUpdates').show();
       $('#AllTrailData').hide();
        location.reload();

    }
    });
}

</script>



<script type="text/javascript">
$(document).ready(function(){
$('#toggleColumn-datatable11').dataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
} );

    
    $('.sorting_asc').removeClass('sorting_asc');

    $("#select_all").change(function(){ 
        $(".mycheckbox").prop('checked', $(this).prop("checked"));  
    });
    $('.mycheckbox').on('click',function(){

        if($('.mycheckbox:checked').length > 0){
            $('#select_all').prop('checked',true);
        }
        else{
            $('#select_all').prop('checked',false);
        }
    }); 
    $("#CloseALLTrails").click(function() {
     
      var rows = table.rows({ 'search': 'applied' }).nodes();
       var region_name ='<?php echo $_GET['state'];?>';
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked",rows).each(function() {
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data = selectedItems.join(',');
      var inbox_ids = data;
      var inbox_action = 'CloseALLTrails';
      var buttonVal = 1
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_acitities'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action,region_name:region_name}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
               $("#ajax_favorite_loddder").hide();
               location.reload();
            }
      });                

    });
      $("#OpenALLTrails").click(function() {
      var rows = table.rows({ 'search': 'applied' }).nodes();
      var region_name ='<?php echo $_GET['state'];?>';
      var selectedItems = new Array();
      $("input:checkbox[name='inbox_id[]']:checked",rows).each(function() {
        selectedItems.push('"'+$(this).val()+'"');
      });
      var data1 = selectedItems.join(',');

      var inbox_ids = data1;
      var inbox_action = 'OpenALLTrails';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_acitities'; ?>',
            data: {inbox_ids:inbox_ids, inbox_action:inbox_action,region_name:region_name}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
                $("#ajax_favorite_loddder").hide();
               location.reload();
            }
      });                

    });

});

$("#seletAllClose").click(function() {
    // $("#ajax_favorite_loddder").show();
      var inbox_action = 'seletAllClose';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_acitities'; ?>',
            data: {inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
               location.reload();
            }
      });                

    });
$("#seletAllOpen").click(function() {
     //$("#ajax_favorite_loddder").show();
      var inbox_action = 'seletAllOpen';
      $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trail_acitities'; ?>',
            data: {inbox_action:inbox_action}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
                location.reload();
            }
      });                

    });
function trailDetailEdit(trail_name, oldtrail){
    var trailName = $('#trail_name'+trail_name+'').val();
    //alert(trailName);
    var trailDesc = $('#trailDesc'+trail_name+'').val();
     $.ajax({
            type: "POST",
            url: '<?php echo  base_url().'administrator/admin/trailDetailEdit'; ?>',
            data: {trailName:trailName, trailDesc:trailDesc,oldtrail:oldtrail}, // serializes the form's elements.
            dataType: "JSON",
            success: function(data)
            {
                $('#'+trail_name+'trailDesc'+trail_name).html(trailDesc);
                $('#'+trail_name+'trailname'+trail_name).html(trailName);
                $('#respMsgtrail').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a>Trail detail Update successfully </div>').show().fadeOut(5000);
                var trailnamejoin = oldtrail.replace(/\s/g, '');
                //alert(trailnamejoin);
               // setTimeout($('#trailnameModal'+trailnamejoin).modal('hide'), 40000);
               location.reload();
       
            }
   }); 

}

$(document).on('click','.deletekml',function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_kml_data_trail';
 var row = $(this).parent().parent();       
if (confirm('Do you want to remove this?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             //location.reload();
             row.remove();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});

$(document).ready(function(){
   // code to get all records from table via select box
    $("#state").change(function() {
       $('#stateSubmit').trigger('click');
    });


    /*$('#toggleColumn-datatable123').dataTable( {
      "search": {
      "smart": false
      },
      "ordering": true,
      columnDefs: [{  orderable: false, targets:  "no-sort"}]
    });*/
});

$(document).on('click','.deletetrailreport',function(){
 var del_id= $(this).attr('id');
 var tablename= 'tbl_trail_report';
 var row = $(this).parent().parent();       
if (confirm('Do you want to remove this?'))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url();?>administrator/admin/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
             //location.reload();
             row.remove();
          }
           }
        });
           return false;
        }else{
           return true;
        }

});
</script> 