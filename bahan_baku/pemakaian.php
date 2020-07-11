<?php 
    $current = "data bahan baku";
    require_once '../layouts/header.php';

    $bahan_baku = single("tb_bahan_baku",$_GET['id']);

    if(isset($_POST["simpan"])){
        unset($_POST["simpan"]);
        $res = insert("tb_pemakaian",$_POST);
        updateBahan(['stok'=>$bahan_baku['stok']-$_POST['jumlah']],$_POST['nama_bahan_baku']);
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
                    <div class="alert alert-success">Berhasil meyimpan data</div>
                <?php elseif(isset($failed)): ?>
                    <div class="alert alert-danger">Gagal meyimpan data</div>
                <?php endif ?>
                <form method="post">
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" readonly="" value="<?=$bahan_baku['nama_bahan_baku']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="" class="form-control" required>
                    </div>
                    <button class="btn btn-success" name="simpan">Simpan</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require_once '../layouts/footer.php';
?>


