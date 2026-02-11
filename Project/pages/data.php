<?php
// Letakkan logika PHP di paling atas (seperti saran sebelumnya)
$file = '../data.json';

// Handle delete logic
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        if (isset($data[$deleteIndex])) {
            unset($data[$deleteIndex]);
            $data = array_values($data);
            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
            header("Location: data.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan Aruma SPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-5 mb-1">Daftar Reservasi</h1>
                <p class="text-muted">Kelola jadwal ketenangan pelanggan Anda</p>
            </div>
            <a href="form.php" class="btn btn-primary shadow-sm">+ Reservasi Baru</a>
        </div>

        <div class="row g-4">
            <?php
            if (file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
                if ($data && count($data) > 0) {
                    foreach ($data as $index => $item) {
                        $tanggal = (isset($item['jadwal']) && $item['jadwal'] !== '') 
                                   ? date('d M Y | H:i', strtotime($item['jadwal'])) 
                                   : 'Belum diatur';
            ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="badge bg-soft-pink text-pink p-2 px-3" style="background: #fff0f5; color: #ff83b4; border-radius: 10px;">
                                <i class="bi bi-calendar-event me-2"></i><?= $tanggal ?>
                            </div>
                        </div>
                        <h4 class="card-title text-start mb-1" style="color: #5d4037;"><?= htmlspecialchars($item['nama']) ?></h4>
                        <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i> <?= htmlspecialchars($item['kota']) ?></p>
                        
                        <div class="d-flex align-items-center p-3 mb-4" style="background: #fdfafb; border-radius: 15px;">
                            <i class="bi bi-telephone-fill me-3 text-secondary"></i>
                            <span class="fw-bold"><?= htmlspecialchars($item['telepon']) ?></span>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="edit.php?id=<?= $index ?>" class="btn btn-outline-primary btn-sm w-100">Edit</a>
                            <a href="data.php?delete=<?= $index ?>" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Hapus data reservasi ini?')">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "<div class='col-12 text-center py-5'><p class='text-muted'>Belum ada data pelanggan.</p></div>";
                }
            }
            ?>
        </div>

        <div class="text-center mt-5">
            <a href="homepage.php" class="text-decoration-none text-muted"><i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>