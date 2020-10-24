				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:160px;" href="<?php echo base_url("barang/barang_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah Barang</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="databarang" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama barang</th>
                                                <th>Satuan Barang</th>
                                                <th>Action</th>
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
$('#databarang').DataTable({
			"ajax": "<?php echo base_url('barang/get_data_master_barang/');?>" ,
			"columns": [
				{ "data": "kode_barang" },
				{ "data": "nama_barang" },
				{ "data": "satuan_barang" }
			],
			columnDefs: [
				   {
				   targets: [3],
				    data: 'kode_barang',
				   render: function ( data, type, row, meta ) { 

					var edit = "<a href='<?php echo base_url();?>barang/barang_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					if(data!=1){
						var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus barang ini ?')\" href='<?php echo base_url();?>barang/barang_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					}else{
						var hapus = "";
					}
					
					return edit +  hapus;
				   }
				},],
			});
	});
</script>