@extends('components.layout')

@section('title', 'Jadwal Kelas — Coursia')

@vite(['resources/css/jadwalkelas.css'])

@section('content')
<section id="jadwal" class="schedule-container">

    <h2 class="section-title">Jadwal Kelas Regular (Online)</h2>
    <p class="section-subtitle">Pilihan jadwal kelas kelompok untuk semua level. Jadwal Privat lebih fleksibel.</p>

    <div class="tab-navigation-container">
      <button class="tab-navigation-button is-active" data-target="kids">Kids (4-12)</button>
      <button class="tab-navigation-button" data-target="teens">Teens (13-17)</button>
      <button class="tab-navigation-button" data-target="adults">Adults (18+)</button>
    </div>

    <div id="schedule-content">
      <div id="kids" class="schedule-tab-content is-active">
        <div class="schedule-card level-kids">
          <div class="card-header">
            <h3>Kids (4-12 Tahun) - Starter Level</h3>
          </div>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Senin & Rabu</td><td>15:00 - 16:00</td><td>Ms. Anna</td><td>60 Menit</td>
                  <td><span class="slot-badge slot-available">4/8 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Kids', 'jadwal' => 'Siang']) }}">Pesan</a>
                  </td>
                </tr>
                <tr>
                  <td>Selasa & Kamis</td><td>16:30 - 17:30</td><td>Mr. John</td><td>60 Menit</td>
                  <td><span class="slot-badge slot-limited">1/8 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Kids', 'jadwal' => 'Siang']) }}">Pesan</a>
                  </td>
                </tr>
                <tr>
                  <td>Sabtu (Intensif)</td><td>09:00 - 10:30</td><td>Ms. Maya</td><td>90 Menit</td>
                  <td><span class="slot-badge slot-full">Penuh</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat is-disabled" aria-disabled="true" href="#" tabindex="-1">Penuh</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="teens" class="schedule-tab-content">
        <div class="schedule-card level-teens">
          <div class="card-header">
            <h3>Teens (13-17 Tahun) - Elementary Level</h3>
          </div>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Senin & Rabu</td><td>18:00 - 19:30</td><td>Ms. Anna</td><td>90 Menit</td>
                  <td><span class="slot-badge slot-available">5/10 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Teens', 'jadwal' => 'Malam']) }}">Pesan</a>
                  </td>
                </tr>
                <tr>
                  <td>Selasa & Kamis</td><td>17:00 - 18:30</td><td>Mr. Rizky</td><td>90 Menit</td>
                  <td><span class="slot-badge slot-available">7/10 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Teens', 'jadwal' => 'Malam']) }}">Pesan</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="adults" class="schedule-tab-content">
        <div class="schedule-card level-adults">
          <div class="card-header">
            <h3>Adults & Professionals (18+) - Intermediate Level</h3>
          </div>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Selasa & Kamis</td><td>19:30 - 21:00</td><td>Mr. Rizky</td><td>90 Menit</td>
                  <td><span class="slot-badge slot-available">6/10 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Adults', 'jadwal' => 'Malam']) }}">Pesan</a>
                  </td>
                </tr>
                <tr>
                  <td>Jumat (Business Focus)</td><td>20:00 - 21:30</td><td>Mr. John</td><td>90 Menit</td>
                  <td><span class="slot-badge slot-limited">2/10 Slot</span></td>
                  <td class="schedule-actions-cell">
                    <a class="btn-seat" href="{{ route('daftar', ['program' => 'Adults', 'jadwal' => 'Malam']) }}">Pesan</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="call-to-action">
      <a href="{{ route('daftar', ['program' => 'Kids', 'jadwal' => 'Siang']) }}" class="call-to-action-button">Pesan Kursi Anda Sekarang</a>
      <p class="cta-note">Untuk jadwal kelas offline atau privat, silakan hubungi admin.</p>
    </div>

  </section>

  <script>
    const tabs = document.querySelectorAll('.tab-navigation-button');
    const contents = document.querySelectorAll('.schedule-tab-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('is-active'));
        contents.forEach(c => c.classList.remove('is-active'));

        tab.classList.add('is-active');
        document.getElementById(tab.dataset.target).classList.add('is-active');
      });
    });
  </script>
@endsection 