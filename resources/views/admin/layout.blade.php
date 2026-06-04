<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Admin — Coursia')</title>
  <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
  <script defer src="{{ asset('js/app.js') }}"></script>
</head>
<body>
  <div class="layout">
    @include('admin.sidebar')
    <main class="main">
      @include('admin.header')
      <div class="container">
        @yield('content')
      </div>
    </main>
  </div>
  @include('admin.footer')
</body>
</html>

