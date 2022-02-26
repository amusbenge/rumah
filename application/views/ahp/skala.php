<div class="container-fluid">
  <h3 class="text-gray-900 mb-2"><?= $title ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">

      <!-- Tombol Tambah skala dengan MODAL -->
      <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#staticBackdrop">
        <i class="fas fa-plus-circle mr-1"></i>
        Tambah
      </button>

      <!-- Pesan SUKSES/TIDAK -->
      <div class="row">
        <div class="col-lg-6">
          <?= $this->session->flashdata('message') ?>
        </div>
      </div>

      <!-- Tabel skala -->
      <table class="table table-bordered text-center display compact nowrap" id="jtable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nomor</th>
            <th scope="col">Nama SKala</th>
            <th scope="col">Bobot</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($data_skala as $skala) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $skala['nama_skala'] ?></td>
              <td><?= $skala['bobot'] ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-circle btn-sm mb-3" data-toggle="modal" data-target="#editSkala<?= $skala['id'] ?>">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
          <!-- akhir LOOPING -->
        </tbody>
      </table>
      <!-- AKHIR tabel -->

    </div>
  </div>

</div>


<!-- Modal Tambah skala -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Tambah Skala</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- FORM isian Data skala -->
        <form action="<?= base_url('ahp/tmbh_skala/') ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="skala">Nama Skala</label>
            <input type="text" class="form-control" id="skala" name="nama_skala" required>
          </div>
          <div class="form-group">
            <label for="bobot">Bobot</label>
            <input type="number" class="form-control" id="skala" name="bobot" required>
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

<!-- Modal Edit Skala -->
<?php foreach ($data_skala as $skala) : ?>
  <div class="modal fade" id="editSkala<?= $skala['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Edit Skala</h5>
          <button type="button" class="close btn-danger" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- FORM isian Data skala -->
          <form action="<?= base_url('ahp/tmbh_skala/') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="skala">Nama Skala</label>
              <input type="text" class="form-control" id="skala" name="nama_skala" value="<?= $skala['nama_skala'] ?>" required>
            </div>
            <div class="form-group">
              <label for="bobot">Bobot</label>
              <input type="number" class="form-control" id="skala" name="bobot" value="<?= $skala['bobot'] ?>" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>