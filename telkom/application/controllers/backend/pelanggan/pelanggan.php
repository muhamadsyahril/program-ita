<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

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
				$where = "AND tbl_produk.name_produk LIKE '%$cari%' OR tbl_pelanggan.nama_pel LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Pelanggan";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT *,tbl_produk.name_produk as produk 
						FROM tbl_pelanggan,tbl_produk 
						WHERE tbl_pelanggan.id_produk=tbl_produk.id_produk $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'backend/pelanggan/index/';
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
			

			$text = "SELECT *,tbl_produk.name_produk as produk 
						FROM tbl_pelanggan,tbl_produk 
						WHERE tbl_pelanggan.id_produk=tbl_produk.id_produk $where 
					ORDER BY nama_pel ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text ="SELECT * FROM tbl_produk ";
			$d['produk'] = $this->app_model->manualQuery($text);
			
			$text ="SELECT * FROM tbl_area";
			$d['area'] = $this->app_model->manualQuery($text);
				
			
			$d['content'] = $this->load->view('backend/pelanggan/view', $d, true);		
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

			$d['judul']="Pelanggan";	
			
			$text = "SELECT * FROM tbl_pelanggan";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('backend/pelanggan/form', $d, true);		
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
			
			$text = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan='$id'";
			
			$data = $this->app_model->manualQuery($text);
			
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id_pelanggan']	=$db->id_pelanggan;
					$d['id_produk']	=$db->id_produk;
					$d['id_area']	=$db->id_area;
					$d['nama_pel']	=$db->nama_pel;
					$d['alamat_pel']	=$db->alamat_pel;
					$d['telp_pel']	=$db->telp_pel;
					$d['email_pel']	=$db->email_pel;
					$d['tgl_lahir']	=$db->tgl_lahir;
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
			$this->app_model->manualQuery("DELETE FROM tbl_pelanggan WHERE id_pelanggan='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/pelanggan'>";			
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$up['id_produk']=$this->input->post('id_produk');
				$up['id_area']=$this->input->post('id_area');
				$up['nama_pel']=$this->input->post('nama_pel');
				$up['alamat_pel']=$this->input->post('alamat_pel');
				$up['telp_pel']=$this->input->post('telp_pel');
				$up['speedyno']=$this->input->post('speedyno');
				$up['tgl_lahir']=$this->input->post('tgl_lahir');
				$up['email_pel']=$this->input->post('email_pel');
				$id['id_pelanggan']=$this->input->post('id_pelanggan');
				
				$text = "SELECT nama_pel FROM tbl_pelanggan WHERE nama_pel='".$up['nama_pel']."'";
				$data1 = $this->app_model->manualQuery($text);
				
				if($data1->num_rows()>0) {
				
				$data = $this->app_model->getSelectedData("tbl_pelanggan",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("tbl_pelanggan",$up,$id);
					echo 'Update data Sukses';
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/pelanggan'>";
					
					}else{ echo "data sudah ada"; }
				}else{
				
				$this->app_model->insertData("tbl_pelanggan",$up);
					echo 'Simpan data Sukses';
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/pelanggan'>";					
					
				} 
		}else{
		header('location:'.base_url('backend'));
				
		}
	
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */