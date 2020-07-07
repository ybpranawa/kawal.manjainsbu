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
		$data['sto']=$this->kawal_model->tampil_dataSTOtanpagsk();
		$data['agency']=$this->kawal_model->tampil_dataAgency();
		$this->load->view('form_sales',$data);
		// echo "ditutup sampai pukul 8.00";
        
	}

	public function inputwo()
	{
		$this->load->model('kawal_model');
		$this->load->helper('url');
		$data['sto']=$this->kawal_model->tampil_dataSTO();
		$data['agency']=$this->kawal_model->tampil_dataAgency();
		$this->load->view('form_sales',$data);
		// echo "ditutup sampai pukul 18.00";
        
	}

	function cekkey(){
		$this->load->model('kawal_model');
		$data=$this->kawal_model->selectPrimaryKey();
		$number=substr($data[0]->id,-6);
		echo $data[0]->id;
		echo "<br>";
		$number=$number+1;
		echo sprintf('%06d',$number);
	}

	public function cekSTO(){
		$this->load->model('kawal_model');
		// $sto = $this->input->get('sto');
		$stodetail=$this->kawal_model->selectDetailSTOFromId($this->uri->segment('3'));
		var_dump($stodetail);
		// echo $this->uri->segment('3');
	}
	
	function tambah_po_inputan(){
		$this->load->model('kawal_model');
		
		$sto = $this->input->post('sto');
		$myir = $this->input->post('myir');
		$alpro = $this->input->post('alpro');
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
		$cekid=date('Y').date('m').date('d');
		$idpk=substr($pk[0]->id,4,8);
		if($cekid==$idpk){
			$number=substr($pk[0]->id,-6);
			$number=$number+1;
		}else{
			$number=000000;
		}
		$stodetail=$this->kawal_model->selectDetailSTOFromId($sto);

		$data_kpro = array(
			'datakpro_sto' => $sto,
			"datakpro_regional"=>$stodetail[0]->sto_regionalid, 
			"datakpro_witel"=>$stodetail[0]->sto_witelid,
			"datakpro_datel"=>$stodetail[0]->sto_datelid,
			'datakpro_id' => 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number),
			'datakpro_alpro'=> $alpro,
			'datakpro_myir' => $myir,
			'datakpro_packagename' => $paket,
			'datakpro_deposit' => $deposit,
			'datakpro_namacust' => $nama_pelanggan,
			'datakpro_nohp' => $hp_pelanggan,
			'datakpro_alamat' => $alamat_pelanggan,
			'datakpro_salesid' => $kcontact,
			'datakpro_agency' => $agency,
			'datakpro_salesname' => $nama_sales,
			'datakpro_saleshp' => $hp_sales,
			'datakpro_salestelegram' => $idtele_sales,
			'datakpro_tanggalinput' => date('Y-m-d H:i:s')
			);
		$data_teknis = array(
			'datateknis_id'=> 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number)
		);
		$dataa2 = array(
			'dataa2_id'=> 'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number)
		);
		$datainputter=array(
			'datainputter_id'=>'FORM'.date('Y').date('m').date('d').sprintf('%06d',$number),
			'datainputter_drop'=>0,
		);
		// var_dump($data_kpro);
		
		$filter=$this->kawal_model->selectUniqueDataPO($myir);		
		//if ($filter[0]->datakpro_myir==NULL){

		if(empty($filter)){
			$this->kawal_model->input_dataPO($data_kpro,'kawal_datakpro');
			$this->kawal_model->input_dataTeknis($data_teknis,'kawal_datateknis');
			$this->kawal_model->input_dataA2($dataa2,'kawal_dataa2');
			$this->kawal_model->input_dataInputter($datainputter,'kawal_datainputter');
			$data['pesan']='Data berhasil dimasukkan';
			$data['notif']=1;
			// redirect('Board/index/'.$data['notif'].'/'.$data['pesan']);
			// redirect('Board/index/');
			$this->load->view('formsukses',$data);
		}else{
			//var_dump($filter);
			//redirect('');
			$data1['sto']=$this->kawal_model->tampil_dataSTO();
			$data1['agency']=$this->kawal_model->tampil_dataAgency();
			$data1['pesan']='Data duplikat';
			$data1['notif']=0;
			// redirect('Board/index/');
			// redirect('Board/index/'.$data1.'/'.$data['pesan']);
      		$this->load->view('formsukses',$data1);
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
		// $this->load->view('comingsoon');
	}

	public function login2(){
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
		$this->load->model('kawal_model');
		$this->load->model('Db_model');
		
        $user=$this->session->userdata('username');
        $sto=$this->session->userdata('sto');
        if(isset($user)){
			$data['today'] = date('d F Y');
			//all
			$data['jumlah_wo']=$this->Db_model->selectWOAll($sto);
			$data['ok_sc']=$this->Db_model->selectOK_SC($sto);
			$data['ok_blmsc']=$this->Db_model->selectOK_BLMSC($sto);
			$data['nok_depo']=$this->Db_model->selectNOK_DEPO($sto);
			$data['nok_blmdepo']=$this->Db_model->selectNOK_BLMDEPO($sto);

			//a2			
            $data['a2_ok']=$this->Db_model->selectA2_OK($sto);
            $data['a2_nok']=$this->Db_model->selectA2_NOK($sto);
			$data['a2_blmdivalidasi']=$this->Db_model->selectA2_null($sto);
			
			//so
            $data['so_ok']=$this->Db_model->selectSO_OK($sto);
            $data['so_nok']=$this->Db_model->selectSO_NOK($sto);
			$data['so_blm_update']=$this->Db_model->selectSO_not_updated($sto);

			$data['teknisi_null']=$this->Db_model->selectWOTeknisiNull($sto);	
			
			$data_1['vb_teknisi'] = $this->Db_model->select_SO();
			$ubs = array();
			$id_ubs = array();
			$wo_total = array();
			$wo_blm = array();
			$wo_kendala = array();		
			foreach($data_1['vb_teknisi'] as $vis)
			{
				//var_dump($vis->ubis);
				array_push($id_ubs,$vis->id_sto);
				array_push($ubs,$vis->ubis);
				array_push($wo_total,count($this->Db_model->rekapwo_vb($vis->id_sto)));
				array_push($wo_blm,count($this->Db_model->rekapwo_vb_notupdate($vis->id_sto)));
				array_push($wo_kendala,count($this->Db_model->rekapwo_vb_kendala($vis->id_sto)));
				
			}

			$data['id_sto'] = $id_ubs;
			$data['ubs'] = $ubs;
			$data['wo_total'] = $wo_total;
			$data['wo_blm'] = $wo_blm;			
			$data['wo_kendala'] = $wo_kendala;			
			
			$data['kps']=count($this->Db_model->selectWOAll('STO00014'));
			$data['mgo']=count($this->Db_model->selectWOAll('STO00018'));
			$data['kbl']=count($this->Db_model->selectWOAll('STO00009'));
			$data['kjr']=count($this->Db_model->selectWOAll('STO00011'));
			$data['kln']=count($this->Db_model->selectWOAll('STO00012'));
			$data['tns']=count($this->Db_model->selectWOAll('STO00021'));
			$data['knn']=count($this->Db_model->selectWOAll('STO00013'));
			$data['lki']=count($this->Db_model->selectWOAll('STO00016'));
			$data['krp']=count($this->Db_model->selectWOAll('STO00015'));
			$data['bbe']=count($this->Db_model->selectWOAll('STO00002'));			
			$data['lmg']=count($this->Db_model->selectWOAll('STO00017'));

			$data['kps_valid']=count($this->Db_model->selectSO_OK('STO00014'));
			$data['mgo_valid']=count($this->Db_model->selectSO_OK('STO00018'));
			$data['kbl_valid']=count($this->Db_model->selectSO_OK('STO00009'));
			$data['kjr_valid']=count($this->Db_model->selectSO_OK('STO00011'));
			$data['kln_valid']=count($this->Db_model->selectSO_OK('STO00012'));
			$data['tns_valid']=count($this->Db_model->selectSO_OK('STO00021'));
			$data['knn_valid']=count($this->Db_model->selectSO_OK('STO00013'));
			$data['lki_valid']=count($this->Db_model->selectSO_OK('STO00016'));
			$data['krp_valid']=count($this->Db_model->selectSO_OK('STO00015'));
			$data['bbe_valid']=count($this->Db_model->selectSO_OK('STO00002'));			
			$data['lmg_valid']=count($this->Db_model->selectSO_OK('STO00017'));

			$data['kps_valid_a2']=count($this->Db_model->selectA2_OK('STO00014'));
			$data['mgo_valid_a2']=count($this->Db_model->selectA2_OK('STO00018'));
			$data['kbl_valid_a2']=count($this->Db_model->selectA2_OK('STO00009'));
			$data['kjr_valid_a2']=count($this->Db_model->selectA2_OK('STO00011'));
			$data['kln_valid_a2']=count($this->Db_model->selectA2_OK('STO00012'));
			$data['tns_valid_a2']=count($this->Db_model->selectA2_OK('STO00021'));
			$data['knn_valid_a2']=count($this->Db_model->selectA2_OK('STO00013'));
			$data['lki_valid_a2']=count($this->Db_model->selectA2_OK('STO00016'));
			$data['krp_valid_a2']=count($this->Db_model->selectA2_OK('STO00015'));
			$data['bbe_valid_a2']=count($this->Db_model->selectA2_OK('STO00002'));
			$data['lmg_valid_a2']=count($this->Db_model->selectA2_OK('STO00017'));

			//mtd
			$from = date('Y-m') . '-01';
			$to = date('Y-m-d');
			
			
			$data['kps_mtd']=count($this->kawal_model->reportDataKawalTL('STO00014',$from,$to));
			$data['mgo_mtd']=count($this->kawal_model->reportDataKawalTL('STO00018',$from,$to));
			$data['kbl_mtd']=count($this->kawal_model->reportDataKawalTL('STO00009',$from,$to));
			$data['kjr_mtd']=count($this->kawal_model->reportDataKawalTL('STO00011',$from,$to));
			$data['kln_mtd']=count($this->kawal_model->reportDataKawalTL('STO00012',$from,$to));
			$data['tns_mtd']=count($this->kawal_model->reportDataKawalTL('STO00021',$from,$to));
			$data['knn_mtd']=count($this->kawal_model->reportDataKawalTL('STO00013',$from,$to));
			$data['lki_mtd']=count($this->kawal_model->reportDataKawalTL('STO00016',$from,$to));
			$data['krp_mtd']=count($this->kawal_model->reportDataKawalTL('STO00015',$from,$to));
			$data['bbe_mtd']=count($this->kawal_model->reportDataKawalTL('STO00002',$from,$to));
			$data['lmg_mtd']=count($this->kawal_model->reportDataKawalTLdatel('DATEL00003',$from,$to));

			/*
			$data['kps_valid_mtd']=count($this->Db_model->selectSO_OK('STO00014'));
			$data['mgo_valid_mtd']=count($this->Db_model->selectSO_OK('STO00018'));
			$data['kbl_valid_mtd']=count($this->Db_model->selectSO_OK('STO00009'));
			$data['kjr_valid_mtd']=count($this->Db_model->selectSO_OK('STO00011'));
			$data['kln_valid_mtd']=count($this->Db_model->selectSO_OK('STO00012'));
			$data['tns_valid_mtd']=count($this->Db_model->selectSO_OK('STO00021'));
			$data['knn_valid_mtd']=count($this->Db_model->selectSO_OK('STO00013'));
			$data['lki_valid_mtd']=count($this->Db_model->selectSO_OK('STO00016'));
			$data['krp_valid_mtd']=count($this->Db_model->selectSO_OK('STO00015'));
			$data['bbe_valid_mtd']=count($this->Db_model->selectSO_OK('STO00002'));
			$data['lmg_valid_mtd']=count($this->Db_model->selectSO_OK('STO00017'));

			$data['kps_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00014'));
			$data['mgo_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00018'));
			$data['kbl_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00009'));
			$data['kjr_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00011'));
			$data['kln_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00012'));
			$data['tns_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00021'));
			$data['knn_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00013'));
			$data['lki_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00016'));
			$data['krp_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00015'));
			$data['bbe_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00002'));
			$data['lmg_valid_a2_mtd']=count($this->Db_model->selectA2_OK('STO00017'));
			*/

            $this->load->view('db',$data);
        }else{
            redirect('Board/login');
        }
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
			$this->load->model('Db_model');
			$this->load->model('kawal_model');
			$perintah = $this->uri->segment('3');
			$data['channel']=$this->kawal_model->selectChannel();
			
			if($perintah == "1")
			{
				$data['query']=$this->Db_model->selectWOAll($sto);
				$data['kata'] = "WO HARI INI";
			}
			elseif($perintah == "2")
			{
				$data['query']=$this->Db_model->selectOK_SC($sto);
				$data['kata'] = "WO HARI INI SUDAH ADA SC";
			}
			elseif($perintah == "3")
			{
				$data['query']=$this->Db_model->selectOK_BLMSC($sto);
				$data['kata'] = "WO HARI INI BELUM ADA SC";
			}
			elseif($perintah == "4")
			{
				$data['query']=$this->Db_model->selectNOK_DEPO($sto);
				$data['kata'] = "WO HARI INI NOK A2 DAN UBIS TAPI SUDAH DEPOSIT";
			}
			elseif($perintah == "5")
			{
				$data['kata'] = "WO HARI INI NOK A2 DAN UBIS TAPI BELUM DEPOSIT";
				$data['query']=$this->Db_model->selectNOK_BLMDEPO($sto);
			}
			elseif($perintah == "6")
			{
				$data['kata'] = "WO HARI INI OK OLEH UBIS";
				$data['query']=$this->Db_model->selectSO_OK($sto);
			}
			elseif($perintah == "7")
			{
				$data['kata'] = "WO HARI INI NOK OLEH UBIS";
				$data['query']=$this->Db_model->selectSO_NOK($sto);
			}
			elseif($perintah == "8")
			{
				$data['kata'] = "WO HARI INI BELUM ADA UPDATE DARI UBIS";
				$data['query']=$this->Db_model->selectSO_not_updated($sto);
			}
			elseif($perintah == "9")
			{
				$data['kata'] = "WO HARI INI OK OLEH A2";
				$data['query']=$this->Db_model->selectA2_OK($sto);				
			}
			elseif($perintah == "10")
			{
				$data['kata'] = "WO HARI INI NOK OLEH A2";
				$data['query']=$this->Db_model->selectA2_NOK($sto);
			}
			elseif($perintah == "11")
			{
				$data['kata'] = "WO HARI INI BELUM DIVALIDASI A2";
				$data['query']=$this->Db_model->selectA2_null($sto);
			}
			else
			{
				$data['kata'] = "WO HARI INI";
				$data['query']=$this->Db_model->selectWOAll($sto);
			}
            $this->load->view('dash_detail',$data); 
        }else{
            redirect('Board/login');
        }
	}
	
	public function uploadpsb(){
		$user=$this->session->userdata('username');
        if(isset($user)){
			$this->load->view('uploadpsb'); 
			// echo "ditutup sementara";
        }else{
            redirect('Board/login');
        }
	}

	public function uploadpsb2(){
		$user=$this->session->userdata('username');
        if(isset($user)){
			$this->load->view('uploadpsb2'); 
			// echo "ditutup sementara";
        }else{
            redirect('Board/login');
        }
	}

	public function douploadpsb2(){
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
		$no=0;
		
		for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
			$pk=$this->kawal_model->selectPrimaryKey2();
			$cekid=date('Y').date('m').date('d');
			$idpk=substr($pk[0]->id,4,8);
			if($cekid==$idpk){
				$number=substr($pk[0]->id,-6);
				$number=$number+1;
			}else{
				$number=000000;
			}
			// $number=substr($pk[0]->id,-6);
			// $number=$number+1;
			
			$stodetail=$this->kawal_model->selectDetailSTO($rowData[0][4]);
			
			
			if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
				
				if(substr($rowData[0][39],0,3)=='DCS'){
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
						$salesid=strtoupper($kcontact[0]);
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
				}else{
					$kcontact=NULL;
					$mobi=NULL;
					$salesid=NULL;
					$idsales=NULL;
					$namasales=NULL;
					$cpsales=NULL;
					$agency=NULL;
					$myir=NULL;
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
				if(substr($rowData[0][39],0,3)=='DCS'){
					$selectData=$this->kawal_model->selectDataKpro2($data['datakpro_orderid'],$data['datakpro_myir']);
					
				}else{
					$selectData=$this->kawal_model->selectUniqueSC2($data['datakpro_orderid']);
				}
				echo "<h1>".$no++."</h1>";
				var_dump($data);
				echo "<br>";
				echo "<br>";
				// echo $data['datakpro_orderid'];
				// echo "<br>";
				// echo $data['datakpro_myir'];
				// echo "<br>";
				// var_dump($selectData);
				// echo $data['datakpro_id'];
				// echo "<br>";
				

				if (isset($selectData[0])){
					// echo $rowData[0][5]." update<br>";

					// $update=$this->kawal_model->updateDataKpro2($data);
					// $datas['update']=$datas['update']+$update;

					// echo "tes";
					
				}else{
					// $insert=$this->kawal_model->insertDataKpro2($data);
					// $datas['insert']=$datas['insert']+$insert; 

					// echo "t";
					
					// echo $rowData[0][5]." insert<br>"; 
				}
				
            }	 
		}
		unlink($inputFileName);
		
		// $this->load->view('uploadpsb',$datas);
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
			$cekid=date('Y').date('m').date('d');
			$idpk=substr($pk[0]->id,4,8);
			if($cekid==$idpk){
				$number=substr($pk[0]->id,-6);
				$number=$number+1;
			}else{
				$number=000000;
			}
			// $number=substr($pk[0]->id,-6);
			// $number=$number+1;
			
			$stodetail=$this->kawal_model->selectDetailSTO($rowData[0][4]);
			
			
			if ($rowData[0][0]==NULL){
				$highestRow=$row;
				break;
            }else{
				
				if(substr($rowData[0][39],0,3)=='DCS'){
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
						$salesid=strtoupper($kcontact[0]);
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
				}else{
					$kcontact=NULL;
					$mobi=NULL;
					$salesid=NULL;
					$idsales=NULL;
					$namasales=NULL;
					$cpsales=NULL;
					$agency=NULL;
					$myir=NULL;
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
				if(substr($rowData[0][39],0,3)=='DCS'){
					$selectData=$this->kawal_model->selectDataKpro($data['datakpro_orderid'],$data['datakpro_myir']);
					// var_dump($data);
				}else{
					$selectData=$this->kawal_model->selectUniqueSC($data['datakpro_orderid']);
				}
				// echo "<br>";
				// echo "<br>";
				// echo $data['datakpro_orderid'];
				// echo "<br>";
				// echo $data['datakpro_myir'];
				// echo "<br>";
				// var_dump($selectData);
				echo $data['datakpro_id'];
				echo "<br>";
				

				if (isset($selectData[0])){
					// echo $rowData[0][5]." update<br>";

					$update=$this->kawal_model->updateDataKpro($data);
					$datas['update']=$datas['update']+$update;

					// echo "tes";
					
				}else{
					$insert=$this->kawal_model->insertDataKpro($data);
					$datas['insert']=$datas['insert']+$insert; 

					// echo "t";
					
					// echo $rowData[0][5]." insert<br>"; 
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
			$data['sto']=$this->kawal_model->tampil_dataSTO();
			// if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00006' || $role=='ROLE00008'||$role=='ROLE00009'){
			// 	// $data['query']=$this->kawal_model->selectDataKawalAll();	
			// }else if ($role=='ROLE00002'){
			// 	// $data['query']=$this->kawal_model->selectDataKawalTL($sto);
			// }else if ($role=='ROLE00003'){
			// 	$data['query']=$this->kawal_model->selectDataKawalAgency($loker);
			// }else if($role=='ROLE00005'){
			// 	// $data['query']=$this->kawal_model->selectDataKawalA2($user);
			// }else if($role=='ROLE00007'){
			// 	$data['query']=$this->kawal_model->selectDataKawalPlasa($user);
			// }else if($role=='ROLE00004'){
			// 	// $data['query']=$this->kawal_model->selectDataKawalInputter();
			// }
			$this->load->view('kawalpsb',$data); 
        }else{
            redirect('Board/login');
        }
	}

	public function kawalpsb2(){
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
        // if(isset($user)){
			$this->load->model('kawal_model');
			$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
			$data['statusorder']=$this->kawal_model->selectStatusOrder();
			$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
			$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
			$data['channel']=$this->kawal_model->selectChannel();
			$data['valinputter']=$this->kawal_model->selectValidasiInputter();
			$data['sto']=$this->kawal_model->tampil_dataSTO();
			// if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00006' || $role=='ROLE00008'||$role=='ROLE00009'){
				$data['query']=$this->kawal_model->selectDataKawalAll();	
			// }else if ($role=='ROLE00002'){
			// 	$data['query']=$this->kawal_model->selectDataKawalTL($sto);
			// }else if ($role=='ROLE00003'){
			// 	$data['query']=$this->kawal_model->selectDataKawalAgency($loker);
			// }else if($role=='ROLE00005'){
			// 	$data['query']=$this->kawal_model->selectDataKawalA2($user);
			// }else if($role=='ROLE00007'){
			// 	$data['query']=$this->kawal_model->selectDataKawalPlasa($user);
			// }else if($role=='ROLE00004'){
			// 	$data['query']=$this->kawal_model->selectDataKawalInputter();
			// }
            $this->load->view('kawalpsb2',$data); 
        // }else{
        //     redirect('Board/login');
        // }
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
			'keterangan'=>$this->input->post('ket'),
			'sto'=>$this->input->post('sto')
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
			'deposit'=>$this->input->post('deposit'),
			'manja'=>$this->input->post('manja'),
			'keterangan'=>$this->input->post('ket'),
			// 'sto'=>$this->input->post('sto'),
			'oknok'=>$this->input->post('oknok')
		);
		$data['query']=$this->kawal_model->updateA2($formid,$data);
		return $data;
	}

	public function updateInputter(){
		$this->load->model('kawal_model');
		$formid=$this->input->post('form');
		$data=array(
			'orderid'=>$this->input->post('order'),
			'sto'=>$this->input->post('sto')
		);
		$data['query']=$this->kawal_model->updateInputter($formid,$data);
		return $data;
	}

	public function dropData(){
		$this->load->model('kawal_model');
		$formid=$this->input->post('form');
		// $data=array(
		// 	'orderid'=>$this->input->post('order'),
		// );
		$data['query']=$this->kawal_model->dropData($formid);
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
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
		$from=date('Y-m-d');
		$to = date("Y-m-d", time() + 86400);
		// echo $from;
		// echo "<br>";
		// echo $to;
		$diff=date_diff(date_create($from),date_create($to));
		$rentang=$diff->format("%a");

        if(isset($user)){
			$this->load->model('kawal_model');
			$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
			$data['statusorder']=$this->kawal_model->selectStatusOrder();
			$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
			$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
			$data['channel']=$this->kawal_model->selectChannel();
			$data['valinputter']=$this->kawal_model->selectValidasiInputter();
			if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00004' || $role=='ROLE00006' || $role=='ROLE00008'){
				$data['query']=$this->kawal_model->reportDataKawalAll($from,$to);	
			}else if ($role=='ROLE00002'){
				if($sto=='STO00000'){
					$data['query']=$this->kawal_model->reportDataKawalTLdatel($datel,$from,$to);
				}else{
					$data['query']=$this->kawal_model->reportDataKawalTL($sto,$from,$to);
				}
				
			}else if ($role=='ROLE00003'){
				$data['query']=$this->kawal_model->reportDataKawalAgency($loker,$from,$to);
			}else if($role=='ROLE00005'){
				$data['query']=$this->kawal_model->reportDataKawalA2($user,$from,$to);
			}else if($role=='ROLE00007'){
				$data['query']=$this->kawal_model->reportDataKawalPlasa($user,$from,$to);
			}
			$this->load->view('reportpsb',$data); 
			// echo $sto;
			// echo $rentang;
        }else{
            redirect('Board/login');
		}	
	}
	
	public function searchreportpsb(){
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
		$from=$this->input->post('startdate');
		$to = $this->input->post('enddate');
		$diff=date_diff(date_create($from),date_create($to));
		$rentang=$diff->format("%a");

		if(isset($user)){
			if ($rentang<32){
					
				$this->load->model('kawal_model');
				$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
				$data['statusorder']=$this->kawal_model->selectStatusOrder();
				$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
				$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
				$data['channel']=$this->kawal_model->selectChannel();
				$data['valinputter']=$this->kawal_model->selectValidasiInputter();
				if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00004' || $role=='ROLE00006' || $role=='ROLE00008'){
					$data['query']=$this->kawal_model->reportDataKawalAll($from,$to);	
				}else if ($role=='ROLE00002'){
					if($sto=='STO00000'){
						$data['query']=$this->kawal_model->reportDataKawalTLdatel($datel,$from,$to);
					}else{
						$data['query']=$this->kawal_model->reportDataKawalTL($sto,$from,$to);
					}
					
				}else if ($role=='ROLE00003'){
					$data['query']=$this->kawal_model->reportDataKawalAgency($loker,$from,$to);
				}else if($role=='ROLE00005'){
					$data['query']=$this->kawal_model->reportDataKawalA2($user,$from,$to);
				}else if($role=='ROLE00007'){
					$data['query']=$this->kawal_model->reportDataKawalPlasa($user,$from,$to);
				}
				$this->load->view('reportpsb',$data); 
			}else{
				redirect('Board/reportpsb');
			}
		}else{
			redirect('Board/login');
		}
	}

	public function cekcek(){
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
		$today=date('Y-m-d H:i:s');
		var_dump($today);
        // if(isset($user)){
		// 	$this->load->model('kawal_model');
		// 	$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
		// 	$data['statusorder']=$this->kawal_model->selectStatusOrder();
		// 	$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
		// 	$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
		// 	$data['channel']=$this->kawal_model->selectChannel();
		// 	$data['valinputter']=$this->kawal_model->selectValidasiInputter();
		// 	if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00004' || $role=='ROLE00006' || $role=='ROLE00008'){
		// 		$data['query']=$this->kawal_model->reportDataKawalAll();	
		// 	}else if ($role=='ROLE00002'){
		// 		$data['query']=$this->kawal_model->reportDataKawalTL($sto); //done
		// 	}else if ($role=='ROLE00003'){
		// 		$data['query']=$this->kawal_model->selectDataKawalAgency($loker);
		// 	}else if($role=='ROLE00005'){
		// 		$data['query']=$this->kawal_model->selectDataKawalA2($user);
		// 	}else if($role=='ROLE00007'){
		// 		$data['query']=$this->kawal_model->selectDataKawalPlasa($user);
		// 	}
        //     $this->load->view('reportpsb',$data); 
        // }else{
        //     redirect('Board/login');
        // }
		
	}

	public function downloaddata(){
		// Create new Spreadsheet object
		$this->load->model('kawal_model');
        ini_set("max_execution_time", 'time_limit');


        ini_set('memory_limit', '-1');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('telkom.co.id')
        ->setLastModifiedBy('Telkom Witel Surabaya Utara')
        ->setTitle('Data kawal manjainsbu.com')
        ->setSubject('950039')
        ->setDescription('950039');
        // add style to the header
        $styleArray = array(
        'font' => array(
            'bold' => true,
        ),
        'alignment' => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '333333'),
            ),
        ),
        'fill' => array(
            'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
            'startcolor' => array('rgb' => '0d0d0d'),
            'endColor'   => array('rgb' => 'f2f2f2'),
        ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:BD1')->applyFromArray($styleArray);
        // auto fit column to content
        foreach(range('A', 'BE') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        // set the names of header cells
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'REGIONAL');
        $sheet->setCellValue('C1', 'WITEL');
        $sheet->setCellValue('D1', 'DATEL');
        $sheet->setCellValue('E1', 'STO');
        $sheet->setCellValue('F1', 'ORDER ID');
        $sheet->setCellValue('G1', 'TYPE TRANSAKSI');
        $sheet->setCellValue('H1', 'JENIS LAYANAN');
        $sheet->setCellValue('I1', 'ALPRO');
        $sheet->setCellValue('J1', 'NCLI');
        $sheet->setCellValue('K1', 'POTS');
        $sheet->setCellValue('L1', 'INTERNET');
        $sheet->setCellValue('M1', 'STATUS RESUME');
        $sheet->setCellValue('N1', 'STATUS MESSAGE');
        $sheet->setCellValue('O1', 'ORDER DATE');
        $sheet->setCellValue('P1', 'LAST UPDATE STATUS');
        $sheet->setCellValue('Q1', 'DURASI V1');
		$sheet->setCellValue('R1', 'NAMA CUST');
		$sheet->setCellValue('S1', 'NO HP');
        $sheet->setCellValue('T1', 'ALAMAT');
        $sheet->setCellValue('U1', 'K-CONTACT');
        $sheet->setCellValue('V1', 'LONG');
        $sheet->setCellValue('W1', 'LAT');
        $sheet->setCellValue('X1', 'WFM ID');
        $sheet->setCellValue('Y1', 'STATUS WFM');
        $sheet->setCellValue('Z1', 'DESK TASK');
        $sheet->setCellValue('AA1', 'STATUS TASK');
		$sheet->setCellValue('AB1', 'TGL INSTALL');
		$sheet->setCellValue('AC1', 'SEKTOR');
        $sheet->setCellValue('AD1', 'AMCREW');
        $sheet->setCellValue('AE1', 'TEKNISI1');
        $sheet->setCellValue('AF1', 'PERSONID');
        $sheet->setCellValue('AG1', 'TEKNISI2');
        $sheet->setCellValue('AH1', 'PERSONID2');
        $sheet->setCellValue('AI1', 'TINDAK LANJUT');
        $sheet->setCellValue('AJ1', 'KETERANGAN');
		$sheet->setCellValue('AK1', 'USER');
		$sheet->setCellValue('AL1', 'TGL TINDAK LANJUT');
        $sheet->setCellValue('AM1', 'PACKAGE NAME');
        $sheet->setCellValue('AN1', 'ESTIMASI DROP CORE');
		$sheet->setCellValue('AO1', 'PROVIDER');
        $sheet->setCellValue('AP1', 'MYIR');
        $sheet->setCellValue('AQ1', 'SALES ID');
        $sheet->setCellValue('AR1', 'MOBI');
        $sheet->setCellValue('AS1', 'TELEGRAM SALES');
        $sheet->setCellValue('AT1', 'CP SALES');
        $sheet->setCellValue('AU1', 'NOMINAL DEPOSIT');
        $sheet->setCellValue('AV1', 'AGENCY');
		$sheet->setCellValue('AW1', 'NAMA SALES');
		$sheet->setCellValue('AX1', 'TANGGAL INPUT');
        $sheet->setCellValue('AY1', 'STATUS DEPOSIT');
        $sheet->setCellValue('AZ1', 'STATUS LAYANAN');
        $sheet->setCellValue('BA1', 'STATUS CUSTOMER');
        $sheet->setCellValue('BB1', 'CHANNEL');
		$sheet->setCellValue('BC1', 'MANJA');
		$sheet->setCellValue('BD1', 'VALIDASI A2');
		$sheet->setCellValue('BE1', 'KETERANGAN A2');
        
        $startdate=date('Y-m-d',strtotime($this->input->post('startdate')));
        $enddate=date('Y-m-d',strtotime($this->input->post('enddate')));
        
        // $agency=$this->myir_model->getUserAgency($_SESSION['username']);
        // $agn=$agency[0]->login_agency;
        if($_SESSION['role']=='ROLE00005'){
            // echo "A2";
            $getdata=$this->kawal_model->downloadDataKawalA2($_SESSION['username'],$startdate,$enddate);
        }else if($_SESSION['role']=='ROLE00002'){
			// echo "TL";
			if($_SESSION['sto']=='STO00000'){
				$getdata=$this->kawal_model->downloadDataKawalTLdatel($_SESSION['datel'],$startdate,$enddate);
			}else{
				$getdata=$this->kawal_model->downloadDataKawalTL($_SESSION['sto'],$startdate,$enddate);
			}
			
			// var_dump($getdata);
			// echo $startdate."<br>";
			// echo $enddate;
        }else if($_SESSION['role']=='ROLE00003'){
            // echo "agency";
            $getdata = $this->kawal_model->downloadDataKawalAgency($_SESSION['loker'],$startdate,$enddate);
        }else{
			//echo WOC dan ALL data
			$getdata=$this->kawal_model->downloadDataKawalAll($startdate,$enddate);
		}
        
        // var_dump($agn);
        // echo $agency[0]->login_agency;
        // Add some data
        $x = 2;
        $n=1;
        foreach($getdata as $get){
			// echo "<h1>$x</h1><br>";
            $sheet->setCellValue('A'.$x, $n);
            $sheet->setCellValue('B'.$x, $get->datakpro_regional);
            $sheet->setCellValue('C'.$x, $get->witel_name);
            $sheet->setCellValue('D'.$x, $get->datel_name);
            $sheet->setCellValue('E'.$x, $get->sto_code);
            $sheet->setCellValue('F'.$x, $get->datakpro_orderid);
            $sheet->setCellValue('G'.$x, $get->datakpro_typetransaksi);
            $sheet->setCellValue('H'.$x, $get->datakpro_jenislayanan);
            $sheet->setCellValue('I'.$x, $get->datakpro_alpro);
            $sheet->setCellValue('J'.$x, $get->datakpro_ncli);
            $sheet->setCellValue('K'.$x, $get->datakpro_pots);
            $sheet->setCellValue('L'.$x, $get->datakpro_internet);
            $sheet->setCellValue('M'.$x, $get->datakpro_statusresume);
            $sheet->setCellValue('N'.$x, $get->datakpro_statusmessage);
            $sheet->setCellValue('O'.$x, $get->datakpro_orderdate);
            $sheet->setCellValue('P'.$x, $get->datakpro_lastupdatestatus);
            $sheet->setCellValue('Q'.$x, $get->datakpro_durasi);
			$sheet->setCellValue('R'.$x, $get->datakpro_namacust);
			$sheet->setCellValue('S'.$x, $get->datakpro_nohp);
            $sheet->setCellValue('T'.$x, $get->datakpro_alamat);
            $sheet->setCellValue('U'.$x, $get->datakpro_kcontact);
            $sheet->setCellValue('V'.$x, $get->datakpro_long);
            $sheet->setCellValue('W'.$x, $get->datakpro_lat);
            $sheet->setCellValue('X'.$x, $get->datateknis_wfmid);
            $sheet->setCellValue('Y'.$x, $get->datateknis_statuswfm);
            $sheet->setCellValue('Z'.$x, $get->datateknis_desktask);
            $sheet->setCellValue('AA'.$x, $get->datateknis_statustask);
            $sheet->setCellValue('AB'.$x, $get->datateknis_tglinstall);
            $sheet->setCellValue('AC'.$x, $get->datateknis_sektor);
            $sheet->setCellValue('AD'.$x, $get->datateknis_amcrew);
            $sheet->setCellValue('AE'.$x, $get->teknisiname1);
            $sheet->setCellValue('AF'.$x, $get->teknisiid1);
            $sheet->setCellValue('AG'.$x, $get->teknisiname2);
            $sheet->setCellValue('AH'.$x, $get->teknisiid2);
            $sheet->setCellValue('AI'.$x, $get->datateknis_tindaklanjut);
			$sheet->setCellValue('AJ'.$x, trim($get->datateknis_keterangan)); 
			$sheet->setCellValue('AK'.$x, $get->datateknis_user);
            $sheet->setCellValue('AL'.$x, $get->datateknis_tgltindaklanjut);
            $sheet->setCellValue('AM'.$x, $get->datakpro_packagename);
            $sheet->setCellValue('AN'.$x, '');
            $sheet->setCellValue('AO'.$x, $get->datakpro_provider);
            $sheet->setCellValue('AP'.$x, $get->datakpro_myir);
            $sheet->setCellValue('AQ'.$x, $get->datakpro_salesid);
            $sheet->setCellValue('AR'.$x, $get->datakpro_mobi);
            $sheet->setCellValue('AS'.$x, $get->datakpro_salestelegram);
            $sheet->setCellValue('AT'.$x, $get->datakpro_saleshp);
            $sheet->setCellValue('AU'.$x, $get->datakpro_deposit);
            $sheet->setCellValue('AV'.$x, $get->lokername);
            $sheet->setCellValue('AW'.$x, $get->datakpro_salesname);
            $sheet->setCellValue('AX'.$x, $get->datakpro_tanggalinput);
            $sheet->setCellValue('AY'.$x, $get->dataa2_validasideposit);
            $sheet->setCellValue('AZ'.$x, $get->vallayanan);
            $sheet->setCellValue('BA'.$x, $get->valcustomer);
			$sheet->setCellValue('BB'.$x, $get->channel);
			$sheet->setCellValue('BC'.$x, $get->dataa2_manja);
			$sheet->setCellValue('BD'.$x, $get->dataa2_oknok);
			$sheet->setCellValue('BE'.$x, trim($get->dataa2_keterangan));
			
			
			
			// echo $get->datakpro_id."<br>";
			// echo trim($get->datateknis_keterangan)."<br>";
			// $sheet->setCellValue('B'.$x, (string)$get->datateknis_keterangan);
			// var_dump($get);
			$x++;
            $n++;
        }
        
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="kawalsbu.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
		// var_dump($getdata);
		// print_r($getdata);
	}
	
	//DOWNLOAD DATA INBOX KAWALPSB
	public function downloaddata_inbox(){
		// Create new Spreadsheet object
		$this->load->model('kawal_model');
        ini_set("max_execution_time", 'time_limit');


        ini_set('memory_limit', '-1');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Set document properties
        $spreadsheet->getProperties()->setCreator('telkom.co.id')
        ->setLastModifiedBy('Telkom Witel Surabaya Utara')
        ->setTitle('Data kawal manjainsbu.com')
        ->setSubject('950039')
        ->setDescription('950039');
        // add style to the header
        $styleArray = array(
        'font' => array(
            'bold' => true,
        ),
        'alignment' => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '333333'),
            ),
        ),
        'fill' => array(
            'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
            'startcolor' => array('rgb' => '0d0d0d'),
            'endColor'   => array('rgb' => 'f2f2f2'),
        ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:BD1')->applyFromArray($styleArray);
        // auto fit column to content
        foreach(range('A', 'BE') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        // set the names of header cells
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'REGIONAL');
        $sheet->setCellValue('C1', 'WITEL');
        $sheet->setCellValue('D1', 'DATEL');
        $sheet->setCellValue('E1', 'STO');
        $sheet->setCellValue('F1', 'ORDER ID');
        $sheet->setCellValue('G1', 'TYPE TRANSAKSI');
        $sheet->setCellValue('H1', 'JENIS LAYANAN');
        $sheet->setCellValue('I1', 'ALPRO');
        $sheet->setCellValue('J1', 'NCLI');
        $sheet->setCellValue('K1', 'POTS');
        $sheet->setCellValue('L1', 'INTERNET');
        $sheet->setCellValue('M1', 'STATUS RESUME');
        $sheet->setCellValue('N1', 'STATUS MESSAGE');
        $sheet->setCellValue('O1', 'ORDER DATE');
        $sheet->setCellValue('P1', 'LAST UPDATE STATUS');
        $sheet->setCellValue('Q1', 'DURASI V1');
		$sheet->setCellValue('R1', 'NAMA CUST');
		$sheet->setCellValue('S1', 'NO HP');
        $sheet->setCellValue('T1', 'ALAMAT');
        $sheet->setCellValue('U1', 'K-CONTACT');
        $sheet->setCellValue('V1', 'LONG');
        $sheet->setCellValue('W1', 'LAT');
        $sheet->setCellValue('X1', 'WFM ID');
        $sheet->setCellValue('Y1', 'STATUS WFM');
        $sheet->setCellValue('Z1', 'DESK TASK');
        $sheet->setCellValue('AA1', 'STATUS TASK');
		$sheet->setCellValue('AB1', 'TGL INSTALL');
		$sheet->setCellValue('AC1', 'SEKTOR');
        $sheet->setCellValue('AD1', 'AMCREW');
        $sheet->setCellValue('AE1', 'TEKNISI1');
        $sheet->setCellValue('AF1', 'PERSONID');
        $sheet->setCellValue('AG1', 'TEKNISI2');
        $sheet->setCellValue('AH1', 'PERSONID2');
        $sheet->setCellValue('AI1', 'TINDAK LANJUT');
        $sheet->setCellValue('AJ1', 'KETERANGAN');
		$sheet->setCellValue('AK1', 'USER');
		$sheet->setCellValue('AL1', 'TGL TINDAK LANJUT');
        $sheet->setCellValue('AM1', 'PACKAGE NAME');
        $sheet->setCellValue('AN1', 'ESTIMASI DROP CORE');
		$sheet->setCellValue('AO1', 'PROVIDER');
        $sheet->setCellValue('AP1', 'MYIR');
        $sheet->setCellValue('AQ1', 'SALES ID');
        $sheet->setCellValue('AR1', 'MOBI');
        $sheet->setCellValue('AS1', 'TELEGRAM SALES');
        $sheet->setCellValue('AT1', 'CP SALES');
        $sheet->setCellValue('AU1', 'NOMINAL DEPOSIT');
        $sheet->setCellValue('AV1', 'AGENCY');
		$sheet->setCellValue('AW1', 'NAMA SALES');
		$sheet->setCellValue('AX1', 'TANGGAL INPUT');
        $sheet->setCellValue('AY1', 'STATUS DEPOSIT');
        $sheet->setCellValue('AZ1', 'STATUS LAYANAN');
        $sheet->setCellValue('BA1', 'STATUS CUSTOMER');
        $sheet->setCellValue('BB1', 'CHANNEL');
		$sheet->setCellValue('BC1', 'MANJA');
		$sheet->setCellValue('BD1', 'VALIDASI A2');
		$sheet->setCellValue('BE1', 'KETERANGAN A2');
        
       
        if($_SESSION['role']=='ROLE00005'){
            // echo "A2";
            $getdata=$this->kawal_model->downloadInbox_KawalA2($_SESSION['username']);
		}else if($_SESSION['role']=='ROLE00004'){
            // echo "inputer";
            $getdata = $this->kawal_model->downloadInbox_Inputter();
        }else if($_SESSION['role']=='ROLE00002'){
			// echo "TL";
			if($_SESSION['sto']=='STO00000')
			{
				$getdata=$this->kawal_model->downloadInbox_KawalDatel($_SESSION['datel']);
				
			}
			else $getdata=$this->kawal_model->downloadInbox_KawalTL($_SESSION['sto']);
			
        }else if($_SESSION['role']=='ROLE00003'){
            // echo "agency";
            $getdata = $this->kawal_model->downloadInbox_Agency($_SESSION['loker']);
        }else{
			//echo WOC dan ALL data
			$getdata=$this->kawal_model->downloadInbox();
		}
        
        // var_dump($agn);
        // echo $agency[0]->login_agency;
        // Add some data
        $x = 2;
        $n=1;
        foreach($getdata as $get){
            $sheet->setCellValue('A'.$x, $n);
            $sheet->setCellValue('B'.$x, $get->datakpro_regional);
            $sheet->setCellValue('C'.$x, 'SBY UTARA');
            $sheet->setCellValue('D'.$x, '');
            $sheet->setCellValue('E'.$x, $get->sto_code);
            $sheet->setCellValue('F'.$x, $get->datakpro_orderid);
            $sheet->setCellValue('G'.$x, $get->datakpro_typetransaksi);
            $sheet->setCellValue('H'.$x, $get->datakpro_jenislayanan);
            $sheet->setCellValue('I'.$x, $get->datakpro_alpro);
            $sheet->setCellValue('J'.$x, $get->datakpro_ncli);
            $sheet->setCellValue('K'.$x, $get->datakpro_pots);
            $sheet->setCellValue('L'.$x, $get->datakpro_internet);
            $sheet->setCellValue('M'.$x, $get->datakpro_statusresume);
            $sheet->setCellValue('N'.$x, $get->datakpro_statusmessage);
            $sheet->setCellValue('O'.$x, $get->datakpro_orderdate);
            $sheet->setCellValue('P'.$x, $get->datakpro_lastupdatestatus);
            $sheet->setCellValue('Q'.$x, $get->datakpro_durasi);
			$sheet->setCellValue('R'.$x, $get->datakpro_namacust);
			$sheet->setCellValue('S'.$x, $get->datakpro_nohp);
            $sheet->setCellValue('T'.$x, $get->datakpro_alamat);
            $sheet->setCellValue('U'.$x, $get->datakpro_kcontact);
            $sheet->setCellValue('V'.$x, $get->datakpro_long);
            $sheet->setCellValue('W'.$x, $get->datakpro_lat);
            $sheet->setCellValue('X'.$x, $get->datateknis_wfmid);
            $sheet->setCellValue('Y'.$x, $get->datateknis_statuswfm);
            $sheet->setCellValue('Z'.$x, $get->datateknis_desktask);
            $sheet->setCellValue('AA'.$x, $get->datateknis_statustask);
            $sheet->setCellValue('AB'.$x, $get->datateknis_tglinstall);
            $sheet->setCellValue('AC'.$x, $get->datateknis_sektor);
            $sheet->setCellValue('AD'.$x, $get->datateknis_amcrew);
            $sheet->setCellValue('AE'.$x, $get->teknisiname1);
            $sheet->setCellValue('AF'.$x, $get->teknisiid1);
            $sheet->setCellValue('AG'.$x, $get->teknisiname2);
            $sheet->setCellValue('AH'.$x, $get->teknisiid2);
            $sheet->setCellValue('AI'.$x, $get->datateknis_tindaklanjut);
			$sheet->setCellValue('AJ'.$x, $get->datateknis_keterangan);
			$sheet->setCellValue('AK'.$x, $get->datateknis_user);
            $sheet->setCellValue('AL'.$x, $get->datateknis_tgltindaklanjut);
            $sheet->setCellValue('AM'.$x, $get->datakpro_packagename);
            $sheet->setCellValue('AN'.$x, '');
            $sheet->setCellValue('AO'.$x, $get->datakpro_provider);
            $sheet->setCellValue('AP'.$x, $get->datakpro_myir);
            $sheet->setCellValue('AQ'.$x, $get->datakpro_salesid);
            $sheet->setCellValue('AR'.$x, $get->datakpro_mobi);
            $sheet->setCellValue('AS'.$x, $get->datakpro_salestelegram);
            $sheet->setCellValue('AT'.$x, $get->datakpro_saleshp);
            $sheet->setCellValue('AU'.$x, $get->datakpro_deposit);
            $sheet->setCellValue('AV'.$x, $get->lokername);
            $sheet->setCellValue('AW'.$x, $get->datakpro_salesname);
            $sheet->setCellValue('AX'.$x, $get->datakpro_tanggalinput);
            $sheet->setCellValue('AY'.$x, $get->dataa2_validasideposit);
            $sheet->setCellValue('AZ'.$x, $get->vallayanan);
            $sheet->setCellValue('BA'.$x, $get->valcustomer);
			$sheet->setCellValue('BB'.$x, $get->channel);
			$sheet->setCellValue('BC'.$x, $get->dataa2_manja);
			$sheet->setCellValue('BD'.$x, $get->dataa2_oknok);
			$sheet->setCellValue('BE'.$x, $get->dataa2_keterangan);
            $x++;
            $n++;
        }
        
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="kawalsbu.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
		// var_dump($getdata);
		// print_r($getdata);
    }

	public function reportggn(){
		$this->load->view('comingsoon'); 
	}

	public function changepassword(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('changepassword');
        }else{
            redirect('Board/login');
        }
	}

	public function dochangepassword(){
		$passwordlama=md5($this->input->post('passlama'));
		$passbaru=md5($this->input->post('passbaru'));
		$this->load->model('kawal_model');
		$selectpasslama=$this->kawal_model->selectPassLama($_SESSION['username']);
		// var_dump($selectpasslama);
		// echo $_SESSION['username'];
		if($selectpasslama[0]->users_password==$passwordlama){
			$this->kawal_model->updatePassword($_SESSION['username'],$passbaru);
			// redirect('Board/changepassword');
			$data['notif']='1';
			$data['pesan']='Password berhasil dirubah';
			$this->load->view('changepassword',$data);
			// echo "bisa";
		}else{
			$data['notif']='0';
			$data['pesan']='Password gagal dirubah';
			$this->load->view('changepassword',$data);
			// redirect('Board/changepassword');
			// echo "error";
		}
	}

	public function editData(){
		$this->load->model('kawal_model');
		$formid=$this->input->post('form');
		if($_SESSION['role']=='ROLE00002'){
			$data['query']=$this->kawal_model->editTL($formid);
		}else if($_SESSION['role']=='ROLE00004'){
			$data['query']=$this->kawal_model->editInputter($formid);
		}else if ($_SESSION['role']=='ROLE00005'){
			$data['query']=$this->kawal_model->editA2($formid);
		}else if ($_SESSION['role']=='ROLE00009'){
			$data['query']=$this->kawal_model->editCAM($formid);
		}else if ($_SESSION['role']=='ROLE00000'){
			$data['query']=$this->kawal_model->editAdmin($formid);
		}
		return $data;
	}

	public function getNCX(){
		$this->load->model('kawal_model');
		// echo $_POST['data'];
		$datas['insert']=0;
		$datas['update']=0;
		$number=0;
		$pk=$this->kawal_model->selectPrimaryKey();
		$cekid=date('Y').date('m').date('d');
		$idpk=substr($pk[0]->id,4,8);
		if($cekid==$idpk){
			$number=substr($pk[0]->id,-6);
			$number=$number+1;
		}else{
			$number=000000;
		}

		$datawilayah=$this->kawal_model->selectDetailSTO($_POST['sto']);

		// $formid='FORM'.date('Y').date('m').date('d').sprintf('%06d',$number);
		// $treg=$datawilayah[0]->sto_regionalid;
		// $witel=$datawilayah[0]->sto_witelid;
		// $datel=$datawilayah[0]->sto_datelid;
		// $sto=$datawilayah[0]->sto_id;
		$orderid=$_POST['orderid'];
		$typetransaksi=explode("|",$_POST['typetransaksi']);
		$jenislayanan=count(explode("+",$typetransaksi[1]));
		$orderdate=date('Y-m-d H:i:s',strtotime($_POST['orderdate']));
		if(isset($_POST['paket'])){
			$paket=$_POST['paket'];
		}else{
			$paket=NULL;
		}
		$postkcontact=$_POST['kcontact'];
		
		$datakkontact=explode(";",$postkcontact);
		
		if($datakkontact[0]=="MI"){
			$nohp=$datakkontact[4];
			$myir=$datakkontact[1];
			$salesmobi=explode("-",$datakkontact[2]);
			if(isset($salesmobi[1])){
				// echo "ada mobi";
				$salesid=strtoupper($salesmobi[0]);
				$mobi=$salesmobi[1];
			}else{
				// echo "tdk ada mobi";
				$salesid=strtoupper($salesmobi[0]);
				$mobi=NULL;
			}
			// var_dump($salesid);
			// echo "<br><br>";
			$datasales=$this->kawal_model->selectDetailSales($salesid);
			// $datasales=NULL;
			$selectData=$this->kawal_model->selectDataKpro($orderid,$myir);
			$provider="DCS";
			echo "DCS";

		}
		// else if (substr($datakkontact[0],0,3)=="[PL"){
		// 	$nohp=$datakkontact[3];
		// 	$myir=NULL;
		// 	$salesid=$datakkontact[0];
		// 	$salesmobi=explode("-",$datakkontact[2]);
		// 	if(isset($salesmobi[1])){
		// 		$mobi=$salesmobi[1];
		// 	}else{
		// 		$mobi=NULL;
		// 	}
		// 	$datasales=NULL;
		// 	$selectData=$this->kawal_model->dummyselectUniqueSC($orderid);
		// 	// $selectData[0]="1";
		// 	$provider="DCS";
		// 	echo "PLS";
		// }
		
		// else if (substr($datakkontact[0],0,2)=="SP"){
		// 	echo "aneh";
		// 	$nohp=NULL;
		// 	$myir=NULL;
		// 	$salesid=NULL;
		// 	$mobi=NULL;
		// 	$datasales=NULL;
		// 	$selectData=$this->kawal_model->dummyselectUniqueSC($_POST['orderid']);
		// 	$provider=NULL;
		// 	// var_dump($selectData);
		// }
		else{
			$nohp=NULL;
			$myir=NULL;
			$salesid=NULL;
			$mobi=NULL;
			$datasales=NULL;
			$selectData=$this->kawal_model->selectUniqueSC($orderid);
			// $selectData[0]="1";
			var_dump($selectData);
			$provider="DBS/DES/DGS";
			echo "DBS";
		}
		
		// var_dump($datasales);

		if($datasales!=NULL){
			// var_dump($datasales);
			// echo "<br><br>";
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
		
		if(isset($_POST['pots'])){
			$pots=$_POST['pots'];
		}else{
			$pots=NULL;
		}

		if(isset($_POST['inet'])){
			$inet=$_POST['inet'];
		}else{
			$inet=NULL;
		}

		if(isset($_POST['ncli'])){
			$ncli=$_POST['ncli'];
		}else{
			$ncli=NULL;
		}


		

		$data = array(
			"datakpro_id"=>"FORM".date('Y').date('m').date('d').sprintf('%06d',$number),
			"datakpro_regional"=>$datawilayah[0]->sto_regionalid, 
			"datakpro_witel"=>$datawilayah[0]->sto_witelid,
			"datakpro_datel"=>$datawilayah[0]->sto_datelid,
			"datakpro_sto"=>$datawilayah[0]->sto_id,
			"datakpro_orderid"=>$_POST['orderid'],
			"datakpro_typetransaksi"=>$typetransaksi[0],
			"datakpro_jenislayanan"=> $jenislayanan."P",
			"datakpro_alpro"=>$_POST['alpro'],
			"datakpro_ncli"=>$ncli,
			"datakpro_pots"=>$pots,
			"datakpro_internet"=>$inet,
			"datakpro_statusresume"=>$_POST['statresume'],
			"datakpro_statusmessage"=>$_POST['statmessage'],
			"datakpro_orderdate"=>$orderdate,
			"datakpro_lastupdatestatus"=>date('Y-m-d H:i:s'),
			"datakpro_durasi"=>NULL,
			"datakpro_namacust"=>$_POST['namacust'],
			"datakpro_nohp"=>$nohp,
			"datakpro_alamat"=>$_POST['alamat'],
			"datakpro_kcontact"=>$_POST['kcontact'],
			"datakpro_long"=>$_POST['long'],
			"datakpro_lat"=>$_POST['lat'],
			"datakpro_packagename"=>$paket,
			// "datakpro_provider"=>$rowData[0][38],
			"datakpro_myir"=>$myir,
			"datakpro_salesid"=>$salesid,
			"datakpro_mobi"=>$mobi,
			"datakpro_salestelegram"=>NULL,
			"datakpro_saleshp"=>$cpsales,
			"datakpro_deposit"=>NULL,
			"datakpro_agency"=>$agency,
			"datakpro_salesname"=>$namasales,
			"datakpro_tanggalinput"=>$orderdate,
			"datateknis_wfmid"=>NULL,
			"datateknis_statuswfm"=>NULL,
			"datateknis_desktask"=>NULL,
			"datateknis_statustask"=>NULL,
			"datateknis_tglinstall"=>NULL,
			"datakpro_provider"=>$provider

			// "datakpro_salesid"=>


			
		);

		// $tesdata=$_POST['data']." ".date('Y-m-d H:i:s');

		// parse_str(file_get_contents("php://input"),$post_vars);
		// $tesdata=$post_vars['data'];

		// $this->kawal_model->dummyinputPost($data);
		// echo $tesdata;
		// echo $formid;
		// echo $data['datakpro_orderid'];
		// echo $data['datakpro_kcontact'];
		var_dump($selectData);
		// print_r($selectData);
		// echo $selectData[0];
		if(isset($selectData[0])){
			$flag=1;
		}else if(isset($selectData[0]->jml)){
			$flag=0;
		}else{
			$flag=0;
		}
		// echo array_key_exists(0,$selectData);
		if ($flag==1){
			// echo $rowData[0][5]." update<br>";

			// $update=
			$this->kawal_model->updateDataKpro($data);
			// $update=1;
			// $datas['update']=$datas['update']+$update;
			echo "masuk update";
			// echo "tes";
			
		}else if($flag==0){
			// $insert=
			$this->kawal_model->insertDataKpro($data);
			// $insert=1;
			// $datas['insert']=$datas['insert']+$insert; 
			echo "masuk insert";
			// echo "t";
			
			// echo $rowData[0][5]." insert<br>"; 
		}

		// echo $data['datakpro_orderid'];
		// echo $datas['update']." ".$datas['insert'];
		// var_dump($selectData);
		$_POST=array();
	}

	public function dummygetNCX(){
		$this->load->model('kawal_model');
		// echo $_POST['data'];
		$datas['insert']=0;
		$datas['update']=0;
		$number=0;
		$pk=$this->kawal_model->selectPrimaryKey2();
		$cekid=date('Y').date('m').date('d');
		$idpk=substr($pk[0]->id,4,8);
		if($cekid==$idpk){
			$number=substr($pk[0]->id,-6);
			$number=$number+1;
		}else{
			$number=000000;
		}

		$datawilayah=$this->kawal_model->selectDetailSTO($_POST['sto']);

		// $formid='FORM'.date('Y').date('m').date('d').sprintf('%06d',$number);
		// $treg=$datawilayah[0]->sto_regionalid;
		// $witel=$datawilayah[0]->sto_witelid;
		// $datel=$datawilayah[0]->sto_datelid;
		// $sto=$datawilayah[0]->sto_id;
		$orderid=$_POST['orderid'];
		$typetransaksi=explode("|",$_POST['typetransaksi']);
		$jenislayanan=count(explode("+",$typetransaksi[1]));
		$orderdate=date('Y-m-d H:i:s',strtotime($_POST['orderdate']));
		if(isset($_POST['paket'])){
			$paket=$_POST['paket'];
		}else{
			$paket=NULL;
		}
		$postkcontact=$_POST['kcontact'];
		
		$datakkontact=explode(";",$postkcontact);
		
		if($datakkontact[0]=="MI"){
			$nohp=$datakkontact[4];
			$myir=$datakkontact[1];
			$salesmobi=explode("-",$datakkontact[2]);
			if(isset($salesmobi[1])){
				// echo "ada mobi";
				$salesid=strtoupper($salesmobi[0]);
				$mobi=$salesmobi[1];
			}else{
				// echo "tdk ada mobi";
				$salesid=strtoupper($salesmobi[0]);
				$mobi=NULL;
			}
			// var_dump($salesid);
			// echo "<br><br>";
			$datasales=$this->kawal_model->selectDetailSales($salesid);
			// $datasales=NULL;
			$selectData=$this->kawal_model->dummyselectDataKpro($orderid,$myir);
			$provider="DCS";
			echo "DCS";

		}
		// else if (substr($datakkontact[0],0,3)=="[PL"){
		// 	$nohp=$datakkontact[3];
		// 	$myir=NULL;
		// 	$salesid=$datakkontact[0];
		// 	$salesmobi=explode("-",$datakkontact[2]);
		// 	if(isset($salesmobi[1])){
		// 		$mobi=$salesmobi[1];
		// 	}else{
		// 		$mobi=NULL;
		// 	}
		// 	$datasales=NULL;
		// 	$selectData=$this->kawal_model->dummyselectUniqueSC($orderid);
		// 	// $selectData[0]="1";
		// 	$provider="DCS";
		// 	echo "PLS";
		// }
		
		// else if (substr($datakkontact[0],0,2)=="SP"){
		// 	echo "aneh";
		// 	$nohp=NULL;
		// 	$myir=NULL;
		// 	$salesid=NULL;
		// 	$mobi=NULL;
		// 	$datasales=NULL;
		// 	$selectData=$this->kawal_model->dummyselectUniqueSC($_POST['orderid']);
		// 	$provider=NULL;
		// 	// var_dump($selectData);
		// }
		else{
			$nohp=NULL;
			$myir=NULL;
			$salesid=NULL;
			$mobi=NULL;
			$datasales=NULL;
			$selectData=$this->kawal_model->dummyselectUniqueSC($orderid);
			// $selectData[0]="1";
			var_dump($selectData);
			$provider="DBS/DES/DGS";
			echo "DBS";
		}
		
		// var_dump($datasales);

		if($datasales!=NULL){
			// var_dump($datasales);
			// echo "<br><br>";
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
		
		if(isset($_POST['pots'])){
			$pots=$_POST['pots'];
		}else{
			$pots=NULL;
		}

		if(isset($_POST['inet'])){
			$inet=$_POST['inet'];
		}else{
			$inet=NULL;
		}

		

		$data = array(
			"datakpro_id"=>"FORM".date('Y').date('m').date('d').sprintf('%06d',$number),
			"datakpro_regional"=>$datawilayah[0]->sto_regionalid, 
			"datakpro_witel"=>$datawilayah[0]->sto_witelid,
			"datakpro_datel"=>$datawilayah[0]->sto_datelid,
			"datakpro_sto"=>$datawilayah[0]->sto_id,
			"datakpro_orderid"=>$_POST['orderid'],
			"datakpro_typetransaksi"=>$typetransaksi[0],
			"datakpro_jenislayanan"=> $jenislayanan."P",
			"datakpro_alpro"=>$_POST['alpro'],
			"datakpro_ncli"=>$_POST['ncli'],
			"datakpro_pots"=>$pots,
			"datakpro_internet"=>$inet,
			"datakpro_statusresume"=>$_POST['statresume'],
			"datakpro_statusmessage"=>$_POST['statmessage'],
			"datakpro_orderdate"=>$orderdate,
			"datakpro_lastupdatestatus"=>date('Y-m-d H:i:s'),
			"datakpro_durasi"=>NULL,
			"datakpro_namacust"=>$_POST['namacust'],
			"datakpro_nohp"=>$nohp,
			"datakpro_alamat"=>$_POST['alamat'],
			"datakpro_kcontact"=>$_POST['kcontact'],
			"datakpro_long"=>$_POST['long'],
			"datakpro_lat"=>$_POST['lat'],
			"datakpro_packagename"=>$paket,
			// "datakpro_provider"=>$rowData[0][38],
			"datakpro_myir"=>$myir,
			"datakpro_salesid"=>$salesid,
			"datakpro_mobi"=>$mobi,
			"datakpro_salestelegram"=>NULL,
			"datakpro_saleshp"=>$cpsales,
			"datakpro_deposit"=>NULL,
			"datakpro_agency"=>$agency,
			"datakpro_salesname"=>$namasales,
			"datakpro_tanggalinput"=>$orderdate,
			"datateknis_wfmid"=>NULL,
			"datateknis_statuswfm"=>NULL,
			"datateknis_desktask"=>NULL,
			"datateknis_statustask"=>NULL,
			"datateknis_tglinstall"=>NULL,
			"datakpro_provider"=>$provider

			// "datakpro_salesid"=>


			
		);

		// $tesdata=$_POST['data']." ".date('Y-m-d H:i:s');

		// parse_str(file_get_contents("php://input"),$post_vars);
		// $tesdata=$post_vars['data'];

		// $this->kawal_model->dummyinputPost($data);
		// echo $tesdata;
		// echo $formid;
		// echo $data['datakpro_orderid'];
		// echo $data['datakpro_kcontact'];
		var_dump($selectData);
		// print_r($selectData);
		// echo $selectData[0];
		if(isset($selectData[0])){
			$flag=1;
		}else if(isset($selectData[0]->jml)){
			$flag=0;
		}else{
			$flag=0;
		}
		// echo array_key_exists(0,$selectData);
		if ($flag==1){
			// echo $rowData[0][5]." update<br>";

			// $update=
			$this->kawal_model->dummyupdateDataKpro($data);
			// $update=1;
			// $datas['update']=$datas['update']+$update;
			echo "masuk update";
			// echo "tes";
			
		}else if($flag==0){
			// $insert=
			$this->kawal_model->dummyinsertDataKpro($data);
			// $insert=1;
			// $datas['insert']=$datas['insert']+$insert; 
			echo "masuk insert";
			// echo "t";
			
			// echo $rowData[0][5]." insert<br>"; 
		}

		// echo $data['datakpro_orderid'];
		// echo $datas['update']." ".$datas['insert'];
		// var_dump($selectData);
		$_POST=array();
	}

	public function cekdummySC(){
		$this->load->model('kawal_model');
		$orderid=$_POST['orderid'];
		$selectData=$this->kawal_model->dummyselectUniqueSC($orderid);
		var_dump($selectData);
	}

	public function searchbymyir(){
		$user=$this->session->userdata('username');
        if(isset($user)){
            $this->load->view('searchbymyir');
        }else{
            redirect('Board/login');
        }
	}

	public function dosearchmyir(){
		$this->load->model('kawal_model');
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
		$loker=$this->session->userdata('loker');
		if(isset($user)){
			$data['teknisi']=$this->kawal_model->selectTeknisiPSB($sto);
			$data['statusorder']=$this->kawal_model->selectStatusOrder();
			$data['vallayanan']=$this->kawal_model->selectValidasiLayanan();
			$data['valcustomer']=$this->kawal_model->selectValidasiCustomer();
			$data['channel']=$this->kawal_model->selectChannel();
			$data['valinputter']=$this->kawal_model->selectValidasiInputter();
			$data['sto']=$this->kawal_model->tampil_dataSTO();

			$myir=strtoupper($this->input->post('myir'));
			$data['query']=$this->kawal_model->searchmyir($myir);
			$this->load->view('kawalpsb2',$data);
		}else{
			redirect('Board/login');
		}
		// var_dump($data);
	}

	public function serverside(){
		$this->load->model('kawal_model');
		// $stoid=$this->input->post('stoid');
		// var_dump($stoid);
		// echo $stoid;
		$list = $this->kawal_model->get_datatables();

        $data = array();
		$no = $_POST['start'];

		$usersto=$this->session->userdata('sto');
		$teknisi=$this->kawal_model->selectTeknisiPSB($usersto);
		$statusorder=$this->kawal_model->selectStatusOrder();
		$vallayanan=$this->kawal_model->selectValidasiLayanan();
		$valcustomer=$this->kawal_model->selectValidasiCustomer();
		$channel=$this->kawal_model->selectChannel();
		// $valinputter=$this->kawal_model->selectValidasiInputter();
		$sto=$this->kawal_model->tampil_dataSTO();

		
		
        foreach ($list as $field) {
            $no++;
			$row = array();
			$row[] = '<div style="display: none;" id="formid'.$field->datakpro_id.'">'.$field->datakpro_id.'</div>';
            $row[] = $no.'<div style="display: none;" id="formid'.$field->datakpro_id.'">'.$field->datakpro_id.'</div>';
			if($_SESSION['role']=='ROLE00004'||$_SESSION['role']=='ROLE00009'){
				if($field->vallayananid=='LAY000'||$field->valcustomerid=='CUS000'||$field->channelid==NULL||$field->dataa2_validasideposit=='BELUM'
					||$field->dataa2_manja==NULL||$field->dataa2_oknok==NULL||$field->teknisiid1==NULL
					||$field->teknisiid2==NULL||$field->datateknis_sektor==NULL||$field->datateknis_tindaklanjut==NULL){
						$row[] = '<p style="background-color:yellow;color:red;" align="center">Validasi Belum Lengkap</p>';
				}else{
					$row[]='<input type="text" id="orderid'.$field->datakpro_id.'" pattern="[0-9]{9}" placeholder="Cth. 50000001 (Tanpa awalan SC)" value="'.$field->datakpro_orderid.'" />';
				}
			}else{
				$row[] = $field->datakpro_orderid;
			}

            $row[] = $field->datakpro_myir;
			$row[] = $field->datakpro_namacust;
			$row[] = $field->datakpro_alamat.' STO '.$field->sto_name;
			if($_SESSION['role']=='ROLE00002'||$_SESSION['role']=='ROLE00004'||$_SESSION['role']=='ROLE00009'){
				$rows2='';
				$rows1='<select id="sto'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
				<option value="'.$field->sto_id.'">'.$field->sto_code.'</option>';
				foreach($sto as $row7){
					if($row7->sto_id=='STO00000'){
						continue;
					}else{
						$rows2.='<option value="'.$row7->sto_id.'">'.$row7->sto_code.'</option>';
					}
				}
				$rows3='</select>';
				$row[]=$rows1.$rows2.$rows3;
				// $row[]='tes';
			}else{
				$row[] = $field->sto_name;
			}
			
			$row[] = $field->datakpro_nohp;
			$row[] = $field->datakpro_packagename;
			$row[] = $field->datakpro_alpro;
			$row[] = $field->datakpro_salesid.'-'.$field->datakpro_salesname.'('.$field->datakpro_saleshp.')-'.$field->datakpro_salestelegram;
			$row[] = $field->lokername;
			$row[] = $field->datakpro_statusresume;
			$row[] = $field->datakpro_statusmessage;
			$row[] = $field->datakpro_tanggalinput;

			if($_SESSION['role']=='ROLE00002'){

				
				if($field->teknisiid1==NULL){
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='teknisi1".$field->datakpro_id."' value=''><input type='text' class='form-control' id='teknisiname1".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTeknisi'><i class='fas fa-edit'></i></button></span></div></div>";
				}else{
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='teknisi1".$field->datakpro_id."' value='".$field->teknisiid1."'><input type='text' class='form-control' id='teknisiname1".$field->datakpro_id."' value='".$field->teknisiname1."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTeknisi'><i class='fas fa-edit'></i></button></span></div></div>";
				}

				

				if($field->teknisiid2==NULL){
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='teknisi2".$field->datakpro_id."' value=''><input type='text' class='form-control' id='teknisiname2".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTeknisi'><i class='fas fa-edit'></i></button></span></div></div>";
				}else{
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='teknisi2".$field->datakpro_id."' value='".$field->teknisiid2."'><input type='text' class='form-control' id='teknisiname2".$field->datakpro_id."' value='".$field->teknisiname2."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTeknisi'><i class='fas fa-edit'></i></button></span></div></div>";
				}

				$row[]='<select id="sektor'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
							<option value="'.$field->datateknis_sektor.'">'.$field->datateknis_sektor.'</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>';
				
				// $rows2='';
				// $rows1='<select id="statuswo'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
				// <option value="'.$field->statusorderid.'">'.$field->statusorder.'</option>';
				// foreach ($statusorder as $row6){
				// 	$rows2.='<option value="'.$row6->statusorder_id.'">'.$row6->statusorder_name.'</option>';
				// }
				// $rows3='</select>';
				// $row[]=$rows1.$rows2.$rows3;

				if($field->statusorderid==NULL){
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='statuswo".$field->datakpro_id."' value=''><input type='text' class='form-control' id='statuswoname".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalStatuswo'><i class='fas fa-edit'></i></button></span></div></div>";
				}else{
					$row[]="<div class='input-group' ><input type='hidden' class='form-control' id='statuswo".$field->datakpro_id."' value='".$field->statusorderid."'><input type='text' class='form-control' id='statuswoname".$field->datakpro_id."' value='".$field->statusorder."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalStatuswo'><i class='fas fa-edit'></i></button></span></div></div>";
				}

				$row[]='<textarea id="keterangan'.$field->datakpro_id.'">'.$field->datateknis_keterangan.'</textarea>';

			}else if ($_SESSION['role']=='ROLE00005' || $_SESSION['role']=='ROLE00004'
			||$_SESSION['role']=='ROLE00009'||$_SESSION['role']=='ROLE00006'
			||$_SESSION['role']=='ROLE00003'||$_SESSION['role']=='ROLE00001'){
				
				if($field->teknisiname1==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Assign</p>';
				}else{
					$row[]=$field->teknisiname1;
				}

				if($field->teknisiname1==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Assign</p>';
				}else{
					$row[]=$field->teknisiname2;
				}

				if($field->datateknis_sektor==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Mapping</p>';
				}else{
					$row[]=$field->datateknis_sektor;
				}

				if($field->statusorder==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Update</p>';
				}else{
					$row[]=$field->statusorder;
				}
				
				if($field->datateknis_keterangan==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Update</p>';
				}else{
					$row[]=$field->datateknis_keterangan;
				}
			}

			if($_SESSION['role']=='ROLE00002' || $_SESSION['role']=='ROLE00004'
			||$_SESSION['role']=='ROLE00009'||$_SESSION['role']=='ROLE00006'
			||$_SESSION['role']=='ROLE00003'||$_SESSION['role']=='ROLE00001' ){
				if($field->vallayanan==NULL || $field->vallayanan=='BELUM DIVALIDASI'){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Validasi</p>';
				}else{
					$row[]=$field->vallayanan;
				}
				
				if($field->valcustomer==NULL || $field->valcustomer=='BELUM DIVALIDASI'){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Validasi</p>';
				}else{
					$row[]=$field->valcustomer;
				}

				if($field->channel==NULL){
					// $row[] = "<div class='input-group' ><input type='text' class='form-control' id='channel".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalChannel'><i class='fas fa-edit'></i></button></span></div></div>";
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Assign</p>';
				}else{
					// $row[]="<div class='input-group' ><input type='text' class='form-control' id='channel".$field->datakpro_id."' value='".$field->channel."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalChannel'><i class='fas fa-edit'></i></button></button></span></div></div>";
					$row[]=$field->channel;
				}

				if($field->dataa2_validasideposit==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Validasi</p>';
				}else{
					$row[]=$field->dataa2_validasideposit;
				}
				
				if($field->dataa2_manja==NULL){
					$row[]="<div class='input-group' ><input type='text' class='form-control' id='tanggal".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTanggal'><i class='fas fa-edit'></i></button></span></div></div>";
				}else{
					$row[]="<div class='input-group' ><input type='text' class='form-control' id='tanggal".$field->datakpro_id."' value='".$field->dataa2_manja."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTanggal'><i class='fas fa-edit'></i></button></span></div></div>";
				}
				
				if($field->dataa2_oknok==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Validasi</p>';
				}else{
					$row[]=$field->dataa2_oknok;
				}
				
				if($field->dataa2_keterangan==NULL){
					$row[] = '<p style="background-color:yellow;color:red;" align="center">Belum Update</p>';
				}else{
					$row[]=$field->dataa2_keterangan;
				}
			}else if($_SESSION['role']=='ROLE00005'||$_SESSION['role']=='ROLE00009'){
				$rows2='';
				$rows1='<select id="layanan'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
							<option value="'.$field->vallayananid.'">'.$field->vallayanan.'</option>';
				foreach($vallayanan as $row3){							
					$rows2.="<option value='".$row3->validasilayanan_id."'>".$row3->validasilayanan_name."</option>";
				} 	
				$rows3='</select>';
				$row[]=$rows1.$rows2.$rows3;

				$rows2='';
				$rows1='<select id="customer'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
						<option value="'.$field->valcustomerid.'">'.$field->valcustomer.'</option>';
				foreach($valcustomer as $row4){							
					$rows2.='<option value="'.$row4->validasicustomer_id.'">'.$row4->validasicustomer_name.'</option>';
				} 
				$rows3='</select>';
				$row[]=$rows1.$rows2.$rows3;

				$rows2='';
				$rows1='<select id="channel'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
						<option value="'.$field->channelid.'">'.$field->channel.'</option>';
				foreach($channel as $row5){							
					$rows2.='<option value="'.$row5->channel_id.'">'.$row5->channel_name.'</option>';
				} 
				$rows3='</select>';
				$row[]=$rows1.$rows2.$rows3;

				$rows2='';
				$rows1='<select id="deposit'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">';
				if ($field->dataa2_validasideposit=='SUDAH')
				{
					$rows2='<option value="SUDAH">Sudah Deposit</option>
					<option value="BELUM">Belum Deposit</option>';
				
				}else{
				
					$rows2='<option value="BELUM">Belum Deposit</option>
					<option value="SUDAH">Sudah Deposit</option>';
				
				}
				$rows3='</select>';
				$row[]=$rows1.$rows2.$rows3;
				
				if($field->dataa2_manja==NULL){
					$row[]="<div class='input-group' ><input type='text' class='form-control' id='tanggal".$field->datakpro_id."' value=''><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTanggal'><i class='fas fa-edit'></i></button></span></div></div>";
				}else{
					$row[]="<div class='input-group' ><input type='text' class='form-control' id='tanggal".$field->datakpro_id."' value='".$field->dataa2_manja."'><div class='input-group-append' ><span class='input-group-text'><button type='button' class='btn btn-info btn-sm margin-5' data-formid='".$field->datakpro_id."' data-toggle='modal' data-target='#ModalTanggal'><i class='fas fa-edit'></i></button></span></div></div>";
				}
				
				$row[]='<select id="oknok'.$field->datakpro_id.'" class="select2 form-control custom-select" style="width: 125px; height:36px;">
							<option value="'.$field->dataa2_oknok.'">'.$field->dataa2_oknok.'</option>
							<option value="OK">OK</option>
							<option value="NOK">NOK</option>
						</select>';
				
				$row[]='<textarea id="keterangana2'.$field->datakpro_id.'" rows="2" cols="35">'.$field->dataa2_keterangan.'</textarea>';
				
			}

			
			
			if($_SESSION['role']=='ROLE00002'){
				$row[]='<button type="button" id="'.$field->datakpro_id.'" onClick="updateTL(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>';
			}else if($_SESSION['role']=='ROLE00005'){
				$row[]='<button type="button" id="'.$field->datakpro_id.'" onClick="updateA2(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>
				<button type="button" id="'.$field->datakpro_id.'" onClick="dropData(this.id)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Drop"><span class="mdi mdi-delete-forever"></span></button>';
			}else if($_SESSION['role']=='ROLE00004'){
				$row[]='<button type="button" id="'.$field->datakpro_id.'" onClick="updateInputter(this.id)" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Save"><span class="mdi mdi-checkbox-marked-outline"></span></button>
						<button type="button" id="'.$field->datakpro_id.'" onClick="dropData(this.id)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Drop"><span class="mdi mdi-delete-forever"></span></button>';
			
			}else if($_SESSION['role']=='ROLE00009'){
				$row[]='			
					<button type="button" id="'.$field->datakpro_id.'" onClick="updateA2(this.id)" class="btn btn-success">Save Verifikasi</button>
					<button type="button" id="'.$field->datakpro_id.'" onClick="updateInputter(this.id)" class="btn btn-success">Save SC</button>
					<button type="button" id="'.$field->datakpro_id.'" onClick="dropData(this.id)" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Edit"><span class="mdi mdi-delete-forever"></span></button>';
			}else if($_SESSION['role']=='ROLE00003'){
				$row[]='';
			}
            $data[] = $row;
		}
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kawal_model->count_all(),
            "recordsFiltered" => $this->kawal_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

	public function tescount(){
		$this->load->model('kawal_model');
		$user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
        $loker=$this->session->userdata('loker');
		echo $this->kawal_model->count_filtered();
		// echo "tes";
    }

	public function reportchart(){
		$this->load->model('kawal_model');
		$this->load->model('Db_model');

		$data['orderprogress']=$this->kawal_model->orderprogress();
		$data['kendalateknik']=$this->kawal_model->kendalateknik();
		$data['kendalapelanggan']=$this->kawal_model->kendalapelanggan();
		$data['belumtl']=$this->kawal_model->belumtl();
		$data['inputvalid']=$this->kawal_model->inputvalid();
		$data['kendalalayanan']=$this->kawal_model->kendalalayanan();
		$data['kendalapela2']=$this->kawal_model->kendalapela2();
		$data['kendaladeposit']=$this->kawal_model->kendaladeposit();
		$data['belumvalid']=$this->kawal_model->belumvalid();
		$data['inputsc']=$this->kawal_model->inputsc();
		$data['kendalatl']=$this->kawal_model->kendalatl();
		$data['kendalaa2']=$this->kawal_model->kendalaa2();
		$data['beluminputter']=$this->kawal_model->beluminputter();
		

		$data_1['vb_teknisi'] = $this->Db_model->select_SO();
		$ubs = array();
		$id_ubs = array();
		$wo_total = array();
		$wo_blm = array();
		$wo_kendala = array();		
		foreach($data_1['vb_teknisi'] as $vis)
		{
			//var_dump($vis->ubis);
			array_push($id_ubs,$vis->id_sto);
			array_push($ubs,$vis->ubis);
			array_push($wo_total,count($this->Db_model->rekapwo_vb($vis->id_sto)));
			array_push($wo_blm,count($this->Db_model->rekapwo_vb_notupdate($vis->id_sto)));
			array_push($wo_kendala,count($this->Db_model->rekapwo_vb_kendala($vis->id_sto)));
			
		}
		$data['id_sto'] = $id_ubs;
		$data['ubs'] = $ubs;
		$data['wo_total'] = $wo_total;
		$data['wo_blm'] = $wo_blm;			
		$data['wo_kendala'] = $wo_kendala;	

		$this->load->view('reportchart',$data);
		// var_dump($data);
	}
}
