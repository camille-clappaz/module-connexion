<?php
session_start();
$mysqli=new mysqli('localhost', 'camille-clappaz', 'HTqRlhcphi81y3#?', 'camille-clappaz_moduleconnexion');
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
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
<?php include('header-include.php');?>
    <main>
        <?php
        if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            if (!empty($_POST["login"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["password"])) {
                $id=$_SESSION['user'][0]['id'];
                $login = $_POST['login'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $password = $_POST['password'];
                if ($_POST['password'] == $_POST['confirmpassword']) {//Attention si on cherche par le login, on ne pourra pas le modifier
                    //donc il faut chercher par l'id.
                    $request = $mysqli->query("UPDATE `utilisateurs`  SET login='$login', prenom='$prenom', nom='$nom', password='$password' WHERE id LIKE'$id'");
                    header('Location:index.php');
                } else {
                    echo "Les mots de passe sont différents!";
                }
            } else {
                echo "il manque des trucs bro!";
            }
        }
        ?>

       
        <div class="login-box">
  <h2>Modifier le profil</h2>
  <form method="POST">
    <div class="user-box">
      <input  type="text" name="login" value="<?php
                                                        $login = $_SESSION['user'][0]['login'];
                                                        echo "$login"; ?>">
      <label>Login</label>
    </div>
    <div class="user-box">
      <input  type="text" name="prenom" value="<?php
                                                        $prenom = $_SESSION['user'][0]['prenom'];
                                                        echo "$prenom"; ?>">
      <label>Prenom</label>
    </div>
    <div class="user-box">
      <input  type="text" name="nom" value="<?php
                                                        $nom = $_SESSION['user'][0]['nom'];
                                                        echo "$nom"; ?>">
      <label>Nom</label>
    </div>
    <div class="user-box">
      <input  type="password" name="password" value="<?php
                                                                $password = $_SESSION['user'][0]['password'];
                                                                echo "$password"; ?>">
      <label>Password</label>
    </div>
    <div class="user-box">
      <input  type="password" name="confirmpassword" value="<?php
                                                                        $password = $_SESSION['user'][0]['password'];
                                                                        echo "$password"; ?>">
      <label>Confirmation Password</label>
    </div>
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <button type="submit" name="submit" >Modifier le profil</button>
    </a>
  </form>
</div>

    </main>
    <footer>
    <?php include('footer-include.php');?>
    </footer>

</body>

</html>