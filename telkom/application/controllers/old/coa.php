<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa extends CI_Controller {

	/**
	 * @author : Muhamad syahril
	 * @web : 
	 * @keterangan : 
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			if(empty($cari)){
				$where = ' ';
			}else{
				$where = " WHERE nama_coa LIKE '%$cari%' OR kelompok LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Master Coa";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM master_coa $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/coa/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
			

			$text = "SELECT * FROM master_coa $where 
					ORDER BY idcoa ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM master_coa";
			$d['list'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('coa/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Rekening";	
			
			$text = "SELECT * FROM rekening";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('rekening/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			/*
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Surat Perintah";
			$d['message'] = '';
			*/
			
			$id = $this->input->post('id');  //$this->uri->segment(3);
			$text = "SELECT * FROM master_coa WHERE idcoa='$id'";
			$data = $this->app_model->manualQuery($text);
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['icoa']	=$db->idcoa;
					$d['nama_coa']	=$db->nama_coa;
					$d['kelompok']	=$db->kelompok;
					echo json_encode($d);
				}
			//}
						
			//$d['content'] = $this->load->view('rekening/tambah', $d, true);		
			//$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM master_coa WHERE idcoa='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/coa'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				

				$up['idcoa']=$this->input->post('idcoa');
				$up['nama_coa']=$this->input->post('nama_coa');
				$up['kelompok']=$this->input->post('klpk_coa');
				
				$id['idcoa']=$this->input->post('idcoa');
				
				$data = $this->app_model->getSelectedData("master_coa",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("master_coa",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("master_coa",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file coa.php */
/* Location: ./application/controllers/coa.php */