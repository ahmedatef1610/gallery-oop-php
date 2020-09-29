<?php

class Comment extends Db_object {

    protected static $db_table = 'comments';
    protected static $db_table_fields = ['comment_id', 'comment_photo_id', 'comment_author', 'comment_body'];
    public $comment_id ;
    public $comment_photo_id;
    public $comment_author;
    public $comment_body;
    public $comment_date;

    //1
    public static function create_comment( $comment_photo_id, $comment_author, $comment_body ) {
        if ( !empty( $comment_photo_id ) && !empty( $comment_author ) && !empty( $comment_body ) ) {
            $comment = new Comment();
            $comment->comment_photo_id = $comment_photo_id;
            $comment->comment_author = $comment_author;
            $comment->comment_body = $comment_body;
            return $comment;
        } else {
            return false;
        }
    }

    //2
    public static function find_the_comments( $comment_photo_id = "" ) {
        global $database;

        $sql = "SELECT * FROM ".self::$db_table." ";
        $sql .= "WHERE comment_photo_id = ".$database->escape_string($comment_photo_id). " ";
        $sql .= "ORDER BY comment_photo_id ASC ";

        return self::find_by_query($sql);
    }

    //3

}

?>