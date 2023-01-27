<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="border-start border-4 rounded-start border-warning">
                <div class="border border-1 rounded-end p-2 border-start-0">

                    <div style="font-size: 14px;">Dikirim</div>
                    <div class="fs-4">-</div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="border-start border-4 rounded-start border-success">
                <div class="border border-1 rounded-end p-2 border-start-0  ">

                    <div style="font-size: 14px;">Diterima</div>
                    <div class="fs-4">-</div>

                </div>
            </div>
        </div>

    </div>

    <hr />

    <div>
        <!-- <table class="table"> -->
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Tanggal</th>
                    <th data-sortable="true">No. Invoice</th>
                    <th data-sortable="true">Anggota</th>
                    <th data-sortable="true" data-align="right">Bayar</th>
                    <th data-sortable="true">Alamat Kirim</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->order as $order) :
                ?>
                    <tr <?php if ($order->barang_diterima != '1') echo "style='background-color: #faea73;'"; ?>>
                        <td><?= $order->tanggal_pesan ?></td>
                        <td><?= $order->no_invoice ?></td>
                        <td>
                            <div><?= $order->no_anggota ?></div>
                            <!-- <div>Jen Tyaw lie</div> -->
                        </td>
                        <td><?= Numeric::numberFormat($order->total_harga); ?></td>
                        <td>
                            <div style="font-size: 12px; font-weight: bold;"><?= $order->penerima_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->alamat_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->propinsi_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->no_ponsel_kirim ?></div>
                        </td>
                        <td>
                            <?php
                            if ($order->barang_diterima == '1') :
                            ?>
                                <span class="text-success fst-italic fw-bold">selesai!</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
                <!-- <tr style="background-color: #faea73;">
                    <td>2022-12-24 16:12:33</td>
                    <td>202206238766</td>
                    <td>
                        <div>SK00256</div>
                        <div>Jen Tyaw lie</div>
                    </td>
                    <td>250.000</td>
                    <td>
                        <div style="font-size: 12px; font-weight: bold;">Ahmad Fauzi</div>
                        <div style="font-size: 12px;">Jl. Kilisari RT/RW 02/02 Desa Selosari Kecamatan Kandat, Kab. Kediri</div>
                        <div style="font-size: 12px;">Jawa Timur</div>
                    </td>
                    <td> -->
                <!-- <span class="text-success fst-italic fw-bold">selesai!</span> -->
                <!-- </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>