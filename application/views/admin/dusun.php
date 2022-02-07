<div class="container-fluid">
    <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

    <!-- Isi Dalam bentuk Card -->
    <div class="card">
        <div class="card-body">

            <!-- Tombol Tambah User dengan MODAL -->
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addDusun">
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
                        <th scope="col">Nama Dusun</th>
                        <th scope="col">Kepala Dusun</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">

                    <!-- LOOPING tampil isi tabel users -->
                    <?php
                    $no = 1;
                    foreach ($dusun as $d) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama_dusun'] ?></td>
                            <td><?= $d['nama'] ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#userDusun_<?= $d['id'] ?>">
                                    <i class="fas fa-recycle fa-sm"></i>
                                </button>
                            </td>
                            <!-- Tambah Ganti Kepala Dusun -->
                            <div class="modal fade" id="userDusun_<?= $d['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                <form action="<?= base_url('admin/tmbh_kepala_dusun/') ?>" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_dusun" value="<?= $d['id'] ?>" class="d-none">
                                                    <input type="hidden" name="jabatan" value="Kepala Dusun" class="d-none">
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
                                                    <input type="hidden" name="role_id" value="3" class="d-none">
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Akhir TABEL -->

        </div>
    </div>

</div>
</div>

<!-- Modal Tambah Dusun -->
<div class="modal fade" id="addDusun" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Tambah Dusun</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <!-- FORM isian Data User -->
                    <form action="<?= base_url('admin/tambah_dusun/') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Dusun</label>
                            <input type="text" class="form-control form-control-sm" id="nama_dusun" name="nama_dusun" required>
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