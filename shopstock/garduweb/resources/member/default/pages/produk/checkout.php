<div class="content">

    <?php Flasher::flash() ?>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th style="text-align: right;">Jumlah</th>
                <th style="text-align: right;">Harga</th>
                <th style="text-align: right;">Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->keranjang as $keranjang) :
                $produk = MemberModel::getProdukByID($keranjang->id_produk);
                $harga = $keranjang->qty * $produk->harga;
                @$jumlah = $jumlah + $harga;
                $berat = $produk->berat * $keranjang->qty;
                @$berat_total = $berat_total + $berat;
                @$total_qty = $total_qty + $keranjang->qty;

            ?>
                <tr>
                    <td><?= $produk->nama_produk ?></td>
                    <td align="right"><?= $keranjang->qty ?></td>
                    <td align="right"><?= Numeric::numberFormat($produk->harga) ?></td>
                    <td align="right"><?= Numeric::numberFormat($harga) ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right"><?= Numeric::numberFormat($jumlah) ?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="right">Ppn</td>
                <td align="right">
                    <?php
                    $ppn = ($jumlah * $data->ppn->ppn) / 100;
                    echo Numeric::numberFormat($ppn);
                    ?>
                </td>
                <td></td>
            <tr>
                <td colspan="3" align="right">Ongkir</td>
                <td align="right">
                    <?php
                    $ongkir = $data->ongkir->ongkir;
                    $total_ongkir = ceil($berat_total / 1000) * $ongkir;
                    echo Numeric::numberFormat($total_ongkir);
                    ?>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>BAYAR</b></td>
                <td align="right">
                    <b>
                        <?php
                        $bayar = $ppn + $ongkir + $jumlah;
                        echo Numeric::numberFormat($bayar);
                        ?>
                    </b>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <hr />
    <div>
        <form method="POST" action="<?= BASEURL ?>/member/produk/action/bayar/">
            <input type="hidden" name="total_berat" value="<?= $berat_total ?>">
            <input type="hidden" name="total_harga" value="<?= $bayar ?>">
            <input type="hidden" name="qty" value="<?= $total_qty ?>">
            <button type="submit" class="btn btn-success">BAYAR</button>
        </form>
    </div>
</div>