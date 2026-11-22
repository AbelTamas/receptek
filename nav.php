<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Felhasználó';
?>
<aside class="sidebar">
    <div>
       <div class="nav-brand">🧲 HűtőMágnes</div>
        <ul class="nav-links">
            <li>
                <a href="index.php" class="menu-receptek">
                    <span class="menu-icon">📖</span> Receptek böngészése
                </a>
            </li>
            <li>
                <a href="ajanlott_receptek.php" class="menu-ajanlott">
                    <span class="menu-icon">⭐</span> Ajánlott receptek
                </a>
            </li>
            <li>
                <a href="kereso.php" class="menu-kereso">
                    <span class="menu-icon">🔍</span> Recept kereső
                </a>
            </li>
            <li>
                <a href="nevjegy.php" class="menu-nevjegy">
                    <span class="menu-icon">ℹ️</span> Névjegy
                </a>
            </li>
        </ul>
    </div>
    
    <div>
        <ul class="nav-links">
            <li>
                <a href="logout.php" class="menu-kilepes">
                    <span class="menu-icon">🚪</span> Kilépés (<?php echo htmlspecialchars($username); ?>)
                </a>
            </li>
        </ul>
    </div>
</aside>