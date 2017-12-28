<?php if(!defined('BASEPATH'))exit("No direct script access allowed");

class App extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			Header('Location:'.base_url().'index.php/dashboard/');
		}else{
			$this->load->view('login_view');
		}
	}
	
	function login_act(){
		$this->form_validation->set_rules('user_id','ID Pengguna','required');
		$this->form_validation->set_rules('user_pass','Password Pengguna','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('change_result',"<div id='notif' style='z-index: 999999;width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);z-index: 999999;'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
			Header('Location:'.base_url().'index.php/app/');
		}else{
			$User_ID = $this->input->post('user_id');
			$User_Pass = $this->input->post('user_pass');
			$validation = $this->db->query("select * from tbl_SlipSetor_Ms_User where User_ID = '".$User_ID."' and User_Pass = '".$User_Pass."'");
			if($validation->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='z-index: 999999;width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);z-index: 999999;'>Maaf, ID atau Password yang anda masukkan salah.<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/app/');
			}else{
				foreach($validation->result() as $login){
					$login_data['idu'] = $login->ObjectID;
					$login_data['user_id'] = $login->User_ID;
					$login_data['password'] = $login->User_Pass;
					$login_data['name'] = $login->User_Name;
					$login_data['status'] = $login->User_Status;
					$login_data['level'] = $login->User_Lvl;
					$login_data['login_code'] = 'sukses_login';
					if($login_data['status'] == '0'){
						$this->session->set_flashdata('change_result',"<div id='notif' style='z-index: 999999;width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);z-index: 999999;'>Maaf, Akun yang anda pakai belum diaktifkan.<br/><span style='font-size:11px;'>Silahkan hubungi Divisi IT</span></div></div>");
						Header('Location:'.base_url().'index.php/app/');
					}else{
						$this->session->set_userdata($login_data);
						Header('Location:'.base_url().'index.php/dashboard/');
					}
				}
			}
		}
	}
	
	function logout_act(){
		$this->session->sess_destroy();
		$cek = $this->session->userdata('login_code');
		if($cek){
			Header('Location:'.base_url().'index.php/dashboard/');
		}else{
			Header('Location:'.base_url());
		}
	}
}

/*End of file App.php*/
/*Location:.application/controllers/app.php*/