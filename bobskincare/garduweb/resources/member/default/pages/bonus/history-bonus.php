<div class="content">
    <table id="table" data-toggle="table" data-pagination="true" data-search="false" data-search-align="left" paginationHAlign="right">
        <thead>
            <tr>
                <th data-sortable="true">Tanggal</th>
                <!-- <th data-sortable="true">Debet</th>
                <th data-sortable="true">Kredit</th> -->
                <th data-sortable="true">Bonus</th>
                <th data-sortable="true">Kategori</th>
                <th>Asal Bonus</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->riwayat as $riwayat) :
            ?>
                <tr>
                    <td><?= $riwayat->tanggal_bonus ?></td>
                    <td><?= Numeric::numberFormat($riwayat->bonus) ?></td>
                    <td><?= $riwayat->type ?></td>
                    <td><?= $riwayat->bonus_dari ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>