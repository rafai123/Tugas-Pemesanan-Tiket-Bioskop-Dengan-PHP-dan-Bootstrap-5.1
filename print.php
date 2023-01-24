<?php

require_once __DIR__ . '/vendor/autoload.php';
require "function.php";
$kode = $_GET["kode"];
$film = query("SELECT * FROM pemesanan WHERE kode_unik = '$kode'")[0];
// var_dump($film);

$html = '<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>TIKET</title>
    <link rel="stylesheet" href="style/bootstrap.css">
</head>
<body>
    <body>
        <div class="container">
            <div class="row ">
                <div class="col-sm-5">
                    <h1><b>Ticket CynaPolis</b></h1>
                    <hr class="border border-dark border-2" >
                    <br>
                    <h3>'.$film["nama_film"].'</h3>
                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>'.$film["tanggal"].'</td>
                        </tr>
                        <tr>
                            <td>Nomor Bangku</td>
                            <td>:</td>
                            <td>'.$film["no_bangku"].'</td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td>'.$film["harga"].'</td>
                        </tr>
                        <tr>
                            <td>Kode Tiket</td>
                            <td>:</td>
                            <td><h3>'.$film["kode_unik"].'</h3></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Tiket CynaPolis.pdf', 'I');

?>
