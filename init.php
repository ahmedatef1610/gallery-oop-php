<?php 
    defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
    require 'rootDir.php';
    define("SITE_ROOT",$_SERVER['DOCUMENT_ROOT'].rootDir);
    
    require "functions.php";
    require 'db/db_keys.php';

    require "db/database.php";
    $database = new Database();
    
    require_once "classes/loadClasses.php";
    $session = new Session();

?>