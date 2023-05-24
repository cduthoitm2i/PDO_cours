<!DOCTYPE html>
<!--
sha1_php_insert_select_delete
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        $message = "";
        // OK
        // Méthode 1
        //$pwd = sha1("Pwd12345#"); // ad847e6f5693c0f5f74438286aea608433feda40
        // Méthode 2 (attention de bien augmenter la taille du string dans la BD)
        // $pwd = hash("sha256", "Pwd12345#"); // a722d504f802a903c02b9cf94a8284c35e3ed6c471391a06d8802222d63303a5
        // Méthode 3 (attention de bien augmenter la taille du string dans la BD)
        //$pwd = hash("sha512", "Pwd12345#"); // a722d504f802a903c02b9cf94a8284c35e3ed6c471391a06d8802222d63303a5
          // IRREVERSIBLE donc KO
        // Méthode 3 (donc le SELECT ne fonctionne pas)
        $pwd = password_hash("Pwd12345#", PASSWORD_DEFAULT);
        try {
            /*
             * Connexion
             */
            $pdo = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET NAMES 'UTF8'");

            $btInsert = filter_input(INPUT_GET, "btInsert");
            $btSelect = filter_input(INPUT_GET, "btSelect");
            $btDelete = filter_input(INPUT_GET, "btDelete");

            if ($btInsert != null) {
                // Le SQL
                $sql = "INSERT INTO utilisateurs(pseudo, mdp, email, qualite, jeton) VALUES(?,?,?,?,?)";
                $statement = $pdo->prepare($sql);
                // Pseudo
                $statement->bindValue(1, "s");
                // le mot de passe
                $statement->bindValue(2, $pwd);
                // le mail
                $statement->bindValue(3, "s@gmail.com");
                $statement->bindValue(4, "FO");
                $statement->bindValue(5, "s");
                $statement->execute();
                $message = "INSERT OK";
            }
            if ($btDelete != null) {
                // Le SQL
                $sql = "DELETE FROM  utilisateurs WHERE pseudo = ?";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(1, "s");
                $statement->execute();
                $message = "DELETE OK";
            }
            if ($btSelect != null) {
                // Le SQL
                $sql = "SELECT * FROM utilisateurs WHERE mdp=?";
                $cursor = $pdo->prepare($sql);
                $cursor->bindValue(1, $pwd);
                $cursor->execute();
                $line = $cursor->fetch();
                if ($line === FALSE) {
                    $message = "INTROUVABLE";
                } else {
                    $message = $line[0] . " - " . $line[1];
                }
            }
        } catch (PDOException $exc) {
            $message = "Erreur : " . $exc->getMessage();
        }
        ?>
        <h1>SHA-1 - PHP</h1>
        <form>
            <p>
                <label>Pseudo ? </label>
                <input type="text" name="pseudo" value="s" placeholder="Pseudo ? "/>
            </p>
            <p>
                <input type="submit" value="Insert" name="btInsert" />
                <input type="submit" value="Select" name="btSelect" />
                <input type="submit" value="Delete" name="btDelete" />
            </p>
        </form>
        <p>
            <?php
            echo $message;
            ?>
        </p>
    </body>
</html>
