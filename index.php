<?php 
    $current = "dashboard";
    require_once 'layouts/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
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


