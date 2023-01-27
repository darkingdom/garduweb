<?php
$x = @$_GET['x'];
if ($x == "BERHASIL") :
    echo "<div style='color:green'>BERHASIL</div>";
elseif ($x == "GAGAL") :
    echo "<div style='color:red'>GAGAL</div>";
endif;
?>
<form action="./action/ganti-akun.php" method="POST">
    <div>
        <table>
            <tr>
                <td>Token</td>
                <td><input type="text" name="token" /></td>
            </tr>
            <tr>
                <td>Akun Trading Lama</td>
                <td><input type="text" name="akun_lama" /></td>
            </tr>
            <tr>
                <td>Akun Trading Baru</td>
                <td><input type="text" name="akun_baru" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button name="btn_ganti" type="submit">GANTI AKUN</button>
                    <span style="margin-left: 20px;"><a href="./">Kembali</a></span>
                </td>
            </tr>

        </table>
    </div>
</form>