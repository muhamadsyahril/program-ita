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
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="Form Usulan";
			$t_budget ="SELECT budget.periode_bulan,budget.periode_tahun,budget.kodecab,
							master_coa.idcoa,master_coa.nama_coa,budget.debet
						FROM budget,master_coa
						WHERE
						budget.idcoa=master_coa.idcoa
						AND kodecab='$kodecab'
						AND periode_bulan='$month_now'";
			$d['data'] = $this->app_model->manualQuery($t_budget);
			$d['content'] = $this->load->view('usulan/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function view_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$kodecab = $this->session->userdata('kodecab');
			$month_now=date('m');
			$idcoa = $this->input->post('coa');
			$d['idcoa']=$idcoa;
			
			$text = "SELECT budget.periode_bulan,budget.periode_tahun,budget.kodecab,
							master_coa.idcoa,master_coa.nama_coa,master_coa.jenis,budget.debet
						FROM budget,master_coa
						WHERE
						budget.idcoa=master_coa.idcoa
						AND kodecab='$kodecab'
						AND periode_bulan='$month_now'
						AND .master_coa.idcoa = '$idcoa'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('usulan/view_data',$d);
			
		}else{
			header('location:'.base_url());
		}
	}
	public function form_usulan()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$nama = $this->session->userdata('nama');
			$kodecab = $this->session->userdata('kodecab');
			$month_now=date('m');
			$idcoa = $this->input->post('idcoa');
			$namacoa = $this->input->post('namacoa');

			$text = "SELECT budget.periode_bulan,budget.periode_tahun,budget.kodecab,
							master_coa.idcoa,master_coa.nama_coa,master_coa.jenis,budget.debet
						FROM budget,master_coa
						WHERE
						budget.idcoa=master_coa.idcoa
						AND kodecab='$kodecab'
						AND periode_bulan='$month_now'
						AND .master_coa.idcoa = '$idcoa'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "select * from table_cabang WHERE kodecab='$kodecab'";
			$d['data1'] = $this->app_model->manualQuery($text);
			
			
			$this->load->view('usulan/form_usulan',$d);
			
		}else{
			header('location:'.base_url());
		}
	}
	
		public function cari_inventaris()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			$kodecab = $this->session->userdata('kodecab');
			if(empty($cari)){
				$where = " WHERE kodecab='$kodecab'";
			}else{
				$where = " WHERE idasset LIKE '%$cari%' OR  item LIKE '%$cari%'";
			}
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM data_asset $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/usulan/index/';
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
			

			$text = "SELECT * FROM data_asset $where ORDER BY idasset ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			$d['content'] = $this->load->view('usulan/cari_data_inventaris',$d);		
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cari_detail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			if(empty($cari)){
				$where = "";
			}else{
				$where = " WHERE detail LIKE '%$cari%' OR  jenis LIKE '%$cari%'";
			}
			//paging
			$page=$this->uri->segment(4);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM master_usulan $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/usulan/cari_detail/index/';
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
			

			$text = "SELECT * FROM master_usulan $where ORDER BY detail ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			$d['content'] = $this->load->view('usulan/cari_data_usulan',$d);		
			
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file usulan.php */
/* Location: ./application/controllers/usulan.php */