<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

	/**
	 * @author : Merita
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
				$where = "where area_name LIKE '%$cari%' OR kota LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Area";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM tbl_area $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'backend/area/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 4;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
			

			$text = "SELECT * FROM tbl_area  $where 
					ORDER BY kota ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text ="SELECT * FROM tbl_petugas ";
			$d['petugas'] = $this->app_model->manualQuery($text);
				
			
			$d['content'] = $this->load->view('backend/area/view', $d, true);		
			$this->load->view('backend/ui_backend/home',$d);
		}else{
			header('location:'.base_url('backend'));
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

			$d['judul']="Produk";	
			
			$text = "SELECT * FROM tbl_area";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('backend/area/form', $d, true);		
			$this->load->view('backend/ui_backend/home',$d);
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function edit()

	{
		$cek = $this->session->userdata('logged_in');
		
		
		if(!empty($cek)){

			$id = $this->input->post('id');  //$this->uri->segment(3);
			
			$text = "SELECT * FROM tbl_area WHERE id_area='$id'";
			
			$data = $this->app_model->manualQuery($text);
			
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id_area']	=$db->id_area;
					$d['area_name']	=$db->area_name;
					$d['kota']	=$db->kota;
					$d['id_petugas']	=$db->id_petugas;
					echo json_encode($d);
				}
			//}
						
			//$d['content'] = $this->load->view('rekening/tambah', $d, true);		
			//$this->load->view('home',$d);
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(4);
			$this->app_model->manualQuery("DELETE FROM tbl_area WHERE id_area='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/area'>";			
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$up['area_name']=$this->input->post('area_name');
				$up['kota']=$this->input->post('kota');
				$id['id_area']=$this->input->post('id_area');
				
				$text = "SELECT area_name FROM tbl_area WHERE area_name='".$up['area_name']."'";
				$data1 = $this->app_model->manualQuery($text);
				
				if($data1->num_rows()>0) {
				
				$data = $this->app_model->getSelectedData("tbl_area",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("tbl_area",$up,$id);
					echo 'Update data Sukses';
					
					}else{ echo "data sudah ada"; }
				}else{
				
				$this->app_model->insertData("tbl_area",$up);
					echo 'Simpan data Sukses';
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/area'>";					
					
				} 
		}else{
		header('location:'.base_url('backend'));
				
		}
	
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */