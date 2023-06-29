<div class="container">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Insert type plantation
            </h3>
        </div>
    </div>
    <div class="row m-auto w-50">
        <form class="form" action="<?php echo site_url('plantation/save'); ?>" method="POST">
            <div class="row mt-4 mb-3">
                <label for="type" class="form-label w-50">Type of plantation : </label>
                <input type="text" class="form-control w-50" name="type" id="type">
                <?php echo form_error('type'); ?>
            </div>
            <div class="row mt-4 mb-3">
                <label for="baby" class="form-label w-50">Weight max when baby : </label>
                <input type="text" class="form-control w-50" name="w_max_baby" id="baby">
                <?php echo form_error('w_max_baby'); ?>
            </div>
            <div class="row mt-4 mb-3">
                <label for="semi_mature" class="form-label w-50">Weight max when semi-mature : </label>
                <input type="text" class="form-control w-50" name="w_max_semi_mature" id="semi_mature">
                <?php echo form_error('w_max_semi_mature'); ?>
            </div>

            <div class="row mt-4 mb-3">
                <input type="submit" value="Insert new plantation type" class="btn btn-dark">
            </div>
        </form>

    </div>