<?php

class Db_object {

    //1
    public static function instantiation( $the_record ) {
        
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ( $the_record as $key => $value ) {
            if ( $the_object->has_the_property( $key ) ) {
                $the_object->$key = $value;
            }
        }
        return $the_object;
    }

    //2
    private function has_the_property( $key ) {
        return property_exists( $this, $key );
    }

    //3
    public static function find_by_query( $sql ) {
        global $database;
        $the_object_array = [];
        $result = $database->query( $sql );
        while ( $row = $result->fetch_array() ) {
            $the_object_array[] = static::instantiation( $row );
        }
        return $the_object_array;
    }
    /**************************************************************************/
    //4
    public static function find_all() {
        return static::find_by_query( 'SELECT * FROM '.static::$db_table.' ' );
    }

    //5
    public static function find_by_id( $idNum = 1 ) {

        $id = static::getIdFieldName();

        $result = static::find_by_query( "SELECT * FROM ".static::$db_table." WHERE {$id} = $idNum LIMIT 1" );
        return !empty( $result )?$result[0]:false;
    }

    //7
    public function create() {
        global $database;

        $id = static::getIdFieldName();

        $properties = $this->clean_properties();
        
        $sql = 'INSERT INTO '.static::$db_table.' ('.implode( ',', array_keys( $properties ) ).') ';
        $sql .= "VALUES ( '".implode( "','", array_values( $properties ) )."' ) ";

        if ( $database->query( $sql ) ) {
            $this->$id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    //8
    public function update() {
        global $database;

        $id = static::getIdFieldName();

        $properties = $this->clean_properties();
        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = " {$key}='{$value}' ";
        }

        $sql = "UPDATE ".static::$db_table." SET ";
        $sql .= implode(" , ",$properties_pairs);
        $sql .= " WHERE {$id}={$database->escape_string($this->$id)}";

        $database->query( $sql ) ;
        return ( $database->connection->affected_rows == 1 )? true : false ;
    }

    //9
    public function delete() {
        global $database;
        $id = static::getIdFieldName();

        $sql = 'DELETE FROM '.static::$db_table.' ';
        $sql .= "WHERE {$id}={$database->escape_string($this->$id)} ";
        $sql .= 'LIMIT 1 ';

        $database->query( $sql ) ;
        return ( $database->connection->affected_rows == 1 )? true : false ;
    }

    //10
    public function save() {
        $id = static::getIdFieldName();
        return isset( $this->$id ) ? $this->update() : $this->create() ;
    }

    //11
    protected function properties() {
        //return get_object_vars( $this );
        $properties = [];
        foreach ( static::$db_table_fields as $db_field ) {
            if ( property_exists( $this, $db_field ) ) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    //12
    protected function clean_properties() {
        global $database;
        $clean_properties = [];
        foreach ( $this->properties() as $key => $value ) {
            $clean_properties[$key] = $database->escape_string($value);

        }
        return $clean_properties;
    }

    //13
    protected static function getIdFieldName() {
        $table = get_called_class();
        $id = strtolower($table).'_id';
        return $id;
    }

    //14
    public static function count_all() {
        global $database;
        $id = static::getIdFieldName();

        $sql = 'SELECT COUNT(*) as count FROM '.static::$db_table.' ';

        $result = $database->query( $sql ) ;
        $row = $result->fetch_array();

        return $row['count']??0 ;
    }

}

?>