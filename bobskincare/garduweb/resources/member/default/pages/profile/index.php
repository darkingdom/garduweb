<div class="content">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>No Anggota</td>
                <td><?= $data->member->no_anggota ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= $data->member->nama ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $data->member->alamat ?></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td><?= $data->member->kota ?></td>
            </tr>
            <tr>
                <td>Propinsi</td>
                <td><?= $data->member->propinsi ?></td>
            </tr>
            <tr>
                <td>No Ponsel</td>
                <td><?= $data->member->no_ponsel ?></td>
            </tr>
            <tr>
                <td>email</td>
                <td><?= $data->member->email ?></td>
            </tr>
            <tr>
                <td>Tingkat Anggota</td>
                <td><?= $data->member->keanggotaan ?></td>
            </tr>
        </tbody>
    </table>

    <div class="mt-5">
        <a href="<?= BASEURL ?>/member/profile/ganti-profile/" class="btn btn-primary">EDIT PROFIL</a>
    </div>
</div>