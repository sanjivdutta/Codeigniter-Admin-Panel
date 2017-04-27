
<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php if($this->uri->segment(2)=='dashboard'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url() ?>admin/dashboard">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li <?php if($this->uri->segment(2)=='setting'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url() ?>admin/setting">
                    <i class="material-icons">settings</i>
                    <span>General Setting</span>
                </a>
            </li>
            <li <?php if($this->uri->segment(2)=='add_user' || $this->uri->segment(2)=='view_user'){ ?> class="active" <?php } ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">supervisor_account</i>
                    <span>Users</span>
                </a>
                <ul class="ml-menu">
                    <li <?php if($this->uri->segment(2)=='add_user'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/add_user">Add User</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='view_user'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/view_user">View User</a>
                    </li>
                </ul>
            </li>
            <li <?php if($this->uri->segment(2)=='add_product' || $this->uri->segment(2)=='view_product' || $this->uri->segment(2)=='product_categories'){ ?> class="active" <?php } ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">shopping_cart</i>
                    <span>Products</span>
                </a>
                <ul class="ml-menu">
                    <li <?php if($this->uri->segment(2)=='add_product'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/add_product">Add Product</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='view_product'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/view_product">View Product</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='product_categories'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/product_categories">Product Categories</a>
                    </li>
                </ul>
            </li>

            <!-- Gallery Section -->

            <li <?php if($this->uri->segment(2)=='add_gallery' || $this->uri->segment(2)=='view_gallery'){ ?> class="active" <?php } ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">add_a_photo</i>
                    <span>Galleries</span>
                </a>
                <ul class="ml-menu">
                    <li <?php if($this->uri->segment(2)=='add_gallery'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/add_gallery">Add Gallery</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='view_gallery'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/view_gallery">View Gallery</a>
                    </li>
                </ul>
            </li>

            <!-- Classified Section -->

            <li <?php if($this->uri->segment(2)=='add_classified' || $this->uri->segment(2)=='view_classified'){ ?> class="active" <?php } ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">account_balance</i>
                    <span>Classifieds</span>
                </a>
                <ul class="ml-menu">
                    <li <?php if($this->uri->segment(2)=='add_classified'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/add_classified">Add Classified</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='view_classified'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/view_classified">View Classifieds</a>
                    </li>
                </ul>
            </li>

            <!-- Testimonial Section -->

            <li <?php if($this->uri->segment(2)=='add_testimonial' || $this->uri->segment(2)=='view_testimonial'){ ?> class="active" <?php } ?>>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">comment</i>
                    <span>Testimonials</span>
                </a>
                <ul class="ml-menu">
                    <li <?php if($this->uri->segment(2)=='add_testimonial'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/add_testimonial">Add Testimonial</a>
                    </li>
                    <li <?php if($this->uri->segment(2)=='view_testimonial'){ ?> class="active" <?php } ?>>
                        <a href="<?php echo base_url() ?>admin/view_testimonial">View Testimonials</a>
                    </li>
                </ul>
            </li>

            <li <?php if($this->uri->segment(2)=='events'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url() ?>admin/events">
                    <i class="material-icons">event</i>
                    <span>Events</span>
                </a>
            </li>

            <li <?php if($this->uri->segment(2)=='viewOrders'){ ?> class="active" <?php } ?>>
                <a href="<?php echo base_url() ?>admin/viewOrders">
                    <i class="material-icons">shop</i>
                    <span>Orders</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <?php if(isset(getSiteDetails()[0]['field_value'])){ ?>
    <div class="legal">
        <div class="copyright">
            <a href="javascript:void(0);"><?php echo getSiteDetails()[0]['field_value']; ?> </a>.
        </div>
    </div>
    <?php } ?>
    <!-- #Footer -->
</aside>