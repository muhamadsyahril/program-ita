<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabang extends CI_Controller {

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
				$where = " WHERE kodecab LIKE '%$cari%' OR namacabang LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Master Cabang";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM table_cabang $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/cabang/index/';
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
			

			$text = "SELECT * FROM table_cabang $where 
					ORDER BY kodecab ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM table_cabang";
			$d['list'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('cabang/view', $d, true);		
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

			$d['judul']="Cabang";	
			
			$text = "SELECT * FROM table_cabang";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('cabang/form', $d, true);		
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
			$text = "SELECT * FROM table_cabang WHERE kodecab='$id'";
			$data = $this->app_model->manualQuery($text);
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['kodecab']	=$db->kodecab;
					$d['singcab']	=$db->singcab;
					$d['namacabang']	=$db->namacabang;
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
			$this->app_model->manualQuery("DELETE FROM table_cabang WHERE kodecab='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/cabang'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				

				$up['kodecab']=$this->input->post('kodecab');
				$up['singcab']=$this->input->post('singcab');
				$up['namacabang']=$this->input->post('namacabang');
				
				$id['kodecab']=$this->input->post('kodecab');
				
				$data = $this->app_model->getSelectedData("table_cabang",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("table_cabang",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("table_cabang",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file coa.php */
/* Location: ./application/controllers/coa.php */