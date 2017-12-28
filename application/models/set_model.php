<?php
	if(!defined('BASEPATH'))exit('No Direct Script Access Allowed');
	
	class Set_Model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		public function validation_login($user_id, $password,$pos){
			$query_validasi_login = $this->db->query("select * from Ms_User where user_id='".$user_id."' and password='".$password."' and position='".$pos."'");
			return $query_validasi_login;
		}
		
		public function insert_data($table, $data){
			//$this->load->database('default',FALSE,TRUE);
			return $this->db->insert($table,$data);
		}
		
		function update_data($table, $pk, $id, $data){
			//$this->load->database('default',FALSE,TRUE);
			$this->db->where($pk,$id);
			return $this->db->update($table,$data);
		}
	}

/*End of file sg_model.php*/
/*Location:.application/model/sg_model.php*/