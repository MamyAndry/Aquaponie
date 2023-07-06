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
                    <h2 class="text-center">Insert Sale Plantation </h2>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <form class="form-control justify-content-center" method="POST" action="<?php echo site_url('sale/Plantation_Sale/insert_sale_plantation');?>" enctype="multipart/form-data">
                    <div class="row mt-4 mb-3">
                        <div class="row mt-2 mb-3" >
                            <label for="id_field" class="form-label w-25">Field</label>
                            <select name="id_field" id="id_field" name="id_field" class="form-select w-75">
                                <?php foreach( $fields as $field ){ ?>
                                    <option value="<?php echo $field->id_field_plantation; ?>">
                                        <?php echo $field->id_field_plantation; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row mt-2 mb-3">
                            <label for="quantity" class="form-label w-25">Quantity Sold</label>
                            <input type="number" class="form-control w-75" id="quantity" name="quantity">
                        </div>
                        <div class="row mt-2 mb-3">
                            <label for="date" class="form-label w-25">Date</label>
                            <input type="date" class="form-control w-75" id="date" name="date">
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
