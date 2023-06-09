<div class="container">
    <div class="row">
        <div class="row title">
            <h3 class="text-center">
                Insert type fish
            </h3>
        </div>
    </div>
    <div class="row m-auto w-50">
        <form class="form" action="<?php echo site_url('fish/save'); ?>" method="POST">
            <div class="row mt-4 mb-3">
                <label for="type" class="form-label w-50">Type of fish : </label>
                <input type="text" class="form-control w-50" name="type" id="type">
                <?php echo form_error('type'); ?>
            </div>
            <div class="row mt-4 mb-3">
                <label for="period" class="form-label w-50">Maturity period : </label>
                <input type="text" class="form-control w-50" name="m_period" id="period">
                <?php echo form_error('m_period'); ?>
            </div>
            <div class="row mt-4 mb-3">
                <label for="length" class="form-label w-50">Maturity length : </label>
                <input type="text" class="form-control w-50" name="m_length" id="length">
                <?php echo form_error('m_length'); ?>
            </div>

            <div class="row mt-4 mb-3">
                <label for="m-size" class="form-label w-50">Size at maturity : </label>
                <input type="text" class="form-control w-50" name="m_size" id="m-size">
                <?php echo form_error('m_size'); ?>
            </div>


            <div class="row mt-4 mb-3">
                <label for="w-baby" class="form-label w-50">Max weight when baby : </label>
                <input type="text" class="form-control w-50" name="w_max_baby" id="w-baby">
                <?php echo form_error('w_max_baby'); ?>
            </div>

            <div class="row mt-4 mb-3">
                <label for="avg-max" class="form-label w-50">Average max weight : </label>
                <input type="text" class="form-control w-50" name="w_max_avg" id="avg-max">
                <?php echo form_error('w_max_avg'); ?>
            </div>


            <div class="row mt-4 mb-3">
                <label for="size-baby" class="form-label w-50">Max Size when baby : </label>
                <input type="text" class="form-control w-50" name="s_max_baby" id="size-baby">
                <?php echo form_error('s_max_baby'); ?>
            </div>


            <div class="row mt-4 mb-3">
                <label for="size-average" class="form-label w-50">Max Size Average : </label>
                <input type="text" class="form-control w-50" name="s_max_avg" id="size-average">
                <?php echo form_error('s_max_avg'); ?>
            </div>

            <div class="row mt-4 mb-3">
                <input type="submit" value="Insert new Fish Type" class="btn btn-dark">
            </div>
    </form>
    
</div>