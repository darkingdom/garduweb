<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/admin/pesan/action/kirim-pesan/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtTujuan" name="txtTujuan">
            <label>Tujuan (ID Anggota)</label>
            <span style="font-size: 10px; color:#777;">* isikan ALL untuk mengirim broadcast ke semua anggota</span>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtJudul" name="txtJudul">
            <label>Judul pesan:</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="txtIsiPesan" name="txtIsiPesan"></textarea>
            <label>Isi pesan:</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" name="simpan" class="btn btn-primary">KIRIM</button>
        </div>
    </form>
</div>