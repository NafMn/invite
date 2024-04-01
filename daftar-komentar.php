<?php
// Include file yang berisi fungsi-fungsi untuk menangani komentar
include 'fungsi-komentar.php';



// Fungsi untuk mengambil jumlah like dari database


// Ambil daftar komentar dari database
$daftar_komentar = getDaftarKomentar(); // Anda perlu menyesuaikan dengan fungsi yang benar untuk mengambil daftar komentar dari database

// Fungsi untuk mengambil nama kelas berdasarkan nilai kehadiran
function getKehadiranClass($kehadiran) {
    switch ($kehadiran) {
        case 1:
            return 'text-success';
        case 2:
            return 'text-danger';
        default:
            return 'text-muted';
    }
}
?>

<!-- Daftar Komentar -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="list-group">
                <?php foreach ($daftar_komentar as $komentar):?>
                    <div class="list-group-item list-group-item-action mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo htmlspecialchars($komentar['nama']); ?></h5>
                            <small class="mr-3 <?php echo getKehadiranClass($komentar['kehadiran']); ?>">
                                <?php echo ($komentar['kehadiran'] == 1) ? 'Hadir' : (($komentar['kehadiran'] == 2) ? 'Berhalangan' : ''); ?>
                            </small>
                        </div>
                        <p class="mb-1"><?php echo htmlspecialchars($komentar['pesan']); ?></p>
                        <small><?php echo date('d F Y H:i', strtotime($komentar['waktu'])); ?></small>
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-outline-dark balas-btn" data-id="<?php echo $komentar['id']; ?>">
                                <i class="fas fa-reply"></i> Balas
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark hapus-btn" data-id="<?php echo $komentar['id']; ?>">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark like-btn" data-id="<?php echo $komentar['id']; ?>">
                                <i class="far fa-heart"></i> <span class="like-count"><?php echo getJumlahLike($komentar['id']); ?></span>
                            </button>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Menangani klik tombol Balas
        $('.balas-btn').click(function() {
            var idKomentar = $(this).data('id');
            // Lakukan apa pun yang perlu dilakukan ketika tombol Balas diklik
            console.log('Tombol Balas diklik untuk komentar dengan ID: ' + idKomentar);
        });

        // Menangani klik tombol Hapus
        $('.hapus-btn').click(function() {
            var idKomentar = $(this).data('id');
            // Lakukan apa pun yang perlu dilakukan ketika tombol Hapus diklik
            console.log('Tombol Hapus diklik untuk komentar dengan ID: ' + idKomentar);
        });

        // Menangani klik tombol Like
        $('.like-btn').click(function() {
            var idKomentar = $(this).data('id');
            // Lakukan apa pun yang perlu dilakukan ketika tombol Like diklik
            console.log('Tombol Like diklik untuk komentar dengan ID: ' + idKomentar);
        });
    });
</script>

