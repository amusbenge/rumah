<html>

<head>
    <title>Laporan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #000000;
        }

        td {
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }

        table thead td {
            background-color: #4F8DF5;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }
    </style>
</head>

<body>
    <div class="" style="text-align: center; font-family: serif;">
        <h2>Laporan Data Kepala Keluarga</h2>
    </div>
    <div style="text-align: left; font-family: serif;">Tanggal Cetak: <?= date('d F Y'); ?> </div><br><br>
    <table class="items" width="100%" style="font-size: 9pt; font-family: serif; border-collapse: collapse; " cellpadding="8">
        <thead>
            <tr>
                <td width="5%">No</td>
                <td width="10%">No KK</td>
                <td width="10%">Kepala Keluarga</td>
                <td width="10%">Alamat</td>
                <td width="10%">Dusun</td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <?php $i = 1; ?>
            <?php foreach ($data['kepkel'] as $k) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $k['no_kk']; ?></td>
                    <td><?= $k['nm_kpl_kel']; ?></td>
                    <td><?= $k['alamat']; ?>, <?= $k['rt']; ?>/<?= $k['rw']; ?>, <?= $k['desa']; ?>, <?= $k['kec']; ?>, <?= $k['kab']; ?></td>
                    <td><?= $k['nama_dusun']; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>