<!DOCTYPE html>
<html>

<head>
    <title>Desain Tabel Menggunakan CSS</title>
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
    </style>
</head>

<body>
    <h1>lebakcyber.net</h1>
    <table class="tabel1">
        <tr>
            <th width="5%">No</th>
            <th width="10%">No KK</th>
            <th width="10%">Kepala Keluarga</th>
            <th width="10%">Alamat</th>
            <th width="10%">Dusun</th>
        </tr>
        <!-- ITEMS HERE -->
        <?php $i = 1; ?>
        <?php foreach ($data['kepkel'] as $k) : ?>
            <tr>
                <td scope="row"><?= $i; ?></td>
                <td><?= $k['no_kk']; ?></td>
                <td><?= $k['nm_kpl_kel']; ?></td>
                <td><?= $k['alamat']; ?>, <?= $k['rt']; ?>/<?= $k['rw']; ?>, <?= $k['desa']; ?>, <?= $k['kec']; ?>, <?= $k['kab']; ?></td>
                <td><?= $k['nama_dusun']; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>