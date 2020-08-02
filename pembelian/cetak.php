<?php 
    require_once '../dompdf/autoload.inc.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    $current = "data pembelian";

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

    if(isset($_GET['available'])){
        $pem = single('tb_pembelian',$_GET['available']);
        $pem['keterangan'] = 'diterima';
        $res = update('tb_pembelian',$pem,$pem['id']);
        if($res){
            unset($_GET);
            header("location:index.php");
        }
    }

    if(isset($_GET['unavailable'])){
        $pem = single('tb_pembelian',$_GET['unavailable']);
        $pem['keterangan'] = 'ditolak';
        $res = update('tb_pembelian',$pem,$pem['id']);
        if($res){
            unset($_GET);
            header("location:index.php");
        }
    }

    if(isset($_GET['confirm'])){
        $pem = single('tb_pembelian',$_GET['confirm']);
        $pem['keterangan'] = 'selesai';
        $res = update('tb_pembelian',$pem,$pem['id']);
        
        if($res){
            $bahan = singleBahan($pem['nama_bahan_baku']);
            $bahan['stok'] += $pem['jumlah'];
            $res = updateBahan($bahan,$bahan['nama_bahan_baku']);
            if($res){
                unset($_GET);
                header("location:index.php");
            }
        }
    }

    // require_once '../layouts/header.php';

    $pembelian = $_SESSION['user']['level'] == 'supplier' ? getForSupplier($_SESSION['user']['id']) : get("tb_pembelian");
    if(isset($_GET['filter'])){
        $pembelian = getPembelianFilter($_GET);
    }

    
$html = '<div id="print">
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
                    <h3>Laporan Pembelian</h3>
                    <div style="text-align: left">
                    <b>Tanggal Awal :</b> '.(isset($_GET['from']) && $_GET['from'] != "" ? $_GET['from'] : '-').'<br>
                    <b>Tanggal Akhir :</b> '.(isset($_GET['to']) && $_GET['to'] != "" ? $_GET['to'] : '-').'<br>
                    <b>Status :</b> '.(isset($_GET['status']) && $_GET['status'] != "" ? $_GET['status'] : '-').'<br>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <table class="table table-bordered table-stripped" width="100%" border="1" cellpadding="5">
        <colgroup>
            <col width="10%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="30%">
        </colgroup>
        <thead>
            <tr>
                <th>ID</th>
                <th>Bahan Baku</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>';
            if(count($pembelian) > 0):
                foreach($pembelian as $k => $pem):
                $html .= '<tr>
                    <td>'.++$k.'</td>
                    <td>
                        <b>Nama : '.$pem["nama_bahan_baku"].'</b>
                        <br>
                        <span>Harga : Rp. '.number_format($pem["harga"]).'</span>
                        <br>
                        <span>Tanggal : '.$pem["tanggal"].'</span>
                    </td>
                    <td>'.$pem["jumlah"].' Kg</td>
                    <td>';
                    if($pem['keterangan'] == 'checkout'):
                        $html .= '<span class="badge badge-warning">Sedang di Proses</span>';
                    elseif($pem['keterangan']=='diterima'):
                        $html .= '<span class="badge badge-info">'.$pem["keterangan"].'</span>';
                    elseif($pem['keterangan']=='diterima'):
                        $html .= '<span class="badge badge-danger">'.$pem["keterangan"].'</span>';
                    elseif($pem['keterangan']=='selesai'):
                        $html .= '<span class="badge badge-success">'.$pem["keterangan"].'</span>';
                    elseif($pem['keterangan']=='ditolak'):
                        $html .= '<span class="badge badge-danger">'.$pem["keterangan"].'</span>';
                    endif;
                    $html .= '</td>
                    <td>Rp. '.number_format($pem["total"]).'</td>
                </tr>';
                endforeach;
            else:
                $html .= '<tr class="text-center">
                    <td colspan="6">Tidak ada Data</td>
                </tr>';
            endif;
        $html .= '</tbody>
    </table>
    <br><br>
    Kisaran, '.date("d-m-Y").'<br>
    <b>Diketahui Oleh</b>

    <br><br><br><br><br>
    <b>SELAMET</b>
</div>';


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan-Pembelian.pdf");