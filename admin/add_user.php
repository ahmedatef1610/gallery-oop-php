<?php $pageTitle = 'Create User' ?>
<?php include( 'includes/header.php' ) ?>

<?php
    $user = new User();
    if ( isset( $_POST['create'] ) ) {
        if ( $user ) {
            $user->user_name = $_POST['username'];
            $user->user_password = $_POST['password'];
            $user->user_firstname = $_POST['first_name'];
            $user->user_lastname = $_POST['last_name'];

            $user->set_file( $_FILES['user_image'] );
            $user->upload_photo();
            $session->message( "The user {$user->user_name} has been added" );
            $user->save();
            
            redirect( 'users.php' );
        }
    }
?>

<!-- Navigation -->
<?php include( 'includes/navigation.php' ) ?>

<body>
    <div id="wrapper">
        <div id='page-wrapper'>
            <div class='container-fluid'>
                <!-- Page Heading -->
                <div class='row'>
                    <div class='col-lg-12'>
                        <h1 class='page-header'>
                            Add User
                            <small>Subheading</small>
                        </h1>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='col-md-6 col-md-offset-3'>

                                <div class='form-group'>
                                    <input type='file' name='user_image'>
                                </div>

                                <div class='form-group'>
                                    <label for='username'>Username</label>
                                    <input type='text' name='username' class='form-control'>
                                </div>

                                <div class='form-group'>
                                    <label for='password'>Password</label>
                                    <input type='password' name='password' class='form-control'>
                                </div>

                                <div class='form-group'>
                                    <label for='first name'>First Name</label>
                                    <input type='text' name='first_name' class='form-control'>
                                </div>

                                <div class='form-group'>
                                    <label for='last name'>Last Name</label>
                                    <input type='text' name='last_name' class='form-control'>
                                </div>

                                <div class='form-group'>
                                    <input type='submit' name='create' class='btn btn-block btn-primary'>
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