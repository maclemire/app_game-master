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

/**
 * This function deletes a game
 */

function delete(): void
{
    $pdo = getPDO();
    $id = getId();
    $sql = "DELETE FROM jeux WHERE id=?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    //-Redirection
    $_SESSION["success"] = "Le jeu est bien supprimé.";
    header("location:index.php");
}

function add(): void
{
    $sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at, url_img) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW(), :url_img)";

    // 2- prepare la requette
    $query = $pdo->prepare($sql);

    // 3- on associe chaque requette à sa valeur et protection contre injection SQL
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':price', $price, PDO::PARAM_STMT);
    $query->bindValue(':note', $note, PDO::PARAM_STMT);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':genre', implode("|", $genre_clear), PDO::PARAM_STR);
    $query->bindValue(':plateforms', implode("|", $plateforms_clear), PDO::PARAM_STR);
    $query->bindValue(':PEGI', $PEGI, PDO::PARAM_STR);
    $query->bindValue(':url_img', $url_img, PDO::PARAM_STR);

    // 4- execution de la requette
    $query->execute();

    // 5- redirection
    $_SESSION["success"] = "le jeu a bien été ajouté";
    header("Location: index.php");
}