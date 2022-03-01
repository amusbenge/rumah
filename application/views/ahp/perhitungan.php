<div class="container-fluid">
  <h3 class="mb-2 text-gray-900"><?= $title; ?></h3>

  <!-- Isi Dalam bentuk Card -->
  <div class="card">
    <div class="card-body">
      <?= $this->session->flashdata('pesan'); ?>
      <form action="<?= base_url('surveyor/insert_perhitungan') ?>" method="post">
        <input type="hidden" name="id_kriteria" value="<?= $kriteria['id'] ?>">
        <input type="hidden" name="id_dusun" value="<?= $dusun['id'] ?>">
        <?php foreach ($alternatif as $alt) : ?>
          <input type="hidden" name="id_alternatif_<?= $alt['id'] ?>" value="<?= $alt['id_alternatif'] ?>">
          <input type="hidden" name="id_kriteria_alternatif[]" value="<?= $alt['id'] ?>">
          <?php foreach ($alt['banding'] as $banding) : ?>
            <input type="hidden" name="banding_<?= $alt['id']  ?>[]" value="<?= $banding['id_alternatif'] ?>">
            <div class="form-group row">
              <div class="col-3">
                <div class="form-check">
                  <input type="hidden" name="alt_<?= $alt['id']  ?>_<?= $banding['id_alternatif'] ?>" value="<?= $alt['id_alternatif'] ?>">
                  <input class="form-check-input" type="radio" name="cek_<?= $alt['id']  ?>_<?= $banding['id_alternatif'] ?>" id="exampleRadios1" value="alt">
                  <b><?= $alt['nm_kpl_kel'] ?></b>
                  <p class=""><?= $alt['deskripsi'] ?></p>
                </div>
              </div>

              <div class="col-3">
                <div class="form-check">
                  <input type="hidden" name="alt2_<?= $alt['id']  ?>_<?= $banding['id_alternatif'] ?>" value="<?= $banding['id_alternatif'] ?>">
                  <input class="form-check-input" type="radio" name="cek_<?= $alt['id']  ?>_<?= $banding['id_alternatif'] ?>" id="exampleRadios1" value="alt2">
                  <b><?= $banding['nm_kpl_kel'] ?></b>
                  <p class=""><?= $banding['deskripsi'] ?></p>
                </div>
              </div>

              <div class="col-6">
                <select name="skala_<?= $alt['id']  ?>_<?= $banding['id_alternatif'] ?>" id="" class="custom-select" required>
                  <option value="">Pilih Skala Kepentingan</option>
                  <?php foreach ($skala as $s) : ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama_skala'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

            </div>


          <?php endforeach; ?>
        <?php endforeach; ?>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Kirim Data</button>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- End of Main Content -->