<?php
session_start();
$message = "";
$bd = new mysqli('localhost', 'root', '', 'livreor');

if (isset($_POST['submit'])) {
  if (!empty($_POST['login']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
    $sql = 'SELECT login FROM utilisateurs';
    $request = $bd->query($sql);
    $result = $request->fetch_all(MYSQLI_ASSOC);
    $i = 0;
    foreach ($result as $value) {
      if ($value["login"] == $_POST['login']) {
        $message = "Ce login existe deja, utilisez un autre login !";
        $i++;
      }
    }
      if ($i==0){
        if ($_POST['password1'] == $_POST['password2']) {
          $login = $_POST['login'];
          $mdp = $_POST['password1'];
          $sql = "INSERT INTO utilisateurs(login, password) VALUES ('$login', '$mdp')";
          $request = $bd->query($sql);
          header('location:connexion.php');
        } 
        else {
          $message = "Les deux mots de passe ne sont pas identiques !";
        }
        echo $message;
      
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

            <h1 class="h1from">Inscription</h1> <!-- titre -->

              <div class="field">
                <label>Login :</label>
                <input type="text" name="login">
              </div>

              <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password1">
              </div>

              <div class="field">
                <label>Confirmez le mot de passe :</label>
                <input type="password" name="password2">
              </div>

              <div class="field">
                <input type="submit" name="submit" value="Connexion">
              </div>

              <div class="message"><?= $message ?></div>
            </form>
        </div>
        <div class="petitmsg">
          <span>Vous avez deja un compte ? <a href="connexion.php">Connectez-vous !</a></span>
        </div>    
</body>
</html>