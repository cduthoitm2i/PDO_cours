<?php
/**
 * Générateur token 
 *  On utilise la liste de l'alphabet (jusque la lettre f) et les chiffres de 0 à 9, ensuite, on place dans un string et la fonction rand utilise ces caractères
 * pour générer un code aléatoire
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringRandomInt
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringRandomInt()
{   $length = 11;
    // On délimite le nombre de caractère pour le random_int (on reste sur de l'hexadécimale donc jusque la lettre F)
    $stringSpace = '0123456789abcdef';
    // on déclare la variable $pieces comme contenant un string
    $pieces = [];
    // mb_strlen — Retourne la taille d'une chaîne avec un encodage sur 8 bit (pas obligatoire) et on supprime 
    $max = mb_strlen($stringSpace, '8bit') - 1;
    // On crée une boucle qui affiche jusque 11 caractères (variable $length)
    for ($i = 0; $i < $length; $i++) {
        // on affecte à $pieces la valeur calculée de random_int de 0 à $max (8 bits)
        $pieces[] = $stringSpace[random_int(0, $max)];
    }
    // On retourne la valeur string et on rassemble les éléments séparés
    return implode('', $pieces);
}
?>


<?php
/**
 * On utilise la liste de l'alphabet (jusque la lettre f) et les nombres de 0 à 9, ensuite, on place dans un string et la fonction rand utilise ces caractères
 * pour générer un code aléatoire
 * by using rand() function.
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringRand
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringRand()
{
    $length = 11;
    // On délimite le nombre de caractère pour le random (on reste sur de l'hexadécimale donc jusque la lettre F)
    $stringSpace = '0123456789abcdef';
    // strlen — Retourne la taille d'une chaîne (soit dans l'exemple = 16)
    $stringLength = strlen($stringSpace);
    // on initialise la variable $randomString
    $randomString = '';
    // On crée une boucle qui affiche jusque 11 caractères (variable $length)
    for ($i = 0; $i < $length; $i++) {
        // on affecte à $randomString la valeur calculée de rand de 0 à $stringLength (soit 11 caractères)
        $randomString = $randomString . $stringSpace[rand(0, $stringLength - 1)];
    }
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 * On utilise la liste de l'alphabet (jusque la lettre f) et les nombres de 0 à 9, ensuite, on place dans un string et la fonction rand utilise ces caractères
 * pour générer un code aléatoire
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringShuffle
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringShuffle()
{
    $length = 11;
    // On délimite le nombre de caractère pour le random (on reste sur de l'hexadécimale donc jusque la lettre F)
    $stringSpace = '0123456789abcdef';
    // strlen — Retourne la taille d'une chaîne (soit dans l'exemple = 16)
    $stringLength = strlen($stringSpace);
    // str_repeat — Répète une chaîne, ceil — Arrondit au nombre supérieur la division de 11/16, soit 1
    $string = str_repeat($stringSpace, ceil($length / $stringLength));
    // str_shuffle — Mélange les caractères d'une chaîne de caractères
    $shuffledString = str_shuffle($string);
    // substr — Retourne un segment de chaîne
    $randomString = substr($shuffledString, 1, $length);
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 * On utilise random_bytes et openssl_random_pseudo_bytes
 * pour générer un code aléatoire
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringBin2hex
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringBin2hex()
{
    $length = 11;
    // function_exists — Indique si une fonction est définie (random_bytes)
    if (function_exists('random_bytes')) {
        // random_bytes — Récupère des octets aléatoires cryptographiquement sécurisés
        $bytes = random_bytes($length / 2);
    } else {
        // openssl_random_pseudo_bytes — Génère une chaine pseudo-aléatoire d'octets
        $bytes = openssl_random_pseudo_bytes($length / 2);
    }
    // bin2hex — Convertit des données binaires en représentation hexadécimale
    $randomString = bin2hex($bytes);
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 * Using mt_rand() actually it is an alias of rand()
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringMtrand
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringMtrand()
{
    $length = 11;
    // array_merge — Fusionne plusieurs tableaux en un seul, range — Crée un tableau contenant un intervalle d'éléments
    // On délimite de 0 à 9 pour les chiffres et de a à f pour les lettres
    $keys = array_merge(range(0, 9), range('a', 'f'));
    // On initialise la variable $key à 0
    $key = "";
    // On crée une boucle qui affiche jusque 11 caractères (variable $length)
    for ($i = 0; $i < $length; $i++) {
        // mt_rand — Génère une valeur aléatoire via le générateur de nombre aléatoire Mersenne Twister
        // mt_rand() est une fonction de remplacement pour rand()
        // Elle utilise un générateur de nombres aléatoire de caractéristique connue, le " Mersenne Twister " qui est 4 fois plus rapide que la fonction standard libc. 
        // on commence le mt_rand à 0, si on augmente de nombre, par exemple, 9, le code n'aura pas de chiffres de 0 à 8
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    // On affecte $key à $randomString
    $randomString = $key;
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 *
 * Using sha1().
 * sha1 has a 40 character limit and always lowercase characters.
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringSha1
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringSha1()
{
    $length = 11;
    // Calcule le sha1 d'une chaîne de caractères et rand — Génère une valeur aléatoire
    // donc on crypte avec la méthode sha1 une valeur aléatoire
    $string = sha1(rand());
    // substr — Retourne un segment de chaîne
    $randomString = substr($string, 0, $length);
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 *
 * Using md5().
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringMd5
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringMd5()
{
    $length = 11;
    // Calcule le sha1 d'une chaîne de caractères et rand — Génère une valeur aléatoire
    // donc on crypte avec la méthode md5 une valeur aléatoire
    $string = md5(rand());
    // substr — Retourne un segment de chaîne
    $randomString = substr($string, 0, $length);
    // On retourne la valeur string $randomString
    return $randomString;
}
?>


<?php
/**
 *
 * Using uniqid().
 *
 * @param int $length
 * @return string
 */
// Début de la fonction getRandomStringUniqid
// On déclare le nombre de caractères (longueur de la chaine, soit 11 par exemple)
function getRandomStringUniqid()
{
    $length = 11;
    // uniqid — Génère un identifiant unique et rand — Génère une valeur aléatoire (mais numérique)
    // donc on génère une valeur unique sur un élément généré aléatoirement
    $string = uniqid(rand());
    // substr — Retourne un segment de chaîne
    $randomString = substr($string, 0, $length);
    // On retourne la valeur string $randomString    
    return $randomString;
}
?>
<?php 

echo "<table border='1'>";
echo "<tr><td>random_int(): </td><td>" . getRandomStringRandomInt() . "</td></tr>";
echo "<tr><td>rand(): </td><td>" . getRandomStringRand() . "</td></tr>";
echo "<tr><td>shuffle(): </td><td>" . getRandomStringShuffle() . "</td></tr>";
echo "<tr><td>bin2hex(): </td><td>" . getRandomStringBin2hex() . "</td></tr>";
echo "<tr><td>mt_rand(): </td><td>" . getRandomStringMtrand() . "</td></tr>";
echo "<tr><td>sha1(): </td><td>" . getRandomStringSha1() . "</td></tr>";
echo "<tr><td>md5(): </td><td>" . getRandomStringMd5() . "</td></tr>";
echo "<tr><td>uniqid(): </td><td>" . getRandomStringUniqid() . "</td></tr>";
echo "</table>";
?>

