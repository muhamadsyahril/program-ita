<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_update extends CI_Model {
	
	function activeStatus($id){
		
		$sql = "UPDATE ".$_SESSION['modul_aktif']." SET `status` =ABS(`status` -1) WHERE id='".$id."'";
		return $this->db->query($sql);
		
	}
	
	function getEditData($id){
		
		$sql = "SELECT * FROM ".$_SESSION['modul_aktif']." WHERE id='".$id."'";
		return $this->db->query($sql)->result_array();
		
	}
	
	function updateModul($table,$data){

		$sql = "UPDATE ".$table." SET table_name='".$data['tableName']."', modul_name='".$data['modulname']."'
			, url_alias='".$data['urlAlias']."', parent='".$data['modulGroup']."', update_by ='".$_SESSION['user_data']['id']."',update_date = now()  WHERE id='".$data['id']."'";
		return $this->db->query($sql);
	
	}
	
	function updateUser($table,$data){


		$sql = "UPDATE ".$table." SET no_induk='".$data['noinduk']."', username='".$data['username']."', update_date = now()  WHERE id='".$data['id']."'";
		return $this->db->query($sql);

		
	}
	
	function updateRole($table,$data){
		$sql = "UPDATE ".$table." SET role_name='".$data['rolename']."', update_by ='".$_SESSION['user_data']['id']."',update_date = now()  WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	function updatePage($table,$data){
		$sql = "UPDATE ".$table." SET page_name='".$data['pagename']."', url_alias ='".$data['urlAlias']."', parent_page ='".$data['pageGroup']."', 
		type ='".$data['typePage']."', kategory_page='".$data['categoryPage']."', content_page='".$data['contentPage']."', update_by ='".$_SESSION['user_data']['id']."',update_date = now()  WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	function updatePost($table,$data){
		$sql = "UPDATE ".$table." SET post_title='".$data['postTitle']."', url_alias ='".$data['urlAlias']."', kategori_id ='".$data['postKategori']."', 
		post_images ='".$data['postimageurl']."', post_content='".$data['postContent']."', update_by ='".$_SESSION['user_data']['id']."',update_date = now()  WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	function updateArea($table,$data){
		$sql = "UPDATE ".$table." SET nm_area='".$data['nmarea']."', wilayah ='".$data['nmwilayah']."' WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	function updateSalesman($table,$data){
		$sql = "UPDATE ".$table." SET no_induk='".$data['noinduk']."', nama ='".$data['namasales']."', kd_area ='".$data['nmarea']."' WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	function updatePelanggan($table,$data){
		$sql = "UPDATE ".$table." 
		SET nmPel='".$data['namapel']."', 
		alamat ='".$data['alamatpel']."', 
		tgl_lahir ='".$data['tgllahir']."',
		tptLahir ='".$data['tptlahir']."', 
		nonpwp ='".$data['npwp']."', 
		noidnts ='".$data['noindentitas']."',  
		idarea ='".$data['nmarea']."', 
		siup ='".$data['siup']."' 
		WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
		function updateBarang($table,$data){
		$sql = "UPDATE ".$table." SET 
			nmBrg='".$data['nmbarang']."',
			detail ='".$data['detail']."',  
			satuan ='".$data['satuan']."', 
			qty ='".$data['qty']."', 
			harga ='".$data['harga']."' 
			WHERE id='".$data['id']."'";
		return $this->db->query($sql);
		
	}
	
	
	
}