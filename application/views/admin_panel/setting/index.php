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
                            Website Setting
                            <small>Add all your Website/Admin Panel related data here.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('setting_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/submitSetting', $attributes);
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="footer_text" <?php if(isset($footerText) && !empty($footerText)){ ?> value="<?php echo $footerText->field_value; ?>" <?php } ?> />
                                <?php if(isset($footerText) && empty($footerText)){ ?>
                                <label class="form-label">Footer Text</label>
                                <?php } ?>
                            </div><small>Footer Text</small>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="copyright_text"  <?php if(isset($copyrightText) && !empty($copyrightText)){ ?> value="<?php echo $copyrightText->field_value; ?>" <?php } ?> />
                                <?php if(isset($copyrightText) && empty($copyrightText)){ ?>
                                <label class="form-label">Copyright Text</label>
                                <?php } ?>
                            </div><small>Copyright Text</small>
                        </div>
                        <?php if(isset($siteImage) && !empty($siteImage)){ ?>
                            <div class="form-group form-float imgDiv">
                                <p>Uploaded Logo</p>
                                <img class="customImg" src="<?php echo base_url().'uploads/'.$siteImage->field_value ?>" alt="img_edt_txt" />
                                <br/>
                                <a href="<?php echo base_url().'admin/setting/image_delete/'.customEncrypt($siteImage->id); ?>" class="btn bg-teal waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">Remove Image</a>
                            </div>
                        <?php } else { ?>
                        <div class="form-group form-float">
                            <p>Upload Logo</p>
                               <input type="file" class="form-control" name="site_logo_image">
                            <span><?php if (isset($error)) { echo $error; } ?></span>
                        </div>
                        <?php } ?>
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT SETTING</button>
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
