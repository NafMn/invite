<?php


    $servername = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "invite";

    $connect = mysqli_connect("$servername","$db_user", "$db_password", "$db_name");

    if(!$connect){
        mysqli_connect_error($connect);
        echo "Database Galat";
    };

    // Ambil parameter 'per' dan 'next' dari URL
    $per = $_GET['per'] ?? 4; // Jumlah komentar per halaman, default 10
    $next = $_GET['next'] ?? 0; // Komentar selanjutnya yang akan diambil, default 0

    // Query untuk mengambil data komentar dari database
    $sql = "SELECT * FROM komentar ORDER BY waktu DESC LIMIT $per OFFSET $next";
    $result = $connect->query($sql);

    // Inisialisasi array untuk menyimpan data komentar
    $comments = array();

    // Jika data komentar tersedia
    if ($result->num_rows > 0) {
        // Mendapatkan setiap baris hasil sebagai array asosiatif
        while ($row = $result->fetch_assoc()) {
            // Menambahkan data komentar ke dalam array
            $comments[] = $row;
        }
    }


?>