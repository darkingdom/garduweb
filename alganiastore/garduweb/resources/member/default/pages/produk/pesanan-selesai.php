<div class="content">
    <table class="table">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Tanggal Transaksi</th>
                <th style="text-align: right;">Total Item</th>
                <th style="text-align: right;">Total Harga</th>
                <th>No Resi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->order as $order) :
            ?>
                <tr>
                    <td><?= $order->no_invoice ?></td>
                    <td><?= $order->tanggal_pesan ?></td>
                    <td align="right"><?= $order->qty ?></td>
                    <td align="right"><?= Numeric::numberFormat($order->total_harga) ?></td>
                    <td>
                        <?php
                        echo $order->no_resi;
                        echo "<br/>";
                        echo $order->ekspedisi;
                        ?>
                    </td>
                    <td>
                        <span class="text-success fw-bold fst-italic">
                            <i class="fa-solid fa-check"></i> Selesai
                        </span>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>