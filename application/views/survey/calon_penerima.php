<div class="container-fluid h-100">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('message'); ?>
      <table class="table table-bordered text-center display compact nowrap" id="jtable">
        <thead>
          <tr>
            <th>No KK</th>
            <th>Nama Kepala Keluarga</th>
            <th>RT/RW</th>
            <th>Dusun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($kep_keluarga as $kk) : ?>
            <tr>
              <td><?= $kk['no_kk'] ?></td>
              <td><?= $kk['nm_kpl_kel'] ?></td>
              <td><?= $kk['rt'] ?>/<?= $kk['rw'] ?></td>
              <td><?= $kk['nama_dusun'] ?></td>
              <td>
                <?php if ($kk['jumlah_survey'] < 9) : ?>
                  <a href="<?= base_url('surveyor/survey_calon/' . $kk['id_alternatif']) ?>" class="btn btn-sm btn-primary">Survey</a>
                <?php else : ?>
                  <a href="<?= base_url('surveyor/detail_survey/' . $kk['id_alternatif']) ?>" class="btn btn-sm btn-success">Detail</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- End of Main Content -->