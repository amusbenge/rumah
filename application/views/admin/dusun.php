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
                                <a class="btn btn-info btn-sm btn-edit" href="#" data-id="<?= $d['id']; ?>" data-dusun="<?= $d['nama_dusun']; ?>" data-iduser="<?= $d['id_user']; ?>">
                                    <i class="fas fa-recycle fa-sm"></i>
                                </a>
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
                        <div class="form-group">
                            <label for="id_user"> - Pilih Kepala Dusun - </label>
                            <select class="custom-select form-control-sm" id="id_user" name="id_user" required>
                                <option selected>Pilih Kepala Dusun</option>
                                <?php foreach ($kep_dusun as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
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

<!-- Modal Ganti Kep Dusun -->
<div class="modal fade" id="updateDusun" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Ganti Kep. Dusun</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <!-- FORM isian Data User -->
                    <form action="<?= base_url('admin/update_dusun') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Dusun</label>
                            <input type="text" class="form-control form-control-sm nama_dusun" id="nama_dusun" name="nama_dusun" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_user">Pilih Kepala Dusun</label>
                            <select class="custom-select form-control-sm id_user" id="id_user" name="id_user" required>
                                <option selected> - Pilih Kepala Dusun - </option>
                                <?php foreach ($kep_dusun as $k) : ?>
                                    <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="id" name="id" class="id">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>