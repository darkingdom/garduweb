<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <a href="<?= BASEURL ?>/admin/member/newMember">
            <button class="btn btn-primary" style="float: left; margin-top: 10px;">TAMBAH</button>
        </a>
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Nama Nasabah</th>
                    <th data-sortable="true">Saldo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->member as $member) :
                ?>
                    <tr>
                        <td><?= $member->nama ?></td>
                        <td><?= Numeric::numberFormat($member->saldoSimpanan) ?></td>
                        <td>
                            <a href="#" class="member-detail" data-id="<?= $member->uid ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                <span class="badge bg-primary">detail</span>
                            </a>
                            <a href="<?= BASEURL ?>/admin/member/updateMember/<?= $member->uid ?>"><span class="badge bg-warning">edit</span></a>
                            <a href="#" class="member-delete" data-id="<?= $member->uid ?>" data-bs-toggle="modal" data-bs-target="#deleteMember">
                                <span class="badge bg-danger">hapus</span>
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
    // include COMPONENTADM . "/component/atom/pagination.php";
    include COMPONENTADM . "/component/atom/modalMember.php";
    ?>

</div>


<style>
    .table {
        margin-top: 10px;
    }
</style>