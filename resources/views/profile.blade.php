@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">

          <!-- Sisi Kiri: Avatar & Identitas -->
          <div class="col-md-4 bg-dark text-white d-flex flex-column align-items-center justify-content-center p-4">
            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="120" class="rounded-circle border border-3 border-light mb-3 shadow-sm" alt="User Avatar">
            <h4 class="mb-1">{{ Auth::user()->name }}</h4>
            <p class="text-light small mb-2">{{ Auth::user()->email }}</p>
            <span class="badge bg-light text-dark">🟢 Online</span>
          </div>

          <!-- Sisi Kanan: Detail Akun -->
          <div class="col-md-8 bg-white p-5">
            <h3 class="mb-4 text-primary"><i class="bi bi-person-vcard me-2"></i>Data Akun</h3>

            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Nama Lengkap</div>
              <div class="col-sm-8">{{ Auth::user()->name }}</div>
            </div>
            <hr>
            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Email</div>
              <div class="col-sm-8">{{ Auth::user()->email }}</div>
            </div>
            <hr>
            <div class="row mb-3">
              <div class="col-sm-4 text-muted">Tanggal Daftar</div>
              <div class="col-sm-8">{{ Auth::user()->created_at->format('d M Y') }}</div>
            </div>

            <div class="d-flex justify-content-start mt-5">
              <a href="/dashboard" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
              </a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
