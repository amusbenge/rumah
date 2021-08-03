<div class="container-fluid">
    <h3 class="mb-3 text-gray-800"><?= $title; ?></h3>

    <!-- Isi Dalam bentuk Card -->
    <div class="card"> 
        <div class="card-body">

        <!-- Tampil Tabel Data Users -->
        <table class="table table-bordered table-hover text-center table-sm">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Status</th>
                <th scope="col">Gender</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-900">

            <!-- LOOPING tampil isi tabel users -->
            <?php 
            $no = 1;
            foreach ($users as $user) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user['nama'] ?></td>
                    <td><?= $user['tipe'] ?></td>
                    <td><?= $user['jk'] ?></td>
                    <td> 
                        <a href="<?= base_url('admin/edit_user/') ?><?= $user['id']; ?>" class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/hapus_user/') ?><?= $user['id']; ?>" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
        <!-- Akhir TABEL -->

        </div>
    </div>

</div>
</div>