<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kawal_model extends CI_Model{
    public function select_user($array){
        $query=$this->db->query("SELECT * FROM kawal_users WHERE users_username='".$array['username']."' AND 
        users_password=md5('".$array['passwd']."') ");
        return $query->result();
    }
    public function selectTeknisiPSB($array){
        if($this->session->userdata('sto')=='STO00000'){
            $array=$this->session->userdata('datel');
            $query=$this->db->query("SELECT * FROM kawal_teknisi t
            RIGHT JOIN kawal_sto s
            ON t.teknisi_sto=s.sto_id
            WHERE s.sto_datelid='".$array."'");
        }else{
            $query=$this->db->query("SELECT * FROM kawal_teknisi WHERE teknisi_sto='".$array."'");
        }
        return $query->result();
    }

    public function searchmyir($myir){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_myir='".$myir."'
        ");
        return $query->result();
    }

    public function selectDataKawalAll(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        -- WHERE (t.datateknis_tindaklanjut != 'STS00001' 
        -- AND k.datakpro_statusmessage!='Completed' 
        -- AND t.datateknis_tindaklanjut!='STS00012') 
        -- OR t.datateknis_tindaklanjut IS NULL 
        WHERE k.datakpro_tanggalinput LIKE '".$today."%'
        -- OR t.datateknis_tindaklanjut IS NULL
        OR k.datakpro_orderdate LIKE '".$today."%'
        OR (
            (t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
        AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
        AND t.datateknis_tindaklanjut <>'STS00016' )
        AND 
        (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL)
        )
        ");
        return $query->result();
    }

    public function reportDataKawalAll($from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE (DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' ) ");
        return $query->result();
    }

    public function downloadDataKawalAll($from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername,
        dat.datel_name,
        wit.witel_name
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        LEFT JOIN kawal_datel dat ON k.datakpro_datel=dat.datel_id
        LEFT JOIN kawal_witel wit ON k.datakpro_witel=wit.witel_id
        WHERE (DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' ) ");
        return $query->result();
    }

    public function selectDataKawalInputter(){
        $query=$this->db->query("SELECT 
        k.*,t.*,a2.*,
        sto.*,
        tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        -- WHERE (t.datateknis_tindaklanjut != 'STS00001' 
        -- AND k.datakpro_statusmessage!='Completed' AND t.datateknis_tindaklanjut!='STS00012') 
        -- AND i.datainputter_drop=0 
        -- OR t.datateknis_tindaklanjut IS NULL 
        -- WHERE t.datateknis_tindaklanjut !='STS00001' 
        -- AND k.datakpro_statusmessage!='Completed' 
        -- OR k.datakpro_orderid=NULL
        WHERE k.datakpro_orderid IS NULL AND i.datainputter_drop!=1
        AND k.datakpro_datel='DATEL00001'
        AND k.datakpro_datel='DATEL00003'
        
        ");
        return $query->result();
    }

    public function selectDataKawalTL($sto){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_sto='".$sto."' 
        AND 
        (
        -- t.datateknis_tindaklanjut IS NULL
            k.datakpro_orderid IS NULL
            OR 
            (
                (t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
                AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
                AND t.datateknis_tindaklanjut <>'STS00016' )
                AND 
                (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL)
            )
        )
        AND i.datainputter_drop<>'1'
         ");
        return $query->result();
    }

    public function reportDataKawalTL($sto,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_sto='".$sto."' 
        AND ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function reportDataKawalTLdatel($datel,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_datel='".$datel."' 
        AND ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function downloadDataKawalTL($sto,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername,
        dat.datel_name,
        wit.witel_name
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        LEFT JOIN kawal_datel dat ON k.datakpro_datel=dat.datel_id
        LEFT JOIN kawal_witel wit ON k.datakpro_witel=wit.witel_id
        WHERE datakpro_sto='".$sto."' 
        AND ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function downloadDataKawalTLdatel($datel,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername,
        dat.datel_name,
        wit.witel_name
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        LEFT JOIN kawal_datel dat ON k.datakpro_datel=dat.datel_id
        LEFT JOIN kawal_witel wit ON k.datakpro_witel=wit.witel_id
        WHERE datakpro_datel='".$datel."' 
        AND ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function downloadInbox_Agency($loker){
        $from=date('Y-m-d', strtotime("-1 days"));
        $to = date("Y-m-d");
        
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_agency='".$loker."'
        AND k.datakpro_tanggalinput >= '".$from."'
        AND k.datakpro_tanggalinput <= '".$to."'");
        return $query->result();
    }

    public function downloadInbox_Inputter(){
        $query=$this->db->query("SELECT 
        k.*,t.*,a2.*,
        sto.*,
        tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_orderid IS NULL AND i.datainputter_drop!=1
        AND k.datakpro_datel='DATEL00001'
        
        ");
        return $query->result();
    }

    public function downloadInbox_KawalTL($sto){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_sto='".$sto."' 
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
        AND i.datainputter_drop <> '1'
         ");
        return $query->result();
    }

    public function downloadInbox_KawalDatel($datel){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_datel='".$datel."' 
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
        AND i.datainputter_drop <> '1'
         ");
        return $query->result();
    }

    public function downloadInbox_KawalA2($user){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_orderid IS NULL AND i.datainputter_drop!=1
        AND k.datakpro_datel='DATEL00001'
        AND (
			
			s.statusorder_id <> 'STS00007' 
			OR s.statusorder_id <> 'STS00008' 
			OR s.statusorder_id <> 'STS00010' 
			OR s.statusorder_id <> 'STS00009'
			OR s.statusorder_id <> 'STS00013' 
			OR s.statusorder_id <> 'STS00023'
			OR s.statusorder_id <> 'STS00024'
			AND s.statusorder_id IS NULL
            )
        ");
        return $query->result();
    }

    public function downloadInbox($loker){
        $from=date('Y-m-d', strtotime("-1 days"));
        $to = date("Y-m-d");
        
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_orderid= NULL
        AND i.datainputter_drop != '1'
        AND k.datakpro_tanggalinput >= '".$from."'
        AND k.datakpro_tanggalinput <= '".$to."'");
        return $query->result();
    }

    public function selectDataKawalAgency($loker){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_agency='".$loker."' ");
        return $query->result();
    }

    public function reportDataKawalAgency($loker,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_agency='".$loker."' AND 
        ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function downloadDataKawalAgency($loker,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername,
        dat.datel_name,
        wit.witel_name
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        LEFT JOIN kawal_datel dat ON k.datakpro_datel=dat.datel_id
        LEFT JOIN kawal_witel wit ON k.datakpro_witel=wit.witel_id
        WHERE k.datakpro_agency='".$loker."' AND 
        ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function selectDataKawalA2($sto){
        $from=date('Y-m-d', strtotime("-1 days"));
		$to = date("Y-m-d");
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        -- WHERE (a2.dataa2_oknok!='OK'
        -- OR a2.dataa2_validasilayanan='LAY000'
        -- OR a2.dataa2_validasicustomer='CUS000'
        -- OR a2.dataa2_validasideposit='BELUM'
        -- OR a2.dataa2_channel IS NULL
        -- OR a2.dataa2_manja IS NULL)
        -- OR k.datakpro_orderid IS NULL
        WHERE 
        k.datakpro_orderid IS NULL 
        -- a2.dataa2_oknok IS NULL
        AND i.datainputter_drop!=1
        -- AND (DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        AND k.datakpro_datel='DATEL00001'
        AND k.datakpro_datel='DATEL00003'
        AND (s.statusorder_id IS NULL OR s.statusorder_id='STS00007' OR s.statusorder_id='STS00008'
        OR s.statusorder_id='STS00010' OR s.statusorder_id='STS00009' OR s.statusorder_id='STS00013'
        OR s.statusorder_id='STS00023')
        
         ");
        return $query->result();
    }


    public function countSelectDataKawalAll(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        
        WHERE k.datakpro_tanggalinput LIKE '".$today."%'
        
        OR k.datakpro_orderdate LIKE '".$today."%'
        OR (
            (t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
        AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
        AND t.datateknis_tindaklanjut <>'STS00016' )
        AND 
        (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL)
        )
        ");
        return $query->num_rows();
    }

    public function countSelectDataKawalA2($sto){
        $from=date('Y-m-d', strtotime("-1 days"));
		$to = date("Y-m-d");
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        -- WHERE (a2.dataa2_oknok!='OK'
        -- OR a2.dataa2_validasilayanan='LAY000'
        -- OR a2.dataa2_validasicustomer='CUS000'
        -- OR a2.dataa2_validasideposit='BELUM'
        -- OR a2.dataa2_channel IS NULL
        -- OR a2.dataa2_manja IS NULL)
        -- OR k.datakpro_orderid IS NULL
        WHERE 
        k.datakpro_orderid IS NULL 
        -- a2.dataa2_oknok IS NULL
        AND i.datainputter_drop!=1
        -- AND (DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        AND (k.datakpro_datel='DATEL00001'
        OR k.datakpro_datel='DATEL00003')
        AND (s.statusorder_id IS NULL OR s.statusorder_id='STS00007' OR s.statusorder_id='STS00008'
        OR s.statusorder_id='STS00010' OR s.statusorder_id='STS00009' OR s.statusorder_id='STS00013'
        OR s.statusorder_id='STS00023' OR s.statusorder_id='STS00024')
        
         ");
        return $query->num_rows();
    }

    public function countSelectDataKawalAgency($loker){
        $from=date('Y-m-d', strtotime("-1 days"));
		$to = date("Y-m-d");
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE k.datakpro_agency='".$loker."' 
        AND (DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        ");
        return $query->num_rows();
    }

    public function countSelectDataKawalInputter(){
        $query=$this->db->query("SELECT 
        k.*,t.*,a2.*,
        sto.*,
        tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        -- WHERE (t.datateknis_tindaklanjut != 'STS00001' 
        -- AND k.datakpro_statusmessage!='Completed' AND t.datateknis_tindaklanjut!='STS00012') 
        -- AND i.datainputter_drop=0 
        -- OR t.datateknis_tindaklanjut IS NULL 
        -- WHERE t.datateknis_tindaklanjut !='STS00001' 
        -- AND k.datakpro_statusmessage!='Completed' 
        -- OR k.datakpro_orderid=NULL
        WHERE k.datakpro_orderid IS NULL AND i.datainputter_drop!=1
        AND (k.datakpro_datel='DATEL00001'
        OR k.datakpro_datel='DATEL00003')
        ");
        return $query->num_rows();
    }

    public function countSelectDataKawalTL($sto){
        $query=$this->db->query("SELECT COUNT(k.datakpro_id)
        --     k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        -- tek.teknisi_name as teknisiname1,
        -- tek2.teknisi_id as teknisiid2,
        -- tek2.teknisi_name as teknisiname2,
        -- s.statusorder_name as statusorder,
        -- s.statusorder_id as statusorderid,
        -- l.validasilayanan_id as vallayananid,
        -- l.validasilayanan_name as vallayanan,
        -- c.validasicustomer_id as valcustomerid,
        -- c.validasicustomer_name as valcustomer,
        -- ch.channel_id as channelid,
        -- ch.channel_name as channel,
        -- lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_sto='".$sto."' 
        AND 
        -- (
        -- -- t.datateknis_tindaklanjut IS NULL
            k.datakpro_orderid IS NULL
            AND
        --     (
                (t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
                AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
                AND t.datateknis_tindaklanjut <>'STS00016' AND t.datateknis_tindaklanjut <>'STS00019' 
                OR t.datateknis_tindaklanjut IS NULL )
                -- AND 
                -- (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL)
        --     )
        -- )
        AND i.datainputter_drop<>'1'
         ");
        return $query->num_rows();
    }

    public function countSelectDataKawalTLdatel($datel){
        $query=$this->db->query("SELECT COUNT(k.datakpro_id)
        --     k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        -- tek.teknisi_name as teknisiname1,
        -- tek2.teknisi_id as teknisiid2,
        -- tek2.teknisi_name as teknisiname2,
        -- s.statusorder_name as statusorder,
        -- s.statusorder_id as statusorderid,
        -- l.validasilayanan_id as vallayananid,
        -- l.validasilayanan_name as vallayanan,
        -- c.validasicustomer_id as valcustomerid,
        -- c.validasicustomer_name as valcustomer,
        -- ch.channel_id as channelid,
        -- ch.channel_name as channel,
        -- lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE datakpro_datel='".$datel."' 
        AND 
        -- (
        -- -- t.datateknis_tindaklanjut IS NULL
            k.datakpro_orderid IS NULL
            AND
        --     (
                (t.datateknis_tindaklanjut <> 'STS00001' AND t.datateknis_tindaklanjut<>'STS00012'
                AND t.datateknis_tindaklanjut <>'STS00011' AND t.datateknis_tindaklanjut <>'STS00015'
                AND t.datateknis_tindaklanjut <>'STS00016' AND t.datateknis_tindaklanjut <>'STS00019' 
                OR t.datateknis_tindaklanjut IS NULL )
                -- AND 
                -- (k.datakpro_statusmessage NOT LIKE '%COMPLETED%' AND k.datakpro_statusmessage IS NOT NULL)
        --     )
        -- )
        AND i.datainputter_drop<>'1'
         ");
        return $query->num_rows();
    }




    public function reportDataKawalA2($user,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,i.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        WHERE a2.dataa2_user='".$user."' AND 
        ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function downloadDataKawalA2($user,$from,$to){
        $query=$this->db->query("SELECT k.*,t.*,a2.*,sto.*,tek.teknisi_labor as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_labor as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername,
        dat.datel_name,
        wit.witel_name
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON k.datakpro_id=t.datateknis_id
        LEFT JOIN kawal_teknisi tek ON tek.teknisi_id=t.datateknis_personid1
        LEFT JOIN kawal_teknisi tek2 ON tek2.teknisi_id=t.datateknis_personid2
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_statusorder s ON s.statusorder_id=t.datateknis_tindaklanjut
        LEFT JOIN kawal_validasilayanan l ON a2.dataa2_validasilayanan=l.validasilayanan_id
        LEFT JOIN kawal_validasicustomer c ON a2.dataa2_validasicustomer=c.validasicustomer_id
        LEFT JOIN kawal_channel ch ON a2.dataa2_channel=ch.channel_id
        LEFT JOIN kawal_sto sto ON sto.sto_id=k.datakpro_sto
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        LEFT JOIN kawal_loker lok ON lok.loker_id=k.datakpro_agency
        LEFT JOIN kawal_datel dat ON k.datakpro_datel=dat.datel_id
        LEFT JOIN kawal_witel wit ON k.datakpro_witel=wit.witel_id
        WHERE a2.dataa2_user='".$user."' AND 
        ((DATE(k.datakpro_tanggalinput) >= '".$from."' AND DATE(k.datakpro_tanggalinput) <= '".$to."')
        OR (DATE(k.datakpro_orderdate)>='".$from."' AND DATE(k.datakpro_orderdate)<= '".$to."' )) ");
        return $query->result();
    }

    public function selectStatusOrder(){
        $query=$this->db->query("SELECT * FROM kawal_statusorder");
        return $query->result();
    }

    public function selectValidasiLayanan(){
        $query=$this->db->query("SELECT * FROM kawal_validasilayanan");
        return $query->result();
    }

    public function selectValidasiCustomer(){
        $query=$this->db->query("SELECT * FROM kawal_validasicustomer");
        return $query->result();
    }

    public function selectChannel(){
        $query=$this->db->query("SELECT * FROM kawal_channel");
        return $query->result();
    }
    
    public function selectValidasiInputter(){
        $query=$this->db->query("SELECT * FROM kawal_validasiinputter");
        return $query->result();
    }

	
	function tampil_dataSTO(){
        // return $this->db->get('kawal_sto');
        $query=$this->db->query("SELECT * FROM kawal_sto");
        return $query->result();
    }

    function tampil_dataSTOtanpagsk(){
        // return $this->db->get('kawal_sto');
        $query=$this->db->query("SELECT * FROM kawal_sto WHERE sto_datelid!='DATEL00002'");
        return $query->result();
    }

    function selectDetailSTO($sto){
        $query=$this->db->query("SELECT * FROM kawal_sto WHERE sto_code='".$sto."' ");
        return $query->result();
    }

    function selectDetailSTOFromId($sto){
        $query=$this->db->query("SELECT * FROM kawal_sto WHERE sto_id='".$sto."' ");
        return $query->result();
    }

    function selectDataKpro($scid,$myir){
        $query=$this->db->query("SELECT 1 FROM kawal_datakpro WHERE datakpro_orderid='".$this->db->escape_str($scid)."' OR datakpro_myir='".$myir."' ");
        return $query->result();
    }

    

    function selectUniqueSC($scid){
        $query=$this->db->query("SELECT 1 FROM kawal_datakpro WHERE datakpro_orderid='".$this->db->escape_str($scid)."' ");
        return $query->result();
    }

    function insertDataKpro($data){
        $this->db->query("INSERT INTO kawal_datakpro
        VALUES (
        '".$data['datakpro_id']."',
        '".$data['datakpro_regional']."',
        '".$data['datakpro_witel']."',
        '".$data['datakpro_datel']."',
        '".$data['datakpro_sto']."',
        '".$this->db->escape_str($data['datakpro_orderid'])."', 
        '".$data['datakpro_typetransaksi']."',
        '".$data['datakpro_jenislayanan']."',
        '".$data['datakpro_alpro']."',
        '".$this->db->escape_str($data['datakpro_ncli'])."',
        '".$this->db->escape_str($data['datakpro_pots'])."',
        '".$this->db->escape_str($data['datakpro_internet'])."',
        '".$this->db->escape_str($data['datakpro_statusresume'])."',
        '".$this->db->escape_str($data['datakpro_statusmessage'])."',
        '".$data['datakpro_orderdate']."',
        '".$data['datakpro_lastupdatestatus']."',
        '".$data['datakpro_durasi']."',
        '".$this->db->escape_str($data['datakpro_namacust'])."',
        '".$this->db->escape_str($data['datakpro_nohp'])."',
        '".$this->db->escape_str($data['datakpro_alamat'])."',
        '".$data['datakpro_kcontact']."',
        '".$this->db->escape_str($data['datakpro_long'])."',
        '".$this->db->escape_str($data['datakpro_lat'])."',
        '".$data['datakpro_packagename']."',
        '".$data['datakpro_provider']."',
        '".$data['datakpro_myir']."', #no update
        '".$data['datakpro_salesid']."', #no update
        '".$data['datakpro_mobi']."', #no update
        '".$data['datakpro_salestelegram']."', #no update
        '".$data['datakpro_saleshp']."', #no update
        '".$data['datakpro_deposit']."', #no update
        '".$data['datakpro_agency']."', #no update
        '".$data['datakpro_salesname']."', #no update
        '".$data['datakpro_tanggalinput']." #no update')
        ");

        $this->db->query("INSERT INTO kawal_datateknis
        VALUES (
        '".$this->db->escape_str($data['datakpro_id'])."', 
        '".$this->db->escape_str($data['datakpro_orderid'])."',
        '".$this->db->escape_str($data['datateknis_wfmid'])."',
        '".$this->db->escape_str($data['datateknis_statuswfm'])."',
        '".$this->db->escape_str($data['datateknis_desktask'])."',
        '".$this->db->escape_str($data['datateknis_statustask'])."',
        '".$this->db->escape_str($data['datateknis_tglinstall'])."',
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL #no update
        )
        ");

        $this->db->query("INSERT INTO kawal_dataa2
        VALUES (
        '".$data['datakpro_id']."',
        'LAY000',
        'CUS000',
        'BELUM',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL)
        ");

        $this->db->query("INSERT INTO kawal_datainputter
        VALUES(
        '".$data['datakpro_id']."',
        0,
        NULL
        )
        ");

        // echo "1";
        
        return 1;
    }

    function updateDataKpro($data){
        $this->db->query("UPDATE kawal_datakpro 
        SET 
        datakpro_regional='".$data['datakpro_regional']."',
        datakpro_witel='".$data['datakpro_witel']."',
        datakpro_datel='".$data['datakpro_datel']."',
        datakpro_sto='".$data['datakpro_sto']."',
        datakpro_orderid='".$this->db->escape_str($data['datakpro_orderid'])."', 
        datakpro_typetransaksi='".$data['datakpro_typetransaksi']."',
        datakpro_jenislayanan='".$data['datakpro_jenislayanan']."',
        datakpro_alpro='".$data['datakpro_alpro']."',
        datakpro_ncli='".$this->db->escape_str($data['datakpro_ncli'])."',
        datakpro_pots='".$this->db->escape_str($data['datakpro_pots'])."',
        datakpro_internet='".$this->db->escape_str($data['datakpro_internet'])."',
        datakpro_statusresume='".$this->db->escape_str($data['datakpro_statusresume'])."',
        datakpro_statusmessage='".$this->db->escape_str($data['datakpro_statusmessage'])."',
        datakpro_orderdate='".$data['datakpro_orderdate']."',
        datakpro_lastupdatestatus='".$data['datakpro_lastupdatestatus']."',
        datakpro_durasi='".$data['datakpro_durasi']."',
        datakpro_namacust='".$this->db->escape_str($data['datakpro_namacust'])."',
        datakpro_nohp='".$this->db->escape_str($data['datakpro_nohp'])."',
        datakpro_alamat='".$this->db->escape_str($data['datakpro_alamat'])."',
        datakpro_kcontact='".$data['datakpro_kcontact']."',
        datakpro_long='".$this->db->escape_str($data['datakpro_long'])."',
        datakpro_lat='".$this->db->escape_str($data['datakpro_lat'])."',
        datakpro_packagename='".$data['datakpro_packagename']."',
        datakpro_provider='".$data['datakpro_provider']."'
        WHERE
        datakpro_orderid='".$this->db->escape_str($data['datakpro_orderid'])."'
        
        ");

        $this->db->query("UPDATE kawal_datateknis
        SET
        datateknis_orderid='".$this->db->escape_str($data['datakpro_orderid'])."', 
        datateknis_wfmid='".$this->db->escape_str($data['datateknis_wfmid'])."',
        datateknis_statuswfm='".$this->db->escape_str($data['datateknis_statuswfm'])."',
        datateknis_desktask='".$this->db->escape_str($data['datateknis_desktask'])."',
        datateknis_statustask='".$this->db->escape_str($data['datateknis_statustask'])."',
        datateknis_tglinstall='".$this->db->escape_str($data['datateknis_tglinstall'])."'
        WHERE datateknis_orderid='".$this->db->escape_str($data['datakpro_orderid'])."'
        ");
        // echo "2";
        return 1;
    }

    function selectDetailSales($salesid){
        $query=$this->db->query("SELECT * FROM kawal_kcontact WHERE kcontact_id='".$salesid."' ");
        return $query->result();
    }
    
    function tampil_dataAgency(){
        $query=$this->db->query("SELECT * FROM kawal_loker");
        return $query->result();
        // return $this->db->get('kawal_loker');
    }

    function selectUniqueDataPO($myir){
        $query=$this->db->query("SELECT datakpro_myir FROM kawal_datakpro WHERE datakpro_myir='".$myir."' ");
        return $query->result();
    }

	function input_dataPO($data_po,$table){
		$this->db->insert($table,$data_po); 
    }
    
    function input_dataTeknis($data_teknis,$table){
        $this->db->insert($table,$data_teknis);
    }

    function input_dataA2($dataa2,$table){
        $this->db->insert($table,$dataa2);
    }

    function input_dataInputter($datainputter,$table){
        $this->db->insert($table,$datainputter);
    }

    function updateTL($formid,$data){
        // $this->db->where('datateknis_id',$formid);
        // $this->db->update('kawal_datateknis',$data);
        $this->db->query("UPDATE kawal_datateknis 
        SET datateknis_personid1='".$data['teknisi1']."', 
        datateknis_personid2='".$data['teknisi2']."',
        datateknis_sektor='".$data['sektor']."',
        datateknis_tindaklanjut='".$data['statuswo']."',
        datateknis_keterangan='".$data['keterangan']."',
        datateknis_user='".$_SESSION['username']."',
        datateknis_tgltindaklanjut='".date('Y-m-d H:i:s')."'
        where datateknis_id='".$formid."' ");

        $this->db->query("UPDATE kawal_datakpro 
        SET datakpro_sto='".$data['sto']."' 
        where datakpro_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_datainputter 
        SET datainputter_drop='0' 
        where datainputter_id='".$formid."' 
        ");
        return 1;
    }

    function updateA2($formid,$data){
        $this->db->query("UPDATE kawal_dataa2
        SET dataa2_validasilayanan='".$data['layanan']."',
        dataa2_validasicustomer='".$data['customer']."',
        dataa2_validasideposit='".$data['deposit']."',
        dataa2_channel='".$data['channel']."',
        dataa2_user='".$_SESSION['username']."',
        dataa2_manja='".$data['manja']."',
        dataa2_oknok='".$data['oknok']."',
        dataa2_keterangan='".$data['keterangan']."'
        WHERE dataa2_id='".$formid."' ");

        // $this->db->query("UPDATE kawal_datakpro 
        // SET datakpro_sto='".$data['sto']."' 
        // where datakpro_id='".$formid."'
        // ");
        return 1;
    }

    function updateInputter($formid,$data){
        if($data['orderid']=='0'){
            $this->db->query("UPDATE kawal_datakpro
            SET datakpro_orderid=NULL
            WHERE datakpro_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datateknis
            SET datateknis_orderid=NULL
            WHERE datateknis_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datainputter
            SET datainputter_drop=0,
            datainputter_user='".$_SESSION['username']."'
            WHERE datainputter_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datakpro 
            SET datakpro_sto='".$data['sto']."' 
            where datakpro_id='".$formid."'
            ");
            
        }else{
            
            $this->db->query("UPDATE kawal_datakpro
            SET datakpro_orderid='".$data['orderid']."'
            WHERE datakpro_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datateknis
            SET datateknis_orderid='".$data['orderid']."'
            WHERE datateknis_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datainputter
            SET datainputter_drop=0,
            datainputter_user='".$_SESSION['username']."'
            WHERE datainputter_id='".$formid."'
            ");
            $this->db->query("UPDATE kawal_datakpro 
            SET datakpro_sto='".$data['sto']."' 
            where datakpro_id='".$formid."'
            ");
        }
        return 1;
    }

    function dropData($formid){
        $this->db->query("UPDATE kawal_datainputter
        SET datainputter_drop=1,
        datainputter_user='".$_SESSION['username']."'
        WHERE datainputter_id='".$formid."'
        ");
        return 1;
    }

    function selectPrimaryKey(){
        $query=$this->db->query("SELECT MAX(datakpro_id) as id FROM kawal_datakpro");
        return $query->result();
    }

    function selectPrimaryKey2(){
        $query=$this->db->query("SELECT MAX(datakpro_id) as id FROM kawal_dummydatakpro");
        return $query->result();
    }

    function selectPassLama($user){
        $query=$this->db->query("SELECT users_password FROM kawal_users WHERE users_username='".$user."'");
        return $query->result();
    }

    function updatePassword($user,$passbaru){
        $query=$this->db->query("UPDATE kawal_users SET users_password='".$passbaru."' WHERE users_username='".$user."' ");
    }
    
    function editTL($formid){
        $this->db->query("UPDATE kawal_datateknis
        SET datateknis_personid1=NULL,
        datateknis_personid2=NULL,
        datateknis_tindaklanjut=NULL,
        datateknis_keterangan=NULL,
        datateknis_tindaklanjut=date('Y-m-d H:i:s'),
        datateknis_user='".$_SESSION['username']."'
        WHERE datateknis_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_datainputter 
        SET datainputter_drop='0' 
        where datainputter_id='".$formid."' 
        ");
        return 1;
    }

    function editInputter($formid){
        $this->db->query("UPDATE kawal_datakpro
        SET datakpro_orderid=NULL
        WHERE datakpro_id='".$formid."'
        ");
        
        $this->db->query("UPDATE kawal_datateknis
        SET datateknis_orderid=NULL
        WHERE datateknis_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_datainputter
        SET datainputter_drop='0'
        WHERE datainputter_id='".$formid."'
        ");

        return 1;
    }

    function editA2($formid){
        $this->db->query("UPDATE kawal_dataa2
        SET dataa2_oknok=NULL,
        dataa2_keterangan=NULL
        WHERE dataa2_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_datainputter
        SET datainputter_drop='0'
        WHERE datainputter_id='".$formid."'
        ");
        return 1;
    }

    function editCAM($formid){
        $this->db->query("UPDATE kawal_datakpro
        SET datakpro_orderid=NULL
        WHERE datakpro_id='".$formid."'
        ");
        
        $this->db->query("UPDATE kawal_datateknis
        SET datateknis_orderid=NULL
        WHERE datateknis_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_datainputter
        SET datainputter_drop='0'
        WHERE datainputter_id='".$formid."'
        ");

        $this->db->query("UPDATE kawal_dataa2
        SET dataa2_oknok=NULL,
        dataa2_keterangan=NULL
        WHERE dataa2_id='".$formid."'
        ");

        return 1;
    }

    function editAdmin($formid){
        return 1;
    }

    function inputPost($data){
        $this->db->query("INSERT INTO kawal_tes(tes_data) VALUES('".$data."')");
        return 1;
    }

    function dummyselectDataKpro($scid,$myir){
        $query=$this->db->query("SELECT 1 FROM kawal_dummydatakpro WHERE datakpro_orderid='".$this->db->escape_str($scid)."' OR datakpro_myir='".$myir."' ");
        return $query->result();
    }

    function dummyselectUniqueSC($scid){
        $query=$this->db->query("SELECT 1 FROM kawal_dummydatakpro WHERE datakpro_orderid='".$this->db->escape_str($scid)."' ");
        return $query->result();
    }

    function dummyinsertDataKpro($data){
        $this->db->query("INSERT INTO kawal_dummydatakpro
        VALUES (
        '".$data['datakpro_id']."',
        '".$data['datakpro_regional']."',
        '".$data['datakpro_witel']."',
        '".$data['datakpro_datel']."',
        '".$data['datakpro_sto']."',
        '".$this->db->escape_str($data['datakpro_orderid'])."', 
        '".$data['datakpro_typetransaksi']."',
        '".$data['datakpro_jenislayanan']."',
        '".$data['datakpro_alpro']."',
        '".$this->db->escape_str($data['datakpro_ncli'])."',
        '".$this->db->escape_str($data['datakpro_pots'])."',
        '".$this->db->escape_str($data['datakpro_internet'])."',
        '".$this->db->escape_str($data['datakpro_statusresume'])."',
        '".$this->db->escape_str($data['datakpro_statusmessage'])."',
        '".$data['datakpro_orderdate']."',
        '".$data['datakpro_lastupdatestatus']."',
        '".$data['datakpro_durasi']."',
        '".$this->db->escape_str($data['datakpro_namacust'])."',
        '".$this->db->escape_str($data['datakpro_nohp'])."',
        '".$this->db->escape_str($data['datakpro_alamat'])."',
        '".$data['datakpro_kcontact']."',
        '".$this->db->escape_str($data['datakpro_long'])."',
        '".$this->db->escape_str($data['datakpro_lat'])."',
        '".$data['datakpro_packagename']."',
        '".$data['datakpro_provider']."',
        '".$data['datakpro_myir']."', #no update
        '".$data['datakpro_salesid']."', #no update
        '".$data['datakpro_mobi']."', #no update
        '".$data['datakpro_salestelegram']."', #no update
        '".$data['datakpro_saleshp']."', #no update
        '".$data['datakpro_deposit']."', #no update
        '".$data['datakpro_agency']."', #no update
        '".$data['datakpro_salesname']."', #no update
        '".$data['datakpro_tanggalinput']." #no update')
        ");

        $this->db->query("INSERT INTO kawal_dummydatateknis
        VALUES (
        '".$this->db->escape_str($data['datakpro_id'])."', 
        '".$this->db->escape_str($data['datakpro_orderid'])."',
        '".$this->db->escape_str($data['datateknis_wfmid'])."',
        '".$this->db->escape_str($data['datateknis_statuswfm'])."',
        '".$this->db->escape_str($data['datateknis_desktask'])."',
        '".$this->db->escape_str($data['datateknis_statustask'])."',
        '".$this->db->escape_str($data['datateknis_tglinstall'])."',
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL,#no update
        NULL #no update
        )
        ");

        $this->db->query("INSERT INTO kawal_dummydataa2
        VALUES (
        '".$data['datakpro_id']."',
        'LAY000',
        'CUS000',
        'BELUM',
        NULL,
        NULL,
        NULL,
        NULL,
        NULL)
        ");

        $this->db->query("INSERT INTO kawal_dummydatainputter
        VALUES(
        '".$data['datakpro_id']."',
        0,
        NULL
        )
        ");

        // echo "1";
        
        return 1;
    }

    function dummyupdateDataKpro($data){
        $this->db->query("UPDATE kawal_dummydatakpro 
        SET 
        datakpro_regional='".$data['datakpro_regional']."',
        datakpro_witel='".$data['datakpro_witel']."',
        datakpro_datel='".$data['datakpro_datel']."',
        datakpro_sto='".$data['datakpro_sto']."',
        datakpro_orderid='".$this->db->escape_str($data['datakpro_orderid'])."', 
        datakpro_typetransaksi='".$data['datakpro_typetransaksi']."',
        datakpro_jenislayanan='".$data['datakpro_jenislayanan']."',
        datakpro_alpro='".$data['datakpro_alpro']."',
        datakpro_ncli='".$this->db->escape_str($data['datakpro_ncli'])."',
        datakpro_pots='".$this->db->escape_str($data['datakpro_pots'])."',
        datakpro_internet='".$this->db->escape_str($data['datakpro_internet'])."',
        datakpro_statusresume='".$this->db->escape_str($data['datakpro_statusresume'])."',
        datakpro_statusmessage='".$this->db->escape_str($data['datakpro_statusmessage'])."',
        datakpro_orderdate='".$data['datakpro_orderdate']."',
        datakpro_lastupdatestatus='".$data['datakpro_lastupdatestatus']."',
        datakpro_durasi='".$data['datakpro_durasi']."',
        datakpro_namacust='".$this->db->escape_str($data['datakpro_namacust'])."',
        datakpro_nohp='".$this->db->escape_str($data['datakpro_nohp'])."',
        datakpro_alamat='".$this->db->escape_str($data['datakpro_alamat'])."',
        datakpro_kcontact='".$data['datakpro_kcontact']."',
        datakpro_long='".$this->db->escape_str($data['datakpro_long'])."',
        datakpro_lat='".$this->db->escape_str($data['datakpro_lat'])."',
        datakpro_packagename='".$data['datakpro_packagename']."',
        datakpro_provider='".$data['datakpro_provider']."'
        WHERE
        datakpro_orderid='".$this->db->escape_str($data['datakpro_orderid'])."'
        
        ");

        $this->db->query("UPDATE kawal_dummydatateknis
        SET
        datateknis_orderid='".$this->db->escape_str($data['datakpro_orderid'])."', 
        datateknis_wfmid='".$this->db->escape_str($data['datateknis_wfmid'])."',
        datateknis_statuswfm='".$this->db->escape_str($data['datateknis_statuswfm'])."',
        datateknis_desktask='".$this->db->escape_str($data['datateknis_desktask'])."',
        datateknis_statustask='".$this->db->escape_str($data['datateknis_statustask'])."',
        datateknis_tglinstall='".$this->db->escape_str($data['datateknis_tglinstall'])."'
        WHERE datateknis_orderid='".$this->db->escape_str($data['datakpro_orderid'])."'
        ");
        // echo "2";
        return 1;
    }

    var $column_order = array(null,null,'k.datakpro_orderid','k.datakpro_myir','k.datakpro_namacust',
    'k.datakpro_alamat','sto.sto_name','k.datakpro_nohp','k.datakpro_packagename','k.datakpro_alpro',
    'k.datakpro_salesid','k.datakpro_agency','k.datakpro_statusresume','k.datakpro_statusmessage',
    'k.datakpro_tanggalinput','teknisiid1','teknisiid2', 't.datateknis_sektor','t.datateknis_tindaklanjut',
    't.datateknis_keterangan','vallayananid','valcustomerid','channelid','a2.dataa2_validasideposit',
    'a2.dataa2_manja','a2.dataa2_oknok','a2.dataa2_keterangan'); //field yang ada di table user
    var $column_search = array('datakpro_myir','datakpro_namacust','sto_name'); //field yang diizin untuk pencarian 
    var $order = array('datakpro_orderdate' => 'asc'); // default order 
 
    public function _get_datatables_query(){
        $from=date('Y-m-d', strtotime("-1 days"));
        $to = date("Y-m-d");
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        $this->db->where('k.datakpro_orderid',NULL);
        $this->db->where('i.datainputter_drop != ',1);
        $this->db->where("DATE(k.datakpro_tanggalinput)>=",$from);
        $this->db->where("DATE(k.datakpro_tanggalinput) <=",$to);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function _get_datatables_query_TL($sto){
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        
        $this->db->where('k.datakpro_sto=',$sto);
        $this->db->group_start();
            $this->db->where('k.datakpro_orderid',NULL);
            // $this->db->where('t.datateknis_tindaklanjut',NULL);
            // $this->db->group_start();
                $this->db->group_start();
                    // $this->db->where('t.datateknis_tindaklanjut','STS00001');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00012');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00011');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00015');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00016');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00001');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00019');
                    $this->db->or_where('t.datateknis_tindaklanjut',NULL);
                $this->db->group_end();
            //     $this->db->group_start();
            //         $this->db->not_like('k.datakpro_statusmessage','COMPLETED');
            //         $this->db->where('k.datakpro_statusmessage !=',NULL);
            //     $this->db->group_end();
            // $this->db->group_end();
        $this->db->group_end();    
        $this->db->where('i.datainputter_drop !=','1');
        $this->db->order_by('t.datateknis_tindaklanjut','ASC');
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function _get_datatables_query_TL_datel($datel){
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        
        $this->db->where('k.datakpro_datel=',$datel);
        $this->db->group_start();
            $this->db->where('k.datakpro_orderid',NULL);
            // $this->db->where('t.datateknis_tindaklanjut',NULL);
            // $this->db->group_start();
                $this->db->group_start();
                    // $this->db->where('t.datateknis_tindaklanjut','STS00001');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00012');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00011');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00015');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00016');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00001');
                    $this->db->where('t.datateknis_tindaklanjut !=','STS00019');
                    $this->db->or_where('t.datateknis_tindaklanjut',NULL);
                $this->db->group_end();
            //     $this->db->group_start();
            //         $this->db->not_like('k.datakpro_statusmessage','COMPLETED');
            //         $this->db->where('k.datakpro_statusmessage !=',NULL);
            //     $this->db->group_end();
            // $this->db->group_end();
        $this->db->group_end();    
        $this->db->where('i.datainputter_drop !=','1');
        $this->db->order_by('t.datateknis_tindaklanjut','ASC');
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function _get_datatables_query_a2($user){
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        $this->db->where('k.datakpro_orderid',NULL);
        $this->db->where('i.datainputter_drop!=','1');
        $this->db->group_start();
            $this->db->where('k.datakpro_datel','DATEL00001');
            $this->db->or_where('k.datakpro_datel','DATEL00003');
        $this->db->group_end();
        $this->db->group_start();
            $this->db->where('s.statusorder_id',NULL);
            $this->db->or_where('s.statusorder_id','STS00007');
            $this->db->or_where('s.statusorder_id','STS00008');
            $this->db->or_where('s.statusorder_id','STS00010'); 
            $this->db->or_where('s.statusorder_id','STS00009'); 
            $this->db->or_where('s.statusorder_id','STS00013');
            $this->db->or_where('s.statusorder_id','STS00023');
            $this->db->or_where('s.statusorder_id','STS00024');
        $this->db->group_end();
        // $this->db->like('k.datakpro_sto',$filtersto);
        $this->db->order_by('s.statusorder_id','DESC');
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function _get_datatables_query_agency($loker){
        $from=date('Y-m-d', strtotime("-1 days"));
		$to = date("Y-m-d");
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        $this->db->where('k.datakpro_agency',$loker);
        $this->db->where('DATE(k.datakpro_tanggalinput)>=',$from);
        $this->db->where('DATE(k.datakpro_tanggalinput)<=',$to);
        $this->db->order_by('a2.dataa2_oknok',"ASC");

        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function _get_datatables_query_inputter(){
        $this->db->select('k.*,t.*,a2.*,sto.*,tek.teknisi_id as teknisiid1, 
        tek.teknisi_name as teknisiname1,
        tek2.teknisi_id as teknisiid2,
        tek2.teknisi_name as teknisiname2,
        s.statusorder_name as statusorder,
        s.statusorder_id as statusorderid,
        l.validasilayanan_id as vallayananid,
        l.validasilayanan_name as vallayanan,
        c.validasicustomer_id as valcustomerid,
        c.validasicustomer_name as valcustomer,
        ch.channel_id as channelid,
        ch.channel_name as channel,
        lok.loker_name as lokername');
        $this->db->from('kawal_datakpro as k');
        $this->db->join('kawal_datateknis as t','t.datateknis_id=k.datakpro_id','left');
        $this->db->join('kawal_teknisi as tek','tek.teknisi_id=t.datateknis_personid1','left');
        $this->db->join('kawal_teknisi as tek2','tek2.teknisi_id=t.datateknis_personid2','left');
        $this->db->join('kawal_dataa2 as a2',' a2.dataa2_id=k.datakpro_id','left');
        $this->db->join('kawal_statusorder as s','s.statusorder_id=t.datateknis_tindaklanjut','left');
        $this->db->join('kawal_validasilayanan as l','a2.dataa2_validasilayanan=l.validasilayanan_id','left');
        $this->db->join('kawal_validasicustomer as c','a2.dataa2_validasicustomer=c.validasicustomer_id','left');
        $this->db->join('kawal_channel as ch','a2.dataa2_channel=ch.channel_id','left');
        $this->db->join('kawal_sto as sto','sto.sto_id=k.datakpro_sto','left');
        $this->db->join('kawal_datainputter as i','i.datainputter_id=k.datakpro_id','left');
        $this->db->join('kawal_loker as lok','lok.loker_id=k.datakpro_agency','left');
        $this->db->where('k.datakpro_orderid',NULL);
        $this->db->where('i.datainputter_drop!=','1');
        $this->db->group_start();
            $this->db->where('k.datakpro_datel','DATEL00001');
            $this->db->or_where('k.datakpro_datel','DATEL00003');
        $this->db->group_end();
        $this->db->order_by('a2.dataa2_oknok','DESC');
        
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables(){
        $user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
        $loker=$this->session->userdata('loker');
        
        if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00006' || $role=='ROLE00008'||$role=='ROLE00009'){
            $this->_get_datatables_query();
        }else if ($role=='ROLE00002'){
            // $data['query']=$this->kawal_model->selectDataKawalTL($sto);
            if($sto=='STO00000'){
                $this->_get_datatables_query_TL_datel($datel);
            }else{
                $this->_get_datatables_query_TL($sto);
            }
        }else if ($role=='ROLE00003'){
            $data['query']=$this->kawal_model->_get_datatables_query_agency($loker);
        }else if($role=='ROLE00005'){
            // $data['query']=$this->kawal_model->selectDataKawalA2($user);
            $this->_get_datatables_query_a2($user);
        }else if($role=='ROLE00007'){
            // $data['query']=$this->kawal_model->selectDataKawalPlasa($user);
        }else if($role=='ROLE00004'){
            // $data['query']=$this->kawal_model->selectDataKawalInputter();
            $this->_get_datatables_query_inputter();
        }
        
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all(){
        $user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
        $loker=$this->session->userdata('loker');

        if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00006' || $role=='ROLE00008'||$role=='ROLE00009'){
            return $this->countSelectDataKawalAll();
        }else if ($role=='ROLE00002'){
            // $data['query']=$this->kawal_model->selectDataKawalTL($sto);
            if($sto=='STO00000'){
                return $this->countSelectDataKawalTLdatel($datel);
            }else{
                return $this->countSelectDataKawalTL($sto);    
            }
            
        }else if ($role=='ROLE00003'){
            // $data['query']=$this->kawal_model->selectDataKawalAgency($loker);
            return $this->countSelectDataKawalAgency($loker);
        }else if($role=='ROLE00005'){
            // $data['query']=$this->kawal_model->selectDataKawalA2($user);
            return $this->countSelectDataKawalA2($user);
        }else if($role=='ROLE00007'){
            // $data['query']=$this->kawal_model->selectDataKawalPlasa($user);
        }else if($role=='ROLE00004'){
            // $data['query']=$this->kawal_model->selectDataKawalInputter();
            return $this->countSelectDataKawalInputter();
        }
    }

    public function count_filtered(){
        // $this->_get_datatables_query();
        $user=$this->session->userdata('username');
		$role=$this->session->userdata('role');
		$regional=$this->session->userdata('regional');
		$witel=$this->session->userdata('witel');
		$datel=$this->session->userdata('datel');
		$sto=$this->session->userdata('sto');
        $loker=$this->session->userdata('loker');
        
        if($role=='ROLE00000' || $role=='ROLE00001' || $role=='ROLE00006' || $role=='ROLE00008'||$role=='ROLE00009'){
            $this->_get_datatables_query();
        }else if ($role=='ROLE00002'){
            // $data['query']=$this->kawal_model->selectDataKawalTL($sto);
            if($sto=='STO00000'){
                $this->_get_datatables_query_TL_datel($datel);
            }else{
                $this->_get_datatables_query_TL($sto);
            }
        }else if ($role=='ROLE00003'){
            // $data['query']=$this->kawal_model->selectDataKawalAgency($loker);
            $this->_get_datatables_query_agency($loker);
        }else if($role=='ROLE00005'){
            // $data['query']=$this->kawal_model->selectDataKawalA2($user);
            $this->_get_datatables_query_a2($user);
        }else if($role=='ROLE00007'){
            // $data['query']=$this->kawal_model->selectDataKawalPlasa($user);
        }else if($role=='ROLE00004'){
            // $data['query']=$this->kawal_model->selectDataKawalInputter();
            $this->_get_datatables_query_inputter();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function orderprogress(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as orderprogress
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            t.datateknis_tindaklanjut='STS00001'
            OR t.datateknis_tindaklanjut='STS00002'
            OR t.datateknis_tindaklanjut='STS00003'
            OR t.datateknis_tindaklanjut='STS00004'
            OR t.datateknis_tindaklanjut='STS00005'
            OR t.datateknis_tindaklanjut='STS00006'
            OR t.datateknis_tindaklanjut='STS00007'
            OR t.datateknis_tindaklanjut='STS00022'
            OR t.datateknis_tindaklanjut='STS00023'
            OR t.datateknis_tindaklanjut='STS00024'
        )
        AND k.datakpro_datel='DATEL00001'
        ");
        
        

        return $query->num_rows();
    }

    public function kendalateknik(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalateknik
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND 
        (t.datateknis_tindaklanjut='STS00010'
        OR t.datateknis_tindaklanjut='STS00015'
        OR t.datateknis_tindaklanjut='STS00016'
        OR t.datateknis_tindaklanjut='STS00017'
        OR t.datateknis_tindaklanjut='STS00018'
        OR t.datateknis_tindaklanjut='STS00019'
        OR t.datateknis_tindaklanjut='STS00020'
        OR t.datateknis_tindaklanjut='STS00021'
        )AND k.datakpro_datel='DATEL00001' ");

        return $query->num_rows();
    }

    public function kendalapelanggan(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalapelanggan
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND 
        (t.datateknis_tindaklanjut='STS00008'
        OR t.datateknis_tindaklanjut='STS00009'
        OR t.datateknis_tindaklanjut='STS00011'
        OR t.datateknis_tindaklanjut='STS00012'
        OR t.datateknis_tindaklanjut='STS00013'
        OR t.datateknis_tindaklanjut='STS00014'
        )AND k.datakpro_datel='DATEL00001' ");

        return $query->num_rows();
    }
    
    public function belumtl(){ 
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as belumtl
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND 
        t.datateknis_tindaklanjut IS NULL AND k.datakpro_datel='DATEL00001'
        ");

        return $query->num_rows();
        
    }

    public function inputvalid(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as inputvalid
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_oknok='OK'
            AND a2.dataa2_validasideposit='SUDAH'
            
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function kendalalayanan(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalalayanan
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_validasilayanan!='LAY001'
            and a2.dataa2_validasicustomer='CUS001'
            AND a2.dataa2_validasideposit='BELUM'
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function kendalapela2(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalapela2
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_validasicustomer!='CUS001'
            and a2.dataa2_validasilayanan='LAY001'
            AND a2.dataa2_validasideposit='BELUM'
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function kendaladeposit(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendaladeposit
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_validasideposit='BELUM'
            and a2.dataa2_validasicustomer='CUS001'
            and a2.dataa2_validasilayanan='LAY001'
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function belumvalid(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as beluma2
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_validasilayanan='LAY000'
            OR a2.dataa2_validasicustomer='CUS000'
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function inputsc(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as inputsc
        FROM kawal_datakpro k
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' 
        AND k.datakpro_orderid IS NOT NULL
        AND k.datakpro_datel='DATEL00001'
        ");

        return $query->num_rows();
    }

    public function kendalatl(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalatl
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            t.datateknis_personid1 IS NULL
            AND t.datateknis_personid2 IS NULL
            AND t.datateknis_tindaklanjut IS NULL
            
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function kendalaa2(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as kendalaa2
        FROM kawal_datakpro k
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            a2.dataa2_validasilayanan='LAY000'
            AND a2.dataa2_validasicustomer='CUS000'
            AND a2.dataa2_validasideposit='BELUM'
            AND a2.dataa2_channel IS NULL
            AND a2.dataa2_oknok IS NULL
            AND a2.dataa2_oknok='NOK'
            
        )AND k.datakpro_datel='DATEL00001'
        ");

        
        return $query->num_rows();
    }

    public function beluminputter(){
        $today=date('Y-m-d');
        $query=$this->db->query("SELECT k.datakpro_id as beluminputter
        FROM kawal_datakpro k
        LEFT JOIN kawal_datateknis t ON t.datateknis_id=k.datakpro_id
        LEFT JOIN kawal_dataa2 a2 ON a2.dataa2_id=k.datakpro_id
        LEFT JOIN kawal_datainputter i ON i.datainputter_id=k.datakpro_id
        WHERE k.datakpro_tanggalinput LIKE '".$today."%' AND
        (
            t.datateknis_personid1 IS NOT NULL
            AND t.datateknis_personid2 IS NOT NULL
            AND t.datateknis_tindaklanjut IS NOT NULL
            AND a2.dataa2_validasilayanan!='LAY000'
            AND a2.dataa2_validasicustomer!='CUS000'
            AND a2.dataa2_validasideposit!='BELUM'
            AND a2.dataa2_channel IS NOT NULL
            AND a2.dataa2_oknok IS NOT NULL
            AND a2.dataa2_oknok!='NOK'
            AND i.datainputter_drop!='1'
        )AND k.datakpro_datel='DATEL00001'
        ");


        return $query->num_rows();
    }

}