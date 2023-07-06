<div class="container">
    <div class="row">
        <div class="row title p-2 m-3">
            <h3 class="text-center">
                Details For field : <span class="h4"> <?php echo $fields[0]->id_field ?> </span>
            </h3>
        </div>
        <div class="row details">
            <div class="row fishes">
                <div class="row title">
                    <h3 class="text-center"> Plantations insides the pond </h3>
                </div>
                <div class="row contents justify-content-center">
                    <div class="card col-lg-6 my-2 p-3 offset-col ml-auto mr-auto">
                        <div class="card-title">
                            <h3 class="text-center">
                                Plantation: <?php echo $fields[0]->details[0]->name_type_plantation; ?>
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
                                    <td>Density : </td>
                                    <td class="text-end">
                                        <?php echo $fields[0]->details[0]->density; ?> plants/m²
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-end">
                                        <a href="<?php echo site_url('/plantation/see/').$fields[0]->details[0]->id_type_plantation; ?>" class="btn btn-primary">
                                            See about that plantation
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>