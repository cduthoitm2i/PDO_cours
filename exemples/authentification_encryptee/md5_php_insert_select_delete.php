<!DOCTYPE html>
<!--
md5_php_insert_select_delete
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <?php
        $message = "";
        $pseudo = filter_input(INPUT_GET, "pseudo");
        $pwd = md5("Pwd12345#"); // 6cdeb3ca449dcbe5e904fafa6c922df1
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
                $statement->bindValue(1, $pseudo);
                $statement->bindValue(2, $pwd);
                $statement->bindValue(3, "s@gmail.com");
                $statement->bindValue(4, "FO");
                $statement->bindValue(5, "s");
                $statement->execute();
                $message = "INSERT OK";
            }
            if ($btDelete != null) {
                // Le SQL
                $sql = "DELETE FROM utilisateurs WHERE pseudo = ?";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(1, $pseudo);
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
        <h1>MD5 - PHP</h1>
        <form action="" method="GET">
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
