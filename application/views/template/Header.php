<header>
    <div class="px-3 py-2 bg-dark text-white">
      <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <!--<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>-->
              <i class="fa fa-sad-cry"></i>
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li class="nav-item">
              <a href="#" class="nav-link text-secondary">
                <i class="fa fa-home"></i>
                Home
              </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <li>
              <a href="#" class="nav-link text-secondary">
                Ponds
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-secondary">
                Customers
              </a>
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