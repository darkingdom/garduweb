<?php
class MemberController extends Controller
{
    public
        $member,
        $unread;

    public function __construct()
    {
        if (Session::get('login_mb') != 'member') {
            header('location:' . BASEURL . '/login/');
            exit;
        }
        $this->member =  ModelController::model('MemberModel')->getMemberById(Session::get('id'));
        @ModelController::model('MemberModel')->deleteOverChatGlobal();
        $this->unread = ModelController::model('MemberModel')->cekUnreadGlobalChat();
        $this->unread = ModelController::model('MemberModel')->crossCheckMemberAktif();
    }

    public function index()
    {
        $data['p'] = 'home';
        $data['member'] = $this->member;
        $data['numsponsor'] = ModelController::model('MemberModel')->getTotalDownline();
        $data['wdtertunda'] = ModelController::model('MemberModel')->getWDtertunda();
        return $this->view('index', $data);
    }

    public function getmemberbyid($id)
    {
        return ModelController::model('MemberModel')->getMemberById($id);
    }

    public function givehelp()
    {
        $data['p'] = 'givehelp';
        return $this->view('index', $data);
    }

    public function receivehelp()
    {
        $data['p'] = 'receivehelp';
        return $this->view('index', $data);
    }

    public function pincard()
    {
        $data['p'] = 'pincard';
        return $this->view('index', $data);
    }

    public function robotdoge()
    {
        $data['p'] = 'robotdoge';
        return $this->view('index', $data);
    }

    public function riwayat()
    {
        $data['p'] = 'riwayat';
        return $this->view('index', $data);
    }

    public function upgrademember($id)
    {
        $data['p'] = 'upgrademember';
        $data['member'] = $this->member;
        $data['transaksi'] = ModelController::model('MemberModel')->getTransaksiById($id);
        return $this->view('index', $data);
    }

    public function member($gen = 1)
    {
        $data['p'] = 'member';
        $data['page'] = $gen;
        // $data['downline'] = ModelController::model('MemberModel')->getAllMemberBySponsor();
        $data['downline'] = ModelController::model('MemberModel')->getAllMembersByGenerasi($gen);
        return $this->view('index', $data);
    }

    public function memberinfo($id)
    {
        $data['p'] = 'memberinfo';
        $data['info'] = $this->getmemberbyid($id);
        $data['bank'] = ModelController::model('MemberModel')->getAllBankByIdMember($id);
        $this->view('index', $data);
    }

    public function infomember($id)
    {
        $data['p'] = 'infomember';
        $data['info'] = $this->getmemberbyid($id);
        $data['bank'] = ModelController::model('MemberModel')->getAllBankByIdMember($id);
        $this->view('index', $data);
    }

    public function tambahmember()
    {
        $data['p'] = 'tambahmember';
        $data['member'] = $this->member;
        return $this->view('index', $data);
    }

    public function simpanmember()
    {
        if (ModelController::model('MemberModel')->simpanMember($_POST) > 0) {
            header("location:" . BASEURL . "/member/member/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/tambahmember");
            exit;
        }
    }

    public function global()
    {
        $data['p'] = 'global';
        $data['member'] = $this->member;
        $data['chat'] =  ModelController::model('MemberModel')->getAllChatGlobal();
        $this->view('index', $data);
    }

    public function profil()
    {
        $data['p'] = 'profil';
        $data['member'] = $this->member;
        return $this->view('index', $data);
    }

    public function gantiprofil()
    {
        $data['p'] = 'gantiprofil';
        $data['member'] = $this->member;
        return $this->view('index', $data);
    }

    public function simpanprofile()
    {
        if (ModelController::model('MemberModel')->simpanProfile($_POST) > 0) {
            header("location:" . BASEURL . "/member/profil/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/gantiprofil/");
            exit;
        }
    }

    public function gantipassword()
    {
        $data['p'] = 'gantipassword';
        return $this->view('index', $data);
    }

    public function simpanpassword()
    {
        if (ModelController::model('MemberModel')->simpanPassword($_POST) > 0) {
            header("location:" . BASEURL . "/member/profil/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/gantipassword/");
            exit;
        }
    }

    public function bank()
    {
        $data['p'] = 'bank';
        $data['bank'] = ModelController::model('MemberModel')->getAllBank();
        return $this->view('index', $data);
    }

    public function tambahbank()
    {
        $data['p'] = 'tambahbank';
        return $this->view('index', $data);
    }

    public function simpanbank()
    {

        if (ModelController::model('MemberModel')->simpanBank($_POST) > 0) {
            header("location:" . BASEURL . "/member/bank/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/tambahbank/");
            exit;
        }
    }

    public function sendchatglobal()
    {
        echo ModelController::model('MemberModel')->sendChatGlobal($_POST);
    }

    public function deletechatglobal($id)
    {
        ModelController::model('MemberModel')->deleteChatGlobalById($id);
        header("location:" . BASEURL . "/member/global/");
        exit;
    }

    public function uploadtransfer($id)
    {
        if (ModelController::model('MemberModel')->uploadTransfer($id) > 0) {
            header("location:" . BASEURL . "/member/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/upgrademember/" . $id);
            exit;
        }
    }

    public function adminupgrademember()
    {
        $data['p'] = 'adminupgrademember';
        $data['upgrade'] = ModelController::model('MemberModel')->getAllRequestUpgradeMember();
        return $this->view('index', $data);
    }

