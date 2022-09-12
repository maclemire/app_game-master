<?php

namespace Models;

require("Model.php");

class User extends Model
{
    protected $table = "users";


    
    function getName(string $name)
    {
        return $name;
    }
}
