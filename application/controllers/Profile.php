<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	
	public function profile_aksi_ubah($url)
    {
		if(isset($_POST['id_user'])){			
			$username = $this->input->post('username')[0];
			$username_old = $this->input->post('username')[1];
			$where['id_user'] = $_POST['id_user'];
			$tbl_user = $this->m_general->view_by("tbl_user",$where);
			$password = $this->input->post('password')[0];
			$password_old = $this->input->post('password')[1];
			$foto_user = $this->input->post('foto_user');
			
			if($username!=$username_old){
				$check_no_user = $this->m_general->countdata("tbl_user", array("username" => $username));
			}else{
				$check_no_user = 0;
			}
			
			$_POST['username'] = $username;
			
			if($check_no_user==0){	
				if($password!=$password_old){
					$_POST['password'] = md5($password);
				}else{
					$_POST['password'] = $password;
				}
				
				$file_upload = $_FILES['userfiles'];
				$files = $file_upload;
				$uploadPath = "avatar";
					
				if($files['name'] != "" OR $files['name'] != NULL){
					$_POST['foto_user'] = $this->m_general->file_upload($files, $uploadPath);
				}else{
					$_POST['foto_user'] = $foto_user;
				}
				
				$this->m_general->edit("tbl_user", $where, $_POST);
				$_POST['sukses'] = "1";
				$this->load->view("v_".$url."_header");
				$this->load->view("v_index", $_POST);
				$this->load->view("v_main_footer");
			}else{
				$_POST['username_eksis'] = "1";
				$_POST['password'] = $password;
				$where = array("id_user" => $_POST['id_user']);
				$_POST['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
				$this->load->view("v_".$url."_header");
				$this->load->view("v_index", $_POST);
				$this->load->view("v_main_footer");
			}
		}else{
			redirect("$url/index");
		}
    }
}