<?php //require 'rootDir.php' ?>
<?php
    $arrDir = explode( '/', $_SERVER['SCRIPT_FILENAME'] );
    define("rootDir","/{$arrDir[3]}");
?>