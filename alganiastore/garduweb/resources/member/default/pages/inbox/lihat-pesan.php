<div class="content">
    <div class="border border-2 border-secondary rounded">
        <div class="border-bottom border-1 border-secondary p-2">
            <div style="font-size: 18px;"><?= $data->msg->judul ?></div>
            <div class="text-secondary" style="font-size: 10px;"><?= $data->msg->tanggal_kirim ?></div>
            <div class="text-secondary" style="font-size: 12px;"><?= $data->msg->pengirim ?></div>
        </div>
        <div class="p-2">
            <?= $data->msg->isi_pesan ?>
        </div>
    </div>
</div>