<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Coursia')</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="page-bg">
  @section('header')
    @include('components.header')
  @show

  @if(session('success'))
    <div class="container mt-3">
      <div class="toast-success">{{ session('success') }}</div>
    </div>
  @endif
  @if(session('error'))
    <div class="container mt-3">
      <div class="toast-error">{{ session('error') }}</div>
    </div>
  @endif

  <main class="container page-container">
    @yield('content')
  </main>

  @section('footer')
    @include('components.footer')
  @show
</body>
</html>

