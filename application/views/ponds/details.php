<div class="container">
	<div class="row">
		<div class="row title p-2 m-3">
			<h3 class="text-center">
				Details For ponds : <span class="h4"> <?php echo $ponds[0]->id_pond ?> </span>
			</h3>
		</div>
		<div class="row details">
			<div class="row fishes">
				<div class="row title">
					<h3 class="text-center"> Fishes insides the pond </h3>
				</div>
				<div class="row contents">
					<div class="card col-lg-6 my-2 p-3 offset-col ml-auto mr-auto">
						<?php foreach ($ponds[0]->details as $detail) { ?>
						<div class="card-title">
							
							<h3 class="text-center">
								Fish: <?php echo $detail->fish->name_type_fish; ?>
							</h3>
						</div>

						<div class="card-body">
							<table class="table">
								<thead>
									<th>Data</th>
									<th></th>
								</thead>
								<tbody>
									<tr>
										<td>Max quantity : </td>
										<td class="text-end">
											<?php echo $detail->max_quantity; ?>
										</td>
									</tr>
									<tr>
										<td>Fish quantity : </td>
										<td class="text-end">
											<?php echo $fish_quantity; ?>
										</td>
									</tr>
									<tr>
										<td></td>
										<td class="text-end">
											<a href="<?php echo site_url('/fish/see/').$detail->id_type_fish; ?>" class="btn btn-primary">
												See about that fish
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<?php } ?>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-title">
	<h3 class="text-center">
		Transaction details
	</h3>
</div>
 <table class="table">
	<thead>
		<tr>
		<th scope="col">name_type_fish</th>
		<th scope="col">quantity</th>
		<th scope="col">insertion_date</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($details as $detail) { ?>
		<tr>
			<td><?php echo $detail['name_type_fish'];?></td>
			<td><?php echo $detail['quantity'];?></td>
			<td><?php echo $detail['insertion_date'];?></td>
		</tr>
		<?php }?>
	</tbody>
</table>