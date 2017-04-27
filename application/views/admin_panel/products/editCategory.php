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
                            Edit Category
                            <small></small>
                        </h2>
                    </div>
                    <?php //print_r($tblData); ?>

                    <div class="body">
                        <?php
                        echo $this->session->flashdata('category_edit');
                        $attributes = array('id' => 'form_validation_add_category');
                        echo form_open_multipart('admin/updateProductCategory', $attributes);
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="cat_name" value="<?php echo $catDet->cat_name; ?>" required>
                                <input type="hidden" class="form-control" name="catID" value="<?php echo $this->uri->segment(5); ?>" >
                            </div><small>Category Name</small><br><?php echo form_error('cat_name'); ?><br/>
                            <?php if($catDet->file_name!=''){ ?>
                            <div class="form-group form-float imgDiv">
                                <p>Upload Image</p>
                                <img class="customImg" src="<?php echo base_url().'uploads/catImages/'.$catDet->file_name ?>" alt="img_edt_txt" />
                                <br/>
                                <a href="<?php echo base_url().'admin/product/category/image_delete/'.$this->uri->segment(5); ?>" class="btn bg-teal waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">Remove Image</a>
                            </div>
                            <?php } else { ?>

                            <div class="form-group form-float">
                                <p>Upload Image</p>
                                <input type="file" class="form-control" name="cat_images">
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit">UPDATE CATEGORY</button>
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
