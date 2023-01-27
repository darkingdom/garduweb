<div class="content">
    <div class="row">
        <div class="col">
            <div class="border-start border-4 rounded-start border-primary">
                <div class="border border-1 rounded-end p-2 border-start-0">

                    <div style="font-size: 14px;">Total Anggota</div>
                    <div class="fs-4"><?= $data->total_member ?></div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-4 rounded-start border-success">
                <div class="border border-1 rounded-end p-2 border-start-0  ">

                    <div style="font-size: 14px;">Anggota Aktif</div>
                    <div class="fs-4"><?= $data->aktif_member ?></div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-4 rounded-start border-warning">
                <div class="border border-1 rounded-end p-2 border-start-0  ">

                    <div style="font-size: 14px;">Upgrade Anggota</div>
                    <div class="fs-4"><?= $data->upgrade_member ?></div>

                </div>
            </div>
        </div>
    </div>

    <hr />

    <?php Flasher::flash() ?>

    <div>
        <!-- <table class="table"> -->
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">No. Anggota</th>
                    <th data-sortable="true">Nama</th>
                    <th data-sortable="true">No. Ponsel</th>
                    <th data-sortable="true">Keanggotaan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->member as $member) :
                ?>
                    <tr>
                        <td><?= $member->no_anggota ?></td>
                        <td><?= $member->nama ?></td>
                        <td><?= $member->no_ponsel ?></td>
                        <td><?= $member->keanggotaan ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/admin/member/edit-member/<?= $member->id ?>/" title="Edit" class="text-light">
                                <span class="badge bg-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </span>
                            </a>
                            <!-- <a href="#" title="Delete" class="text-light media-delete" data-id="<?= $member->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </span>
                            </a> -->
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/member/action/member-hapus/"
            );
        });
    });
</script>