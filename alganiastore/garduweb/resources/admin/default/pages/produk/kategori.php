<div class="content">

    <?php Flasher::flash() ?>

    <div>
        <form method="POST" action="<?= BASEURL ?>/admin/setting/action/kategori-simpan/">
            <input type="hidden" id="id" name="id" value="<?= @$data->item_kategori->id ?>">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtKategori" name="txtKategori" value="<?= @$data->item_kategori->kategori ?>">
                <label>Kategori</label>
            </div>

            <div>
                <?php if (@$data->edit == 'edit') { ?>
                    <button type="submit" name="edit" class="btn btn-danger">UPDATE</button>
                <?php } else { ?>
                    <button type="submit" name="simpan" class="btn btn-primary">SIMPAN</button>
                <?php } ?>
            </div>
        </form>
    </div>

    <div class="mt-5">
        <hr />
        <table id="table" data-toggle="table" data-pagination="true" data-search="false" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Kategori</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->kategori as $kategori) :
                ?>
                    <tr>
                        <td><?= $kategori->kategori ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/admin/produk/kategori/<?= $kategori->slug ?>/" title="Edit" class="text-light">
                                <span class="badge bg-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </span>
                            </a>
                            <a href="#" title="Delete" class="text-light media-delete" data-id="<?= $kategori->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
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
                baseurl + "/admin/produk/action/kategori-hapus/"
            );
        });
    });
</script>