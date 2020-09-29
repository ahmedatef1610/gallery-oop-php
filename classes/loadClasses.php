<?php

function loadClasses( $class ) {
    $rootDir = rootDir;
    $class = strtolower( $class );
    $the_path = "{$_SERVER['DOCUMENT_ROOT']}{$rootDir}/classes/{$class}.php";

    if ( file_exists( $the_path ) && is_file($the_path) && !class_exists($class) ) {
        require_once( $the_path );
    } else {
        die( "This file named {$class}.php was not found man...." );
    }

}

spl_autoload_register('loadClasses');
?>