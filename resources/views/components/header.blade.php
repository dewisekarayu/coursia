<header class="site-header">
  <div class="container header-inner">
    <div class="logo">
      <a href="{{ route('home') }}">
        <img src="{{ asset('assets/logo.png') }}" alt="Coursia">
      </a>
    </div>

    <nav class="main-nav">
      <ul>
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('kidsprogram') }}">Kids</a></li>
        <li><a href="{{ route('teensprogram') }}">Teens</a></li>
        <li><a href="{{ route('adultsprogram') }}">Adults</a></li>
        <li><a href="{{ route('pendapat') }}">Testimoni</a></li>
      </ul>
    </nav>

    <div class="header-actions">
      @auth
        <span class="nav-user">Halo, {{ auth()->user()->name }}</span>
        <a class="btn btn-outline" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
      @else
        <a class="btn btn-outline" href="{{ route('login.form') }}">Login</a>
        <a class="btn btn-primary" href="{{ route('register.form') }}">Daftar</a>
      @endauth
    </div>
  </div>
</header>
