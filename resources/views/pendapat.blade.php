<?php
session_start();

$nama = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : 'Siswa';

$cerita = [
    'Aulia' => [
        'full_name' => 'Aulia (12 Tahun)',
        'program' => 'English for Kids',
        'quote' => 'Coursia bikin belajar Inggris jadi fun banget!',
        'story' => 'Awalnya aku takut banget kalau disuruh ngomong bahasa Inggris di depan kelas. Tapi di Coursia, Miss Anna ngajarnya seru banget pake lagu dan cerita. Sekarang aku jadi juara pidato bahasa Inggris di sekolah!',
        'img' => '../assets/aulia.jpeg'
    ],
    'Raka' => [
        'full_name' => 'Raka (17 Tahun)',
        'program' => 'English for Teens (Exam Prep)',
        'quote' => 'Guru-gurunya sabar dan bikin suasana enak!',
        'story' => 'Persiapan ujian sekolah bikin stress, tapi kelas di Coursia santai tapi daging semua isinya. Aku belajar banyak trik grammar yang gak diajarin di sekolah. Nilai ujianku naik drastis.',
        'img' => '../assets/raka1.jpeg'
    ],
    'Maya' => [
        'full_name' => 'Maya (27 Tahun)',
        'program' => 'Business English',
        'quote' => 'Aku jadi lebih percaya diri pakai bahasa Inggris di kantor.',
        'story' => 'Sebagai marketing, aku sering meeting sama klien luar negeri. Dulu sering grogi dan belepotan. Setelah ambil paket privat di Coursia, vocabulary bisnisku nambah banyak dan aku bisa presentasi dengan lancar. Thanks Coursia!',
        'img' => '../assets/maya1.jpeg'
    ]
];

$data = isset($cerita[$nama]) ? $cerita[$nama] : [
    'full_name' => 'Siswa Coursia',
    'program' => 'General English',
    'quote' => 'Pengalaman belajar yang menyenangkan.',
    'story' => 'Cerita belum tersedia untuk saat ini.',
    'img' => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?w=500'
];

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pendapat <?php echo $nama; ?> — Coursia</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/homepage.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f8fafc;
        }
        .site-header {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }
        .logo img {
            height: 40px;
        }
        .main-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .main-nav ul li a {
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            padding: 8px 15px;
            transition: color 0.3s;
        }
        .main-nav ul li a:hover {
            color: #4f46e5;
        }
        main {
            padding: 4rem 0;
            flex-grow: 1;
        }
        .testimonial-card {
            max-width: 800px;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            background: white;
        }
        .testimonial-content {
            display: flex;
            flex-wrap: wrap;
        }
        .image-side {
            flex: 1;
            min-width: 300px;
            background: #f0f4f8;
        }
        .image-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 300px;
            display: block;
        }
        .text-side {
            flex: 1.5;
            padding: 2.5rem;
        }
        .tag {
            background: #e0e7ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        .text-side h1 {
            margin-top: 1rem;
            font-size: 2rem;
            color: #1e293b;
        }
        blockquote {
            border-left: 4px solid #4f46e5;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #475569;
        }
        .text-side p {
            line-height: 1.8;
            color: #334155;
        }
        .action-buttons {
            margin-top: 2rem;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-right: 10px;
            display: inline-block;
        }
        .btn-outline {
            border: 2px solid #4f46e5;
            color: #4f46e5;
            background: white;
        }
        .btn-outline:hover {
            background: #4f46e5;
            color: white;
        }
        .btn-primary {
            background: #4f46e5;
            color: white;
            border: 2px solid #4f46e5;
        }
        .btn-primary:hover {
            background: #3e33c6;
            border-color: #3e33c6;
        }
        .site-footer {
            margin-top: auto;
            padding: 20px 0;
            background: #f1f5f9;
        }
        .copyright {
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
        }

        @media (max-width: 768px) {
            .testimonial-content {
                flex-direction: column;
            }
            .image-side {
                min-height: 200px;
                height: 300px;
                width: 100%;
            }
            .text-side {
                padding: 1.5rem;
            }
            .text-side h1 {
                font-size: 1.75rem;
            }
            .action-buttons a {
                display: block;
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <header class="site-header">
        <div class="container header-inner">
            <div class="logo">
                <a href="homepage.php"><img src="../assets/logo.png" alt="Coursia"></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="homepage.php">Kembali ke Beranda</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        
        <div class="testimonial-card" data-aos="fade-up">
            
            <div class="testimonial-content">
                <div class="image-side">
                    <img src="<?php echo htmlspecialchars($data['img']); ?>" alt="<?php echo htmlspecialchars($data['full_name']); ?>">
                </div>

                <div class="text-side">
                    <span class="tag">
                        <?php echo htmlspecialchars($data['program']); ?>
                    </span>
                    
                    <h1><?php echo htmlspecialchars($data['full_name']); ?></h1>
                    
                    <blockquote>
                        "<?php echo htmlspecialchars($data['quote']); ?>"
                    </blockquote>

                    <p>
                        <?php echo htmlspecialchars($data['story']); ?>
                    </p>

                    <div class="action-buttons">
                        <a href="homepage.php#testimoni" class="btn btn-outline">Kembali</a>
                        <a href="{{ route('daftar') }}" class="btn btn-primary">Gabung Seperti <?php echo $nama; ?></a>

                    </div>
                </div>
            </div>

        </div>

    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="copyright">© 2025 Coursia. All rights reserved.</div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>