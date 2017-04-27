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
                            Edit User
                            <small>Edit Admin/Sub Admin</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('record_update');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_update_user');
                        echo form_open_multipart('admin/updateUser', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="fname" value="<?php echo $userDet->fname; ?>" placeholder="Enter First Name" required>
                                    <input type="hidden" class="form-control" name="userID" value="<?php echo $this->uri->segment(4); ?>" >
                                </div><?php echo form_error('fname'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="lname" value="<?php echo $userDet->lname; ?>" placeholder="Enter Last Name" required>
                                </div><?php echo form_error('lname'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" disabled value="<?php echo $userDet->username; ?>" placeholder="Enter Username" require>
                                </div><?php echo form_error('username'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" disabled placeholder="Enter Email ID" value="<?php echo $userDet->email; ?>" required />
                                </div><?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="sex" id="male" value="M" class="with-gap" <?php if($userDet->sex=='M') { ?> checked <?php } ?>>
                                <label for="male">Male</label>

                                <input type="radio" name="sex" id="female" value="F" class="with-gap" <?php if($userDet->sex=='F') { ?> checked <?php } ?>>
                                <label for="female" class="m-l-20">Female</label>

                            </div>
                            <?php if($userDet->profileImage!=''){ ?>
                                <div class="form-group form-float imgDiv">
                                    <p>Upload Image</p>
                                    <img class="customImg" src="<?php echo base_url().'uploads/profileImages/'.$userDet->profileImage; ?>" alt="img_edt_txt" />
                                    <br/>
                                    <a href="<?php echo base_url().'admin/user/image_delete/'.$this->uri->segment(4); ?>" class="btn bg-teal waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">Remove Image</a>
                                </div>
                            <?php } else { ?>

                                <div class="form-group form-float">
                                    <p>Upload Image</p>
                                    <input type="file" class="form-control" name="user_image">
                                    <span><?php if (isset($error)) { echo $error; } ?></span>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea id="ckeditor" class="form-control no-resize" placeholder="Enter Delivery Address" name="delivery_address"><?php echo $userDet->user_address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea id="ckeditor" class="form-control no-resize" placeholder="Enter User Bio" rows="5" name="desc"><?php echo $userDet->user_bio; ?></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">UPDATE USER</button>
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
