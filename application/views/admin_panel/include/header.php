<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo SITE_TITLE.ucwords(str_replace('_',' ',$this->uri->segment(2))); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/css/style.css" rel="stylesheet">

    <!-- You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>/admin_assets/css/themes/all-themes.css" rel="stylesheet" />

    <!-- You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>/admin_assets/css/custom.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>/admin_assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <?php if($this->uri->segment(2)=='gallery' && $this->uri->segment(3)=='edit'){ ?>
        <link href="<?php echo base_url(); ?>/admin_assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    <?php } if($this->uri->segment(2)=='events' && $this->uri->segment(3)=='') { ?>
        <link href='<?php echo base_url(); ?>/admin_assets/fullcalander/fullcalendar.min.css' rel='stylesheet' />
        <script src='<?php echo base_url(); ?>/admin_assets/fullcalander/moment.min.js'></script>
    <?php } if(($this->uri->segment(2)=='events' && $this->uri->segment(3)=='add') || $this->uri->segment(2)=='submitEvent') { ?>
    <!-- Bootstrap Material Datetime Picker Css -->
        <link href="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <?php } ?>
</head>
<body class="theme-blue">