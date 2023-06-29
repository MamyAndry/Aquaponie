<div class="container">
    <div class="row">
        <div class="row text-title p-2 my-3">
            <h3 class="text-center text-decoration-underline">
                All your plantations Types
            </h3>
        </div>
        <div class=" my-3 row fishes-types d-flex">
            <?php

            foreach( $plantations as $plantation ){ ?>
                <div class="card col-lg-3 shadow p-3 col-md-5 offset-md-1 border-0  col-sm-12 " data-aos="fade-down">
                    <div class="card-body rounded">
                        <div class="row details-rows">
                            <div class="title-row row">
                                Type of plantation : <?php echo $plantation->name_type_plantation; ?>
                            </div>
                            <div class="row"></div>
                            <div class="row fish-details">
                                <table class="table">
                                    <thead>
                                    <th> Data </th>
                                    <th> </th>
                                    </thead>
                                    <tbody>
                                    <tr >
                                        <td class="p-2">Weight max when baby</td>
                                        <td class="text-end"> <?php echo $plantation->weight_max_baby; ?> KG</td>
                                    </tr>
                                    <tr>
                                        <td class="p-2"> Weight max semi-mature</td>
                                        <td class="text-end"> <?php echo $plantation->weight_max_semi_mature; ?> KG</td>
                                    </tr>
                                    <tr class="">
                                        <td></td>
                                        <td class="text-end">
                                            <a href="" class="btn btn-primary">
                                                See more Info
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="card col-lg-3 shadow border-0 col-md-5 offset-md-1 col-sm-12"  data-aos="zoom-in" data-aos-delay="1000">
                <div class="card-body">
                    <div class="row my-5">
                        <div class="img-fluid text-decoration-none text-center">
                            <a href="<?php echo site_url('plantation/insert'); ?>" class="links text-decoration-none">
                                <i class="fa fa-plus-circle display-1"></i>
                            </a>
                        </div>
                        <div class="text-center">
                            <p class="text-secondary">
                                Add more type of plantation
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>