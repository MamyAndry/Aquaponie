<div class="container">
    <div class="row">
        <div class="row title p-2 m-3">
            <h3 class="text-center">
                Details For field : <span class="h4"> <?php echo $field_plantations[0]->id_field_plantation ?> </span>
            </h3>
        </div>
        <div class="row details">
            <div class="row fishes">
                <div class="row title">
                    <h3 class="text-center"> Plantations insides the pond </h3>
                </div>
                <div class="row contents">
                    <div class="card col-lg-6 my-2 p-3 offset-col ml-auto mr-auto">
                        <div class="card-title">
                            <h3 class="text-center">
                                Plantation: <?php echo $field_plantations[0]->name_type_plantation; ?>
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
                                    <td>Maximum : </td>
                                    <td class="text-end">
                                        data
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-end">
                                        <a href="<?php echo site_url('/Plantation/see/').$field_plantations[0]->id_type_plantation; ?>" class="btn btn-primary">
                                            See about that Plantation
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