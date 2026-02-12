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
    <?php include_once 'nav.php'; ?>
    <?php include_once 'breadcrumb.php'; ?>
    <div class="container py-5">
        <div class="mb-5">
            <h1 class="display-5 mb-1">Daftar Reservasi</h1>
            <p class="text-muted mb-4">Kelola jadwal ketenangan pelanggan Anda</p>
            
            <div class="input-group spa-search-group" style="border-bottom: 2px solid var(--spa-accent);">
                <span class="input-group-text spa-search-icon" style="background-color: white !important; border: none !important; color: var(--spa-accent) !important;"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control spa-search-input" placeholder="Cari berdasarkan nama, kota, atau telepon..." autocomplete="off" style="background-color: white !important; border: none !important; color: var(--spa-text) !important;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (file_exists($file)) {
                    $data = json_decode(file_get_contents($file), true);
                    if ($data && count($data) > 0) {
                        foreach ($data as $index => $item) {
                            $tanggal = (isset($item['jadwal']) && $item['jadwal'] !== '') 
                                       ? date('d M Y | H:i', strtotime($item['jadwal'])) 
                                       : 'Belum diatur';
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $tanggal ?></td>
                        <td><?= htmlspecialchars($item['nama']) ?></td>
                        <td><?= htmlspecialchars($item['kota']) ?></td>
                        <td><?= htmlspecialchars($item['telepon']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $index ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                            <a href="data.php?delete=<?= $index ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data reservasi ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center py-4'>Belum ada data pelanggan.</td></tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
            <div>
                <label class="mb-0">Rows per page:
                    <select id="rowsPerPage" class="form-select form-select-sm d-inline-block w-auto ms-2">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                    </select>
                </label>
            </div>
            <nav aria-label="Table pagination">
                <ul id="pagination" class="pagination mb-0"></ul>
            </nav>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function(){
            const tbody = document.querySelector('table tbody');
            if (!tbody) return;
            const allRows = Array.from(tbody.querySelectorAll('tr'));
            const pagination = document.getElementById('pagination');
            const rowsPerPageSelect = document.getElementById('rowsPerPage');
            const searchInput = document.getElementById('searchInput');
            let currentPage = 1;
            let filteredRows = [...allRows];

            function getVisibleRows() {
                return allRows.filter(row => {
                    const searchTerm = searchInput.value.toLowerCase();
                    if (!searchTerm) return true;
                    const cells = row.querySelectorAll('td');
                    const nama = cells[2]?.textContent.toLowerCase() || '';
                    const kota = cells[3]?.textContent.toLowerCase() || '';
                    const telepon = cells[4]?.textContent.toLowerCase() || '';
                    return nama.includes(searchTerm) || kota.includes(searchTerm) || telepon.includes(searchTerm);
                });
            }

            function render() {
                filteredRows = getVisibleRows();
                const perPage = parseInt(rowsPerPageSelect.value,10) || 10;
                const totalPages = Math.max(1, Math.ceil(filteredRows.length / perPage));
                if (currentPage > totalPages) currentPage = totalPages;
                const start = (currentPage-1)*perPage;
                const end = start + perPage;
                allRows.forEach(r => r.style.display = 'none');
                filteredRows.forEach((r,i) => r.style.display = (i>=start && i<end) ? '' : 'none');

                // build pagination
                pagination.innerHTML = '';
                const makeItem = (p, text, active=false, disabled=false) => {
                    const li = document.createElement('li'); li.className = 'page-item' + (active? ' active':'') + (disabled? ' disabled':'');
                    const a = document.createElement('a'); a.className = 'page-link'; a.href = '#'; a.innerHTML = text;
                    if (active) {
                        a.style.cssText = 'background-color: var(--spa-accent) !important; border-color: var(--spa-accent) !important; color: white !important;';
                    } else if (!disabled) {
                        a.style.cssText = 'color: var(--spa-accent) !important; border-color: #ddd !important;';
                        a.onmouseover = function() { this.style.cssText = 'background-color: var(--spa-primary) !important; border-color: var(--spa-accent) !important; color: var(--spa-accent) !important;'; };
                        a.onmouseout = function() { this.style.cssText = 'color: var(--spa-accent) !important; border-color: #ddd !important;'; };
                    } else {
                        a.style.cssText = 'color: #999 !important; background-color: #f9f9f9 !important; border-color: #ddd !important;';
                    }
                    a.addEventListener('click', (e)=>{ e.preventDefault(); if(!disabled){ currentPage = p; render(); }});
                    li.appendChild(a); return li;
                };

                // prev
                pagination.appendChild(makeItem(Math.max(1, currentPage-1), '&laquo;', false, currentPage===1));

                let startPage = 1, endPage = totalPages;
                if (totalPages > 7) {
                    startPage = Math.max(1, currentPage - 3);
                    endPage = Math.min(totalPages, startPage + 6);
                    if (endPage - startPage < 6) startPage = Math.max(1, endPage - 6);
                }

                if (startPage > 1) pagination.appendChild(makeItem(1, '1'));
                if (startPage > 2) {
                    const ell = document.createElement('li'); ell.className='page-item disabled'; const sp = document.createElement('span'); sp.className='page-link'; sp.textContent='...'; ell.appendChild(sp); pagination.appendChild(ell);
                }

                for (let p = startPage; p <= endPage; p++) {
                    pagination.appendChild(makeItem(p, String(p), p===currentPage));
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ell = document.createElement('li'); ell.className='page-item disabled'; const sp = document.createElement('span'); sp.className='page-link'; sp.textContent='...'; ell.appendChild(sp); pagination.appendChild(ell);
                    }
                    pagination.appendChild(makeItem(totalPages, String(totalPages)));
                }

                // next
                pagination.appendChild(makeItem(Math.min(totalPages, currentPage+1), '&raquo;', false, currentPage===totalPages));
            }

            searchInput.addEventListener('input', () => { currentPage = 1; render(); });
            rowsPerPageSelect.addEventListener('change', ()=>{ currentPage = 1; render(); });
            render();
        });
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>