<div  class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
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
<div class="card radius-15">
	<div style="margin: 30px" class="card-body">
		<div class="card-title">
			<h4 class="mb-0">Rekap Pembayaran</h4>
		</div>
		<hr/>
		<form method="post" action="admin.php?halaman=table-rekap">
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label>Awal</label>
						<input name="tgl1" class="form-control form-control-lg" type="date" placeholder="Masukan NIS">
					</div>
					<div class="col-md-6">
						<label>Akhir</label>
						<input name="tgl2" class="form-control form-control-lg" type="date" placeholder="Masukan NIS">
					</div>
				</div>
			</div>
			<button type="submit" name="submit" style="width: 110px; height:40px" class="btn btn-primary">Cari</button>
		</form>
		
		
		
	</div>
</div>