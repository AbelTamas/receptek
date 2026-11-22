<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>HűtőMágnes - Receptgyűjtemény</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .about-card {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            max-width: 700px;
            margin: 40px auto;
            text-align: center;
        }
        .about-card h1 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 2rem;
        }
        .about-card p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .creators-box {
            background: #f8f9fa;
            border-left: 4px solid #27ae60;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
            border-radius: 0 8px 8px 0;
        }
        .creators-box h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }
        .creators-list {
            list-style: none;
            padding: 0;
        }
        .creators-list li {
            padding: 5px 0;
            font-size: 1.05rem;
            color: #333;
            font-weight: 500;
        }
        .project-meta {
            font-size: 0.95rem;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <main class="container">
        <div class="about-card">
            <h1>HűtőMágnes Alkalmazás</h1>
            <p>Ez a webes alkalmazás egy komplex receptkezelő és külső keresőrendszer, amely segít az otthoni alapanyagok felhasználásában és a főzésben.</p>
            
            <div class="creators-box">
                <h3>A program készítői:</h3>
                <ul class="creators-list">
                    <li>👨‍💻 Ábel Tamás</li>
                    <li>👩‍💻 Ábel-Antal Ágnes</li>
                    <li>👩‍💻 Visnyánszki Dalma</li>
                </ul>
            </div>

            <div class="project-meta">
                <p>Készült a <strong>Szoftverfejlesztő és tesztelő</strong> tanfolyam vizsgaremek munkájaként.</p>
                <p>Technológiák: PHP, MySQL, HTML5, CSS3</p>
            </div>
        </div>
    </main>
</body>
</html>