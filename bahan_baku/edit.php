<?php 
    $current = "data bahan baku";
    require_once '../layouts/header.php';

    $bahan_baku = single("tb_bahan_baku",$_GET['id']);
    $suppliers = get("tb_supplier");

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

<!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Bahan Baku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/bahan_baku/index.php">Bahan Baku</a></li>              
              <li class="breadcrumb-item active">Edit Bahan Baku</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

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
                    <input type="hidden" name="id" disabled value="<?=$bahan_baku['id']?>" class="form-control" required>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" class="form-control">
                            <?php foreach($suppliers as $supplier): ?>
                                <?php if($bahan_baku['supplier_id'] == $supplier['id']) : ?>
                                    <option value="<?=$supplier['id']?>" selected><?=$supplier['nama_supplier']?></option>
                                <?php else: ?>
                                    <option value="<?=$supplier['id']?>"><?=$supplier['nama_supplier']?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan_baku" value="<?=$bahan_baku['nama_bahan_baku']?>" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" value="<?=$bahan_baku['stok']?>" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok Minimal</label>
                        <input type="number" name="min_stok" value="<?=$bahan_baku['min_stok']?>" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" value="<?=$bahan_baku['harga']?>" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="<?=$bahan_baku['keterangan']?>" oninvalid="setCustomValidity('Field ini harus di isi')" oninput="setCustomValidity('')" class="form-control" required>
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


