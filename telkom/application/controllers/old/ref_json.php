<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function CariNoJurnal()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['nojurnal'] = $this->app_model->MaxNoJurnal();
			$data['tgl'] = date('d-m-Y');
			echo json_encode($data);
			
		}else{
			header('location:'.base_url());
		}
	}
	
		public function CariNoUsulan()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['nousulan'] = $this->app_model->MaxNoUsulan();
			$data['tgl'] = date('d-m-Y');
			echo json_encode($data);
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function CariNoAJP()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['nojurnal'] = $this->app_model->MaxNoAJP();
			$data['tgl'] = date('d-m-Y');
			echo json_encode($data);
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function CariNamaCab()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$kodecab = $this->input->post('kodecab');
			
			$text = "SELECT * FROM table_cabang WHERE kodecab='$kodecab'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['singcab'] = $t->singcab;
					echo json_encode($data);
				}
			}else{
				$data['singcab'] ='';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */