<?php 
    $current = "dashboard";
    require_once 'layouts/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        $bahan = get("tb_bahan_baku");
                        foreach($bahan as $bahan_baku):
                            if($bahan_baku['stok'] > $bahan_baku['min_stok']) continue;
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Stok Bahan Baku <?= $bahan_baku['nama_bahan_baku'] ?> sudah mencapai batas minimal dan harus di pesan.
                            Silahkan klik <a href="/pemesanan/create.php?bahan_baku=<?=$bahan_baku['nama_bahan_baku']?>">disini</a> untuk memesan bahan baku.
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-text">Data Bahan Baku</span>
                            </div>
                            <div class="card-body">
                            <?= getCount("tb_bahan_baku") ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-text">Data Supplier</span>
                            </div>
                            <div class="card-body">
                                <?= getCount("tb_supplier") ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-text">Data Pemesanan</span>
                            </div>
                            <div class="card-body">
                                <?= getCount("tb_pemesanan") ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-text">Data Pembelian</span>
                            </div>
                            <div class="card-body">
                                <?= getCount("tb_pembelian") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'layouts/footer.php';
?>


