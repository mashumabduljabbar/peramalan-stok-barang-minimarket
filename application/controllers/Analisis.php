<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/ssp.php';
class Analisis extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('m_general');
	}
	
	////////////////////////////////////
	
	public function index($kode_barang="")
    {
		$data['tbl_stok'] = $this->db->query("select id_stok, akhir_stok as X1, penjualan_stok as X2, persediaan_stok as Y, 
akhir_stok*persediaan_stok as X1Y,
penjualan_stok*persediaan_stok as X2Y,
akhir_stok*penjualan_stok as X1X2,
POWER(akhir_stok,2) as X12, 
POWER(penjualan_stok,2) as X22, 
CONCAT(YEAR(tanggal_stok),'-',DATE_FORMAT(tanggal_stok,'%m')) as bulan 
from tbl_stok
where kode_barang='$kode_barang'
order by id_stok ASC")->result();

		$data['tbl_analisa'] = $this->db->query("select 
		@jumlah := count(*) as jumlah, 
@totalX1 := sum(akhir_stok) as totalX1, 
@totalX2 := sum(penjualan_stok) as totalX2, 
@totalY := sum(persediaan_stok) as totalY, 
@totalX1Y := sum(akhir_stok*persediaan_stok) as totalX1Y,
@totalX2Y := sum(penjualan_stok*persediaan_stok) as totalX2Y,
@totalX1X2 := sum(akhir_stok*penjualan_stok) as totalX1X2,
@totalX12 := sum(POWER(akhir_stok,2)) as totalX12, 
@totalX22 := sum(POWER(penjualan_stok,2)) as totalX22, 

@detA := @jumlah*(@totalX12*@totalX22-@totalX1X2*@totalX1X2)+
@totalX1*(@totalX1X2*@totalX2-@totalX1*@totalX22)+
@totalX2*(@totalX1*@totalX1X2-@totalX12*@totalX2) as detA,

@detA1 := @totalY*(@totalX12*@totalX22-@totalX1X2*@totalX1X2)+
@totalX1Y*(@totalX1X2*@totalX2-@totalX1*@totalX22)+
@totalX2Y*(@totalX1*@totalX1X2-@totalX12*@totalX2) as detA1,

@detA2 := @jumlah*(@totalX1Y*@totalX22-@totalX2Y*@totalX1X2)+
@totalX1*(@totalX2Y*@totalX2-@totalY*@totalX22)+
@totalX2*(@totalY*@totalX1X2-@totalX1Y*@totalX2) as detA2,

@detA3 := @jumlah*(@totalX12*@totalX2Y-@totalX1X2*@totalX1Y)+
@totalX1*(@totalX1X2*@totalY-@totalX1*@totalX2Y)+
@totalX2*(@totalX1*@totalX1Y-@totalX12*@totalY) as detA3,

@b0 := @detA1/@detA as b0, 
@b1 := @detA2/@detA as b1, 
@b2 := @detA3/@detA as b2,

@X1 :=  (SELECT a.akhir_stok as X1
FROM tbl_stok a
WHERE a.kode_barang='$kode_barang'
ORDER BY a.id_stok DESC LIMIT 1) as X1,

@X2 :=  (SELECT a.penjualan_stok as X2
FROM tbl_stok a
WHERE a.kode_barang='$kode_barang'
ORDER BY a.id_stok DESC LIMIT 1) as X2,

@Y := ROUND(@b0 + (@b1 * @X1) + (@b2 * @X2),0) as Y

from tbl_stok
where kode_barang='$kode_barang'")->row();

		$data['tbl_barang'] = $this->m_general->view_where("tbl_barang", array("kode_barang!="=>$kode_barang));
		if($kode_barang!=""){
			$tbl_barang = $this->m_general->view_by("tbl_barang", array("kode_barang"=>$kode_barang));
			$data['nama_barang'] = $tbl_barang->nama_barang;
		}else{ $data['nama_barang'] = "Pilih Barang"; }
		$url = $this->session->userdata('jabatan_user');
		$this->load->view("v_".$url."_header");
        $this->load->view("v_analisis",$data);
        $this->load->view("v_main_footer");
    }
	
	//////////////////////////////////////
}