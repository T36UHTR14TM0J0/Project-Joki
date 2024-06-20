
<div class="container">
	<div class="alert alert-success" role="alert">
		<h4 class="text-title text-center text-dark text-uppercase">Selamat Datang disistem informasi pelayanan kesehatan bidan ulfi</h4>
	</div>
</div>				
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Transaksi Obat</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_transaksi_obat; ?></h2>
						<a href="<?php echo base_url('laporan_obat'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Transaksi Periksa</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_transaksi_periksa; ?></h2>
						<a href="<?php echo base_url('laporan_transaksi'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Data Pasien</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_pasien; ?></h2>
						<a href="<?php echo base_url('pasien'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Data Periksa Umum</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_umum; ?></h2>
						<a href="<?php echo base_url('pel_umum'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Data Bayi</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_bayi; ?></h2>
						<a href="<?php echo base_url('pel_bayi'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Data Ibu Hamil</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_bumil; ?></h2>
						<a href="<?php echo base_url('pel_bumil'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-primary mb-3 text-center text-primary">
					<div class="card-header">
						<h5 class="text-title">Data KB</h5>
					</div>
					<div class="card-body text-primary">
						<h2><?php echo $jml_kb; ?></h2>
						<a href="<?php echo base_url('pel_kb'); ?>"><<-Lihat->></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>							