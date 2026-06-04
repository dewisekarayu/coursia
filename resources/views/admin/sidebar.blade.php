@php
    $adminRole = session('admin.role');
@endphp
<aside class="sidebar">
  <div class="brand">
    <a href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('assets/logo.png') }}" alt="" style="width:120px;">
    </a>
  </div>
  <nav>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>

    @if(in_array($adminRole, ['superadmin', 'admin_kursus'], true))
      <a href="{{ route('admin.students') }}" class="{{ request()->is('admin/students*') ? 'active' : '' }}">Murid</a>
      <a href="{{ route('admin.instructors') }}" class="{{ request()->is('admin/instructors*') ? 'active' : '' }}">Instruktur</a>
      <a href="{{ route('admin.programs') }}" class="{{ request()->is('admin/programs*') ? 'active' : '' }}">Program</a>
      <a href="{{ route('admin.schedules') }}" class="{{ request()->is('admin/schedules*') ? 'active' : '' }}">Jadwal</a>

      @if($adminRole === 'superadmin')
        <a href="{{ route('admin.admins') }}" class="{{ request()->is('admin/admins*') ? 'active' : '' }}">Admin</a>
        <a href="{{ route('admin.log') }}" class="{{ request()->is('admin/log*') ? 'active' : '' }}">Log</a>
      @endif
    @endif

    @if(in_array($adminRole, ['superadmin', 'admin_keuangan'], true))
      <a href="{{ route('admin.payments') }}" class="{{ request()->is('admin/payments*') ? 'active' : '' }}">Pembayaran</a>
    @else
      {{-- fallback: tetap tampil agar tidak terasa “tidak bisa dipencet” --}}
      <a href="{{ route('admin.payments') }}" class="{{ request()->is('admin/payments*') ? 'active' : '' }}">Pembayaran</a>
    @endif



    <a href="{{ route('admin.logout') }}">Logout</a>
  </nav>
</aside>

