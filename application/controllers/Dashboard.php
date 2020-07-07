<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
\PhpOffice\PhpSpreadsheet\Shared\File::setUseUploadTempDirectory(true);
class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 
	 
	public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->library('session');
            
	}
	
	public function index()
	{
        $user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('dashboard');
        }else{
            redirect('Board/login');
        }        
	}
	
	
	public function login(){
		$this->load->view('login');
	}
	
	public function dologin(){
		$this->load->model('kawal_model');
        $data['query']=$this->kawal_model->select_user($this->input->post());
        $username=$this->input->post('username');
        if ($data['query'] != NULL){ 
			$this->session->set_userdata('username',$data['query'][0]->users_username);
			$this->session->set_userdata('role',$data['query'][0]->users_role);
			$this->session->set_userdata('regional',$data['query'][0]->users_regional);
			$this->session->set_userdata('witel',$data['query'][0]->users_witel);
			$this->session->set_userdata('datel',$data['query'][0]->users_datel);
			$this->session->set_userdata('sto',$data['query'][0]->users_sto);
			$this->session->set_userdata('loker',$data['query'][0]->users_loker);
            redirect('Dashboard/dashboard');
            // var_dump($data);
		}
		else{
            // echo "salah";
			redirect('Dashboard/login');
		}
	}
    public function dashboard(){
        $this->load->model('Db_model1');
        $user=$this->session->userdata('username');
        $sto=$this->session->userdata('sto');
        if(isset($user)){
			$data['today'] = date('d F Y');
			//all
			$data['jumlah_wo']=$this->Db_model1->selectWOAll($sto);
			$data['ok_sc']=$this->Db_model1->selectOK_SC($sto);
			$data['ok_blmsc']=$this->Db_model1->selectOK_BLMSC($sto);
			$data['nok_depo']=$this->Db_model1->selectNOK_DEPO($sto);
			$data['nok_blmdepo']=$this->Db_model1->selectNOK_BLMDEPO($sto);

			//a2			
            $data['a2_ok']=$this->Db_model1->selectA2_OK($sto);
            $data['a2_nok']=$this->Db_model1->selectA2_NOK($sto);
			$data['a2_blmdivalidasi']=$this->Db_model1->selectA2_null($sto);
			
			//so
            $data['so_ok']=$this->Db_model1->selectSO_OK($sto);
            $data['so_nok']=$this->Db_model1->selectSO_NOK($sto);
			$data['so_blm_update']=$this->Db_model1->selectSO_not_updated($sto);


            $data['teknisi_null']=$this->Db_model1->selectWOTeknisiNull($sto);		
			$data['vb_teknisi'] = $this->Db_model1->selectRekapTeknisi($sto);	
			
			$data['kps']=count($this->Db_model1->selectWOAll('STO00014'));
			$data['mgo']=count($this->Db_model1->selectWOAll('STO00018'));
			$data['kbl']=count($this->Db_model1->selectWOAll('STO00009'));
			$data['kjr']=count($this->Db_model1->selectWOAll('STO00011'));
			$data['kln']=count($this->Db_model1->selectWOAll('STO00012'));
			$data['tns']=count($this->Db_model1->selectWOAll('STO00021'));
			$data['knn']=count($this->Db_model1->selectWOAll('STO00013'));
			$data['lki']=count($this->Db_model1->selectWOAll('STO00016'));
			$data['krp']=count($this->Db_model1->selectWOAll('STO00015'));
			$data['bbe']=count($this->Db_model1->selectWOAll('STO00002'));

			$data['kps_valid']=count($this->Db_model1->selectSO_OK('STO00014'));
			$data['mgo_valid']=count($this->Db_model1->selectSO_OK('STO00018'));
			$data['kbl_valid']=count($this->Db_model1->selectSO_OK('STO00009'));
			$data['kjr_valid']=count($this->Db_model1->selectSO_OK('STO00011'));
			$data['kln_valid']=count($this->Db_model1->selectSO_OK('STO00012'));
			$data['tns_valid']=count($this->Db_model1->selectSO_OK('STO00021'));
			$data['knn_valid']=count($this->Db_model1->selectSO_OK('STO00013'));
			$data['lki_valid']=count($this->Db_model1->selectSO_OK('STO00016'));
			$data['krp_valid']=count($this->Db_model1->selectSO_OK('STO00015'));
			$data['bbe_valid']=count($this->Db_model1->selectSO_OK('STO00002'));

			$data['kps_valid_a2']=count($this->Db_model1->selectA2_OK('STO00014'));
			$data['mgo_valid_a2']=count($this->Db_model1->selectA2_OK('STO00018'));
			$data['kbl_valid_a2']=count($this->Db_model1->selectA2_OK('STO00009'));
			$data['kjr_valid_a2']=count($this->Db_model1->selectA2_OK('STO00011'));
			$data['kln_valid_a2']=count($this->Db_model1->selectA2_OK('STO00012'));
			$data['tns_valid_a2']=count($this->Db_model1->selectA2_OK('STO00021'));
			$data['knn_valid_a2']=count($this->Db_model1->selectA2_OK('STO00013'));
			$data['lki_valid_a2']=count($this->Db_model1->selectA2_OK('STO00016'));
			$data['krp_valid_a2']=count($this->Db_model1->selectA2_OK('STO00015'));
			$data['bbe_valid_a2']=count($this->Db_model1->selectA2_OK('STO00002'));
			
            $this->load->view('db2',$data);
        }else{
            redirect('Board/login');
        }
	}
	
	public function logout(){
		$this->session->unset_userdata(array(
			'username',
			'role',
			'regional',
			'witel',
			'datel',
			'sto',
			'loker'
		));
		redirect('Board/login');
	}

	public function reportpsb(){
		$this->load->view('comingsoon'); 
	}

	public function reportggn(){
		$this->load->view('comingsoon'); 
	}

	public function viewdata(){
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
        if(isset($user)){
			$this->load->model('Db_model1');
			$this->load->model('kawal_model');
			$perintah = $this->uri->segment('3');
			$data['channel']=$this->kawal_model->selectChannel();
			//$data['hasil_query']=$this->Db_model1->selectWOAll($sto);
			if($perintah == "1")
			{
				$data['query']=$this->Db_model1->selectWOAll($sto);
				$data['kata'] = "WO HARI INI";
			}
			elseif($perintah == "2")
			{
				$data['query']=$this->Db_model1->selectOK_SC($sto);
				$data['kata'] = "WO HARI INI SUDAH ADA SC";
			}
			elseif($perintah == "3")
			{
				$data['query']=$this->Db_model1->selectOK_BLMSC($sto);
				$data['kata'] = "WO HARI INI BELUM ADA SC";
			}
			elseif($perintah == "4")
			{
				$data['query']=$this->Db_model1->selectNOK_DEPO($sto);
				$data['kata'] = "WO HARI INI NOK A2 DAN UBIS TAPI SUDAH DEPOSIT";
			}
			elseif($perintah == "5")
			{
				$data['kata'] = "WO HARI INI NOK A2 DAN UBIS TAPI BELUM DEPOSIT";
				$data['query']=$this->Db_model1->selectNOK_BLMDEPO($sto);
			}
			elseif($perintah == "6")
			{
				$data['kata'] = "WO HARI INI OK OLEH UBIS";
				$data['query']=$this->Db_model1->selectSO_OK($sto);
			}
			elseif($perintah == "7")
			{
				$data['kata'] = "WO HARI INI NOK OLEH UBIS";
				$data['query']=$this->Db_model1->selectSO_NOK($sto);
			}
			elseif($perintah == "8")
			{
				$data['kata'] = "WO HARI INI BELUM ADA UPDATE DARI UBIS";
				$data['query']=$this->Db_model1->selectSO_not_updated($sto);
			}
			elseif($perintah == "9")
			{
				$data['kata'] = "WO HARI INI OK OLEH A2";
				$data['query']=$this->Db_model1->selectA2_OK($sto);				
			}
			elseif($perintah == "10")
			{
				$data['kata'] = "WO HARI INI NOK OLEH A2";
				$data['query']=$this->Db_model1->selectA2_NOK($sto);
			}
			elseif($perintah == "11")
			{
				$data['kata'] = "WO HARI INI BELUM DIVALIDASI A2";
				$data['query']=$this->Db_model1->selectA2_null($sto);
			}
			else
			{
				$data['kata'] = "WO HARI INI";
				$data['query']=$this->Db_model1->selectWOAll($sto);
			}
            $this->load->view('dash_detail',$data); 
        }else{
            redirect('Board/login');
        }
	}
}
