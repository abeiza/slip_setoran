<?php if(!defined('BASEPATH'))exit('No direct SCript access allowed');

class dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$cek_transaksi = $this->db->query("select distinct Trans_No from tbl_SlipSetor_Transaction");
			$data['cek_trans'] = $cek_transaksi->num_rows();

			$cek_penerima = $this->db->query("select distinct ObjectID from tbl_SlipSetor_Ms_Receiver");
			$data['cek_penerima'] = $cek_penerima->num_rows();

			$cek_form = $this->db->query("select distinct ObjectID from tbl_SlipSetor_Ms_Slip where Slip_Status = 1");
			$data['cek_form'] = $cek_form->num_rows();

			$data['table_trans'] = $this->db->query("select Bank_Name, Slip_Name, count(Trans_Amount) as Count_Trans, sum(Trans_Amount) as Sum_Trans from View_EVAN_SlipSetor_Transaction
where Year(Trans_DT) = Year(NOW())
group by Bank_Name, Slip_Name");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('dashboard_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER BANK
	//
	//-----------------------------------------------------------------

	function master_bank_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['query_list_bank'] = $this->db->query("select * from tbl_SlipSetor_Ms_Bank order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_bank_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_bank(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('kode_bank','Kode Bank','required|trim');
			$this->form_validation->set_rules('nama_bank','Nama Bank','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
			}else{
				$kd_bank = $this->input->post('kode_bank');
				$nama_bank = $this->input->post('nama_bank');
				$keterangan_bank = $this->input->post('keterangan_bank');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Bank where Bank_ID = '".$kd_bank."'");
				if($query_check->num_rows() == 0){
					$data['Bank_ID'] = $kd_bank;
					$data['Bank_Name'] = $nama_bank;
					$data['Bank_Desc'] = $keterangan_bank;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Bank', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data bank berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar bank telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode bank yang baru anda input telah digunakan oleh record lain.<br/><span style='font-size:11px;'>Mohon cari kode lainnya!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_bank($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_bank = $this->uri->segment(3);
			$check_bank = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Bank where ObjectID = '".$id_bank."'");
			if($check_bank->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah nama profil berhasil, <br/><span style='font-size:11px;'>Nama akun anda telah terupdate!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Bank where ObjectID = '".$id_curr."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar mata uang telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_bank($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_curr = $this->uri->segment(3);
			$check_cur = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Bank where ObjectID = '".$id_curr."'");
			if($check_cur->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Bank where ObjectID='".$id."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_bank(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_kode_bank','Kode Bank','required|trim');
			$this->form_validation->set_rules('e_nama_bank','Nama Bank','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode bank tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$kd_bank = $this->input->post('e_kode_bank');
				$nama_bank = $this->input->post('e_nama_bank');
				$keterangan_bank = $this->input->post('e_keterangan_bank');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Bank where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode bank tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
				}else{
					$id = $objectid;
					$data['Bank_ID'] = $kd_bank;
					$data['Bank_Name'] = $nama_bank;
					$data['Bank_Desc'] = $keterangan_bank;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Bank', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data bank berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar bank telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data bank gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_bank_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER CURR
	//
	//-----------------------------------------------------------------

	function master_curr_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['query_list_curr'] = $this->db->query("select * from tbl_SlipSetor_Ms_Curr order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_curr_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_curr(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('kd_mata_uang','Kode Mata Uang','required|trim');
			$this->form_validation->set_rules('mata_uang','Mata Uang','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
			}else{
				$kd_mata_uang = $this->input->post('kd_mata_uang');
				$mata_uang = $this->input->post('mata_uang');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Curr where Curr_ShotID = '".$kd_mata_uang."'");
				if($query_check->num_rows() == 0){
					$data['Curr_ShotID'] = $kd_mata_uang;
					$data['Curr_Name'] = $mata_uang;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Curr', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar mata uang telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode mata uang yang baru anda input telah digunakan oleh record lain.<br/><span style='font-size:11px;'>Mohon cari kode lainnya!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_curr($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_curr = $this->uri->segment(3);
			$check_cur = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Curr where ObjectID = '".$id_curr."'");
			if($check_cur->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>data mata uang yang anda maksudkan tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Curr where ObjectID = '".$id_curr."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar mata uang telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_curr($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_curr = $this->uri->segment(3);
			$check_cur = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Curr where ObjectID = '".$id_curr."'");
			if($check_cur->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Curr where ObjectID='".$id."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_curr(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('kd_mata_uang','Kode Mata Uang','required|trim');
			$this->form_validation->set_rules('mata_uang','Mata Uang','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$kd_mata_uang = $this->input->post('kd_mata_uang');
				$mata_uang = $this->input->post('mata_uang');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Curr where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode mata uang tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
				}else{
					$id = $objectid;
					$data['Curr_ShotID'] = $kd_mata_uang;
					$data['Curr_Name'] = $mata_uang;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Curr', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar mata uang telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_curr_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}



	//-----------------------------------------------------------------
	//
	//                          MASTER CURRATE
	//
	//-----------------------------------------------------------------

	function master_currate_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['query_list_currate'] = $this->db->query("select tbl_SlipSetor_Ms_CurrRate.*, tbl_SlipSetor_Ms_Bank.Bank_Name, tbl_SlipSetor_Ms_Curr.Curr_Name from tbl_SlipSetor_Ms_CurrRate inner join tbl_SlipSetor_Ms_Bank on tbl_SlipSetor_Ms_CurrRate.Bank_ID = tbl_SlipSetor_Ms_Bank.ObjectID inner join tbl_SlipSetor_Ms_Curr on tbl_SlipSetor_Ms_CurrRate.Curr_ID = tbl_SlipSetor_Ms_Curr.ObjectID order by tbl_SlipSetor_Ms_CurrRate.ObjectID desc");
			$data['query_list_bank'] = $this->db->query("select ObjectID, Bank_ID, Bank_Name from tbl_SlipSetor_Ms_Bank order by Bank_Name");
			$data['query_list_curr'] = $this->db->query("select ObjectID, Curr_ShotID, Curr_Name from tbl_SlipSetor_Ms_Curr order by Curr_Name");
			$data['query_list_bank_e'] = $this->db->query("select ObjectID, Bank_ID, Bank_Name from tbl_SlipSetor_Ms_Bank order by Bank_Name");
			$data['query_list_curr_e'] = $this->db->query("select ObjectID, Curr_ShotID, Curr_Name from tbl_SlipSetor_Ms_Curr order by Curr_Name");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_currate_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_currate(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('year','tahun','required');
			$this->form_validation->set_rules('month','bulan','required');
			$this->form_validation->set_rules('bank_id','bank','required');
			$this->form_validation->set_rules('curr_id','mata uang','required');
			$this->form_validation->set_rules('rate','rate','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
			}else{
				$tahun = $this->input->post('year');
				$bulan = $this->input->post('month');
				$bank_id = $this->input->post('bank_id');
				$mata_uang = $this->input->post('curr_id');
				$rate = $this->input->post('rate');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_CurrRate where bank_id = '".$bank_id."' and Year = '".$tahun."' and Month = '".$bulan."' and Curr_ID = '".$mata_uang."'");
				if($query_check->num_rows() == 0){
					$data['Year'] = $tahun;
					$data['Month'] = $bulan;
					$data['Bank_ID'] = $bank_id;
					$data['Curr_ID'] = $mata_uang;
					$data['Rate'] = $rate;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_CurrRate', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data kurs mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar kurs mata uang telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data kurs mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode kurs mata uang yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_currate($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_currate = $this->uri->segment(3);
			$check_cur = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_CurrRate where ObjectID = '".$id_currate."'");
			if($check_cur->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data kurs mata uang tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_CurrRate where ObjectID = '".$id_currate."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data kurs mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar kurs mata uang telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data kurs mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_currate($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_currate = $this->uri->segment(3);
			$check_cur = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_CurrRate where ObjectID = '".$id_currate."'");
			if($check_cur->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_CurrRate where ObjectID='".$id_currate."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_currate(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_bank_id','bank','required|trim');
			$this->form_validation->set_rules('e_curr_id','mata uang','required|trim');
			$this->form_validation->set_rules('e_year','tahun','required|trim');
			$this->form_validation->set_rules('e_month','bulan','required|trim');
			$this->form_validation->set_rules('e_rate','rate','required|trim');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$e_bank_id = $this->input->post('e_bank_id');
				$e_curr_id = $this->input->post('e_curr_id');
				$e_year = $this->input->post('e_year');
				$e_month = $this->input->post('e_month');
				$e_rate = $this->input->post('e_rate');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_CurrRate where bank_id = '".$e_bank_id."' and Year = '".$e_year."' and Month = '".$e_month."' and Curr_ID = '".$e_curr_id."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode kurs mata uang tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
				}else{
					$id = $objectid;
					$data['Bank_ID'] = $e_bank_id;
					$data['Curr_ID'] = $e_curr_id;
					$data['Year'] = $e_year;
					$data['Month'] = $e_month;
					$data['Rate'] = $e_rate;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_CurrRate', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data kurs mata uang berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar kurs mata uang telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data kurs mata uang gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_currate_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	//-----------------------------------------------------------------
	//
	//                          MASTER DEPOSITOR
	//
	//-----------------------------------------------------------------

	function master_depositor_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_depositor_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_depositor_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_depositor(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('depositor_name','Nama Penyetor','required');
			$this->form_validation->set_rules('depositor_status','Status Penyetor','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
			}else{
				$Depositor_Name = $this->input->post('depositor_name');
				$Depositor_Address = $this->input->post('depositor_address');
				$Depositor_Phone = $this->input->post('depositor_phone');
				$Depositor_Rec = $this->input->post('depositor_rec');
				$Depositor_Status = $this->input->post('depositor_status');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor where depositor_name = '".$Depositor_Name."'");
				if($query_check->num_rows() == 0){
					$data['Depositor_Name'] = $Depositor_Name;
					$data['Depositor_Address'] = $Depositor_Address;
					$data['Depositor_Phone'] = $Depositor_Phone;
					$data['Depositor_Rec'] = $Depositor_Rec;
					$data['Depositor_Status'] = $Depositor_Status;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Depositor', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data penyetor berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar penyetor telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data penyetor gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode penyetor yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_depositor($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Depositor where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data penyetor tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Depositor where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data penyetor berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar rekening telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data rekening gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_depositor($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Depositor where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_depositor(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_depositor_name','Nama Penyetor','required');
			$this->form_validation->set_rules('e_depositor_status','Status Penyetor','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$Depositor_Name = $this->input->post('e_depositor_name');
				$Depositor_Address = $this->input->post('e_depositor_address');
				$Depositor_Phone = $this->input->post('e_depositor_phone');
				$Depositor_Rec = $this->input->post('e_depositor_rec');
				$Depositor_Status = $this->input->post('e_depositor_status');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode penyetor tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
				}else{
					$id = $objectid;
					$data['Depositor_Name'] = $Depositor_Name;
					$data['Depositor_Address'] = $Depositor_Address;
					$data['Depositor_Phone'] = $Depositor_Phone;
					$data['Depositor_Rec'] = $Depositor_Rec;
					$data['Depositor_Status'] = $Depositor_Status;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Depositor', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data penyetor berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar rekening telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data penyetor gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_depositor_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	//-----------------------------------------------------------------
	//
	//                          MASTER RECEIVER
	//
	//-----------------------------------------------------------------

	function master_receiver_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_receiver_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_receiver_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_receiver(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('receiver_name','Nama Penerima','required');
			$this->form_validation->set_rules('receiver_status','Status Penerima','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
			}else{
				$Receiver_Name = $this->input->post('receiver_name');
				$Receiver_Address = $this->input->post('receiver_address');
				$Receiver_Phone = $this->input->post('receiver_phone');
				$Receiver_Rec = $this->input->post('receiver_rec');
				$Receiver_Status = $this->input->post('receiver_status');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver where receiver_name = '".$Receiver_Name."'");
				if($query_check->num_rows() == 0){
					$data['Receiver_Name'] = $Receiver_Name;
					$data['Receiver_Address'] = $Receiver_Address;
					$data['Receiver_Phone'] = $Receiver_Phone;
					$data['Receiver_Rec'] = $Receiver_Rec;
					$data['Receiver_Status'] = $Receiver_Status;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Receiver', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data penerima berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar penerima telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data penerima gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode penerima yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_receiver($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Receiver where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data penerima tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Receiver where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data penerima berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar penerima telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data penerima gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_receiver($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Receiver where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_receiver(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_receiver_name','Nama Penerima','required');
			$this->form_validation->set_rules('e_receiver_status','Status Penerima','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$Receiver_Name = $this->input->post('e_receiver_name');
				$Receiver_Address = $this->input->post('e_receiver_address');
				$Receiver_Phone = $this->input->post('e_receiver_phone');
				$Receiver_Rec = $this->input->post('e_receiver_rec');
				$Receiver_Status = $this->input->post('e_receiver_status');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode penerima tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
				}else{
					$id = $objectid;
					$data['Receiver_Name'] = $Receiver_Name;
					$data['Receiver_Address'] = $Receiver_Address;
					$data['Receiver_Phone'] = $Receiver_Phone;
					$data['Receiver_Rec'] = $Receiver_Rec;
					$data['Receiver_Status'] = $Receiver_Status;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Receiver', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data penerima berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar penerima telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data penerima gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_receiver_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER USER
	//
	//-----------------------------------------------------------------

	function master_user_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_user_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_User order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_user_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_user(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('user_name','Nama Pengguna','required');
			$this->form_validation->set_rules('user_id','ID Pengguna','required');
			$this->form_validation->set_rules('user_pass','Password Pengguna','required');
			$this->form_validation->set_rules('user_status','Status Pengguna','required');
			$this->form_validation->set_rules('user_lvl','Level Pengguna','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
			}else{
				$User_Name = $this->input->post('user_name');
				$User_ID = $this->input->post('user_id');
				$User_Pass = $this->input->post('user_pass');
				$User_Status = $this->input->post('user_status');
				$User_Lvl = $this->input->post('user_lvl');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_User where User_Name = '".$User_Name."'");
				if($query_check->num_rows() == 0){
					$data['User_Name'] = $User_Name;
					$data['User_ID'] = $User_ID;
					$data['User_Pass'] = $User_Pass;
					$data['User_Status'] = $User_Status;
					$data['User_Lvl'] = $User_Lvl;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_User', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data pengguna berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar pengguna telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data pengguna gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode pengguna yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_user($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_User where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data pengguna tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_User where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data pengguna berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar pengguna telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data pengguna gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_user($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_User where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_User where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_user(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_user_name','Nama Pengguna','required');
			$this->form_validation->set_rules('e_user_id','ID Pengguna','required');
			$this->form_validation->set_rules('e_user_pass','Password Pengguna','required');
			$this->form_validation->set_rules('e_user_status','Status Pengguna','required');
			$this->form_validation->set_rules('e_user_lvl','Level Pengguna','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$User_Name = $this->input->post('e_user_name');
				$User_ID = $this->input->post('e_user_id');
				$User_Pass = $this->input->post('e_user_pass');
				$User_Status = $this->input->post('e_user_status');
				$User_Lvl = $this->input->post('e_user_lvl');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_User where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode pengguna tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
				}else{
					$id = $objectid;
					$data['User_Name'] = $User_Name;
					$data['User_ID'] = $User_ID;
					$data['User_Pass'] = $User_Pass;
					$data['User_Status'] = $User_Status;
					$data['User_Lvl'] = $User_Lvl;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_User', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data pengguna berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar pengguna telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data pengguna gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_user_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER SETUP VARIABEL
	//
	//-----------------------------------------------------------------

	function master_var_list($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id = $this->uri->segment(3);
			$data['master_var_list'] = $this->db->query("select var.*, slip.Slip_Name_e as Slip_Name from tbl_SlipSetor_SetupSlip_Var as var inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$id."' order by var.ObjectID desc");
			$data['query_list_slip'] = $this->db->query("select slip.*, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Bank as bank on slip.Bank_ID = bank.ObjectID order by bank.Bank_Name,slip.Slip_Name_e");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_var_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_var($Slip_ID){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('field','Field','required');
			$this->form_validation->set_rules('label','Label','required');
			$this->form_validation->set_rules('tipe_data','Tipe Data','required');
			$this->form_validation->set_rules('margin_top','Margin Top','required');
			$this->form_validation->set_rules('margin_left','Margin Left','required');

			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
			}else{
				$Slip_ID = $this->uri->segment(3);
				$Slip_Field = $this->input->post('field');
				$Slip_Var_Name = $this->input->post('label');
				$Slip_Var_Type = $this->input->post('tipe_data');
				$Slip_Var_Margin_Top = $this->input->post('margin_top');
				$Slip_Var_Margin_Left = $this->input->post('margin_left');
				$Slip_Var_Align = $this->input->post('align');
				$Slip_Var_Border = $this->input->post('border');
				$Slip_Var_Group = $this->input->post('group');
				$Slip_Var_Function = $this->input->post('function');
				$Slip_Var_Css = $this->input->post('css');
				$query_check = $this->db->query("select * from tbl_SlipSetor_SetupSlip_Var where Slip_Field = '".$Slip_Field."'");
				if($query_check->num_rows() == 0){
					$data['Slip_ID'] = $Slip_ID;
					$data['Slip_Field'] = $Slip_Field;
					$data['Slip_Var_Name'] = $Slip_Var_Name;
					$data['Slip_Var_Type'] = $Slip_Var_Type;
					$data['Slip_Var_Margin_Top'] = $Slip_Var_Margin_Top;
					$data['Slip_Var_Margin_Left'] = $Slip_Var_Margin_Left;
					$data['Slip_Var_Align'] = $Slip_Var_Align;
					$data['Slip_Var_Border'] = $Slip_Var_Border;
					$data['Slip_Var_Group'] = $Slip_Var_Group;
					$data['Slip_Var_Function'] = $Slip_Var_Function;
					$data['Slip_Var_Css'] = $Slip_Var_Css;
					$input = $this->set_model->insert_data('tbl_SlipSetor_SetupSlip_Var', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data variabel berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar variabel telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data variabel gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode variabel yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_var($id_rec, $id_rec2){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$id_rec2 = $this->uri->segment(4);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_SetupSlip_Var where ObjectID = '".$id_rec2."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data variabel tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_SetupSlip_Var where ObjectID = '".$id_rec2."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data variabel berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar variabel telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data variabel gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_var($id, $id2){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id = $this->uri->segment(3);
			$id2 = $this->uri->segment(4);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_SetupSlip_Var where ObjectID = '".$id2."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_SetupSlip_Var where ObjectID='".$id2."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_var($Slip_ID){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('e_field','Field','required');
			$this->form_validation->set_rules('e_label','Label','required');
			$this->form_validation->set_rules('e_tipe_data','Tipe Data','required');
			$this->form_validation->set_rules('e_margin_top','Margin Top','required');
			$this->form_validation->set_rules('e_margin_left','Margin Left','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
			}else{
				$objectid = $this->input->post('objectid');
				$Slip_ID = $this->uri->segment(3);
				$Slip_Field = $this->input->post('e_field');
				$Slip_Var_Name = $this->input->post('e_label');
				$Slip_Var_Type = $this->input->post('e_tipe_data');
				$Slip_Var_Margin_Top = $this->input->post('e_margin_top');
				$Slip_Var_Margin_Left = $this->input->post('e_margin_left');
				$Slip_Var_Align = $this->input->post('e_align');
				$Slip_Var_Border = $this->input->post('e_border');
				$Slip_Var_Group = $this->input->post('e_group');
				$Slip_Var_Function = $this->input->post('e_function');
				$Slip_Var_CSS = $this->input->post('e_css');
				$query_check = $this->db->query("select * from tbl_SlipSetor_SetupSlip_Var where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode variabel tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
				}else{
					$id = $objectid;
					$data['Slip_ID'] = $Slip_ID;
					$data['Slip_Field'] = $Slip_Field;
					$data['Slip_Var_Name'] = $Slip_Var_Name;
					$data['Slip_Var_Type'] = $Slip_Var_Type;
					$data['Slip_Var_Margin_Top'] = $Slip_Var_Margin_Top;
					$data['Slip_Var_Margin_Left'] = $Slip_Var_Margin_Left;
					$data['Slip_Var_Align'] = $Slip_Var_Align;
					$data['Slip_Var_Border'] = $Slip_Var_Border;
					$data['Slip_Var_Group'] = $Slip_Var_Group;
					$data['Slip_Var_Function'] = $Slip_Var_Function;
					$data['Slip_Var_Css'] = $Slip_Var_CSS;
					$update = $this->set_model->update_data('tbl_SlipSetor_SetupSlip_Var', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data variabel berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar variabel telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data variabel gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_var_list/'.$this->uri->segment(3));
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER TYPE
	//
	//-----------------------------------------------------------------

	function master_type_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_type_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip order by ObjectID desc");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_type_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_type(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('slip_name','Nama Slip','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
			}else{
				$Slip_Name = $this->input->post('slip_name');
				$Slip_Desc = $this->input->post('slip_desc');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip where Slip_Name = '".$Slip_Name."'");
				if($query_check->num_rows() == 0){
					$data['Slip_Name'] = $Slip_Name;
					$data['Slip_Desc'] = $Slip_Desc;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Type_Slip', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode slip yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_type($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Type_Slip where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data slip tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Type_Slip where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_type($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Type_Slip where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_type(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('e_slip_name','Nama Slip','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$Slip_Name = $this->input->post('e_slip_name');
				$Slip_Desc = $this->input->post('e_slip_desc');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode slip tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
				}else{
					$id = $objectid;
					$data['Slip_Name'] = $Slip_Name;
					$data['Slip_Desc'] = $Slip_Desc;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_TYpe_Slip', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_type_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER SLIP
	//
	//-----------------------------------------------------------------

	function master_slip_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID order by slip.ObjectID desc");
			$data['query_list_type'] = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip order by Slip_Name");
			$data['query_list_bank'] = $this->db->query("select * from tbl_SlipSetor_Ms_Bank order by Bank_Name");

			$data['e_query_list_type'] = $this->db->query("select * from tbl_SlipSetor_Ms_Type_Slip order by Slip_Name");
			$data['e_query_list_bank'] = $this->db->query("select * from tbl_SlipSetor_Ms_Bank order by Bank_Name");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_slip_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_slip(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('slip_name','Nama Slip','required');
			$this->form_validation->set_rules('typeslip_id','Tipe Slip','required');
			$this->form_validation->set_rules('bank_id','Bank','required');
			$this->form_validation->set_rules('slip_status','Status','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
			}else{
				$Slip_Name = $this->input->post('slip_name');
				$TypeSlip_ID = $this->input->post('typeslip_id');
				$Bank_ID = $this->input->post('bank_id');
				$Slip_Status = $this->input->post('slip_status');
				$Slip_Memo = $this->input->post('slip_memo');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Slip where Slip_Name_e = '".$Slip_Name."'");
				if($query_check->num_rows() == 0){
					$data['Slip_Name_e'] = $Slip_Name;
					$data['TypeSlip_ID'] = $TypeSlip_ID;
					$data['Bank_ID'] = $Bank_ID;
					$data['Slip_Status'] = $Slip_Status;
					$data['Slip_Memo'] = $Slip_Memo;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Slip', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode slip yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_slip($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Slip where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data slip tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Slip where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_slip($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Slip where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Slip where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_slip(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('e_slip_name','Nama Slip','required');
			$this->form_validation->set_rules('e_typeslip_id','Tipe Slip','required');
			$this->form_validation->set_rules('e_bank_id','Bank','required');
			$this->form_validation->set_rules('e_slip_status','Status','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$Slip_Name = $this->input->post('e_slip_name');
				$TypeSlip_ID = $this->input->post('e_typeslip_id');
				$Bank_ID = $this->input->post('e_bank_id');
				$Slip_Status = $this->input->post('e_slip_status');
				$Slip_Memo = $this->input->post('e_slip_memo');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Slip where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode slip tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
				}else{
					$id = $objectid;
					$data['Slip_Name_e'] = $Slip_Name;
					$data['TypeSlip_ID'] = $TypeSlip_ID;
					$data['Bank_ID'] = $Bank_ID;
					$data['Slip_Status'] = $Slip_Status;
					$data['Slip_Memo'] = $Slip_Memo;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Slip', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data slip berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar slip telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data slip gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_slip_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}


	//-----------------------------------------------------------------
	//
	//                          MASTER REKENING
	//
	//-----------------------------------------------------------------

	function master_rec_list(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$data['master_rec_list'] = $this->db->query("select tbl_SlipSetor_Ms_Rec.*, tbl_SlipSetor_Ms_Bank.Bank_Name from tbl_SlipSetor_Ms_Rec inner join tbl_SlipSetor_Ms_Bank on tbl_SlipSetor_Ms_Rec.Bank_ID = tbl_SlipSetor_Ms_Bank.ObjectID order by tbl_SlipSetor_Ms_Rec.ObjectID desc");
			$data['query_list_bank'] = $this->db->query("select ObjectID, Bank_ID, Bank_Name from tbl_SlipSetor_Ms_Bank order by Bank_Name");
			$data['query_list_bank_e'] = $this->db->query("select ObjectID, Bank_ID, Bank_Name from tbl_SlipSetor_Ms_Bank order by Bank_Name");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('master_rec_view.php',$data);
			$this->load->view('footer_view.php');
		}else{
			$this->load->view('login_view');
		}
	}

	function add_master_rec(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('bank_id','bank','required');
			$this->form_validation->set_rules('rec_no','no. rekening','required');
			$this->form_validation->set_rules('rec_name','pemilik rekening','required');
			$this->form_validation->set_rules('rec_status','status rekening','required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
			}else{
				$bank_id = $this->input->post('bank_id');
				$rec_no = $this->input->post('rec_no');
				$rec_name = $this->input->post('rec_name');
				$rec_status = $this->input->post('rec_status');
				$rec_desc = $this->input->post('rec_desc');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Rec where Bank_ID = '".$bank_id."' and Rec_No = '".$rec_no."'");
				if($query_check->num_rows() == 0){
					$data['Bank_ID'] = $bank_id;
					$data['Rec_No'] = $rec_no;
					$data['Rec_Name'] = $rec_name;
					$data['Rec_Status'] = $rec_status;
					$data['Rec_Desc'] = $rec_desc;
					$input = $this->set_model->insert_data('tbl_SlipSetor_Ms_Rec', $data);
					if($input){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Tambah data rekening berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar rekening telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, tambah data rekening gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
					}
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode rekening yang baru anda input sudah terinput sebelumnya.<br/><span style='font-size:11px;'>Mohon cek kembali inputan anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function del_master_rec($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Rec where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Data rekening tidak tersedia, <br/><span style='font-size:11px;'>Mohon cek kembali data anda!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
			}else{
				$act_del = $this->db->query("delete from tbl_SlipSetor_Ms_Rec where ObjectID = '".$id_rec."'");
				if($act_del){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Hapus data rekening berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar rekening telah terupdate!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
				}else{
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, hapus data rekening gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

	function edit_master_rec($id){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$id_rec = $this->uri->segment(3);
			$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Rec where ObjectID = '".$id_rec."'");
			if($check_rec->num_rows() == 0){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
			}else{
				$query = $this->db->query("select * from tbl_SlipSetor_Ms_Rec where ObjectID='".$id_rec."'");
				$data = array();
				foreach($query->result() as $db){
					$data[] = $db;
				}
				echo json_encode($data);

			}
		}else{
			$this->load->view('login_view');
		}
	}

	function update_master_rec(){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$this->form_validation->set_rules('objectid','Object ID','required|numeric');
			$this->form_validation->set_rules('e_bank_id','bank','required|trim');
			$this->form_validation->set_rules('e_rec_no','no rekening','required|trim');
			$this->form_validation->set_rules('e_rec_name','pemilik rekening','required|trim');
			$this->form_validation->set_rules('e_rec_status','status','required|trim');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Silahkan isi kolom yang diberi tanda bintang<br/><span style='font-size:11px;'>Silahkan coba lagi!</span></div></div>");
				Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
			}else{
				$objectid = $this->input->post('objectid');
				$e_bank_id = $this->input->post('e_bank_id');
				$e_rec_no = $this->input->post('e_rec_no');
				$e_rec_name = $this->input->post('e_rec_name');
				$e_rec_status = $this->input->post('e_rec_status');
				$e_rec_desc = $this->input->post('e_rec_desc');
				$query_check = $this->db->query("select * from tbl_SlipSetor_Ms_Rec where ObjectID = '".$objectid."'");
				if($query_check->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, kode rekening tidak ditemukan.<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
				}else{
					$id = $objectid;
					$data['Bank_ID'] = $e_bank_id;
					$data['Rec_No'] = $e_rec_no;
					$data['Rec_Name'] = $e_rec_name;
					$data['Rec_Status'] = $e_rec_status;
					$data['Rec_Desc'] = $e_rec_desc;
					$update = $this->set_model->update_data('tbl_SlipSetor_Ms_Rec', 'ObjectID', $id, $data);
					if($update){
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Ubah data rekening berhasil dilakukan, <br/><span style='font-size:11px;'>Daftar rekening telah terupdate!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
					}else{
						$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, ubah data rekening gagal dilakukan<br/><span style='font-size:11px;'>Mohon periksa kembali data Anda!</span></div></div>");
						Header('Location:'.base_url().'index.php/dashboard/master_rec_list/');
					}
				}
			}
		}else{
			$this->load->view('login_view');
		}
	}

}

/*End of file dashboard.php*/
/*Location:.application/controllers/dashboard.php*/
