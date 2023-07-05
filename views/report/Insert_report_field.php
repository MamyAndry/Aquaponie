<body>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6 text-center">
             <h3>Insert Report field</h3>
          </div>
      </div>
      <div class="row justify-content-center">
          <form class="form-control justify-content-center" method="POST" action="<?php echo site_url('report/Field_Report/insert_report_field');?>" enctype="multipart/form-data">
              <div class="row mt-4 mb-3">
                  <div class="row col-md-6 col-lg-6 mt-4 mb-3 justify-content-center">
                      <div class="row mt-2 mb-3">
                        <label for="pond" class="form-label w-25">Pond</label>
                        <select name="id_fish_pond" id="id_fish_pond" name="id_fish_pond" class="form-select w-75">
                            <?php
                                foreach( $ponds as $pond ){ ?>
                                    <option value="<?php echo $pond->id_fish_pond; ?>">
                                        <?php echo $pond->id_fish_pond; ?>
                                    </option>
                            <?php } ?>
                            
                        </select>
                      </div>
                      <div class="row mt-2 mb-3" >
                          <label for="date" class="form-label w-25">Date report</label>
                          <input type="date" class="form-control w-75" name="date" id="max">
                      </div>
                      <div class="row mt-2 mb-3">
                          <label for="alive" class="form-label w-25">Density</label>
                          <input type="number" class="form-control w-75" id="density" name="density">
                      </div>
                      
                  </div>
                  <div class="row col-md-6 col-lg-6 mt-4 mb-3 justify-content-center">
                      <div class="row mt-2 mb-3">
                          <label for="dead" class="form-label w-25">Surface Covered</label>
                          <input type="number" class="form-control w-75" name="dead" id="surface">
                      </div>
                      <div class="row mt-2 mb-3">
                          <label for="category" class="form-label w-25">Plant Weight</label>
                          <input type="file" class="form-control w-75" id="file-input" accept=".csv" name="weight" required>
                      </div>
                      <div class="row mt-2 mb-3">

                      </div>
                  </div>
              </div>
              <div class="row mt-4 mb-3 justify-content-center">
                  <input type="submit" name="submit" class="btn btn-dark w-25">
              </div>
          </form>
      </div>
  </div>
</body>
</html>
