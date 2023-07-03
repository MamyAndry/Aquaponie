<div class="container">
	<div class="row justify-content-center">
		<div class="row text-title p-2 m-3">
			<h3 class="text-center text-decoration-underline">
				Lists of all ponds
			</h3>
		</div>
		<div class=" my-3 row fishes-types d-flex justify-content-center">
            <?php
            foreach( $ponds as $pond ){ ?>
                <div class="card col-lg-4 shadow p-3 my-2 col-md-5 offset-md-1 border-0  col-sm-12 " data-aos="fade-down">
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
                                                <a href="" class="btn btn-dark">
                                                    Add Fishes      
                                                </a>   
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
            <div class="card col-lg-4 shadow p-3 my-lg-2 col-md-5 offset-md-1 border-0  col-sm-12 "  data-aos="zoom-in" data-aos-delay="1000">
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
        </div>
	</div>
</div>