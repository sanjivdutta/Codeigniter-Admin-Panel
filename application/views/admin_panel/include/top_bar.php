<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <?php if(isset(getSiteDetails()[2]['field_value'])){ ?>
            <img src="<?php echo base_url(); ?>/uploads/<?php echo getSiteDetails()[2]['field_value']; ?>" height="30" alt="website_logo">
            <?php } else { echo 'Admin Panel'; } ?>
            </a>
            <!-- <a href="javascript:void(0);" id="menu_control"><i class="material-icons">more_vert</i></a> -->
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <?php
                            if($this->session->userdata['profilePic']!=''){
                        ?>
                        <span><img class="topUserImage" src="<?php echo base_url(); ?>/uploads/profileImages/<?php echo $this->session->userdata['profilePic']; ?>" width="48" height="48" alt="User" /></span>
                        <?php } ?>
                        <span class="">Sanjiv Dutta</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="body" style="height: 85px !important;">
                            <ul class="menu tasks">
                                <li><a href="<?php echo base_url().'admin/user/edit/'.customEncrypt($this->session->userdata['userID']); ?>"><i class="material-icons">person</i>Profile</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/logout"><i class="material-icons">input</i>Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>