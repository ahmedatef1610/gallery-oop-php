<?php $pageTitle = 'Edit Photo' ?>
<?php include( 'includes/header.php' ) ?>

<?php
    if ( empty( $_GET['photo_id'] ) ) {
        redirect( 'photos.php' );
    } else {
        $photo = Photo::find_by_id( $_GET['photo_id'] );
        if ( isset( $_POST['update'] ) ) {
            if ( $photo ) {
                $photo->photo_title = $_POST['title'];
                $photo->photo_caption = $_POST['caption'];
                $photo->photo_alternate_text = $_POST['alternate_text'];
                $photo->photo_description = $_POST['description'];
                $photo->save();
            }
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
                            Edit Photo <small>Subheading</small>
                        </h1>

                        <form action='' method='post'>
                            <div class='col-md-8'>
                                <div class='form-group'>
                                    <input type='text' name='title' class='form-control' value="<?php echo $photo->photo_title ?>">
                                </div>
                                <div class='form-group'>
                                    <a class='thumbnail' href="<?php echo $photo->picture_path(); ?>" data-toggle="lightbox">
                                        <img src="<?php echo $photo->picture_path() ?>" alt=''>
                                    </a>
                                </div>
                                <div class='form-group'>
                                    <label for='caption'>Caption</label>
                                    <input type='text' name='caption' class='form-control' value="<?php echo $photo->photo_caption ?>">
                                </div>

                                <div class='form-group'>
                                    <label for='caption'>Alternate Text</label>
                                    <input type='text' name='alternate_text' class='form-control' value="<?php echo $photo->photo_alternate_text ?>">
                                </div>
                                <div class='form-group'>
                                    <label for='caption'>Description</label>
                                    <textarea class='form-control' name='description' id='description' cols='30' rows='10'><?php echo $photo->photo_description ?></textarea>
                                </div>
                            </div>

                            <div class='col-md-4'>
                                <div class='photo-info-box'>
                                    <div class='info-box-header'>
                                        <h4>Save <span id='toggle' class='glyphicon glyphicon-menu-up pull-right'></span></h4>
                                    </div>
                                    <div class='inside'>
                                        <div class='box-inner'>
                                            <p class='text'>
                                                <span class='glyphicon glyphicon-calendar'></span> 
                                                <?php
                                                    $photo_timestamp = strtotime( $photo->photo_date );
                                                    $photo_time = date( 'Y-m-d h:i:s A', $photo_timestamp );
                                                ?>
                                                Created on: <?php echo $photo_time;?>
                                            </p>
                                            <p class='text '>
                                                Photo Id: <span class='data photo_id_box'><?php echo $photo->photo_id ?></span>
                                            </p>
                                            <p class='text'>
                                                Filename: <span class='data'><?php echo $photo->photo_filename ?></span>
                                            </p>
                                            <p class='text'>
                                                File Type: <span class='data'><?php echo $photo->photo_type ?></span>
                                            </p>
                                            <p class='text'>
                                                File Size: <span class='data'><?php echo $photo->photo_size ?> Bytes</span>
                                            </p>
                                        </div>
                                        <div class='info-box-footer clearfix'>
                                            <div class='info-box-delete pull-left'>
                                                <a href="delete_photo.php?photo_id=<?php echo $photo->photo_id ?>" class='btn btn-danger btn-lg delete_link' >Delete</a>
                                            </div>
                                            <div class='info-box-update pull-right '>
                                                <input type='submit' name='update' value='Update' class='btn btn-primary btn-lg '>
                                            </div>
                                        </div>
                                    </div>
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