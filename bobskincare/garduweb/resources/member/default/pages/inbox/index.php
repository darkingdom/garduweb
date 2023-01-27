<div class="content">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pesan</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->msg as $msg) :
            ?>
                <tr>
                    <td><?= $msg->tanggal_kirim ?></td>
                    <td>
                        <div class="fs-6">
                            <a href="<?= BASEURL ?>/member/inbox/lihat-pesan/<?= $msg->id ?>/" class="text-dark">
                                <?php
                                if ($msg->dibaca == '1') :
                                    echo $msg->judul;
                                else :
                                    echo "<b>" . $msg->judul . "</b>";
                                endif;
                                ?>
                            </a>
                        </div>
                        <div class="text-secondary" style="font-size: 12px;"><?= $msg->pengirim ?></div>
                    </td>
                    <td>
                        <!-- <a href="#" class="text-danger">Hapus</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>