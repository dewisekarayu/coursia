<!doctype html> 
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>English for Teens</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

 <style>
    body {
      background: #f3f6ff;
    }

    .hero {
      padding: 80px 0;
    }

    .hero h1 {
      font-weight: 800;
      color: #3554d1;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 650px;
      margin: 0 auto;
      color: #6f7287;
    }

    .section-card {
      background: #ffffff;
      border-radius: 18px;
      padding: 32px;
      border: 2px solid #e7ebff;
      box-shadow: 0 10px 28px rgba(0,0,0,0.05);
      margin-bottom: 40px;
    }

    .section-title {
      font-weight: 700;
      font-size: 1.45rem;
      color: #3554d1;
      margin-bottom: 20px;
      border-left: 6px solid #3554d1;
      padding-left: 12px;
    }

    .cta-btn {
      padding: 15px 38px;
      border-radius: 40px;
      font-size: 18px;
      font-weight: 600;
    }

    .back-btn {
      margin-top: 20px;
      padding: 12px 30px;
      border-radius: 35px;
      font-weight: 600;
    }
  </style>
</head>

<body>

<section class="hero text-center">
  <div class="container">
    <h1 class="fw-bold display-5">English for Teens</h1>
    <p>
      Program untuk meningkatkan kemampuan English remaja melalui praktik 
      speaking, project-based learning, dan aktivitas kreatif yang relatable.
    </p>
  </div>
</section>

<div class="container">

  <div class="section-card">
    <h3 class="section-title">Tujuan Belajar</h3>
    <ul>
      <li>Meningkatkan kepercayaan diri dalam speaking di situasi nyata.</li>
      <li>Mempersiapkan kemampuan English untuk tugas sekolah & lomba.</li>
      <li>Melatih critical thinking melalui diskusi dan mini project.</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Level Program</h3>
    <ul>
      <li>Pre-Intermediate</li>
      <li>Intermediate</li>
      <li>Upper Intermediate</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Materi Belajar</h3>
    <ul>
      <li>Conversational English (daily & school context).</li>
      <li>Grammar applied in real-use (not textbook-focused).</li>
      <li>Vocabulary building untuk teenager topics.</li>
      <li>Presentation & teamwork skills.</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Durasi Program</h3>
    <p>75 menit per sesi • 8 sesi per bulan • maksimal 10 siswa per kelas</p>
  </div>

  <div class="section-card">
    <h3 class="section-title">Jadwal Kelas</h3>
    <ul>
      <li>Senin — 16.00–17.15</li>
      <li>Rabu — 16.00–17.15</li>
      <li>Jumat — 15.30–16.45</li>
    </ul>
  </div>

  <div class="text-center pb-5">
    <a href="{{ route('daftar') }}" class="btn btn-primary cta-btn">Daftar Sekarang</a>

    <br>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary back-btn">← Kembali ke Homepage</a>
  </div>

</div>

</body>
</html>