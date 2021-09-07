<form method="post">
    <input type="email" name="lemail" id="lemail" placeholder="Email" required><br/>
    <input type="password" name="lpassword" id="lpassword" placeholder="Mot de passe" required>
    <a href="#"><input type="submit" name="formlogin" id="formlogin" value ="Login"></a><br/>
</form>

<?php 
    
    if(isset($_POST['formlogin'])){

        extract($_POST);

        if(!empty($lemail) && !empty($lpassword)){
            
            $q = $db->prepare("SELECT * FROM users WHERE email = :email");
            $q->execute(['email' => $lemail]);
            $result = $q->fetch();

            if($result == true){
                $hashpassword = $result['password'];

                if(password_verify($lpassword, $hashpassword)){
                        setcookie('name', $result['name'], time() + 30*24*3600, '/', null, false, true);
                        setcookie('fname', $result['fname'], time() + 30*24*3600, '/', null, false, true);
                        setcookie('email', $result['email'], time() + 30*24*3600, '/', null, false, true);
                        header('Location:/shop');
                }else{
                    echo "Le mot de passe est incorrect";
                }
            }else{
                echo "Le compte portant l'email " . $lemail . " n'existe pas";
            }


        }else{
            echo "Les champs ne sont pas tous remplis";
        }

    }

?>