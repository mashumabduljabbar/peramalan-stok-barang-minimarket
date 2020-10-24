<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_general extends CI_Model {
  
	public function countdata($table, $where_array){
		$this->db->where($where_array);
		$total = $this->db->get($table)->num_rows();
		return $total;
	}
	
	public function bacaidterakhir($table, $id){
		$query = $this->db->query("select $id+1 as $id from $table order by $id DESC LIMIT 1");
		if($query->num_rows() > 0){
			$query2 = $query->row();
			$idnya = $query2->$id;
		}else{
			$idnya = "1";
		}
		
		return $idnya;
	}
	
	public function view($table){
		return $this->db->get($table)->result();
	}
	
	public function view_by($table, $where){
		$this->db->where($where);
		return $this->db->get($table)->row();
	}
	
	public function view_order($table, $order =""){
		$this->db->order_by($order);
		return $this->db->get($table)->result();
	}
  
	public function add($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
  
	function edit($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data); 
		return $this->db->affected_rows();
	}
  
	function hapus($table, $where)
	{
		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		$this->db->delete($table);
		return $this->db->affected_rows();
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	public function file_upload($file_upload, $folder)
    {
				$files = $file_upload;
				$_FILES['userfile']['name'] = $files['name'];
				$_FILES['userfile']['type'] = $files['type'];
				$_FILES['userfile']['error'] = $files['error'];
				$_FILES['userfile']['tmp_name'] = $files['tmp_name'];
				$_FILES['userfile']['size'] = $files['size'];
				$new_name = time().md5($files['name']);
				
				// File upload configuration
                $uploadPath = './assets/'.$folder.'/';
                $config=array(); 
				$config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'avi|mp4|flv|pdf|jpg|jpeg|png|gif';
                $config['max_size'] = '30000';
                $config['max_width'] = '20000';
                $config['max_height'] = '20000';
                $config['file_name'] = $new_name;
				
				// Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload userfile to server
                if($this->upload->do_upload()){
                    // Uploaded userfile data
                    $nama_fileupload = $this->upload->data('file_name');
                }
				
				return $nama_fileupload;
	}
	
	public function getTanggalIndo($tanggal){
		if($tanggal!=NULL OR $tanggal!="0000-00-00"){
			$bulan = array ( 1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$pecahkan = explode('-', $tanggal); 
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
			
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}else{
			return "";
		}
	}
	
}