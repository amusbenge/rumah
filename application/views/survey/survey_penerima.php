<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <h2><?= $kk['nm_kpl_kel'] ?></h2>
      <form action="<?= base_url('surveyor/insert_survey') ?>" class="mt-5" method="post">
        <input type="hidden" name="id_alternatif" value="<?= $kk['id_alternatif'] ?>" class="d-none">
        <?php foreach ($data_kriteria as $kriteria) : ?>
          <div class="form-group row">
            <input type="hidden" name="id_kriteria[]" value="<?= $kriteria['id'] ?>">
            <label for="deskripsi_<?= $kriteria['id'] ?>" class="col-sm-4"><?= $kriteria['kriteria'] ?></label>
            <div class="col-sm-8">
              <input type="text" name="deskripsi_<?= $kriteria['id'] ?>" id="" class="form-control" required>
            </div>
          </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-end">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End of Main Content -->