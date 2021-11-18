<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">

                    <?= form_open_multipart('admin/update_kepkel/' . $kepkel['no_kk']); ?>

                    <div class="form-group row">
                        <label for="no_kk" class="col-sm-4 col-form-label">No Kartu Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_kk" value="<?= $kepkel['no_kk'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nm_kpl_kel" class="col-sm-4 col-form-label">Nama Kepala Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nm_kpl_kel" value="<?= $kepkel['nm_kpl_kel'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $kepkel['alamat'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rt" class="col-sm-4 col-form-label">RT / RW</label>
                        <div class="col-sm-2">
                            <input type="text" id="rt" class="form-control" name="rt" value="<?= $kepkel['rt'] ?>" required>
                        </div> /
                        <div class="col-sm-2">
                            <input type="text" id="rw" class="form-control" name="rw" value="<?= $kepkel['rw'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desa" class="col-sm-4 col-form-label">Desa</label>
                        <div class="col-sm-8">
                            <input type="text" id="desa" class="form-control" name="desa" value="<?= $kepkel['desa'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kec" class="col-sm-4 col-form-label">Kecamatan</label>
                        <div class="col-sm-8">
                            <input type="text" id="kec" class="form-control" name="kec" value="<?= $kepkel['kec'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kab" class="col-sm-4 col-form-label">Kabupaten</label>
                        <div class="col-sm-8">
                            <input type="text" id="kab" class="form-control" name="kab" value="<?= $kepkel['kab'] ?>" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning text-gray-900">Edit</button>
                    </div>

                    <?= form_close(); ?>

                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End of Main Content -->