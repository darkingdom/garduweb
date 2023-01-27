<div class="content">
    <div class="container">
        <div class="title-page">
            Laporan Penjualan
        </div>
    </div>

    <div class="container">
        <div class="col-12">
            <form action="#" method="POST">
                <div class="row">
                    <div class=" col-md-4 mb-3">
                        <div class="form-floating">
                            <select class="form-select" name="txtBulan" id="txtBulan">
                                <option value="0" style="font-weight: bold;">:: Pilih Bulan</option>
                                <option disabled>-------------------</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">Nopember</option>
                                <option value="12">Desember</option>
                            </select>
                            <label for="txtEtalase">Etalase</label>
                        </div>
                    </div>

                    <div class=" col-md-2 mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="txtTahun" name="txtTahun" placeholder="Tahun" value="<?= date('Y') ?>">
                            <label for="txtHarga">Tahun</label>
                        </div>
                    </div>

                    <div class="form-floating col-md-2 mb-3">
                        <button class="btn btn-success py-3" type="submit">FILTER</button>
                    </div>
                </div>
            </form>
        </div>

        <hr />

        <div class="mt-3">
            laporan
        </div>
    </div>
</div>