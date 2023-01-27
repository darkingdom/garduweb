<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <form action="<?= BASEURL ?>/admin/setMember/save" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Nama Lengkap">
                <label for="txtName">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="Username">
                <label for="txtUsername">Username</label>
            </div>
            <div class="form-floating  mb-3">
                <input type="text" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
                <label for="txtPassword">Password</label>
            </div>
            <div class="form-floating">
                <button type="submit" class="btn btn-primary">SIMPAN</button>
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
                    $("#txtKota").html(response);
                },
            });
        });

        //select Kabupaten/Kota
        $("#txtKota").on("change", function() {
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