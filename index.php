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
                        <h4 align="center">Bahan Baku Keripik UD Selasih</h4>
                        <p></p>
                        <div class="gallery">
                        <?php 
                        $items = [
                            "",
                            "Ubi Kayu",
                            "Sukun",
                            "Pisang",
                            "Ubi Rambat"
                        ];
                        for($i=1;$i<=4;$i++) { ?>
                            <div class="gallery-item">
                                <img src="/assets/bahan-baku-<?=$i?>.jpeg">
                                <center>
                                    <span><?= $items[$i] ?></span>
                                </center>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
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
                </div> -->
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'layouts/footer.php';
?>


