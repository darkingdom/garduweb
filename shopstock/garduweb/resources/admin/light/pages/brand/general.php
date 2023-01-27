<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            BRAND
        </div>
        <form>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama merek</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div>
                <div class="row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">URL Logo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor" placeholder="Optional">
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
            Tabel Brand
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama Merek</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cardinal</td>
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