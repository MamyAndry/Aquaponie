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
                        <div class="row justify-content-center">
                            <div class="col-lg-5 my-2">
                                <h4 class="text-center">
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
                                        <td><?php echo $fish->maturity_period." ".$unities[1]['nom'];?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-5 offset-1 my-2">
                                <h4 class="text-center">
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
                                        <td><?php echo $fish->weight_max_little." ".$unities[0]['nom'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Maximum weight average </td>
                                        <td><?php echo $fish->weight_max_average." ".$unities[0]['nom'];?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-5 my-2">
                                <h4 class="text-center">
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
                                        <td><?php echo $fish->size_max_little." ".$unities[2]['nom'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Maximum size average</td>
                                        <td><?php echo $fish->size_max_average." ".$unities[2]['nom'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Size at Maturity</td>
                                        <td><?php echo $fish->maturity_size." ".$unities[2]['nom'];?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
					</div>
				</div>
			</div>

		<?php } ?>
</div>