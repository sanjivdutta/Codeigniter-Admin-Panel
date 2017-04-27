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
                            Add Event
                            <small>Add new event here.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <?php
                            $attributes = array('id' => 'form_validation_add_event');
                            echo form_open_multipart('admin/submitEvent', $attributes);
                            ?>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" name="title" placeholder="Enter event name" type="text" required="required">
                                        </div>
                                        <?php echo form_error('title'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="datepicker_na datetimepicker form-control" name="start_date" required="required" placeholder="Please choose start date..." data-dtp="dtp_NiD8M" type="text">
                                        </div>
                                        <?php echo form_error('start_date'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="datetimepicker form-control" name="end_date" placeholder="Please choose end date..." data-dtp="dtp_NiD8M" type="text">
                                        </div>
                                        <small>Leave this space empty if you are adding a single day event.</small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea class="form-control" name="details" placeholder="Enter Event Details Here"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-primary waves-effect pull-right" type="submit">SUBMIT EVENT</button>
                                </div>
                            <?php form_close(); ?>
                        </div>
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
