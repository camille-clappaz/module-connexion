<?php
// session_start();
$mysqli=new mysqli("localhost", "root", "", "moduleconnexion");
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
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

    <main>
<?php
if(isset($_POST['submit'])){ // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
//if(empty($_POST["login"]))  Si l'input est vide
    if(!empty($_POST["login"]) && !empty($_POST["prenom"]) && !empty($_POST["nom"]) && !empty($_POST["password"])){
        $login=$_POST['login'];
        $prenom=$_POST['prenom'];
        $nom=$_POST['nom'];
        $password=$_POST['password'];
            if($_POST['password']==$_POST['confirmpassword']){
            $request=$mysqli->query("INSERT INTO utilisateurs ( login, prenom, nom, password) VALUES ( '$login', '$prenom', '$nom', '$password')");
            header('Location:index.php');}
            else{
                echo "Les mots de passe sont différents!";
            }
    }
    else {
        echo "il manque des trucs bro!";
    }
}
?>

<div class="container">
    <form class="inscription" action="" method="POST">
        <input placeholder="Login" type="text" name="login">
        <input placeholder="Prenom" type="text" name="prenom">
        <input placeholder="Nom" type="text" name="nom">
        <input placeholder="Password" type="password" name="password">
        <input placeholder="Confirmation password" type="password" name="confirmpassword">
        <button type="submit" name="submit">S'inscrire</button>
    </form>
</div>

    </main>
    <footer></footer>
    
</body>
</html>