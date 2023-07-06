
<header>
    <main id="header" class="mb-5" style="box-shadow: 0px 4px 13px rgba(0, 0, 0, 0.5);">
        <nav class="navbar navbar-dark bg-dark p-3" aria-label="Dark offcanvas navbar">
            <div class="container-fluid">
                <a href="" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto col-lg-2 col-md-2 col-sm-1 col-3 justify-content-md-start justify-content-center">
                    <!--<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>-->
                    <img src="<?php echo base_url('assets/image/AquaponicV2.png')?>" class="col-lg-2 col-md-2 col-3">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbarDark" aria-labelledby="offcanvasNavbarDarkLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle <?php echo $header_product; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Product
                                </a>
                                <ul class="dropdown-menu">
                                    <li >
                                        <a href="<?php echo site_url('fish'); ?>" class="dropdown-item">
                                            Fish
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo  site_url('plantation')?>" class="dropdown-item">
                                            Plantation
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo $header_ponds; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Field pond
                                </a>
                                <ul class="dropdown-menu">
                                    <li >
                                        <a href="<?php echo site_url('pond/Ponds'); ?>" class="dropdown-item">
                                            Ponds
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('field/Field'); ?>" class="dropdown-item">
                                            Field
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo $header_statistics; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Statistics
                                </a>
                                <ul class="dropdown-menu">
                                    <li >
                                        <a href="<?php echo site_url('statistics/Fish_Statistics'); ?>" class="dropdown-item">
                                            Fish
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('statistics/Plantation_statistics'); ?>" class="dropdown-item">
                                            Plantation
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo $header_sale; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sale
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href=<?php echo site_url("sale/Fish_Sale"); ?> class="dropdown-item">
                                            Fish
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            Plantation
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo $header_report; ?>" role="button" data-bs-toggle="dropdown" data-bs-delay="1000" aria-expanded="false">
                                    Report
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href=<?php echo site_url("report/Pond_Report"); ?> class="dropdown-item">
                                            Fish
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("report/Field_Report"); ?>" class="dropdown-item">
                                            Plantation
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </main>
 </header>
