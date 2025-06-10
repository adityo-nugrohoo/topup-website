@auth
<form method="POST" action="/logout" class="d-inline">
    @csrf
    <button class="btn btn-danger btn-sm">Logout</button>
</form>
@endauth