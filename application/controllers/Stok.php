<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Stok extends CI_Controller {
	var $jabatan ="";
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
		$this->jabatan = $this->session->userdata('jabatan_user');
	}
	
	////////////////////////////////////
	
	public function index()
    {
		$this->load->view("v_".$this->jabatan."_header");
        $this->load->view("v_stok");
        $this->load->view("v_main_footer");
    }
	
	////////////////////////////////////
	
	public function get_data_master_stok()
	{
		$table = "
        (
          select a.*, b.nama_barang, b.satuan_barang, 
CONCAT(YEAR(a.tanggal_stok),'-',DATE_FORMAT(a.tanggal_stok,'%m')) as bulan 
from tbl_stok a
left join tbl_barang b on a.kode_barang=b.kode_barang
order by id_stok ASC
        )temp";
		
        $primaryKey = 'id_stok';
        $columns = array(
        array( 'db' => 'bulan',     'dt' => 'bulan' ),
        array( 'db' => 'nama_barang',     'dt' => 'nama_barang' ),
        array( 'db' => 'akhir_stok',     'dt' => 'akhir_stok' ),
        array( 'db' => 'penjualan_stok',     'dt' => 'penjualan_stok' ),
        array( 'db' => 'persediaan_stok',     'dt' => 'persediaan_stok' ),
        array( 'db' => 'kode_barang',     'dt' => 'kode_barang' ),
        array( 'db' => 'id_stok',     'dt' => 'id_stok' ),
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
	public function stok_tambah()
    {
		$data['tbl_barang'] = $this->m_general->view("tbl_barang");
		$this->load->view("v_".$this->jabatan."_header");
        $this->load->view("v_stok_add", $data);
		$this->load->view("v_main_footer");
    }
	public function stok_ubah($id_stok="")
	{
		if($id_stok!=""){
			$where = array("id_stok" => $id_stok);
			$data['tbl_stok'] = $this->m_general->view_by("tbl_stok",$where);
			$this->load->view("v_".$this->jabatan."_header");
			$this->load->view('v_stok_edit', $data);
			$this->load->view("v_main_footer");
		}else{
			redirect('stok');
		}
	}
	public function stok_aksi_tambah()
    {
		$id_terakhir = $this->m_general->bacaidterakhir("tbl_stok", "id_stok");
		$_POST['id_stok'] = $id_terakhir;
		$this->m_general->add("tbl_stok", $_POST);
		redirect('stok');
    }	
	public function stok_aksi_ubah()
    {
		if(isset($_POST['id_stok'])){			
			$where['id_stok'] = $_POST['id_stok'];
			$this->m_general->edit("tbl_stok", $where, $_POST);
			redirect('stok');
		}	
    }	
	public function stok_aksi_hapus($id_stok=""){
		if($id_stok!=""){
			$where['id_stok'] = $id_stok;
			$this->m_general->hapus("tbl_stok", $where);
			redirect('stok');
		}else{
			redirect('stok');
		}
	}
}