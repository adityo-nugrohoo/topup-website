<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Top Up Game</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background: linear-gradient(120deg, #6366f1, #60a5fa);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(20px);
      padding: 2.5rem;
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      color: #fff;
      width: 100%;
      max-width: 560px;
      animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-control,
    .form-select {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.4);
    }

    .form-control::placeholder {
      color: #e5e5e5;
    }

    .form-control:focus,
    .form-select:focus {
      background-color: rgba(255, 255, 255, 0.3);
      color: #fff;
      border-color: #fff;
      box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.2);
    }

    .btn-success {
      background-color: #16a34a;
      border: none;
    }

    .btn-outline-light {
      border-color: #fff;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .form-icon {
      margin-right: 8px;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="form-card">
  @if (session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500
      });
    </script>
  @endif

  @if (session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2500
      });
    </script>
  @endif

  <h3 class="text-center mb-4">
    <i class="bi bi-cart-plus-fill form-icon"></i>Top Up Game
  </h3>

  <form method="POST" action="/topup">
    @csrf

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-controller form-icon"></i>Nama Game</label>
      <select name="game" class="form-select" required>
        <option value="">-- Pilih Game --</option>
        <option value="Mobile Legends">Mobile Legends</option>
        <option value="Free Fire">Free Fire</option>
        <option value="PUBG Mobile">PUBG Mobile</option>
        <option value="Genshin Impact">Genshin Impact</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-person-badge form-icon"></i>ID Pemain</label>
      <input type="text" name="player_id" class="form-control" placeholder="Masukkan ID Pemain" required>
    </div>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-envelope-fill form-icon"></i>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
    </div>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-cash-stack form-icon"></i>Jumlah Diamond</label>
      <select name="amount" class="form-select" required>
        <option value="">-- Pilih Nominal --</option>
        <option value="50">50 Diamond</option>
        <option value="100">100 Diamond</option>
        <option value="250">250 Diamond</option>
        <option value="500">500 Diamond</option>
      </select>
    </div>

    <div class="mb-4">
      <label class="form-label"><i class="bi bi-credit-card form-icon"></i>Metode Pembayaran</label>
      <select name="payment_method" class="form-select" required>
        <option value="">-- Pilih Metode Pembayaran --</option>
        <option value="DANA">DANA</option>
        <option value="OVO">OVO</option>
        <option value="GoPay">GoPay</option>
        <option value="ShopeePay">ShopeePay</option>
        <option value="Transfer Bank">Transfer Bank</option>
      </select>
    </div>

    <div class="d-grid mb-3">
      <button type="submit" class="btn btn-success btn-lg">
        <i class="bi bi-lightning-fill"></i> Proses Top Up
      </button>
    </div>

    <div class="d-grid">
      <a href="{{ route('dashboard') }}" class="btn btn-outline-light">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
      </a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
