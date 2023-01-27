<div class="content">

    <?php include RESOURCEADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <a href="<?= BASEURL ?>/admin/member/newMember">
            <button type="button" class="btn btn-primary">+Tambah Member</button>
        </a>

        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nama Nasabah</th>
                    <th scope="col">Saldo</th>
                    <th scope="col"></th>
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
    include RESOURCEADM . "/component/atom/pagination.php";
    include RESOURCEADM . "/component/atom/modalMember.php";
    ?>

</div>


<style>
    .table {
        margin-top: 10px;
    }
</style>