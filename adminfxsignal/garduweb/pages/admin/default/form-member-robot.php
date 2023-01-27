<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <form action="<?php
                        if (isset($data->member->id)) {
                            echo BASEURL . "/admin/setRobot/member/update";
                        } else {
                            echo BASEURL . "/admin/setRobot/member/save";
                        }
                        ?>" method="POST">
            <div class="form-floating input-group mb-3">
                <input type="text" id="txtGenerate" name="txtGenerate" class="form-control" placeholder="Generate" value="<?= @$data->member->uid ?>" aria-label="Generate" aria-describedby="btnGenerate">
                <button class="btn btn-outline-secondary" type="button" id="btnGenerate">Generate</button>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtAkunTrading" name="txtAkunTrading" placeholder="Password Baru" value="<?= @$data->member->akun_trading ?>">
                <label>Akun Trading</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="selTypeRobot" name="selTypeRobot" aria-label="Type Robot">
                    <option value="0">Pilihan</option>
                    <?php
                    foreach ($data->robot as $robot) :
                    ?>
                        <option value="<?= $robot->id ?>" <?php if (@$data->member->id_robot == $robot->id) echo "selected"; ?>><?= $robot->nama_robot ?></option>
                    <?php
                    endforeach;
                    ?>

                </select>
                <label>Type Robot</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtExpire" name="txtExpire" placeholder="Expire" value="<?php if (isset($data->member->id)) :
                                                                                                                        echo @$data->member->expire;
                                                                                                                    else :
                                                                                                                        echo '0000-00-00';
                                                                                                                    endif; ?>">
                <label>Expire</label>
            </div>

            <div class="mt-5">
                <button class="btn btn-primary" type="submit">SIMPAN</button>
                <a href="<?= BASEURL ?>/admin/member-robot-trading/">
                    <span class="btn btn-danger">KEMBALI</span>
                </a>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#btnGenerate").click(function() {
            $.ajax({
                url: baseurl + "/admin/member-robot-trading/get-generate/",
                type: "post",
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#txtGenerate").val(response);
                },
            });
        });
    });
</script>