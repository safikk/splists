<?php
require_once('helper.php');

$bdd = dbConnect('splists', 'root', '', 3308);

// Response de la BDD non traitee
$res = $bdd->query('SELECT * FROM lists');

       // Si je veux voir la derniere erreur en BDD : $bdd->errorinfo()

// J'instancie mon tableau qui contoiendra mes listes
$lists = [];

// Tant que j'ai des reponses qui vont dans $donnees (variable temporaire pour le while)
while($donnees = $res->fetch()) {

        // On prend chaque ligne de "$donnees" qu'on met dans L'array $lists
    $lists[] = $donnees;
}

$res->closeCursor();

// Cas où je reçcois une variable Post de _form_list.php : je crée une liste
if (!empty($_POST['list-title']) ) {
    // Création d'une nouvelle liste : 

    $res = $bdd->prepare("INSERT INTO lists(title) VALUES (:title)");

    $res->execute([
        "title" => $_POST['list-title']
    ]);
    // Change en tête de mesage en http
    Header('Location: /splists/views/board.php' . $bdd->lastInsertId());
}
   
// READ (1 élément) : Lecture d'une Liste.
function getList($idList) {
    $bdd = dbConnect('splists', 'root', '', 3308);

    $request ='SELECT * FROM lists WHERE id = ' . $idList;

    $response = $bdd->query($request);
    
    // Je m'attends à recevoir 1 seul élément, je ne fais pas de while (tant que...)
    // Car while (tant que...) me sert à dire : "tant qu'il y a des éléments qui vont dans $liste"
    $liste = $response->fetch();

    return $liste;
}


function getTasks($idTasks) {
    $bdd = dbConnect('splists', 'root', '', 3308);

    $request ='SELECT * FROM tasks WHERE id_list = ' . $idTasks;

    $response = $bdd->query($request);
    
    // J'initialise un tableau de tache vide
    $tasks = [];

    // Tant que j'ai des données reçues...
    while ($donnees = $response->fetch()) {

        // j'ajoute (en mettant des crochets au nom de l'array) dans le tableau $task
        // ce que j'ai reçu dans $donnees
        $tasks[] = $donnees;
    }

    return $tasks;
}