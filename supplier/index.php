<?php 
    $current = "data supplier";

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

    $supplier = get("tb_supplier");
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                    <h5>Data Supplier</h5>
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
                            <th>Alamat</th>
                            <th>Nomor Handphone</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($supplier) > 0): ?>
                            <?php foreach($supplier as $supp): ?>
                            <tr>
                                <td><?= $supp["id"] ?></td>
                                <td><?= $supp["nama_supplier"] ?></td>
                                <td><?= $supp["alamat"] ?></td>
                                <td><?= $supp["no_handphone"] ?></td>
                                <td><?= $supp["username"] ?></td>
                                <td><?= $supp["email"] ?></td>
                                <td><?= $supp["password"] ?></td>
                                <td>
                                    <a href="edit.php?id=<?=$supp['id']?>" class="badge badge-warning">Edit</a>
                                    <a href="index.php?delete=<?=$supp['id']?>" class="badge badge-danger">Hapus</a>
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

