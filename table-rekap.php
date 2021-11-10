<?php
$tgl = date("Y/m/d");
include 'koneksi.php';
if( isset( $_REQUEST['sub'] )){
	$sub = $_REQUEST['sub'];

	include "laporan_tagihan.php";
} else {

	if(isset($_REQUEST['submit'])){
		$submit = $_REQUEST['submit'];
		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];

         //echo $tgl1.'-'.$tgl2;
		$q = "SELECT kelas,sum(jumlah) FROM pembayaran WHERE tgl_bayar BETWEEN '$tgl1' AND '$tgl2' GROUP BY kelas";

	} else {
		$tgl = date("Y/m/d");
		$q = "SELECT kelas,sum(jumlah) FROM pembayaran WHERE tgl_bayar='$tgl' GROUP BY kelas";

	}

	$sql = mysqli_query($koneksi,$q);

}
?>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
	<div class="pl-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Rekap Pembayaran</li>
			</ol>
		</nav>
	</div>

</div>
<div class="card">
	<div class="card-body">
		<div>
			<h5>Rekap Pembayaran</h5>
			<hr/>
			<div class="table-responsive">
				<table class="table table-striped table-bordered mb-0" id="table1">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Kelas</th>
							<th scope="col">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = 0;
						$no=1;
						while(list($kls,$jml) = mysqli_fetch_array($sql))
							{?>						
								<tr>
									<th scope="row"><?php echo $no?></th>
									<td><?php echo $kls?></td>
									<td><?php echo $jml?></td>
								</tr>
								<?php $no++;  $total += $jml;?>
							<?php }?>
							<?php
							echo '<tr><td colspan="2"><span class="pull-right">T O T A L</span></td><td><span class="pull-right">'.$total.'</span></td></tr>';
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>