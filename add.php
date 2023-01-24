<?php 
    session_start();
    require "function.php";

    if ( !isset($_SESSION["login"])) {
        header("location: login.php");
        exit;
    }

    if ( $_SESSION["level"] == 'customer') {
        // $not_admin = true;
        echo "
                <script>
                    alert('Maaf halaman ini hanya untuk admin!!');
                    document.location.href = 'index.php';
                </script>
            ";
    }

    if ( isset($_POST["add"]) ) {
        if ( tambah($_POST) > 0 ) {
            echo "
                <script>
                    alert('tambah data berhasil');
                    document.location.href = 'ADD.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('tambah data gagal');
                    
                </script>
            ";
        }
    }

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

    <!-- Form -->
    <div class="show">
    <div class="container-fluid " style="margin-top: 50px; ">
        
            <div class="row d-flex justify-content-center">
                <div class="col-sm"></div>
                <div class="col-sm-8 border-secondary p-4 rounded show">
                    <h1 class="danger text-primary mb-4">Post Film</h1>
                    
                    <form action="" method="POST" enctype="multipart/form-data" >
                        <div class="mb-3">
                            <label for="image" class="form-label text-white">Gambar</label>
                            <input type="file" class="form-control" id="image"  name="image">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">Nama</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label text-white">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="producer" class="form-label text-white">Producer</label>
                            <input type="text" class="form-control" id="producer" name="producer">
                        </div>
                        <div class="mb-3">
                            <label for="director" class="form-label text-white">Director</label>
                            <input type="text" class="form-control" id="director" name="director">
                        </div>
                        <div class="mb-3">
                            <label for="writer" class="form-label text-white">Writer</label>
                            <input type="text" class="form-control" id="writer" name="writer">
                        </div>
                        <div class="mb-3">
                            <label for="cast" class="form-label text-white">Cast</label>
                            <input type="text" class="form-control" id="cast" name="cast">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label text-white">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga">
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="add">Tambah</button>
                    </form>
                    
                </div>
                <div class="col-sm"></div>
            </div>
        
    </div>
    </div>
    <!-- End Form -->



<script src="script/bootstrap.js"></script>
</body>
</html>