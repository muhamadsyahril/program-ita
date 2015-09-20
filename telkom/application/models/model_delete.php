<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_delete extends CI_Model {

	function delete($id){
		
		$sql = "DELETE FROM ".$_SESSION['modul_aktif']."  WHERE id='".$id."'";
	    return $this->db->query($sql);
		
	}
	
	

	
}