<?php 
    session_start();
    require "function.php";

    $id = $_GET["id"];
    $jam = $_GET["jam"];
    $hari = $_GET["hari"];
    $query = "SELECT * FROM film WHERE id_film = $id";
    $barang = query("SELECT * FROM film WHERE id_film = $id");
    // var_dump($barang);
    $content = query($query)[0];

    if ( isset($_POST["buy"]) ) {
        // var_dump($_POST);
        // $tgl = date('d-m-o');
        // var_dump($tgl);
        // die;
        if ( buy($_POST) > 0 ) {
            echo "
                <script>
                    alert('Tiket Berhasil Di Beli');
                    document.location.href = 'order.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Tiket gagal di beli');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
    $name_film = $content["name_film"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/manual.css">
    <style>
        .bangku:hover {
            box-shadow: 2px 2px 5px black;
        }
    </style>
</head>
<body style="background-image: url('img/background/bg_bride.jpg');  background-size: cover; background-repeat: repeat-y;" >
    <!-- Navbar -->
    <!-- <div class="container-fluid"> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php">CynaPolis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Now Showing</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="order.php">Riwayat Pesan</a>
                    </li>
                <?php if ($_SESSION["level"] == 'admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Tambah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit.php">Edit</a>
                    </li>
                <?php endif; ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end" >
                <li class="nav-item ms-3">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Username : <?php echo $_SESSION["username"]; ?></a>
                </li>
            </ul>    
                <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            <form class="d-flex" action="" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                <button class="btn btn-outline-light" type="submit" name="search">Search</button>
            </form>
            
            </div>
        </div>
        </nav>
    <!-- </div> -->
    <!-- End Navbar -->

    <!-- Form -->
    <div class="container-fluid show" style="margin-top: 56px;">
        
            <div class="row d-flex justify-content-center" style="margin: auto;">
                <div class="col-sm"></div>
                <div class="col-sm-8 border-secondary p-1 rounded show-bold">
                    <div class="row align-items-center">
                        <div class="col ">
                        <h1 class="danger text-primary text-center mb-4">Pembelian</h1>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm">
                                <img class="text-center" src="img/<?php echo $content["image"] ?>" alt="" width="90%">
                            </div>
                            <div class="col-sm">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <table class="text-white">
                                    <tr>
                                        <td>Judul</td>
                                        <td> </td>
                                        <td> :</td>
                                        <td><?= $content["name_film"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td> </td>
                                        <td> :</td>
                                        <td><?= $_SESSION["username"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hari</td>
                                        <td> </td>
                                        <td> :</td>
                                        <td><?= $hari  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jam</td>
                                        <td> </td>
                                        <td> :</td>
                                        <td><?= $jam  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td> </td>
                                        <td> :</td>
                                        <td>Rp <?= number_format($content["harga"])  ?></td>
                                    </tr>
                                </table>
                                <br>
                                <div class="container rounded" style="background-color: #fff;">
                                    <div class="row rounded">
                                        <div class="col-sm">
                                            <div class="bg-dark text-white text-center">LAYAR</div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        
                                            <?php for($i = 1; $i <= 20; $i++) : ?>
                                                <div class="col-sm-3">
                                                    <?php $result = mysqli_query($conn, "SELECT * FROM pemesanan INNER JOIN film ON pemesanan.id_film = film.id_film WHERE no_bangku = '$i' AND name_film = '$name_film'"); ?>
                                                    <?php if (mysqli_num_rows($result) == '1') : ?>
                                                        <div class="text-center rounded text-white bg-danger m-1" style="width: 100%;" id="bangku_mati<?= $i; ?>"><?= $i ?></div>
                                                        <div class="text-center rounded text-white bg-primary m-1" style="width: 100%; display: none;" id="bangku<?= $i; ?>"><?= $i ?></div>
                                                    <?php else : ?>
                                                        <div class="text-center rounded text-white bg-primary m-1 bangku" style="width: 100%;" id="bangku<?= $i; ?>"><?= $i ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endfor; ?>
                                        
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                        <div class="text-center rounded text-white bg-primary m-1" style="width: 50%;">Bangku Tersedia</div>
                                        <div class="text-center rounded text-white bg-danger m-1" style="width: 50%;">Bangku Sudah Dibeli</div>
                                        </div>
                                    </div>
                                </div>
                        <br>
                        
                        <div class="mb-3">
                            <label for="bangku" class="form-label text-white">No bangku</label>
                            <input disabled type="text" name="bangku_preview" id="kursi" class="form-control" placeholder="Klik Bangku Di Atas">
                            <input type="hidden" name="bangku" id="bangku" class="form-control">
                        </div>

                            <input type="hidden" name="id_film" value="<?php echo $barang[0]["id_film"]; ?>" >
                            <input type="hidden" name="hari" value="<?= $hari ?>" >
                            <input type="hidden" name="jam" value="<?= $jam ?>" >
                        <div class="mb-3">
                            <input type="hidden" id="id" name="id" value="<?php echo $content["id_film"] ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="name_film" name="name_film" value="<?php echo $content["name_film"] ?>" >
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="harga" name="harga" value="<?php echo $content["harga"] ?>">
                        </div>
                        
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="total" name="total" value="">
                            <input type="hidden" class="form-control" id="jam" name="jam" value="<?= $jam; ?>">
                            <input type="hidden" class="form-control" id="hari" name="hari" value="<?= $hari; ?>"">
                        </div>
                        <div class="mb-3">
                            <select type="select" class="form-control" id="pembayaran" name="pembayaran" placeholder="Pilih Pembayaran">
                                <option value="-">Pilih Pembayaran</option>
                                <option value="Dana">Dana</option>
                                <option value="GoPay">GoPay</option>
                                <option value="ShopeePay">ShopeePay</option>
                                <option value="OVO">OVO</option>
                                <option value="LinkAja">LinkAja</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" id="nomor_pembayaran" name="nomor_pembayaran" placeholder="Masukkan Nomor Pembayaran">
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="buy">Beli</button>
                    </form>
                            </div>
                        </div>
                    </div>

                    <!-- lokasi form -->
                    
                </div>
                <div class="col-sm"></div>
            </div>
        
    </div>
    <!-- End Form -->
<!-- <?= var_dump($barang); ?> -->


<script src="script/bootstrap.js"></script>
<script>

    const bangku1 = document.getElementById("bangku1");
    const bangku2 = document.getElementById("bangku2");
    const bangku3 = document.getElementById("bangku3");
    const bangku4 = document.getElementById("bangku4");
    const bangku5 = document.getElementById("bangku5");
    const bangku6 = document.getElementById("bangku6");
    const bangku7 = document.getElementById("bangku7");
    const bangku8 = document.getElementById("bangku8");
    const bangku9 = document.getElementById("bangku9");
    const bangku10 = document.getElementById("bangku10");
    const bangku11 = document.getElementById("bangku11");
    const bangku12 = document.getElementById("bangku12");
    const bangku13 = document.getElementById("bangku13");
    const bangku14 = document.getElementById("bangku14");
    const bangku15 = document.getElementById("bangku15");
    const bangku16 = document.getElementById("bangku16");
    const bangku17 = document.getElementById("bangku17");
    const bangku18 = document.getElementById("bangku18");
    const bangku19 = document.getElementById("bangku19");
    const bangku20 = document.getElementById("bangku20");

    let inputBangku = document.getElementById("bangku");
    let previewBangku = document.getElementById("kursi");

    bangku1.addEventListener('click', function() {
        inputBangku.value = "1";
        previewBangku.value = "1";
    });
    bangku2.addEventListener('click', function() {
        inputBangku.value = "2";
        previewBangku.value = "2";
    });
    bangku3.addEventListener('click', function() {
        inputBangku.value = "3";
        previewBangku.value = "3";
    });
    bangku4.addEventListener('click', function() {
        inputBangku.value = "4";
        previewBangku.value = "4";
    });
    bangku5.addEventListener('click', function() {
        inputBangku.value = "5";
        previewBangku.value = "5";
    });
    bangku6.addEventListener('click', function() {
        inputBangku.value = "6";
        previewBangku.value = "6";
    });
    bangku7.addEventListener('click', function() {
        inputBangku.value = "7";
        previewBangku.value = "7";
    });
    bangku8.addEventListener('click', function() {
        inputBangku.value = "8";
        previewBangku.value = "8";
    });
    bangku9.addEventListener('click', function() {
        inputBangku.value = "9";
        previewBangku.value = "9";
    });
    bangku10.addEventListener('click', function() {
        inputBangku.value = "10";
        previewBangku.value = "10";
    });
    bangku11.addEventListener('click', function() {
        inputBangku.value = "11";
        previewBangku.value = "11";
    });
    bangku12.addEventListener('click', function() {
        inputBangku.value = "12";
        previewBangku.value = "12";
    });
    bangku13.addEventListener('click', function() {
        inputBangku.value = "13";
        previewBangku.value = "13";
    });
    bangku14.addEventListener('click', function() {
        inputBangku.value = "14";
        previewBangku.value = "14";
    });
    bangku15.addEventListener('click', function() {
        inputBangku.value = "15";
        previewBangku.value = "15";
    });
    bangku16.addEventListener('click', function() {
        inputBangku.value = "16";
        previewBangku.value = "16";
    });
    bangku17.addEventListener('click', function() {
        inputBangku.value = "17";
        previewBangku.value = "17";
    });
    bangku18.addEventListener('click', function() {
        inputBangku.value = "18";
        previewBangku.value = "18";
    });
    bangku19.addEventListener('click', function() {
        inputBangku.value = "19";
        previewBangku.value = "19";
    });
    bangku20.addEventListener('click', function() {
        inputBangku.value = "20";
        previewBangku.value = "20";
    });


    // const plusBtn = document.getElementById("plusBtn");
    // const minusBtn = document.getElementById("minusBtn");
    

    // quantity.addEventListener('input', function() {
    //     total.value = price.value * quantity.value;
    //     totalPreview.value = price.value * quantity.value;
    // });

    // plusBtn.addEventListener('click', function() {      
    //     quantity.value++;
    //     total.value = price.value * quantity.value;
    //     totalPreview.value = price.value * quantity.value;     
    // });

    // minusBtn.addEventListener('click', function() {
    //     quantity.value--;
    //     total.value = price.value * quantity.value;
    //     totalPreview.value = price.value * quantity.value;     
    // });

    // totalPreview.value = quantity.value * price.value;
    // total.value = quantity.value * price.value;


</script>
</body>
</html>