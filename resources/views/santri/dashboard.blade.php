<h1>Dashboard Santri</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>
<p>Role: {{ auth()->user()->role }}</p>

<form method="POST" action="/logout">
    @csrf
    <button class="btn">Logout</button>
</form>