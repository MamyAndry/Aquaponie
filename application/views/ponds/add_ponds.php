<div class="container">
	<div class="row">
		<div class="container">
			<div class="row title">
				<h3 class="text-center">
					Add a new Ponds
				</h3>
			</div>
			<div class="row contents my-3 p-4">
				<div class="col-lg-6 my-auto mx-auto">
					<form action="<?php echo site_url('pond/ponds/add_details'); ?>" method="POST" class="form">
						<div class="mb-3">
							<label for="" class="form-label"> Max quantity for the new Pond : </label>
							<input type="text" class="form-control" name="max_quantity" id="">
						</div>
						<div class="mb-3">
							<!-- <input type="submit" class="btn btn-primary" value="Add new Pond"> -->
							<input type="submit" class="btn btn-primary" value="Next Step">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>