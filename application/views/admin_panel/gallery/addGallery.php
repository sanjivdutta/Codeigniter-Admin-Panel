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
                        echo $this->session->flashdata('gallery_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/submitGallery', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="gname" required>
                                    <label class="form-label">Gallery Name</label>
                                </div><?php echo form_error('gname'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea class="form-control" name="gdesc" rows="6"></textarea>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <p>Upload Image</p>
                                   <input type="file" class="form-control" name="userFiles[]" multiple>
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT GALLERY</button>
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
