<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usulan extends CI_Controller {

	/**
	 * @author : 
	 * @web : 
	 * @keterangan : 
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
		
			$cari = $this->input->post('txt_cari');
			$kodecab = $this->session->userdata('kodecab');
			$month_now=date('m');
			if(empty($cari)){
				
				$where = "	WHERE
							budget.idcoa=master_coa.idcoa 
							AND kodecab='$kodecab'
							AND periode_bulan='$month_now'";
			}else{
				$where = "WHERE
						budget.idcoa=master_coa.idcoa 
						AND kodecab='$kodecab'
						AND periode_bulan='$month_now'
						AND nama_coa LIKE'%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Form Usulan";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			//$text = "SELECT * FROM jurnal_umum $where ";		
			//$tot_hal = $this->app_model->manualQuery($text);		
			
			//$d['tot_hal'] = $tot_hal->num_rows();
			//$config['base_url'] = site_url() . '/usulan/index/';
			//$config['total_rows'] = $tot_hal->num_rows();
			//$config['per_page'] = $limit;
			//$config['uri_segment'] = 3;
			//$config['next_link'] = 'Lanjut &raquo;';
			//$config['prev_link'] = '&laquo; Kembali';
			//$config['last_link'] = '<b>Terakhir &raquo; </b>';
			//$config['first_link'] = '<b> &laquo; Pertama</b>';
			//$this->pagination->initialize($config);
			//$d["paginator"] =$this->pagination->create_links();
			//$d['hal'] = $offset;
			

			$t_budget = "SELECT budget.periode_bulan,budget.periode_tahun,budget.kodecab,
							master_coa.idcoa,master_coa.nama_coa,budget.debet
							FROM budget,master_coa
							$where";
			$d['data1'] = $this->app_model->manualQuery($t_budget);
			
			$t_proceed = "SELECT * FROM proceed WHERE kodecab='$kodecab' AND month(tanggal)='$month_now'";
			$d['data2'] = $this->app_model->manualQuery($t_proceed);
			
			//$text = "SELECT * FROM rekening ORDER BY no_rek ASC";
			//$d['list_rek'] = $this->app_model->manualQuery($text);
			
			$d['content'] = $this->load->view('usulan/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function tampil_budget()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			
			
			$this->load->view('usulan/view_data',$d);
			
		}else{
			header('location:'.base_url());
		}
	
	
	}
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('id');  
			$text = "SELECT * FROM jurnal_umum WHERE no_jurnal='$id' LIMIT 1";
			$data = $this->app_model->manualQuery($text);
			foreach($data->result() as $db){
				$d['no_jurnal']	=$db->no_jurnal;
				$d['tgl']		= $this->app_model->tgl_str($db->tgl_jurnal);
				$d['no_bukti']	=$db->no_bukti;
				$d['ket']		=$db->ket;
				echo json_encode($d);
			}

		}else{
			header('location:'.base_url());
		}
	}
	
	/*
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM jurnal_umum WHERE id_jurnal='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rekening'>";			
		}else{
			header('location:'.base_url());
		}
	}
	*/
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$up['no_jurnal']=$this->input->post('no_jurnal');
				$up['tgl_jurnal']=$this->app_model->tgl_sql($this->input->post('tgl'));
				$up['ket']=$this->input->post('ket');
				$up['no_bukti']=$this->input->post('no_bukti');
				$up['no_rek']=$this->input->post('no_rek');
				$up['debet']=$this->input->post('debet');
				$up['kredit']=$this->input->post('kredit');
				$up['username']=$this->session->userdata('username');
				$up['tgl_insert']=date('Y-m-d h:m:s');
				
				$id['no_jurnal']=$this->input->post('no_jurnal');
				$id['no_rek']=$this->input->post('no_rek');
				
				$no_jurnal 	=$this->input->post('no_jurnal');
				$no_rek 	=$this->input->post('no_rek');
				
				$text = "SELECT * FROM jurnal_umum WHERE no_jurnal='$no_jurnal' AND no_rek='$no_rek'";
				$data = $this->app_model->manualQuery($text); //$this->app_model->getSelectedData("jurnal_umum",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("jurnal_umum",$up,$id);
					echo 'Simpan data Sukses';
				}else{
					$this->app_model->insertData("jurnal_umum",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
	public function DetailJurnalUmum()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$id = $this->input->post('no_jurnal'); 
			
			$text = "SELECT * FROM jurnal_umum WHERE no_jurnal='$id'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('jurnal_umum/detail_jurnal',$d);
		
			//echo $text;
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapusDetail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$id = $this->input->post('no_jurnal'); 
			$rek = $this->input->post('no_rek'); 
			
			$text = "DELETE FROM jurnal_umum WHERE no_jurnal='$id' AND no_rek='$rek'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM jurnal_umum WHERE no_jurnal='$id'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('jurnal_umum/detail_jurnal',$d);

		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */