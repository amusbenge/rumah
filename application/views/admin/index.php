<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>
  <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#tambahPeriode">
    <i class="fas fa-plus mr-1"></i>Tambah Periode</button>

  <div class="col-lg-6 col-md-6">
    <?= $this->session->flashdata('message'); ?>
  </div>
  <!-- Isi Dalam bentuk Card -->
  <div class="row">
    <div class="col-lg-3">
      <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header"></div>
        <div class="card-body">
          <h5 class="card-title">Informasi Daftar Penerimaan Bantuan Rumah</h5>
          <p class="card-text" style="text-align: justify;">Untuk <i class="fas fa-fw fa-list text-success"></i> adalah periode penerimaan bantuan rumah yang telah selesai, tetapi untuk <i class="fas fa-fw fa-list text-primary"></i> adalah periode penerimaan bantuan rumah yang baru dibuka.</p>
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