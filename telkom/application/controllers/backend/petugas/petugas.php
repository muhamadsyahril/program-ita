<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas extends CI_Controller {

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
				$where = ' where a.idarea=b.id_area';
			}else{
				$where = " WHERE a.idarea=b.id_area and id_petugas LIKE '%$cari%' OR nama LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Petugas";
			
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT a.*,b.area_name FROM tbl_petugas a,tbl_area b $where ";	
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . 'backend/petugas/index/';
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
			

			$text = "SELECT a.*,b.area_name FROM tbl_petugas a,tbl_area b $where 
					ORDER BY a.id_petugas ASC 
					LIMIT $limit OFFSET $offset";

			$d['data'] = $this->app_model->manualQuery($text);

			$text ="SELECT * FROM tbl_area";
			$d['area'] = $this->app_model->manualQuery($text);

			$d['content'] = $this->load->view('backend/petugas/view', $d, true);		
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

			$d['judul']="Petugas";	
			
			$text = "SELECT * FROM tbl_petugas";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('backend/petugas/form', $d, true);		
			$this->load->view('backend/ui_backend/home',$d);
		}else{
			header('location:'.base_url('backend'));
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
			$text = "SELECT * FROM tbl_petugas WHERE id_petugas='$id'";
			$data = $this->app_model->manualQuery($text);
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id_petugas']	=$db->id_petugas;
					$d['nama']	=$db->nama;
					$d['member']	=$db->member;
					$d['no_telpon']	=$db->no_telp;
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
			$id = $this->uri->segment(4);
			$this->app_model->manualQuery("DELETE FROM tbl_petugas WHERE id_petugas='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/petugas'>";			
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
	
				$up['id_petugas']=$this->input->post('id_petugas');
				$up['idarea']=$this->input->post('idarea');
				$up['nama']=$this->input->post('nama');
				$up['member']=$this->input->post('member');
				$up['no_telpon']=$this->input->post('no_telpon');
				
				$id['id_petugas']=$this->input->post('id_petugas');
				
				
				$data = $this->app_model->getSelectedData("tbl_petugas",$id);
				
				$text = "SELECT nama FROM tbl_petugas WHERE nama='".$up['nama']."'";
				$data1 = $this->app_model->manualQuery($text);
				
				if($data1->num_rows()>0) {
				
				
				if($data->num_rows()>0){
					$this->app_model->updateData("tbl_petugas",$up,$id);
					echo 'Data berhasil diupdate';
					}else{ echo "data sudah ada"; }
					
				}else{
					
					$this->app_model->insertData("tbl_petugas",$up);
					echo 'Data berhasil disimpan';	
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/petugas'>";
				}
		}else{
				header('location:'.base_url('backend'));
		}
	
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */