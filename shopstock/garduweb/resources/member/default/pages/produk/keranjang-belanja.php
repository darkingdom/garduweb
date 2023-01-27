<div class="content">
    <table class="table mb-5">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th style="text-align: right;">Jumlah</th>
                <th style="text-align: right;">Harga</th>
                <th style="text-align: right;">Total Harga</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->keranjang as $keranjang) :
                $produk = MemberModel::getProdukByID($keranjang->id_produk);
                $harga = $keranjang->qty * $produk->harga;
                @$jumlah = $jumlah + $harga;
            ?>
                <tr>
                    <td><?= $produk->nama_produk ?></td>
                    <td align="right"><?= $keranjang->qty ?></td>
                    <td align="right"><?= Numeric::numberFormat($produk->harga) ?></td>
                    <td align="right"><?= Numeric::numberFormat($harga) ?></td>
                    <td>
                        <!-- <a href="#"><i class="fa-solid fa-minus"></i></a> &nbsp;
                        <a href="#"><i class="fa-solid fa-plus"></i></a> &nbsp; -->
                        <a href="#" title="Delete" class="text-light media-delete" data-id="<?= $keranjang->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                            <i class="fa-solid fa-trash-can text-danger"></i>
                        </a>
                    </td>
                </tr>
            <?php
            endforeach
            ?>
            <tr>
                <td></td>
                <td></td>
                <td>Jumlah</td>
                <td align="right"><?= Numeric::numberFormat(@$jumlah) ?></td>
            </tr>
        </tbody>
    </table>

    <hr />
    <form method="POST" action="<?= BASEURL ?>/member/produk/action/simpan-checkout/">
        <div class="mt-4">
            <!-- <textarea class="form-control" placeholder="Alamat pengiriman"></textarea> -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtNama" name="txtNama" value="<?= $data->penerima->penerima_kirim ?>">
                <label>Nama Penerima</label>
            </div>

            <div class="form-floating mb-3">
                <textarea type="text" class="form-control" id="txtAlamat" name="txtAlamat"><?= $data->penerima->alamat_kirim ?></textarea>
                <label>Alamat Pengiriman</label>
            </div>

            <div class="form-floating mb-3">
                <select id="selPropinsi" name="selPropinsi" class="form-select">
                    <option value="0">Pilihan...</option>
                    <?php
                    foreach ($data->propinsi as $propinsi) :
                    ?>
                        <option value="<?= $propinsi->id ?>" <?php if ($propinsi->id == $data->penerima->propinsi_kirim) echo "selected"; ?>><?= $propinsi->propinsi ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <label>Propinsi</label>
            </div>


            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtPonsel" name="txtPonsel" value="<?= $data->penerima->no_ponsel_kirim ?>">
                <label>No Handphone</label>
            </div>
        </div>

        <hr />
        <div>
            <!-- <a href="<?= BASEURL ?>/member/produk/checkout/" class="btn btn-warning">CHECKOUT</a> -->
            <button type="submit" class="btn btn-warning">CHECKOUT</button>
        </div>
    </form>


    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>

</div>

<script>
    $(document).ready(function() {
        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/member/produk/action/hapus-keranjang/"
            );
        });
    });
</script>