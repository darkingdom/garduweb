<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/admin/produk/action/produk-simpan/">
        <input type="hidden" id="id" name="id" value="<?= @$data->produk->id ?>" />
        <div class="bg-primary p-2 rounded">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtURL1" name="txtURL1" value="<?= @$data->produk->url_produk1 ?>">
                <label>URL Produk 1 (default)</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtURL2" name="txtURL2" value="<?= @$data->produk->url_produk2 ?>">
                <label>URL Produk 2</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="txtURL3" name="txtURL3" value="<?= @$data->produk->url_produk3 ?>">
                <label>URL Produk 3</label>
            </div>
        </div>

        <hr />

        <div class="bg-warning p-2 rounded">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtProduk" name="txtProduk" value="<?= @$data->produk->nama_produk ?>">
                <label>Nama Produk</label>
            </div>
            <div class="form-floating mb-3">
                <select id="selKategori" name="selKategori" class="form-select">
                    <option selected value="0">Pilihan...</option>
                    <?php foreach ($data->kategori as $kategori) : ?>
                        <option value="<?= $kategori->id ?>" <?php if (@$data->produk->id_kategori_produk == $kategori->id) echo 'selected'; ?>><?= $kategori->kategori ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Kategori</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtHarga" name="txtHarga" value="<?= @$data->produk->harga ?>">
                <label>Harga</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtBerat" name="txtBerat" value="<?= @$data->produk->berat ?>">
                <label>Berat (gr)</label>
            </div>
            <div class="form-floating">
                <textarea type="text" class="form-control" id="txtKeterangan" name="txtKeterangan"><?= @$data->produk->keterangan ?></textarea>
                <label>Keterangan</label>
            </div>
        </div>

        <hr />

        <div class="bg-success p-2 rounded">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtBonus1" name="txtBonus1" value="<?= @$data->produk->bonus_level1 ?>">
                <label>Bonus Level 1</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtBonus2" name="txtBonus2" value="<?= @$data->produk->bonus_level2 ?>">
                <label>Bonus Level 2</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtBonus3" name="txtBonus3" value="<?= @$data->produk->bonus_level3 ?>">
                <label>Bonus Level 3</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtBonus4" name="txtBonus4" value="<?= @$data->produk->bonus_level4 ?>">
                <label>Bonus Level 4</label>
            </div>
            <div class="form-floating">
                <input type="number" class="form-control" id="txtBonus5" name="txtBonus5" value="<?= @$data->produk->bonus_level5 ?>">
                <label>Bonus Level 5</label>
            </div>
        </div>

        <div class="mt-5">
            <hr />
            <?php if (@$data->edit == 'edit') { ?>
                <button type="submit" name="edit" class="btn btn-danger">UPDATE PRODUK</button>
            <?php } else { ?>
                <button type="submit" name="simpan" class="btn btn-warning">SIMPAN PRODUK</button>
            <?php } ?>
        </div>
    </form>
</div>