<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="row text-title p-2 my-3">
			<h3 class="text-center text-decoration-underline">
				All your fishes Types
			</h3>
		</div>
		<div class=" my-3 row fishes-types d-flex justify-content-center">
            <div class="card col-lg-3 shadow p-3 my-lg-2 col-md-5 offset-md-1 border-0  col-sm-12 "  data-aos="zoom-in">
                <div class="card-body">
                    <div class="row my-lg-5 my-md-3 my-sm-2 my-5">
                        <div class="img-fluid text-decoration-none text-center">
                            <a href="<?php echo site_url('fish/insert'); ?>" class="links text-decoration-none">
                                <i class="fa fa-plus-circle display-1 "></i>
                            </a>
                        </div>
                        <div class="text-center">
                            <p class="text-secondary">
                                Add more type of fish
                            </p>
                        </div>
                    </div>
                </div>
            </div>
			<?php 

				foreach( $fishes as $fish ){ ?>
					<div class="card col-lg-3 shadow p-3 my-lg-2 col-md-5 offset-md-1 border-0  col-sm-12 " data-aos="fade-down" data-aos-delay="100">
						<div class="card-body rounded">
							<div class="row details-rows">
								<div class="title-row row">
									Type Of Fish : <?php echo $fish->name_type_fish; ?>
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
												<td class="p-2"> Maturity Period</td>
												<td class="text-end"> <?php echo $fish->maturity_period." ".$unities[2]['nom']; ?></td>
											</tr>
                                            <tr>
                                                <td class="p-2"> Maturity Length</td>
                                                <td class="text-end"> <?php echo $fish->maturity_size." ".$unities[1]['nom']; ?></td>
                                            </tr>
											<tr class="">
												<td></td>
												<td class="text-end">
													<a href="<?php echo site_url('fish/see/').$fish->id_type_fish; ?>" class="btn btn-primary">
														See more Info
													</a>
												</td>
											</tr>
										</tbody>
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