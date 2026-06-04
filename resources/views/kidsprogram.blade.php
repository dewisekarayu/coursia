<!doctype html> 
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>English for Kids</title>

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
    <h1 class="fw-bold display-5">English for Kids</h1>
    <p>
      Belajar sambil bermain — fun activities, storytelling, songs, dan games interaktif untuk mengenalkan English sejak dini.
    </p>
  </div>
</section>

<div class="container">

  <div class="section-card">
    <h3 class="section-title">Tujuan Belajar</h3>
    <ul>
      <li>Mengenalkan kosakata dasar secara fun dan mudah diingat.</li>
      <li>Meningkatkan kemampuan listening dan pronunciation.</li>
      <li>Membangun keberanian berbicara dari konteks sederhana.</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Level Program</h3>
    <ul>
      <li>Starter</li>
      <li>Beginner</li>
      <li>Elementary</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Materi Belajar</h3>
    <ul>
      <li>Phonics & early reading.</li>
      <li>Daily vocabulary (colors, animals, family, school).</li>
      <li>Basic speaking & storytelling.</li>
    </ul>
  </div>

  <div class="section-card">
    <h3 class="section-title">Durasi Program</h3>
    <p>60 menit per sesi • 8 sesi per bulan • maksimal 8 siswa per kelas</p>
  </div>

  <div class="section-card">
    <h3 class="section-title">Jadwal Kelas</h3>
    <ul>
      <li>Senin & Rabu — 15.00–16.00</li>
      <li>Selasa & Kamis — 16.00–17.00</li>
      <li>Sabtu — 10.00–11.00</li>
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
