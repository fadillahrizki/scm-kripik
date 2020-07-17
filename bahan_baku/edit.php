<?php 
    $current = "data bahan baku";
    require_once '../layouts/header.php';

    $bahan_baku = single("tb_bahan_baku",$_GET['id']);

    if(isset($_POST["edit"])){
        unset($_POST["edit"]);
        $res = update("tb_bahan_baku",$_POST,$_GET['id']);
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
                    <div class="alert alert-success">Berhasil mengedit data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal mengedit data</div>
                <?php endif ?>
                <form method="post">
                    <div class="form-group">
                        <label>ID Bahan Baku</label>
                        <input type="text" name="id" disabled value="<?=$bahan_baku['id']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" value="<?=$bahan_baku['nama_bahan_baku']?>" oninvalid="this.setCustomValidity('Field ini harus di isi')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" value="<?=$bahan_baku['stok']?>" oninvalid="this.setCustomValidity('Field ini harus di isi')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok Minimal</label>
                        <input type="number" name="min_stok" value="<?=$bahan_baku['min_stok']?>" oninvalid="this.setCustomValidity('Field ini harus di isi')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" value="<?=$bahan_baku['harga']?>" oninvalid="this.setCustomValidity('Field ini harus di isi')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="<?=$bahan_baku['keterangan']?>" oninvalid="this.setCustomValidity('Field ini harus di isi')" class="form-control" required>
                    </div>
                    <button class="btn btn-success" name="edit">Edit</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once '../layouts/footer.php';
?>


