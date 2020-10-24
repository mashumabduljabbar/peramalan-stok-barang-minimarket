<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Bangkok");	
		$this->load->model('m_general');
	}	
	
	public function index()
	{
		if($this->session->userdata('status') == "login"){
			redirect(base_url("admin"));
		}
		$data['hasillogin'] = "";
		$this->load->view('v_login_index',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	
	function aksi_login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$where = array(
			'username' => $username,
			'password' => $password
			);
		$checking = $this->m_general->countdata('tbl_user', $where);
		
		if($checking > 0){
			$tbl_user = $this->m_general->view_by('tbl_user', $where);
				$data_session = array(
					'id_user' => $tbl_user->id_user,
					'jabatan_user' => $tbl_user->jabatan_user,
					'nama_user' => $tbl_user->nama_user,
					'username' => $tbl_user->username,
					'status' => "login"
					);
	 
				$this->session->set_userdata($data_session);
			if($tbl_user->jabatan_user=="admin"){	
				redirect(base_url("admin"));
			}else{
				redirect(base_url("pimpinan"));	
			}
		}else{
			$data['hasillogin'] = "<i style='color:red;'>Username dan password salah !</i>";
			$this->load->view('v_login_index' , $data);
		}
	}
 
}
