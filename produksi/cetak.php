<?php 
    require_once '../dompdf/autoload.inc.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    require_once '../qb.php';

    $produksi = get("tb_produksi");

$html = '
<div id="print">
    <table width="100%" cellpadding="5" width="100%">
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
                <h3>Laporan Produksi</h3>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-stripped" border="1" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>';
            if(count($produksi) > 0):
                foreach($produksi as $k => $p): 
                $html .= '
                <tr>
                    <td>'.++$k.'</td>
                    <td>'.$p['produk'].'<br>';
                    $produksi_bahan_baku = getBy('tb_produksi_bahan_baku',['produk'=>$p['produk']]);
                    foreach($produksi_bahan_baku as $b)
                    {
                        $bahan_baku = getBy('tb_bahan_baku',['nama_bahan_baku'=>$b['bahan_baku']])[0];
                        $jumlah = $p['jumlah'] * $b['jumlah'];
                        $html .= '<b>'.$b['bahan_baku'].'</b> : '.$jumlah.' Kg<br>';
                    }
                    $html .= '</td>
                    <td>'.$p['jumlah'].' Bungkus</td>
                    <td>'.$p['tanggal'].'</td>
                </tr>';
                endforeach;
            else:
                $html .= '
                <tr class="text-center">
                    <td colspan="4">Tidak ada Data</td>
                </tr>';
            endif;
        $html .= '
        </tbody>
    </table>
    <div class="py-3 text-print">
        <br><br>
        Di ketahui Oleh
        <br><br><br><br>
        <b>UD. SELASIH</b>
    </div>
</div>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan-Produksi.pdf");