<?php $pageTitle = 'Delete Photo' ?>
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
                            Delete Photo
                            <small>Subheading</small>
                        </h1>
                        <?php
                            if(empty($_GET['photo_id'])){
                                redirect("photos.php");
                            }
                            $photo = Photo::find_by_id($_GET['photo_id']);
                            if($photo){
                                if($photo->delete_photo()){ 
                                    $session->message("the {$photo->photo_filename} photo has been deleted");
                                    redirect("photos.php");
                                }
                                else{
                                    redirect("photos.php");
                                }
                            }else{
                                redirect("photos.php");
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