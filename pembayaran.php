
<!--breadcrumb-->
<div  class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
	<div class="pl-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
			</ol>
		</nav>
	</div>

</div>
<!--end breadcrumb-->
<div class="card radius-15">
	<div style="margin: 30px"  class="card-body">
		<h4 class="mb-0">Pembayaran SPP</h4>
		<hr/>
		<form method="post">
			<div class="form-row">
				<div class="col-md-10">
					<div class="form-group mb-2">
						<input id="todo-input" type="text" name="nis" class="form-control form-control-lg" value="">
					</div>
				</div>
				<div class="col-md text-right">
					<button name="cari" style="height: 48px" class="btn btn-block btn-primary">Cari</button>
				</div>
			</div>
		</form>
		<?php
		include 'koneksi.php';
		if (isset($_POST['cari'])) 
		{
			$nis=$_POST['nis'];
			$qsiswa = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
			list($nis,$nama,$idprodi) = mysqli_fetch_array($qsiswa);
			echo '<div class="row">';
			echo '<div class="col-sm-12"><table class="table table-bordered">';
			echo '<tr><td colspan="2">Nomor Induk</td><td colspan="3">'.$nis.'</td>';
			echo '<td><a href="./cetak.php?nis='.$nis.'" target="_blank" class="btn btn-outline-primary m-1 px-5"><span class="glyphicon glyphicon-print" aria-hidden="true"></span><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
			<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
			<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
			</svg></i></a></td></tr>';
			echo '<tr><td colspan="2">Nama Siswa</td><td colspan="4">'.$nama.'</td></tr>';

			echo '<tr><td colspan="2">Pembayaran</td><td colspan="4">';
			?>
			<form class="form-inline" role="form" method="post" action="./admin.php?hlm=bayar">
				<input type="hidden" name="nis" value="<?php echo $nis; ?>">
				<input type="hidden" name="tgl" value="<?php echo date("Y-m-d"); ?>">
				<div class="form-group">
					<label class="sr-only" for="kls">Kelas</label>
					<select name="kls" class="form-control" id="kls">
						<?php
						$qkelas = mysqli_query($koneksi,"SELECT kelas,th_pelajaran FROM kelas WHERE nis='$nis'");
						while(list($kelas,$thn)=mysqli_fetch_array($qkelas)){
							echo '<option value="'.$kelas.'">'.$kelas.' ('.$thn.')</option>';
						}
						?>
					</select>
				</div>
				<div style="margin-left: 30px" class="form-group">
					<label class="sr-only" for="bln">Bulan</label>
					<select name="bln" id="bln" class="form-control">
						<?php
						for($i=1;$i<=12;$i++){
							$b = date('F',mktime(0,0,0,$i,10));
							echo '<option value="'.$b.'">'.$b.'</option>';
						}
						?>
					</select>
				</div>
				<div style="margin-left: 30px" class="form-group">
					<div class="input-group">
						
						<div class="input-group-prepend">	<span class="input-group-text">Rp</span>
						</div>
						<input type="text" class="form-control" name="jumlah" aria-label="Amount (to the nearest dollar)">
						<div class="input-group-append">	
						</div>

					</div>
				</div>
				<button style="margin-left: 30px" type="submit" class="btn btn-outline-success m-1 px-5" name="submit" value="bayar">Bayar</button>
			</form>
			<?php
			echo '</td></tr>';
			echo '<tr class="info"><th width="50">#</th><th width="100">Kelas</th><th>Bulan</th><th>Tanggal Bayar</th><th>Jumlah</th>';
			echo '<th>&nbsp;</th>';
			echo '</tr>';
			$qbayar = mysqli_query($koneksi,"SELECT kelas,bulan,tgl_bayar,jumlah FROM pembayaran WHERE nis='$nis' ORDER BY tgl_bayar DESC");
			if(mysqli_num_rows($qbayar) > 0){
				$no = 1;
				while(list($kelas,$bulan,$tgl,$jumlah) = mysqli_fetch_array($qbayar)){
					echo '<tr><td>'.$no.'</td>';
					echo '<td>'.$kelas.'</td>';
					echo '<td>'.$bulan.'</td>';
					echo '<td>'.$tgl.'</td>';
					echo '<td>'.$jumlah.'</td><td>';

					if( $_SESSION['admin'] == 1 ){
						echo '<a href="./admin.php?hlm=bayar&submit=hapus&kls='.$kelas.'&nis='.$nis.'&bln='.$bulan.'" class="btn btn-outline-danger ml-1"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg></i></a>';
					}
					echo ' <a href="./cetak.php?submit=nota&kls='.$kelas.'&nis='.$nis.'&bln='.$bulan.'" target="_blank" class="btn btn-outline-primary m-1"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
					<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
					<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
					</svg></i></a>';
					echo '</td></tr>';

					$no++;
				}
			} else {
				echo '<tr><td colspan="6"><em>Belum ada data!</em></td></tr>';
			}
		}
		?>
		<div class="form-row mt-3">
			<div class="col-12">
				<div id="todo-container"></div>
			</div>
		</div>
	</div>
</div>
