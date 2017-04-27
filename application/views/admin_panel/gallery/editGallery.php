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
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Gallery
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('record_update');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/updateGallery', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Gallery Name" name="gname" value="<?php echo $postDet->gname; ?>" required>
                                    <input type="hidden" class="form-control" name="galID" value="<?php echo $this->uri->segment(4); ?>" >
                                </div><?php echo form_error('gname'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea class="form-control" name="gdesc" rows="6" placeholder="Enter Description"><?php echo $postDet->gdesc; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="publish" id="active" value="Y" class="with-gap" <?php if($postDet->publish=='Y'){ echo 'checked'; } ?>>
                                <label for="active">Publish this Gallery</label>

                                <input type="radio" name="publish" id="inactive" value="N" class="with-gap" <?php if($postDet->publish=='N'){ echo 'checked'; } ?>>
                                <label for="inactive" class="m-l-20">Don't Publish this Gallery</label>

                            </div><br><?php echo form_error('status'); ?>

                            <div class="form-group form-float">
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <?php
                                    $images = getGalImages($postDet->id);
                                    foreach($images as $img){
                                ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 minHeight">
                                    <a href="<?php echo base_url().'uploads/gallery/'.$img['img_name']; ?>" data-sub-html="<?php echo $postDet->gname; ?>">
                                        <img class="img-responsive thumbnail" src="<?php echo base_url().'uploads/gallery/'.$img['img_name']; ?>">
                                    </a>
                                    <!-- <a href="<?php echo base_url().'admin/gallery/image_delete/'.$this->uri->segment(4); ?>" class="btn bg-red waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">
                                        Remove Image
                                    </a> -->
                                </div>
                                <?php } ?>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <p>Upload More Image</p>
                                   <input type="file" class="form-control" name="userFiles[]" multiple>
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">UPDATE GALLERY</button>
                        <?php form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <?php include(dirname(__FILE__).'/../include/footer.php'); ?>
    </body>
</html>
