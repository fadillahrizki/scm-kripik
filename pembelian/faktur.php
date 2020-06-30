<?php 
    $current = "faktur pembelian";
    require_once '../layouts/header.php';

    if(isset($_GET['filter'])){
        $pembelian = getFaktur($_SESSION['user']['id'],$_GET);
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
                <h5>Faktur Pembelian</h5>
                <form method="get" class="py-3 d-flex justify-content-start">    
                    <div class="form-group">
                        <label>Dari tanggal</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div class="form-group mx-3">
                        <label>Sampai tanggal</label>
                        <input type="date" name="to" class="form-control">
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
                <div id="print">
                    <div class="text-center py-3 text-print">
                        <h4>UD SELASIH SENTANG</h4>
                        <p>Jln. Sentang Kisaran No.4,Asahan, Sumatera Utara</p>
                    </div>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($pembelian) > 0): ?>
                                <?php $total=0; foreach($pembelian as $pem): $total += $pem['total'];?>
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
                                </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td colspan="4"> <b> Total :  </b></td>
                                    <td> <b> <?=number_format($total)?> </b> </td>
                                </tr>
                            <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="5">Tidak ada Data</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <div class="text-print pt-5">
                        <p class="mb-5">Diketahui Oleh</p>
                        <p><?=$_SESSION['user']['nama_supplier']?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    require_once '../layouts/footer.php';
?>


