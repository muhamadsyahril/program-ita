<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_getlist extends CI_Model {
	
	function executeData($sql){
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		return $rs;	
		
	}
	
	// get count data
	function numRows($sql){
		$query	= $this->db->query($sql);
		$rs		= $query->num_rows(); 
		return $rs;	
		
	}
	
	
	function getListTable($id){
		$sql	= "SELECT modul_name,table_name,parent FROM modul WHERE id='".$id."'";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function showTables(){
		$sql	= "SHOW TABLES";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function getListAll($table,$where,$limit,$offset){
			
		$sql	= "SELECT * FROM ".$table." ".$where."  LIMIT ".$limit." OFFSET ".$offset."";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function getListAllNum($table,$where){
			
		$sql	= "SELECT * FROM ".$table." ".$where."";
		$query	= $this->numRows($sql);
		return $query;	
	}
	
	function getListAllModul(){
			
		$sql	= "SELECT * FROM modul WHERE status = 1 ORDER BY id";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function getListAllPrivilage($id){
			
		$sql	= "SELECT a.id, a.roleid, b.role_name, a.privilage_name, a.privilage_value 
					FROM tbl_privilage a, cms_role b WHERE a.roleid=b.id AND b.id='".$id."'";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	
		public function getPaging($id,$table,$limit,$where){
		
			$totalrows = $this->getListAllNum($table,$where);
			
				$config['base_url'] = BASE_URL_BACKEND. '/dolist/getlist/'.$id.'/p/';
				$config['total_rows'] = $totalrows;
				$config['per_page'] = $limit;
				$config['uri_segment'] = 6;

				$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
				$config['full_tag_close'] = '</ul>';
				
				$config['cur_tag_open'] = '<li class="active"><a href="">';
				$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
				
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				
				$config['prev_link'] = '&larr; Previous';
				$config['prev_tag_open'] = '<li class="previous-off">';
				$config['prev_tag_close'] = '</li>';
				
				$config['next_link'] = 'Next &rarr;';
				$config['next_tag_open'] = '<li class="next">';
				$config['next_tag_close'] = '</li>';
		
			$this->pagination->initialize($config);
			$paginator=$this->pagination->create_links();
			
			return $paginator;
		
	}
	
	function getTablePromo(){
		$sql	= "SELECT * FROM tbl_promo_orange WHERE status = 0 ORDER BY id DESC LIMIT 2";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function updateResponseAccount($response,$id){
		$sql	= "UPDATE tbl_promo_orange SET response_account='".$response."', status=1 WHERE user_id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;	
	}
	
	function updateResponseWallet($response){
		$sql	= "UPDATE tbl_promo_orange SET response_wallet='".$response."', status=2 WHERE user_id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;	
	}
	
	function updateResponsePackage($response){
		$sql	= "UPDATE tbl_promo_orange SET response_package='".$response."', status=3 WHERE user_id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;	
	}
	
	function getGroupModul($ids){
		
		$this->db->select('id,parent');
		$this->db->from('modul');
		$this->db->where_in('id',$ids); 
		$this->db->group_by('parent');
		//$query = $this->db->get();
		return $this->db->get()->result_array();
		//$rs   = $query->result_array();
		//return $rs;
	
	}
	function getlistBox($roleid){
		$sql	= "SELECT * FROM tbl_privilage WHERE roleid ='".$roleid."' AND privilage_name='privListGroup'";
		$query	= $this->executeData($sql);
		return $query;	
		
	}
	function getNowPriv($roleid){
		$sql	= "SELECT * FROM tbl_privilage WHERE roleid ='".$roleid."' AND privilage_name='privList'";
		$query	= $this->executeData($sql);
		return $query;	
		
	}
	
		function getListAllPrivilagecols($id){
			
		$sql	= "SELECT  roleid, 
   					 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privilage_menu' AND roleid = t1.roleid) AS privilage_menu,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privAprove' AND roleid = t1.roleid) AS privAprove,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privUpdate' AND roleid = t1.roleid) AS privUpdate,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privCreate' AND roleid = t1.roleid) AS privCreate,
					 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privListGroup' AND roleid = t1.roleid) AS privListGroup,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privDelete' AND roleid = t1.roleid) AS privDelete
					FROM tbl_privilage AS T1 WHERE roleid= '".$id."'
					GROUP BY roleid";
		$query	= $this->executeData($sql);
		
		return $query;	
	}
	
		function getRoleName($roleid){
		$sql	= "SELECT role_name FROM cms_role WHERE id ='".$roleid."'";
		$query	= $this->executeData($sql);
		return $query;	
		
	}
	
	function getAreaPetugas($id)
	{
		$sql	= "SELECT id_petugas, idarea, nama
					FROM tbl_petugas
					WHERE id_petugas =".$id;
		$query	= $this->executeData($sql);
		return $query;	

	}

	function getListAllKeluhanbyArea($areaID){
			
		$sql	= "SELECT a.*,b.id_area, b.nama_pel 
					FROM tbl_keluhan a INNER JOIN tbl_pelanggan b 
					ON a.idpel=b.id_pelanggan
					WHERE a.status='Request' AND b.id_area =".$areaID;
		$query	= $this->executeData($sql);
		return $query;	
	}

	function getListAllKeluhan(){
			
		$sql	= "SELECT a.*,b.id_area, b.nama_pel 
					FROM tbl_keluhan a INNER JOIN tbl_pelanggan b 
					ON a.idpel=b.id_pelanggan";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function getListAllJenisKeluhan(){
			
		$sql	= "SELECT * FROM tbl_jenis_keluhan";
		$query	= $this->executeData($sql);
		return $query;	
	}
	
	function getListPelangganById($id){
			
		$sql	= "select a.*, b.name_produk, c.area_name
				   from tbl_pelanggan a,tbl_produk b, tbl_area c
				   where a.id_produk=b.id_produk 
                   and a.id_area=c.id_area
                   and a.id_pelanggan=".$id;
		$query	= $this->executeData($sql);
		return $query;	
	}

	function getListKeluhanById($id){
			
		$sql	= "select * FROM tbl_keluhan WHERE idpel =".$id;
		$query	= $this->executeData($sql);
		return $query;	
	}

	function getPhonePetugas($idPelanggan){
		$sql	= "select a.id_area, d.no_telpon
				   from tbl_pelanggan a,tbl_produk b, tbl_area c, tbl_petugas d
				   where a.id_produk=b.id_produk 
                   and a.id_area=c.id_area
                   and a.id_area=d.idarea
                   and a.id_pelanggan=".$idPelanggan;
		$query	= $this->executeData($sql);
		return $query;	
	}

	 
	
	
}