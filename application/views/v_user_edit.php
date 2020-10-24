			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Ubah User</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					<?php 
					if(isset($_POST['username_eksis'])=="1"){
							$jabatan_user = $_POST['jabatan_user'];
							$username = $_POST['username'];
							$nama_user = $_POST['nama_user'];
							$foto_user = $_POST['foto_user'];
							$password = $_POST['password'];
					?>
					<p style="color:red;"><i>Username sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$jabatan_user = $tbl_user->jabatan_user;
							$username = $tbl_user->username;
							$nama_user = $tbl_user->nama_user;
							$foto_user = $tbl_user->foto_user;
							$password = $tbl_user->password;
					}?>
					
				  <?php echo form_open_multipart("user/user_aksi_ubah"); ?>
					<input type="hidden"name="id_user" value="<?php echo $tbl_user->id_user;?>" required>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama User</label>
							<input type="text" class="form-control" maxlength="30" name="nama_user" placeholder="Nama User" value="<?php echo $nama_user;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Jabatan User</label>
							<select name="jabatan_user" class="form-control">
								<option value="<?php echo $jabatan_user;?>"><?php echo $jabatan_user;?></option>
								<option value="admin">admin</option>
								<option value="pimpinan">pimpinan</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Username</label>
							<input type="text" class="form-control" maxlength="30" name="username[]" placeholder="Username" value="<?php echo $username;?>" required>
							<input type="hidden" name="username[]" value="<?php echo $tbl_user->username;?>" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Password</label>
							<input type="password" class="form-control" maxlength="40" name="password[]" placeholder="Password" value="<?php echo $password;?>" required>
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
						<label>&nbsp;</label>
						<img class="img img-responsive user-image" id="blah" src="<?php echo base_url("assets/avatar/$foto_user"); ?>" alt="">
					  </div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
						<input type="submit" onclick="return confirm('Apakah Yakin Menyimpan?');" value="Submit" class="btn btn-success">
					  </div>
					</div>
					<?php echo form_close(); ?>
				  
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