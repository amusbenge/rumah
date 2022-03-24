<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <table class="table table-bordered text-center display compact nowrap">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Ranking</th>
            <th scope="col">No KK</th>
            <th scope="col">Nama Calon Penerima</th>
            <!-- <th scope="col">Presentase Survey</th> -->
            <th scope="col">Nilai</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($alternatif as $alt) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $alt['no_kk'] ?></td>
              <td><?= $alt['nm_kpl_kel'] ?></td>
              <td><?= number_format($alt['hasil'], 3) ?></td>
            </tr>
          <?php endforeach; ?>
          <!-- akhir LOOPING -->
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>
<!-- End of Main Content -->