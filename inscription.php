<?php
// session_start();
$mysqli = new mysqli("localhost", "root", "", "moduleconnexion");
if ($mysqli->connect_error) {
    echo "erreur de connexion a MySQL:" . $mysqli->connect_error;
    exit();
}
// $request=$mysqli->query("SELECT * FROM utilisateurs");
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
    <?php include('header-include.php');?>
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
                    $request = $mysqli->query("INSERT INTO utilisateurs ( login, prenom, nom, password) VALUES ( '$login', '$prenom', '$nom', '$password')");
                    header('Location:index.php');
                } else {
                    echo "<p class='erreur'>Les mots de passe sont différents!</p>";
                }
            } 
        }
        ?>

<div class="login-box">
  <h2>Inscription</h2>
  <form method="POST">
    <div class="user-box">
      <input type="text" name="login" required="">
      <label>Login</label>
    </div>
    <div class="user-box">
      <input type="text" name="prenom" required="">
      <label>Prenom</label>
    </div>
    <div class="user-box">
      <input  type="text" name="nom" required="">
      <label>Nom</label>
    </div>
    <div class="user-box">
      <input  type="password" name="password" required="">
      <label>Password</label>
    </div>
    <div class="user-box">
      <input  type="password" name="confirmpassword" required="">
      <label>Confirmation Password</label>
    </div>
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <button type="submit" name="submit" >S'inscrire</button>
    </a>
  </form>
</div>

    </main>
    <footer>
    <?php include('footer-include.php');?>
    </footer>

</body>

</html>