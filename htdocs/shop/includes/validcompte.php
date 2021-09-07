<?php

$header="MIME-Version: 1.0\r\n";
$header.='From:"NayrisShop.com"<support@nayrisshop.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
    <body>
        <div align="center">
            Mail automatique,
            <br/> 
            veuillez confirmer votre adresse email !
        </div>
    </body>
</html>
';


if(isset($_POST['verifcompte'])){
    mail("yanis.rebia.95@gmail.com", "Validation de votre compte NayrisShop",$message,$header);
}

?>

<form method="POST">
    <input type="submit" name="verifcompte" id="verifcompte" value ="send">
</form>

