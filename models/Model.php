<?php

namespace Models;

require("database.php");

use PDO;

abstract class Model
{
    private $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPDO();
    }


    /**
     * This function returns all items in an array
     * @return array
     */
    function getAll($order = ""): array
    {
        // $pdo = getPDO();
        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $items = $query->fetchAll();

        return $items;
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
     * This function returns a single item
     * @return array
     */
    function get(): array
    {
        $pdo = getPDO();
        $id = $this->getId();
        $sql = "SELECT * FROM {$this->table} WHERE id=:id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $item = $query->fetch();
        // debug_array($item);
        // $item = [];

        if (!$item) {
            $_SESSION["error"] = "Ce {$this->table} n'est pas disponible.";
            header("location: index.php");
        }
        return $item;
    }

    function delete(): void
    {
        $pdo = getPDO();
        $id = $this->getId();
        $sql = "DELETE FROM {$this->table} WHERE id=?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        //-Redirection
        $_SESSION["success"] = "Le {$this->table} est bien supprimé.";
        header("Location: index.php");
    }

    function create($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img): void
    {

        $pdo = getPDO();
        $sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at, url_img) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW(), :url_img)";
        $query = $this->pdo->prepare($sql);
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
        $id = $this->getId();
        $sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, PEGI = :PEGI, url_img = :url_img, updated_at = NOW() WHERE id= :id";

        $query = $this->pdo->prepare($sql);

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

    function updateU($name, $email, $password): void
    {

        $pdo = getPDO();
        $id = $this->getId();
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, updated_at = NOW() WHERE id= :id";

        $query = $this->pdo->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);

        $query->execute();

        $_SESSION["success"] = "User has been updated";
        header("Location: user.php");
    }



    function createU($name, $email, $password): void
    {

        $pdo = getPDO();
        $sql = "INSERT INTO users(name, email, password, created_at) VALUES(:name, :email, :password, NOW())";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->execute();
        //-Redirection
        $_SESSION["success"] = "User added";
        header("Location: user.php");
    }



    function getName(string $name)
    {
        return $name;
    }
}
