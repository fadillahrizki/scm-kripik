<?php 
    $current = "data supplier";
    require_once '../layouts/header.php';

    if(isset($_POST["create"])){
        unset($_POST["create"]);
        $res = insert("tb_supplier",$_POST);
        if($res){
            $success = true;
        }else{
            $failed = true;
        }
    }
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if(isset($success)): ?>
                    <div class="alert alert-success">Berhasil menambah data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal menambah data</div>
                <?php endif ?>
                <form method="post">
                    <div class="form-group">
                        <label>ID Supplier</label>
                        <input type="text" name="id" value="<?= substr(md5(strtotime(date('Y-m-d H:i:s'))), 0, 8) ?>" class="form-control" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input type="tel" name="no_handphone" maxlength="12" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{8,}$" required>
                    </div>
                    <button class="btn btn-success" name="create">Tambah</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once '../layouts/footer.php';
?>


