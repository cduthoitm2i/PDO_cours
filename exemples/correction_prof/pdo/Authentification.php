<!DOCTYPE html>

<?php
// $_GET est une superglobale (=valable dans tous le site)
// isset pour savoir si une variable existe
if (isset($_GET['rememberme'])) {  
    // filter_input pour récupérer les saisies du formulaire
    $pseudo = filter_input(INPUT_GET, "pseudo");
    $mdp = filter_input(INPUT_GET, "mdp");
        if (($pseudo != null && $mdp != null)) {
            setCookie("pseudo", $pseudo);
            setCookie("mdp", $mdp);    
        } 
        // inutile car il y a un required dans la balise <input>
        else {
            echo "Saisies manquantes";
        }
    }
    

?>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>

</head>

<body>
    <header>

    </header>


    <section>

        <?php

        ?>

        <form method="get" action="">
            <fieldset>
                <legend>Authentification</legend>
                <p>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </p>
                <p>
                    <label for="motdepasse">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" required>
                </p>
                <p>
                    <input type="checkbox" name="MdpVisible" value="ON" />
                    <label>Mot de passe visible</label>
                </p>
                <p>
                    <input type="checkbox" id="rememberme" name="rememberme">
                    <label for="rememberme">Se souvenir de moi</label>
                </p>

                <p>
                    <input type="submit" value="Réinitialiser">
                    <input type="submit" value="Valider">
                </p>
            </fieldset>
            <div><a href="./motdepasseoublie.php" id="motdepasseoublie">Mot de passe oublié ?</a>
                <label>
                    <?php

                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </label>
                <?php
                ?>
    </section>

    <footer>

    </footer>

</body>

</html>