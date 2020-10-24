			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Ubah Stok Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
							Silahkan melengkapi form berikut
							</div>
							<div class="card-body">
					
				  <?php echo form_open_multipart("stok/stok_aksi_ubah"); ?>
					<input type="hidden" name="id_stok" value="<?php echo $tbl_stok->id_stok;?>">
					<div class="col-md-6">
						<div class="form-group">
							<label>	Stok </label>
							<input type="number" class="form-control" maxlength="11" name="akhir_stok" placeholder="Stok Akhir" value="<?php echo $tbl_stok->akhir_stok;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Penjualan </label>
							<input type="number" class="form-control" maxlength="11" name="penjualan_stok" placeholder="Penjualan Bulanan" value="<?php echo $tbl_stok->penjualan_stok;?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>	Persediaan </label>
							<input type="number" class="form-control" maxlength="11" name="persediaan_stok" placeholder="Persediaan Bulanan" value="<?php echo $tbl_stok->persediaan_stok;?>" required>
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