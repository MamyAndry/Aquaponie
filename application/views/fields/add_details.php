<div class="container">

    <!-- Tokony hoe apoitra eto ny anaran'ilay izy rehefa azo ampidirina -->

    <div class="row">
        <h3 class="text-center">
            Available details
        </h3>
        <form action="" class="form" id="general-form">
            <table class="table">
                <thead>
                <th> Density of field </th>
                <th> Surface recovered </th>
                <th> Density of field </th>
                <th> Plants </th>
                <th> Plants weight </th>
                <th> Date insertion </th>
                </thead>
                <tbody id="details-container">
                </tbody>
            </table>
        </form>

        <div class="col-lg-4  d-flex">
            <button type="button mx-3" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add new Details
            </button>

            <button class="btn btn-danger" onclick="removeAllDetails()">
                Remove all details
            </button>

            <!-- Ito no manantso ny tena izy, Izany hoe manantso AJAX ito andao ary -->
            <button class="btn btn-success" onclick="validate_ponds('<?php echo site_url('pond/ponds/save'); ?>')">
                Add the new Ponds
            </button>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="form" id="form-modal">
                        <div class="row text-center">
                            <h3 class="text-center">
                                Add new Details
                            </h3>
                        </div>
                        <div class="my-3">
                            <label for="" class="form-label"> Density of the field </label>
                            <input type="text" id="density" name="density" class="form-control">
                        </div>
                        <div class="my-3">
                            <label for="" class="form-label"> Max quantity of that fish </label>
                            <input type="text" id="quantity" name="max_quantity" class="form-control">
                        </div>
                        <div class="my-3">
                            <select name="fish" id="fish" class="form-select">
                                <?php
                                foreach( $plantations as $plantation ){ ?>
                                    <option value="<?php echo $plantation->name_type_plantation; ?>">
                                        <?php echo $plantation->name_type_plantation; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="my-3">
                            <label for="" class="form-label"> Plant weight </label>
                            <input type="text" id="quantity" name="max_quantity" class="form-control">
                        </div>
                        <div class="my-3">
                            <label for="" class="form-label"> Date </label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary" onclick="addDetails()" data-bs-dismiss="modal">Add details</button>
                </div>
            </div>
        </div>
    </div>

</div>