<div class="container my-2">
        <div class="row card shadow border-0">
            <div class="card-title">
                <div class="row">
                    <div class="row-title">
                        <h3 class="text-center">
                            Insert Report Field
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-center">
                    <div class="col-lg-5 my-2">
                        <form class="form" method="POST" action="<?php echo site_url('report/Field_Report/insert_report_field');?>" enctype="multipart/form-data">
                            <div class="row mt-4 mb-3">
                                <label for="date" class="form-label w-25">Date report</label>
                                <input type="date" class="form-control w-75" name="date" id="date">
                            </div>
                            <div class="row mt-4 mb-3">
                                <label for="density" class="form-label w-25">Density</label>
                                <input type="number" class="form-control w-75" id="density" name="density">
                            </div>
                            <div class="row mt-4 mb-3">
                                <label for="surface" class="form-label w-25">Surface Covered</label>
                                <input type="number" class="form-control w-75" name="surface" id="surface">
                            </div>

                            <div class="row mt-4 mb-3">
                                <label for="id_field_plantation" class="form-label w-25">Field</label>
                                <select name="id_field_plantation" id="id_field_plantation" name="id_field_plantation" class="form-select w-75">
                                    <?php foreach( $fields as $field ){ ?>
                                        <option value="<?php echo $field->id_field_plantation; ?>">
                                        <?php echo $field->id_field_plantation; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="row mt-4 mb-3">
                                <label for="weight" class="form-label w-25">Plant Weight</label>
                                <input type="file" class="form-control w-75" id="file-input" accept=".csv" name="weight" required>                 
                            </div>

                            <div class="row mt-4 mb-3">
                                <input type="submit" value="Insert report field" class="btn btn-dark" name="submit">
                            </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
