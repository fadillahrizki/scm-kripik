<?php 
    $current = "data pemesanan";
    require_once '../layouts/header.php';

    if(isset($_POST["create"])){
        unset($_POST["create"]);
        $res = insert("tb_pemesanan",$_POST);
        if($res){
            $success = true;
        }else{
            $failed = true;
        }
    }

    $bahan = get('tb_bahan_baku');
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
                        <label>ID Pemesanan</label>
                        <input type="text" name="id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>ID Admin</label>
                        <input type="text" name="id_admin" class="form-control" readonly value="<?=$_SESSION['user']['id']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bahan Baku</label>
                        <div id="bahan-baku" style="display:none;">
                            <?= json_encode($bahan) ?>
                        </div>
                        <select name="nama_bahan_baku" class="form-control" onchange="showPrice(event)">
                            <option value="">- Pilih Bahan Baku -</option>
                            <?php foreach($bahan as $bahan_baku): ?>
                                <option value="<?=$bahan_baku['nama_bahan_baku']?>"><?=$bahan_baku['nama_bahan_baku']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" id="price" readonly class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="hidden" name="keterangan" value="pesan" class="form-control" required>
                    </div>
                    <button class="btn btn-success" name="create">Tambah</button>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showPrice(e){
        let bahan = JSON.parse(document.querySelector("#bahan-baku").innerHTML)
        let name = e.target.value
        let bb = bahan.filter(b=>b.nama_bahan_baku == name)[0]
        let price = document.querySelector("#price")
        price.value = bb.harga
    }
</script>


<?php
    require_once 'layouts/footer.php';
?>



