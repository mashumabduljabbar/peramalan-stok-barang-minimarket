<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Barang extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"  and $this->session->userdata('satuan_barang') != "admin"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_barang");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	
	public function get_data_master_barang()
	{
		$table = "
        (
          select * from tbl_stok order by nama_barang ASC
        )temp";
		
        $primaryKey = 'kode_barang';
        $columns = array(
        array( 'db' => 'kode_barang',     'dt' => 'kode_barang' ),
        array( 'db' => 'nama_barang',     'dt' => 'nama_barang' ),
        array( 'db' => 'satuan_barang',     'dt' => 'satuan_barang' ),
        array( 'db' => 'kode_barang',     'dt' => 'kode_barang' ),
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
	public function barang_tambah()
    {
		$this->load->view("v_admin_header");
        $this->load->view("v_barang_add", $_POST);
		$this->load->view("v_main_footer");
    }
	public function barang_ubah($kode_barang="")
	{
		if($kode_barang!=""){
			$where = array("kode_barang" => $kode_barang);
			$data['tbl_stok'] = $this->m_general->view_by("tbl_stok",$where);
			$this->load->view("v_admin_header");
			$this->load->view('v_barang_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('stok');
		}
	}
	public function barang_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_stok", "id_stok");
		$_POST['id_stok'] = $id_terakhir;
		$this->m_general->add("tbl_stok", $_POST);
		redirect('stok');
    }	
	public function barang_aksi_ubah()
    {
		if(isset($_POST['kode_barang'])){			
			$kode_barang = $this->input->post('kode_barang')[0];
			$kode_barang_old = $this->input->post('kode_barang')[1];
			$where['kode_barang'] = $kode_barang_old;
			$_POST['kode_barang'] = $kode_barang;	
			
			if($kode_barang!=$kode_barang_old){
				$check_kode_barang = $this->m_general->countdata("tbl_stok", array("kode_barang" => $kode_barang));
			}else{
				$check_kode_barang = 0;
			}
			
			if($check_kode_barang==0){
							
				$this->m_general->edit("tbl_stok", $where, $_POST);
				redirect('stok');
			}else{
				$_POST['kode_barang_eksis'] = "1";
				$_POST['tbl_stok'] = $this->m_general->view_by("tbl_stok",$where);
				$this->load->view("v_admin_header");
				$this->load->view("v_barang_edit", $_POST);
				$this->load->view("v_main_footer");
			}
		}else{
			redirect('stok/barang_ubah/');
		}
    }	
	public function barang_aksi_hapus($kode_barang=""){
		if($kode_barang!=""){
			$where['kode_barang'] = $kode_barang;
			$this->m_general->hapus("tbl_stok", $where);
			redirect('stok');
		}else{
			redirect('stok');
		}
	}
}