<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="gestion-tache";
//connexion à la base de données grace au PDO
try {
    $conn = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

}
catch (PDOException $e)
{
    echo "la connexion a échoué:" .$e->getMessage();
}



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if($_SERVER ["REQUEST_METHOD"] =='POST'){
if (isset($_POST['creer']))
{
    $nom = $_POST['utilisateur'];
    $email= $_POST['email'];
    $password= $_POST['motpass'];
     $confirm= $_POST['confirmation'];
    
    if ($password === $confirm) {
        $sql = "INSERT INTO user (nom,email,motpass) VALUES (:nom, :email,:motpass)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motpass', $password);
        if ($stmt->execute()) {
            echo "inscription reussie ";
            }else {
                echo "erreur inscription";
            }
    }else {
        echo "oupps les deux mot de passe ne sont pas identiques";
    }
}elseif (isset($_POST["connexion"])){
        
    $email= $_POST['email'];
    $motpass= $_POST['password'];
    var_dump($email);
    var_dump($motpass);
    die();


    $sql = "SELECT * FROM  user WHERE email= :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);

    $stmt->execute();
   
     $user=  $stmt->fetchAll(PDO::FETCH_ASSOC);
     var_dump($user);
     die();
   
     if ($user && $motpass=== $user['motpass']) {
        // $_SESSION['nom']=$user['nom']; 
        // $_SESSION['id']=$user['id']; 
       // echo $_SESSION['id'];
        
        header('location:gestion-taches.php');
    //    echo "connexion reusi";
           
     }else {
        echo'connexion perdue';
     }   
    
}        

}



      
       
      
        

// $stmt = $conn->prepare("INSERT INTO user (nom,email,motpass) VALUES (?,?,?)");
// $stmt->bindParam(1,$nom, PDO::PARAM_STR);
// $stmt->bindParam(2,$email, PDO::PARAM_STR);
// $stmt->bindParam(3,$password, PDO::PARAM_STR);






?>
