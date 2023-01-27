<div class="content">

    <?php Flasher::flash() ?>

    Total kirim : <?= $data->totalkirim ?>
    <hr />
    <table class="table">
        <thead>
            <tr>
                <th>ID Anggota</th>
                <th>Token</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->pin as $pin) :
            ?>
                <tr>
                    <td><?= $pin->no_anggota ?></td>
                    <td><?= substr($pin->token, 0, 25) ?>...</td>
                    <td>
                        <div class='bar<?= $pin->id ?> visually-hidden'><?= $pin->token ?></div>
                        <a href="#" class="copy" data-clipboard-action="copy" data-clipboard-target=".bar<?= $pin->id ?>">
                            <i class="fa-regular fa-copy"></i>
                        </a>
                        &nbsp;
                        <a href="<?= BASEURL ?>/member/pin/transfer-pin/<?= $pin->no_anggota ?>/" class="text-danger">
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