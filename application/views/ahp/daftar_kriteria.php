<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>
  <?= $this->session->flashdata('pesan'); ?>

  <!-- Isi Dalam bentuk Card -->
  <div class="row">
    <?php foreach ($data_kriteria as $kriteria) : ?>
      <div class="col-md-3 mb-5">
        <div class="card h-100 card-primary">
          <div class="card-body text-center">
            <?php if ($kriteria['jumlah_perbandingan'] > 0) : ?>
              <h5 class="text-success"><i class="fas fa-check-circle"></i></h5>
            <?php else :  ?>
              <h5 class="text-warning mb-4"><i class="fas fa-exclamation-triangle"></i></h5>
            <?php endif ?>
            <h3 class="text-dark"><?= $kriteria['kriteria'] ?></h3>
          </div>
          <div class="card-header text-center">
            <?php if ($kriteria['jumlah_perbandingan'] > 0) : ?>
            <?php else :  ?>
              <a href="<?= base_url('ahp/perhitungan/' . $dusun['id'] . '/' . $kriteria['id']) ?>" class="btn btn-circle btn-sm btn-secondary"><i class="fas fa-cog"></i></a>
            <?php endif ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<!-- End of Main Content -->