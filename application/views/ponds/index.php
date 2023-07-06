<div class="px-3 py-3 border-bottom mb-3">
    <div class="container d-flex flex-wrap justify-content-center">
        <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end mx-2">
            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#report">
                Add report
            </a>
        </div>
        <div class="text-end">
            <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#sale">
                <i class="fa fa-cart-shopping"></i>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="row text-title p-2 m-3">
			<h3 class="text-center text-decoration-underline">
				Lists of all ponds
			</h3>
		</div>
		<div class=" my-3 row fishes-types d-flex justify-content-center">
            <div class="card col-lg-3 shadow p-3 my-lg-2 col-md-5 mx-5 mx-sm-0 mx-md-3 mx-lg-5 border-0  col-sm-12 "  data-aos="zoom-in">
                <div class="card-body">
                    <div class="row my-lg-5 my-md-3 my-sm-2 my-5">
                        <div class="img-fluid text-decoration-none text-center">
                            <a href="<?php echo site_url('pond/Ponds/insert'); ?>" class="links text-decoration-none">
                                <i class="fa fa-plus-circle display-1"></i>
                            </a>
                        </div>
                        <div class="text-center">
                            <p class="text-secondary">
                                Insert a new Pond
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            foreach( $ponds as $pond ){ ?>
                <div class="card col-lg-3 shadow p-3 my-2 col-md-5 mx-5 mx-sm-0 mx-md-3 mx-lg-5 border-0  col-sm-12      " data-aos="fade-down" data-aos-delay="100">
                    <div class="card-body rounded">
                        <div class="row details-rows">
                            <div class="title-row row">
                                Ponds Id : <span class="h4"><?php echo $pond->id_pond; ?></span>
                            </div>
                            <div class="row"></div>
                            <div class="row fish-details">
                                <table class="table">
                                    <thead>
                                    <th> Data </th>
                                    <th> </th>
                                    </thead>
                                    <tbody>
                                    <tr >
                                        <td class="p-2">Maximum Capacity</td>
                                        <td class="text-end"> <?php echo $pond->capacity; ?></td>

                                    </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        	<td>
                                            </td>
                                        	<td class="text-end">
                                        		<a href="<?php echo base_url('pond/Ponds/see')?>/<?php echo $pond->id_pond;?>" class="btn btn-primary">
                                        			See Details
                                        		</a>
                                        	</td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <a href="#header" id="backToTopButton" class="btn-back-to-top position-fixed bottom-0 end-0 mb-4 me-4 col-1 d-none" style="z-index: 9999;">
                <i class="fa fa-arrow-alt-circle-up display-1 text-dark-emphasis"></i>
            </a>
        </div>
	</div>
</div>

<!-- Modal-report -->
<div class="modal fade" id="report" tabindex="-1" aria-labelledby="report" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="report">Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('report/Pond_Report') ?>" method="get" class="form" id="form-modal">
                <div class="modal-body">
                    <div class="row text-center">
                        <h3 class="text-center">
                            Add report
                        </h3>
                    </div>
                    <div class="my-3">
                        <select name="fish" id="fish" class="form-select">
                            <?php foreach ($ponds as $pond){ ?>
                                <option value="<?php echo $pond->id_pond; ?>"> <?php echo $pond->id_pond; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"> Add </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal report end -->

<!-- Modal-sale -->
<div class="modal fade" id="sale" tabindex="-1" aria-labelledby="sale" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sale">Sale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('sale/Fish_Sale');?>" method="get" class="form" id="form-modal">
                <div class="modal-body">
                    <div class="row text-center">
                        <h3 class="text-center">
                            Add sale
                        </h3>
                    </div>
                    <div class="my-3">
                        <select name="id_pond" id="id_pond" class="form-select">
                            <?php foreach ($ponds as $pond){ ?>
                                <option value="<?php echo $pond->id_pond; ?>"> <?php echo $pond->id_pond; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"> Add </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal sale end -->