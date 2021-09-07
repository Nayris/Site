<body>
    <section>
        <?php
            if(isset($_COOKIE['fname']) && isset($_COOKIE['name']) && isset($_COOKIE['email'])){
                ?>
                <p>Bienvenue sur le jeu <?= $_COOKIE['fname'];?> </p>
                <form method="post">
                    <a href="index.php"><input type="submit" name="logout" id="logout" value ="Logout"></a><br/>
                </form>
                <form method="post">
                    <a href="index.php"><input type="submit" name="validation" id="validation" value ="Validation"></a><br/>
                </form>
                <form method="post">
                    <a href="index.php"><input type="submit" name="return" id="return" value ="Retour"></a><br/>
                </form>
                <button>Pierre</button>
                <button>Feuille</button>
                <button>Ciseaux</button>
                <div class="result">Click pour jouer</div>
                    </br>
                <div class="win"></div>
                <div class="egal"></div>
                <div class="def"></div>
                <div class="score"></div>
                <?php
                $score = 0;
                setcookie('Score', $score);
                ?>
                <script type="text/javascript">
                    var cookies = document.cookie.split(;).
                    map(function(el){ return el.split(=); }).
                    reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});
                    
                    const buttons = document.querySelectorAll("button");
                    var egal = 0;
                    var perd = 0;
                    var win = 0;
                    var score = cookies['Score'];
                    
                    for (let i = 0; i < buttons.length; i++){
                        buttons[i].addEventListener("click", function(){
                            const joueur = buttons[i].innerHTML;
                            const robot = buttons[Math.floor(Math.random() * buttons.length)].innerHTML;
                            let result = "";

                            // Logique
                            if(joueur === robot){
                                result = "Egalité";
                                egal ++;
                            }else if ((joueur === "Pierre" && robot === "Ciseaux") || (joueur === "Feuille" 
                            && robot === "Pierre") || (joueur === "Ciseaux" && robot === "Feuille")){
                                result = "Gagné";
                                win ++;
                                score = win-perd;
                            }else{
                                result = "Perdu"
                                perd ++;
                                score = win-perd;
                            }

                            document.querySelector(".result").innerHTML = `
                                Joueur : ${joueur}</br>
                                Robot : ${robot}</br>
                                ${result}
                            `;
                            document.querySelector(".win").innerHTML = `
                            Nombre de victoires : ${win}
                            `;
                            document.querySelector(".egal").innerHTML = `
                            Nombre d'égalités : ${egal}
                            `;
                            document.querySelector(".def").innerHTML = `
                            Nombre de défaites : ${perd}
                            `;
                            document.querySelector(".score").innerHTML = `
                            Score : ${score}
                            `;  

                        });
                        
                        
                    }
                </script>
                <?php
 
                echo $score;

                include 'database.php';
                global $db;
                
                
            
                if(isset($_POST['validation'])){
                    $q = $db->prepare("UPDATE users SET score = :score WHERE email = :email");
                    $q->execute([
                    'score' => $score,
                    'email' => $_COOKIE['email']
                    ]);
                }
                if(isset($_POST['return'])){
                    header('Location:/');
                }
                if(isset($_POST['logout'])){
                    setcookie('name', '', time(), '/', null, false, true);
                    setcookie('fname', '', time(), '/', null, false, true);
                    setcookie('email', '', time(), '/', null, false, true);
                    header('Location:/');
                }
            }else{
                header('Location:/');
            }
        
        ?>
    </section>
</body>

    

    



