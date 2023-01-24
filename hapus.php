<?php
    session_start();
    
    if ( !isset($_SESSION["login"]) ) {
        header("location: login.php");
        exit;
    }

    require "function.php";

    if ( delete($_GET["id"]) > 0 ) {
        echo "
            <script>
                alert('film Berhasil Di Hapus');
                document.location.href ='index.php';
            </script>
        ";
    } else {
        $err = Mysqli_error($conn);
        echo "
            <script>
                alert('film Gagal Di Hapus $err');
                document.location.href = 'index.php';
            </script>
        ";
    }
?>