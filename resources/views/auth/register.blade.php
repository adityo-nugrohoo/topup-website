<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Top Up Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .register-container {
            animation: fadeIn 1s ease-in-out;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-header h3 {
            font-weight: bold;
            color: #4e54c8;
        }
        .btn-success {
            background: #4e54c8;
            border: none;
        }
        .btn-success:hover {
            background: #3c41b5;
        }
    </style>
</head>
<body>
    <div class="container register-container col-md-6">
        <div class="register-header">
            <img src="https://cdn-icons-png.flaticon.com/512/6009/6009894.png" width="60" alt="icon">
            <h3>Daftar Akun Baru</h3>
            <p class="text-muted">Isi data di bawah untuk membuat akun</p>
        </div>

        <form method="POST" action="/register">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="d-grid mb-3">
                <button class="btn btn-success">✅ Daftar</button>
            </div>
        </form>
        <div class="text-center">
            <small class="text-muted">Sudah punya akun? <a href="/login">Login di sini</a></small>
        </div>
    </div>
</body>
</html>
