<?php $pageTitle = 'Edit User' ?>
<?php include( 'includes/header.php' ) ?>

<?php
    if ( empty( $_GET['user_id'] ) ) {
        redirect( 'users.php' );
    } else {
        $user = User::find_by_id( $_GET['user_id'] );
        if ( isset( $_POST['update'] ) ) {
            if ( $user ) {
                $user->user_name = $_POST['username'];
                $user->user_password = $_POST['password'];
                $user->user_firstname = $_POST['first_name'];
                $user->user_lastname = $_POST['last_name'];
                if(empty($_FILES['user_image'] )){
                    $user->save();
                }
                else {
                    $user->set_file( $_FILES['user_image'] );
                    $user->upload_photo();
                    $user->save();
                }

                $session->message("the user {$user->user_name} has been update");

                //redirect( "{$_SERVER['REQUEST_URI']}" );
                redirect( 'users.php' );
            }
        }
    }
?>

<input type="hidden" name="" id="user-id" value="<?php echo $user->user_id ?>" >

<!-- Navigation -->
<?php include( 'includes/navigation.php' ) ?>
<!-- Photo Modal -->
<?php include( 'photo_modal.php' ) ?>

<body>
    <div id="wrapper">
        <div id='page-wrapper'>
            <div class='container-fluid'>
                <!-- Page Heading -->
                <div class='row'>
                    <div class='col-lg-12'>
                        <h1 class='page-header'>
                            Edit User
                            <small></small>
                        </h1>
                        <div>
                            <form action='' method='post' enctype='multipart/form-data'>
                                <div class='col-md-6 '>
                                    <a class="thumbnail" href="#" data-toggle="modal" data-target="#photo-modal">
                                        <img src="<?php echo $user->image_path_and_placeholder() ?>" alt="">
                                    </a>
                                </div>
                                <div class='col-md-6 '>

                                    <div class='form-group'>
                                        <input type='file' name='user_image'>
                                    </div>

                                    <div class='form-group'>
                                        <label for='username'>Username</label>
                                        <input type='text' name='username' class='form-control'
                                            value="<?php echo $user->user_name ?>">
                                    </div>

                                    <div class='form-group'>
                                        <label for='password'>Password</label>
                                        <input type='password' name='password' class='form-control'
                                            value="<?php echo $user->user_password ?>">
                                    </div>

                                    <div class='form-group'>
                                        <label for='first name'>First Name</label>
                                        <input type='text' name='first_name' class='form-control'
                                            value="<?php echo $user->user_firstname ?>">
                                    </div>

                                    <div class='form-group'>
                                        <label for='last name'>Last Name</label>
                                        <input type='text' name='last_name' class='form-control'
                                            value="<?php echo $user->user_lastname ?>">
                                    </div>

                                    <div class='form-group'>
                                        <a class="btn btn-danger delete_link"
                                            href="delete_user.php?user_id=<?php echo $user->user_id ?>" >Delete</a>
                                        <input type='submit' name='update' value="Update"
                                            class='btn  btn-primary pull-right'>
                                    </div>
                                </div>
                            </form>
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