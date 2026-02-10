<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Pelanggan Aruma SPA</title>
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
            background-color: #ff83b4 !important;
            border-color: #ff83b4 !important;
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
        .btn-warning {
            background-color: #ffc5d9 !important;
            border-color: #ffc5d9 !important;
        }
        .btn-warning:hover {
            background-color: #f57c00 !important;
            border-color: #f57c00 !important;
        }
        .btn-danger {
            background-color: #c2185b !important;
            border-color: #c2185b !important;
        }
        .btn-danger:hover {
            background-color: #d32f2f !important;
            border-color: #d32f2f !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Pelanggan Aruma SPA</h1>
        
        <table class="table table-striped table-hover table-bordered">
            <thead class="table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Telepon</th>
                    <th>Kota</th>
                    <th>Reservasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $file = 'data.json';
                $no = 1;

                // Handle delete
                if (isset($_GET['delete'])) {
                    $deleteIndex = $_GET['delete'];
                    if (file_exists($file)) {
                        $data = json_decode(file_get_contents($file), true);
                        if (isset($data[$deleteIndex])) {
                            unset($data[$deleteIndex]);
                            $data = array_values($data);
                            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                            echo "<script>window.location.href='tabel.php';</script>";
                        }
                    }
                }

                if (file_exists($file)) {
                    $data = json_decode(file_get_contents($file), true);
                    
                    if ($data && count($data) > 0) {
                        foreach ($data as $index => $item) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . htmlspecialchars($item['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['telepon']) . "</td>";
                            echo "<td>" . htmlspecialchars($item['kota']) . "</td>";
                            echo "<td>" . (isset($item['jadwal']) && $item['jadwal'] !== '' ? date('d-m-Y H:i', strtotime($item['jadwal'])) : '-') . "</td>";
                            echo "<td>";
                            echo "<a href='edit.php?id=" . $index . "' class='btn btn-sm btn-warning'>Edit</a> ";
                            echo "<a href='tabel.php?delete=" . $index . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Tidak ada data pelanggan</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data pelanggan</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="form.php" class="btn btn-primary mt-3">Tambahkan Pelanggan</a>
        <a href="belajar.php" class="btn btn-secondary mt-3">Kembali ke Halaman Awal</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
