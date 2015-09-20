<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Budgeting extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function index()
	{
	    $year=date('Y');
		$month=date('m');
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cabang = $this->input->post('cabang');
			$bln = $this->input->post('periode_bln');
			$thn = $this->input->post('periode_thn');
			if(empty($cabang)){
				$where ="WHERE periode_tahun ='$year' AND kodecab='101PST' AND periode_bulan='$month'";
			}else{
				$where = " WHERE periode_tahun ='$thn' AND kodecab='$cabang' AND periode_bulan='$bln'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Input Budgeting Periode -".$bln."-".$thn;
			
			$d['no'] = 0;
			
			$text = "SELECT a.periode_bulan,a.periode_tahun,b.idcoa,a.kodecab,b.nama_coa,a.debet
					 FROM budget as a
					 RIGHT JOIN master_coa as b
							 ON a.idcoa=b.idcoa
					$where 
					ORDER BY b.idcoa ASC";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT kodecab,namacabang FROM table_cabang";
			$d['list'] = $this->app_model->manualQuery($text);
						
			
			$d['content'] = $this->load->view('budgeting/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$up['periode_bulan']=$this->input->post('periode_bln');
				$up['periode_tahun']=$this->input->post('periode_thn');
				$up['idcoa']=$this->input->post('idcoa');
				$up['kodecab']=$this->input->post('kodecab');
				$up['debet']=$this->input->post('dr');
				$up['status']='Aktif';
				$up['tanggal_insert']=date('Y-m-d h:m:s');
				$up['keterangan']=$this->session->userdata('username');
				
				
				$id['periode_bulan']=$this->input->post('periode_bln');
				$id['periode_tahun']=$this->input->post('periode_thn');
				$id['kodecab']=$this->input->post('kodecab');
				$id['idcoa']=$this->input->post('idcoa');
				$data = $this->app_model->getSelectedData("budget",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("budget",$up,$id);
					echo 'Update data Sukses';
					echo $data->num_rows();
				}else{
					$this->app_model->insertData("budget",$up);
					echo $data->num_rows();
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file budgeting.php */
/* Location: ./application/controllers/budgeting.php */