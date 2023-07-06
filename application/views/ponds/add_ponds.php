<div class="container">
	<div class="row">
		<div class="col-6 offset-3 p-4 my-box">
			<div class="my-box-title">
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-right-circle-fill" viewBox="0 0 16 16">
                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm5.904-2.803a.5.5 0 1 0-.707.707L9.293 10H6.525a.5.5 0 0 0 0 1H10.5a.5.5 0 0 0 .5-.5V6.525a.5.5 0 0 0-1 0v2.768L5.904 5.197z"/>
            	</svg>  <span style="float: right;">Add new ponds</span>
			</div><hr>
			<div class="contents my-3 p-4">
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