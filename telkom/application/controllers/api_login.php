<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

require APPPATH . '/libraries/nusoap.php';

class Api_login extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
	}
	
	function index()
	{
		
		
   		if (isset($_POST['tag']) && $_POST['tag'] != '') {

			$tag = $_POST['tag'];
			$response = array("tag" => $tag, "success" => 0, "error" => 0);

				if ($tag == 'login') {

					$username = $_POST['username'];
					$password = $_POST['password'];

					$this->load->model("cmsadmin");
					$user = $this->cmsadmin->getUserByEmailAndPassword($username, $password);
		
						if (count($user) == 1) {
			
							$response["success"] = 1; 
							$response["user"]["uid"] = $user[0]["nomerid_pel_pet"];
							$response["user"]["name"] = $user[0]["username"];
							$response["user"]["menu"] = $user[0]["level"];
							$response["user"]["created_at"] = date("Y-m-d H:i:s");
							
			
							$resp = json_encode($response);
							echo $resp;	
			
							} else {

								$response["error"] = 1;
								$response["error_msg"] = "Incorrect email or password!";
								$resp = json_encode($response);
								echo $resp;
						}
				} elseif($tag == 'getkeluhan') {

					$id = $_POST['idpetugas'];

					$this->load->model("model_getlist");
					$idarea = $this->model_getlist->getAreaPetugas($id);
					$idarea = $idarea[0]['idarea'];
					$response = $this->model_getlist->getListAllKeluhanbyArea($idarea);
					//print_r($response);
					//$response = $response[0];
					$response[0]["tgl"] = $response[0]['tgl_keluhan']." - ".$response[0]['nama_pel'];
					$resp = json_encode($response);
					echo "{\"keluhan\":" . $resp . "}";


				} elseif($tag == 'getallkeluhan') {

	
					$this->load->model("model_getlist");
			
					$response = $this->model_getlist->getListAllKeluhan();
					
					$resp = json_encode($response);
					echo "{\"keluhan\":" . $resp . "}";
					
			
				} elseif($tag == 'inputkeluhan') {
				

					$jenis = $_POST['jenis'];
					$keluhan = $_POST['keluhan'];
					$idpelanggan = $_POST['idpelanggan'];
					$notiket = date("dmYHis");

					
					$this->load->model(array("model_create", "model_getlist"));

				
					$countKel = $this->model_create->cekDataKeluhan($idpelanggan);
					$countKel = $countKel[0]['jlh'];
					
					if($countKel == 0)
					{
						$id = $this->model_create->createKeluhan($jenis, $keluhan, $idpelanggan, $notiket);
							if($id)
							{
								$rs = $this->model_getlist->getPhonePetugas($idpelanggan);

								$userkey ="Pradesya";
								$passkey ="ee432c6e3903d8aa5f19da9ab4b8c85e";

								$nohptujuan = $rs[0]['no_telpon'];
								$pesan  = "idpelanggan".$idpelanggan."keluhan".$keluhan;

								$urlsoap = 'http://116.213.48.103/api.php';
								
								$client = new nusoap_client($urlsoap);
								$result = $client->call('sendsms', array('destination' => $nohptujuan, 'message' => $pesan, 'username' => $userkey, 'apikey' => $passkey));
	
								$response["success"] = 1; 

							}
						$resp = json_encode($response);
						echo $resp;
					}
					else
					{
						$response["success"] = 0;
						$resp = json_encode($response);
						echo $resp;
					}


				} elseif($tag == 'inputsolusi') {
				

					$id 	= $_POST['idkeluhan'];
					$solusi = $_POST['solusi'];
				
					$this->load->model("model_create");

					$query = $this->model_create->inputDataSolusi($id, $solusi);

					if($query)
					{
						$response["success"] = 1; 
						$resp = json_encode($response);
						echo $resp;
					}
					else
					{
						$response["success"] = 0;
						$resp = json_encode($response);
						echo $resp;
					}
					
				} elseif($tag == 'jeniskeluhan') {

					$this->load->model("model_getlist");
					$response = $this->model_getlist->getListAllJenisKeluhan();
					
					$resp = json_encode($response);
					
					echo "{\"keluhan\":" . $resp . "}";
					
	
						
				} elseif($tag == 'getpelanggan') {

					$idpelanggan = $_POST['nomerid'];
					$this->load->model("model_getlist");
					$response = $this->model_getlist->getListPelangganById($idpelanggan);
					$resp = json_encode($response);
					echo "{\"pelanggan\":" . $resp . "}";

				} elseif($tag == 'keluhanbyid') {

					$idpelanggan = $_POST['nomerid'];
					$this->load->model("model_getlist");
					$response = $this->model_getlist->getListKeluhanById($idpelanggan);
					$resp = json_encode($response);
					echo "{\"keluhan\":" . $resp . "}";
					
				
					
				} else {
					echo "Invalid Request";
			}
		} else {
			echo "Access Denied";
		}

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/telkom/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");

	}
	

}