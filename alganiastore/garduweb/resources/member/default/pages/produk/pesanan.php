<div class="content">
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
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
            foreach ($data->pesanan as $pesanan) :
            ?>
                <tr>
                    <td><?= $pesanan->no_invoice ?></td>
                    <td><?= $pesanan->tanggal_pesan ?></td>
                    <td align="right"><?= $pesanan->qty ?></td>
                    <td align="right"><?= Numeric::numberFormat($pesanan->total_harga) ?></td>
                    <td>
                        <?php
                        echo $pesanan->no_resi;
                        echo "<br/>";
                        echo $pesanan->ekspedisi;
                        ?>
                    </td>
                    <td>
                        <?php if ($pesanan->barang_dikirim == 1) : ?>
                            <a href="#" title="Confirm" class="badge text-bg-warning media-confirm" data-id="<?= $pesanan->id ?>" data-bs-toggle="modal" data-bs-target="#modalConfirm">
                                Barang diterima</a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- <tr>
                <td>204673313574</td>
                <td>2022-02-25 24:12:12</td>
                <td align="right">2</td>
                <td align="right">69.500</td>
                <td>166586399 (Pos Indonesia)</td>
                <td><a href="#" class="badge text-bg-success">Sudah dibayar</a> <a href="#" class="badge text-bg-warning">Barang sudah diterima</a></td>
            </tr>
            <tr>
                <td>204673313574</td>
                <td>2022-02-25 24:12:12</td>
                <td align="right">2</td>
                <td align="right">69.500</td>
                <td>166586399 (Pos Indonesia)</td>
                <td><a href="#" class="badge text-bg-success">Sudah dibayar</a></td>
            </tr> -->
        </tbody>
    </table>

    <?php
    include COMPONENTADM . "/component/atom/modalConfirm.php";
    ?>

</div>


<script>
    $(document).ready(function() {
        $(".media-confirm").on("click", function() {
            const id = $(this).data("id");
            $("#modal-confirm-id").val(id);
            $("#modal-desc").html('Konfirmasi barang sudah diterima?');
            $("#modalConfirmURL").attr(
                "action",
                baseurl + "/member/produk/action/barang-diterima/"
            );
        });
    });
</script>