<?php 
    $conn = mysqli_connect("localhost", "root", "", "bioskop");

    function register($data) {

        global $conn;

        // $username = strtolower(stripslashes($data["username"]));
        // $password = mysqli_real_escape_string($conn, $data["password"]);
        // $re_password = mysqli_real_escape_string($conn, $data["password2"]);
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $re_password = mysqli_real_escape_string($conn, $data["password2"]);

        // cek apakah username sudah terdaftar
        $result = mysqli_query($conn, "SELECT username FROM account WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "
                <script>
                    alert('Username sudah terdaftar!');
                </script>
            ";
            return false;
        }

        // cek apakah password atau username kosong
        if ( $password == "" || $username == "" ) {
            echo "
                <script>
                    alert('Data Kosong!');
                </script>
            ";
            return false;
        }

        // cek apakah password dan konfirmasi password sama
        if ( $password !== $re_password) {
            echo "
                <script>
                    alert('Password dan Konfirmasi password tidak sama!');
                </script>
            ";
            return false;
        }

        // upload photo profile
        // $profile = upload();

        // enkripsi Password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // Registrasi ke database
        mysqli_query($conn, "INSERT INTO account VALUES ('', '$username', '$password', 'customer')");

        return mysqli_affected_rows($conn);
    }

    function upload() {
        $name = $_FILES["image"]["name"];
        $tmp_name = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];
        $size = $_FILES["image"]["size"];

        // cek apakah file sudah dimasukkan
        if ( $error === 4 ) {
            echo "
                <script>
                    alert('Silahkan masukkan gambar');
                </script>
            ";
            return false;
        }

        // cek apakah extensi file adalah gambar
        $valid_extension = ["jpg", "jpeg", "png", "gif", "jfif", "raw", "svg", "tiff", "heif"];
        $explode_name = explode(".", $name);
        $image_extension = strtolower(end($explode_name));

        if ( !in_array($image_extension, $valid_extension)) {
            echo "
                <script>
                    alert('File yang anda upload bukan gambar!');
                </script>
            ";
            return false;
        }

        // buat nama file menjadi id unik
        $new_file_name = uniqid();
        $new_file_name .= "_";
        $new_file_name .= $explode_name[0];
        $new_file_name .= ".";
        $new_file_name .= $image_extension;


        // jika file sudah memenuhi syarat, maka lakukan upload
        
        // pindahkan file dari penyimpanan sementara ke server
        move_uploaded_file($tmp_name, "img/" . $new_file_name);

        return $new_file_name;
    }

    function tambah($data) {
        global $conn;
        // tangkap isi data
        $name = $data["name"];
        $producer = $data["producer"];
        $description = $data["description"];
        $director = $data["director"];
        $writer = $data["writer"];
        $cast = $data["cast"];
        
        $harga = $data["harga"];
        

        $image = upload();

        // jika function gambar menghasilkan false, maka gagal tambah data
        if ($image == false) {
            return false;
        }

          // query
        Mysqli_query($conn,"INSERT INTO film
                            VALUES
                            ('', '$name', '$description', '$producer', '$director', '$writer', '$cast', '$image', '$harga') 
                            " );

    return Mysqli_affected_rows($conn);
    }

    function query($query) {
        global $conn;
        $rows = [];

        $result = Mysqli_query($conn, $query);

        while ($row = Mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        
    return $rows;
    }

    function buy($data) {
        global $conn;


        // $id = $data["id"];
        // $name =$data["nama"];
        // $nim = $data["nim"];
        // $major = $data["jurusan"];
        // $email = $data["email"];

        $id_film = $data["id_film"];
        $name_film = $data["name_film"];
        $harga = $data["harga"];
        $bangku = $data["bangku"];
        $kode = uniqid();
        $date = $data["hari"] . $data["jam"];
        $metode_pembayaran = $data["metode_pembayaran"];
        $nomor_pembayaran = $data["nomor_pembayaran"];
        

        $username = $_SESSION["username"];

        // var_dump($data);
        // die;
        

        Mysqli_query($conn, "INSERT INTO pemesanan
                            VALUES
                            
                            ('', '$id_film', '$date', '$username', '$kode', '$bangku', '$metode_pembayaran', '$nomor_pembayaran') ");

    return Mysqli_affected_rows($conn);
    }
  
    
    function search($keyword) {
        global $conn;

        $rows = [];

        $result = Mysqli_query($conn, "SELECT * FROM film
                                WHERE
                                name_film LIKE '%$keyword%' OR
                                description LIKE '%$keyword%' OR
                                producer LIKE '%$keyword%' OR
                                director LIKE '%$keyword%' OR
                                writer LIKE '%$keyword%' OR
                                cast LIKE '%$keyword%' OR
                                harga LIKE '%$keyword' OR
                                image LIKE '%$keyword%'
                                ");
        while ( $row = Mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function search_order($keyword) {
        global $conn;

        $rows = [];

        $result = Mysqli_query($conn, "SELECT * FROM pemesanan
                                WHERE
                                nama_film LIKE '%$keyword%' OR
                                username LIKE '%$keyword%' OR
                                tanggal LIKE '%$keyword%' OR
                                username LIKE '%$keyword' OR
                                kode_unik LIKE '%$keyword' OR
                                harga LIKE '%$keyword' OR
                                no_bangku LIKE '%$keyword'
                                ");
        while ( $row = Mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function delete($id) {
        global $conn;

        Mysqli_query($conn, "DELETE FROM film WHERE id_film = $id");

    return Mysqli_affected_rows($conn);
    }
    function update($data) {
        global $conn;

        // var_dump($_POST);
        // var_dump($_FILES); die;
        
        $id = $data["id_film"];
        $name = $data["name"];
        $description = $data["description"];
        $harga = $data["harga"];
        $producer = $data["producer"];
        $director = $data["director"];
        $writer = $data["writer"];
        $cast = $data["cast"];

        if ( $_FILES["image"]["error"] === 4) {
            $gambar = $data["image"];
        } else {
            $gambar = upload();
        }

        Mysqli_query($conn, "UPDATE film
                            SET
                            name_film = '$name',
                            description = '$description',
                            producer = '$producer',
                            director = '$director',
                            writer = '$writer',
                            cast = '$cast',
                            image = '$gambar',
                            harga = '$harga'
                            WHERE id_film = $id
                            ");

    return Mysqli_affected_rows($conn);
    }
?>