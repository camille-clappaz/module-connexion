<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

</body>

</html>
<header>
    <img class="banniere" src="nuagesbanniere.jpg" alt="mer de nuages">
    <div class="onglets">
        <?php

        if (!empty($_SESSION['user'])) {
            echo "<a href='index.php'>Accueil</a>
        <a href='profil.php'>Profil</a>
        <a href='deconnexion.php'>Deconnexion</a>
        ";
            if ($_SESSION['user'][0]['login'] == "admin") {
                echo "<a href='admin.php'>Admin</a>";
            }
        } else {
            echo "<a href='index.php'>Accueil</a>
        <a href='inscription.php'>Inscription</a> ";
        }


        ?>

</header>