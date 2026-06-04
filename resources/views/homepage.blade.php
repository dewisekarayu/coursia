<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Coursia — Kursus Bahasa Inggris (Versi EF-style Upgrade)</title>
  <meta name="description" content="Coursia — Kursus Bahasa Inggris lengkap untuk semua umur: Kids, Teens, Adults, Professionals, Corporate." />

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

  <style>
    #testimoni .testimonial {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: space-between;
        padding-bottom: 2rem;
    }
    
    #testimoni .testimonial p.italic {
        flex-grow: 1;
        margin-bottom: 1.5rem;
    }

    .btn-testimoni {
        min-width: 150px;
        width: auto !important;
        border-radius: 50px;
        margin-top: auto;
    }

    .nav-user {
        color: #ffffff;
        font-weight: 600;
        margin-right: 0.75rem;
        white-space: nowrap;
    }

    .toast-success {
        background: rgba(56, 161, 105, 0.14);
        color: #134f2d;
        border: 1px solid rgba(56, 161, 105, 0.35);
        padding: 1rem 1.25rem;
        border-radius: 16px;
    }
  </style>
</head>

<body>
  <header class="site-header">
    <div class="container header-inner">
      <div class="logo">
        <img src="{{ asset('assets/logo.png') }}" alt="Coursia">
      </div>

      <nav class="main-nav">
        <ul>
          <li><a href="#program">Program</a></li>
          <li><a href="#program">Level</a></li>
          <li><a href="#pricing">Harga</a></li>
          <li><a href="#pengajar">Pengajar</a></li>
          <li><a href="#testimoni">Testimoni</a></li>
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

  @if(session('success'))
    <div class="container mt-3">
      <div class="toast-success">{{ session('success') }}</div>
    </div>
  @endif

  <main>

    <section class="hero">
      <div class="container hero-grid">
        <div class="hero-left" data-aos="fade-right">
          <h1>Belajar Bahasa Inggris <span class="accent">Percaya Diri & Terukur</span></h1>
          <p class="lead">Coursia memberikan kurikulum terstruktur, tutor bersertifikat, dan pengalaman belajar interaktif untuk semua usia.</p>

          <div class="hero-ctas">

    @auth
        <a class="btn btn-success" href="{{ route('dashboard') }}">Dashboard Saya</a>
    @else
        <a class="btn btn-outline" href="{{ route('login.form') }}">Login</a>
        <a class="btn btn-primary" href="{{ route('register.form') }}">Daftar</a>
    @endauth

    <a class="btn btn-primary" href="{{ route('jadwalkelas') }}">Lihat Program</a>


