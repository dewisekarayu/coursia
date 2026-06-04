<?php
session_start();

$mentors = [
    "anna" => [
        "name" => "Anna Williams",
        "img"  => "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=800&q=70&auto=format&fit=crop",
        "expert" => "TOEFL • Kids • IELTS",
        "desc" => "Anna menggabungkan metode pengajaran berbasis data dengan pendekatan yang lembut dan human-centered. Setiap sesi dirancang seperti learning system yang adaptif—fun, cepat dipahami, dan efektif untuk anak hingga remaja.",
        "skills" => ["TOEFL Prep", "IELTS Academic", "Kids Program", "Phonics"]
    ],

    "rizky" => [
        "name" => "Rizky Pratama",
        "img"  => "https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=800&q=70&auto=format&fit=crop",
        "expert" => "TEFL • Business English",
        "desc" => "Rizky menghadirkan pengalaman belajar ala corporate learning system: terstruktur, responsif, dan berfokus pada hasil. Pendekatannya futuristik dan relevan dengan kebutuhan industri modern.",
        "skills" => ["Business English", "Corporate Training", "Presentation", "TEFL Expert"]
    ],

    "maya" => [
        "name" => "Maya Sari",
        "img"  => "https://randomuser.me/api/portraits/women/65.jpg",
        "expert" => "IELTS Specialist",
        "desc" => "Maya menggunakan strategi IELTS berbasis analisis performa dan pattern-based learning. Efektif, sistematis, dan dirancang untuk mempercepat peningkatan band score.",
        "skills" => ["IELTS Writing", "IELTS Speaking", "Mock Test", "Band Strategy"]
    ],

    "john" => [
        "name" => "John Carter",
        "img"  => "https://images.unsplash.com/photo-1544006659-f0b21884ce1d?w=800&q=70&auto=format&fit=crop",
        "expert" => "Native Speaker • Conversation Coach",
        "desc" => "John memberikan pengalaman speaking natural dan immersive, fokus pada pronunciation, fluency, dan real-life expression dengan pendekatan intuitif.",
        "skills" => ["Speaking Fluency", "Pronunciation", "Conversation", "Accent Training"]
    ]
];

$selected = $_GET['mentor'] ?? '';
if (!isset($mentors[$selected])) die("Mentor tidak ditemukan.");
$data = $mentors[$selected];
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title><?= $data['name']; ?> - Mentor Coursia</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
body {
    background: #eef1f8;
    font-family: Inter, sans-serif;
    margin: 0;
}

.header {
    background: linear-gradient(135deg, #4456ff, #7a37ff);
    padding: 90px 20px 120px;
    text-align: center;
    color: white;
    border-radius: 0 0 40px 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.profile-box {
    width: 90%;
    max-width: 950px;
    margin: -90px auto 50px;
    background: #fff;
    padding: 50px;
    border-radius: 28px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    text-align: center;
}

.profile-box img {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 6px solid white;
    margin-top: -120px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

.expert-tag {
    margin-top: 15px;
    font-size: 17px;
    color: #4752ff;
    font-weight: 700;
}

.desc {
    margin-top: 25px;
    font-size: 16px;
    color: #444;
    line-height: 1.7;
}

.skill {
    display: inline-block;
    background: #eef0ff;
    color: #4752ff;
    padding: 8px 18px;
    border-radius: 50px;
    margin: 8px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 3px 12px rgba(100,100,255,0.18);
    transition: 0.2s;
}
.skill:hover {
    background: #4752ff;
    color: white;
    transform: translateY(-3px);
}

.btn-book {
    display: inline-block;
    margin-top: 35px;
    padding: 14px 32px;
    background: linear-gradient(135deg, #4752ff, #7a37ff);
    color: white;
    font-weight: 700;
    border-radius: 14px;
    text-decoration: none;
    font-size: 16px;
    box-shadow: 0 5px 18px rgba(70,70,255,0.3);
    transition: 0.25s;
}
.btn-book:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(70,70,255,0.45);
}

.back {
    display: inline-block;
    margin-top: 20px;
    color: #666;
    text-decoration: none;
    font-size: 14px;
}
.back:hover {
    color: #333;
}

</style>
</head>

<body>

<div class="header">
    <h1><?= $data['name']; ?></h1>
    <div class="expert-tag"><?= $data['expert']; ?></div>
</div>

<div class="profile-box">
    <img src="<?= $data['img']; ?>" alt="Foto Mentor">

    <p class="desc"><?= $data['desc']; ?></p>

    <h3 style="margin-top: 30px; color:#333;">Keahlian:</h3>
    <?php foreach ($data['skills'] as $skill): ?>
        <span class="skill"><?= $skill; ?></span>
    <?php endforeach; ?>

    <br><br>
    
    <a class="btn-book" href="{{ route('payment', ['paket'=>'privat','mentor'=>$selected]) }}">Booking Kelas Dengan Mentor Ini</a>

    <br>
    <a class="back" href="{{ route('home') }}">← Kembali ke Homepage</a>

</div>

</body>
</html>