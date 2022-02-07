<div class="container-fluid">
    <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

    <!-- Isi Dalam bentuk Card -->
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah User dengan MODAL -->
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#staticBackdrop">
                <i class="fas fa-user-plus mr-1"></i>
                Tambah
            </button>

            <!-- Pesan SUKSES/TIDAK -->
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>

            <!-- Tampil Tabel Data Users -->
            <table class="table table-bordered text-center display compact nowrap" id="jtable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">

                    <!-- LOOPING tampil isi tabel users -->
                    <?php
                    $no = 1;
                    foreach ($users as $u) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $u['nama'] ?></td>
                            <td><?= $u['role'] ?><?= ($u['id_dusun'] != null) ? '(' . $u['nama_dusun'] . ')' : '' ?></td>
                            <td><?= $u['jk'] ?></td>
                            <td>
                                <a class="btn btn-warning btn-circle btn-sm" href="<?= base_url('admin/edit_user/') ?><?= $u['id']; ?>" data-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit fa-sm"></i>
                                </a>
                                <!-- JIKA USER YANG SEDANG AKTIF, TOMBOL HAPUS TIDAK MUNCUL -->
                                <?php if ($user['username'] != $u['username']) : ?>
                                    <a href="<?= base_url('admin/hapus_user/') ?><?= $u['id']; ?>" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" title="Hapus" onclick="return confirm('Yakin ingin menghapus User ini?')">
                                        <i class="fas fa-trash fa-sm"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Akhir TABEL -->

        </div>
    </div>

</div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Tambah User</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <!-- FORM isian Data User -->
                    <form action="<?= base_url('admin/tmbh_user/') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="custom-select form-control-sm" id="jk" name="jk" required>
                                <option selected></option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                            <span toggle="#password" class="fa fa-eye pass toggle-pass pt-2 pl-2" data-toggle="tooltip" data-placement="top" title="Lihat Password"></span>
                        </div>
                        <div class="form-group">
                            <label for="tipe">Tipe</label>
                            <select class="custom-select form-control-sm" id="tipe" name="role_id" required>
                                <option selected></option>
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control btn-sm" id="foto" name="foto" required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>