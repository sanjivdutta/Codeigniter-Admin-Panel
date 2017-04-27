<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo SITE_TITLE.'Forget Password Page'; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url(); ?>/admin_assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>/admin_assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin Panel</a>
            <small>Backend Admin Panel</small>
        </div>
        <div class="card">
            <div class="body">
                <?php echo form_open('admin/resetPassword');?>
                    <div class="msg">Enter username to reset password<br/>
                        <span class="col-pink">
                        <?php
                        echo $this->session->flashdata('error_sec');
                        ?>
                        </span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Id" required autofocus>
                        </div>
                        <br><?php echo form_error('email'); ?>
                    </div>
                    <di
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <!-- <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label> -->
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SUBMIT</button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>/admin_assets/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>/admin_assets/js/pages/examples/sign-in.js"></script>
</body>

</html>