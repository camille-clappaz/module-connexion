<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "moduleconnexion");
if ($mysqli->connect_error) {
    echo "erreur de connexion a MySQL:" . $mysqli->connect_error;
    exit();
}
// $request=$mysqli->query("SELECT * FROM utilisateurs WHERE login LIKE'$login'");
// $result=$request->fetch_all(MYSQLI_ASSOC);
// var_dump($result);
?>
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

    <main>
        <?php
        if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            if (!empty($_POST["login"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["password"])) {
                $login = $_POST['login'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $password = $_POST['password'];
                if ($_POST['password'] == $_POST['confirmpassword']) {
                    $request = $mysqli->query("UPDATE `utilisateurs`  SET login='$login', prenom='$prenom', nom='$nom', password='$password' WHERE login LIKE'$login'");
                    header('Location:index.php');
                } else {
                    echo "Les mots de passe sont différents!";
                }
            } else {
                echo "il manque des trucs bro!";
            }
        }

        ?>

        <div class="container">
            <form class="modification" action="" method="POST">
                <input type="text" name="login" value="<?php
                                                        $login = $_SESSION['user'][0]['login'];
                                                        echo "$login"; ?>">

                <input type="text" name="prenom" value="<?php
                                                        $prenom = $_SESSION['user'][0]['prenom'];
                                                        echo "$prenom"; ?>">

                <input type="text" name="nom" value="<?php
                                                        $nom = $_SESSION['user'][0]['nom'];
                                                        echo "$nom"; ?>">

                <input type="password" name="password" value="<?php
                                                                $password = $_SESSION['user'][0]['password'];
                                                                echo "$password"; ?>">

                <input type="password" name="confirmpassword" value="<?php
                                                                        $password = $_SESSION['user'][0]['password'];
                                                                        echo "$password"; ?>">
                <button type="submit" name="submit">Modifier</button>
            </form>
        </div>
        <?php

        ?>


    </main>
    <footer></footer>

</body>

</html>