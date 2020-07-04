<?php 
    $current = "data pembelian";

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

    if(isset($_GET['available'])){
        $pem = single('tb_pembelian',$_GET['available']);
        $pem['keterangan'] = 'diterima';
        $res = update('tb_pembelian',$pem,$pem['id']);
        if($res){
            unset($_GET);
            header("location:index.php");
        }
    }

    if(isset($_GET['unavailable'])){
        $pem = single('tb_pembelian',$_GET['unavailable']);
        $pem['keterangan'] = 'ditolak';
        $res = update('tb_pembelian',$pem,$pem['id']);
        if($res){
            unset($_GET);
            header("location:index.php");
        }
    }

    if(isset($_GET['confirm'])){
        $pem = single('tb_pembelian',$_GET['confirm']);
        $pem['keterangan'] = 'selesai';
        $res = update('tb_pembelian',$pem,$pem['id']);
        
        if($res){
            $bahan = singleBahan($pem['nama_bahan_baku']);
            $bahan['stok'] += $pem['jumlah'];
            $res = updateBahan($bahan,$bahan['nama_bahan_baku']);
            if($res){
                unset($_GET);
                header("location:index.php");
            }
        }
    }

    require_once '../layouts/header.php';

    $pembelian = $_SESSION['user']['level'] == 'supplier' ? getForSupplier($_SESSION['user']['id']) : get("tb_pembelian");
    if(isset($_GET['filter'])){
        $pembelian = getPembelianFilter($_GET);
    }
?>

<style>

.text-print{
    display: none;
}

@media print{
    body  {
        visibility: hidden;
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5>Data Pembelian</h5>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success">Berhasil menghapus data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal menghapus data</div>
                <?php endif ?>
                <?php if($_SESSION['user']['level'] == 'admin'): ?>
                <form method="get" class="py-3 d-flex justify-content-start">    
                    <div class="form-group">
                        <label>Dari tanggal</label>
                        <input type="date" value="<?=@$_GET['from']?>" name="from" class="form-control">
                    </div>
                    <div class="form-group mx-3">
                        <label>Sampai tanggal</label>
                        <input type="date" value="<?=@$_GET['to']?>" name="to" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <br>
                        <button class="btn btn-info" name="filter">Cari</button>
                        <?php if(count($pembelian)):?>
                            <button class="btn btn-success" type="button" onclick="window.print()">Cetak</button>
                        <?php endif ?>
                    </div>
                </form>
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
                                    <h3>Laporan Pembelian</h3>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($pembelian) > 0): ?>
                                <?php foreach($pembelian as $pem): ?>
                                <tr>
                                    <td><?= $pem["id"] ?></td>
                                    <td>
                                        <b>Nama : <?= $pem["nama_bahan_baku"] ?></b>
                                        <br>
                                        <span>Harga : <?= number_format($pem["harga"]) ?></span>
                                        <br>
                                        <span>Tanggal : <?= $pem["tanggal"] ?></span>
                                    </td>
                                    <td><?= $pem["jumlah"] ?></td>
                                    <td>
                                    <?php if($pem['keterangan'] == 'checkout'): ?>
                                        <span class="badge badge-warning"><?= $pem["keterangan"] ?></span>
                                    <?php elseif($pem['keterangan']=='diterima'): ?>
                                        <span class="badge badge-info"><?= $pem["keterangan"] ?></span>
                                    <?php elseif($pem['keterangan']=='diterima'): ?>
                                        <span class="badge badge-danger"><?= $pem["keterangan"] ?></span>
                                    <?php elseif($pem['keterangan']=='selesai'): ?>
                                        <span class="badge badge-success"><?= $pem["keterangan"] ?></span>
                                    <?php elseif($pem['keterangan']=='ditolak'): ?>
                                        <span class="badge badge-danger"><?= $pem["keterangan"] ?></span>
                                    <?php endif ?>
                                    </td>
                                    <td><?= number_format($pem["total"]) ?></td>
                                    <?php if($_SESSION['user']['level'] == 'supplier'): ?>
                                        <td>
                                            <a href="index.php?available=<?=$pem['id']?>" class="badge badge-success">Bahan baku tersedia</a>
                                            <a href="index.php?unavailable=<?=$pem['id']?>" class="badge badge-danger">Bahan baku tidak tersedia</a>
                                        </td>
                                    <?php elseif($pem['keterangan'] == 'diterima'): ?>
                                        <td>
                                            <a href="index.php?confirm=<?=$pem['id']?>" class="badge badge-success">Konfirmasi</a>
                                        </td>
                                    <?php else: ?>
                                        <td>Tidak ada aksi</td>
                                    <?php endif ?>
                                </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="6">Tidak ada Data</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once '../layouts/footer.php';
?>

