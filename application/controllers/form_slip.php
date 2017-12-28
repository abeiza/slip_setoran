<?php if(!defined('BASEPATH'))exit('No Direct Script Access Allowed');
	class Form_Slip extends CI_Controller{
		function __construct(){
			parent::__construct();
		}

		function form($id){
			$id = $this->uri->segment(3);
			$data['qry_frm'] = $this->db->query("select bank.Bank_Name, slip.Slip_Name_e, var.* from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_SetupSlip_Var as var on
slip.ObjectID = var.Slip_ID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."' order by var.ObjectID");
			$title_qry = $this->db->Query("select slip.Slip_Name_e, Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."'");
			foreach($title_qry->result() as $t){
				$data['title_1'] = $t->Slip_Name_e;
				$data['title_2'] = $t->Bank_Name;
			}

			$data['master_receiver_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver order by ObjectID");
			$data['master_depositor_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor order by ObjectID");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('form_view',$data);
			$this->load->view('footer_view.php');
		}

		function search($search){
			$id = $this->uri->segment(3);
			$search = urldecode($id);

			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, trans.Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID where trans.Trans_No like '%".$search."%' or
trans.Receiver_Name like '%".$search."%' or
trans.Receiver_Rek like '%".$search."%' or
trans.Bank_Name like '%".$search."%' or
trans.Slip_Name like '%".$search."%' or
trans.Trans_Desc like '%".$search."%'
order by Trans_No desc");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_wt_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('trans_view',$data);
			$this->load->view('footer_view.php');
		}

		function form_review($id){
			$id = $this->uri->segment(3);
			$data['qry_frm'] = $this->db->query("select bank.Bank_Name, slip.Slip_Name_e, var.* from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_SetupSlip_Var as var on
slip.ObjectID = var.Slip_ID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."' order by var.ObjectID");
			$title_qry = $this->db->Query("select slip.Slip_Name_e, Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."'");
			foreach($title_qry->result() as $t){
				$data['title_1'] = $t->Slip_Name_e;
				$data['title_2'] = $t->Bank_Name;
			}

			$data['master_receiver_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver order by ObjectID");
			$data['master_depositor_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor order by ObjectID");
			$this->load->view('header_view.php');
			//$this->load->view('nav_top_view.php');
			//$this->load->view('nav_left_view.php');
			$this->load->view('form_view',$data);
			//$this->load->view('footer_view.php');
		}

		function form_detail($id,$id2){
			$id = $this->uri->segment(3);
			$data['qry_frm'] = $this->db->query("select bank.Bank_Name, slip.Slip_Name_e, var.* from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_SetupSlip_Var as var on
slip.ObjectID = var.Slip_ID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."' order by var.ObjectID");

			$title_qry = $this->db->Query("select slip.Slip_Name_e, Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
where slip.ObjectID = '".$id."'");
			foreach($title_qry->result() as $t){
				$data['title_1'] = $t->Slip_Name_e;
				$data['title_2'] = $t->Bank_Name;
			}

			$data['master_receiver_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver order by ObjectID");
			$data['master_depositor_list'] = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor order by ObjectID");
			$this->load->view('header_view.php');
			$this->load->view('nav_top_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('form_detail_view',$data);
			$this->load->view('footer_view.php');
		}

		function transaction_list(){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, trans.Trans_Desc, var.Slip_ID  
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID order by Trans_No desc");

			$this->load->view('header_view.php');
			$this->load->view('nav_top_wt_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('trans_view',$data);
			$this->load->view('footer_view.php');
		}

		function transaction_bank($bank, $slip, $from, $to){
			$bank = $this->uri->segment(3);
			$slip = $this->uri->segment(4);
			$from = $this->uri->segment(5);
			$to = $this->uri->segment(6);

			if($bank == 'all' and $slip == 'all' and $from == 'all' and $to == 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID order by Trans_No desc");
			}

			else if($slip == 'all' and $bank != 'all' and $from != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($bank == 'all' and $slip != 'all' and $from != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$slip."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($from == 'all' and $bank != 'all' and $slip != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and slip.ObjectID = '".$slip."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($to == 'all' and $from != 'all' and $bank != 'all' and $slip != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and slip.ObjectID = '".$slip."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' order by Trans_No desc");
			}


			else if($slip == 'all' and $bank == 'all' and $from == 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($bank == 'all' and $from == 'all' and $to == 'all' and $slip != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$slip."' order by Trans_No desc");
			}else if($slip == 'all' and $from == 'all' and $to == 'all' and $bank != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' order by Trans_No desc");
			}else if($slip == 'all' and $bank == 'all' and $to == 'all' and $from != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' order by Trans_No desc");
			}


			else if($slip == 'all' and $bank == 'all' and $from != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($slip == 'all' and $from == 'all' and $bank != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($slip == 'all' and $to == 'all' and $bank != 'all' and $from != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' order by Trans_No desc");
			}else if($bank == 'all' and $from == 'all' and $slip != 'all' and $to != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$slip."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}else if($bank == 'all' and $to == 'all' and $slip != 'all' and $from != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$slip."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' order by Trans_No desc");
			}else if($from == 'all' and $to == 'all' and $bank != 'all' and $slip != 'all'){
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.ObjectID = '".$slip."' and slip.Bank_ID = '".$bank."' order by Trans_No desc");
			}


			else{
			$data['qry_frm'] = $this->db->query("select distinct trans.Trans_No, trans.Receiver_Name, trans.Receiver_Rek, trans.Entry_Dt, trans.Bank_Name, trans.Slip_Name, trans.Trans_Dt, trans.Trans_Amount, Cast(trans.Trans_Desc as varchar(150)) as Trans_Desc, var.Slip_ID
from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID where slip.Bank_ID = '".$bank."' and slip.ObjectID = '".$slip."' and trans.Trans_Dt >= '".substr($from,4,4)."-".substr($from,0,2)."-".substr($from,2,2)."' and trans.Trans_Dt <= '".substr($to,4,4)."-".substr($to,0,2)."-".substr($to,2,2)."' order by Trans_No desc");
			}

			$this->load->view('header_view.php');
			$this->load->view('nav_top_wt_view.php');
			$this->load->view('nav_left_view.php');
			$this->load->view('trans_view',$data);
			$this->load->view('footer_view.php');
		}

		function master_slip($id,$id2){
		$cek = $this->session->userdata('login_code');
		if($cek){
			$bank = $this->uri->segment(3);
			$slip = $this->uri->segment(4);

			if($bank == 'all' and $slip == 'all'){
			$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID order by slip.ObjectID desc");
			}else if($slip == 'all'){
			$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID where slip.Bank_ID = '".$bank."' order by slip.ObjectID desc");
			}else if($bank == 'all'){
			$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID where type.ObjectID = '".$slip."' order by slip.ObjectID desc");
			}else{
			$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID where type.ObjectID = '".$slip."' and slip.Bank_ID = '".$bank."' order by slip.ObjectID desc");
			}

			//$data['master_sliptt_list'] = $this->db->query("select slip.*, type.Slip_Name, bank.Bank_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID order by slip.ObjectID desc");
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

		function update_transaction($id,$id2){
			$id = $this->uri->segment(3);
			$id2 = $this->uri->segment(4);
			$qry_var = $this->db->query("select var.ObjectID, var.Slip_Field, bank.Bank_Name, bank.Bank_ID, slip.Slip_Name_e, var.Slip_ID from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_SetupSlip_Var as var on
				slip.ObjectID = var.Slip_ID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
				where slip.ObjectID = '".$id."' order by var.ObjectID");
			$id_footer = date('YmdHsi');
			$entry = date('Y-m-d H:s:i');
			foreach($qry_var->result() as $v){
				$trans_no = $id2;
				$bank_name = $v->Bank_Name;
				$slip_name = $v->Slip_Name_e;
				$receiver_name = $this->input->post('nama_customer_1');
				$receiver_rek = $this->input->post('no_rek_customer_1');
				$depositor_name = $this->input->post('nama_penyetor');
				$depositor_rek = $this->input->post('no_rek_penyetor');

				if($this->input->post('tgl_setor') == ''){
					$trans_dt = date('Y-m-d');
				}else{
					$trans_dt = substr($this->input->post('tgl_setor'),6,10).'-'.substr($this->input->post('tgl_setor'),0,2).'-'.substr($this->input->post('tgl_setor'),3,2);
				}
				$entry_dt = $entry;
				$slip_var_id = $v->ObjectID;
				$slip_var_value = $this->input->post($v->Slip_Field);
				//if($this->input->post('berita_keterangan') == 0 or $this->input->post('berita_keterangan') == '' or $this->input->post('berita_keterangan') == null){
				//	$data['Trans_Desc'] = "-";
				//}else{
				$trans_desc = $this->input->post('berita_keterangan');
				//}
				$trans_amount = str_replace(',','',$this->input->post('total_jumlah_rupiah'));


				$update_data = $this->db->query("update tbl_SlipSetor_Transaction set Bank_Name = '".$bank_name."', Slip_Name = '".$slip_name."',
				Receiver_Name = '".$receiver_name."', Receiver_Rek = '".$receiver_rek."', Depositor_Name = '".$depositor_name."', Depositor_Rek = '".$depositor_rek."',
				Trans_Dt = '".$trans_dt."', Entry_Dt = '".$entry_dt."', Slip_Var_Value = '".$slip_var_value."', Trans_Amount = '".$trans_amount."', Trans_Desc = '".$trans_desc."'
				where Trans_No = '".$trans_no."' and Slip_Var_ID = '".$slip_var_id."'");
				//$insert_data = $this->set_model->update_data('tbl_SlipSetor_Transaction', $pk, $id, $data);
			}
			echo "<script>window.open('".base_url()."index.php/form_slip/get_print/".$id2."','mywindow', 'width=900,height=555,left=160,top=170')</script>";
			echo "<script>window.location = '".base_url()."index.php/form_slip/transaction_list/';</script>";//$this->transaction_list();
			//$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Terimakasih, <br/><span style='font-size:11px;'>Pengisian Slip Online telah selesai diproses!</span></div></div>");
			//Header('Location:'.base_url().'index.php/form_slip/transaction_list/');
		}

		function add_transaction($id){
			$id = $this->uri->segment(3);
			$qry_var = $this->db->query("select var.ObjectID, var.Slip_Field, bank.Bank_Name, bank.Bank_ID, slip.Slip_Name_e, var.Slip_ID from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_SetupSlip_Var as var on
				slip.ObjectID = var.Slip_ID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID
				where slip.ObjectID = '".$id."' order by var.ObjectID");
			$id_footer = date('YmdHsi');
			$entry = date('Y-m-d H:s:i');
			foreach($qry_var->result() as $v){
				$data['Trans_No'] = $v->Bank_ID.'-'.$v->Slip_ID.'-'.$id_footer;
				$data['Bank_Name'] = $v->Bank_Name;
				$data['Slip_Name'] = $v->Slip_Name_e;

				$data['Receiver_Name'] = $this->input->post('nama_customer_1');
				$data['Receiver_Rek'] = $this->input->post('no_rek_customer_1');
				$data['Depositor_Name'] = $this->input->post('nama_penyetor');
				$data['Depositor_Rek'] = $this->input->post('no_rek_penyetor');
				if($this->input->post('tgl_setor') == ''){
					$data['Trans_Dt'] = date('Y-m-d');
				}else{
					$data['Trans_Dt'] = substr($this->input->post('tgl_setor'),6,10).'-'.substr($this->input->post('tgl_setor'),0,2).'-'.substr($this->input->post('tgl_setor'),3,2);
				}
				$data['Entry_Dt'] = $entry;
				$data['Slip_Var_ID'] = $v->ObjectID;
				$data['Slip_Var_Value'] = $this->input->post($v->Slip_Field);
				//if($this->input->post('berita_keterangan') == 0 or $this->input->post('berita_keterangan') == '' or $this->input->post('berita_keterangan') == null){
				//	$data['Trans_Desc'] = "-";
				//}else{
				$data['Trans_Desc'] = $this->input->post('berita_keterangan');
				//}
				$data['Trans_Amount'] = str_replace(',','',$this->input->post('total_jumlah_rupiah'));


				$insert_data = $this->set_model->insert_data('tbl_SlipSetor_Transaction', $data);
			}
			echo "<script>window.open('".base_url()."index.php/form_slip/get_print/".$data['Trans_No']."','mywindow', 'width=900,height=555,left=160,top=170')</script>";
			echo "<script>window.location = '".base_url()."index.php/form_slip/transaction_list/';</script>";//$this->transaction_list();
			//$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Terimakasih, <br/><span style='font-size:11px;'>Pengisian Slip Online telah selesai diproses!</span></div></div>");
			//Header('Location:'.base_url().'index.php/form_slip/transaction_list/');
		}

		function get_print($id){
			$id = $this->uri->segment(3);
			$data['cek_print'] = $this->db->query("select * from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on trans.Slip_Var_ID = var.ObjectID where trans.Trans_No = '".$id."'");

			//$this->load->view('header_view.php');
			//$this->load->view('nav_top_view.php');
			//$this->load->view('nav_left_view.php');
			$this->load->view('form_print_view',$data);
			//$this->load->view('footer_view.php');
		}

		function get_depo($id){
			$cek = $this->session->userdata('login_code');
			if($cek){
				$id = $this->uri->segment(3);
				$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Depositor where ObjectID = '".$id."'");
				if($check_rec->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
				}else{
					$query = $this->db->query("select * from tbl_SlipSetor_Ms_Depositor where ObjectID='".$id."'");
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

		function get_cust($id){
			$cek = $this->session->userdata('login_code');
			if($cek){
				$id = $this->uri->segment(3);
				$check_rec = $this->db->query("select ObjectID from tbl_SlipSetor_Ms_Receiver where ObjectID = '".$id."'");
				if($check_rec->num_rows() == 0){
					$this->session->set_flashdata('change_result',"<div id='notif' style='width:100%;height:100%;display:flex;position:fixed;left:0;top:0;'><div style='font-size:14px;color:#fff;padding:10px 25px;margin:auto;border-radius:2px;background-color:rgb(50,50,50);'>Maaf, Terjadi kesalahan, <br/><span style='font-size:11px;'>Data yang anda pilih tidak tersedia!</span></div></div>");
					Header('Location:'.base_url().'index.php/dashboard/master_var_list/');
				}else{
					$query = $this->db->query("select * from tbl_SlipSetor_Ms_Receiver where ObjectID='".$id."'");
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
	}

	/*End of file Form_Slip.php*/
	/*Location:.application/controllers/form_slip.php*/
