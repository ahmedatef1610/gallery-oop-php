<?php $pageTitle = 'Delete Comment' ?>
<?php include( 'includes/header.php' ) ?>

<!-- Navigation -->
<?php //include( 'includes/navigation.php' ) ?>

<body>
    <div id="wrapper">
        <div id='page-wrapper'>
            <div class='container-fluid'>
                <!-- Page Heading -->
                <div class='row'>
                    <div class='col-lg-12'>
                        <h1 class='page-header'>
                            Delete User
                            <small>Subheading</small>
                        </h1>
                        <?php
                            if(empty($_GET['comment_id'])){
                                redirect("{$_SERVER['HTTP_REFERER']}");
                            }
                            $comment = Comment::find_by_id($_GET['comment_id']);
                            if($comment){
                                if($comment->delete()){ 
                                    $session->message("the comment with id: {$comment->comment_id} has been deleted");
                                    redirect("{$_SERVER['HTTP_REFERER']}");
                                }
                                else{
                                    redirect("{$_SERVER['HTTP_REFERER']}");
                                }
                            }else{
                                redirect("{$_SERVER['HTTP_REFERER']}");
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include( 'includes/footer.php' ) ?>