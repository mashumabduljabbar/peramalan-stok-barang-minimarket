				<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							<label><a class="btn-sm btn-primary nav-link" style="width:140px;" href="<?php echo base_url("user/user_tambah");?>"><i class="fa fa-plus"></i> <span>Tambah User</span>
							</a></label>
							</div>
							<div class="card-body">
                                <div class="table-responsive">
                                    
									<table class="table table-bordered" id="dataUser" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama User</th>
                                                <th>Jabatan</th>
                                                <th>Username</th>
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
$('#dataUser').DataTable({
			"ajax": "<?php echo base_url('user/get_data_master_user/');?>" ,
			"columns": [
				{ "data": "nama_user" },
				{ "data": "jabatan_user" },
				{ "data": "username" }
			],
			columnDefs: [
				   {
				   targets: [3],
				    data: 'id_user',
				   render: function ( data, type, row, meta ) { 

					var edit = "<a href='<?php echo base_url();?>user/user_ubah/"+data+"' title='Ubah'> <button type='button' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> </button></a>";
					
					if(data!=1){
						var hapus = "<a onclick=\"return confirm('Yakin untuk menghapus user ini ?')\" href='<?php echo base_url();?>user/user_aksi_hapus/"+data+"' title='Hapus'> <button type='button' class='btn btn-sm  btn-danger'><i class='fa fa-trash'></i> </button></a>";
					}else{
						var hapus = "";
					}
					
					return edit +  hapus;
				   }
				},],
			});
	});
</script>