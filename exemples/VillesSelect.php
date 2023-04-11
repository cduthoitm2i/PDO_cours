<?php
    // --- VillesSelect.php
    // Caché sinon erreur ?? (présent dans le code du prof)
    // header("Content-Type: text/html; charset=UTF-8");
    // Gérer les exceptions
    try {
        // Connexion
        // Le mode utilisé est le mode FETCH_NUM (chaque enregistrement est vu comme un tableau ordinal).
        // écriture par défaut identique pour toutes les BDD (on adapte juste le nom et les inforamtions de connexion)
        // PDO est la clé d'accès à la bdd
        // dbname correspond au nom de la bdd déclaré dans Myphpadmin
        // Le port est facultatif
        $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cours;", "root", "");
        // Configure un attribut PDO 
        // PDO::ATTR_ERRMODE
        // Le mode pour reporter les erreurs de PDO. Peut prendre une des valeurs suivantes : 
        // PDO::ERRMODE_EXCEPTION
        // Lances des PDOExceptions. 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // PDO::exec — Exécute une requête SQL et affecte le codage UTF-8 à toutes les données (permet de communiquer en UTF-8)
        $pdo->exec("SET NAMES 'UTF8'");

        // Préparation et exécution du SELECT SQL (requêter)
        $select = "SELECT cp, nom_ville FROM villes";
        // utiliser la méthode query(sql) de l'objet PDO ie la connexion qui exécute un SELECT et remplit un curseur.
        $curseur = $pdo->query($select);
        $curseur->setFetchMode(PDO::FETCH_NUM);

        $contenu = "";

        // On boucle sur les lignes en récupérant le contenu des colonnes 1 et 2
        foreach($curseur as $enregistrement) {
            // Récupération des valeurs par concaténation et interpolation
            $contenu .= "$enregistrement[0]-$enregistrement[1]<br>";
        }
        // Fermeture du curseur (facultatif)
        // Utiliser la méthode closeCursor() de l'objet curseur qui le ferme. Permet à une autre requête d'être exécutée.
        $curseur->closeCursor();
    }
    // Gestion des erreurs
    catch(PDOException $e) {
        $contenu = "Echec de l'exécution : " . $e->getMessage();
    }

    // Déconnexion (facultative)
    // Se déconnecter (affecter null à la connexion).
    $pdo = null;

    // Affichage du contenu
    echo $contenu;

?>