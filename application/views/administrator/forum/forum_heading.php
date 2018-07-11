<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <style type="text/css">
     .form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
            <div class="panel-heading">Forum Heading</div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/forum_heading" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" placeholder="title" value="<?php if(isset($forum_heading->title)){echo $forum_heading->title; } ?>" />
                                <label id="forum_heading-error" class="error" for="forum_heading"><?php echo form_error('forum_heading');?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Description</label>
                            <div class="col-sm-8">
                                <textarea cols="100" id="ckeditor" name="description" rows="50"><?php if(isset($forum_heading->description)){echo $forum_heading->description; }else{echo set_value('description'); }?></textarea>
                                <label id="description-error" class="error" for="description"><?php echo form_error('description');?></label>
                            </div>
                        </div>
                        <hr class="dotted">
                        <div class="form-group buton-edit">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button  type="submit" class="btn btn-primary" name="signup">Update</button>
                            </div>
                        </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
