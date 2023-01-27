<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Kasir
        </div>
        <form>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama Kasir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
                <div class="row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            Tabel Kasir
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama</th>
                        <th data-sortable="true">No. HP</th>
                        <th data-sortable="true">Username</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmad Fauzi</td>
                        <td>085852619898</td>
                        <td>lemon</td>
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