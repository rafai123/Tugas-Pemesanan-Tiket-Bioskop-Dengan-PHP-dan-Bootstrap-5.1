<?php 
    session_start();
    require "function.php";

    $username = $_SESSION["username"];
    $query = "SELECT * FROM film";
    // $result = mysqli_query($conn, "SELECT * FROM buy WHERE username = '$username'");
    // $totalOrder = mysqli_num_rows($result);
    // var_dump($totalOrder);
    $contents = query($query);

    if ( isset($_POST["search"]) ) {
        $contents = search_order($_POST["keyword"]);
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
    <div class="container-fluid show" style="margin-top: 56px;">
        
            <div class="row d-flex justify-content-center">
                <div class="col-sm"></div>
                <div class="col-sm-10 border-dark p-4 rounded show-bold">
                    <h1 class="danger text-primary mb-4">Edit Data</h1>

                    <!-- Riwayat Pesanan -->
                    <table class="table table-striped text-white" style="width: 100%;">
                        <thead>
                            <tr class="text-white">
                                <th scope="col" class="text-white" >No</th>
                                <th scope="col" class="text-white">Nama</th>
                                <th scope="col" class="text-white">Producer</th>
                                <th scope="col" class="text-white">Director</th>
                                <th scope="col" class="text-white">Gambar</th>
                                <th scope="col" class="text-white">Harga</th>
                                <th scope="col" class="text-white">Update</th>
                                <th scope="col" class="text-white">Hapus</th>
                            </tr>
                        </thead>

                    <?php $i = 1; $total_all = 0;?>
                    <?php foreach ($contents as $content) : ?>
                    
                        <tbody>
                            <tr class="table-striped">
                                <th class="text-white" scope="row"><?php echo $i; ?></th>
                                <td class="text-white"><?php echo $content["name_film"]; ?></td>
                                <td class="text-white"><?php echo $content["producer"]; ?></td>
                                <td class="text-white"><?php echo $content["director"]; ?></td>
                                <td><img src="img/<?php echo $content["image"]; ?>" width="40px"></td>
                                <td class="text-white"><?php echo $content["harga"]; ?></td>
                                <td class="text-white"><a href="update.php?id=<?= $content["id_film"]; ?>" class="btn btn-primary">Update</a></td>
                                <td class="text-white"><a href="hapus.php?id=<?= $content["id_film"]; ?>" class="btn btn-primary" onclick="return confirm('Yakin?');">Hapus</a></td>
                            </tr>
                        </tbody>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                        
                    </table>
                    <!-- Akhir Riwayat Pesanan -->
                </div>
                <div class="col-sm">
                    
                </div>
            </div>
        
    </div>
    <!-- End Form -->



<script src="script/bootstrap.js"></script>
</body>
</html>