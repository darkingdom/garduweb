<?php
class MemberController extends Controller
{
    public
        $member,
        $unread;

    public function __construct()
    {
        $this->model = $this->model('memberModel');
        $this->page = $this->page('memberView');
        $this->globalVar();
    }

    // ================================================================================= LOGIN

    public function globalVar()
    {
        $wallet = @$this->model->getWalletByNoAnggota(Session::get('idMB'))->wallet;
        Session::set('wallet', $wallet);
    }

    private function auth()
    {
        if (Session::get('loginMB') != 'logedIN') {
            $this->page->redirect('member');
        }
    }

    public function index()
    {
        if (Session::get('loginMB') != 'logedIN') {
            $this->page->login();
        } else {
            $countUID = $this->model->countMemberByUID(Session::get('uidMB'))->total;
            if ($countUID > 0) :
                $this->dashboard();
            else :
                $this->page->login();
            endif;
        }
    }

    public function login()
    {
        $post = $_POST;
        $username = $this->model->countUsername($post)->total;
        if ($username > 0) {
            $login = $this->model->countLogin($post)->total;
            if ($login > 0) {
                $admin = $this->model->getMemberByUsername($post['username']);
                Session::set('loginMB', 'logedIN');
                Session::set('uidMB', $admin->uuid);
                Session::set('idMB', $admin->no_anggota);
                Session::set('nameMB', $admin->nama);
                $result = $this->page->redirect('member');
            } else {
                $result = $this->page->redirect('member/loginFAILED');
            }
        } else {
            $result = $this->page->redirect('member/usernameFAILED');
        }
        return $result;
    }

    public function logout()
    {
        Session::destroyAll();
        $this->page->redirect('member');
    }

