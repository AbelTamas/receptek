<?php
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $felhasznalonev = trim($_POST['felhasznalonev']);
    $jelszo = trim($_POST['jelszo']);

    // Ideiglenes egyszerű ellenőrzés a teszteléshez
    if ($felhasznalonev === 'admin' && $jelszo === 'admin123') {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'admin';
        header("Location: index.php");
        exit();
    } else {
        $error = "Helytelen felhasználónév vagy jelszó!";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés - Receptgyűjtemény</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-card">
        <h2>Bejelentkezés</h2>
        <?php if (!empty($error)): ?>
            <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label>Felhasználónév:</label>
                <input type="text" name="felhasznalonev" required>
            </div>
            <div class="form-group">
                <label>Jelszó:</label>
                <input type="password" name="jelszo" required>
            </div>
            <button type="submit">Belépés</button>
        </form>
    </div>
</body>
</html>