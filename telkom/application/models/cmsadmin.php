<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsadmin extends CI_Model {
	
	
	function excute_array($sql){
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		return $rs;	
		
	}
	
	function get_session(){
		
		$sql	= "SELECT * FROM wp_usermeta WHERE user_id =1";
		$query	= $this->cmsadmin->excute_array($sql); 
		
		return $query;	
		
	}
	
	function getListModul($table){
		
		$sql	= "SELECT * FROM ".$table."";
		$query	= $this->cmsadmin->excute_array($sql);
		
		return $query;	
		
		
	}
	
	function getModul(){
		$sql	= "SELECT * FROM  modul WHERE parent= 0";
		$query	= $this->cmsadmin->excute_array($sql); 
		
		return $query;	
	
	}
	
	function getModulParent($ids){
		
		$this->db->select('*');
		$this->db->from('modul');
		$this->db->where_in('id',$ids); 
		$query = $this->db->get();
		$rs   = $query->result_array();
		
		return $rs;	
	
	}
	
	function createUserStep1($arr){
		
		$pengacak   ="17563nnPKroseMN";
		$passInput  = $arr['in_password'];
		$passEnkrip = md5($pengacak . md5($passInput) . $pengacak );
		
		$sql	= "INSERT INTO cms_user (username,email,password,ip,create_date,status) 
				   VALUES ('".$arr['in_user_name']."','".$arr['in_email']."','".$passEnkrip."','".$this->input->ip_address()."',now(),1)";
		$query	= $this->db->query($sql);
		
		return $query;	
		
	}
	
	function changePassword($pass){
	
		$pengacak   ="17563nnPKroseMN";
		$passInput  = $pass;
		$passEnkrip = md5($pengacak . md5($passInput) . $pengacak );
		
		$sql	= "UPDATE cms_user SET password ='".$passEnkrip."' WHERE id='".$_SESSION['user_data']['id']."'";
		return $query	= $this->db->query($sql);
		
		
	}
	
	public function getLoginAuth($usr,$psw)
	{
		
		
		$pengacak   ="17563nnPKroseMN";
		$u = mysql_real_escape_string($usr);
		$p = md5($pengacak . md5($psw) . $pengacak );
		$pi = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->getuser_privilage($u,$p);
		
		if(count($q_cek_login)>0)
		
		{
					$roleid = $q_cek_login[0]['roleid'];
					$role_privilage = $this->get_role_privilage($roleid);
					
					$_SESSION['logged_in'] = 'cmsMaeLoginYou';
					$_SESSION['user_data'] = $q_cek_login[0];
					$_SESSION['privilage'] = $role_privilage;
					$_SESSION['msgalert'] = $this->lang->line('6');	
					header('location:'.base_url().'backend/home');

		}
		else
		{
			
			$_SESSION['msgalert'] = $this->lang->line('7');	
			header('location:'.base_url().'backend');
		}
	}
	
	
	public function getuser_privilage($usr,$psw){
		
		if($usr == "'"){
			header('location:'.base_url().'backend');
		}else{
		
			$sql	= "SELECT * FROM  cms_user  WHERE username ='".$usr."' AND password ='".$psw."'";
			$query	= $this->cmsadmin->excute_array($sql); 
			
			return $query;
		}
		
	}
	
	public function get_role_privilage($roleid){
		
		$sql	= "SELECT  roleid, 
   					 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privilage_menu' AND roleid = t1.roleid) AS privilage_menu,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privAprove' AND roleid = t1.roleid) AS privAprove,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privUpdate' AND roleid = t1.roleid) AS privUpdate,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privCreate' AND roleid = t1.roleid) AS privCreate,
    				 (SELECT privilage_value FROM tbl_privilage WHERE privilage_name='privDelete' AND roleid = t1.roleid) AS privDelete
					FROM tbl_privilage AS T1 WHERE roleid= '".$roleid."'
					GROUP BY roleid";
		$query	= $this->cmsadmin->excute_array($sql); 
		
		return $query;	
		
	}
	
	public function backendView($current_view,$data) 
	{
		$this->load->view('backend/default/header');
		$this->load->view('backend/default/menu');
		$this->load->view($current_view,$data);
		
		return NULL;
	}
	
	public function updateBre($genflix,$pwd,$msisdn){
		$sql ="UPDATE indosat_bre SET genflixid ='".$genflix."' , password= '".$pwd."' WHERE msisdn = '".$msisdn."'";
		return $this->db->query($sql);
	
	}
	
	public function getBre() {
	$sql ="SELECT * FROM indosat_bre WHERE genflixid =''";
	$query	= $this->cmsadmin->excute_array($sql); 
	return $query;
	
	}
	
	public function getUserByEmailAndPassword($usr,$psw)
	{
		
		
		$pengacak   ="meRita!say#kepo";
		$u = mysql_real_escape_string($usr);
		$p = md5($pengacak . md5($psw) . $pengacak );
		$pi = md5(mysql_real_escape_string($psw));
		
		$sql ="SELECT * FROM tbl_user WHERE username ='".$u."' AND password='".$p."'";

		$query	= $this->db->query($sql)->result_array(); 
		return $query;
		

	}
	
	
	

	 
}