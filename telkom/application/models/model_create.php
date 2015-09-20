<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_create extends CI_Model {
	
	
	function excute_array($sql){
		$query	= $this->db->query($sql); 
		$rs = $query->result_array();
		return $rs;	
		
	}
	
	function getModulGroup(){
		$sql	= "SELECT * FROM modul WHERE status ='2'";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
	function addSave($table,$data){	
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	
	function updateUrl($id,$url){
		$sql	= "UPDATE modul SET url='".$url."' WHERE id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;
		
	}
	
	function getRoleGroup(){
		$sql	= "SELECT * FROM cms_role WHERE status ='1'";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
	function insertPrivilages($roleid,$name,$value){
		$sql ="INSERT INTO tbl_privilage (roleid,privilage_name,privilage_value,create_date)
				VALUES('".$roleid."','".$name."','".$value."',now())";
		return $query = $this->db->query($sql);
		
	}
	
	function updatePrivilages($roleid,$name,$value){
		$sql ="UPDATE tbl_privilage SET privilage_name = '".$name."', privilage_value ='".$value."' WHERE roleid='".$roleid."' AND privilage_name='privList'";
		return $query = $this->db->query($sql);
		
	}
	
	function delPrivnoyus(){
		$sql ="DELETE FROM tbl_privilage WHERE privilage_name ='ceklistbox' OR privilage_name ='tbSave' OR privilage_name ='roleid'";	
		return $query = $this->db->query($sql);
	}
	
		function delPrivAll($roleid){
		$sql ="DELETE FROM tbl_privilage WHERE roleid='".$roleid."'";	
		return $query = $this->db->query($sql);
	}
	
	
	  function getPageGroup(){
		$sql	= "SELECT * FROM tbl_page WHERE type ='group'";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
	  function getArea(){
		$sql	= "SELECT * FROM tbl_area";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
		function updateUrlPage($id,$url){
		$sql	= "UPDATE tbl_page SET url='".$url."' WHERE id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;
		
	}
	
	 function getKategori(){
		$sql	= "SELECT * FROM tbl_kategori WHERE status =1";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
	 function getSalesman(){
		$sql	= "SELECT no_induk, nama FROM tbl_salesman WHERE status =1";
		$query	= $this->model_create->excute_array($sql);
		return $query;	
		
	}
	
	function checkCategory($categoryname){
		
		$sql	= "SELECT * FROM tbl_kategori WHERE kategori_name = '".$categoryname."'";
		$query	= $this->db->query($sql)->num_rows();
		return $query;
		
	}
	
	function insertCategory($categoryname){
		$sql	= "INSERT INTO tbl_kategori (kategori_name,status,create_date)
					VALUES('".$categoryname."',1,now())";	
	    $query = $this->db->query($sql);
		return $query;
		
	}
	
	function updateUrlPost($id,$url){
		$sql	= "UPDATE tbl_post SET url='".$url."' WHERE id='".$id."'";
		$query	= $this->db->query($sql);
		return $query;
		
	}

	function cekDataKeluhan($id)
	{
		$sql	= "SELECT count(idkel) as jlh FROM tbl_keluhan WHERE idpel ='".$id."' AND status ='Request'";
		$query	= $this->model_create->excute_array($sql);
		return $query;
	}
	function createKeluhan($jenis, $keluhan, $id, $tiket)
	{
		$sql	= "INSERT INTO tbl_keluhan  (notiket, idpel, jenis, keluhan, status, tgl_keluhan)
					VALUES('".$tiket."', '".$id."', '".$jenis."','".$keluhan."','Request', now())";	
	    $query = $this->db->query($sql);
		return $query;
	}


		function inputDataSolusi($id, $solusi)
	{
		$sql	= "UPDATE tbl_keluhan SET solusi ='".$solusi."', 
								status ='Response', tgl_realisasi =now() WHERE idkel=".$id;	
	    $query = $this->db->query($sql);
		return $query;
	}


}