<?php 
    $current = "data bahan baku";

    require_once '../qb.php';

    if(isset($_GET['delete'])){
        $res = delete('tb_bahan_baku',$_GET['delete']);
        if($res){
            $success = true;
            unset($_GET);
            header("location:index.php");
        }else{
            $failed = true;
        }
    }

    require_once '../layouts/header.php';

    if($_SESSION['user']['level'] == 'admin')
        $bahan = get("tb_bahan_baku");
    else
        $bahan = getBy("tb_bahan_baku",['supplier_id'=>$_SESSION['user']['id']]);

    $bulan = [
    	1 => 'Januari',
    	2 => 'Februari',
    	3 => 'Maret',
    	4 => 'April',
    	5 => 'Mei',
    	6 => 'Juni',
    	7 => 'Juli',
    	8 => 'Agustus',
    	9 => 'September',
    	10 => 'Oktober',
    	11 => 'November',
    	12 => 'Desember',
    ];

?>
<style>

.text-print{
    display: none;
}

@media print{
    body  {
        visibility: hidden;
    }

    .hide-print, .dataTables_paginate.paging_simple_numbers {
        display: none;
    }

    .text-print{
        display: block;
    }

    #print {
        visibility: visible;
        position: fixed;
        top:0;
        left:0;
        width: 100%;
    }
}

</style>
<form action="cetak.php">
	<div class="modal fade" id="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTitle">Laporan Pemakaian</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        
	            <div class="form-group">
	                <label>Bulan</label>
	                <select name="bulan" class="form-control" required="">
	                    <option value="">- Pilih Bulan -</option>
	                    <?php foreach($bulan as $k => $v): ?>
	                        <option value="<?=$k?>"><?=$v?></option>
	                    <?php endforeach ?>
	                </select>
	            </div>
	            <div class="form-group">
	                <label>Tahun</label>
	                <select name="tahun" class="form-control" required="">
	                    <option value="">- Pilih Tahun -</option>
	                    <?php for($i=2020;$i>=2000;$i--): ?>
	                        <option value="<?=$i?>"><?=$i?></option>
	                    <?php endfor ?>
	                </select>
	            </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	        <button class="btn btn-primary">Cetak</button>
	      </div>
	    </div>
	  </div>
	</div>
</form>

     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bahan Baku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Bahan Baku</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                    <h5>Data Bahan Baku</h5>
                    <?php if($_SESSION['user']['level'] == 'admin'): ?>
                    <div>
                    <a href="cetak-bahan-baku.php" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak</a>
                    <a href="create.php" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                    <!-- <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="fa fa-print"></i> Laporan Pemakaian</a> -->
                    </div>
                    <?php endif ?>
                </div>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success">Berhasil menghapus data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal menghapus data</div>
                <?php endif ?>
                <div id="print">
                    <div class="text-center py-3 text-print">
                        <table width="100%">
                            <tr>
                                <td width="100px">
                                    <img src="../assets/logo.jpeg" width="100%">
                                </td>
                                <td>
                                    <center>
                                    <h4>UD SELASIH SENTANG</h4>
                                    <p>Jl. Jahe Lk IV No 34 Sentang, Kisaran Timur</p>
                                    </center>
                                </td>
                            </tr>    
                            <tr>
                                <td colspan="2">
                                    <hr>
                                    <h3>Data Bahan Baku</h3>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supplier</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th class="hide-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($bahan) > 0): ?>
                                <?php 
                                foreach($bahan as $bahan_baku): 
                                    $bg = '';
                                    $keterangan = 'Tersedia';
                                    if($bahan_baku["stok"] <= $bahan_baku['min_stok'] && $bahan_baku['stok'] != 0)
                                    {
                                        $bg = 'bg-warning';
                                        $keterangan = 'Tersedia tetapi sudah hampir habis';
                                    }
                                    elseif($bahan_baku['stok'] == 0)
                                    {
                                        $keterangan = 'Stok Habis';
                                        $bg = 'bg-danger';
                                    }

                                ?>
                                <tr class="<?= $bg ?>">
                                    <td><?= $bahan_baku["id"] ?></td>
                                    <td><?= single("tb_supplier",$bahan_baku["supplier_id"])["nama_supplier"] ?></td>
                                    <td><?= $bahan_baku["nama_bahan_baku"] ?></td>
                                    <td>Rp. <?= number_format($bahan_baku["harga"]) ?></td>
                                    <td>
                                        <?= $bahan_baku["stok"] ?> Kg<br>
                                        <a href="#" class="badge badge-success hide-print">Min : <?= $bahan_baku['min_stok']?> Kg</a>
                                    </td>
                                    <td><?= $keterangan ?></td>
                                    <td class="hide-print">
                                        <?php if($_SESSION['user']['level'] == 'admin'): ?>
                                        <!-- <a href="pemakaian.php?id=<?=$bahan_baku['id']?>" class="badge badge-success hide-print">Pemakaian</a> -->
                                        <a href="edit.php?id=<?=$bahan_baku['id']?>" class="badge badge-warning hide-print"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="index.php?delete=<?=$bahan_baku['id']?>" class="badge badge-danger hide-print"><i class="fa fa-trash"></i> Hapus</a>
                                        <?php else: ?>
                                            <?php if($bahan_baku['stok'] <= $bahan_baku['min_stok']): ?>
                                        <a href="https://web.whatsapp.com/send?phone=6282273329997&text=Stok <?=$bahan_baku['nama_bahan_baku']?> anda sudah hampir habis. apakah anda akan memesan lagi ?" class="badge badge-success hide-print"><i class="fa fa-whatsapp"></i> Kirim Pesan WA</a>
                                        <?php else: ?>
                                            -
                                        <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="7">Tidak ada Data</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <div class="py-3 text-print">
                        Di ketahui Oleh
                        <br><br><br><br>
                        <b>UD. SELASIH</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once '../layouts/footer.php';
?>


