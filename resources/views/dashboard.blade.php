<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Top Up Game</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
    }

    .sidebar {
      height: 100vh;
      background: linear-gradient(to bottom, #0d6efd, #0a58ca);
      color: white;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
    }

    .sidebar h4 {
      font-weight: bold;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #e9ecef;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: background-color 0.2s;
    }

    .sidebar a:hover {
      background-color: rgba(255,255,255,0.1);
    }

    .main-content {
      margin-left: 270px;
      padding: 40px;
    }

    .card-stat {
      border-radius: 16px;
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      animation: fadeInUp 0.6s ease;
    }

    .card-stat:hover {
      transform: translateY(-5px);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4><i class="bi bi-controller"></i> YOO STORE</h4>
    <p>Halo, <strong>{{ Auth::user()->name }}</strong></p>
    <a href="/dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
    <a href="/topup"><i class="bi bi-cart-plus"></i> Form Top Up</a>
    <a href="/profile"><i class="bi bi-person-circle"></i> Profil</a>
    <form action="/logout" method="POST" class="mt-3">
      @csrf
      <button class="btn btn-danger btn-sm w-100">Logout</button>
    </form>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    @if(session('success'))
    <script>
      window.onload = () => {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session('success') }}',
          showConfirmButton: false,
          timer: 2000
        });
      };
    </script>
    @endif

    <h2 class="mb-4">Dashboard</h2>

    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card card-stat p-4">
          <h5>Total Top Up</h5>
          <h3 class="text-primary">{{ $transactions->count() ?? 0 }}</h3>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-stat p-4">
          <h5>Total Pengguna</h5>
          <h3 class="text-success">{{ $totalUsers ?? 0 }}</h3>
        </div>
      </div>
    </div>

    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5><i class="bi bi-clock-history"></i> Riwayat Top Up</h5>
        <input type="text" id="searchInput" onkeyup="filterTable()" class="form-control w-25" placeholder="Cari game/ID">
      </div>
      @if(count($transactions ?? []) > 0)
      <div class="table-responsive">
        <table class="table table-hover" id="topupTable">
          <thead class="table-primary">
            <tr>
              <th>#</th>
              <th>Game</th>
              <th>ID Pemain</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $index => $trx)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $trx->game }}</td>
              <td>{{ $trx->player_id }}</td>
              <td>{{ $trx->amount }}</td>
              <td>
                @if($trx->status == 'Sukses')
                <span class="badge bg-success">Sukses</span>
                @elseif($trx->status == 'Diproses')
                <span class="badge bg-warning text-dark">Diproses</span>
                @else
                <span class="badge bg-danger">Gagal</span>
                @endif
              </td>
              <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="text-center py-4">
        <p class="text-muted">Belum ada transaksi top up.</p>
      </div>
      @endif
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function filterTable() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const rows = document.querySelectorAll("#topupTable tbody tr");
      rows.forEach(row => {
        const game = row.children[1].innerText.toLowerCase();
        const id = row.children[2].innerText.toLowerCase();
        row.style.display = game.includes(input) || id.includes(input) ? "" : "none";
      });
    }
  </script>
</body>
</html>
