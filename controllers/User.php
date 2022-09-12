<?php

namespace Controllers;


require_once("models/User.php");
class User
{
    private $model;

    public function __construct()
    {
        $this->model = new \Models\User();
    }

    public function index()
    {
        $users =  $this->model->getAll("name");
        require("view/userPage.php");
    }

    public function show()
    {

        $user = $this->model->get();
        $title = $user['name'];
        require("view/showUserPage.php");
    }

    public function create()
    {
        $error = [];
        $errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

        if (!empty($_POST["submited"])) {
            require_once("utils/form-security/includeUser.php");
            if (count($error) == 0) { 
                $this->model->createU($name, $email, $password);
            }
        }


        require("view/userCreatePage.php");

    }

    public function update()
    {

        $user = $this->model->get();
        $title = $user['name'];

        $error = [];
        $errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

        if (!empty($_POST["submited"])) {
            require_once("utils/form-security/includeUser.php");
            if (count($error) == 0) {
                $this->model->updateU($name, $email, $password);
            }
        }

        require('view/userUpdatePage.php');
    }

    public function delete()
    {

        $this->model->delete();
    }
    
}