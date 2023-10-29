<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
session_start();
$id=$_SESSION['id'];

?>

<link rel="stylesheet" href="style-gestion.css">

<header class="header2">
<h1>Gestion de mes Taches 
    <?php echo'<br>'. $_SESSION['nom'] ?>
    
   </h1>
   </header> 
<!-- <main>
    <div> 
        <section> 
            <h2>  Préparation d'un rapport de vente</h2>
            <p>Recueillir les données de vente, générer des graphiques et rédiger un rapport détaillé.</p> <br>
            <div class="paragraphe">
                <p>  Priorité : Haute</p>
            </div>
                <div class="paragraphe2">
                <p>Statut : En cours </p>
            </div>
        </section>

        <section>
            <h2>Réunion d'équipe au travail </h2>
            <p>Tenir une réunion d'équipe pour discuter des progrès et des projets.</p> <br>
            <div class="paragraphe">
                <p>  Priorité : Moyenne</p>
                <div class="paragraphe2">
                <p>Statut : En attente </p>
            </div>
                
            </div>
        </section>

        <section>
            <h2>Achats en ligne </h2>
            <p>Commander de l'épicerie, des fournitures de bureau, etc.</p> <br>
            <div class="paragrape">
                <p>  Priorité : Basse</p>
            </div>
                <div class="paragrape2">
                <p>Statut : Terminée </p>
            </div>
        </section>

    </div>



</main> -->
<!--  -->
<?php


//connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="gestion-tache";

try {
    $conn = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
   // echo "la connexion a été bien établie";
}

catch (PDOException $e)
{
    echo "la connexion a échoué:" .$e->getMessage();
}

if($_SERVER["REQUEST_METHOD"]=='POST'){
    if(isset($_POST['ajouter'])){
       
        
        $titre=$_POST['titre'];
        $priorite=$_POST['priorite'];
        $statut=$_POST['statut'];
        $descript=$_POST['descrip'];
        $date=$_POST['date'];




        echo $_POST['titre']. '<br>';
        echo $_POST['priorite']. '<br>';
        echo $_POST['statut']. '<br>';
        echo $_POST['descrip']. '<br>';
        echo $_POST['date']. '<br>';



        $sql = "INSERT INTO taches(titre,priorite,statut,description,id_user) VALUES (:titre, :priorite,:statut,:description,:id_user)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':priorite', $priorite);
        $stmt->bindValue(':statut', $statut);
        $stmt->bindValue(':descrip', $descript);
        $stmt->bindValue(':id_user', $id);
    
        echo "ajout tache effectué";
        if ($stmt->execute()) {
        }else {
            echo "echec ajout tache";
        }
    }

}

?>

<body>
    <div class="h1">
<h1>Ajouter une nouvelle tache</h1>
</div>
<form action="traitement.php" method="POST">
<label for="">Titre:</label> <br>
<input type="text" name="titre" required><br><br>
<label for="priorité" >Priorité:</label> <br>
<select name="priorite">
        <option value = "haute">Haute</option>
        <option value="moyenne">Moyenne</option>
        <option value="basse">Basse</option>
  </select> <br><br>

  <label for="statut">Statut:</label> <br>
  <select name="statut">
        <option value= "en_cours">En cours</option>
        <option value="en_attente">En attente</option>
        <option value="terminee">Terminée</option>
  </select><br><br>
  <label for="description">Description:</label> <br>
  <textarea name="descrip" required></textarea><br><br>
  <label for="">Date de Fin:</label> <br>
  <input type="date" name="date" required> <br> <br>

  <button type= "submit" name="ajouter">Ajouter</button>
</form>
    
</body>
</html>















