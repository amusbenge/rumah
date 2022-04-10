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

      <!-- Tabel Daftar Dusun -->
      <table class="table table-bordered text-center display compact nowrap" id="jtable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Dusun</th>
            <!-- <th scope="col">Presentase Survey</th> -->
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-900">
          <!-- LOOPING tampil Data -->
          <?php
          $no = 1;
          foreach ($data_dusun as $dusun) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $dusun['nama_dusun'] ?></td>
              <?php if ($dusun['jumlah_alter'] > 0 && $dusun['jumlah_alter'] == $dusun['jumlah_hasil']) : ?>
                <td>
                  <a href="<?= base_url('surveryor/hasil/' . $dusun['id']) ?>" class="btn btn-info btn-sm">Lihat</a>
                </td>
              <?php else : ?>
                <!-- <td>Belum ada data rekomendasi</td> -->
                <td>
                  <i class="text-secondary">Belum ada data untuk ditampilkan</i>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
          <!-- akhir LOOPING -->
        </tbody>
      </table>
      <!-- AKHIR tabel -->

    </div>
  </div>

</div>