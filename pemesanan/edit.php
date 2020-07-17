<?php 
    $current = "data pemesanan";
    require_once '../layouts/header.php';

    $pemesanan = single("tb_pemesanan",$_GET['id']);

    if(isset($_POST["edit"])){
        unset($_POST["edit"]);
        $res = update("tb_pemesanan",$_POST,$_GET['id']);
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
                    <input type="hidden" name="id_admin" value="<?=$pemesanan['id_admin']?>" required>
                    <div class="form-group">
                        <label>ID Pemesanan</label>
                        <input type="text" name="id" class="form-control" disabled value="<?=$pemesanan['id']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" value="<?=$pemesanan['nama_bahan_baku']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" value="<?=$pemesanan['tanggal']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" value="<?=$pemesanan['jumlah']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" value="<?=$pemesanan['harga']?>" required>
                    </div>
                    <!-- <div class="form-group"> -->
                        <!-- <label>Keterangan</label> -->
                        <input type="hidden" name="keterangan" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" value="<?=$pemesanan['keterangan']?>" required>
                    <!-- </div> -->
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


