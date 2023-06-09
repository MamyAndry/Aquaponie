<header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <!--<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>-->
              <i><img src="<?php echo base_url('assets/images/png/AquaponicV2.png'); ?>" width="5%"></i>
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li class="nav-item">
              <a href="#" class="nav-link <?php echo $header_home; ?>">
                <i class="fa fa-home"></i>
                Home
              </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo $header_product; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-tree"></i>
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
                Ponds
              </a>
                <ul class="dropdown-menu">
                    <li >
                        <a href="<?php echo site_url('pond/Ponds'); ?>" class="dropdown-item">
                            All
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('pond/Fish'); ?>" class="dropdown-item">
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
              <a class="nav-link dropdown-toggle <?php echo $header_ponds; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Statistics
              </a>
                <ul class="dropdown-menu">
                      <li>
                          <a href=<?php echo site_url("statistics/Fish_Statistics"); ?> class="dropdown-item">
                              Fish
                          </a>
                      </li>
                      <li>
                          <a href=<?php echo site_url("statistics/Plantation_Statistics"); ?> class="dropdown-item">
                              Plantation
                          </a>
                      </li>
                  </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle <?php echo $header_ponds; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Report
              </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href=<?php echo site_url("report/Pond_Report"); ?> class="dropdown-item">
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
              <a class="nav-link dropdown-toggle <?php echo $header_ponds; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

          </ul>
        </div>
      </div>
    </div>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-light text-dark me-2">Login</button>
          <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
      </div>
    </div>
 </header>