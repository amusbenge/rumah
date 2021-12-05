<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->

  <p>
    <a class="btn btn-warning btn-icon-split" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      <span class="icon text-white-50">
        <i class="fas fa-info-circle"></i>
      </span>
      <span class="text">Info Kriteria</span>
    </a>
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card mb-2">
      <div class="card-body">
        <div class="card card-body">
          <!-- Tabel Kriteria -->
          <table class="table table-bordered text-center display compact nowrap">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kriteria</th>
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

  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <div class="row">
        <div class="col-lg-6">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="kriteria">Pilih Kriteria</label>
            </div>
            <select class="custom-select" id="kriteria">
              <option selected>Pilih Kriteria</option>
              <?php foreach ($kriteria as $p) : ?>
                <option value="<?= $p['id']; ?>"><?= $p['kriteria']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="mt-2">
        <div class="row">
          <div class="col-lg-4">
            <label for="">Alternatif</label>
            <?php foreach ($keluarga as $k) : ?>
              <div class="col-sm-12">
                <input type="text" readonly class="form-control" id="nm_kpl_kel" value="<?= $k['nm_kpl_kel']; ?>">
              </div>
            <?php endforeach; ?>
          </div>
          <div class="col-lg-4">
            <label for="">Penilaian</label>
            <select class="custom-select" id="kriteria">
              <option selected>Pilih Kriteria</option>
              <?php foreach ($kriteria as $p) : ?>
                <option value="<?= $p['id']; ?>"><?= $p['kriteria']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-lg-4">
            <label for="">Alternatif</label>
            <?php foreach ($keluarga as $k) : ?>
              <div class="col-sm-12">
                <input type="text" readonly class="form-control" id="nm_kpl_kel" value="<?= $k['nm_kpl_kel']; ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<!-- End of Main Content -->