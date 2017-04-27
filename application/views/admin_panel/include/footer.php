
<!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/node-waves/waves.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>admin_assets/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/admin.js"></script>


    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <?php if($this->uri->segment(2)=='dashboard'){ ?>
    <!-- Morris Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->

    <script src="<?php echo base_url(); ?>admin_assets/plugins/flot-charts/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <?php } ?>


    <?php if($this->uri->segment(2)=='dashboard'){ ?>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>admin_assets/js/pages/index.js"></script>
    <?php } ?>

    <?php if($this->uri->segment(2)=='add_post' || $this->uri->segment(2)=='post' || $this->uri->segment(2)=='product' || $this->uri->segment(2)=='add_product' || $this->uri->segment(2)=='add_classified' || $this->uri->segment(2)=='classified'  || $this->uri->segment(2)=='updateClassified' || $this->uri->segment(2)=='add_testimonial' || $this->uri->segment(2)=='testimonial'){ ?>
    <!-- JS For Posts -->
    <script src="<?php echo base_url(); ?>admin_assets/js/pages/forms/editors.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/tinymce/tinymce.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/ckeditor/ckeditor.js"></script>
    <!-- JS For Posts -->
    <!-- validator -->
    <!-- Jquery Validation Plugin Css -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-validation/jquery.validate.js"></script>
    <!-- JQuery Steps Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url(); ?>admin_assets/js/pages/forms/form-validation.js"></script>
    <!-- validator -->
    <?php } ?>

    <?php if($this->uri->segment(2)=='view_post' || $this->uri->segment(2)=='categories' || $this->uri->segment(2)=='product_categories' || $this->uri->segment(2)=='view_product'){ ?>
    <!-- Data table -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/pages/ui/tooltips-popovers.js"></script>
    <!-- Data table -->
    <?php } ?>

    <?php if($this->uri->segment(2)=='gallery' && $this->uri->segment(3)=='edit'){ ?>
    <!-- Light Gallery Plugin Js -->
    <script src="<?php echo base_url(); ?>admin_assets/plugins/light-gallery/js/lightgallery-all.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>admin_assets/js/pages/medias/image-gallery.js"></script>
    <?php } if($this->uri->segment(2)=='events' && $this->uri->segment(3)=='') { ?>
        <script src='<?php echo base_url(); ?>/admin_assets/fullcalander/fullcalendar.min.js'></script>
    <?php } if(($this->uri->segment(2)=='events' && $this->uri->segment(3)=='add') || $this->uri->segment(2)=='submitEvent') { ?>
        <!-- Moment Plugin Js -->
        <script src="<?php echo base_url(); ?>/admin_assets/plugins/momentjs/moment.js"></script>
        <!-- Bootstrap Material Datetime Picker Plugin Js -->
        <script src="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>/admin_assets/js/pages/forms/basic-form-elements.js"></script>
    <?php } ?>


    <!-- Chart Plugins Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Custom Js -->
    <!-- <script src="<?php echo base_url(); ?>/admin_assets/js/admin.js"></script>
    <script src="<?php //echo base_url(); ?>/admin_assets/js/pages/charts/chartjs.js"></script> -->