<nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary" data-bs-theme="dark">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand fw-bold text-warning" href="/">Candy Shop</a>
        @if(Auth::check())
            <a href="/logout">
                <button class="btn btn-warning">Logout</button>
            </a>
        @else
            <a href="/admin/login">
                <button class="btn btn-warning">Login</button>
            </a>
        @endif
    </div>
</nav>
