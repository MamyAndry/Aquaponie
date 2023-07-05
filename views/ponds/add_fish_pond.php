<style>
  .btn:hover {
    background-color: #0070BC;
    border-color:#0070BC;
    color: #ffffff; 
  }
</style>

<div class="container my-2">
	<div class="row card shadow border-0">
		<div class="card-title">
			<div class="row">
				<div class="row-title">
                    <br>
					<h2 class="text-center">Insert Fish Pond </h2>
				</div>
			</div>
		</div>
		<div class="card-body">
            <div class="row justify-content-center">
                <form class="form-control justify-content-center" method="POST" action="<?php echo site_url('pond/Fish/insert_fish_pond');?>" enctype="multipart/form-data">
                    <div class="row mt-4 mb-3">
                        <div class="row col-md-6 col-lg-6 mt-4 mb-3 justify-content-center">
                            <div class="row mt-2 mb-3" >
                                <label for="pond" class="form-label w-25">Type Fish</label>
                                <select name="id_type_fish" id="id_type_fish" name="id_type_fish" class="form-select w-75">
                                    <?php foreach( $fishs as $fish ){ ?>
                                        <option value="<?php echo $fish->id_type_fish; ?>">
                                    <?php echo $fish->id_type_fish; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="row mt-2 mb-3">
                                <label for="pond" class="form-label w-25">Pond</label>
                                <select name="id_pond" id="id_pond" name="id_pond" class="form-select w-75">
                                    <?php foreach( $ponds as $pond ){ ?>
                                        <option value="<?php echo $pond->id_pond; ?>">
                                    <?php echo $pond->id_pond; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row col-md-6 col-lg-6 mt-4 mb-3 justify-content-center">
                            <div class="row mt-2 mb-3">
                                <label for="pond" class="form-label w-25">Fish gender</label>
                                <select name="fish_gender" id="fish_gender" name="fish_gender" class="form-select w-75">
                                    <option value="t">Female</option>
                                    <option value="f">Male</option>
                                </select>
                            </div>
                            <div class="row mt-2 mb-3">
                                <label for="category" class="form-label w-25">Quantity</label>
                                <input type="number" class="form-control w-75" id="quantity" name="quantity">
                            </div>
                            <div class="row mt-2 mb-3">
                                <label for="category" class="form-label w-25">Date</label>
                                <input type="date" class="form-control w-75" id="date" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 justify-content-center">
                        <input type="submit" name="submit" class="btn btn-dark w-25 btn" value="Insert">
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
