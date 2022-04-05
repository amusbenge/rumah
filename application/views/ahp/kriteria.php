<div class="container-fluid">
  <h3 class="text-gray-900 mb-2"><?= $title ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">

      <!-- Tombol Tambah Kriteria dengan MODAL -->
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

      <!-- Tabel Kriteria -->
      <table class="table table-bordered text-center display compact nowrap" id="jtable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nomor</th>
            <th scope="col">Kriteria</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($kriteria as $k) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $k['kriteria'] ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateKriteria<?= $k['id'] ?>">
                  update
                </button>
                <?php if ($k['punya_sub'] == 1) : ?>
                  <a href="<?= base_url('index.php/ahp/sub_kriteria/' . $k['id']) ?>" class="btn btn-info btn-sm">Sub Kriteria</a>
                <?php endif; ?>
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
</div>

<!-- Modal Tambah Kriteria -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-gray-900" id="staticBackdropLabel">Tambah Kriteria</h5>
        <button type="button" class="close btn-danger" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- FORM isian Data Kriteria -->
        <form action="<?= base_url('ahp/tmbh_kriteria/') ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="kriteria">Kriteria</label>
            <input type="text" class="form-control" id="kriteria" name="kriteria" required>
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

<!-- Modal Update Kriteria -->
<?php foreach ($kriteria as $k) : ?>
  <div class="modal fade" id="updateKriteria<?= $k['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateKriteriaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-gray-900" id="updateKriteriaLabel">Tambah Kriteria</h5>
          <button type="button" class="close btn-danger" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- FORM isian Data Kriteria -->
          <form action="<?= base_url('ahp/update_kriteria/') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_kriteria" value="<?= $k['id'] ?>">
            <div class="form-group">
              <label for="kriteria">Kriteria</label>
              <input type="text" class="form-control" name="kriteria" value="<?= $k['kriteria'] ?>" required>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" name="punya_sub" class="form-check-input" id="punya_sub<?= $k['id'] ?>" onclick="setJumlah(<?= $k['id'] ?>)" <?= ($k['punya_sub'] == 1) ? 'checked' : '' ?>>
              <label class="form-check-label" for="punya_sub">Punya Sub</label>
            </div>
            <div class="form-group">
              <label for="jumlah">Tambah Sub</label>
              <input type="number" name="jumlah" id="jumlah<?= $k['id'] ?>" value="0" class="form-control" <?= ($k['punya_sub'] == 0) ? 'disabled' : '' ?>>
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
<?php endforeach; ?>