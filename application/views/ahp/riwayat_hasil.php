<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>
  *Jika tidak ada data yang ditampilkan proses perankingan belum selesai.
  <!-- Isi Dalam bentuk Card -->
  <?php foreach ($dusun as $d) : ?>
    <div class="card card-secondary">
      <div class="card-header">
        <h3><?= $d['nama_dusun'] ?></h3>
      </div>
      <div class="card-body">
        <?= $this->session->flashdata('pesan'); ?>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">No KK</th>
              <th scope="col">Nama</th>
              <th scope="col">Nilai</th>
            </tr>
          </thead>
          <tbody class="text-gray-900">
            <!-- LOOPING tampil Data -->
            <?php
            $no = 1;
            foreach ($d['hasil'] as $hasil) : ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $hasil['no_kk'] ?></td>
                <td><?= $hasil['nm_kpl_kel'] ?></td>
                <td><?= number_format($hasil['hasil'], 3) ?></td>
              </tr>
            <?php endforeach; ?>
            <!-- akhir LOOPING -->
          </tbody>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</div>
<!-- End of Main Content -->