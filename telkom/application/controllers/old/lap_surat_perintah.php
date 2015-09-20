<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_surat_perintah extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
			$tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
			
			$d['tgl1'] =$this->input->post('tgl1');
			$d['tgl2'] =$this->input->post('tgl2');
			
			if(empty($tgl1) && empty($tgl2)){
				$where = " WHERE perihal=''";
			}else{
				$where = " WHERE tanggal>='$tgl1' AND tanggal<='$tgl2'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Laporan Surat Perintah";
			
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			
			$text = "SELECT * FROM surat_perintah $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/surat_perintah/index/';
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
			

			$text = "SELECT * FROM surat_perintah $where 
					ORDER BY tanggal,nomor_surat DESC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('v_lap_surat_perintah', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
			$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
			
			$d['tgl1'] =$this->uri->segment(3);
			$d['tgl2'] =$this->uri->segment(4);
			
			
			if(empty($tgl1) && empty($tgl2)){
				$where = " WHERE perihal=''";
			}else{
				$where = " WHERE tanggal>='$tgl1' AND tanggal<='$tgl2'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Surat Perintah";

			$text = "SELECT * FROM surat_perintah $where 
					ORDER BY tanggal,nomor_surat";
			$d['data'] = $this->app_model->manualQuery($text);
			
					
			$this->load->view('cetak_surat_perintah',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cetak_excel()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
			$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
			
			$d['tgl1'] =$this->uri->segment(3);
			$d['tgl2'] =$this->uri->segment(4);
			
			
			if(empty($tgl1) && empty($tgl2)){
				$where = " WHERE perihal=''";
			}else{
				$where = " WHERE tanggal>='$tgl1' AND tanggal<='$tgl2'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Surat Perintah";

			$text = "SELECT * FROM surat_perintah $where 
					ORDER BY tanggal,nomor_surat";
			$d['data'] = $this->app_model->manualQuery($text);
			
					
			$this->load->view('cetak_excel_surat_perintah',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */