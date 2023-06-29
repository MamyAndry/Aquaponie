<div class="container my-2">
	<?php
		foreach( $fishes as $fish ) { ?>
			<div class="row card shadow border-0">
				<div class="card-title">
					<div class="row">
						<div class="row-title">
							<h5 class="text-center"> 
								Type of fish : <span class="h2"> <?php echo $fish->name_type_fish ?> </span>
							</h5>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<h3 class="text-center"> Fish details </h3>
						<div class="col-lg-5 my-2">
							<h4>
								Maturity
							</h4>
							<table class="table">
								<thead>
									<th>Data Names</th>
									<th>Data values</th>
								</thead>
								<tbody>
									<tr>
										<td>Maturity Period</td>
										<td>Maturity Period</td>
									</tr>
									<tr>
										<td>Size at Maturity</td>
										<td>Maturity Period</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-5 offset-1 my-2">
							<h4>
								Weights
							</h4>
							<table class="table">
								<thead>
									<th>Data Names</th>
									<th>Data values</th>
								</thead>
								<tbody>
									<tr>
										<td>Maximum weight when Little</td>
										<td>Size at Maturity</td>
									</tr>
									<tr>
										<td>Maximum weight average </td>
										<td>Maturity Period</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-lg-5 my-2">
							<h4>
								Sizes
							</h4>
							<table class="table">
								<thead>
									<th>Data Names</th>
									<th>Data values</th>
								</thead>
								<tbody>
									<tr>
										<td>Maximum size when Little</td>
										<td>Maturity Period</td>
									</tr>
									<tr>
										<td>Maximum size average</td>
										<td>Maturity Period</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>
</div>