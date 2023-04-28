<?php
try
{// Souvent on identifie cet objet par la variable $conn ou $db
    //loggin
    $db = new PDO(
        'mysql:host=127.0.0.1:3306;dbname=we_love_food;charset=utf8',
        'root',
        '', //Paramètre mot de passe: aucun mot de passe requis lors de la création
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION], //Teste la présence d'erreurs (si rien n'est affiché = 0 erreur)
    );    
}  catch (Exception $e) //S'il y a une erreur, PHP rentre dans le bloc catch et fait ce qu'on lui demande (ici, on arrête l'exécution de la page en affichant un message décrivant l'erreur).
{
        die('Erreur : ' . $e->getMessage());
}

$recipesStatement = $db->prepare('SELECT * FROM recipes');
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll(); //"Fetch" en anglais signifie « va chercher ».

try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=my_recipes;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
$sqlQuery = 'SELECT title, author FROM recipes';
$recipesStatement1 = $mysqlClient->prepare($sqlQuery);
$recipesStatement1->execute();
$recipes = $recipesStatement->fetchAll();

// On affiche chaque recette une à une
foreach ($recipes as $recipe) {

    echo "<p>".$recipe['author']."</p>";

}
?>