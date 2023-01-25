<?php
session_start();
$mysqli=new mysqli("localhost", "root", "", "moduleconnexion");
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}
$request=$mysqli->query("SELECT * FROM utilisateurs");
$result=$request->fetch_all(MYSQLI_ASSOC);
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
if(empty($_SESSION['user'])){
  if(isset($_POST['submit'])){
    if(empty($_POST["login"]) ){
        echo "<p class='erreur'>Il faut écrire votre login</p>";
    }
    elseif(empty($_POST["password"])){
        echo "<p class='erreur'>Il faut renseigner votre mot de passe</p>";
        
    }     

  
  foreach($result as $element){
      if($_POST["password"]==$element["password"] && $_POST["login"]==$element["login"]){
          $login=$_POST['login'];
          $request2=$mysqli->query("SELECT * FROM utilisateurs WHERE login LIKE'$login'");
          $results=$request2->fetch_all(MYSQLI_ASSOC);
          $_SESSION['user']=$results;
          header("Location: index.php");
      } 
    
  }
}}
var_dump($_SESSION['user']);

?>
<?php
if(empty($_SESSION['user'])):?>
    <div class="card">
    <form class="formulaire" action="" method="POST">
        <input placeholder="Login" type="text" name="login" >
        <input placeholder="Password" type="text" name="password" > 
        <button type="submit" name="submit">Se connecter</button>
    </form>
    </div>
    <?php endif ?>
</main>
<?php
if(!empty($_SESSION['user'])):
  $user=$_SESSION['user'][0]['login'];?>

  <p class='bonjour'>Bonjour <?=$user?></p>
  <p class='bonjour' >:)</p>
<?php endif ?>

  <footer></footer>
  
</body>
</html>