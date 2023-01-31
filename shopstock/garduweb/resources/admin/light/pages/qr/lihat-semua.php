<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Filter
        </div>
        <div class="card-body">
            <form action="<?= BASEURL ?>/admin/qr/action/qr/filter/" method="POST">
                <div class="row">
                    <div class="col-sm-3">
                        <select class="form-select" id="selGroup" name="selGroup">
                            <option value="lihat-semua">Tampilkan Semua</option>
                            <?php foreach ($data->group as $group) : ?>
                                <option value="<?= $group->group_qr ?>" <?php if ($group->group_qr == @$data->select_group) echo "selected"; ?>><?= $group->group_qr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <button class="btn btn-primary" name="btn-filter" type="submit">Filter</button>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-print"></i> Print</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            Tabel QR CODE
        </div>
        <div class="card-body">
            <form>
                <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                    <thead>
                        <tr>
                            <th data-align="center" data-width="40"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                            <th data-sortable="true">Tanggal Generate</th>
                            <th data-sortable="true">QR CODE</th>
                            <th data-sortable="true">Group</th>
                            <!-- <th data-sortable="true">Status</th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->qr as $qr) : ?>
                            <tr>
                                <td><input type="checkbox" name="chkID[]" value="<?= $qr->id ?>"></td>
                                <td><?= $qr->tanggal_generate ?></td>
                                <td><?= $qr->qr_code ?></td>
                                <td><?= $qr->group_qr ?></td>
                                <!-- <td>
                                    < ?php
                                    if ($qr->status_digunakan == '1') :
                                        echo "<span class='fw-bold fst-italic text-success'>digunakan</span>";
                                    endif;
                                    ?>
                                </td> -->
                                <td>
                                    <div class="text-nowrap">
                                        <!-- <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Download">
                                            <i class="fa-solid fa-download"></i>
                                        </a> -->
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-title="Print">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="mt-2">
                    <button class="btn btn-danger btn-xsm" data-bs-toggle="tooltip" data-bs-title="Delete"> <i class="fa-solid fa-trash-can"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>