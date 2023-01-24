<?php 
    session_start();
    require "function.php";
    
    if ( !isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }

    $id_film = $_GET["id_film"];
    $film = query("SELECT * FROM film WHERE id_film = $id_film")[0];
    // var_dump($film);
    
    // $goods = query("SELECT * FROM film");

    // if ( isset($_POST["search"]) ) {
    //     $goods = search($_POST["keyword"]);
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/manual.css">
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="cetak_tiket.php">Cetak Tiket</a>
                    </li> -->
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

    <div class="show" >
        <div class="container mt-5 pt-3">
            <div class="row mt-5 pt-1">
                <div class="col-sm-3">
                    <div class="card mt-2" style="max-width: 100%; ">
                        <img src="img/<?php echo $film["image"]; ?>" class="card-img-top" alt="...">
                        <a href="#schedule"><div class="buy text-dark" >Beli</div></a>
                    </div>
                </div>
                <div class="col-sm">
                <h2 class="text-primary"><?= $film["name_film"] ?></h2>
                <table class="text-white">
                    <tr>
                        <td>Produser</td>
                        <td>:</td>
                        <td><?= $film["producer"] ?></td>
                    </tr>
                    <tr>
                        <td>Director</td>
                        <td>:</td>
                        <td><?= $film["director"] ?></td>
                    </tr>
                    <tr>
                        <td>Writer</td>
                        <td>:</td>
                        <td><?= $film["writer"] ?></td>
                    </tr>
                    <tr>
                        <td>Cast</td>
                        <td>:</td>
                        <td><?= $film["cast"] ?></td>
                    </tr>
                </table>
                <p>
                    <h4 class="text-white ">Sinopsis</h4>
                </p>
                <p class="text-white" style="text-align: justify;"><?= $film["description"] ?></p>
            </div>
            </div>
        </div>


        <div class="schedule mt-5"  id="schedule">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-sm-9">
                    <h1 class="text-warning">PILIH JADWAL</h1>
                    <hr >
                    <?php 
                        $tgl1 = date("l, d-M-Y");
                        $tgl1Get = date("l-d-M-Y");
                        $tgl2 = date("l, d-M-Y", time()+60*60*24*1);
                        $tgl2Get = date("l-d-M-Y", time()+60*60*24*1);
                        $tgl3 = date("l, d-M-Y", time()+60*60*24*2);
                        $tgl3Get = date("l-d-M-Y", time()+60*60*24*2);

                    ?>
                    <h4 class="text-warning">Siantar City Square Cynapolis <?= $tgl1; ?> </h4>
                    <p class="text-white" style="font-size: 11px; font-style: italic;" >Alamat : Jl. Medan no.88, Martoba, Kecamatan Siantar Utara, Pematangsiantar</p>
                    <h6 class="text-white">Regular 2D</h6>
                    <p>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=11:30&hari=<?= $tgl1Get; ?>">11:30</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=13:50&hari=<?= $tgl1Get; ?>">13:50</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=16:10&hari=<?= $tgl1Get; ?>">16:10</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=18:30&hari=<?= $tgl1Get; ?>">18:30</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=20:50&hari=<?= $tgl1Get; ?>">20:50</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=22:30&hari=<?= $tgl1Get; ?>">22:30</a>
                    </p>
                    <hr style="color: white;" class="mb-5">

                    <h4 class="text-warning">Siantar City Square Cynapolis <?= $tgl2 ?> </h4>
                    <p class="text-white" style="font-size: 11px; font-style: italic;">Alamat : Jl. Medan no.88, Martoba, Kecamatan Siantar Utara, Pematangsiantar</p>
                    <h6 class="text-white">Regular 2D</h6>
                    <p>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=12:00&hari=<?= $tgl2Get; ?>">12:00</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=14:20&hari=<?= $tgl2Get; ?>">14:20</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=16:40&hari=<?= $tgl2Get; ?>">16:40</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=19:00&hari=<?= $tgl2Get; ?>">19:00</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=21:20&hari=<?= $tgl2Get; ?>">21:20</a>
                        <a class="btn btn-light m-1" href="buy.php?id=<?= $film["id_film"]; ?>&jam=22:50&hari=<?= $tgl2Get; ?>">22:50</a>
                    </p>
                    <hr style="color: white;" class="mb-5">

                    <h4 class="text-warning">Siantar City Square Cynapolis <?= $tgl3; ?> </h4>
                    <p class="text-white" style="font-size: 11px; font-style: italic;">Alamat : Jl. Medan no.88, Martoba, Kecamatan Siantar Utara, Pematangsiantar</p>
                    <h6 class="text-white">Regular 2D</h6>
                    <p>
                        <a class="btn btn-light m-1">19:00</a>
                        <a class="btn btn-light m-1">19:00</a>
                        <a class="btn btn-light m-1">19:00</a>
                        <a class="btn btn-light m-1">19:00</a>
                        <a class="btn btn-light m-1">19:00</a>
                        <a class="btn btn-light m-1">19:00</a>
                    </p>
                    <hr style="color: white;" class="mb-5">
                </div>
            </div>
        </div>
    </div>
    </div>

    



<script src="script/bootstrap.js"></script>
</body>
</html>