<?php $this->load->view('include/header_css');?>
<body>
<style type="text/css">
.table_data_main {
  overflow-x: scroll;
}

</style>
<header class="navigation">
  <div class="top-bar">
    <?php $this->load->view('include/top_header');?>
  </div>
  
  <nav class="navbar">
  <?php $this->load->view('include/nav_header'); ?>
    </nav>
</header>

<div class="wrapper">
<section class="profile-main-sec">
    <div class="container">
      <div class="pms-bg">
        <div class="row">
         <?php $this->load->view('user/leftsidebar') ?>
          <div class="col-md-9 col-sm-8">
            <div class="business-detail-sec">
            <div class="business-frm">
              <div id="responseMsg"></div>
              <h3>News List</h3>
            <!-- -->
            <div class="nw-bsns-btn"><a href="<?php echo  base_url();?>user/news/addnews">Add News</a></div>
            
             <div class="table_data_main">
             <div class="table-responsive">
              <table id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
              <thead>
                 <tr>
                    <th>s. no</th>
                    <th>News Title</th>
                    <th>New Description</th>
                    <th>Image</th>
                    <th>Created Date</th>
                    <th>Update Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
            
              <tbody>
                  
                  <?php 
                $i =1;
                if(isset($newList)){
                    foreach ($newList as $news) { 
                        if($news->news_status == 1){
                                $st='Unpublic'; $set=0;
                            }else{
                                $st='Public'; $set=1;
                            }
                            $words = explode(" ",$news->news_description);
                            $content = implode(" ",array_splice($words,0,5));
                            $words1 = explode(" ",$news->news_title);
                            $content1 = implode(" ",array_splice($words1,0,5));
                        ?>
                        <tr>
    
                       <td><?php echo $i; ?></td>
                        <td><?php if(isset($content1)){echo $content1;}?></td>
                        <td><?php if(isset($content)){echo $content;}?></td>
                        <td><img src="<?php if(isset($news->news_image) && !empty($news->news_image)){echo base_url().$news->news_image;}?>" style="height: 78px;margin-left: 10px;"></td>
                        <td><?php if(isset($news->news_created_date)){$date = date_create($news->news_created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>

                        <td><?php if(isset($news->news_update_date)){$date = date_create($news->news_update_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                        <td>
                        <?php if($news->news_status == 1){ ?>
                            <span class="cls_published">Published</span>
                        <?php  }else{?>
                        <span class="cls_pending">Pending Approval</span>
                        <?php } ?>
                       <td>
                       <ul>
                          <li> <a href="<?php echo base_url().'user/news/viewnews/'.$news->news_id; ?>"><i class="fa fa-eye"></i></a></li>

                         <?php if($news->news_status != 1){ ?>
                         <li><a href="<?php echo base_url()."user/news/editnews/".$news->news_id; ?>"><i class="fa fa-pencil"></i></a></li>
                         <?php } ?>


                         <li>  <a onClick="deleteNewsfunc(<?php if(isset($news->news_id)){echo $news->news_id;} ?>, 'tbl_news', 'Do you want to remove this news?')" class="delete-list-row"><i class="fa fa-trash"></i></a></li>
                      </ul>   
                    </td>

                    </tr>
                  <?php  $i++; }  } ?>
                      
                  
                 
              </tbody>
          </table>
            </div>
            </div>
            <!-- -->
            </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>

</div>
    
<footer class="main_footer">
   <?php $this->load->view('include/main_footer'); ?>


</footer>
<div class="copy-right">
<?php $this->load->view('include/copyright'); ?>
</div>

</body>
</html>
<script type="text/javascript">
 function deleteNewsfunc(del_id, tablename, message){

if (confirm(message))
{

$.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>user/deletefun',
        data:{ del_id:del_id, tablename:tablename },
        success: function(data){
          if(data == 1){
            $('#responseMsg').html('<div class="alert alert-success">Delete Record successfully</div>').show().fadeOut(5000);
             location.reload();
          }
           }
        });
           return false;
        }else{
           return true;
        }
    
}

$(document).ready(function() {
$('#responseMsg').hide();
<?php if($this->session->flashdata('error')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>').show().fadeOut(5000);
<?php } ?>

<?php if($this->session->flashdata('success')){ ?>
  
  $('#responseMsg').html('<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>').show().fadeOut(5000);

<?php } ?>
});
</script>