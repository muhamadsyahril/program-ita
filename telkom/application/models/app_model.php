<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
	 * @author : merita
	 * @phone : 
	 * @keterangan : 
	 **/
	
	
	
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	
	public function CariProceed($id){		
		$kodecab = $this->session->userdata('kodecab');
		$month_now=date('m');
		$text = "SELECT idcoa,sum(kredit) as proceed
				 FROM proceed
				 WHERE
				 kodecab='$kodecab'
				 AND month(tanggal)='$month_now' AND idcoa='$id'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->proceed;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
		public function CariIDInventaris(){		
		$kodecab = $this->session->userdata('kodecab');
		$text = "SELECT * FROM data_asset WHERE kodecab='$kodecab'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$idinventaris = $t->id_inventaris;
			}
		}else{
			$idinventaris = "";
		}
		return $idinventaris;
	}
	
	public function CariIDTransaksi(){	
	
       $dt = date('d');
		$bln = date('m');
		$th = date('Y');
		$text = "SELECT max(idproceed) as no FROM proceed_tampung WHERE month(tanggal)='$bln'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,4))+1;
				$hasil = $th.$bln.$dt.sprintf("%04s", $tmp);
			}
		}else{
			$hasil = $th.$bln.$dt.'0001';
		}
		return $hasil;
	}
	
	public function MaxNoUsulan(){
		$dt = date('d');
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(no_usulan) as no FROM usulan WHERE month(tgl_usulan)='$bln'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = $dt.$bln.$th.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = $dt.$bln.$th.'00001';
		}
		return $hasil;
	}
	
		public function MaxNoInventaris(){
		$bln = date('m');
		$tahun = date('Y');
		$th = date('y');
		$text = "SELECT max(idasset) as no FROM data_asset WHERE year(tanggal_insert)='$tahun'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,4,4))+1;
				$hasil = $bln.$th.sprintf("%04s", $tmp);
			}
		}else{
			$hasil =$bln.$th.'0001';
		}
		return $hasil;
	}
	
	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	
	public function getLoginAuth($usr,$psw)
	{
		$pengacak ="meRita!say#kepo";
		$u = mysql_real_escape_string($usr);
		$p = md5($pengacak . md5($psw) . $pengacak );
		$pi = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('tbl_user', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'ancurYahLoginWae';
						$sess_data['username'] = $qad->username;
						$sess_data['level'] = $qad->level;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'backend/home');
			}
		}
		else
		{
		    echo $p; 
			$this->session->set_flashdata('result_login', 'data user / password yang anda masukan salah');
			header('location:'.base_url().'backend');
		}
	}
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */