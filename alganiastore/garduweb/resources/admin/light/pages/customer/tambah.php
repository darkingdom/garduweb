<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Tambah Customer
        </div>
        <div class="card-body">
            <form id="frmCustomer" action="<?= BASEURL ?>/admin/customer/action/tambah/simpan/" method="POST">
                <div class="row mb-3">
                    <label for="txtNamaCustomer" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaCustomer" name="txtNamaCustomer">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNoHP" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtAlamat" class="col-sm-2 col-form-label text-nowrap">Alamat lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="selPropinsi" class="col-sm-2 col-form-label text-nowrap">Propinsi</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selPropinsi" name="selPropinsi">
                            <option value="0">Pilihan...</option>
                            <?php foreach ($data->propinsi as $propinsi) : ?>
                                <option value="<?= $propinsi->id ?>"><?= $propinsi->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="selKota" class="col-sm-2 col-form-label text-nowrap">Kota</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selKota" name="selKota">
                            <option>Pilihan...</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtEmail" class="col-sm-2 col-form-label text-nowrap">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail">
                    </div>
                </div>
                <div>
                    <hr>
                </div>
                <div class="row mb-3">
                    <label for="txtUsername" class="col-sm-2 col-form-label text-nowrap">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername">
                    </div>
                </div>
                <div class="row">
                    <label for="txtPassword" class="col-sm-2 col-form-label text-nowrap">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmCustomer" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#selPropinsi").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/customer/ajax/kota/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selKota").html(response);
                },
            });
        });
    });
</script>