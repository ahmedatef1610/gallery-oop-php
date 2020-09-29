<?php $pageTitle = 'Login' ?>

<?php include( './includes/header.php' ) ?>

<?php
    if ( $session->is_signed_in() ) {
        redirect( 'admin' );
    }

    if ( isset( $_POST['submit'] ) ) {
        $username = trim( $_POST['user_name'] );
        $password = trim( $_POST['user_password'] );
        //method to check database user
        $user_found = User::verify_user( $username, $password );
        if ( $user_found ) {
            $session->login( $user_found );
            redirect( 'admin' );
        } else {
            $the_message = 'Your username or password are incorrect';
        }
    } else {
        $username = '';
        $password = '';
        $the_message = '';
    }
?>

<body>
    <!-- Navigation -->
    <?php include( './includes/navigation.php' ) ?>
    <!-- Page Content -->
    <div class='container'>
        <div class='row'>
            <!-- Blog Entries Column -->
            <div class="col-md-4 col-md-offset-4">
                <?php if($the_message): ?>
                    <div class="bg-danger alert alert-danger"><?php echo $the_message; ?></div>
                <?php endif ?>

                <form id="login-id" action="" method="post">
                    <div class="form-group">
                        <label for="user_name">Username</label>
                        <input type="text" class="form-control" name="user_name"
                            value="<?php echo htmlentities($username); ?>">
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" name="user_password"
                            value="<?php echo htmlentities($password); ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>

            </div>
            <!-- /.row -->
            <?php include( 'includes/footer.php' ) ?>