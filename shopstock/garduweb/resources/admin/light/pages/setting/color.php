<?php Flasher::flash(); ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Color
        </div>
        <div class="card-body">
            <form id="frmColor" action="<?= BASEURL ?>/admin/setting/action/color/simpan/" method="POST">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Hex Color</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Nama Warna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaWarna" name="txtNamaWarna">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmColor" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
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
                            <th data-align="center" data-width="40"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                            <th data-sortable="true">Hex Color</th>
                            <th data-sortable="true" data-align="right">Nama Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data->color as $color) :
                        ?>
                            <tr>
                                <td><input type="checkbox" name="chkID[]" value="1"></td>
                                <td><?= $color->hex_color ?></td>
                                <td><?= $color->nama_color ?></td>
                                <td>
                                    <div class="text-nowrap">
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div class="mt-2">
                    <button class="btn btn-danger btn-xsm" data-bs-toggle="tooltip" data-bs-title="Delete"> <i class="fa-solid fa-trash-can"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>