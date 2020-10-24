			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Ubah Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					<?php 
					if(isset($_POST['kode_barang_eksis'])==1){
							$kode_barang = $_POST['kode_barang'];
							$nama_barang = $_POST['nama_barang'];
							$satuan_barang = $_POST['satuan_barang'];
					?>
					<p style="color:red;"><i>Kode Barang sudah digunakan, silahkan coba yang lain.</i></p>
					<?php 
					}else{
							$kode_barang = $tbl_barang->kode_barang;
							$nama_barang = $tbl_barang->nama_barang;
							$satuan_barang = $tbl_barang->satuan_barang;
					}?>
					
				  <?php echo form_open_multipart("barang/barang_aksi_ubah"); ?>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Kode Barang</label>
							<input type="text" class="form-control" maxlength="8" name="kode_barang[]" placeholder="Kode Barang" value="<?php echo $kode_barang;?>" required>
							<input type="hidden" name="kode_barang[]" value="<?php echo $tbl_barang->kode_barang;?>" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Nama Barang</label>
							<input type="text" class="form-control" maxlength="30" name="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Satuan Barang</label>
							<input type="text" class="form-control" maxlength="30" name="satuan_barang" placeholder="Satuan Barang" value="<?php echo $satuan_barang;?>" required>
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