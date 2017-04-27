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
                            Add Post
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('post_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/submitPost', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="title" requireda>
                                    <label class="form-label">Post Title</label>
                                </div><?php echo form_error('title'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="page_name" required>
                                    <label class="form-label">Page Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">

                                    <select class="form-control show-tick" name="postCat" data-live-search="true">
                                        <option value=''>Search category here..</option>
                                        <?php foreach($categories as $cat){ ?>
                                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <div class="pull-right marginTop"><a href="<?php echo base_url() ?>admin/categories">Click here to add new category</a></div>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="status" id="active" value="1" class="with-gap">
                                <label for="active">Publish this post</label>

                                <input type="radio" name="status" id="inactive" value="0" class="with-gap" checked>
                                <label for="inactive" class="m-l-20">Don't Publish this post</label>

                            </div><?php echo form_error('status'); ?>
                            <div class="form-group form-float">
                                <p>Upload Image</p>
                                   <input type="file" class="form-control" name="post_image">
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <div class="form-group">
                                <textarea id="ckeditor" name="desc"></textarea>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT POST</button>
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
