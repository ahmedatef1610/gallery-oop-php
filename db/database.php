<?php

class Database {

    public $connection;
    public $db;

    public function __construct() {
      $this->db = $this->open_db_connection();
    }

    public function __destruct() {
        $this->connection->close();
    }

    //1
    public function open_db_connection() {
        $this->connection = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
        if ( $this->connection->connect_errno ) {
            die( 'Could not connect: ' . $this->connection->connect_error );
        } else {
            //echo 'Connected successfully';
        }
        return $this->connection;
    }

    //2
    public function query( $sql ) {
        $result = $this->db->query( $sql );
        $this->confirm_query( $result );
        return $result;
    }

    //3
    private function confirm_query( $result ) {
        if ( !$result ) {
            die( "<div><strong>Query Failed : </strong> <code> {$this->db->error} </code></div>" );
        }
    }

    //4
    public function escape_string($string) {
        return $this->db->real_escape_string($string);
      
    }

    //5
    public function the_insert_id() {
        return $this->db->insert_id;
    }
}

?>