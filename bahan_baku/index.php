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

    $bahan = get("tb_bahan_baku");

?>
<style>

.text-print{
    display: none;
}

@media print{
    body  {
        visibility: hidden;
    }

    .hide-print {
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                    <h5>Data Bahan Baku</h5>
                    <div>
                    <button class="btn btn-primary btn-sm" type="button" onclick="window.print()">Cetak</button>
                    <a href="create.php" class="btn btn-success btn-sm">Tambah</a>
                    </div>
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
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Keterangan</th>
                                <th class="hide-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($bahan) > 0): ?>
                                <?php foreach($bahan as $bahan_baku): ?>
                                <tr>
                                    <td><?= $bahan_baku["id"] ?></td>
                                    <td><?= $bahan_baku["nama_bahan_baku"] ?></td>
                                    <td><?= number_format($bahan_baku["harga"]) ?></td>
                                    <td>
                                        <?= $bahan_baku["stok"] ?><br>
                                        <a href="#" class="badge badge-success hide-print">Min : <?= $bahan_baku['min_stok']?></a>
                                    </td>
                                    <td><?= $bahan_baku["keterangan"] ?></td>
                                    <td class="hide-print">
                                        <a href="pemakaian.php?id=<?=$bahan_baku['id']?>" class="badge badge-success hide-print">Pemakaian</a>
                                        <a href="edit.php?id=<?=$bahan_baku['id']?>" class="badge badge-warning hide-print">Edit</a>
                                        <a href="index.php?delete=<?=$bahan_baku['id']?>" class="badge badge-danger hide-print">Hapus</a>
                                    </td>
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


