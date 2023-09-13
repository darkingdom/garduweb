<div class="content">
    <div class="row">
        <div class="col">
            <div class="border-start border-4 rounded-start border-primary">
                <div class="border border-1 rounded-end p-2 border-start-0">

                    <div style="font-size: 14px;">Pesanan</div>
                    <div class="fs-4">-</div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-4 rounded-start border-warning">
                <div class="border border-1 rounded-end p-2 border-start-0  ">

                    <div style="font-size: 14px;">Bayar</div>
                    <div class="fs-4">-</div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="border-start border-4 rounded-start border-success">
                <div class="border border-1 rounded-end p-2 border-start-0  ">

                    <div style="font-size: 14px;">Bayar diterima</div>
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
                    <tr <?php if ($order->pesanan_diterima == '1') echo "style='background-color: #6ff55b;'"; ?>>
                        <td><?= $order->tanggal_pesan ?></td>
                        <td><a href="#"><?= $order->no_invoice ?></a></td>
                        <td>
                            <div><?= $order->no_anggota ?></div>
                            <!-- <div>Jen Tyaw lie</div> -->
                        </td>
                        <td><?= Numeric::numberFormat($order->total_harga) ?></td>
                        <td>
                            <div style="font-size: 12px; font-weight: bold;"><?= $order->penerima_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->alamat_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->propinsi_kirim ?></div>
                            <div style="font-size: 12px;"><?= $order->no_ponsel_kirim ?></div>
                        </td>
                        <td>
                            <?php if ($order->pesanan_diterima == '1') : ?>
                                <a href="<?= BASEURL ?>/admin/order/ekspedisi/<?= $order->id ?>/" class="badge text-bg-success">
                                    Kirim no resi
                                </a>
                            <?php else : ?>
                                <a href="#" title="Confirm" class="media-confirm badge text-bg-primary" data-id="<?= $order->id ?>" data-bs-toggle="modal" data-bs-target="#modalConfirm">
                                    Proses
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

    <?php
    include COMPONENTADM . "/component/atom/modalConfirm.php";
    ?>

</div>

<script>
    $(document).ready(function() {
        $(".media-confirm").on("click", function() {
            const id = $(this).data("id");
            $("#modal-confirm-id").val(id);
            $("#modal-desc").html("Proses Order ini?");
            $("#modalConfirmURL").attr(
                "action",
                baseurl + "/admin/order/action/proses-order/"
            );
        });
    });
</script>