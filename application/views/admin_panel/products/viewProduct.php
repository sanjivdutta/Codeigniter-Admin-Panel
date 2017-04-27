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
                            View Products
                            <small></small>
                        </h2>
                    </div>
                    <?php //print_r($tblData); ?>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('record_update');
                        if(!empty($tblData)){
                        ?>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($tblData as $post){ ?>
                            <tr>
                                <td><?php echo $post['pid']; ?></td>
                                <td><?php echo $post['pname']; ?></td>
                                <td><?php getProductCategory($post['productCat']); ?></td>
                                <td><?php echo ($post['status']==1)?'<span class="label label-success">Published</span>':'<span class="label label-danger">Not Published</span>'; ?></td>
                                <td><?php echo ($post['created_at']=='0000-00-00 00:00:00')?'Not Mentioned':date('d/m/Y h:i:s',strtotime($post['created_at'])); ?></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/product/edit/'.customEncrypt($post['id']); ?>"  class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View/Edit This Product">
                                        <i class="material-icons">edit</i></a>
                                    </a>
                                    <a href="<?php echo base_url().'admin/product/delete/'.customEncrypt($post['id']); ?>"  class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit This Product" onclick="return confirm('Do you really want to delete this Product?')">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { echo 'No product(s) are added!'; } ?>
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
