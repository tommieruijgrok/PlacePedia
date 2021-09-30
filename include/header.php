<?php
session_start();
?>
<link rel="stylesheet" href="../stylesheet/header.css">
<header>
    <h2>PlacePedia</h2>
    <div>
        <input type="text">
        <?php
            if ($_SESSION['status'] == 'true'){
                ?>
                    <p><?php echo $_SESSION['userName'] ?></p>
                    <a id="logoutButton" href="../process/logout.php" style="text-decoration: none; color: unset">Uitloggen
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                <?php
            } else {
                ?>
                    <a href="../login.php" style="text-decoration: none; color: unset">Inloggen</a>
                <?php
            }
        ?>

    </div>
</header>
