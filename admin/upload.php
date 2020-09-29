<?php $pageTitle = 'Upload' ?>
<?php include("includes/header.php") ?>
<!-- Navigation -->
<?php include("includes/navigation.php") ?>

<?php
    //1
    if (isset($_POST['submit'])) {
        $photo =  new Photo();
        $photo->photo_title = $_POST['title'];
        $photo->set_file($_FILES['file']);
        if($photo->save()){
            $message = "Photo uploaded successfully";
        }else{
            $message = join("<br>",$photo->errors);
        }
    }

    //2
    if (isset($_FILES['file']) && isset($_POST['title_dropzone'])) {
        $photo =  new Photo();
        $photo->photo_title = $_POST['title'];
        $photo->set_file($_FILES['file']);
        if($photo->save()){
            $message = "Photo uploaded successfully";
        }else{
            $message = join("<br>",$photo->errors);
        }
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
                            Upload
                            <small></small>
                        </h1>

                        <?php if(isset($message)): ?>
                            <div class="bg-danger alert alert-danger"><?php echo $message??""; ?></div>
                        <?php endif ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="title">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" class="form-control-file" />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" />
                        </form>


                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form action="upload.php" class="dropzone" name="dropzone">
                            <input type="text" name="title_dropzone" class="form-control"  placeholder="title">
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
    <?php include("includes/footer.php") ?>