<?php $pageTitle = 'Users' ?>

<?php include("includes/header.php") ?>

<!-- Navigation -->
<?php include("includes/navigation.php") ?>

<?php
    $users = User::find_all();
?>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Users
                            <small></small>
                        </h1>
                        <?php if($session->message()): ?>
                            <div class="bg-success alert alert-success"><?php echo $session->message() ?></div>
                        <?php endif ?>
                        <div class='col-md-12'>
                            <a href="add_user.php" class="btn btn-primary">Add User</a>
                        </div>
                        <br><br><br>
                        <div class='col-md-12'>
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $users as $user ): ?>
                                        <tr>
                                            <td><?php echo $user->user_id ?> </td>
                                            <td>
                                                <a href="<?php echo $user->image_path_and_placeholder() ?>" data-toggle="lightbox">
                                                    <img class='admin-user-thumbnail user_image' src="<?php echo $user->image_path_and_placeholder() ?>" alt=''>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $user->user_name ?>
                                                <div class='action_links'>
                                                    <a href="delete_user.php?user_id=<?php echo $user->user_id ?>" class="delete_link">Delete</a>
                                                    <a href="edit_user.php?user_id=<?php echo $user->user_id ?>">Edit</a>
                                                </div>
                                            </td>
                                            <td><?php echo $user->user_firstname ?></td>
                                            <td><?php echo $user->user_lastname ?></td>
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