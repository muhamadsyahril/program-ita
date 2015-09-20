<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_budget extends CI_Controller {

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
				$where = " AND idproceed LIKE '%$cari%' OR detail_pengajuan LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="input budget";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "select c.tanggal,c.idproceed,a.namacabang,b.nama_coa,c.detail_pengajuan,c.kredit from 
					 table_cabang a,master_coa b,proceed c 
					 where 
					 a.kodecab = c.kodecab and
					 b.idcoa = c.idcoa
					 $where
					 order by tanggal desc";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/input_budget/index/';
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
			

			$text = "select c.tanggal,c.idproceed,a.namacabang,b.nama_coa,c.detail_pengajuan,c.kredit from 
					 table_cabang a,master_coa b,proceed c 
					 where 
					 a.kodecab = c.kodecab and
					 b.idcoa = c.idcoa
					$where
					order by tanggal desc
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM table_cabang";
			$d['cabang'] = $this->app_model->manualQuery($text);
			$text = "SELECT * FROM master_coa";
			$d['coa'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('input_budget/view', $d, true);		
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
			$text = "SELECT * FROM data_asset WHERE idasset='$id'";
			$data = $this->app_model->manualQuery($text);

				foreach($data->result() as $db){
					$d['idasset']	=$db->idasset;
					$d['asset_label']	=$db->asset_label;
					$d['kodecab']	=$db->kodecab;
					$d['tahun']	=$db->tahun;
					$d['serial_number']	=$db->serial_number;
					$d['item']	=$db->item;
					$d['detail']	=$db->detail;
					$d['kategori']	=$db->kategori;
					$d['user_dept']	=$db->user_dept;
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
			$this->app_model->manualQuery("DELETE FROM data_asset WHERE idasset='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/asset'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				

				$up['idasset']=$this->input->post('idasset');
				$dept=$this->input->post('dept');
				$bln=$this->input->post('bln');
				$thn=$this->input->post('thn');
				$up['kodecab']=$this->input->post('kodecab');
				$singcab=$this->input->post('singcab');
				$up['tahun']=$this->input->post('tahun');
				$up['serial_number']=$this->input->post('serial_number');
				$up['item']=$this->input->post('item');
				$up['detail']=$this->input->post('detail');
				$up['kategori']=$this->input->post('kategori');
				$up['user_dept']=$this->input->post('user_dept');
				$up['user_input']=$this->session->userdata('username');
				
				$up['asset_label']=$up['idasset']."/".$singcab."/".$dept."/".$bln."/".$thn;
				
				$id['idasset']=$this->input->post('idasset');
				
				$data = $this->app_model->getSelectedData("data_asset",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("data_asset",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("data_asset",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file coa.php */
/* Location: ./application/controllers/coa.php */