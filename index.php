<?php 
    session_start();
    require "function.php";

    if ( !isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }

    $goods = query("SELECT * FROM film ORDER BY id_film DESC");

    if ( isset($_POST["search"]) ) {
        $goods = search($_POST["keyword"]);
    }

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
    <div class="container showing" style="margin-top: 55px; ">
        <div class="row d-flex showing">
            <!-- <div class="col-sm"></div> -->
            <?php foreach ($goods as $content) : ?>
            <div class="col-sm-3 ">
    <!-- Isi -->
                <a href="detail.php?id_film=<?= $content["id_film"]; ?>" class="link-card" style="text-decoration: none ;">
                    <div class="card mt-2" style="max-width: 100%; ">
                        <img src="img/<?php echo $content["image"]; ?>" class="card-img-top" alt="...">
                        
                    </div>
                    <h2 class="text-white text-center"><?= $content["name_film"] ?></h2>
                </a>
                

    <!-- End of Isi -->
            </div>
            <?php endforeach; ?>
            <!-- <div class="col-sm"></div> -->
        </div>
    </div>
    </div>



<script src="script/bootstrap.js"></script>
</body>
</html>