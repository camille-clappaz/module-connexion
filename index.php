<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "moduleconnexion");
if ($mysqli->connect_error) {
  echo "erreur de connexion a MySQL:" . $mysqli->connect_error;
  exit();
}
$request = $mysqli->query("SELECT * FROM utilisateurs");
$result = $request->fetch_all(MYSQLI_ASSOC);
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
  <?php
  include('header-include.php');
  ?>

  <main>
    <?php
    if (empty($_SESSION['user'])) {
      if (isset($_POST['submit'])) {
        if (empty($_POST["login"])) {
          echo "<p class='erreur'>Il faut écrire votre login</p>";
        } elseif (empty($_POST["password"])) {
          echo "<p class='erreur'>Il faut renseigner votre mot de passe</p>";
        }


        foreach ($result as $element) {
          if ($_POST["password"] == $element["password"] && $_POST["login"] == $element["login"]) {
            $login = $_POST['login'];
            $request2 = $mysqli->query("SELECT * FROM utilisateurs WHERE login LIKE'$login'");
            $results = $request2->fetch_all(MYSQLI_ASSOC);
            $_SESSION['user'] = $results;
            header("Location: index.php");
          }
        }
      }
    }

    ?>
    <?php
    if (empty($_SESSION['user'])) : ?>
    <?php 
    // foreach($result as $key=>$value){
    //   if($_POST['login']!=$value && $_POST['password']!=$value){
    //     // header('Location:inscription.php');
    //   }
      
    
      
      ?>
      <div class="login-box">
        <h2>Connexion</h2>
        <form method="POST">
          <div class="user-box">
            <input type="text" name="login" required="">
            <label>Login</label>
          </div>
          <div class="user-box">
            <input type="password" name="password" required="">
            <label>Password</label>
          </div>
          <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type="submit" name="submit" >Se connecter</button>
            
          </a>
        </form>
      </div>
    <?php endif ?>
    
 
  <div class="bonjour">
    <?php
    if (!empty($_SESSION['user'])) :
      $user = $_SESSION['user'][0]['login']; ?>
      <p>Bonjour <?= $user ?></p>
      <p>:)</p>
  </div>
<?php endif ?>
</main>
<footer>
  <?php
  include('footer-include.php');
  ?>
</footer>

</body>

</html>