<div class="content">
    <div class="border border-2 border-danger rounded text-center py-5 px-2">
        <div class="text-success fw-bold fs-3 fst-italic">Congratulation!</div>
        <hr />
        <div>
            <div>Pendaftaran member baru</div>
            <div>No. Anggota : <b><?= Session::get('txtNoAnggota'); ?></b></div>
            <div>Nama : <b><?= Session::get('txtNama'); ?></b></div>
            <div>Password : <b><?= Session::get('txtPassword'); ?></b></div>
        </div>
    </div>
</div>