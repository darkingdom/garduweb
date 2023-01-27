<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="content-wrapper">
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="left" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Nama Robot</th>
                    <th data-sortable="false">Key</th>
                    <th data-sortable="true">Harga</th>
                    <th data-sortable="true">Versi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->robot as $robot) :
                ?>
                    <tr>
                        <td><?= $robot->nama_robot ?></td>
                        <td><?= $robot->keyid ?></td>
                        <td><?= Numeric::numberFormat($robot->harga) ?></td>
                        <td><?= $robot->versi ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>

        </table>
    </div>

</div>


<style>
    .table {
        margin-top: 10px;
    }

    .fixed-table-toolbar {
        text-align: right;
    }
</style>