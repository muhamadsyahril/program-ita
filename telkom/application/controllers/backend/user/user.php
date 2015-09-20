<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
				$where = " WHERE userid LIKE '%$cari%' OR username LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="User";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM tbl_user $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/user/index/';
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
			

			$text = "SELECT * FROM tbl_user $where 
					ORDER BY username ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);

			$d['content'] = $this->load->view('backend/user/view', $d, true);		
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

			$d['judul']="user";	
			
			$text = "SELECT * FROM tbl_user";
			$d['list'] = $this->app_model->manualQuery($text);
							
			
			$d['content'] = $this->load->view('backend/user/form', $d, true);		
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
			$text = "SELECT * FROM tbl_user WHERE userid='$id'";
			$data = $this->app_model->manualQuery($text);
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['userid']	=$db->userid;
					$d['password']	=$db->password;
					$d['username']	=$db->username;
					$d['level']	=$db->level;
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
			$this->app_model->manualQuery("DELETE FROM tbl_user WHERE userid='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/user'>";			
		}else{
			header('location:'.base_url('backend'));
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$pengacak ="meRita!say#kepo";
				$passInput = $this->input->post('password');
				$passEnkrip = md5($pengacak . md5($passInput) . $pengacak );
				$up['password']=$passEnkrip;
				$up['username']=$this->input->post('username');
				$up['level']=$this->input->post('level');
				$up['nomerid_pel_pet']=$this->input->post('nomerid');
				
				$id['userid']=$this->input->post('userid');
				$data = $this->app_model->getSelectedData("tbl_user",$id);
				
				$text = "SELECT username FROM tbl_user WHERE username='".$up['username']."'";
				$data1 = $this->app_model->manualQuery($text);
				
				if($data1->num_rows()>0) {
				
				
				if($data->num_rows()>0){
					$this->app_model->updateData("tbl_user",$up,$id);
					echo 'Data berhasil diupdate';
					}else{ echo "data sudah ada"; }
					
				}else{
					$this->app_model->insertData("tbl_user",$up);
					echo 'Data berhasil disimpan';	
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."backend/user'>";
				}
		}else{
				header('location:'.base_url('backend'));
		}
	
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */