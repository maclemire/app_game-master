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
    header("Location: index.php");
}

function create($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img): void
{

    $pdo = getPDO();
    $sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at, url_img) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW(), :url_img)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':price', $price, PDO::PARAM_STMT);
    $query->bindValue(':note', $note, PDO::PARAM_STMT);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':genre', implode("|", $genre_clear), PDO::PARAM_STR);
    $query->bindValue(':plateforms', implode("|", $plateforms_clear), PDO::PARAM_STR);
    $query->bindValue(':PEGI', $PEGI, PDO::PARAM_STR);
    $query->bindValue(':url_img', $url_img, PDO::PARAM_STR);
    $query->execute();
    //-Redirection
    $_SESSION["success"] = "le jeu a bien été ajouté";
    header("Location: index.php");
}


function update($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img): void
{

    $pdo = getPDO();
    $id = getId();
    $sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, PEGI = :PEGI, url_img = :url_img, updated_at = NOW() WHERE id= :id";

    $query = $pdo->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':price', $price, PDO::PARAM_STMT);
    $query->bindValue(':note', $note, PDO::PARAM_STMT);
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':genre', implode("|", $genre_clear), PDO::PARAM_STR);
    $query->bindValue(':plateforms', implode("|", $plateforms_clear), PDO::PARAM_STR);
    $query->bindValue(':PEGI', $PEGI, PDO::PARAM_STR);
    $query->bindValue(':url_img', $url_img, PDO::PARAM_STR);

    $query->execute();

    $_SESSION["success"] = "le jeu a bien été modifié";
    header("Location: index.php");
}
