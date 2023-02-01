<?php
session_start();
$message = "";
$bd = new mysqli('localhost', 'root', '', 'livreor');
$sql = 'SELECT login,password FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $mdp = $_POST['password'];
        foreach ($result as $resultat) {
            if ($login == $resultat['login'] && $mdp == $resultat['password']) {
                $_SESSION['login'] = $login;
                header('location:profil.php');
            } else {
                $message = "Le login et le mot de passe ne correspendent pas !";
            }
        }
    } else {
        $message = "Vous devez remplir tous les champs !";
    }
}
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

<body class="body2">
    <!-- header -->
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
    <div class="container">
        <form class='form1' method="POST"> <!-- formulaire -->

            <h1 class="h1from">Connexion</h1> <!-- titre -->

            <div class="field">
                <label>Login :</label>
                <input type="text" name="login">
            </div>

            <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password">
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Connexion">
            </div>

            <div class="message"><?= $message ?></div>

        </form>

    </div>
    <div class="petitmsg">
        <span>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></span>
    </div>
    
</body>

</html>