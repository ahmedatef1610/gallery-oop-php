<?php $pageTitle = 'Delete User' ?>
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
                            <small></small>
                        </h1>
                        <?php
                            if(empty($_GET['user_id'])){
                                redirect("users.php");
                            }
                            $user = User::find_by_id($_GET['user_id']);
                            if($user){
                                if($user->delete()){ 
                                    $session->message("the {$user->user_name} user has been deleted");
                                    redirect("users.php");
                                }
                                else{
                                    redirect("users.php");
                                }
                            }else{
                                redirect("users.php");
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