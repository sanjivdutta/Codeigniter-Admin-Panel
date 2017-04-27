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
                            View User
                            <small>Admin/Sub Admin List</small>
                        </h2>
                    </div>
                    <?php //print_r($tblData); ?>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('record_update');
                        ?>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Blocked</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Blocked</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($tblData as $user){ ?>
                            <tr>
                                <td><?php echo $user['fname']; ?></td>
                                <td><?php echo $user['lname']; ?></td>
                                <td>
                                   <?php if($user['profileImage']!=''){ ?>
                                    <img class="customImg" src="<?php echo base_url().'uploads/profileImages/'.$user['profileImage'] ?>" alt="<?php echo $user['fname'].'_image' ?>" />
                                    <?php } ?>
                                </td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo ($user['block']=='N')?'<span class="label label-success">No</span>':'<span class="label label-danger">Yes</span>'; ?></td>
                                <td>
                                    <?php if($user['id']!=$this->session->userdata('userID')){ ?>
                                    <a href="<?php echo base_url().'admin/user/edit/'.customEncrypt($user['id']); ?>"  class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View/Edit This User">
                                        <i class="material-icons">edit</i></a>
                                    </a>
                                    <a href="<?php echo base_url().'admin/user/delete/'.customEncrypt($user['id']); ?>"  class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit This User" onclick="return confirm('Do you really want to delete this user?')">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    <?php } else { echo 'No Access';; } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
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
