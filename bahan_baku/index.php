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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                    <h5>Data Bahan Baku</h5>
                    <a href="create.php" class="btn btn-success btn-sm">Tambah</a>
                </div>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success">Berhasil menghapus data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal menghapus data</div>
                <?php endif ?>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($bahan) > 0): ?>
                            <?php foreach($bahan as $bahan_baku): ?>
                            <tr>
                                <td><?= $bahan_baku["id"] ?></td>
                                <td><?= $bahan_baku["nama_bahan_baku"] ?></td>
                                <td><?= number_format($bahan_baku["harga"]) ?></td>
                                <td><?= $bahan_baku["stok"] ?></td>
                                <td><?= $bahan_baku["keterangan"] ?></td>
                                <td>
                                    <a href="edit.php?id=<?=$bahan_baku['id']?>" class="badge badge-warning">Edit</a>
                                    <a href="index.php?delete=<?=$bahan_baku['id']?>" class="badge badge-danger">Hapus</a>
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

<?php
    require_once '../layouts/footer.php';
?>


