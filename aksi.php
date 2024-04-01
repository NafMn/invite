<?php
// Include file yang berisi fungsi-fungsi untuk menangani komentar
// include 'fungsi-komentar.php';
include 'daftar-komentar.php';

// Cek tipe permintaan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Ambil data komentar dari database
    $daftar_komentar = getDaftarKomentar(); // Anda perlu menyesuaikan dengan fungsi yang benar untuk mengambil daftar komentar dari database

    // Mengembalikan data komentar dalam format HTML
    ob_start();
    $daftar_komentar_html = ob_get_clean();


    // Jika permintaan adalah untuk menambah komentar
    if (isset($_POST['form-nama']) && isset($_POST['form-kehadiran']) && isset($_POST['form-pesan'])) {
        $nama = $_POST['form-nama'];
        $kehadiran = $_POST['form-kehadiran'];
        $pesan = $_POST['form-pesan'];
        
        // Panggil fungsi untuk menambah komentar
        $result = tambahKomentar($nama, $kehadiran, $pesan);

        if ($result) {
            // Jika berhasil, tambahkan logika lain di sini
        } else {
            // Jika gagal, tambahkan logika lain di sini
        }
        // Mengembalikan data komentar dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($daftar_komentar_html);
    }

    // Jika permintaan adalah untuk membalas komentar
    if (isset($_POST['id_komentar']) && isset($_POST['pesan_balasan'])) {
        $id_komentar = $_POST['id_komentar'];
        $pesan_balasan = $_POST['pesan_balasan'];
        
        // Panggil fungsi untuk membalas komentar
        balasKomentar($id_komentar, $pesan_balasan);
    }

    // Jika permintaan adalah untuk menghapus komentar
    if (isset($_POST['hapus_komentar'])) {
        $id_komentar = $_POST['hapus_komentar'];
        
        // Panggil fungsi untuk menghapus komentar
        hapusKomentar($id_komentar);
    }

    // Jika permintaan adalah untuk memberi like pada komentar
    if (isset($_POST['like_komentar'])) {
        $id_komentar = $_POST['like_komentar'];
        
        // Panggil fungsi untuk memberi like pada komentar
        likeKomentar($id_komentar);

        // Ambil ulang data komentar dari database
        $daftar_komentar = getDaftarKomentar();
        // Mengembalikan data komentar dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($daftar_komentar);
    }
}
?>
