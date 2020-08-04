<?php 
    require_once '../dompdf/autoload.inc.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    $current = "data bahan baku";

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

    if($_SESSION['user']['level'] == 'admin')
        $bahan = get("tb_bahan_baku");
    else
        $bahan = getBy("tb_bahan_baku",['supplier_id'=>$_SESSION['user']['id']]);

$html = '
<div id="print">
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
                    <h3>Data Bahan Baku</h3>
                </td>
            </tr>
        </table>
    </div>
    <table class="table table-bordered table-stripped" width="100%" border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>';
            if(count($bahan) > 0):
                foreach($bahan as $bahan_baku): 
                    $bg = '';
                    if($bahan_baku["stok"] <= $bahan_baku['min_stok'] && $bahan_baku['stok'] != 0)
                        $bg = 'bg-warning';
                    elseif($bahan_baku['stok'] == 0)
                        $bg = 'bg-danger';
                $html .= '
                <tr class="'.$bg.'">
                    <td>'.$bahan_baku["id"].'</td>
                    <td>'.single("tb_supplier",$bahan_baku["supplier_id"])["nama_supplier"].'</td>
                    <td>'.$bahan_baku["nama_bahan_baku"].'</td>
                    <td>Rp. '.number_format($bahan_baku["harga"]).'</td>
                    <td>
                        '.$bahan_baku["stok"].' Kg
                    </td>
                    <td>'.$bahan_baku["keterangan"].'</td>
                </tr>';
                endforeach;
            else:
                $html .= '
                <tr class="text-center">
                    <td colspan="6">Tidak ada Data</td>
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
$dompdf->stream("Laporan-bahan-baku.pdf");