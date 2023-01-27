<div class="content">

    <?php Flasher::flash() ?>

    Total kirim : <?= $data->totalkirim ?>
    <hr />
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
        <thead>
            <tr>
                <th data-sortable="true">Nominal</th>
                <th>Token</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->voucher as $voucher) :
            ?>
                <tr>
                    <td><?= Numeric::numberFormat($voucher->nominal) ?></td>
                    <td><?= substr($voucher->token, 0, 25) ?>...</td>
                    <td>
                        <div class='bar<?= $voucher->id ?> visually-hidden'><?= $voucher->token ?></div>
                        <a href="#" class="copy" data-clipboard-action="copy" data-clipboard-target=".bar<?= $voucher->id ?>">
                            <i class="fa-regular fa-copy"></i>
                        </a>
                        &nbsp;
                        <a href="<?= BASEURL ?>/member/voucher/transfer-voucher/<?= $voucher->id ?>/" class="text-danger">
                            <i class="fa-regular fa-paper-plane"></i>
                            Kirim
                        </a>

                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>