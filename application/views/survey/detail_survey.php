<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <h2><?= $kk['nm_kpl_kel'] ?></h2>
      <p>Periode : <?= $kk['periode'] ?></p>
      <table class="table table-bordered text-center display compact nowrap" id="jtable">
        <thead>
          <tr>
            <th>Kriteria</th>
            <th>Hasil Survey</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_survey as $survey) : ?>
            <tr>
              <td><?= $survey['kriteria'] ?></td>
              <td><?= $survey['deskripsi'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<!-- End of Main Content -->