<?php
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="homepage.php"><i class="bi bi-flower1 me-2" style="color:var(--spa-accent); font-size:1.2rem;"></i><span style="color:var(--spa-text); font-weight:700;">Aruma SPA</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="homepage.php">Beranda</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="reservasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reservasi</a>
          <ul class="dropdown-menu" aria-labelledby="reservasiDropdown">
            <li><a class="dropdown-item" href="data.php">Daftar Reservasi</a></li>
            <li><a class="dropdown-item" href="form.php">Reservasi Baru</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
