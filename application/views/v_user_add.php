			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah User</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					<?php 
					if(isset($_POST['username_eksis'])==1){
							$jabatan_user = $_POST['jabatan_user'];
							$jabatan_user2 = $_POST['jabatan_user'];
							$username = $_POST['username'];
							$nama_user = $_POST['nama_user'];
							$password = $_POST['password'];
					?>
					<p style="color:red;"><i>Username sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$jabatan_user = "Pilih Level";
							$jabatan_user2 = "";
							$username = "";
							$nama_user = "";
							$password = "";
					}?>
					
				  <?php echo form_open_multipart("user/user_aksi_tambah"); ?>
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
								<option value="<?php echo $jabatan_user2;?>"><?php echo $jabatan_user;?></option>
								<option value="admin">admin</option>
								<option value="pimpinan">pimpinan</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Username</label>
							<input type="text" class="form-control" maxlength="30" name="username" placeholder="Username" value="<?php echo $username;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Password</label>
							<input type="password" class="form-control" maxlength="40" name="password" placeholder="Password" value="<?php echo $password;?>" required>
						</div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
						<label>Foto Profil</label>
						<input type="file" onchange="readURL(this);"  class="form-control" name="userfiles" required>
					  </div>
					</div>	
					<div class="col-md-6">
					  <div class="form-group">
						<label>&nbsp;</label>
						<img class="img img-responsive user-image" id="blah" >
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>  
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