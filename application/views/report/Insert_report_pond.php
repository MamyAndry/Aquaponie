<div class="container my-2">
        <div class="row card shadow border-0">
            <div class="card-title">
                <div class="row">
                    <div class="row-title">
                        <h3 class="text-center">
                            Insert Report Pond
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-center">
                    <div class="col-lg-5 my-2">
                        <form class="form" method="POST" action="<?php echo site_url('report/Pond_Report/insert_report_pond');?>" enctype="multipart/form-data">
                            <div class="row mt-4 mb-3">
                                <label for="date" class="form-label w-25">Date report</label>
                                <input type="date" class="form-control w-75" name="date" id="date">
                            </div>
                            <div class="row mt-4 mb-3">
                                <label for="alive" class="form-label w-25">Alive Fish</label>
                                <input type="number" class="form-control w-75" id="fish" name="alive">
                            </div>
                            <div class="row mt-4 mb-3">
                                <label for="dead" class="form-label w-25">Dead Fish</label>
                                <input type="number" class="form-control w-75" name="dead" id="dead">
                            </div>

                            <div class="row mt-4 mb-3">
                                <label for="pond" class="form-label w-25">Pond</label>
                                <select name="id_fish_pond" id="id_fish_pond" name="id_fish_pond" class="form-select w-75">
                                    <?php foreach( $ponds as $pond ){ ?>
                                        <option value="<?php echo $pond->id_fish_pond; ?>">
                                        <?php echo $pond->id_fish_pond; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="row mt-4 mb-3">
                                <label for="category" class="form-label w-25">Category</label>
                                <input type="file" class="form-control w-75" id="file-input" accept=".csv" name="category" required>                 
                            </div>

                            <div class="row mt-4 mb-3">
                                <input type="submit" value="Insert report pond" class="btn btn-dark" name="submit">
                            </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
