<style>
table, th, td{
	text-align: center;
	font-size: 8pt;
}
</style>
			<main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
						<h5 style="text-align:right;" class="mt-4">
						<input type="button" onclick="printDiv('printableArea')" value="Cetak" />
						
						<select onchange="if (this.value) window.location.href=this.value">
							<option value=""><?php echo $nama_barang;?></option>
							<?php foreach($tbl_barang as $barang){ ?>
								<option value="<?php echo base_url();?>analisis/index/<?php echo $barang->kode_barang;?>"><?php echo $barang->nama_barang;?></option>
							<?php } ?>
						</select>
						</h5>
                        
						<div id="printableArea">
							<ol class="breadcrumb mb-4">
								<li class="breadcrumb-item active">Analisis RLB</li>
							</ol>
							<div class="card mb-4">
							   <div class="card-body">
									<div class="table-responsive">
										
										<table border="1px" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Bulan</th>
													<th>Stok Akhir (X1)</th>
													<th>Penjualan (X2)</th>
													<th>Persediaan (Y)</th>
													<th>X1Y</th>
													<th>X2Y</th>
													<th>X1X2</th>
													<th>X1<sup>2</sup></th>
													<th>X2<sup>2</sup></th>
												</tr>
											</thead>
											<tbody>
												<?php 
												foreach($tbl_stok as $stok){ ?>
												<tr>
													<td><?php echo $stok->bulan;?></td>	
													<td><?php echo number_format($stok->X1);?></td>	
													<td><?php echo number_format($stok->X2);?></td>	
													<td><?php echo number_format($stok->Y);?></td>	
													<td><?php echo number_format($stok->X1Y);?></td>	
													<td><?php echo number_format($stok->X2Y);?></td>	
													<td><?php echo number_format($stok->X1X2);?></td>	
													<td><?php echo number_format($stok->X12);?></td>	
													<td><?php echo number_format($stok->X22);?></td>
												</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<th>Jumlah (&Sigma;)</th>	
													<th><?php echo number_format($tbl_analisa->totalX1);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX2);?></th>	
													<th><?php echo number_format($tbl_analisa->totalY);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX1Y);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX2Y);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX1X2);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX12);?></th>	
													<th><?php echo number_format($tbl_analisa->totalX22);?></th>
												</tr>
												<tr>
													<th>Jumlah Data</th>	
													<th colspan="8"><?php echo $tbl_analisa->jumlah;?></th>	
												</tr>
												<tr>
													<th colspan="9">Stok barang untuk selanjutnya adalah sebanyak 
													<?php 
	$jumlah = $tbl_analisa->jumlah; 
	$totalX1 = $tbl_analisa->totalX1;
	$totalX2 = $tbl_analisa->totalX2;
	$totalY = $tbl_analisa->totalY;
	$totalX1Y = $tbl_analisa->totalX1Y;
	$totalX2Y = $tbl_analisa->totalX2Y;
	$totalX1X2 = $tbl_analisa->totalX1X2;
	$totalX12 = $tbl_analisa->totalX12;
	$totalX22 = $tbl_analisa->totalX22;
	$X1 = $tbl_analisa->X1;
	$X2 = $tbl_analisa->X2;
	$detA = $tbl_analisa->detA;

	$detA = $jumlah*($totalX12*$totalX22-$totalX1X2*$totalX1X2)+
	$totalX1*($totalX1X2*$totalX2-$totalX1*$totalX22)+
	$totalX2*($totalX1*$totalX1X2-$totalX12*$totalX2);

	$detA1 = $totalY*($totalX12*$totalX22-$totalX1X2*$totalX1X2)+
	$totalX1Y*($totalX1X2*$totalX2-$totalX1*$totalX22)+
	$totalX2Y*($totalX1*$totalX1X2-$totalX12*$totalX2);

	$detA2 = $jumlah*($totalX1Y*$totalX22-$totalX2Y*$totalX1X2)+
	$totalX1*($totalX2Y*$totalX2-$totalY*$totalX22)+
	$totalX2*($totalY*$totalX1X2-$totalX1Y*$totalX2);

	$detA3 = $jumlah*($totalX12*$totalX2Y-$totalX1X2*$totalX1Y)+
	$totalX1*($totalX1X2*$totalY-$totalX1*$totalX2Y)+
	$totalX2*($totalX1*$totalX1Y-$totalX12*$totalY);

	if ($detA <= 0) $detA = 1;

	$b0 = $detA1/$detA;
	$b1 = $detA2/$detA; 
	$b2 = $detA3/$detA;

	$Y = ROUND($b0 + ($b1 * $X1) + ($b2 * $X2),0);

													echo $Y;
													
													echo " ".$satuan_barang;
													?>
													
													</th>	
												</tr>
											</tfoot>
										</table>
										<br>
										<table width="60%">
											<tr>
												<td colspan="2">
													<table border="1px" width="100%" cellspacing="0">
														<tr>
															<th colspan="3" style="text-align:center; ">Matriks A</th>
															<th style="text-align:center;">Matriks H</th>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->jumlah);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalY);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX12);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1Y);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX22);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2Y);?></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td>
												<br>
													<table border="1px" width="100%" cellspacing="0">
														<tr>
															<th colspan="3" style="text-align:center; ">Matriks A1</th>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalY);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1Y);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX12);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2Y);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX22);?></td>
														</tr>
													</table>
												</td>
												<td width="25%">
												</td>
											</tr>
											<tr>
												<td>
												<br>
													<table border="1px" width="100%" cellspacing="0">
														<tr>
															<th colspan="3" style="text-align:center; ">Matriks A2</th>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->jumlah);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalY);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1Y);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2Y);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX22);?></td>
														</tr>
													</table>
												</td>
												<td width="25%">
												</td>
											</tr>
											<tr>
												<td>
												<br>
													<table border="1px" width="100%" cellspacing="0">
														<tr>
															<th colspan="3" style="text-align:center; ">Matriks A3</th>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->jumlah);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalY);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX12);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1Y);?></td>
														</tr>
														<tr>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX1X2);?></td>
															<td style="text-align:center; width:25%;"><?php echo number_format($tbl_analisa->totalX2Y);?></td>
														</tr>
													</table>
												</td>
												<td width="25%">
												</td>
											</tr>
										</table>	
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
$(document).ready(function() {
$('#datastok').DataTable({
        "lengthMenu": [[12, 24, -1], [12, 24, "All"]],
		"searching": false, "bPaginate": false, "bInfo" : false
    });
	});
</script>