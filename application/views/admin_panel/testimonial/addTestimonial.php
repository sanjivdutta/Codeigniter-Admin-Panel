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
                            Add Testimonial
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('testimonial_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_testimonial');
                        echo form_open_multipart('admin/submitTestimonial', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="title" requireda>
                                    <label class="form-label">Author Name</label>
                                </div><?php echo form_error('title'); ?>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="status" id="active" value="1" class="with-gap">
                                <label for="active">Publish this Testimonial</label>

                                <input type="radio" name="status" id="inactive" value="0" class="with-gap" checked>
                                <label for="inactive" class="m-l-20">Don't Publish this Testimonial</label>

                            </div><?php echo form_error('status'); ?>
                            <div class="form-group form-float">
                                <p>Upload Author Image</p>
                                   <input type="file" class="form-control" name="post_image">
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <div class="form-group">
                                <textarea id="ckeditor" name="description_testi" placeholder="Description"></textarea>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT TESTIMONIAL</button>
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
