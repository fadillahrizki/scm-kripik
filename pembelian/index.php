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
        $pem = single('tb_pembelian',$_GET['available']);
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
?>

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

<?php
    require_once '../layouts/footer.php';
?>

