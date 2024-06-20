 <!-- Begin Page Content -->
<div class="container-fluid">     
	<div class="card shadow bg-info pt-3">
		<div class="container">
			<h3 class="text-title text-light"> DATA STOK OBAT</h3>
		</div>
	</div>

	<!-- DataTales Example -->
    <div class="card shadow mb-4 mt-2">
        <div class="card-header py-3">
            <a href="<?php echo base_url()."Obat/add"; ?>"><button type="button" class="btn btn-primary">Tambah</button></a>
             <button id="btn-tambah-stock" class="btn btn-info" >Tambah stock Produk </button>
        </div>


    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Id Obat</th>
                            <th style="text-align: center;">Nama Obat</th>
                            <th style="text-align: center;">Harga Beli</th>
                             <th style="text-align: center;">Harga Jual</th>
                            <th style="text-align: center;">Jumlah Stok</th>
                            <th style="text-align: center;">Satuan</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($obat as $o){?>
                            <tr style="font-size: 14px">
                                <td style="text-align: center;"><?php echo $o['id_obat']; ?></td>
                                <td style="text-align: center;"><?php echo $o['nama_obat']; ?></td>
                                <td style="text-align: center;"><?php echo "Rp. " .number_format($o['harga_beli'],'0',',','.'); ?></td>
                                <td style="text-align: center;"><?php echo "Rp. " .number_format($o['harga_jual'],'0',',','.');?></td>
                                <td style="text-align: center;"><?php echo $o['stok']; ?></td>
                                <td style="text-align: center;"><?php echo $o['satuan']?></td>
                                <td style="text-align: center;">
                                    <a href="<?php echo base_url()."/obat/detail/".$o['id_obat']; ?>" style="text-decoration: none;" title="Informasi Lengkap"><button type="button" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-list"></i></button>
                                    <a href="<?php echo base_url()."obat/edit/".$o['id_obat']; ?>" style="text-decoration: none;" title="Ubah Data"><button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    <a href="<?php echo base_url()."/obat/delete/".$o['id_obat']; ?>" style="text-decoration: none;" title="Hapus Data"><button type="button" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin anda akan menghapus data ini ?');"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
					</tbody>
            	</table>
        	</div>
    	</div>
    </div>
 </div>
<!-- /.container-fluid -->



<script type="text/javascript">

        // EVENT CLICK TOMBOL TAMBAH
        $(document).on('click','#btn-tambah-stock',function(event){
            event.preventDefault();
            window.location.href = "<?php echo base_url('obat/stok_obat') ?>";
         
        });

</script>