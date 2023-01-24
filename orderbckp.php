<?php 
    session_start();
    require "function.php";

    $username = $_SESSION["username"];
    $query = "SELECT * FROM buy WHERE username = '$username'";
    $result = mysqli_query($conn, "SELECT * FROM buy WHERE username = '$username'");
    $totalOrder = mysqli_num_rows($result);
    var_dump($totalOrder);
    $contents = query($query);

    if ( isset($_POST["search"]) ) {
        $contents = search_order($_POST["keyword"]);
    }

    // $id = $_GET["id"];
    // $query = "SELECT * FROM goods WHERE id = $id";
    // $content = query($query)[0];

    // if ( isset($_POST["buy"]) ) {
    //     // var_dump($_POST);
    //     // die;
    //     if ( buy($_POST) > 0 ) {
    //         echo "
    //             <script>
    //                 alert('Data Berhasil Di Beli');
    //                 document.location.href = 'index.php';
    //             </script>
    //         ";
    //     } else {
    //         echo "
    //             <script>
    //                 alert('Data gagal di beli');
    //                 document.location.href = 'index.php';
    //             </script>
    //         ";
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New</title>
    <link rel="stylesheet" href="style/bootstrap.css">
</head>
<body>
    <!-- Navbar -->
    <!-- <div class="container-fluid"> -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top shadow">
        <div class="container">
            <a class="navbar-brand" href="index.php">WibuFood</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active"  href="order.php">Pesanan</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="add.php">Tambah</a></li>
                    <li><a class="dropdown-item" href="edit.php">Edit</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end" >
                <!-- <li class="nav-item ms-5">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"><img src="img/<?php echo $_SESSION["profile"]; ?>" alt="profile" width="30px" height="30px" class="rounded-circle"></a>
                </li> -->
                <li class="nav-item ms-3">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $_SESSION["username"]; ?></a>
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
    <!-- <a href="logout.php" class="btn btn-danger">Logout</a> -->

    <!-- Form -->
    <div class="container-fluid " style="margin-top: 70px;">
        
            <div class="row d-flex justify-content-center">
                <div class="col-sm"></div>
                <div class="col-sm-8 border p-4 rounded ">
                    <h1 class="danger text-danger mb-4">Riwayat Pesanan</h1>

                    <!-- Riwayat Pesanan -->
                    <table class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr class="">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>

                    <?php $i = 1; $total_all = 0;?>
                    <?php foreach ($contents as $content) : ?>
                    
                        <tbody>
                            <tr class="table-striped">
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $content["name"]; ?></td>
                                <td><?php echo $content["date"]; ?></td>
                                <td><?php echo $content["price"]; ?></td>
                                <td><?php echo $content["quantity"]; ?></td>
                                <td><?php echo $content["total"]; ?></td>
                                <?php $total_all += $content["total"]; ?>
                            </tr>
                        </tbody>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $total_all; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Akhir Riwayat Pesanan -->
                </div>
                <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <img src="img/<?php echo $_SESSION["profile"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text">
                                <table>
                                    <tr>
                                        <td>Username </td>
                                        <td>:</td>
                                        <td><?php echo $_SESSION["username"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Pesanan</td>
                                        <td>:</td>
                                        <td><?= $totalOrder; ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Total Pembelian</td>
                                        <td>:</td>
                                        <td><?= $total_all; ?></td>
                                    </tr>
                                </table></p>
                        </div>
                    </div>
                                <!-- <img src="img/<?php echo $_SESSION["profile"]; ?>" alt="" width="200px" class="border rounded">
                                <table>
                                    <tr>
                                        <td>Nama </td>
                                        <td><?php echo $_SESSION["username"]; ?></td>
                                    </tr>

                                </table>
                             -->
            </div>
            </div>
        
    </div>
    <!-- End Form -->



<script src="script/bootstrap.js"></script>
</body>
</html>