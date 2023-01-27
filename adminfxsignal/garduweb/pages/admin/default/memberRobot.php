<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <a href="<?= BASEURL ?>/admin/member-robot-trading/new-member">
            <button class="btn btn-primary" style="float: left; margin-top: 10px;"> <i class="fa-solid fa-user-plus"></i> TAMBAH</button>
        </a>
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="left" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Tanggal Gabung</th>
                    <th data-sortable="false">UID</th>
                    <th data-sortable="true">Akun Trading</th>
                    <th data-sortable="true">Type Robot</th>
                    <th data-sortable="true">Expire</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->member as $member) :
                ?>
                    <tr>
                        <td><?= $member->tanggal_daftar ?></td>
                        <td><?= $member->uid ?> <br /> <?= $member->username ?></td>
                        <td><?= $member->akun_trading ?></td>
                        <td><?= @AdminModel::getRobotByID($member->id_robot)->nama_robot ?></td>
                        <td><?= $member->expire ?></td>
                        <td>
                            <!-- <a href="#" class="member-detail" data-id="<?= $member->uid ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                <span class="badge bg-primary">detail</span>
                            </a> -->
                            <a href="<?= BASEURL ?>/admin/member-robot-trading/edit/<?= $member->uid ?>"><span class="badge bg-warning">Edit</span></a>
                            <a href="#" class="item-delete" onclick="attrModalDelete(this)" data-id="<?= $member->uid ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-trash-can"></i>
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


<style>
    .table {
        margin-top: 10px;
    }

    .fixed-table-toolbar {
        text-align: right;
    }
</style>


<script>
    function attrModalDelete(d) {
        const id = d.getAttribute("data-id");
        $("#modal-delete-id").val(id);
        $("#modalDeleteURL").attr(
            "action",
            baseurl + "/admin/setRobot/member/delete/"
        );
    }

    // $(document).ready(function() {
    // function goSomething(ididentifier) {
    //     alert("data-id:" + $(identifier).data('id'));
    // }

    // $(".item-delete").click(function() {
    //     const id = $(this).data("id");
    //     $("#modal-delete-id").val(id);
    //     $("#modalDeleteURL").attr(
    //         "action",
    //         baseurl + "/admin/setRobot/member/delete/"
    //     );
    // });
    // });
</script>