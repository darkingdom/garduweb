<?= Flasher::flash(); ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            BRAND
        </div>
        <div class="card-body">
            <form id="frmBrand" action="<?= BASEURL ?>/admin/brand/action/general/simpan" method="POST">
                <div class="row mb-3">
                    <label for="txtBrandName" class="col-sm-2 col-form-label text-nowrap">Nama merek</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtBrandName" name="txtBrandName">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="selKategori" class="col-sm-2 col-form-label text-nowrap">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selKategori" name="selKategori">
                            <option value="0">Pilihan...</option>
                            <?php
                            foreach ($data->kategori as $kategori) :
                            ?>
                                <option value="<?= $kategori->id ?>"><?= $kategori->kategori ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="txtUrlLogo" class="col-sm-2 col-form-label text-nowrap">URL Logo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUrlLogo" name="txtUrlLogo" placeholder="Optional">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button type="submit" form="frmBrand" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Tabel Brand
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama Merek</th>
                        <th data-sortable="true">Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->brand as $brand) :
                    ?>
                        <tr>
                            <td><?= $brand->nama_merk ?></td>
                            <td><?= AdminModel::AJAXgetKategoriByID($brand->id_kategori)->kategori ?></td>
                            <td>
                                <div class="text-nowrap">
                                    <a href="<?= BASEURL ?>/admin/brand/edit/?id=<?= $brand->id ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <span class="data-delete" data-id="<?= $brand->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
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
        </div>
    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>

<script>
    $(document).ready(function() {
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/brand/action/general/delete/"
            );
        });
    });
</script>