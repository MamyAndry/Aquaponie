<div class="container my-2">
    <?php
    foreach( $plantations as $plantation ) { ?>
        <div class="row card shadow border-0">
            <div class="card-title">
                <div class="row">
                    <div class="row-title">
                        <h5 class="text-center">
                            Type of plantation : <span class="h2"> <?php echo $plantation->name_type_plantation ?> </span>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <h3 class="text-center"> Plantations details </h3>
                    <div class="row justify-content-center">
                        <div class="col-lg-5 my-2">
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
                                    <td><?php echo $plantation->weight_max_baby." ".$unities[0]['nom'];?></td>
                                </tr>
                                <tr>
                                    <td>Maximum weight semi-mature </td>
                                    <td><?php echo $plantation->weight_max_semi_mature." ".$unities[0]['nom'];?></td>
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