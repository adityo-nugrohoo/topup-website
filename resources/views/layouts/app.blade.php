@auth
<form method="POST" action="/logout" class="d-inline">
    @csrf
    <div class="main-content">
  @yield('content')
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</form>
@endauth