<?php

class User extends Db_object{

    protected static $db_table = 'users';
    protected static $db_table_fields = ['user_name', 'user_password', 'user_firstname', 'user_lastname','user_image'];
    public $user_id;
    public $user_name;
    public $user_password;
    public $user_firstname;
    public $user_lastname;
    public $user_date;
    
    public $user_image;
    public $tmp_path;
    public $upload_directory = 'images';
    public $image_placeholder = 'https://placehold.it/400x400?text=user_image';
    public $errors = [];
    public $upload_errors_array = [
        UPLOAD_ERR_OK           => 'There is no error',
        UPLOAD_ERR_INI_SIZE		=> 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE    => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL      => 'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE      => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR   => 'Missing a temporary folder.',
        UPLOAD_ERR_CANT_WRITE   => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION    => 'A PHP extension stopped the file upload.'
    ];

    //1
    public static function verify_user( $user_name, $user_password ) {
        global $database;
        $user_name      = $database->escape_string( $user_name );
        $user_password  = $database->escape_string( $user_password );
        $sql = "SELECT * FROM ".self::$db_table." WHERE user_name = '$user_name' AND user_password = '$user_password' LIMIT 1";
        $result = self::find_by_query( $sql );
        return !empty( $result )?$result[0]:false;
    }

    //2
    public function image_path_and_placeholder(){
        return empty($this->user_image) ? $this->image_placeholder : rootDir.DS.$this->upload_directory.DS.$this->user_image;
    }

    //3
    // This is passing $_FILES['uploaded_file'] as an argument
    public function set_file( $file ) {
        if ( empty( $file ) || !$file || !is_array( $file ) ) {
            $this->errors[] = 'There was no file uploaded here';
            return false;
        } elseif ( $file['error'] != 0 ) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image       =  basename( $file['name'] );
            $this->tmp_path         = $file['tmp_name'];
            return true;
        }
    }

    //4
    public function upload_photo() {
        if ( !empty( $this->errors ) ) {
            return false;
        }
        if ( empty( $this->user_image ) || empty( $this->tmp_path ) ) {
            $this->errors[] = 'the file was not available';
            return false;
        }
        $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->user_image;
        if ( file_exists( $target_path ) ) {
            $this->errors[] = "The file {$this->user_image} already exists";
            return false;
        }
        if ( move_uploaded_file( $this->tmp_path, $target_path ) ) {
                unset( $this->tmp_path );
                return true;
        } else {
            $this->errors[] = 'the file directory probably does not have permission';
            return false;
        }
    }

    //5
    public function delete_photo() {
		if($this->delete()) {
            $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->user_image;
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
    }

    //6
    public function ajax_save_user_image( $user_image, $user_id ) {
        global $database;

        $user_image = $database->escape_string( $user_image );
        $user_id = $database->escape_string( $user_id );

        $this->user_image  = $user_image;
        $this->user_id     = $user_id;

        $sql  = 'UPDATE ' . self::$db_table . " SET user_image = '{$this->user_image}' ";
        $sql .= " WHERE user_id = {$this->user_id} ";
        $update_image = $database->query( $sql );

        echo $this->image_path_and_placeholder();

    }

    //6
    public function photos() {
        return Photo::find_by_query("SELECT * FROM photos WHERE user_id = {$this->user_id}");
    }
}

?>