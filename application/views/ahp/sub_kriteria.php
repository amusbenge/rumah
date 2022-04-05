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
            <th scope="col">Sub Kriteria</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($sub_kriteria as $sub) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $sub['nama_sub'] ?></td>
              <td>
                <a href="<?= base_url('index.php/ahp/delete_sub_kriteria/' . $sub['id']) ?>" class="btn btn-danger btn-sm" onclick="confirm('Apakah anda yakin?')">Hapus</a>
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
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Lanjut</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Modal Update Kriteria -->