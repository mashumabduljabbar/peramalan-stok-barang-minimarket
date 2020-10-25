<?php
  $jabatan_user = $this->session->userdata('jabatan_user');;
?>
				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Stok Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:200px;" href="<?php echo base_url("stok/stok_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Stok Barang</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="datastok" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Barang</th>
                                                <th>Stok Akhir</th>
                                                <th>Penjualan Bulanan</th>
                                                <th>Persediaan Bulanan</th>
												<?php if($jabatan_user=="admin"){ ?>
                                                <th>Action</th>
												<?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
	
var jabatan = "<?php echo $jabatan_user;?>";
if(jabatan=="admin"){
	var angka = 5;
}else{
	var angka = 4;
}

$('#datastok').DataTable({
			"ajax": "<?php echo base_url('stok/get_data_master_stok/');?>" ,
			"columns": [
				{ "data": "bulan" },
				{ "data": "nama_barang" },
				{ "data": "akhir_stok" },
				{ "data": "penjualan_stok" },
				{ "data": "persediaan_stok" }
			],
						
			columnDefs: [
				   {
				   targets: [angka],
				    data: 'id_stok',
				   render: function ( data, type, row, meta ) { 
					if(jabatan=="admin"){
						var edit = "<a href='<?php echo base_url();?>stok/stok_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
						
						var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus stok ini ?')\" href='<?php echo base_url();?>stok/stok_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
						
						return edit +  hapus;
					}else{
						return row.persediaan_stok;
					}
				   }
				},],
				
			});
	});
</script>