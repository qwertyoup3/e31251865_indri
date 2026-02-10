<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan Aruma SPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #ffc5d9;
        }
        h1 {
            text-align: center;
        }
        .btn-primary {
            background-color: #ffc5d9 !important;
            border-color: #ffc5d9 !important;
        }
        .btn-primary:hover {
            background-color: #c2185b !important;
            border-color: #c2185b !important;
        }
        .btn-outline-primary {
            color: #ffc5d9 !important;
            border-color: #ffc5d9 !important;
        }
        .btn-outline-primary:hover {
            background-color: #ffc5d9 !important;
            border-color: #ffc5d9 !important;
        }
        .bg-primary {
            background-color: #ffc5d9 !important;
        }
        .btn-secondary {
            background-color: #ffe8e8 !important;
            border-color: #f1e3e3 !important;
        }
        .btn-secondary:hover {
            background-color: #ffcbcb !important;
            border-color: #ffcbcb !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Edit Data Pelanggan Aruma SPA</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pelanggan" value="<?php echo htmlspecialchars($nama ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($telepon ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukkan nama kota" value="<?php echo htmlspecialchars($kota ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="jadwal" class="form-label">Tanggal Reservasi</label>
                                <input type="datetime-local" class="form-control" id="jadwal" name="jadwal" value="<?php echo isset($jadwal) ? htmlspecialchars($jadwal) : ''; ?>" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Update Data</button>
                                <a href="tabel.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$file = 'data.json';
$id = $_GET['id'] ?? null;

if (!isset($id) || $id === '') {
    header('Location: tabel.php');
    exit;
}

// Baca data dari JSON
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
}

// Check jika ID valid
if (!isset($data[$id])) {
    header('Location: tabel.php');
    exit;
}

$nama = $data[$id]['nama'];
$telepon = $data[$id]['telepon'];
$kota = $data[$id]['kota'];
$jadwal = isset($data[$id]['jadwal']) ? $data[$id]['jadwal'] : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = $_POST['nama'];
    $telepon_baru = $_POST['telepon'];
    $kota_baru = $_POST['kota'];
    $jadwal_baru = isset($_POST['jadwal']) ? $_POST['jadwal'] : '';

    // Update data
    $data[$id] = [
        "nama" => $nama_baru,
        "telepon" => $telepon_baru,
        "kota" => $kota_baru,
        "jadwal" => $jadwal_baru
    ];

    // Simpan ke file JSON
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirect ke tabel
    header('Location: tabel.php');
    exit;
}
?>
