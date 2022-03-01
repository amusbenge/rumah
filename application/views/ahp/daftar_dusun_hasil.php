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
              <?php if ($dusun['jumlah_alternatif'] > 0) : ?>
                <?php $presentase = $dusun['jumlah_hitung'] / ($dusun['jumlah_alternatif'] * 9) * 100; ?>
                <?php $presentase_akhir = $dusun['jumlah_hitung_alternatif'] / ($dusun['jumlah_alternatif'] * 9) * 100; ?>
                <!-- <td><?= $presentase ?>%</td> -->
                <td>
                  <?php if ($presentase == 100 && $presentase_akhir != 100) : ?>
                    <form action="<?= base_url('ahp/hitung_hasil_akhir') ?>" method="post">
                      <input type="hidden" name="id_dusun" value="<?= $dusun['id'] ?>">
                      <button type="submit" class="btn btn-primary btn-sm">Hitung</button>
                    </form>
                  <?php else : ?>
                </td>
              <?php endif; ?>
            <?php else : ?>
              <!-- <td>Belum ada data rekomendasi</td> -->
              <td></td>
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