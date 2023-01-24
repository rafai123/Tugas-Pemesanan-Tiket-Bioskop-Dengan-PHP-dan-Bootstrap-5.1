<?php 
    session_start();
    require "function.php";

    // cek cookie
    if ( isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
        $cookie_id = $_COOKIE["id"];
        $cookie_key = $_COOKIE["key"];

        $result = mysqli_query($conn, "SELECT * FROM account WHERE id = $cookie_id");

        $the_key = mysqli_fetch_assoc($result);


        if ( $cookie_key == hash('sha256', $the_key["username"]) ) {
            $_SESSION["login"] = true;
        }
    }

    // cek session Login
    if ( isset($_SESSION["login"]) ) {
        header("location: index.php");
        exit;
    }

    // cek data login
    if ( isset($_POST["login"]) ) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username' ");

        // cek apakah username ada
        if (mysqli_num_rows($result) == 1 ) {

            // cek password
            $row = mysqli_fetch_assoc($result);

            // var_dump($row);
            // var_dump($password);
            // var_dump(password_verify($password,$row["password"]));
            // die;
            
            if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["profile"] = $row["profile"];
                $_SESSION["level"] = $row["level"];

                // cek ceklist remember me
                if ( isset($_POST["remember"]) ) {
                    // buat cookie
                    setcookie("id", $row["id"], time()+120000);
                    setcookie("key", hash('sha256', $row["username"]), time()+120000);
                }

                header("location: index.php");
                exit;
            }
        }

        $error = true;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/manual.css">
</head>
<body style="background-image: url('img/background/bg_bride.jpg'); background-size: cover;">
    <div class="container-fluid show" >
            <div class="row d-flex justify-content-center p-4">
                <div class="col-sm"></div>
                <div class="col-sm-6 border-dark p-4 m-5 rounded " style="background-color: rgba(0,0,0,.5);">
                    <h1 class="danger text-primary mb-4" style="text-align: center;">Silahkan Login Akun Cynapolis</h1>
                    <?php if ( isset($error) ) : ?>
                        <div class="text-danger">Username atau Password salah!!!</div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label text-white">Username</label>
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-white">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label for="remember" class="form-check-label text-white" text-white>Remember Me</label>
                        </div>
                        <p class="text-white">Belum Punya akun? silahkan <a href="register.php">Daftar</a>
                        </p>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
                <div class="col-sm"></div>
            </div>
    </div>
<script src="script/bootstrap.js"></script>
</body>
</html>