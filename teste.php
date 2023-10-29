<?php
if(!empty($_POST['utilisateur'])){
        $user = test_input($_POST['utilisateur']);
        if(!preg_match("/^[a-zA-Z- ]*$/", $user)){
            $nameErr = "Seuls les lettres et les espaces blancs sont autorisés";
            echo $nameErr;
            die();
            
        } else {
            $nom = $_POST['utilisateur'];
            
            
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
                echo $emailErr;
                // vérifier si l'adresse électronique est bien formée
              } elseif ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
                $emailerreur = "Invalid email format";
                
              } 
               
             else {
             $email= $_POST['email'];
             
             if(!empty($_POST['motpass']) && !empty($_POST['confirmation'])){
             if($_POST['motpass'] == $_POST['confirmation']){
            //validation du passe avant l'affectation
                            $password= $_POST['motpass'];
                            
                        }
                    }
                }
              }
        }





        
        if ($stmt->execute()) {
        echo "inscription reussie ";
        }else {
            echo "erreur connexion";
        }
    
    }elseif (isset($_POST['connexion'])){
        
        $email= $_POST['email'];
        $motpass= $_POST['password'];
        
    
        echo 'Email : '.$_POST['email'].'<br>';
        echo 'Mot de passe : '.$_POST['password'].'<br>';

        $sql = "SELECT * FROM  user WHERE email= :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
    
        $stmt->execute();
       
         $user=  $stmt->fetch();
       
         if ($user && $motpass=== $user['motpass']) {
            $_SESSION['nom']=$user['nom']; 
            $_SESSION['id']=$user['id']; 
           // echo $_SESSION['id'];
            
            header('location:gestion-taches.php');
           
               
         }else {
            echo'connexion perdue';
         }
    
    }