<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
\PhpOffice\PhpSpreadsheet\Shared\File::setUseUploadTempDirectory(true);
class Board extends CI_Controller {

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
		$this->load->model('kawal_model');
		$this->load->helper('url');
		$data['sto']=$this->kawal_model->tampil_dataSTO();
		$data['agency']=$this->kawal_model->tampil_dataAgency();
        $this->load->view('form_sales',$data);
        
	}
	
	// public function form_sales()
	// {
	// 	//$dataSTO['kawal_sto'] = $this->m_data->tampil_dataSTO()->result();

    //     $this->load->view('form_sales');
        
	// }

	function cekkey(){
		$this->load->model('kawal_model');
		$data=$this->kawal_model->selectPrimaryKey();
		$number=substr($data[0]->id,-6);
		echo $data[0]->id;
		echo "<br>";
		$number=$number+1;
		echo sprintf('%06d',$number);
	}
	
	function tambah_po_inputan(){
		$this->load->model('kawal_model'); 
		
		$sto = $this->input->post('sto');
		$myir = $this->input->post('myir');
		$paket = $this->input->post('paket');
		$deposit = $this->input->post('deposit');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$hp_pelanggan = $this->input->post('hp_pelanggan');
		$alamat_pelanggan = $this->input->post('alamat_pelanggan');
		$kcontact = $this->input->post('kcontact');
		$agency = $this->input->post('agency');
		$nama_sales = $this->input->post('nama_sales');
		$hp_sales = $this->input->post('hp_sales');
		$idtele_sales = $this->input->post('idtele_sales');

		$pk=$this->kawal_model->selectPrimaryKey();
		$number=substr($pk[0]->id,-6);
		$number=$number+1;

		$data_kpro = array(
			'datakpro_sto' => $sto,
			'datakpro_id' => 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number),
			'datakpro_myir' => $myir,
			'datakpro_packagename' => $paket,
			'datakpro_deposit' => $deposit,
			'datakpro_namacust' => $nama_pelanggan,
			'datakpro_nohp' => $hp_pelanggan,
			'datakpro_alamat' => $alamat_pelanggan,
			'datakpro_salesid' => $kcontact,
			'datakpro_agency' => $agency,
			'datakpro_salesname' => $nama_sales,
			'datakpro_saleshp' => $nama_sales,
			'datakpro_salestelegram' => $idtele_sales,
			'datakpro_tanggalinput' => date('Y-m-d H:i:s') 
			);
		$data_teknis = array(
			'datateknis_id'=> 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number)
		);
		$dataa2 = array(
			'dataa2_id'=> 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number)
		);
			//var_dump($data_po);
		$filter=$this->kawal_model->selectUniqueDataPO($myir);
		if ($filter[0]->datakpro_myir==NULL){
			$this->kawal_model->input_dataPO($data_kpro,'kawal_datakpro');
			$this->kawal_model->input_dataTeknis($data_teknis,'kawal_datateknis');
			$this->kawal_model->input_dataA2($dataa2,'kawal_dataa2');
			redirect('Board/form_sukses');
		}else{
			redirect('');
		}
		// var_dump($filter);
		// echo $filter[0]->datakpro_myir;
		
	}
	
	public function form_sukses()
	{
		//$dataSTO['kawal_sto'] = $this->m_data->tampil_dataSTO()->result();

        $this->load->view('formsukses');
        
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
            redirect('Board/dashboard');
            // var_dump($data);
		}
		else{
            // echo "salah";
			redirect('Board/login');
		}
		// echo 'tes';
	}
    public function dashboard(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('dashboard');
        }else{
            redirect('Board/login');
        }
	}
	
	public function uploadpsb(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('uploadpsb'); 
        }else{
            redirect('Board/login');
        }
	}

	public function douploadpsb(){
		$filedata=$_FILES['datakpro'];
        $type=explode('.',$_FILES['datakpro']['name']);
		$fileName='tempkpro'.date('YmdHis').'.'.$type[1];
        
        
        $config['upload_path'] = './assets/'; 
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if(! $this->upload->do_upload('datakpro') )
            $this->upload->display_errors();

		$media = $this->upload->data('datakpro');
		// var_dump($media);
		$inputFileName = './assets/'.$fileName;

        $inputFileType= \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $reader= \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet=$reader->load($inputFileName);
        $sheet=$spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        
		$this->load->model('kawal_model');
		
		
		
		$datas['insert']=0;
		$datas['update']=0;
		$number=0;
		
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
			$pk=$this->kawal_model->selectPrimaryKey();
			$number=substr($pk[0]->id,-6);
			$number=$number+1;
			
			$stodetail=$this->kawal_model->selectDetailSTO($rowData[0][4]);
			
			
			if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
            
                $kcontact=explode(";",$rowData[0][20]);
			    
                if (isset($kcontact[2])){
                    $kodesales=explode("-",$kcontact[2]);
                    if (array_key_exists(1,$kodesales)){
                        $mobi=$kodesales[1];
                    }else{
                        $mobi=NULL;
					}
					$salesid=strtoupper($kodesales[0]);
                }else{
            		$kcontact=explode("/",$rowData[0][20]);
					$salesid=strtoupper($kodesales[0]);
					$mobi=NULL;
				}

				$datasales=$this->kawal_model->selectDetailSales($salesid);
				if($datasales!=NULL){
					// var_dump($datasales);
					$idsales=$datasales[0]->kcontact_id;
					$namasales=$datasales[0]->kcontact_name;
					$cpsales=$datasales[0]->kcontact_cp2;
					$agency=$datasales[0]->kcontact_agency;
				}else{
					// echo "kosong";
					$idsales=NULL;
					$namasales=NULL;
					$cpsales=NULL;
					$agency=NULL;
				}
				
				if($kcontact[0]=='MI'){
					$myir=$kcontact[1];
				}else{
					$myir=NULL;
				}
				
                if (isset($kcontact[4])){
					if (is_numeric($kcontact[4])){
						$cpcust=$kcontact[4];
					}else {
						$cpcust=$kcontact[5];
					}
                }else{
                    $cpcust=NULL;
				}
				
                $data = array(
					"datakpro_id"=>"FORM".date('Y').date('m').date('d').sprintf('%06d',$number),
					"datakpro_regional"=>$stodetail[0]->sto_regionalid,
					"datakpro_witel"=>$stodetail[0]->sto_witelid,
					"datakpro_datel"=>$stodetail[0]->sto_datelid,
					"datakpro_sto"=>$stodetail[0]->sto_id,
					"datakpro_orderid"=>$rowData[0][5],
					"datakpro_typetransaksi"=>$rowData[0][6],
					"datakpro_jenislayanan"=>$rowData[0][7],
					"datakpro_alpro"=>$rowData[0][8],
					"datakpro_ncli"=>$rowData[0][9],
					"datakpro_pots"=>$rowData[0][10],
					"datakpro_internet"=>$rowData[0][11],
					"datakpro_statusresume"=>$rowData[0][12],
					"datakpro_statusmessage"=>$rowData[0][13],
					"datakpro_orderdate"=>$rowData[0][14],
					"datakpro_lastupdatestatus"=>$rowData[0][15],
					"datakpro_durasi"=>$rowData[0][16],
					"datakpro_namacust"=>$rowData[0][17],
					"datakpro_nohp"=>$rowData[0][18],
					"datakpro_alamat"=>$rowData[0][19],
					"datakpro_kcontact"=>$rowData[0][20],
					"datakpro_long"=>$rowData[0][21],
					"datakpro_lat"=>$rowData[0][22],
					"datakpro_packagename"=>$rowData[0][37],
					"datakpro_provider"=>$rowData[0][38],
					"datakpro_myir"=>$myir,
					"datakpro_salesid"=>$salesid,
					"datakpro_mobi"=>$mobi,
					"datakpro_salestelegram"=>NULL,
					"datakpro_saleshp"=>$cpsales,
					"datakpro_deposit"=>NULL,
					"datakpro_agency"=>$agency,
					"datakpro_salesname"=>$namasales,
					"datakpro_tanggalinput"=>date('Y-m-d H:i:s'),
					"datateknis_wfmid"=>$rowData[0][23],
					"datateknis_statuswfm"=>$rowData[0][24],
					"datateknis_desktask"=>$rowData[0][25],
					"datateknis_statustask"=>$rowData[0][26],
					"datateknis_tglinstall"=>$rowData[0][27]

					// "datakpro_salesid"=>


                    
				);
				$selectData=$this->kawal_model->selectDataKpro($data['datakpro_orderid'],$data['datakpro_myir']);

				if (isset($selectData[0])){
					// echo "update";
					$update=$this->kawal_model->updateDataKpro($data);
					$datas['update']=$datas['update']+$update;
					// echo "tes";
					
				}else{
					$insert=$this->kawal_model->insertDataKpro($data);
					$datas['insert']=$datas['insert']+$insert;
					// echo "t";
					
					// echo "insert";
				}
				
            }	 
		}
		unlink($inputFileName);
		
		$this->load->view('uploadpsb',$datas);
	}

	public function uploadggn(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('comingsoon'); 
        }else{
            redirect('Board/login');
        }
	}

	public function kawalpsb(){
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
        if(isset($user)){
			$this->load->model('kawal_model');
			$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
			$data['statusorder']=$this->kawal_model->selectStatusOrder();
			$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
			$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
			$data['channel']=$this->kawal_model->selectChannel();
			$data['valinputter']=$this->kawal_model->selectValidasiInputter();
			if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00004' || $role=='ROLE00006' || $role=='ROLE00008'){
				$data['query']=$this->kawal_model->selectDataKawalAll();	
			}else if ($role=='ROLE00002'){
				$data['query']=$this->kawal_model->selectDataKawalTL($sto);
			}else if ($role=='ROLE00003'){
				$data['query']=$this->kawal_model->selectDataKawalAgency($loker);
			}else if($role=='ROLE00005'){
				$data['query']=$this->kawal_model->selectDataKawalA2($user);
			}else if($role=='ROLE00007'){
				$data['query']=$this->kawal_model->selectDataKawalPlasa($user);
			}
            $this->load->view('kawalpsb',$data); 
        }else{
            redirect('Board/login');
        }
	}

	public function kawalggn(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('comingsoon'); 
        }else{
            redirect('Board/login');
        }
	}

	public function updateTL(){
		$this->load->model('kawal_model');
		// $data['query']=$this->kawal_model->updateTL($formid);
		$formid=$this->input->post('form');
		$data=array(
			'teknisi1'=>$this->input->post('tek1'),
			'teknisi2'=>$this->input->post('tek2'),
			'sektor'=>$this->input->post('sek'),
			'statuswo'=>$this->input->post('statwo'),
			'keterangan'=>$this->input->post('ket')
		);
		
		$data['query']=$this->kawal_model->updateTL($formid,$data);
		return $data;
		// print_r($formid);
	}

	public function updateA2(){
		$this->load->model('kawal_model');
		$formid=$this->input->post('form');
		$data=array(
			'layanan'=>$this->input->post('vallayanan'),
			'customer'=>$this->input->post('valcustomer'),
			'channel'=>$this->input->post('channel'),
			'deposit'=>$this->input->post('deposit')
		);
		$data['query']=$this->kawal_model->updateA2($formid,$data);
		return $data;
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
}
