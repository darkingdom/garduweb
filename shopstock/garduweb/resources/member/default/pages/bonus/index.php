<div class="content">
    <h2>Rp <?= Numeric::numberFormat($data->wallet->wallet) ?></h2>
    <hr />
    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td>Bonus Bulan ini</td>
                    <td><?= Numeric::numberFormat($data->bonus_bulan_ini->total) ?></td>
                </tr>
                <!-- <tr>
                    <td>Bonus Belanja Bulan ini</td>
                    <td>25.000</td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>