<?php include(dirname(__FILE__).'/../include/header.php'); ?>
<?php include(dirname(__FILE__).'/../include/materials.php'); ?>
<!-- Top Bar -->
<?php include(dirname(__FILE__).'/../include/top_bar.php'); ?>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <?php include(dirname(__FILE__).'/../include/left_menu.php'); ?>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <?php include(dirname(__FILE__).'/../include/right_bar.php'); ?>
    <!-- #END# Right Sidebar -->
</section>


<section class="content">
    <div class="container-fluid">
        <!-- <div class="block-header">
            <h2>EDITORS</h2>
        </div> -->

        <!-- CKEditor -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Post
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('record_update');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/updatePost', $attributes);
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="title" value="<?php echo $postDet->post_title; ?>" required>
                                <input type="hidden" class="form-control" name="postID" value="<?php echo $this->uri->segment(4); ?>" >
                                <!-- <label class="form-label">Post Title</label> -->
                            </div><small>Post Title</small><br><?php echo form_error('title'); ?>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="page_name" value="<?php echo $postDet->page_name; ?>">
                            </div><small>Page Name</small><br><?php echo form_error('page_name'); ?>
                        </div>
                        <div class="form-group form-float">

                            <select class="form-control show-tick" name="postCat" data-live-search="true">
                                <option value=''>Search category here..</option>
                                <?php foreach($categories as $cat){ ?>
                                    <option <?php if($postDet->cat_id == $cat['id']){ ?> selected <?php } ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="pull-right marginTop"><a href="<?php echo base_url() ?>admin/categories">Click here to add new category</a></div>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="status" id="active" value="1" class="with-gap" <?php if($postDet->status==1){ echo 'checked'; } ?>>
                            <label for="active">Publish this post</label>

                            <input type="radio" name="status" id="inactive" value="0" class="with-gap" <?php if($postDet->status==0){ echo 'checked'; } ?>>
                            <label for="inactive" class="m-l-20">Don't Publish this post</label>

                        </div><br><?php echo form_error('status'); ?>

                        <?php if($postDet->file_name!=''){ ?>
                        <div class="form-group form-float imgDiv">
                            <p>Upload Image</p>
                            <img class="customImg" src="<?php echo base_url().'uploads/postImages/'.$postDet->file_name ?>" alt="img_edt_txt" />
                            <br/>
                            <a href="<?php echo base_url().'admin/post/image_delete/'.$this->uri->segment(4); ?>" class="btn bg-teal waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">Remove Image</a>
                        </div>
                        <?php } else { ?>

                        <div class="form-group form-float">
                            <p>Upload Image</p>
                            <input type="file" class="form-control" name="post_image">
                            <span><?php if (isset($error)) { echo $error; } ?></span>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <textarea id="ckeditor" name="desc"><?php echo $postDet->post_desc; ?></textarea>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit">UPDATE POST</button>
                        <?php form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CKEditor -->
    </div>
</section>

<?php include(dirname(__FILE__).'/../include/footer.php'); ?>
</body>

</html>
