<?php 
    require_once '../dompdf/autoload.inc.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    $current = "data supplier";

    require_once '../qb.php';

    if(isset($_GET['delete'])){
        $res = delete('tb_supplier',$_GET['delete']);
        if($res){
            $success = true;
            unset($_GET);
            header("location:index.php");
        }else{
            $failed = true;
        }
    }

    $supplier = get("tb_supplier");

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
                                    <h3>Data Supplier</h3>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table class="table table-bordered table-stripped" width="100%" border="1" cellpadding="5">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nomor Handphone</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>';
                            if(count($supplier) > 0):
                                foreach($supplier as $supp):
                                $html .= '
                                <tr>
                                    <td>'.$supp["id"].'</td>
                                    <td>'.$supp["nama_supplier"].'</td>
                                    <td>'.$supp["alamat"].'</td>
                                    <td>'.$supp["no_handphone"].'</td>
                                    <td>'.$supp["username"].'</td>
                                    <td>'.$supp["email"].'</td>
                                </tr>';
                            endforeach;
                            else:
                            $html .= '
                                <tr class="text-center">
                                    <td colspan="5">Tidak ada Data</td>
                                </tr>';
                            endif;
                    $html.='
                        </tbody>
                    </table>
                    <div class="py-3 text-print">
                        <br><br>
                        Di ketahui Oleh
                        <br><br><br><br>
                        <b>UD. SELASIH</b>
                    </div>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan-Supplier.pdf");