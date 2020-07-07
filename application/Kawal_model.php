<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kawal_model extends CI_Model{
    public function select_user($array){
        $query=$this->db->query("SELECT * FROM kawal_users WHERE users_username='".$array['username']."' AND 
        users_password=md5('".$array['passwd']."') ");
        return $query->result();
    }
    public function selectTeknisiPSB($array){
        $query=$this->db->query("SELECT * FROM kawal_teknisi WHERE teknisi_sto='".$array."'");
        return $query->result();
    }

    public function selectDataKawalAll(){
        $query=$this->db->query("SELECT * FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id");
        return $query->result();
    }
	
	function tampil_dataSTO(){
		return $this->db->get('kawal_sto');
	}

	function input_dataPO($data_po,$table){
		$this->db->insert($table,$data_po);
	}
}