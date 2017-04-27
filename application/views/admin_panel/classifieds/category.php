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
                            View Categories
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('category_view');
                        $attributes = array('id' => 'form_validation_add_category');
                        echo form_open('admin/submitClassifiedCategory', $attributes);
                        ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="cat_name" required>
                                <label class="form-label">Category Name</label>
                            </div><br><?php echo form_error('cat_name'); ?>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT CATEGORY</button>
                        <?php form_close(); ?>
                    </div>

                    <div class="body">
                        <?php if(!empty($categories)){ ?>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Category Name</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($categories as $cat){ ?>
                            <tr>
                                <td><?php echo $cat['cat_name']; ?></td>
                                <td><?php echo ($cat['created_at']=='0000-00-00 00:00:00')?'Not Mentioned':date('d/m/Y h:i:s',strtotime($cat['created_at'])); ?></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/classified/category/edit/'.customEncrypt($cat['id']); ?>"  class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit This Business">
                                        <i class="material-icons">edit</i></a>
                                    </a>
                                    <a href="<?php echo base_url().'admin/classified/category/delete/'.customEncrypt($cat['id']); ?>"  class="btn btn-danger btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete This Business" onclick="return confirm('Do you really want to delete this Business?')">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <?php } else { echo 'No categories are added!'; } ?>
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
