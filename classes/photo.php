<?php

class Photo extends Db_object {
    protected static $db_table = 'photos';
    protected static $db_table_fields = ['photo_id', 'photo_title','photo_caption', 'photo_description', 'photo_filename','photo_alternate_text', 'photo_type', 'photo_size',"user_id"];
    public $photo_id;
    public $photo_title;
    public $photo_caption;
    public $photo_description;
    public $photo_filename;
    public $photo_alternate_text;
    public $photo_type;
    public $photo_size;
    public $photo_date;

    public $tmp_path;
    public $upload_directory = 'images';
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
    // This is passing $_FILES['uploaded_file'] as an argument
    public function set_file( $file ) {
        if ( empty( $file ) || !$file || !is_array( $file ) ) {
            $this->errors[] = 'There was no file uploaded here';
            return false;

        } elseif ( $file['error'] != 0 ) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->photo_filename   =  basename( $file['name'] );
            $this->tmp_path         = $file['tmp_name'];
            $this->photo_type       = $file['type'];
            $this->photo_size       = $file['size'];
            return true;
        }
    }

    //2
    public function save() {
        if ( $this->photo_id ) {
            $this->update();
        } else {
            if ( !empty( $this->errors ) ) {
                return false;
            }
            if ( empty( $this->photo_filename ) || empty( $this->tmp_path ) ) {
                $this->errors[] = 'the file was not available';
                return false;
            }
            $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->photo_filename;
            if ( file_exists( $target_path ) ) {
                $this->errors[] = "The file {$this->photo_filename} already exists";
                return false;
            }
            if ( move_uploaded_file( $this->tmp_path, $target_path ) ) {
                if ( $this->create() ) {
                    unset( $this->tmp_path );
                    return true;
                }
            } else {
                $this->errors[] = 'the file directory probably does not have permission';
                return false;
            }
        }
    }

    //3
    public function picture_path() {
		return rootDir.DS.$this->upload_directory.DS.$this->photo_filename;
    }

    //4
    public function delete_photo() {
		if($this->delete()) {
            $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->photo_filename;
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
    }
    
    //5
	public static function display_sidebar_data($photo_id) {

		$photo = Photo::find_by_id($photo_id);

		$output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}' ></a> ";
		$output .= "<p>{$photo->photo_filename}</p>";
		$output .= "<p>{$photo->photo_type}</p>";
		$output .= "<p>{$photo->photo_size}</p>";

		echo $output;
    }
}

?>