</div>


          <div class="hero-features">
            <div class="feature">
              <div class="icon big">📜</div>
              <div>
                <div class="title">Pengajar Bersertifikat</div>
                <div class="meta">TOEFL, IELTS</div>
              </div>
            </div>

            <div class="feature">
              <div class="icon big">⏱</div>
              <div>
                <div class="title">Jadwal Fleksibel</div>
                <div class="meta">Online & Offline</div>
              </div>
            </div>
          </div>
        </div>

        <div class="hero-right" data-aos="zoom-in">
          <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=1200&q=80&auto=format&fit=crop&ixlib=rb-4.0.3&s=placeholder" alt="Belajar">
          </div>

          <div class="card-popular">
            <div class="tiny">Kelas Populer</div>
            <div class="bold">TOEFL & IELTS Intensive</div>
            <div class="muted">Paket 8 minggu simulasi + feedback</div>
          </div>
        </div>
      </div>
    </section>

    <section id="program" class="section container">
      <h2 class="section-title" data-aos="fade-up">Program Berdasarkan Usia & Tujuan</h2>
      <p class="section-sub" data-aos="fade-up">Pilih program yang pas untuk tahap perkembangan dan targetmu.</p>

      <div class="grid-3">

        <article class="card card-kids" data-aos="fade-up">
          <div class="card-head">
    <img src="{{ asset('assets/kids.jpeg') }}" alt="Kids" class="thumb">
            <div>
              <h3>Kids 4–12 Tahun</h3>
              <p class="muted">Storytelling, songs, phonics. Maks. 8 siswa/kelas.</p>
            </div>
          </div>

          <ul class="list">
            <li>Durasi: 60 menit / sesi</li>
            <li>Level: Starter → Elementary</li>
            <li>Harga mulai: <strong>Rp 250.000 / bulan</strong></li>
          </ul>

          <div class="card-actions">
            <a class="btn btn-primary" style="width: 100%;" href="{{ route('kidsprogram') }}">Detail Program</a>
          </div>
        </article>

        <article class="card card-teens" data-aos="fade-up">
          <div class="card-head">
    <img src="{{ asset('assets/teens.jpeg') }}" alt="Teens" class="thumb">
            <div>
              <h3>Teens 13–17 Tahun</h3>
              <p class="muted">Speaking, writing, presentation, persiapan ujian.</p>
            </div>
          </div>

          <ul class="list">
            <li>Durasi: 90 menit / sesi</li>
            <li>Level: Elementary → Pre-Intermediate</li>
            <li>Harga mulai: <strong>Rp 300.000 / bulan</strong></li>
          </ul>

          <div class="card-actions">
            <a class="btn btn-success" style="width: 100%;" href="{{ route('teensprogram') }}">Detail Program</a>
          </div>
        </article>

        <article class="card card-adult" data-aos="fade-up">
          <div class="card-head">
            <img src="{{ asset('assets/adult.jpeg') }}" alt="Adults" class="thumb">
            <div>
              <h3>Adults & Professionals 18+</h3>
              <p class="muted">Business English, presentation, negotiation, exam prep.</p>
            </div>
          </div>

          <ul class="list">
            <li>Durasi: 90–120 menit / sesi</li>
            <li>Level: Intermediate → Advanced</li>
            <li>Harga mulai: <strong>Rp 450.000 / bulan</strong></li>
          </ul>

          <div class="card-actions">
             <a class="btn btn-warning" style="width: 100%;" href="{{ route('adultsprogram') }}">Detail Program</a>
          </div>
        </article>

      </div>
    </section>

    <section id="pengajar" class="section container bg-soft">
      <h2 class="section-title">Pengajar Unggulan</h2>
      <div class="grid-4">
        
        <div class="teacher-card">
          <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&q=60&auto=format&fit=crop" alt="Anna">
          <h4>Anna Williams</h4>
          <p class="muted">TOEFL • Kids & IELTS</p>
          <a class="btn btn-primary sm" href="{{ route('mentor', ['mentor'=>'anna']) }}">Lihat Profil</a>
        </div>

        <div class="teacher-card">
          <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=500&q=60&auto=format&fit=crop" alt="Rizky">
          <h4>Rizky Pratama</h4>
          <p class="muted">TEFL • Business English</p>
          <a class="btn btn-primary sm" href="{{ route('mentor', ['mentor'=>'rizky']) }}">Lihat Profil</a>
        </div>

        <div class="teacher-card">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Maya">
          <h4>Maya Sari</h4>
          <p class="muted">IELTS Specialist</p>
          <a class="btn btn-primary sm" href="{{ route('mentor', ['mentor'=>'maya']) }}">Lihat Profil</a>
        </div>

        <div class="teacher-card">
          <img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d?w=500&q=60&auto=format&fit=crop" alt="John">
          <h4>John Carter</h4>
          <p class="muted">Native Speaker • Conversation Coach</p>
          <a class="btn btn-primary sm" href="{{ route('mentor', ['mentor'=>'john']) }}">Lihat Profil</a>
        </div>

      </div>
    </section>

    <section id="pricing" class="section container">
      <h2 class="section-title">Paket & Harga</h2>
      <div class="grid-3">

        <div class="pricing-card">
          <div class="tag">Paket</div>
          <h3>Group Reguler</h3>
          <div class="price">Rp 300.000 / bulan</div>
          <ul class="list">
            <li>8 sesi / bulan</li>
            <li>Progress report</li>
            <li>Maks. 10 siswa</li>
          </ul>
          <a class="btn btn-success" href="{{ route('payment', ['paket'=>'group']) }}">Pilih</a>
        </div>

        <div class="pricing-card">
          <div class="tag">Paket</div>
          <h3>Privat</h3>
          <div class="price">Rp 800.000 / bulan</div>
          <ul class="list">
            <li>Jadwal fleksibel</li>
            <li>Kurikulum personal</li>
            <li>One-on-one</li>
          </ul>
          <a class="btn btn-success" href="{{ route('payment', ['paket'=>'privat']) }}">Pilih</a>
        </div>

        <div class="pricing-card">
          <div class="tag">Paket</div>
          <h3>Intensive (TOEFL/IELTS)</h3>
          <div class="price">Rp 3.000.000 / paket</div>
          <ul class="list">
            <li>8–12 minggu</li>
            <li>Simulasi ujian</li>
            <li>Analisis dan feedback</li>
          </ul>
          <a class="btn btn-warning" href="{{ route('payment', ['paket'=>'intensive']) }}">Pilih</a>
        </div>
      </div>
    </section>

    <section id="testimoni" class="section container bg-gradient-test">
      <h2 class="section-title">Kata Mereka</h2>
      <div class="grid-3" style="align-items: stretch;"> 
        
        <div class="testimonial">
          <img src="{{ asset('assets/aulia.jpeg') }}" alt="Aulia">
          <p class="italic">"Coursia bikin belajar Inggris jadi fun banget! Aku sekarang lebih pede ngomong di sekolah."</p>
          <h4 class="accent">Aulia (12 thn)</h4>
          <a href="{{ route('pendapat', ['nama'=>'Aulia']) }}" class="btn btn-outline sm btn-testimoni">Baca Cerita Aulia</a>
        </div>

        <div class="testimonial">
          <img src="{{ asset('assets/raka1.jpeg') }}" alt="Raka">
          <p class="italic">"Belajarnya interaktif banget. Guru-gurunya sabar dan bikin suasana enak!"</p>
          <h4 class="accent">Raka (17 thn)</h4>
          <a href="{{ route('pendapat', ['nama'=>'Raka']) }}" class="btn btn-outline sm btn-testimoni">Baca Cerita Raka</a>
        </div>

        <div class="testimonial">
          <img src="{{ asset('assets/maya1.jpeg') }}" alt="Maya">
          <p class="italic">"Aku jadi lebih percaya diri pakai bahasa Inggris di kantor. Thanks Coursia!"</p>
          <h4 class="accent">Maya (27 thn)</h4>
          <a href="{{ route('pendapat', ['nama'=>'Maya']) }}" class="btn btn-outline sm btn-testimoni">Baca Cerita Maya</a>
        </div>

      </div>
    </section>

    <section id="lokasi" class="section container">
      <h2 class="section-title">Kantor & Cabang</h2>
      <p class="muted">Cabang kami tersedia di beberapa kota — hubungi admin untuk jadwal kelas offline.</p>

      <div class="grid-3">
        <div class="location-card">
          <h4>Depok</h4>
          <p class="muted">Jl. Contoh No.12, Depok</p>
        </div>
        <div class="location-card">
          <h4>Surabaya</h4>
          <p class="muted">Jl. Contoh No.34, Surabaya</p>
        </div>
        <div class="location-card">
          <h4>Jakarta</h4>
          <p class="muted">Jl. Contoh No.56, Jakarta</p>
        </div>
      </div>

      <div class="map-wrap">
        <iframe class="map-frame" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7920.123456789012!2d106.8020!3d-6.3700!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edf4example!2sDepok!5e0!3m2!1sen!2sid!4v1690000000000"
          allowfullscreen></iframe>
      </div>
    </section>

    <footer class="site-footer">
      <div class="container footer-grid">
        <div>
          <h4>Coursia</h4>
          <p class="muted">Kursus bahasa Inggris — percaya diri bicara, siap tes, siap kerja.</p>
        </div>
        <div>
          <h5>Program</h5>
          <ul class="muted">
            <li>English for Kids (4–12)</li>
            <li>English for Teens (13–17)</li>
            <li>University & Adults</li>
            <li>Business & Corporate</li>
            <li>TOEFL / IELTS</li>
          </ul>
        </div>
        <div>
          <h5>Kontak</h5>
          <p class="muted">Email: hello@coursia.id</p>
          <p class="muted">WA: 0812-xxxx-xxxx</p>
        </div>
      </div>
      <div class="copyright">© 2025 Coursia. All rights reserved.</div>
    </footer>
  </main>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <script>
    AOS.init();
  </script>

</body>
</html>