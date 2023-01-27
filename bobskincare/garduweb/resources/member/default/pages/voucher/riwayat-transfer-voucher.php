<div class="content">
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
        <thead>
            <tr>
                <th data-sortable="true">Tanggal Kirim</th>
                <th data-sortable="true">Nominal</th>
                <th data-sortable="true">Penerima</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->transfer as $transfer) :
            ?>
                <tr>
                    <td><?= $transfer->tanggal_kirim ?></td>
                    <td><?= Numeric::numberFormat($transfer->nominal) ?></td>
                    <td><?= $transfer->penerima ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>