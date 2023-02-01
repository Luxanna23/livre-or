<?php
session_start();
$bd = new mysqli('localhost', 'root', '', 'livreor');
$sql = 'SELECT * FROM utilisateurs';
$request = $bd->query($sql);
$result = $request->fetch_all(MYSQLI_ASSOC);
$message= "";
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

    <!-- Body -->
<?php
$sql2 = 'SELECT * FROM commentaire';
$request2 = $bd->query($sql2);
$result2 = $request2->fetch_all(MYSQLI_ASSOC);

foreach ($result as $key => $value){
    if ($value['login'] == $_SESSION['login']){
        $id = $value['id'];
        $login = $value['login'];
    }
}

if (isset($_POST['submit'])) {
    // if (!isset($_SESSION['login'])) {
    //     header('location:connexion.php');    
    // } 
    // else {
        if (!empty($_POST['comm'])){
            //$login = $_SESSION['login'];
            $comm = $_POST['comm'];
            $date = date('y/m/d');
            date_default_timezone_set('Europe/Paris');
            $sql2 = "INSERT INTO commentaire( id_utilisateur, commentaire, date) VALUES ('$id', '$comm', '$date')";
            $request2 = $bd->query($sql2);
            header('location:livre-or.php');
        }
        else {
            $message = "Vous devez écrire un commentaire !";
        }
   // }
}
?>
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

            <h1 class="h1from">Ecrivez un commentaire</h1> <!-- titre -->

            <div class="">
                <textarea rows="10" cols="50" type="text" name="comm" placeholder="Votre commentaire ici."></textarea>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Envoyer">
            </div>

            <div class="message"><?= $message ?></div>

        </form>

    </div>
    
</body>
</html>