<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>HűtőMágnes - Receptgyűjtemény</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <main class="container">
        <h1>Receptek böngészése</h1>
        <p>Üdvözöljük a Receptgyűjteményben! Itt találhatók a legfinomabb ételek receptjei.</p>
        
        <div class="recipe-grid">
            <div class="recipe-card">
                <h3>Gulyásleves</h3>
                <p>Klasszikus magyar gulyásleves marhahúsból, friss zöldségekkel és csipetkével.</p>
            </div>
            <div class="recipe-card">
                <h3>Palacsinta</h3>
                <p>Hagyományos vékony palacsinta túrós, kakaós vagy lekváros töltelékkel.</p>
            </div>
        </div>
    </main>
</body>
</html>