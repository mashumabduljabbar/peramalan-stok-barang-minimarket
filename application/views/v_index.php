<?php
	$geturl1 = $this->uri->segment(1);
	$id_user = $this->session->userdata('id_user');
	$tbl_user = $this->db->query("SELECT * FROM tbl_user where id_user = '$id_user'")->row();
	$foto_user = $tbl_user->foto_user."?".strtotime("now");
?>           
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
						
						<div class="card mb-4">
                            <div class="card-body">
								<table class="table" width="100%">
									<tr>
										<td width="50%" style="text-align:center;">
										<img width="60%" class="img img-responsive user-image" id="blah" src="<?php echo base_url("assets/avatar/$foto_user"); ?>" alt="">
										</td>
										<td width="50%">
						<?php 
						if(isset($_POST['username_eksis'])=="1"){
							$username = $_POST['username'];
							$nama_user = $_POST['nama_user'];
							$password = $_POST['password'];
							$foto_user = $_POST['foto_user'];
						?>
						<p style="color:red;"><i>Username sudah digunakan, silahkan coba yang lain.</i></p>
						<?php 
						}else{
							$username = $tbl_user->username;
							$nama_user = $tbl_user->nama_user;
							$password = $tbl_user->password;
							$foto_user = $tbl_user->foto_user;
						}
						
						if(isset($_POST['sukses'])=="1"){ ?>
							<p style="color:green;"><i>Profile berhasil diubah.</i></p>
						<?php }
						?>
											<?php echo form_open_multipart("profile/profile_aksi_ubah/$geturl1"); ?>
						<input type="hidden"name="id_user" value="<?php echo $tbl_user->id_user;?>" required>
						<div class="col-md-6">
							<div class="form-group">
								<label>	Nama User</label>
								<input type="text" class="form-control" name="nama_user" placeholder="Nama User" value="<?php echo $nama_user;?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>	Username</label>
								<input type="text" class="form-control" name="username[]" placeholder="Username" value="<?php echo $username;?>" required>
								<input type="hidden" name="username[]" value="<?php echo $tbl_user->username;?>" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>	Password</label>
								<input type="password" class="form-control" name="password[]" placeholder="Password" value="<?php echo $password;?>" required>
								<input type="hidden" name="password[]" value="<?php echo $tbl_user->password;?>" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Foto Profil</label>
								<input type="hidden" name="foto_user" value="<?php echo $foto_user; ?>">
								<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles">
							</div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<input type="submit" onclick="return confirm('Apakah Yakin Menyimpan?');" value="Ubah Profile" class="btn btn-success">
						  </div>
						</div>
						<?php echo form_close(); ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
                    </div>
                </main>

  <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>