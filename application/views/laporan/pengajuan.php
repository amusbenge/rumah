<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        .tabel1 {
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #f2f5f7;
        }

        .tabel1 tr th {
            background: #35A9DB;
            color: #fff;
            font-weight: normal;
        }

        .tabel1,
        th,
        td {
            padding: 10px 20px;
            text-align: left;
        }

        .tabel1 tr:hover {
            background-color: #f5f5f5;
        }

        .tabel1 tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table2 {
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            border: 0px;
            float: right;
            position: fixed;
        }

        .tabel2,
        th,
        td {
            padding: 10px 20px;
            text-align: center;
        }

        .box {
            float: right;
            width: 50%;
        }
    </style>
</head>

<body>
    <h1><?= $data['title'] ?></h1>
    <table class="tabel1">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">No. KK</th>
                <th scope="col">Nama Kepala Keluarga</th>
                <th scope="col">RT/RW</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="text-gray-900">
            <!-- LOOPING tampil Data -->
            <?php
            $no = 1;
            foreach ($data['kepkel'] as $kk) : ?>
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
            <!-- akhir LOOPING -->
        </tbody>
    </table>
    <br>
    <div class="box">
        <table class="table2">
            <tr>

                <td>
                    Kabuna, <?= date('d-m-Y') ?>,
                    <br>
                    Kepala Desa Kabuna
                    <br><br><br><br>
                    Adrianus Yoseph Laka, S.Tp.
                </td>
            </tr>
        </table>
    </div>
</body>

</html>