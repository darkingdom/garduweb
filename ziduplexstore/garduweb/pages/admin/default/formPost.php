<div class="content">

    <div class="container">
        <form action="
        <?php
        if (isset($data->post->id)) {
            echo BASEURL . "/admin/setPost/update";
        } else {
            echo BASEURL . "/admin/setPost/save";
        }
        ?>
            " method="POST">
            <input type="hidden" name="uid" value="<?= @$data->post->uid ?>" />

            <!-- <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtTitlePost" name="txtTitlePost" placeholder="Nama Lengkap" value="<?= @$data->post->titlePost ?>">
                <label for="txtTitlePost">Title Post</label>
            </div> -->

            <div class="col-auto form-floating mb-3">
                <select class="form-select" name="txtPair" id="txtPair">
                    <option value="0">Pilihan</option>
                    <?php foreach ($data->pair as $pair) : ?>
                        <option value="<?= $pair->pair ?>" <?php if ($pair->pair == @$data->post->pair) echo "selected"; ?>><?= $pair->pair ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="txtPair">Pair</label>
            </div>

            <div class="form-floating  mb-3">
                <input class="form-control" id="txtGambar" name="txtGambar" placeholder="Gambar" value="<?= @$data->post->gambar ?>">
                <label for="txtGambar">Gambar</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="txtDeskripsi" id="txtDeskripsi" placeholder="Deskripsi"><?= @$data->post->deskripsi ?></textarea>
                <label for="txtDeskripsi">Deskripsi</label>
            </div>

            <div class="col-auto form-floating mb-3">
                <select class="form-select" name="txtPosition" id="txtPosition">
                    <option value="0">Pilihan</option>
                    <option value="BUY" <?php if (@$data->post->positionTrade == "BUY") echo "selected"; ?>>BUY</option>
                    <option value="SELL" <?php if (@$data->post->positionTrade == "SELL") echo "selected"; ?>>SELL</option>
                    <option value="BUY LIMIT" <?php if (@$data->post->positionTrade == "BUY LIMIT") echo "selected"; ?>>BUY LIMIT</option>
                    <option value="SELL LIMIT" <?php if (@$data->post->positionTrade == "SELL LIMIT") echo "selected"; ?>>SELL LIMIT</option>
                    <option value="BUY STOP" <?php if (@$data->post->positionTrade == "BUY STOP") echo "selected"; ?>>BUY STOP</option>
                    <option value="SELL STOP" <?php if (@$data->post->positionTrade == "SELL STOP") echo "selected"; ?>>SELL STOP</option>
                </select>
                <label for="txtPosition">Position Trade</label>
            </div>

            <div class="col-auto form-floating mb-3">
                <select class="form-select" name="txtTimeframe" id="txtTimeframe">
                    <option value="0">Pilihan</option>
                    <option value="M5" <?php if (@$data->post->timeFrame == "M5") echo "selected"; ?>>M5</option>
                    <option value="M15" <?php if (@$data->post->timeFrame == "M15") echo "selected"; ?>>M15</option>
                    <option value="M30" <?php if (@$data->post->timeFrame == "M30") echo "selected"; ?>>M30</option>
                    <option value="H1" <?php if (@$data->post->timeFrame == "H1") echo "selected"; ?>>H1</option>
                    <option value="H4" <?php if (@$data->post->timeFrame == "H4") echo "selected"; ?>>H4</option>
                    <option value="D1" <?php if (@$data->post->timeFrame == "D1") echo "selected"; ?>>D1</option>
                    <option value="Weekly" <?php if (@$data->post->timeFrame == "Weekly") echo "selected"; ?>>Weekly</option>
                </select>
                <label for="txtTimeframe">Timeframe</label>
            </div>

            <div class="col-auto form-floating">
                <select class="form-select" name="txtTradeType" id="txtTradeType">
                    <option value="0">Pilihan</option>
                    <option value="long-term" <?php if (@$data->post->tradeType == "long-term") echo "selected"; ?>>Long-term</option>
                    <option value="short-term" <?php if (@$data->post->tradeType == "short-term") echo "selected"; ?>>Short-term</option>
                </select>
                <label for="txtTradeType">Trade Method</label>
            </div>

            <div class="col-12 my-5 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">SIMPAN</button>
            </div>
        </form>
    </div>

</div>