<?php Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Bank
        </div>
        <div class="card-body">
            <form id="frmBank" action="<?= BASEURL ?>/admin/setting/action/bank/simpan/" method="POST">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama BANK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaBank" name="txtNamaBank">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">No. Rekening</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoRekening" name="txtNoRekening">
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">AN. Pemilik</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAN_pemilik" name="txtAN_pemilik">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmBank" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Table Color
        </div>
        <div class="card-body">
            <form method="POST">
                <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                    <thead>
                        <tr>
                            <th data-sortable="true">Nama Bank</th>
                            <th data-sortable="true" data-align="right">No Rekening</th>
                            <th data-sortable="true" data-align="right">AN. Pemilik</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data->bank as $bank) :
                        ?>
                            <tr>
                                <td><?= $bank->nama_bank ?></td>
                                <td><?= $bank->no_rekening ?></td>
                                <td><?= $bank->an_pemilik ?></td>
                                <td>
                                    <div class="text-nowrap">
                                        <span class="media-delete" data-id="<?= $bank->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>

</div>

<script>
    $(document).ready(function() {
        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/setting/action/bank/hapus/"
            );
        });
    });
</script>