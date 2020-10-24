			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Stok Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					
				  <?php echo form_open_multipart("stok/stok_aksi_tambah"); ?>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Barang</label>
							<select name="kode_barang" class="form-control select2" required>
							<option value="">Pilih Barang</option>
							<?php foreach($tbl_barang as $barang){?>
							<option value="<?php echo $barang->kode_barang;?>"><?php echo $barang->nama_barang;?></option>
							<?php }?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Tanggal</label>
							<input type="date" class="form-control" name="tanggal_stok" placeholder="Tanggal" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Stok </label>
							<input type="number" class="form-control" maxlength="11" name="akhir_stok" placeholder="Stok Akhir" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Penjualan </label>
							<input type="number" class="form-control" maxlength="11" name="penjualan_stok" placeholder="Penjualan Bulanan" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Persediaan </label>
							<input type="number" class="form-control" maxlength="11" name="persediaan_stok" placeholder="Persediaan Bulanan" required>
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