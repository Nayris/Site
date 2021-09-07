<form method="post">
    <input type="text" name="fname" id="fname" placeholder="Prénom"><br/>
    <input type="text" name="name" id="name" placeholder="Nom"><br/>
    <input type="email" name="email" id="email" placeholder="Email" required><br/>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required><br/>
    <input type="password" name="cpassword" id="cpassword" placeholder="Confime mot de pass" required>
    <input type="submit" name="sformsend" id="sformsend" value="Signup"><br/>
</form>

<?php 

    if(isset($_POST['sformsend'])){

        extract($_POST);

        if(!empty($email) && !empty($password) && !empty($cpassword)){

            if($password == $cpassword){
                $options = ['cost' => 12,];

                $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

                $c = $db->prepare("SELECT email FROM users WHERE email = :email");
                $c->execute(['email' => $email]);

                $result = $c->rowCount();

                if($result == 0){
                    $q = $db->prepare("INSERT INTO users(fname,name,email,password) VALUES(:fname,:name,:email,:password)");
                    $q->execute([
                        'fname' => $fname,
                        'name' => $name,
                        'email' => $email,
                        'password' => $hashpass
                    ]);
                    echo "Compte créé, vous pouvez maintenant vous connecter !";
                }else{
                    echo "Cette email est deja utilisé !";
                }
                
            }else{
                echo "Les mots de passe nes sont pas identique !";
            }

        }else{
            echo "Les champs ne sont pas tous remplis";
        }

    }

?>