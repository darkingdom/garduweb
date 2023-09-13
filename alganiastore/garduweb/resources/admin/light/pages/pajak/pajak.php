<!-- 
total pajak tahun ini
total pajak bulan ini
rincian pajak bulanan ini
rincian pajak tahunan semua 
-->

<!-- <div style="height: 150px; background-color:#FFF"> -->

<!-- </div> -->

<div id="content">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="border rounded border-start-0">
                        <div class="border-start border-5 border-danger p-3 rounded">
                            <div style="font-size: 14px;">
                                Pajak bulan ini
                            </div>
                            <div class="fs-4">
                                <?= Numeric::numberFormat($data->pajak_bulan_ini->total) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="border rounded border-start-0">
                        <div class="border-start border-5 border-primary p-3 rounded">
                            <div style="font-size: 14px;">
                                Pajak tahun ini
                            </div>
                            <div class="fs-4">
                                <?= Numeric::numberFormat($data->pajak_tahun_ini->total) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Pajak Bulanan <?= date('Y') ?>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush" style="font-size: 14px;">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Januari</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_jan->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Februari</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_feb->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Maret</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_mar->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>April</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_apr->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Mei</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_mei->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Juni</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_jun->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Juli</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_jul->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Agustus</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_aug->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>September</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_sep->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Oktober</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_okt->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Nopember</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_nop->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>Desember</div>
                                <div><?= Numeric::numberFormat($data->pajak_bulan_des->total) ?></div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Pajak Tahunan
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush" style="font-size: 14px;">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') - 5 ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_5->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') - 4 ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_4->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') - 3 ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_3->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') - 2 ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_2->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') - 1 ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_1->total) ?></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div><?= date('Y') ?></div>
                                <div><?= Numeric::numberFormat($data->pajak_tahun_ini->total) ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>