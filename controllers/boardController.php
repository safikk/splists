<?php
require_once('helper.php');

$bdd = dbConnect('splists', 'root', '', 3308);

// Response de la BDD non traitee
$res = $bdd->query('SELECT * FROM lists');

// J'instancie mon tableau qui contoiendra mes listes
$lists = [];

// Tant que j'ai des reponses qui vont dans $donnees (variable temporaire pour le while)
while($donnees = $res->fetch()) {

        // On prend chaque ligne de "$donnees" qu'on met dans L'array $lists
    $lists[] = $donnees;
}

