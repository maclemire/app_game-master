<?php
require("helpers/functions.php");

/**
 * Get connexion with DB
 * 
 * @return PDO
 */

function getPDO(): PDO
{
    $serveur = "localhost";
    $dbname = "app_game";
    $login = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $login, $password, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            // pour ne pas avoir de doublons
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // pour afficher les erreurs
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ));
        // affiche message ok connexion
        // echo "connexion établie";
        return $pdo;
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}



/**
 * This function returns all games in an array
 * @return array
 */
function getAllGames(): Array
{
    $pdo= getPDO();
    $sql = "SELECT * FROM jeux ORDER BY name";
    $query = $pdo->prepare($sql);
    $query->execute();
    $games = $query->fetchAll();

    return $games;
}

function getId(): int
{
    //1-verifie id existant et que c'est un int
    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $id = clear_xss($_GET['id']);
    } else {
        $_SESSION["error"] = "URL invalide";
        header("location: index.php");
    }
    return $id;
}

/**
 * This function returns a single game
 * @return array
 */

function getGame(): array
{
    $pdo = getPDO();
    $id = getId();
    $sql = "SELECT * FROM jeux WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $game = $query->fetch();
    // debug_array($game);
    // $game = [];

    if (!$game) {
        $_SESSION["error"] = "Ce jeu n'est pas disponible.";
        header("location: index.php");
    }
    return $game;
}

/**
 * This function returns the current item's id
 * @return int
 */


function getName(string $name)
{
    return $name;
}