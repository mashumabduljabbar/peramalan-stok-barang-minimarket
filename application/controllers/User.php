<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"  or $this->session->userdata('jabatan_user') != "admin"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_user");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	
	public function get_data_master_user()
	{
		$table = "
        (
          select * from tbl_user order by jabatan_user ASC
        )temp";
		
        $primaryKey = 'id_user';
        $columns = array(
        array( 'db' => 'username',     'dt' => 'username' ),
        array( 'db' => 'foto_user',     'dt' => 'foto_user' ),
        array( 'db' => 'nama_user',     'dt' => 'nama_user' ),
        array( 'db' => 'jabatan_user',     'dt' => 'jabatan_user' ),
        array( 'db' => 'id_user',     'dt' => 'id_user' ),
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}	
	public function user_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_user_add");
		$this->load->view("v_main_footer");
    }
	public function user_ubah($id_user="")
	{
		if($id_user!=""){
			$where = array("id_user" => $id_user);
			$data['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
			$this->load->view("v_admin_header");
			$this->load->view('v_user_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('user');
		}
	}
	public function user_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_user", "id_user");
		$_POST['id_user'] = $id_terakhir;
		$username = $this->m_general->countdata("tbl_user", array("username" => $_POST['username']));
		if($username=="0"){
			$file_upload = $_FILES['userfiles'];
			$files = $file_upload;
			$uploadPath = "avatar";		
			if($files['name'] != "" OR $files['name'] != NULL){
				$_POST['foto_user'] = $this->m_general->file_upload($files, $uploadPath);
			}else{
				$_POST['foto_user'] = "";
			}
			$_POST['password'] = md5($_POST['password']);
			$this->m_general->add("tbl_user", $_POST);
			redirect('user');
		}else{
			$_POST['username_eksis'] = "1";
			$this->load->view("v_admin_header");
			$this->load->view("v_user_add", $_POST);
			$this->load->view("v_main_footer");
		}
    }	
	public function user_aksi_ubah()
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
				redirect('user');
			}else{
				$_POST['username_eksis'] = "1";
				$_POST['password'] = $password;
				$where = array("id_user" => $_POST['id_user']);
				$_POST['tbl_user'] = $this->m_general->view_by("tbl_user",$where);
				$file_upload = $_FILES['userfiles'];
				$files = $file_upload;
				$uploadPath = "avatar";
				if($files['name'] != "" OR $files['name'] != NULL){
					$_POST['foto_user'] = $this->m_general->file_upload($files, $uploadPath);
				}else{
					$_POST['foto_user'] = $foto_user;
				}
				$this->load->view("v_admin_header");
				$this->load->view("v_user_edit", $_POST);
				$this->load->view("v_main_footer");
			}
		}else{
			redirect('user/user_ubah/');
		}
    }	
	public function user_aksi_hapus($id_user=""){
		if($id_user!=""){
			$where['id_user'] = $id_user;
			$this->m_general->hapus("tbl_user", $where);
			redirect('user');
		}else{
			redirect('user');
		}
	}
}