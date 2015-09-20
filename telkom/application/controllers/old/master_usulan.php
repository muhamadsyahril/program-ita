<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_usulan extends CI_Controller {

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
				$where = " WHERE detail LIKE '%$cari%' OR jenis LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Master Data Usulan";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM master_usulan $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/master_usulan/index/';
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
			

			$text = "SELECT * FROM master_usulan $where 
					ORDER BY jenis ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM table_cabang";
			$d['list'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('master_usulan/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('id'); 
			$text = "SELECT * FROM master_usulan WHERE idusulan='$id'";
			$data = $this->app_model->manualQuery($text);

				foreach($data->result() as $db){
					$d['idusulan']	=$db->idusulan;
					$d['detail']	=$db->detail;
					$d['satuan']	=$db->satuan;
					$d['jenis']	=$db->jenis;
					echo json_encode($d);
				}

		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM master_usulan WHERE idusulan='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/master_usulan'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				// $up['user_input']=$this->session->userdata('username');
				$up['idusulan']=$this->input->post('idusulan');
				$up['detail']=$this->input->post('detail');
				$up['satuan']=$this->input->post('satuan');
				$up['jenis']=$this->input->post('jenis');
				$id['idusulan']=$this->input->post('idusulan');
				
				
				$data = $this->app_model->getSelectedData("master_usulan",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("master_usulan",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("master_usulan",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file coa.php */
/* Location: ./application/controllers/coa.php */