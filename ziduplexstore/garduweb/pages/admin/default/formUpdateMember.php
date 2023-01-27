<div class="content">

    <?php include RESOURCEADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <form action="<?= BASEURL ?>/admin/setMember/update" method="POST">
            <input type="hidden" value="<?= $data->member->uid ?>" name="uid">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Nama Lengkap" value="<?= $data->member->nama ?>">
                <label for="txtName">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" placeholder="Alamat" value="<?= $data->member->alamat ?>">
                <label for="txtAlamat">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="txtPropinsi" name="txtPropinsi" aria-label="Propinsi">
                    <option value="0" style="font-weight: bold;">Pilih Propinsi</option>
                    <?php
                    if ($data->member->propinsi != NULL) :
                        echo "<option value='{$data->member->propinsi}' selected>{$data->member->propinsi}</option>";
                    endif;
                    foreach ($data->propinsi as $propinsi) :
                        echo "<option value='{$propinsi->name}' data-id='{$propinsi->id}'>{$propinsi->name}</option>";
                    endforeach;
                    ?>
                </select>
                <label for="floatingSelect">Propinsi</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="txtKabupaten" name="txtKabupaten" aria-label="Kota">
                    <option value="0" style="font-weight: bold;">Pilih Kota</option>
                    <?php
                    if ($data->member->kabupaten != NULL) :
                        echo "<option value='{$data->member->kabupaten}' selected>{$data->member->kabupaten}</option>";
                    endif;
                    ?>
                </select>
                <label for="txtKabupaten">kota</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="txtKecamatan" name="txtKecamatan" aria-label="Kecamatan">
                    <option value="0" style="font-weight: bold;">Pilih Kecamatan</option>
                    <?php
                    if ($data->member->kecamatan != NULL) :
                        echo "<option value='{$data->member->kecamatan}' selected>{$data->member->kecamatan}</option>";
                    endif;
                    ?>
                </select>
                <label for="floatingSelect">Kecamatan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="<?= $data->member->email ?>">
                <label for="txtEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtHP" name="txtHP" placeholder="No HP" value="<?= $data->member->noHP ?>">
                <label for="txtHP">No HP</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtREK" name="txtREK" placeholder="No Rekening" value="<?= $data->member->noREK ?>">
                <label for="txtREK">No Rekening</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtBank" name="txtBank" placeholder="Bank" value="<?= $data->member->bank ?>">
                <label for="txtBank">Bank</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtAN" name="txtAN" placeholder="AN" value="<?= $data->member->an ?>">
                <label for="txtAN">AN</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtSaldoSimpanan" name="txtSaldoSimpanan" placeholder="Saldo Simpanan" value="<?= $data->member->saldoSimpanan ?>">
                <label for="txtSaldoSimpanan">Saldo Simpanan</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="Username" value="<?= $data->member->username ?>">
                <label for="txtUsername">Username</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="txtStatus" name="txtStatus" aria-label="Kota">
                    <option value="0" <?php if ($data->member->status == 0) echo "selected"; ?>>Tidak Aktif</option>
                    <option value="1" <?php if ($data->member->status == 1) echo "selected"; ?>>Aktif</option>
                </select>
                <label for="txtStatus">kota</label>
            </div>
            <div class="form-floating mt-5">
                <button type="submit" class="btn btn-primary">SIMPAN UPDATE</button>
            </div>
        </form>
    </div>
</div>

<style>

</style>


<script>
    $(document).ready(function() {
        //select Propinsi
        $("#txtPropinsi").on("change", function() {
            const id = $(this).find(':selected').data('id');
            $.ajax({
                url: baseurl + "/admin/getKota/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#txtKabupaten").html(response);
                },
            });
        });

        //select Kabupaten/Kota
        $("#txtKabupaten").on("change", function() {
            const id = $(this).find(':selected').data('id');
            $.ajax({
                url: baseurl + "/admin/getKecamatan/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#txtKecamatan").html(response);
                },
            });
        });
    });
</script>