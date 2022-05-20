<div class="container-fluid">
  <div class="card mb-2">
    <div class="card-body">
      <div class="text-center">
        <img src="<?= base_url('assets/img/icon/logo1.jpg') ?>" alt="" class="d-none d-md-inline img-fluid mr-2 mb-4" width="80px">
        <img src="<?= base_url('assets/img/icon/logo2.png') ?>" alt="" class="d-none d-md-inline img-fluid mr-2 mb-4" width="80px">
        <img src="<?= base_url('assets/img/icon/logo3.png') ?>" alt="" class="d-none d-md-inline img-fluid mr-2 mb-4" width="80px">
        <h4 class="mb-2 text-gray-900">PEMERINTAHAN KABUPATEN BELU</h4>
        <h4 class="mb-2 mt-2 text-gray-900">DINAS PU DAN PERUMAHAN RAKYAT</h4>
        <h4 class="mb-2 mt-2 text-gray-900">PEMERINTAHAN DESA KABUNA</h4>

      </div>
    </div>
  </div>
  <!-- Isi Dalam bentuk Card -->
  <div class="row">
    <div class="col-lg-3">
      <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header"></div>
        <div class="card-body">
          <h5 class="card-title">Informasi Daftar Penerimaan Bantuan Rumah</h5>
          <p class="card-text" style="text-align: justify;">Simbol 'list' berwarna hijau (<i class="fas fa-fw fa-list text-success"></i>) pada daftar periode disamping melambangkan periode penerimaan bantuan rumah yang telah selesai. Sedangkan simbol 'list' berwarna biru (<i class="fas fa-fw fa-list text-primary"></i>) menunjukkan periode penerimaan bantuan rumah yang baru dibuka atau sedang berjalan.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <div class="row">
        <?php foreach ($periode as $p) : ?>
          <?php if ($p['status'] == 1) : ?>
            <div class="col-xl-4 col-md-6 mb-2">
              <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                      <div class="text-lg font-weight-bold text-secondary text-uppercase mb-1">Periode <?= $p['periode']; ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="#" class="detail-periode">
                        <i class="fas fa-fw fa-list fa-3x text-primary"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php else : ?>
            <div class="col-xl-4 col-md-6 mb-2">
              <div class="card border-left-success h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col">
                      <div class="text-lg font-weight-bold text-secondary text-uppercase mb-1">Periode <?= $p['periode']; ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="#" class="detail-periode">
                        <i class="fas fa-fw fa-list fa-3x text-success"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>
</div>
<!-- End of Main Content -->