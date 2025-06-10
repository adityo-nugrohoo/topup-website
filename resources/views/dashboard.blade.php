<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Top Up Game</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      transition: background-color 0.4s ease, color 0.4s ease;
    }

    .sidebar {
      height: 100vh;
      background-color: #212529;
      color: #fff;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      transition: all 0.3s ease-in-out;
    }

    .sidebar h4 {
      font-weight: bold;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #adb5bd;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      border-radius: 8px;
      transition: all 0.2s ease-in-out;
    }

    .sidebar a:hover {
      background-color: #343a40;
      color: #fff;
      transform: translateX(5px);
    }

    .sidebar .btn {
      width: 100%;
      margin-top: 10px;
    }

    .main-content {
      margin-left: 270px;
      padding: 40px;
    }

    .card-stat {
      border-radius: 16px;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
    }

    .card-stat:hover {
      transform: translateY(-5px);
    }

    .dark-mode {
      background-color: #121212 !important;
      color: #f1f1f1 !important;
    }

    .dark-mode .card,
    .dark-mode .card-stat {
      background-color: #1e1e2f;
      color: #fff;
    }

    .dark-mode .sidebar {
      background-color: #1a1a2e;
    }

    .dark-mode .sidebar a {
      color: #ccc;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .filter-controls input,
    .filter-controls select {
      max-width: 200px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        width: 250px;
        height: 100vh;
        z-index: 1000;
        left: -250px;
      }

      .sidebar.show {
        left: 0;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }

      .menu-toggle {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1100;
        background-color: #212529;
        border: none;
        color: #fff;
        padding: 10px 15px;
        border-radius: 6px;
      }
    }
  </style>
</head>
<body>

  <!-- Tombol Toggle untuk Mobile -->
  <button class="menu-toggle d-md-none" onclick="toggleSidebar()">☰</button>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h4><i class="bi bi-controller"></i> YOO STORE</h4>
    <p>Halo, <strong>{{ Auth::user()->name }}</strong></p>
    <a href="/dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
    <a href="/topup"><i class="bi bi-cart-plus"></i> Form Top Up</a>
    <a href="/profile"><i class="bi bi-person-circle"></i> Profil</a>
    <button onclick="toggleDarkMode()" class="btn btn-outline-light btn-sm">🌙 Dark Mode</button>
    <form action="/logout" method="POST" class="mt-3">
      @csrf
      <button class="btn btn-danger btn-sm">Logout</button>
    </form>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Dashboard</h2>
      <img src="https://cdn-icons-png.flaticon.com/512/4253/4253267.png" width="40" />
    </div>

    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <div class="card card-stat p-4">
          <h5>Total Top Up</h5>
          <h3 class="text-primary">{{ $transactions->count() ?? 0 }}</h3>
          <p class="text-muted">Transaksi berhasil diproses</p>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card card-stat p-4">
          <h5>Total Pengguna</h5>
          <h3 class="text-success">{{ $totalUsers ?? 0 }}</h3>
          <p class="text-muted">User terdaftar</p>
        </div>
      </div>
    </div>

    <div class="card p-5 shadow-lg border-0 rounded-4 mb-4">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h3>Selamat datang!</h3>
          <p class="text-muted">Top Up cepat dan aman game favorit kamu, mulai sekarang juga.</p>
          <a href="/topup" class="btn btn-primary btn-lg">+ Top Up Baru</a>
        </div>
        <div class="col-md-4 d-none d-md-block">
          <img src="https://cdn-icons-png.flaticon.com/512/6009/6009894.png" width="120" alt="Ilustrasi" />
        </div>
      </div>
    </div>

    <div class="card p-4 mt-4 border-0 shadow-sm bg-white bg-opacity-10 backdrop-blur rounded-4 text-dark dark-mode-text-white">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
        <h5 class="mb-3 mb-md-0">
          <i class="bi bi-clock-history me-2"></i>Riwayat Top Up Terbaru
        </h5>
        <div class="d-flex flex-column flex-md-row align-items-stretch gap-2 w-100 w-md-auto">
          <input type="text" id="searchInput" onkeyup="filterTable()" class="form-control form-control-sm" placeholder="🔍 Cari ID / Game">
          <select id="filterGame" onchange="filterTable()" class="form-select form-select-sm">
            <option value="">🎮 Semua Game</option>
            <option value="Mobile Legends">Mobile Legends</option>
            <option value="Free Fire">Free Fire</option>
            <option value="Genshin Impact">Genshin Impact</option>
          </select>
        </div>
      </div>

      @if(count($transactions ?? []) > 0)
      <div class="table-responsive">
        <table class="table table-sm table-hover text-dark dark-mode-text-white" id="topupTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Game</th>
              <th>ID Pemain</th>
              <th>Jumlah</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $index => $trx)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $trx->game }}</td>
              <td>{{ $trx->player_id }}</td>
              <td>{{ $trx->jumlah }}</td>
              <td>
                @if($trx->status == 'Sukses')
                <span class="badge bg-success">{{ $trx->status }}</span>
                @elseif($trx->status == 'Diproses')
                <span class="badge bg-warning text-dark">{{ $trx->status }}</span>
                @else
                <span class="badge bg-danger">{{ $trx->status }}</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="text-center p-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="100" alt="No data" />
        <p class="text-muted mt-3">Belum ada transaksi top up.</p>
      </div>
      @endif
    </div>
  </div>

  <script>
    function toggleDarkMode() {
      document.body.classList.toggle("dark-mode");
    }

    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("show");
    }

    function filterTable() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const filterGame = document.getElementById("filterGame").value.toLowerCase();
      const table = document.getElementById("topupTable");
      const rows = table.getElementsByTagName("tr");

      for (let i = 1; i < rows.length; i++) {
        const cols = rows[i].getElementsByTagName("td");
        const game = cols[1]?.innerText.toLowerCase();
        const id = cols[2]?.innerText.toLowerCase();
        const matchGame = !filterGame || game.includes(filterGame);
        const matchSearch = !input || id.includes(input) || game.includes(input);
        rows[i].style.display = matchGame && matchSearch ? "" : "none";
      }
    }
  </script>
</body>
</html>
