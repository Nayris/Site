<?php session_start(); 


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Shop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="shortcut icon" href="favicons.ico">
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <script src='main.js'></script>
</head>
<body>
    <header>
        <a href="#" class="logo">Logo</a>
        <div class="group">
            <?php include 'includes/nav.php'; ?>
        </div>
        <div class="menuToggle">
            <p>icon menu</p>
            <p>icon close</p>
        </div>
    </header>
    <!-- <div class="banner">
        <div class="bg">
            <img src="bg.png" class="cover">
            <div class="content">
                <h2>(slogan)</h2>
                <a href="#" class="btn">Book Now</a>
        </div>
    </div> -->






    <section>
        <?php
            if(isset($_COOKIE['fname']) && isset($_COOKIE['name']) && isset($_COOKIE['email'])){
                ?>
                <p>Bienvenue sur votre compte <?= $_COOKIE['fname'];?> </p>
                <p>Votre nom : <?= $_COOKIE['name'];?> </p>
                <p>Votre email : <?= $_COOKIE['email'];?> </p>
                <a href="includes/jeux.php"><h3>Jeu</h3></a>
                <form method="post">
                    <a href="#"><input type="submit" name="logout" id="logout" value ="Logout"></a><br/>
                </form>
                <?php
                if(isset($_POST['logout'])){
                    setcookie('name', '', time(), '/', null, false, true);
                    setcookie('fname', '', time(), '/', null, false, true);
                    setcookie('email', '', time(), '/', null, false, true);
                    header('Location:/shop');
                }
            }else{
                ?>
                <p>Connexion :</p>
                <?php include 'includes/database.php';
                global $db;?>
                <?php include 'includes/login.php'; ?>
                <br/>
                <p>Inscription :</p>
                <?php include 'includes/signup.php';
            }
        
        ?>
    </section>
    <div class="produit">
        <div class="nano">
           <p>Nano</p>
        </div>
        <div class="Plaque">
            <p>Plaques</p>
        </div>
    </div>
    <div class="me">
        <p>Ca c'est moi</p>
    </div>
    <div class="contact">
        <p>Pour me contacter :</p>
    </div>
    <footer>
        <ul>
            <li><a href="contact.html">Contacts</a></li>
            <li><a href="me.html">Me</a></li>
        </ul>
    </footer>
</body>
</html>