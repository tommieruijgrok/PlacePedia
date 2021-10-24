<?php
session_start();
?>
<link rel="stylesheet" href="../stylesheet/header.css">
<header>
    <a href="index.php" style="color: unset; text-decoration: none"><h2>PlacePedia</h2></a>
    <div>
        <div id="searchBarParent">
            <input type="text" id="searchBar" placeholder="Zoek een plek op!">
            <div id="dropdown">

            </div>
        </div>

        <?php
            if ($_SESSION['status'] == 'true'){
                ?>
                    <a style="text-decoration: none; color: unset" href="profile.php"><?php echo $_SESSION['userName'] ?></a>
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
<script src="script/searchBar.js"></script>