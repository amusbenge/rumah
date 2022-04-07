<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <table class="table table-bordered text-center display compact nowrap">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Periode</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($periode as $p) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $p['periode'] ?></td>
              <td><a href="<?= base_url('dusun/riwayat_pengajuan/' . $p['id']) ?>" class="btn btn-sm btn-success">Lihat</a></td>
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