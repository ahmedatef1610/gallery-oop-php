<?php $pageTitle = 'Photo' ?>
<?php include( './includes/header.php' ) ?>
<?php
    if ( !empty( $_GET['photo_id'] ) ) {
        $photo = Photo::find_by_id( $_GET['photo_id'] );
    } else {
        redirect( 'index.php' );
    }
?>
<?php
    $comments = Comment::find_the_comments($photo->photo_id);
?>
<?php
    if ( isset( $_POST['add_comment'] ) ) {
        $author = $database->escape_string( trim( $_POST['author'] ) );
        $body = $database->escape_string( trim( $_POST['body'] ) );
        $comment = Comment::create_comment( $photo->photo_id, $author, $body );
        if($comment && $comment->save()){
            $comment->save();
            redirect( "{$_SERVER['REQUEST_URI']}" );
        }else{
            $message = "There was some problems saving";
        }
    }
?>
<script>
    document.title = `<?php echo $photo->photo_title ?> - Photo - Gallery`;
</script>
<body>
    <!-- Navigation -->
    <?php include( './includes/navigation.php' ) ?>
    <!-- Page Content -->
    <div class='container'>
        <div class='row'>
            <!-- Blog Post Content Column -->
            <div class='col-lg-12'>
                <?php if(isset($message)): ?>
                    <div class="bg-danger alert alert-danger"><?php echo $message??""; ?></div>
                <?php endif ?>
                <!-- Blog Post -->
                <!-- Title -->
                <h1><?php echo $photo->photo_title ?></h1>
                <!-- Author -->
                <!-- <p class='lead'>by <a href='#'>Author</a></p> -->
                <hr>
                <!-- Date/Time -->
                <?php
                    $photo_timestamp = strtotime( $photo->photo_date );
                    $photo_time = date( 'Y-m-d h:i:s A', $photo_timestamp );
                ?>
                <p><span class='glyphicon glyphicon-time'></span> Posted on <?php echo $photo_time ?></p>
                <hr>
                <!-- Preview Image -->
                <a href="<?php echo $photo->picture_path(); ?>" data-toggle="lightbox">
                    <img class='img-responsive photo_page_photo' src='<?php echo $photo->picture_path() ?>' alt=''>
                </a>
                <hr>
                <!-- Post Content -->
                <p class='lead'><?php echo $photo->photo_description ?></p>
                <hr>
                <!-- Blog Comments -->
                <!-- Comments Form -->
                <div class='well'>
                    <h4>Leave a Comment:</h4>
                    <form action='' method='post'>
                        <div class='form-group'>
                            <label for='author'>Author</label>
                            <input type='text' class='form-control' name='author' id='author'>
                        </div>
                        <div class='form-group'>
                            <label for='body'>Body</label>
                            <textarea class='form-control' name='body' id='body' rows='3'></textarea>
                        </div>
                        <button type='submit' name='add_comment' class='btn btn-primary'>Add Comment</button>
                    </form>
                </div>
                <hr>
                <!-- Posted Comments -->
                <?php foreach ( $comments as $comment ): ?>
                    <!-- Comment -->
                    <div class='media'>
                        <a class='pull-left' href='#'>
                            <img class='media-object' src='http://placehold.it/64x64' alt=''>
                        </a>
                        <div class='media-body'>
                            <h4 class='media-heading'><?php echo $comment->comment_author ?>
                                <?php
                                    $comment_timestamp = strtotime( $comment->comment_date );
                                    $comment_time = date( 'Y-m-d h:i:s A', $comment_timestamp );
                                ?>
                                <small><?php echo $comment_time ?></small>
                            </h4>
                            <?php echo $comment->comment_body ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class='col-md-4'>
                <?php //include( 'includes/sidebar.php' ) ?>
            </div> -->
        </div>
        <!-- /.row -->
        <?php include( 'includes/footer.php' ) ?>