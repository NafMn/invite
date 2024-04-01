<?php

include "data/database.php";

// Fungsi untuk menambahkan komentar ke dalam database
function tambahKomentar($nama, $kehadiran, $pesan) {
    global $connect;

    // Escape input untuk mencegah SQL Injection
    $nama = $connect->real_escape_string($nama);
    $kehadiran = $connect->real_escape_string($kehadiran);
    $pesan = $connect->real_escape_string($pesan);

    // Query untuk menyimpan komentar ke dalam database
    $sql = "INSERT INTO komentar (nama, kehadiran, pesan) VALUES ('$nama', '$kehadiran', '$pesan')";
    if ($connect->query($sql) === TRUE) {
        return true; // Komentar berhasil ditambahkan
    } else {
        return false; // Terjadi kesalahan saat menambahkan komentar
    }
}

// Fungsi untuk membalas komentar
function balasKomentar($id_komentar, $pesan_balasan) {
    global $connect;

    // Escape input untuk mencegah SQL Injection
    $pesan_balasan = $connect->real_escape_string($pesan_balasan);

    // Query untuk menyimpan balasan komentar ke dalam database
    $sql = "INSERT INTO balasan_komentar (id_komentar, pesan) VALUES ('$id_komentar', '$pesan_balasan')";
    if ($connect->query($sql) === TRUE) {
        return true; // Balasan komentar berhasil ditambahkan
    } else {
        return false; // Terjadi kesalahan saat menambahkan balasan komentar
    }
}

// Fungsi untuk menghapus komentar dari database
function hapusKomentar($id_komentar) {
    global $connect;

    // Query untuk menghapus komentar dari database
    $sql = "DELETE FROM komentar WHERE id = $id_komentar";
    if ($connect->query($sql) === TRUE) {
        return true; // Komentar berhasil dihapus
    } else {
        return false; // Terjadi kesalahan saat menghapus komentar
    }
}

// Fungsi untuk menambahkan like pada komentar di database
function likeKomentar($id_komentar) {
    global $connect;

    try {
        // Query untuk menambahkan like pada komentar
        $sql = "UPDATE komentar SET likes = likes + 1 WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id_komentar);
        $stmt->execute();

        return true; // Like pada komentar berhasil ditambahkan
    } catch (Exception $e) {
        // Tangani kesalahan dengan mencetak pesan kesalahan atau melakukan tindakan lain yang sesuai
        error_log("Gagal menambahkan like pada komentar: " . $e->getMessage());
        return false; // Terjadi kesalahan saat menambahkan like pada komentar
    }
}

// Fungsi untuk mengambil jumlah like dari database
function getJumlahLike($id_komentar) {
    global $connect;
    // Query untuk mengambil jumlah like dari database
    $sql = "SELECT likes FROM komentar WHERE id = $id_komentar";
    $result = $connect->query($sql);
    // Periksa apakah hasil query ada
    if ($result->num_rows > 0) {
        // Mendapatkan jumlah like dari baris hasil
        $row = $result->fetch_assoc();
        return $row['likes'];
    } else {
        return 0; // Jika tidak ada like, kembalikan 0
    }
}

function getDaftarKomentar() {
    global $connect;
    // Query untuk mengambil daftar komentar dari database
    $sql = "SELECT * FROM komentar ORDER BY waktu DESC";
    $result = $connect->query($sql);

    // Inisialisasi array untuk menyimpan data komentar
    $daftar_komentar = array();

    // Jika data komentar tersedia
    if ($result->num_rows > 0) {
        // Mendapatkan setiap baris hasil sebagai array asosiatif
        while ($row = $result->fetch_assoc()) {
            // Menambahkan data komentar ke dalam array
            $daftar_komentar[] = $row;
        }
    }

    // Mengembalikan daftar komentar
    return $daftar_komentar;
}

?>
