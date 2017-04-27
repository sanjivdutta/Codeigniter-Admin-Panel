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
                            View Posts
                            <small></small>
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
                                <th>Post Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Post Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($tblData as $post){ ?>
                            <tr>
                                <td><?php echo $post['post_title']; ?></td>
                                <td><?php getCategory($post['cat_id']); ?></td>
                                <td>
                                   <?php if($post['file_name']!=''){ ?>
                                    <img class="customImg" src="<?php echo base_url().'uploads/postImages/'.$post['file_name'] ?>" alt="<?php echo $post['post_title'].'_image' ?>" />
                                    <?php } ?>
                                </td>
                                <td><?php echo ($post['status']==1)?'<span class="label label-success">Published</span>':'<span class="label label-danger">Not Published</span>'; ?></td>
                                <td><?php echo ($post['created_at']=='0000-00-00 00:00:00')?'Not Mentioned':date('d/m/Y h:i:s',strtotime($post['created_at'])); ?></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/post/edit/'.customEncrypt($post['id']); ?>"  class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View/Edit This Post">
                                        <i class="material-icons">edit</i></a>
                                    </a>
                                    <a href="<?php echo base_url().'admin/post/delete/'.customEncrypt($post['id']); ?>"  class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit This Post" onclick="return confirm('Do you really want to delete this post?')">
                                        <i class="material-icons">delete</i>
                                    </a>
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
