<div class="container">
	<div class="row">
		<div class="row text-title p-2 my-3">
			<h3 class="text-center text-decoration-underline">
				All your fishes Types
			</h3>
		</div>
		<div class=" my-3 row fishes-types d-flex">
			<?php 

				foreach( $fishes as $fish ){ ?>
					<div class="card col-lg-3 shadow p-3 col-md-5 offset-md-1 border-0  col-sm-12 " data-aos="fade-down">
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
												<td class="p-2"> Maturity Period : </td>
												<td class="text-end"> <?php echo $fish->maturity_period; ?> month(s) </td>
											</tr>
											<tr class="">
												<td></td>
												<td class="text-end">
													<a href="" class="btn btn-primary">
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
			<div class="card col-lg-3 shadow border-0 col-md-5 offset-md-1 col-sm-12"  data-aos="zoom-in" data-aos-delay="1000">
				<a href="<?php echo site_url('fish/insert'); ?>" class="links text-decoration-none">
					<div class="card-body">
						<div class="row my-5">
							<div class="img-fluid text-decoration-none text-center">
								<i class="fas fa-plus-circle display-1"></i>
							</div>
							<div class="text-center">
								<p class="text-secondary">
									Add more type of fish
								</p>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>