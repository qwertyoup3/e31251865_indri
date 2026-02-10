<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Form Input Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama mahasiswa" required>
                            </div>

                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM Mahasiswa</label>
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan nomor induk mahasiswa" required>
                            </div>

                            <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <select class="form-select" id="prodi" name="prodi" required>
                                    <option value="">-- Pilih Program Studi --</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                                    <option value="Teknik Komputer">Teknik Komputer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="belajar.php" class="btn btn-outline-primary">Kembali ke Halaman Belajar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST['nama'];
    $nim    = $_POST['nim'];
    $prodi  = $_POST['prodi'];
    $alamat = $_POST['alamat'];

    echo "<h3>Data Mahasiswa</h3>";
    echo "Nama : $nama <br>";
    echo "NIM : $nim <br>";
    echo "Program Studi : $prodi <br>";
    echo "Alamat : $alamat <br><hr>";
}
?>

