<?php $pageTitle = 'Photos' ?>
<?php include("includes/header.php") ?>
<!-- Navigation -->
<?php include("includes/navigation.php") ?>


<?php
    $photos = Photo::find_all();
?>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                            <small></small>
                        </h1>
                        <?php if($session->message()): ?>
                            <div class="bg-success alert alert-success"><?php echo $session->message() ?></div>
                        <?php endif ?>
                        <div class='col-md-12'>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Id</th>
                                        <th>File Name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $photos as $photo ): ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $photo->picture_path(); ?>" data-toggle="lightbox">
                                                    <img class='admin-photo-thumbnail' src="<?php echo $photo->picture_path(); ?>" alt=''>
                                                </a>
                                                
                                                <div class="picture_link">
                                                    <a href="delete_photo.php?photo_id=<?php echo $photo->photo_id; ?>" class="delete_link">Delete</a>
                                                    <a href="edit_photo.php?photo_id=<?php echo $photo->photo_id; ?>">Edit</a>
                                                    <a target="_blank" href="../photo.php?photo_id=<?php echo $photo->photo_id; ?>">View</a>
                                                </div>
                                            </td>
                                            <td><?php echo $photo->photo_id;?></td>
                                            <td><?php echo $photo->photo_filename;?></td>
                                            <td><?php echo $photo->photo_title;?></td>
                                            <td><?php echo $photo->photo_size;?></td>
                                            <td>
                                            <a href="comments_photo.php?photo_id=<?php echo $photo->photo_id; ?>">
                                                <?php 
                                                    $comments = Comment::find_the_comments( $photo->photo_id );
                                                    echo count($comments);
                                                ?>
                                            </a>
                                            </td>
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