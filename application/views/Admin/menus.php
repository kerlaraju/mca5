<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= base_url("index.php/dashboard")?>" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard

                </p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa fa-database"></i>
                <p>
                    Masters
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/category"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Category</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/brand"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Brand</p>
                    </a>
                </li>

            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/alert_messages"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Alert Message</p>
                    </a>
                </li>

            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/product_master"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>product </p>
                    </a>
                </li>

            </ul>



            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/state_master"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>State</p>
                    </a>
                </li>

            </ul>



            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/district_master"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>District</p>
                    </a>
                </li>

            </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/vendor_rating"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vendor</p>
                    </a>
                </li>

            </ul>
             <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/radius_master"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Radius</p>
                    </a>
                </li>

            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url("index.php/banners"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Banner</p>
                    </a>
                </li>

            </ul>
            

            
        </li>

        <li class="nav-header">USERS</li>
        <li class="nav-item">
            <a href="<?= base_url('index.php/vendors'); ?>" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    User Operations

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('index.php/add_vendor'); ?>" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Add Vendors
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('index.php/approve_vendor'); ?>" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Approve Vendors
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url("index.php/logout");?>" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->