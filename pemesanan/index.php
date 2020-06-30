<?php 
    $current = "data pemesanan";

    require_once '../qb.php';

    if(isset($_GET['delete'])){
        $res = delete('tb_pemesanan',$_GET['delete']);
        if($res){
            $success = true;
            unset($_GET);
            header("location:index.php");
        }else{
            $failed = true;
        }
    }

    $pemesanan = get("tb_pemesanan");
    $supplier = get("tb_supplier");

    if(isset($_POST['checkout'])){
        unset($_POST['checkout']);
        foreach($pemesanan as $pem){
            $pem['id_supplier'] = $_POST['id_supplier'];
            $pem['keterangan'] = 'checkout';
            $pem['total'] = $pem['harga']*$pem['jumlah'];
            unset($pem['id_admin']);
            $ins = insert('tb_pembelian',$pem);
            if($ins){
                $trun = truncate('tb_pemesanan');
                if($trun){
                    header("location:index.php");
                }
            }
        }
    }

    require_once '../layouts/header.php';

?>

<form method="post">
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Checkout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            <div class="form-group">
                <label>Supplier</label>
                <select name="id_supplier" class="form-control">
                    <option value="">- Pilih Supplier -</option>
                    <?php foreach($supplier as $supp): ?>
                        <option value="<?=$supp['id']?>"><?=$supp['nama_supplier']?></option>
                    <?php endforeach ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button class="btn btn-primary" name="checkout">Checkout</button>
      </div>
    </div>
  </div>
</div>
</form>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between py-3">
                    <h5>Data Pemesanan</h5>
                    <div>
                        <?php if(count($pemesanan)) : ?>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal">
                              Checkout
                            </button>
                        <?php endif ?>
                        <a href="create.php" class="btn btn-success btn-sm">Tambah</a>
                    </div>
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
                            <th>ID Admin</th>
                            <th>Nama Bahan Baku</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($pemesanan) > 0): ?>
                            <?php foreach($pemesanan as $pem): ?>
                            <tr>
                                <td><?= $pem["id"] ?></td>
                                <td><?= $pem["id_admin"] ?></td>
                                <td><?= $pem["nama_bahan_baku"] ?></td>
                                <td><?= $pem["tanggal"] ?></td>
                                <td><?= $pem["jumlah"] ?></td>
                                <td><?= number_format($pem["harga"]) ?></td>
                                <td> <span class="badge badge-warning"> <?= $pem["keterangan"] ?></span></td>
                                <td>
                                    <a href="edit.php?id=<?=$pem['id']?>" class="badge badge-warning">Edit</a>
                                    <a href="index.php?delete=<?=$pem['id']?>" class="badge badge-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td colspan="8">Tidak ada Data</td>
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

