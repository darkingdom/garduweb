<div class="content">
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
        <thead>
            <tr>
                <th data-sortable="true">No. Anggota</th>
                <th data-sortable="true">Nama</th>
                <th data-sortable="true" data-align="right">Bonus</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->wallet as $wallet) :
            ?>
                <tr>
                    <td><?= $wallet->no_anggota ?></td>
                    <td><?= AdminModel::getMemberByNoAnggota($wallet->no_anggota)->nama ?></td>
                    <td><?= Numeric::numberFormat($wallet->wallet) ?></td>
                    <td><a href="#" class="text-warning" title="edit"><i class="fa-solid fa-pen-to-square"></i> </a></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

</div>