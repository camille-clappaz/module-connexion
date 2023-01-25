<?php
session_start();
$mysqli=new mysqli("localhost", "root", "", "moduleconnexion");
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}
$request=$mysqli->query("SELECT * FROM utilisateurs");
$result=$request->fetch_all(MYSQLI_ASSOC);
// var_dump($result);
//Pour empecher les non admin d'acceder à amni via l'url:
if($_SESSION['user'][0]['login']!='admin')
header("location:index.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include('header-include.php');
?>
   <main>
    <div class="tab_user">
<table >
    <thead >
        <tr >
            <?php foreach($result[0] as $key=> $value): ?>
                <th >
                    <?= $key ?>
                </th>
                <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php for($i=0; $i < sizeof($result); $i++):?>
       <tr >
       <td><?=$result[$i]["id"]?></td>
       <td><?=$result[$i]["login"]?></td>
       <td><?=$result[$i]["prenom"]?></td>
       <td><?=$result[$i]["nom"]?></td>
       <td><?=$result[$i]["password"]?></td>
       
       
      
       </tr>
       <?php endfor; ?>
    </tbody>
</table>   
</div>
</main>
<footer>
    <?php
    include('footer-include.php');
    
    ?>
</footer>
</body>
</html>