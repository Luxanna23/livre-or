<?php
session_start();
 if (!isset($_SESSION['login'])) {
    header('location:connexion.php');
 }

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
<body class="body1">
    <div>
        <h1><?= 'Bonjour, ' . $_SESSION['login'] ?></h1>
        <hr style="margin:auto;width:40%">
    </div>
<?php 
foreach ($result as $key => $value){
    if ($value['login'] == $_SESSION['login']){
        $id = $value['id'];
        $login = $value['login'];
        $mdp = $value['password'];
    }
}
if (isset($_POST['enregistrer'])) {
    if (!empty($_POST['login'])) {
        $login = !empty($_POST['login'])? $_POST['login']:$_SESSION['login'];
        $log = $_SESSION['login'];
        $sql = "UPDATE utilisateurs SET login = '$login' WHERE id = '$id'";
        if ($request = $bd->query($sql)) {
            $_SESSION['login']= $login;
            header('refresh:0');
        }
    } 
    if (!empty($_POST['password1']) && !empty($_POST['password2'])){
        if ($_POST['password1'] == $_POST['password2']) {
        $mdp = $_POST['password1'];
        $sql = "UPDATE utilisateurs SET password = '$mdp' WHERE id = '$id'";
        $request = $bd->query($sql);
        } 
        else {
        $message = "Les deux mots de passe ne sont pas identiques !";
        }
    }
    else {
        $message = "Il faut remplir tous les champs de mot de passe !";
    }
}

if (isset($_POST['deconnexion'])){
    session_destroy();
    header('location:connexion.php');
}

?>
    <div class="profil">

        <form class='form1' method="POST"> <!-- formulaire -->
            <div class="field">
                <label>Login : </label>
                <input type="text" name="login" placeholder="<?php echo $login;?>">
            </div>
            <div class="field">
                <label>Mot de passe :</label>
                <input type="password" name="password1">
            </div>
            <div class="field">
                <label>Confirmez le mot de passe :</label>
                <input type="password" name="password2">
            </div>
            <div>
                <input class="fieldd" type="submit" name="enregistrer" value="Enregistrer">
            </div>
            <div class="message"><?= $message ?></div>
        </form>
        <form class="lienbutton" method="POST">
            <input class="button1" type="submit" name="deconnexion" value="Deconnexion">
        </form>
    </div>
    
</body>
</html>