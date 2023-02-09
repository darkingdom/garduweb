<div id="content">
    <div class="card">
        <div class="card-header">
            Riwayat Pajak
        </div>
        <div class="card-body">
            <!-- <form method="POST"> -->
            <table id="table" data-toggle="table" data-pagination="true" data-pagination-detail-h-align="right" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Tanggal</th>
                        <th data-sortable="true">Invoice</th>
                        <th data-sortable="true" data-align="right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->pajak as $pajak) :
                    ?>
                        <tr>
                            <td><?= $pajak->tanggal_pajak ?></td>
                            <td><?= $pajak->no_invoice ?></td>
                            <td><?= Numeric::numberFormat($pajak->nominal) ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <!-- <div class="mt-2 border-top pt-2">
                <button class="btn btn-danger btn-xsm" data-bs-toggle="tooltip" data-bs-title="Delete"> <i class="fa-solid fa-trash-can"></i> Delete</button>
            </div> -->
            <!-- </form> -->
        </div>

    </div>
</div>