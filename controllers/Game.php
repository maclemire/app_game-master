<?php

namespace Controllers;


require_once("models/Game.php");
class Game
{
    private $model;

    public function __construct()
    {
        $this->model = new \Models\Game();
    }

    public function index()
    {


        $games =  $this->model->getAll();
        require("view/homePage.php");
    }

    public function show()
    {

        $game = $this->model->get();
        $title = $game['name'];
        require("view/showPage.php");
    }

    public function create()
    {
        $error = [];
        $errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

        if (!empty($_POST["submited"])) {
            require_once("utils/form-security/include.php");
            if (count($error) == 0) {

                $this->model->create($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img);
            }
        }


        require("view/createPage.php");
    }

    public function update()
    {

        $game = $this->model->get();
        $title = $game['name'];

        $error = [];
        $errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

        if (!empty($_POST["submited"])) {
            require_once("utils/form-security/include.php");
            if (count($error) == 0) {
                $this->model->update($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img);
            }
        }

        require('view/updatePage.php');
    }

    public function delete()
    {

        $this->model->delete();
    }
    
}