<div class="container-fluid">
  <h3 class="text-gray-900 mb-2"><?= $title ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">


      <!-- Pesan SUKSES/TIDAK -->
      <div class="row">
        <div class="col-lg-6">
          <?= $this->session->flashdata('message') ?>
        </div>
      </div>

      <!-- Form Sub Kriteria -->

      <form action="<?= base_url('index.php/ahp/simpan_sub_kriteria') ?>" method="post">
        <?php for ($i = 0; $i < $jumlah; $i++) : ?>
          <input type="hidden" name="id_kriteria" value="<?= $id ?>">
          <div class="form-group">
            <label for="sub_kriteria[]">Sub Kriteria <?= $i + 1 ?></label>
            <input type="text" name="sub_kriteria[]" id="" class="form-control" required>
          </div>
        <?php endfor; ?>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>

      <!-- End Form -->

    </div>
  </div>

</div>