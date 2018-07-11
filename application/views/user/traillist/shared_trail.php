<?php $this->load->view('include/header_css');?>
<!-- facebbok share --> 
<body>
<style type="text/css">
.table_data_main {
  overflow-x: scroll;
}
.my-drop-list {
    position: relative;
    padding: 10px;
}
.my-drop-list .page_text {
    width: 38px;
    border-radius: 50%;
    height: 38px;
    overflow: hidden;
    float: left;
    margin-left: 10px;
}
.my-drop-list .page_text img {
    width: 100%;
}
.namet {
    float: left;
    padding: 8px 15px;
}
.my-drop-list ul {
    margin: 0 !important;
    padding: 0;
    top: 48px;
    left: 10px;
    right: 10px;
    border-radius: 0;
    border: none;
}
.my-drop-list input {
    width: 100%;
    margin: 0 auto;
    padding: 5px 10px;
    height: 38px;
}
.my-drop-list ul li {
    width: 100%;
    float: left;
}

#ajax_response{
  border: 1px solid #ccc;
  background: #FFFFFF;
  position: absolute;
  display: none;
  padding: 0;
  top: 50px;
  left: 10px;
  right: 10px;
  z-index: 9999;
}
.list {
  padding:0px 0px;
  margin:0px;
  list-style : none;
}
.list li a{
  text-align : left;
  padding:2px;
  cursor:pointer;
  display:block;
  text-decoration : none;
  color:#000000;
}

.bold{
  font-weight:bold;
  color: #131E9F;
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
            <div class="business-frm kml-form-main">
              <div id="responseMsg"></div>
              <?php if($basesegment == 'sharedtrail'){ ?>
                <h3>Shared Trail</h3>
              <?php }?>
              <!-- -->
               <div class="table_data_main">
               <div class="table-responsive">
                <table  id="businessTbl" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                   <tr>
                      <th>User Name</th>
                      <th>State</th>
                      <th>Trail Name</th>
                      <th>Url</th>
                      <th>Date</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                     <?php 
                  $i =1;
                  if(isset($shared_trail_list)){
                      foreach ($shared_trail_list as $shared_trail) { 
                         ?>
                        <tr>
                           <td><?php if(isset($shared_trail->shared_u_id)){
                            $query= $this->db->query("SELECT fname, lname,username,user_id FROM tbl_user_master WHERE user_id=".$shared_trail->shared_u_id."");
                            $result = $query->result();
                          //  print_r($result);
                            if(isset($result[0]->fname) || isset($result[0]->lname)){
                              echo $result[0]->fname.' '.$result[0]->lname;
                            }elseif(isset($result[0]->username)){
                              echo $result[0]->username;
                            }
                            }?></td>
                           <td><?php if(isset($shared_trail->region_name)){echo $shared_trail->region_name;}?></td>
                           <td><?php if(isset($shared_trail->t_name)){echo $shared_trail->t_name;}?></td>
                           <td><a href="<?php if(isset($shared_trail->url)){echo $shared_trail->url;}?>">Show Shared Trail</a></td>
                           <td><?php if(isset($shared_trail->created_date)){$date = date_create($shared_trail->created_date); 
                            echo date_format($date, 'd-M-Y');}?></td>
                           <td>
                              <ul>
                                <li><a href="<?php if(isset($shared_trail->url)){echo $shared_trail->url;}?>"><i class="fa fa-eye"></i></a></li>
                                  <li><a onClick="deletefunc('<?php if(isset($shared_trail->s_t_id)){echo $shared_trail->s_t_id; } ?>', 'tbl_share_my_trails', 'Do you want to remove this shared trail')" 
                                    class="delete-list-row"><i class="fa fa-trash"></i></a>
                                  </li>
                              </ul>
                           </td>
                           
                       </tr>  
                 <?php $i++; } }?>
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

