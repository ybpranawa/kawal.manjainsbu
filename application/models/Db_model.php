<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model{
    
    public function selectWOAll($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE datakpro_agency='".$loker."' AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
            ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }

                $query=$this->db->query("SELECT
                        k.*,
                        t.*,
                        a2.*,
                        sto.*,
                        tek.teknisi_id AS teknisiid1,
                        tek.teknisi_name AS teknisiname1,
                        tek2.teknisi_id AS teknisiid2,
                        tek2.teknisi_name AS teknisiname2,
                        s.statusorder_name AS statusorder,
                        s.statusorder_id AS statusorderid,
                        l.validasilayanan_id AS vallayananid,
                        l.validasilayanan_name AS vallayanan,
                        c.validasicustomer_id AS valcustomerid,
                        c.validasicustomer_name AS valcustomer,
                        ch.channel_id AS channelid,
                        ch.channel_name AS channel,
                        lok.loker_name AS lokername 
                    FROM
                        kawal_datakpro k
                        LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                        LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                        LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                        LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                        LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                        LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                    WHERE ".$que." datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%'
                    
                    ");
            }
            else if($sto == "STO00017")
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE (datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' )
                AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                ");

            }
            else
            {
                $query=$this->db->query("SELECT
                    k.*,
                    t.*,
                    a2.*,
                    sto.*,
                    tek.teknisi_id AS teknisiid1,
                    tek.teknisi_name AS teknisiname1,
                    tek2.teknisi_id AS teknisiid2,
                    tek2.teknisi_name AS teknisiname2,
                    s.statusorder_name AS statusorder,
                    s.statusorder_id AS statusorderid,
                    l.validasilayanan_id AS vallayananid,
                    l.validasilayanan_name AS vallayanan,
                    c.validasicustomer_id AS valcustomerid,
                    c.validasicustomer_name AS valcustomer,
                    ch.channel_id AS channelid,
                    ch.channel_name AS channel,
                    lok.loker_name AS lokername 
                FROM
                    kawal_datakpro k
                    LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                    LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                    LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                    LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                    LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                    LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                    LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                    LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                    LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                    LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                    LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                ");
                
            }

        }
        
        return $query->result();
    }

    public function selectOK_SC($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NOT NULL
                ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }

                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency  
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NOT NULL
                ");
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NOT NULL
                ");
            }

        }
        
        return $query->result();
        //return $query->num_rows();
    }
    public function selectOK_BLMSC($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NULL
                ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NULL
                ");
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                    OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                    OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                    OR t.datateknis_tindaklanjut = 'STS00007'
                    OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                AND a2.dataa2_oknok = 'OK'
                AND k.datakpro_orderid IS NULL
                ");
            }
        }
        
        //return $query->num_rows();
        return $query->result();
    }

    public function selectNOK_DEPO($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
            AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                OR t.datateknis_tindaklanjut = 'STS00021')
            AND a2.dataa2_oknok = 'NOK'
            AND a2.dataa2_validasideposit = 'SUDAH'
            ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                    OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                    OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                    OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                    OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                    OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                    OR t.datateknis_tindaklanjut = 'STS00021')
                AND a2.dataa2_oknok = 'NOK'
                AND a2.dataa2_validasideposit = 'SUDAH'
                ");
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                    OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                    OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                    OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                    OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                    OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                    OR t.datateknis_tindaklanjut = 'STS00021')
                AND a2.dataa2_oknok = 'NOK'
                AND a2.dataa2_validasideposit = 'SUDAH'
                ");
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectNOK_BLMDEPO($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                    OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                    OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                    OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                    OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                    OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                    OR t.datateknis_tindaklanjut = 'STS00021')
                AND a2.dataa2_oknok = 'NOK'
                AND a2.dataa2_validasideposit = 'BELUM'
    
                ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                    OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                    OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                    OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                    OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                    OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                    OR t.datateknis_tindaklanjut = 'STS00021')
                AND a2.dataa2_oknok = 'NOK'
                AND a2.dataa2_validasideposit = 'BELUM'
                ");
                
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                    OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                    OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                    OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                    OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                    OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                    OR t.datateknis_tindaklanjut = 'STS00021')
                AND a2.dataa2_oknok = 'NOK'
                AND a2.dataa2_validasideposit = 'BELUM'
    
                ");
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectA2_OK($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'OK'
                ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'OK'
                ");
                
            }
            
            else if($sto == "STO00017")
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE (datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' )
                AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'OK'
                 ");
    
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND  (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'OK'
                ");
    
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectA2_NOK($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'NOK'
                 ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'NOK'
                 ");
                
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok = 'NOK'
                 ");
    
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectA2_null($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND ( datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok is NULL
                 ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok is NULL
                 ");
                
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND ( datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND a2.dataa2_oknok is NULL
                 ");
    
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectSO_OK($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                     OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                     OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                     OR t.datateknis_tindaklanjut = 'STS00007'
                     OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                 ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                     OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                     OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                     OR t.datateknis_tindaklanjut = 'STS00007'
                     OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                 ");
                
            }
            else if($sto == "STO00017")
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE (datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                     OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                     OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                     OR t.datateknis_tindaklanjut = 'STS00007'
                     OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                 ");
    
            
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut = 'STS00001' OR t.datateknis_tindaklanjut = 'STS00002'
                     OR t.datateknis_tindaklanjut = 'STS00003' OR t.datateknis_tindaklanjut = 'STS00004'
                     OR t.datateknis_tindaklanjut = 'STS00005' OR t.datateknis_tindaklanjut = 'STS00006'
                     OR t.datateknis_tindaklanjut = 'STS00007'
                     OR t.datateknis_tindaklanjut = 'STS00022' OR t.datateknis_tindaklanjut = 'STS00023')
                 ");
    
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }

    public function selectSO_NOK($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                     OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                     OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                     OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                     OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                     OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                     OR t.datateknis_tindaklanjut = 'STS00021' OR t.datateknis_tindaklanjut = 'STS00026' OR t.datateknis_tindaklanjut = 'STS00025')
        
                 ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                     OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                     OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                     OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                     OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                     OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                     OR t.datateknis_tindaklanjut = 'STS00021' OR t.datateknis_tindaklanjut = 'STS00026' OR t.datateknis_tindaklanjut = 'STS00025')
        
                 ");
                
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                     OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                     OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                     OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                     OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                     OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                     OR t.datateknis_tindaklanjut = 'STS00021')
        
                 ");
    
            }
        }
        
        return $query->result();
        //return $query->num_rows();
    }
    
    public function selectSO_not_updated($sto){
        $today = date('Y-m-d');
        $role=$this->session->userdata('role');
        $loker=$this->session->userdata('loker');
        if ($role=="ROLE00003"){
            $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_agency='".$loker."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut IS NULL OR t.datateknis_tindaklanjut='' )
                 ");
        }else{
            if($sto == "STO00000")
            {
                $que = "";
                $id = $_SESSION['datel'];
                if($id == 'DATEL00003')
                {
                    $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
                }
    
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut IS NULL OR t.datateknis_tindaklanjut='' )
                 ");
                
            }
            else
            {
                $query=$this->db->query("SELECT
                k.*,
                t.*,
                a2.*,
                sto.*,
                tek.teknisi_id AS teknisiid1,
                tek.teknisi_name AS teknisiname1,
                tek2.teknisi_id AS teknisiid2,
                tek2.teknisi_name AS teknisiname2,
                s.statusorder_name AS statusorder,
                s.statusorder_id AS statusorderid,
                l.validasilayanan_id AS vallayananid,
                l.validasilayanan_name AS vallayanan,
                c.validasicustomer_id AS valcustomerid,
                c.validasicustomer_name AS valcustomer,
                ch.channel_id AS channelid,
                ch.channel_name AS channel,
                lok.loker_name AS lokername 
            FROM
                kawal_datakpro k
                LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
                LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
                LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
                LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
                LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
                LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
                LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
                WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
                AND (t.datateknis_tindaklanjut IS NULL OR t.datateknis_tindaklanjut='' )
                 ");
    
            }
        }
        
        return $query->result();
       // return $query->num_rows();
    }

    public function selectWOTeknisiNull($sto){
        $today = date('Y-m-d');
        if($sto == "STO00000")
        {
            $que = "";
            $id = $_SESSION['datel'];
            if($id == 'DATEL00003')
            {
                $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
            }

            $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE ".$que." (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
            AND (t.datateknis_personid1 IS NULL AND t.datateknis_personid2 IS NULL)
             ");
            
        }
        else
        {
            $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE datakpro_sto='".$sto."' AND (datakpro_tanggalinput LIKE '".$today."%' OR datakpro_orderdate LIKE '".$today."%')
            AND (t.datateknis_personid1 IS NULL AND t.datateknis_personid2 IS NULL)
             ");

        }
        return $query->result();
       // return $query->num_rows();
    }

    public function selectTekNotUpdate($sto){
        if($sto == "STO00000")
        {
            $que = "";
            $id = $_SESSION['datel'];
            if($id == 'DATEL00003')
            {
                $que = "(datakpro_sto ='STO00001' OR datakpro_sto ='STO00003' OR datakpro_sto ='STO00017' OR datakpro_sto ='STO00019' ) AND";
            }

            $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE ".$que." (t.datateknis_tindaklanjut IS NULL
            OR (t.datateknis_tindaklanjut != 'STS00001' AND t.datateknis_tindaklanjut!='STS00012')
            OR (k.datakpro_statusmessage!='Completed' AND k.datakpro_statusmessage!=NULL))
            AND i.datainputter_drop!=1
            AND t.datateknis_personid1 IS NOT NULL AND t.datateknis_tindaklanjut not like 'STS%'
             ");
            
        }
        else
        {
            $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
            WHERE datakpro_sto='".$sto."' 
            AND (t.datateknis_tindaklanjut IS NULL
            OR (t.datateknis_tindaklanjut != 'STS00001' AND t.datateknis_tindaklanjut!='STS00012')
            OR (k.datakpro_statusmessage!='Completed' AND k.datakpro_statusmessage!=NULL))
            AND i.datainputter_drop!=1
            AND t.datateknis_personid1 IS NOT NULL AND t.datateknis_tindaklanjut not like 'STS%'
             ");

        }
        return $query->result();
        //return $query->num_rows();
    }

    public function selectRekapTeknisi($sto){
        if($sto == "STO00000")
        {
            //cast(k.datakpro_tanggalinput as Date) as tanggal_input
            $query=$this->db->query("SELECT
                    t.datateknis_personid1 AS tek1_id,
                    tek.teknisi_name AS tek1_name,
                    t.datateknis_personid2 AS tek2_id,
                    tek2.teknisi_name AS tek2_name,
                    sto.sto_id, sto.sto_name as ubis,
                    COUNT( k.datakpro_id ) AS jumlah_wo 
                FROM
                    kawal_datakpro k
                    LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                    LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                    LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                    LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                    LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id 
                WHERE
                    t.datateknis_tindaklanjut IS NULL 
                    OR (
                        (
                            t.datateknis_tindaklanjut <> 'STS00001' 
                            AND t.datateknis_tindaklanjut <> 'STS00012' 
                            AND t.datateknis_tindaklanjut <> 'STS00011' 
                            AND t.datateknis_tindaklanjut <> 'STS00015' 
                            AND t.datateknis_tindaklanjut <> 'STS00016' 
                        ) 
                        AND ( k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL ) 
                    ) 
                    AND i.datainputter_drop != '1' 
                GROUP BY
                    t.datateknis_personid1,
                    t.datateknis_personid2, sto.sto_id
                ORDER BY
                    ubis ASC
            ");

        }
        else
        {
            $query=$this->db->query("SELECT
                    t.datateknis_personid1 as tek1_id, tek.teknisi_name as tek1_name,
                    t.datateknis_personid2 as tek2_id, tek2.teknisi_name as tek2_name,                    
                    sto.sto_id, sto.sto_name as ubis,
                    COUNT( k.datakpro_id ) as jumlah_wo
                    
                    FROM kawal_datakpro k
                    LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
                    LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
                    LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
                    LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
                    LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id         
                    WHERE datakpro_sto='".$sto."'
                    AND t.datateknis_tindaklanjut IS NULL
                    OR 
                    ((t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
                    AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
                    AND t.datateknis_tindaklanjut <>'STS00016' )
                    AND 
                    (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL))
                    
                    AND i.datainputter_drop != '1'
                   
                    GROUP BY t.datateknis_personid1, t.datateknis_personid2, sto.sto_id
                    ORDER BY tek1_name ASC
            ");

        }
        return $query->result();
    }

    public function selectTekNotUpdate_vb($tek1,$tek2){
        
        $query=$this->db->query("SELECT k.*,t.*
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        WHERE datakpro_sto = '".$sto."' 
        AND (t.datateknis_tindaklanjut IS NULL
        OR (t.datateknis_tindaklanjut != 'STS00001' AND t.datateknis_tindaklanjut!='STS00012')
        OR (k.datakpro_statusmessage!='Completed' AND k.datakpro_statusmessage!=NULL))
        AND i.datainputter_drop!=1
        AND t.datateknis_personid1 IS NOT NULL AND t.datateknis_tindaklanjut not like 'STS%'
        AND t.datateknis_personid1 = '".$tek1."'
        AND t.datateknis_personid2 = '".$tek2."'
         ");
        return $query->num_rows();
    }

    public function select_SO(){
        
        $query=$this->db->query("SELECT sto_id as id_sto, sto_code as ubis from kawal_sto where sto_datelid = 'DATEL00003' or sto_datelid = 'DATEL00001'
         ");
        return $query->result();
    }

    public function rekapwo_vb($sto){
        
        $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
        WHERE
            datakpro_sto = '".$sto."'
            AND (
                k.datakpro_orderid IS NULL 
                AND (
                    
                    t.datateknis_tindaklanjut <> 'STS00012' 
                    AND t.datateknis_tindaklanjut <> 'STS00011' 
                    AND t.datateknis_tindaklanjut <> 'STS00015' 
                    AND t.datateknis_tindaklanjut <> 'STS00016'
                    AND t.datateknis_tindaklanjut <> 'STS00001' 
                    AND t.datateknis_tindaklanjut <> 'STS00019'
                    OR t.datateknis_tindaklanjut IS NULL
                ) 
            ) 
            AND i.datainputter_drop != '1'
         ");

        return $query->result();
    }
    
    public function rekapwo_vb_notupdate($sto){
        
        $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
        WHERE
            datakpro_sto = '".$sto."'
            AND (
                k.datakpro_orderid IS NULL 
                AND (
                    
                    t.datateknis_tindaklanjut <> 'STS00012' 
                    AND t.datateknis_tindaklanjut <> 'STS00011' 
                    AND t.datateknis_tindaklanjut <> 'STS00015' 
                    AND t.datateknis_tindaklanjut <> 'STS00016'
                    AND t.datateknis_tindaklanjut <> 'STS00001' 
                    AND t.datateknis_tindaklanjut <> 'STS00019'
                    OR t.datateknis_tindaklanjut IS NULL
                ) 
            ) 
            AND i.datainputter_drop != '1'
            AND t.datateknis_tindaklanjut is NULL
         ");
        return $query->result();
    }

    public function rekapwo_vb_kendala($sto){
        
        $query=$this->db->query("SELECT
            k.*,
            t.*,
            a2.*,
            sto.*,
            tek.teknisi_id AS teknisiid1,
            tek.teknisi_name AS teknisiname1,
            tek2.teknisi_id AS teknisiid2,
            tek2.teknisi_name AS teknisiname2,
            s.statusorder_name AS statusorder,
            s.statusorder_id AS statusorderid,
            l.validasilayanan_id AS vallayananid,
            l.validasilayanan_name AS vallayanan,
            c.validasicustomer_id AS valcustomerid,
            c.validasicustomer_name AS valcustomer,
            ch.channel_id AS channelid,
            ch.channel_name AS channel,
            lok.loker_name AS lokername 
        FROM
            kawal_datakpro k
            LEFT JOIN kawal_datateknis t ON k.datakpro_id = t.datateknis_id
            LEFT JOIN kawal_teknisi tek ON tek.teknisi_id = t.datateknis_personid1
            LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id = t.datateknis_personid2
            LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id = k.datakpro_id
            LEFT JOIN kawal_statusorder s ON s.statusorder_id = t.datateknis_tindaklanjut
            LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan = l.validasilayanan_id
            LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer = c.validasicustomer_id
            LEFT JOIN kawal_channel ch ON a2.dataa2_channel = ch.channel_id
            LEFT JOIN kawal_sto sto ON sto.sto_id = k.datakpro_sto
            LEFT JOIN kawal_datainputter i ON i.datainputter_id = k.datakpro_id
            LEFT JOIN kawal_loker lok ON lok.loker_id = k.datakpro_agency 
        WHERE
            datakpro_sto = '".$sto."'
            AND (
                k.datakpro_orderid IS NULL 
                AND (
                    
                    t.datateknis_tindaklanjut <> 'STS00012' 
                    AND t.datateknis_tindaklanjut <> 'STS00011' 
                    AND t.datateknis_tindaklanjut <> 'STS00015' 
                    AND t.datateknis_tindaklanjut <> 'STS00016'
                    AND t.datateknis_tindaklanjut <> 'STS00001' 
                    AND t.datateknis_tindaklanjut <> 'STS00019'
                    OR t.datateknis_tindaklanjut IS NULL
                ) 
            ) 
            AND i.datainputter_drop != '1'
            AND ( t.datateknis_tindaklanjut = 'STS00008' OR t.datateknis_tindaklanjut = 'STS00009' OR t.datateknis_tindaklanjut = 'STS00013'
                     OR t.datateknis_tindaklanjut = 'STS00010' OR t.datateknis_tindaklanjut = 'STS00011'
                     OR t.datateknis_tindaklanjut = 'STS00012' OR t.datateknis_tindaklanjut = 'STS00014'
                     OR t.datateknis_tindaklanjut = 'STS00015' OR t.datateknis_tindaklanjut = 'STS00016'
                     OR t.datateknis_tindaklanjut = 'STS00017' OR t.datateknis_tindaklanjut = 'STS00018'
                     OR t.datateknis_tindaklanjut = 'STS00019' OR t.datateknis_tindaklanjut = 'STS00020'
                     OR t.datateknis_tindaklanjut = 'STS00021' OR t.datateknis_tindaklanjut = 'STS00026' OR t.datateknis_tindaklanjut = 'STS00025')
         ");
        return $query->result();
    }

    
}