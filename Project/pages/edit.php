<?php
$file = '../data.json';
$id = $_GET['id'] ?? null;

// Keamanan: Redirect jika ID tidak ada
if ($id === null || $id === '') {
    header('Location: data.php');
    exit;
}

$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Cek jika data dengan ID tersebut ada
if (!isset($data[$id])) {
    header('Location: data.php');
    exit;
}

$nama = $data[$id]['nama'];
$telepon = $data[$id]['telepon'];
$kota = $data[$id]['kota'];
$jadwal = $data[$id]['jadwal'] ?? '';

// Proses Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data[$id] = [
        "nama" => $_POST['nama'],
        "telepon" => $_POST['telepon'],
        "kota" => $_POST['kota'],
        "jadwal" => $_POST['jadwal'] ?? ''
    ];

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header('Location: data.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembaruan Reservasi | Aruma SPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card overflow-hidden border-0 shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-4 d-none d-md-flex bg-primary flex-column justify-content-center text-center p-4 text-white" style="background: linear-gradient(135deg, #ffc5d9 0%, #ff83b4 100%) !important;">
                            <i class="bi bi-pencil-square display-1 mb-3"></i>
                            <h2 class="h4">Pembaruan Data</h2>
                            <p class="small opacity-75">Pastikan detail reservasi pelanggan sudah sesuai untuk kenyamanan layanan kami.</p>
                        </div>
                        
                        <div class="col-md-8 bg-white p-4 p-md-5">
                            <div class="mb-4">
                                <h2 class="card-title text-start mb-1">Edit Reservasi</h2>
                                <p class="text-muted small">ID Pelanggan: #SPA-<?= $id ?></p>
                            </div>

                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Nama Pelanggan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-person text-muted"></i></span>
                                            <input type="text" class="form-control bg-light border-0" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Nomor Telepon</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-phone text-muted"></i></span>
                                            <input type="text" class="form-control bg-light border-0" name="telepon" value="<?= htmlspecialchars($telepon) ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Kota Asal</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-geo-alt text-muted"></i></span>
                                            <input type="text" class="form-control bg-light border-0" name="kota" value="<?= htmlspecialchars($kota) ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label fw-bold small text-uppercase">Jadwal Reservasi</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-calendar3 text-muted"></i></span>
                                            <input type="datetime-local" class="form-control bg-light border-0" name="jadwal" value="<?= htmlspecialchars($jadwal) ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 pt-2">
                                    <button type="submit" class="btn btn-primary flex-grow-1 shadow-sm">Simpan Perubahan</button>
                                    <a href="data.php" class="btn btn-secondary px-4">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted small">E31251865_Indri Wahyu Setyaningrum</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>