<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Gudang / Etalase
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link <?php if ($data->tab == 'gudang') echo 'active'; ?>" aria-current="page" href="<?= BASEURL ?>/admin/gudang/general/gudang/">Gudang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($data->tab == 'etalase') echo 'active'; ?>"" href=" <?= BASEURL ?>/admin/gudang/general/etalase/">Etalase</a>
                </li>
            </ul>

            <?php if ($data->tab == 'gudang') : ?>
                <form>
                    <div class="mb-3 row">
                        <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama Gudang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                        </div>
                    </div>
                    <div class="row">
                        <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtNamaWarna" name="txtNamaWarna">
                        </div>
                    </div>
                </form>
            <?php endif ?>
            <?php if ($data->tab == 'etalase') : ?>
                <form>
                    <div class="mb-3 row">
                        <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama Gudang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Etalase</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                        </div>
                    </div>
                </form>
            <?php endif ?>
        </div>
        <div class="card-body border-top">
            <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            List Gudang / Etalase
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Gudang</th>
                        <th data-sortable="true">Etalase</th>
                        <th data-sortable="true">Lokasi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gudang A</td>
                        <td>R24</td>
                        <td>Barat Rumah</td>
                        <td>
                            <div class="text-nowrap">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Gudang B</td>
                        <td>A21</td>
                        <td>Depan Rumah</td>
                        <td>
                            <div class="text-nowrap">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>