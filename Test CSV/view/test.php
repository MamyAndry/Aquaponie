<div class="col-lg-5" style="width: 130%;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Importer des nouveaux</h5>
            <form  action="http://localhost/Aquaponie-main/Fish/testFunction" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="custom-file-upload">
                        <input type="file" name="file" id="file-input" size="20" />
                        <i class="fa fa-cloud-upload"></i> Choisissez un fichier
                    </label>
                </div>
                <p><input type="submit" name="submit" value="ajouter">
                <!-- <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary" style="margin-left: 90%;">Ajouter</button>
                    </div>
                </div> -->
            </form>
        </div>
    </div>
</div>