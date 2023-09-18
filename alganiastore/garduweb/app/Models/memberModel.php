<?php
class MemberModel
{
    public $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // GET =========================================================================================================
    public function getMemberByUsername($username)
    {
        $this->db->query("SELECT * FROM `member` WHERE no_ponsel=:username || no_anggota=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getMemberByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM `member` WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data);
        return $this->db->single();
    }

    public function getVoucherByID($data)
    {
        $this->db->query("SELECT * FROM `voucher` WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getPINByToken($data)
    {
        $this->db->query("SELECT * FROM `pin` WHERE token=:token");
        $this->db->bind('token', $data);
        return $this->db->single();
    }

    public function getUplineByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM `upline` WHERE no_anggota=:anggota");
        $this->db->bind('anggota', $data);
        return $this->db->single();
    }

    public function getKeranjangByProduk($data)
    {
        $this->db->query("SELECT * FROM `keranjang` WHERE id_produk=:id_produk && no_anggota=:anggota");
        $this->db->bind('id_produk', $data['id']);
        $this->db->bind('anggota', Session::get('idMB'));
        return $this->db->single();
    }

    static function getProdukByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM produk WHERE id=:id");
        $db->bind('id', $data);
        return $db->single();
    }

    public function getProdukByID_($data)
    {
        $this->db->query("SELECT * FROM produk WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getLastInvoice()
    {
        $this->db->query("SELECT MAX(no_invoice) AS invoice FROM `penjualan`");
        return $this->db->single();
    }

    public function getWalletByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM wallet WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data);
        return $this->db->single();
    }

    public function getOnkirByPropinsi($data)
    {
        $this->db->query("SELECT * FROM ongkos_kirim WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getSetting()
    {
        $this->db->query("SELECT * FROM setting");
        return $this->db->single();
    }

    public function getPenjualanByID($data)
    {
        $this->db->query("SELECT * FROM penjualan WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getVoucherByToken($data)
    {
        $this->db->query("SELECT * FROM voucher WHERE token=:token && status!='1'");
        $this->db->bind('token', $data['txtToken']);
        return $this->db->single();
    }

    public function getMsgByNoID($data)
    {
        $this->db->query("SELECT * FROM pesan WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    // END GET =====================================================================================================

    // GET ALL =====================================================================================================
    public function getAllPIN()
    {
        $this->db->query("SELECT * FROM `pin` WHERE pemilik=:no_anggota && status!=1");
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->resultSet();
    }

    public function getAllVoucher()
    {
        $this->db->query("SELECT * FROM `voucher` WHERE pemilik=:no_anggota && status!=1");
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->resultSet();
    }

    public function getAllRiwayatTransferPIN()
    {
        $this->db->query("SELECT * FROM `riwayat_transfer_pin` WHERE pengirim=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->resultSet();
    }

    public function getAllRiwayatTransferVoucher()
    {
        $this->db->query("SELECT * FROM `riwayat_transfer_voucher` WHERE pengirim=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->resultSet();
    }

    public function getAllPaketProduk()
    {
        $this->db->query("SELECT * FROM `produk` WHERE type_produk='paket'");
        return $this->db->resultSet();
    }

    public function getAllProduk()
    {
        $this->db->query("SELECT * FROM `produk` WHERE type_produk!='paket'");
        return $this->db->resultSet();
    }

    public function getAllKeranjang()
    {
        $this->db->query("SELECT * FROM `keranjang` WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->resultSet();
    }

    static function getAllUplineByNoAnggota($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `upline` WHERE upline1=:no_anggota");
        $db->bind('no_anggota', $data);
        return $db->resultSet();
    }

    public function getAllPropinsi()
    {
        $this->db->query("SELECT * FROM `ongkos_kirim` ORDER BY propinsi ASC");
        return $this->db->resultSet();
    }

    public function getAllPesananByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM `penjualan` WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data);
        return $this->db->resultSet();
    }

    public function getAllBarangByInvoice($data)
    {
        $this->db->query("SELECT * FROM penjualan_barang WHERE no_invoice=:no_invoice");
        $this->db->bind('no_invoice', $data);
        return $this->db->resultSet();
    }

    public function getAllRiwayatBonusByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM riwayat_bonus WHERE no_anggota=:no_anggota ORDER BY id DESC");
        $this->db->bind('no_anggota', $data);
        return $this->db->resultSet();
    }

    public function getAllMessageByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM pesan WHERE tujuan=:no_anggota ORDER BY id DESC");
        $this->db->bind('no_anggota', $data);
        return $this->db->resultSet();
    }

    public function getAllPesananSelesaiByNoAnggota($data)
    {
        $this->db->query("SELECT * FROM penjualan WHERE no_anggota=:no_anggota && barang_diterima='1'  ORDER BY id DESC");
        $this->db->bind('no_anggota', $data);
        return $this->db->resultSet();
    }
    // END GET ALL =================================================================================================

    // COUNT DATA ==================================================================================================
    public function countMemberByUID($uid)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE uuid=:uuid");
        $this->db->bind('uuid', $uid);
        return $this->db->single();
    }

    public function countUsername($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE no_ponsel=:username || no_anggota=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countLogin($data)
    {
        $password = hash('sha256', $data['password']);
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE (no_ponsel=:username || no_anggota=:username) && password='$password'");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countAnggotaByPIN($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE uuid=:uuid && no_anggota=:no_anggota && pin=:pin");
        $this->db->bind('uuid', Session::get('uidMB'));
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('pin', $data['pin']);
        return $this->db->single();
    }

    public function countMyPIN($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `pin` WHERE no_anggota=:no_anggota && pemilik=:idMB");
        $this->db->bind('no_anggota', $data);
        $this->db->bind('idMB', Session::get('idMB'));
        return $this->db->single();
    }

    public function countMyVoucher($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `voucher` WHERE id=:id && pemilik=:idMB");
        $this->db->bind('id', $data);
        $this->db->bind('idMB', Session::get('idMB'));
        return $this->db->single();
    }

    public function countMemberByNoAnggota($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data['txtNoAnggota']);
        return $this->db->single();
    }

    public function countMyPINByToken($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `pin` WHERE pemilik=:no_anggota && token=:token && status!='1'");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('token', $data['txtToken']);
        return $this->db->single();
    }

    public function countNetworkByNoAnggota($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `upline` WHERE no_anggota=:no_anggota && (upline1=:upline || upline2=:upline || upline3=:upline || upline4=:upline || upline5=:upline)");
        $this->db->bind('no_anggota', $data['txtNoAnggota']);
        $this->db->bind('upline', Session::get('idMB'));
        return $this->db->single();
    }

    public function countKeranjangByProduk($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `keranjang` WHERE id_produk=:id_produk && no_anggota=:no_anggota ");
        $this->db->bind('id_produk', $data['id']);
        $this->db->bind('no_anggota', Session::get('idMB'));
        return $this->db->single();
    }

    static function countUplineByNoAnggota($data)
    {
        $db = new Database();
        $db->query("SELECT COUNT(*) AS total FROM `upline` WHERE upline1=:no_anggota");
        $db->bind('no_anggota', $data);
        return $db->single();
    }

    public function countBonusThisMonth($data)
    {
        $this->db->query("SELECT SUM(bonus) AS total FROM `riwayat_bonus` WHERE no_anggota=:no_anggota && MONTH(tanggal_bonus)=:bulan && YEAR(tanggal_bonus)=:tahun");
        $this->db->bind('no_anggota', $data['no_anggota']);
        $this->db->bind('bulan', $data['bulan']);
        $this->db->bind('tahun', $data['tahun']);
        return $this->db->single();
    }


    public function countMemberByPassword($data)
    {
        $password = hash('sha256', $data['txtPasswordLama']);
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE no_anggota=:no_anggota && password=:password");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    public function countMemberByPIN($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE no_anggota=:no_anggota && pin=:pin");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('pin', $data['txtPIN']);
        return $this->db->single();
    }
    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================
    public function updatePIN($data)
    {
        $this->db->query("UPDATE pin SET pemilik=:penerimaPIN WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data['pin']);
        $this->db->bind('penerimaPIN', $data['txtNoAnggota']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateVoucher($data)
    {
        $this->db->query("UPDATE voucher SET pemilik=:penerima WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('penerima', $data['txtNoAnggota']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePINActiveByAnggota($data)
    {
        $this->db->query("UPDATE pin SET tanggal_aktif=NOW(), status='1' WHERE no_anggota=:anggota");
        $this->db->bind('anggota', $data);
        $this->db->execute();
    }

    public function updateKeranjangByID($data)
    {
        $this->db->query("UPDATE `keranjang` SET qty=:qty WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('qty', (string) $data['qty']);
        $this->db->execute();
    }

    public function updateAlamatKirim($data)
    {
        $this->db->query("UPDATE `member` SET alamat_kirim=:alamat, propinsi_kirim=:propinsi, penerima_kirim=:penerima, no_ponsel_kirim=:ponsel  WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('penerima', $data['txtNama']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('propinsi', $data['selPropinsi']);
        $this->db->bind('ponsel', $data['txtPonsel']);
        $this->db->execute();
    }

    public function updateWalletByNoAnggota($data)
    {
        $this->db->query("UPDATE wallet SET wallet=:wallet WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data['no_anggota']);
        $this->db->bind('wallet', (string)$data['wallet']);
        $this->db->execute();
    }

    public function updatePenjualanByID($data)
    {
        $this->db->query("UPDATE penjualan SET tanggal_terima_barang=NOW(), barang_diterima='1' WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateVoucherByID($data)
    {
        $this->db->query("UPDATE voucher SET tanggal_aktif=NOW(), status='1', mengaktifkan=:aktif WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->bind('aktif', Session::get('idMB'));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateProfile($data)
    {
        $this->db->query("UPDATE `member` SET nama=:nama, alamat=:alamat, kota=:kota, 
                                            propinsi=:propinsi, no_ponsel=:no_ponsel, email=:email
                                            WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('nama', $data['txtNama']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('kota', $data['txtKota']);
        $this->db->bind('propinsi', $data['selPropinsi']);
        $this->db->bind('no_ponsel', $data['txtPonsel']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePasswordByNoAnggota($data)
    {
        $password = hash('sha256', $data['txtPasswordBaru']);
        $this->db->query("UPDATE `member` SET password=:password WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('password', $password);
        $this->db->execute();
    }

    public function updateBankByNoAnggota($data)
    {
        $this->db->query("UPDATE `member` SET bank=:bank, no_rekening=:no_rekening, an=:an WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('bank', $data['txtBank']);
        $this->db->bind('no_rekening', $data['txtNomorRekening']);
        $this->db->bind('an', $data['txtNamaPemilik']);
        $this->db->execute();
    }

    public function updatePINByNoAnggota($data)
    {
        $this->db->query("UPDATE `member` SET pin=:pin WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('pin', $data['txtPINBaru']);
        $this->db->execute();
    }

    public function updateStatusMsgByID($data)
    {
        $this->db->query("UPDATE `pesan` SET tanggal_dibaca=NOW(), dibaca='1' WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
    }

    public function updateKeanggotaanByNoAnggota($data)
    {
        $this->db->query("UPDATE `member` SET keanggotaan='Mitra' WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data);
        $this->db->execute();
    }

    // END UPDATE DATA =============================================================================================

    // CREATE ======================================================================================================
    public function simpanRiwayatTrasferPIN($data)
    {
        $this->db->query("INSERT INTO `riwayat_transfer_pin` (tanggal_kirim, no_anggota, pengirim, penerima)
                                        VALUES (NOW(),:pin,:pengirim,:penerima)");
        $this->db->bind('pin', $data['pin']);
        $this->db->bind('pengirim', Session::get('idMB'));
        $this->db->bind('penerima', $data['txtNoAnggota']);
        $this->db->execute();
    }

    public function simpanRiwayatTrasferVoucher($data)
    {
        $this->db->query("INSERT INTO `riwayat_transfer_voucher` (tanggal_kirim, nominal, pengirim, penerima)
                                        VALUES (NOW(),:nominal,:pengirim,:penerima)");
        $this->db->bind('nominal', $data['nominal']);
        $this->db->bind('pengirim', Session::get('idMB'));
        $this->db->bind('penerima', $data['txtNoAnggota']);
        $this->db->execute();
    }

    public function simpanAnggota($data, $custom)
    {
        $uuid = '';
        $password = '';
        $this->db->query("INSERT INTO `member` (uuid,tanggal_gabung,nama,alamat,
                                                kota,propinsi,no_ponsel,password,
                                                no_anggota,pin,keanggotaan,email,
                                                status_aktif) 
                                                VALUES (
													:uuid,NOW(),:nama,:alamat,
                                                    :kota,:propinsi,:no_ponsel,:password,
                                                    :no_anggota,:pin,'User',:email,
                                                    '1'
                                                )");
        $this->db->bind('uuid', $uuid);
        $this->db->bind('nama', $data['txtNama']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('kota', $data['txtKota']);
        $this->db->bind('propinsi', $data['selPropinsi']);
        $this->db->bind('no_ponsel', $data['txtPonsel']);
        $this->db->bind('password', $password);
        $this->db->bind('no_anggota', $custom['no_anggota']);
        $this->db->bind('pin', $custom['pin']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->execute();
    }

    public function simpanUpline($data, $custom)
    {
        $this->db->query("INSERT INTO `upline` (no_anggota,sponsor,upline1,upline2,
                                                upline3,upline4,upline5) 
                                                VALUES (
                                                    :anggota,:sponsor,:upline1,:upline2,
                                                    :upline3,:upline4,:upline5
                                                )");
        $this->db->bind('anggota', $custom['no_anggota']);
        $this->db->bind('sponsor', Session::get('idMB'));
        $this->db->bind('upline1', Session::get('upline'));
        $this->db->bind('upline2', $data->upline1);
        $this->db->bind('upline3', $data->upline2);
        $this->db->bind('upline4', $data->upline3);
        $this->db->bind('upline5', $data->upline4);
        $this->db->execute();
    }

    public function simpanWallet($data)
    {
        $this->db->query("INSERT INTO `wallet` (no_anggota, wallet) VALUES (:anggota, '0')");
        $this->db->bind('anggota', $data['no_anggota']);
        $this->db->execute();
    }

    public function simpanKeranjang($data)
    {
        $this->db->query("INSERT INTO `keranjang` (id_produk, no_anggota, qty) VALUES (:id_produk, :no_anggota, :qty)");
        $this->db->bind('id_produk', $data['id']);
        $this->db->bind('no_anggota', Session::get('idMB'));
        $this->db->bind('qty', $data['qty']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanPenjualan($data, $custom)
    {
        $this->db->query("INSERT INTO `penjualan` (tanggal_pesan, no_invoice, no_anggota, total_berat, 
                                                    total_harga, qty, penerima_kirim, 
                                                    alamat_kirim, propinsi_kirim, no_ponsel_kirim) 
                                                    VALUES (
                                                        NOW(),:invoice,:no_anggota,:berat,
                                                        :harga,:qty,:penerima,
                                                        :alamat,:propinsi,:ponsel
                                                    )");
        $this->db->bind('invoice', $custom['invoice']);
        $this->db->bind('no_anggota', $custom['no_anggota']);
        $this->db->bind('berat', $data['total_berat']);
        $this->db->bind('harga', $data['total_harga']);
        $this->db->bind('qty', $data['qty']);
        $this->db->bind('penerima', $custom['penerima']);
        $this->db->bind('alamat', $custom['alamat']);
        $this->db->bind('propinsi', $custom['propinsi']);
        $this->db->bind('ponsel', $custom['ponsel']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanPenjualanBarang($data, $custom)
    {
        $this->db->query("INSERT INTO `penjualan_barang` (no_invoice, id_produk, no_anggota, qty) 
                                                            VALUES (
                                                                :invoice, :id_produk, :no_anggota, :qty
                                                            )");
        $this->db->bind('invoice', $custom['invoice']);
        $this->db->bind('id_produk', $data->id_produk);
        $this->db->bind('no_anggota', $data->no_anggota);
        $this->db->bind('qty', $data->qty);
        $this->db->execute();
    }

    public function simpanRiwayatBonus($data)
    {
        $this->db->query("INSERT INTO `riwayat_bonus` (tanggal_bonus, no_anggota, bonus, type, bonus_dari) 
                                                        VALUES (
                                                            NOW(), :no_anggota, :bonus, :type, :dari
                                                        )");
        $this->db->bind('no_anggota', $data['upline']);
        $this->db->bind('bonus', (string)$data['bonus']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('dari', $data['dari']);
        $this->db->execute();
    }

    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    public function deleteKeranjangByID($data)
    {
        $this->db->query("DELETE FROM keranjang WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END DELETE DATA =============================================================================================
}
