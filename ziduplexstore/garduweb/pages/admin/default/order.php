<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Transaksi</th>
                    <th data-sortable="true">Konsumen</th>
                    <th data-sortable="true">Berat</th>
                    <th data-sortable="true">Harga</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->pesanan as $pesanan) :
                ?>
                    <tr>
                        <td>
                            <?= $pesanan->uid ?> <br />
                            <?= $pesanan->tanggal_order ?>
                        </td>
                        <td>#</td>
                        <td><?= $pesanan->berat ?></td>
                        <td><?= $pesanan->harga_total ?></td>
                        <td>
                            <a href="#" class="member-detail" data-id="<?= $pesanan->uid ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                <span class="badge bg-primary">detail</span>
                            </a>
                            <a href="<?= BASEURL ?>/admin/member/updateMember/<?= $pesanan->uid ?>"><span class="badge bg-warning">edit</span></a>
                            <a href="#" class="member-delete" data-id="<?= $pesanan->uid ?>" data-bs-toggle="modal" data-bs-target="#deleteMember">
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