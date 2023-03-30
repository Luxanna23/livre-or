<?php
session_start();
    $bd = new mysqli('localhost', 'root', '', 'livreor');
    $sql = 'SELECT * FROM commentaire INNER JOIN utilisateurs WHERE commentaire.id_utilisateur = utilisateurs.id';
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
    
    <h1>Bienvenue sur la page des commentaires</h1>
    <table class="tab">
        <thead>
            <tr>
                <th  class="ptab1">Date</th>
                <th  class="ptab1">Utilisateur</th>
                <th  class="ptab1">Commentaire</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($result as $key => $value) { ?>
                    <td class='ptab2'><?php $str = explode("-",$value['date']); echo $str[2] . " / ". $str[1] . " / ". $str[0];
                    ?></td>
                    <td class='ptab2'><?php echo $value['login']; ?></td>
                    <td class='ptab2'><?php echo $value['commentaire']; ?></td>
            </tr><?php } 
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_POST['comment'])){
        if (isset($_SESSION['login'])) {
            header('location:commentaire.php');
        }
        else {
            header('location:connexion.php');    
        } 
        
    }
    ?>
    <div>
        <form class="commposter" method="POST">
            <input type="submit" name="comment" value="Ecrire un commentaire">
        </form>
    </div>
</body>

</html>
</body>
</html>