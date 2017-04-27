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
                            Add User
                            <small>Create Admin/Sub Admin</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('user_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_user');
                        echo form_open_multipart('admin/submitUser', $attributes);
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="fname" placeholder="Enter First Name" requireda>
                            </div><?php echo form_error('fname'); ?>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" requireda>
                            </div><?php echo form_error('lname'); ?>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Enter Username" requireda>
                            </div><?php echo form_error('username'); ?>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email ID" requireda>
                            </div><?php echo form_error('email'); ?>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" requireda>
                            </div><?php echo form_error('password'); ?>
                        </div>
                         <!-- <div class="form-group">
                                    <select class="form-control show-tick" name="postCat" data-live-search="true">
                                        <option value=''>Select role here..</option>
                                        <?php foreach($categories as $cat){ ?>
                                        <option value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                <div class="pull-right marginTop"><a href="<?php echo base_url() ?>admin/user/roles">Click here to add new role</a></div>
                            </div> -->
                            <div class="form-group">
                                <input type="radio" name="status" id="active" value="A" class="with-gap" checked>
                                <label for="active">Active user</label>

                                <input type="radio" name="status" id="inactive" value="I" class="with-gap">
                                <label for="inactive" class="m-l-20">Deactivate User</label>

                            </div><?php echo form_error('status'); ?>

                            <div class="form-group">
                                <input type="radio" name="sex" id="male" value="M" class="with-gap" checked>
                                <label for="male">Male</label>

                                <input type="radio" name="sex" id="female" value="F" class="with-gap">
                                <label for="female" class="m-l-20">Female</label>

                            </div>

                            <div class="form-group form-float">
                                <p>Upload Image</p>
                                   <input type="file" class="form-control" name="user_image">
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea id="ckeditor" class="form-control no-resize" placeholder="Enter Delivery Address" name="delivery_address"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea id="ckeditor" class="form-control no-resize" placeholder="Enter User Bio" name="desc"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT USER</button>
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
