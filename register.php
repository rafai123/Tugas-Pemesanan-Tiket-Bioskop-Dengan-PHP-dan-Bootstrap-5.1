<?php 
    session_start();
    require "function.php";

    if ( isset($_POST["register"]) ) {
        
        if ( register($_POST) > 0 ) {
            echo "
                <script>
                    alert('Registrasi akun CynaPolis Berhasil!');              
                    document.location.href = 'login.php';
                </script>
            ";
        } else {
            echo mysqli_error($conn);
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/manual.css">
</head>
<body style="background-image: url('img/background/bg_bride.jpg'); background-size: cover;">
    <div class="container-fluid show">
        
            <div class="row d-flex justify-content-center p-4">
                <div class="col-md"></div>
                <div class="col-md-8 border-dark p-4 m-5 rounded " style="background-color: rgba(0,0,0,.5);">
                    <h1 class="danger text-primary mb-4">Register Akun CynaPolis</h1>
                    
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- <div class="mb-3"> -->
                                <!-- <label for="image" class="form-label">Profile Photo</label> -->
                                <!-- <input type="file" id="image" class="form-control" name="image"> -->
                            <!-- </div> -->
                            <div class="mb-3">
                                <label for="username" class="form-label text-white">Username</label>
                                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-white">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label text-white">Password</label>
                                <input type="password" class="form-control" id="password2" name="password2">
                            </div>
                            <!-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                   <label for="remember" class="form-check-label">Remember Me</label>
                            </div> -->
                            <p class="text-white">Sudah Punya akun? silahkan <a href="login.php">Login</a>
                            </p>
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                        </form>
                    
                </div>
                <div class="col-md"></div>
            </div>
        
    </div>
<script src="script/bootstrap.js"></script>
</body>
</html>