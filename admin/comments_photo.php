<?php $pageTitle = 'Comments' ?>

<?php include("includes/header.php") ?>

<!-- Navigation -->
<?php include("includes/navigation.php") ?>

<script>
    document.title = "Photo Comments - Gallery Admin";
</script>

<?php
    if ( empty( $_GET['photo_id'] ) ) {
        redirect( 'photos.php' );
    } else {
        $comments = Comment::find_the_comments( $_GET['photo_id'] );
    }
?>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photo Comments
                            <small></small>
                        </h1>
                        <?php if($session->message()): ?>
                            <div class="bg-success alert alert-success"><?php echo $session->message() ?></div>
                        <?php endif ?>
                        <div class='col-md-12'>
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $comments as $comment ): ?>
                                    <tr>
                                        <td><?php echo $comment->comment_id ?> </td>
                                        <td><?php echo $comment->comment_photo_id ?> </td>
                                        <td>
                                            <?php echo $comment->comment_author ?>
                                            <div class='action_links'>
                                                <a href="delete_comment.php?comment_id=<?php echo $comment->comment_id ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->comment_body ?></td>
                                        <?php
                                            $comment_timestamp = strtotime( $comment->comment_date );
                                            $comment_time = date( 'Y-m-d h:i:s A', $comment_timestamp );
                                        ?>
                                        <td><?php echo $comment_time ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include("includes/footer.php") ?>