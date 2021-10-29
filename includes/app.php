<?php 

require "funciones.php";
require "config/bd.php";

require __DIR__ . "/../vendor/autoload.php";


use Model\ActiveRecord; 

$db = connect_bd(); 



ActiveRecord::setDB($db);