    // =============================================================== START DASHBOARD
    public function home()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $this->auth();
        // $data['totalPost'] = $this->model->countAllPost()->total;
        $this->page->dashboard();
    }
    // =============================================================== END DASHBOARD

    // =============================================================== START INBOX
    public function inbox($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'lihat-pesan') :
            $this->model->updateStatusMsgByID($act);
            $data['msg'] = $this->model->getMsgByNoID($act);
            $this->page->lihatPesan($data);
        else :
            $data['msg'] = $this->model->getAllMessageByNoAnggota(Session::get('idMB'));
            $this->page->inbox($data);
        endif;
    }
    // =============================================================== END INBOX

    // =============================================================== START PROFILE
    public function profile($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'ganti-profile') :
            $data['member'] = $this->model->getMemberByNoAnggota(Session::get('idMB'));
            $data['propinsi'] = $this->model->getAllPropinsi();
            $this->page->gantiProfile($data);
        elseif ($page == 'ganti-password') :
            $this->page->gantiPassword();
        elseif ($page == 'ganti-bank') :
            $this->page->gantiBank();
        elseif ($page == 'ganti-pin') :
            return $this->page->gantiPIN();


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'simpan-profile') :
                if ($post['txtNama'] != '') :
                    $simpan = $this->model->updateProfile($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('member/profile/ganti-profile/');
            elseif ($act == "ganti-password") :
                if ($post['txtPasswordLama'] != '' && $post['txtPasswordBaru'] != '') :
                    $member = $this->model->countMemberByPassword($post)->total;
                    if ($member > 0) :
                        if ($post['txtPasswordBaru'] == $post['txtUlangiPasswordBaru']) :
                            $this->model->updatePasswordByNoAnggota($post);
                            Flasher::setFlash("BERHASIL", 'success');
                        endif;
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                endif;
                $this->page->redirect('member/profile/ganti-password/');
            elseif ($act == "ganti-bank") :
                if (($post['txtBank'] && $post['txtNomorRekening'] && $post['txtNamaPemilik'] && $post['txtPIN']) != '') :
                    $member = $this->model->countMemberByPIN($post)->total;
                    if ($member > 0) :
                        $this->model->updateBankByNoAnggota($post);
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('member/profile/ganti-bank/');
            elseif ($act == "ganti-pin") :
                if (($post['txtPINLama'] && $post['txtPINBaru'] && $post['txtUlangiPINBaru']) != '') :
                    if ($post['txtPINBaru'] == $post['txtUlangiPINBaru']) :
                        $member = $this->model->countMemberByPIN(['txtPIN' => $post['txtPINLama']])->total;
                        if ($member > 0) :
                            $this->model->updatePINByNoAnggota($post);
                            Flasher::setFlash("BERHASIL", 'success');
                        endif;
                    endif;
                endif;
                $this->page->redirect('member/profile/ganti-bank/');

            endif;

        else :
            $data['member'] = $this->model->getMemberByNoAnggota(Session::get('idMB'));
            $this->page->profile($data);
        endif;
    }
    // =============================================================== END PROFILE

    // =============================================================== START BONUS
    public function wallet($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'ambil-bonus') :
            $this->page->ambilBonus();
        elseif ($page == 'history-bonus') :
            $data['riwayat'] = $this->model->getAllRiwayatBonusByNoAnggota(Session::get('idMB'));
            $this->page->historyBonus($data);
        elseif ($page == 'claim-voucher') :
            $this->page->claimVoucher();


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'claim-voucher') :
                if ($post['txtToken'] != '') :
                    //cek voucher
                    //cek pemilik voucher
                    //cek status voucher
                    //update wallet
                    //update voucher
                    $voucher = $this->model->getVoucherByToken($post);
                    if ($voucher->pemilik == Session::get('idMB')) :
                        if ($voucher->status != '1') :
                            $wallet = $this->model->getWalletByNoAnggota(Session::get('idMB'));
                            $myWallet = $wallet->wallet + $voucher->nominal;
                            $this->model->updateVoucherByID($voucher->id);
                            $this->model->updateWalletByNoAnggota(['no_anggota' => Session::get('idMB'), 'wallet' => $myWallet]);
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("Voucher sudah aktif", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Voucher bukan milik Anda", 'danger');
                    endif;
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
                $this->page->redirect('member/wallet/claim-voucher/');
            endif;
        else :
            $dataModel['no_anggota'] = Session::get('idMB');
            $dataModel['bulan'] = date('m');
            $dataModel['tahun'] = date('Y');
            $data['bonus_bulan_ini'] = $this->model->countBonusThisMonth($dataModel);
            $data['wallet'] = $this->model->getWalletByNoAnggota(Session::get('idMB'));
            $this->page->wallet($data);
        endif;
    }
    // =============================================================== END BONUS

    // =============================================================== START PRODUK
    public function produk($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'paket-produk') :
            $data['paket'] = $this->model->getAllPaketProduk();
            $this->page->paketProduk($data);
        elseif ($page == 'keranjang-belanja') :
            $data['keranjang'] = $this->model->getAllKeranjang();
            $data['propinsi'] = $this->model->getAllPropinsi();
            $data['penerima'] = $this->model->getMemberByNoAnggota(Session::get('idMB'));
            $this->page->keranjangBelanja($data);
        elseif ($page == 'pesanan') :
            $data['pesanan'] = $this->model->getAllPesananByNoAnggota(Session::get('idMB'));
            $this->page->pesanan($data);
        elseif ($page == 'pesanan-selesai') :
            $data['order'] = $this->model->getAllPesananSelesaiByNoAnggota(Session::get('idMB'));
            $this->page->pesananSelesai($data);
        elseif ($page == 'checkout') :
            $data['ppn'] = $this->model->getSetting();
            $data['keranjang'] = $this->model->getAllKeranjang();
            $member = $this->model->getMemberByNoAnggota(Session::get('idMB'));
            $data['ongkir'] = $this->model->getOnkirByPropinsi($member->propinsi_kirim);
            $this->page->checkout($data);


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'tambah-keranjang') :
                $countKeranjang = $this->model->countKeranjangByProduk($post)->total;
                if ($countKeranjang > 0) :
                    $keranjang = $this->model->getKeranjangByProduk($post);
                    $id = $keranjang->id;
                    $qty = $keranjang->qty + $post['qty'];
                    $simpan = $this->model->updateKeranjangByID(['id' => $id, 'qty' => $qty]);
                else :
                    $simpan = $this->model->simpanKeranjang($post);
                endif;
                if ($simpan > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                endif;
                if (isset($post['paket'])) :
                    $this->page->redirect('member/produk/paket-produk/');
                else :
                    $this->page->redirect('member/produk/produk/');
                endif;
            elseif ($act == 'hapus-keranjang') :
                $delete = $this->model->deleteKeranjangByID($post['id']);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                endif;
                $this->page->redirect('member/produk/keranjang-belanja/');
            elseif ($act == 'simpan-checkout') :
                if ($post['txtNama'] != '' && $post['txtAlamat'] != '' && $post['selPropinsi'] != '0' && $post['txtPonsel'] != '') :
                    $this->model->updateAlamatKirim($post);
                    $this->page->redirect('member/produk/checkout/');
                else :
                    $this->page->redirect('member/produk/keranjang-belanja/');
                endif;
            elseif ($act == 'bayar') :
                $wallet = $this->model->getWalletByNoAnggota(Session::get('idMB'));
                if ($wallet->wallet >= $post['total_harga']) :
                    $lastInvoice = $this->model->getLastInvoice()->invoice;
                    if ($lastInvoice == 0) :
                        $lastInvoice = 50000;
                    endif;
                    $invoice = $lastInvoice + 1;
                    $penerima = $this->model->getMemberByNoAnggota(Session::get('idMB'));
                    $sisaWallet = $wallet->wallet - $post['total_harga'];

                    $custom['invoice'] = $invoice;
                    $custom['penerima'] = $penerima->penerima_kirim;
                    $custom['alamat'] = $penerima->alamat_kirim;
                    $custom['propinsi'] = $penerima->propinsi_kirim;
                    $custom['ponsel'] = $penerima->no_ponsel_kirim;
                    $custom['no_anggota'] = $penerima->no_anggota;

                    $simpan = $this->model->simpanPenjualan($post, $custom);
                    if ($simpan > 0) :
                        $keranjang = $this->model->getAllKeranjang();
                        foreach ($keranjang as $keranjang) :
                            $this->model->simpanPenjualanBarang($keranjang, $custom);
                            $this->model->deleteKeranjangByID($keranjang->id);
                        endforeach;

                        $this->model->updateWalletByNoAnggota(['no_anggota' => Session::get('idMB'), 'wallet' => $sisaWallet]);
                        $this->page->redirect('member/produk/pesanan/');
                    endif;
                else :
                    Flasher::setFlash("Saldo wallet kurang", 'danger');
                    $this->page->redirect('member/produk/checkout/');
                endif;
            elseif ($act == 'barang-diterima') :
                $simpan = $this->model->updatePenjualanByID($post['id']);
                if ($simpan >= 0) :
                    $member = $this->model->getMemberByNoAnggota(Session::get('idMB'));
                    if ($member->keanggotaan == 'User' || $member->keanggotaan == '0' || $member->keanggotaan == '') :
                        $this->model->updateKeanggotaanByNoAnggota($member->no_anggota);
                    endif;
                    $pesanan = $this->model->getPenjualanByID($post['id']);
                    $barang = $this->model->getAllBarangByInvoice($pesanan->no_invoice);
                    $bonus_up1 = 0;
                    $bonus_up2 = 0;
                    $bonus_up3 = 0;
                    $bonus_up4 = 0;
                    $bonus_up5 = 0;
                    foreach ($barang as $barang) :
                        $produk = $this->model->getProdukByID_($barang->id_produk);
                        $bonus_up1 = (int)$bonus_up1 + ((int)$produk->bonus_level1 * (int)$barang->qty);
                        $bonus_up2 = (int)$bonus_up2 + ((int)$produk->bonus_level2 * (int)$barang->qty);
                        $bonus_up3 = (int)$bonus_up3 + ((int)$produk->bonus_level3 * (int)$barang->qty);
                        $bonus_up4 = (int)$bonus_up4 + ((int)$produk->bonus_level4 * (int)$barang->qty);
                        $bonus_up5 = (int)$bonus_up5 + ((int)$produk->bonus_level5 * (int)$barang->qty);
                    endforeach;

                    $upline = $this->model->getUplineByNoAnggota(Session::get('idMB'));
                    if ($upline->upline1 != '') :
                        $wallet_up1 = $this->model->getWalletByNoAnggota($upline->upline1);
                        $totalbonus_up1 = $wallet_up1->wallet + $bonus_up1;
                        $this->model->updateWalletByNoAnggota(['no_anggota' => $upline->upline1, 'wallet' => $totalbonus_up1]);
                        $this->model->simpanRiwayatBonus(['upline' => $upline->upline1, 'bonus' => $bonus_up1, 'type' => 'belanja', 'dari' => Session::get('idMB')]);
                    endif;

                    if ($upline->upline2 != '') :
                        $wallet_up2 = $this->model->getWalletByNoAnggota($upline->upline2);
                        $totalbonus_up2 = $wallet_up2->wallet + $bonus_up2;
                        $this->model->updateWalletByNoAnggota(['no_anggota' => $upline->upline2, 'wallet' => $totalbonus_up2]);
                        $this->model->simpanRiwayatBonus(['upline' => $upline->upline2, 'bonus' => $bonus_up2, 'type' => 'belanja', 'dari' => Session::get('idMB')]);
                    endif;

                    if ($upline->upline3 != '') :
                        $wallet_up3 = $this->model->getWalletByNoAnggota($upline->upline3);
                        $totalbonus_up3 = $wallet_up3->wallet + $bonus_up3;
                        $this->model->updateWalletByNoAnggota(['no_anggota' => $upline->upline3, 'wallet' => $totalbonus_up3]);
                        $this->model->simpanRiwayatBonus(['upline' => $upline->upline3, 'bonus' => $bonus_up3, 'type' => 'belanja', 'dari' => Session::get('idMB')]);
                    endif;

                    if ($upline->upline4 != '') :
                        $wallet_up4 = $this->model->getWalletByNoAnggota($upline->upline4);
                        $totalbonus_up4 = $wallet_up4->wallet + $bonus_up4;
                        $this->model->updateWalletByNoAnggota(['no_anggota' => $upline->upline4, 'wallet' => $totalbonus_up4]);
                        $this->model->simpanRiwayatBonus(['upline' => $upline->upline4, 'bonus' => $bonus_up4, 'type' => 'belanja', 'dari' => Session::get('idMB')]);
                    endif;

                    if ($upline->upline5 != '') :
                        $wallet_up5 = $this->model->getWalletByNoAnggota($upline->upline5);
                        $totalbonus_up5 = $wallet_up5->wallet + $bonus_up5;
                        $this->model->updateWalletByNoAnggota(['no_anggota' => $upline->upline5, 'wallet' => $totalbonus_up5]);
                        $this->model->simpanRiwayatBonus(['upline' => $upline->upline5, 'bonus' => $bonus_up5, 'type' => 'belanja', 'dari' => Session::get('idMB')]);
                    endif;
                endif;
            endif;


        else :
            $keanggotaan = $this->model->getMemberByNoAnggota(Session::get('idMB'));
            if ($keanggotaan->keanggotaan == "User" || $keanggotaan->keanggotaa == '0' || $keanggotaan->keanggotaan == '') :
                $this->page->redirect('member/produk/paket-produk/');
            else :
                $data['produk'] = $this->model->getAllProduk();
                $this->page->produk();
            endif;
        endif;
    }
    // =============================================================== END PRODUK

    // =============================================================== START ANGGOTA
    public function member($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'tambah-member') :
            //destroy session in here
            Session::destroy('upline');
            Session::destroy('token');
            Session::destroy('txtNoAnggota');
            Session::destroy('txtNama');
            Session::destroy('txtPassword');
            $this->page->tambahMember();
        elseif ($page == 'form-tambah-anggota') :
            $data['token'] = $this->model->getPINByToken(Session::get('token'));
            $this->page->formTambahAnggota($data);
        elseif ($page == 'tambah-anggota-berhasil') :
            $data['no_anggota'] = Session::get('txtNoAnggota');
            $data['nama'] = Session::get('txtNama');
            $data['password'] = Session::get('txtPassword');
            $this->page->tambahAnggotaBerhasil($data);
        elseif ($page == 'jaringan') :
            $this->page->jaringan();

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'token') :
                if ($post['txtToken'] != '') :
                    if ($post['txtNoAnggota'] == '') :
                        Session::set('upline', Session::get('idMB'));
                    else :
                        $network = $this->model->countNetworkByNoAnggota($post)->total;
                        if ($network > 0) :
                            Session::set('upline', $post['txtNoAnggota']);
                        else :
                            Flasher::setFlash("Upline bukan dalam jaringan Anda", 'danger');
                            $this->page->redirect('member/member/tambah-member/');
                            exit;
                        endif;
                    endif;
                    $cekToken = $this->model->countMyPINByToken($post)->total;
                    if ($cekToken > 0) :
                        Session::set('token', $post['txtToken']);
                        $this->page->redirect('member/member/form-tambah-anggota/');
                    else :
                        Flasher::setFlash("Token salah", 'danger');
                        $this->page->redirect('member/member/tambah-member/');
                    endif;
                else :
                    Flasher::setFlash("Form kosong", 'danger');
                    $this->page->redirect('member/member/tambah-member/');
                endif;
            elseif ($act == 'simpan-anggota') :
                $upline = $this->model->getUplineByNoAnggota(Session::get('upline'));
                $pin = $this->model->getPINByToken(Session::get('token'));
                if ($post['txtNama'] != '' && $post['txtPonsel'] != '' && $post['txtPassword'] != '') :
                    $this->model->simpanAnggota($post, ['no_anggota' => $pin->no_anggota, 'pin' => $pin->pin]);
                    $this->model->simpanUpline($upline, ['no_anggota' => $pin->no_anggota]);
                    $this->model->simpanWallet(['no_anggota' => $pin->no_anggota]);
                    $this->model->updatePINActiveByAnggota($pin->no_anggota);
                    Session::set('txtNoAnggota', $pin->no_anggota);
                    Session::set('txtNama', $post['txtNama']);
                    Session::set('txtPassword', $post['password']);
                    $this->page->redirect('member/member/tambah-anggota-berhasil/');
                else :
                    $this->page->redirect('member/member/form-tambah-member/');
                endif;
            endif;

        // else :
        // return $this->view->member();
        endif;
    }
    // =============================================================== END ANGGOTA

    // =============================================================== START PIN
    public function pin($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'semua-pin') :
            $data['totalkirim'] = Session::get('totalKirimPIN');
            $data['pin'] = $this->model->getAllPIN();
            $this->page->semuaPIN($data);
        elseif ($page == 'transfer-pin') :
            if ($act != '') :
                $pin = $this->model->countMyPIN($act)->total;
                if ($pin > 0) :
                    $data['pin'] = $act;
                    $data['penerimaPIN'] = Session::get('penerimaPIN');
                    $this->page->transferPIN($data);
                else :
                    $this->page->dashboard();
                endif;
            else :
                $this->page->dashboard();
            endif;
        elseif ($page == 'riwayat-transfer-pin') :
            $data['transfer'] = $this->model->getAllRiwayatTransferPIN();
            $this->page->riwayatTransferPIN($data);

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'cek-pin') :
                if ($post['pin'] != '') :
                    $cek = $this->model->countAnggotaByPIN($post)->total;
                    if ($cek > 0) :
                        $this->page->redirect('member/pin/semua-pin/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('member/pin/');
                    endif;
                endif;
            elseif ($act == 'kirim-pin') :
                if ($post['txtNoAnggota'] != '') :
                    $anggota = $this->model->countMemberByNoAnggota($post)->total;
                    if ($anggota > 0) :
                        $update = $this->model->updatePIN($post);
                        if ($update > 0) :
                            //simpan riwayat
                            $this->model->simpanRiwayatTrasferPIN($post);
                            $total_kirim = Session::get('totalKirimPIN') + 1;
                            Session::set('totalKirimPIN', $total_kirim);
                            Session::set('penerimaPIN', $post['txtNoAnggota']);
                            Flasher::setFlash("BERHASIL", 'success');
                        endif;
                    endif;
                    $this->page->redirect('member/pin/semua-pin/');
                endif;
            endif;

        else :
            Session::destroy('penerimaPIN');
            Session::destroy('totalKirimPIN');
            $this->page->pin();
        endif;
    }
    // =============================================================== END PIN

    // =============================================================== START VOUCHER
    public function voucher($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'semua-voucher') :
            $data['totalkirim'] = Session::get('totalKirimVoucher');
            $data['voucher'] = $this->model->getAllVoucher();
            $this->page->semuaVoucher($data);
        elseif ($page == 'transfer-voucher') :
            if ($act != '') :
                $voucher = $this->model->countMyVoucher($act)->total;
                if ($voucher > 0) :
                    $data['id'] = $act;
                    $data['penerimaVoucher'] = Session::get('penerimaVoucher');
                    $this->page->transferVoucher($data);
                else :
                    $this->page->dashboard();
                endif;
            else :
                $this->page->dashboard();
            endif;
        elseif ($page == 'riwayat-transfer-voucher') :
            $data['transfer'] = $this->model->getAllRiwayatTransferVoucher();
            $this->page->riwayatTransferVoucher($data);


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'cek-voucher') :
                if ($post['pin'] != '') :
                    $cek = $this->model->countAnggotaByPIN($post)->total;
                    if ($cek > 0) :
                        $this->page->redirect('member/voucher/semua-voucher/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('member/voucher/');
                    endif;
                endif;
            elseif ($act == 'kirim-voucher') :
                if ($post['txtNoAnggota'] != '') :
                    $anggota = $this->model->countMemberByNoAnggota($post)->total;
                    if ($anggota > 0) :
                        $post['nominal'] = $this->model->getVoucherByID($post['id'])->nominal;
                        $update = $this->model->updateVoucher($post);
                        if ($update > 0) :
                            //simpan riwayat
                            $this->model->simpanRiwayatTrasferVoucher($post);
                            $total_kirim = Session::get('totalKirimPIN') + 1;
                            Session::set('totalKirimVoucher', $total_kirim);
                            Session::set('penerimaVoucher', $post['txtNoAnggota']);
                            Flasher::setFlash("BERHASIL", 'success');
                        endif;
                    endif;
                    $this->page->redirect('member/voucher/semua-voucher/');
                endif;
            endif;
        else :
            Session::destroy('penerimaVoucher');
            Session::destroy('totalKirimVoucher');
            $this->page->voucher();
        endif;
    }
    // =============================================================== END VOUCHER


}
