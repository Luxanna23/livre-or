<?php
session_start();
$bd = new mysqli('localhost', 'root', '', 'livreor');
$sql = 'SELECT * FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Avis Japon</title>
</head>

<body class="body1">

    <header>
        <div class="head">
            <nav>
                <ul class="menu">
                    <li><a class="titremenu" href="index.php">Home</a></li>
                    <li><a class="titremenu" href="inscription.php">Inscription</a></li>
                    <li><a class="titremenu" href="connexion.php">Connexion</a></li>
                    <?php if (isset($_SESSION['login']) == TRUE) {?>
                    <li><a class="titremenu" href="profil.php">Profil</a></li>
                    <?php } ?>
                    <li><a class="titremenu" href="livre-or.php">Livre Or</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Body -->

    <div class="main">
        <h1>LE JAPON</h1>
        <hr style="margin:auto;width:40%">
        <p class="descri">La destination n°1 des touristes dans le monde</p>
    </div>

</body>

</html>

</html>