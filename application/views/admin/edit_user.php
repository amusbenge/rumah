<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-900"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10">

                    <?= form_open_multipart('admin/update_user/' . $users['id']); ?>

                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" value="<?= $users['nama'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select type="text" id="jk" class="form-control" name="jk" value="<?= $users['jk'] ?>" required>
                                <option></option>
                                <option value="Pria" <?= set_select('jk', 'Pria', (bool)($users['jk'] == 'Pria')) ?>>Pria</option>
                                <option value="Wanita" <?= set_select('jk', 'Wanita', (bool)($users['jk'] == 'Wanita')) ?>>Wanita</option>
                            </select>
                        </div>
                    </div>
                    <?php if ($user['id'] == $users['id'] && $users['role_id'] != '3') : ?>
                        <input type="hidden" name="tipe" value="Admin">
                    <?php else : ?>
                        <div class="form-group row">
                            <label for="role_id" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?= $role['id'] ?>" <?= set_select('role_id', $role['id'], (bool)($role['id'] == $users['role_id'])) ?>><?= $role['role'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?= base_url('assets/img/auth/user/') . $users['foto']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="foto">Pilih File</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-warning text-gray-900">Edit</button>
                        </div>
                    </div>

                    <?= form_close(); ?>

                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- End of Main Content -->