    public function aktifkanmember($id)
    {
        if (ModelController::model('MemberModel')->activationMember($id) > 0) {
            header("location:" . BASEURL . "/member/adminupgrademember/");
            exit;
        } else {
            header("location:" . BASEURL . "/member/adminupgrademember/");
            exit;
        }
    }

    public function buktitransferupgrade($id)
    {
        $data['p'] = 'buktitransferupgrade';
        $data['upgrade'] = ModelController::model('MemberModel')->getBuktiTransferUpgrade($id);
        return $this->view('index', $data);
    }

    public function upgrade()
    {
        $data['p'] = 'upgrade';
        $data['member'] = $this->member;
        return $this->view('index', $data);
    }

    public function edukasi()
    {
        $data['p'] = 'edukasi';
        $data['member'] = $this->member;
        return $this->view('index', $data);
    }

    public function robot($page = NULL, $id = NULL)
    {
        if ($page == 'simpan') {
            ModelController::model('MemberModel')->simpanRobot($_POST);
            header("location:" . BASEURL . "/member/robot/");
            exit;
        } else if ($page == 'hapus') {
            ModelController::model('MemberModel')->hapusRobot($id);
            header("location:" . BASEURL . "/member/robot/");
            exit;
        } else if ($page == 'bayar') {
            $data['p'] = 'bayarvps';
            $data['member'] = $this->member;
            $data['robot'] = ModelController::model('MemberModel')->getRobot();
            return $this->view('index', $data);
        } else if ($page == 'uploadtransfer') {
            ModelController::model('MemberModel')->uploadTransferVPS($id);
            header("location:" . BASEURL . "/member/robot/");
            exit;
        } else {
            $data['p'] = 'robot';
            $data['cekrobot'] = ModelController::model('MemberModel')->cekRobot();
            if ($data['cekrobot']->total > 0) {
                $data['robot'] = ModelController::model('MemberModel')->getRobot();
            }
            $data['member'] = $this->member;
            return $this->view('index', $data);
        }
    }

    public function withdraw()
    {
        $data['p'] = 'withdraw';
        $data['member'] = $this->member;
        $data['wdtertunda'] = ModelController::model('MemberModel')->getWDtertunda();
        return $this->view('index', $data);
    }

    public function requestwithdraw()
    {
        ModelController::model('MemberModel')->requestWithdraw($_POST);
        header("location:" . BASEURL . "/member/withdraw/");
        exit;
    }

    public function adminmember()
    {
        $data['p'] = 'adminmember';
        $data['member'] = $this->member;
        $data['allmember'] = ModelController::model('MemberModel')->getAllMemberShortByNama();
        $data['mbaktif'] = ModelController::model('MemberModel')->getTotalMemberAktif();
        $data['mbpasif'] = ModelController::model('MemberModel')->getTotalMemberPasif();
        $this->view('index', $data);
    }

    public function adminwithdraw()
    {
        $data['p'] = 'adminwithdraw';
        $data['member'] = $this->member;
        $data['wd'] = ModelController::model('MemberModel')->getAllWithdraw();
        $this->view('index', $data);
    }

    public function adminstatistik()
    {
        $data['p'] = 'adminstatistik';
        $data['member'] = $this->member;
        $data['mbaktif'] = ModelController::model('MemberModel')->getTotalMemberAktif();
        $data['mbpasif'] = ModelController::model('MemberModel')->getTotalMemberPasif();
        $data['totalbonus'] = ModelController::model('MemberModel')->getSumAllBonus();
        $data['totalwd'] = ModelController::model('MemberModel')->getSumAllWithdraw();
        $data['totalwdtertunda'] = ModelController::model('MemberModel')->getSumAllWithdrawPending();
        $data['settings'] = ModelController::model('MemberModel')->getSettings();
        $this->view('index', $data);
    }

    public function wdinfo($id)
    {
        $data['p'] = 'wdinfo';
        $data['wd'] = ModelController::model('MemberModel')->getWDByID($id);
        $data['mbinfo'] = $this->getmemberbyid($data['wd']->idmember);
        $data['bank'] = ModelController::model('MemberModel')->getAllBankByIdMember($data['wd']->idmember);
        $this->view('index', $data);
    }

    public function transferwithdraw($id)
    {
        ModelController::model('MemberModel')->prosesTransferWithdraw($id);
        header("location:" . BASEURL . "/member/adminwithdraw/");
        exit;
    }

    public function pin()
    {
        $data['p'] = 'pin';
        $data['member'] = $this->member;
        $data['pin'] = ModelController::model('MemberModel')->getAllPIN();
        $this->view('index', $data);
    }

    public function adminrobot($page = NULL, $id = NULL)
    {
        if ($page == 'info') {
            $data['p'] = 'adminrobotinfo';
            $data['member'] = $this->member;
            $data['robot'] = ModelController::model('MemberModel')->getRobotByID($id);
            $this->view('index', $data);
        } else if ($page == 'buktitransfer') {
            $data['p'] = 'adminrobotbuktitransfer';
            $data['member'] = $this->member;
            $data['robot'] = ModelController::model('MemberModel')->getRobotByID($id);
            $this->view('index', $data);
        } else if ($page == 'aktifkan') {
            ModelController::model('MemberModel')->aktikanrobot($id);
            header("location:" . BASEURL . "/member/adminrobot/");
            exit;
        } else {
            $data['p'] = 'adminrobot';
            $data['member'] = $this->member;
            $data['robot'] = ModelController::model('MemberModel')->getAllRobot();
            $this->view('index', $data);
        }
    }
}