<div class="container-fluid">
    <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

    <!-- Isi Dalam bentuk Card -->
    <div class="card">
        <div class="card-body">

            <!-- Pesan SUKSES/TIDAK -->
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>

            <!-- Tampil Tabel Data Users -->
            <a href="<?= base_url('dusun/cetak_pengajuan/' . $periode['id']) ?>" class="btn btn-warning mb-2">Laporan</a>
            <table class="table table-bordered text-center display compact nowrap" id="jtable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">No. KK</th>
                        <th scope="col">Nama Kepala Keluarga</th>
                        <th scope="col">RT/RW</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">

                    <!-- LOOPING tampil isi tabel users -->
                    <?php
                    $no = 1;
                    foreach ($kepkel as $kk) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $kk['no_kk'] ?></td>
                            <td><?= $kk['nm_kpl_kel'] ?></td>
                            <td><?= $kk['rt'] ?>/<?= $kk['rw'] ?></td>
                            <td>
                                <?php if ($kk['hasil'] > 0) :  ?>
                                    <?= ($no >= 2 && $no <= 4) ? 'Menerima' : 'Tidak Menerima' ?>
                                <?php else : ?>
                                    sedang diproses
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Akhir TABEL -->
        </div>
    </div>

</div>