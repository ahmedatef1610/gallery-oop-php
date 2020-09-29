<?php $pageTitle = 'Home' ?>
<?php include("./includes/header.php") ?>

<?php

    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $per_page = 4;
    $total_count = Photo::count_all();
    
    $page = ($page > $total_count) ? ceil((int)$total_count/$per_page) : (int)$page ; 
    $page = ($page < 1) ? 1 : (int)$page ; 

    $paginate = new Paginate( $page , $per_page , $total_count );
    
    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$paginate->offset()} ";

    $photos = Photo::find_by_query($sql);


?>
<?php
    //$photos = Photo::find_all();
?>

<body>
    <!-- Navigation -->
    <?php include("./includes/navigation.php") ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row thumbnails">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <?php foreach ( $photos as $photo ): ?>
                    <div class='col-xs-12 col-sm-6 col-md-3'>
                        <a target="_blank" class='thumbnail' href="photo.php?photo_id=<?php echo $photo->photo_id; ?>">
                            <img class='home_page_photo img-responsive' src="<?php echo $photo->picture_path(); ?>" alt=''>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row">
                <ul class="pager">
                    <?php
                        if( $paginate->page_total() > 1){
                            if($paginate->has_next()){
                                echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next &rarr;</a></li>";
                            }
                            for ($i=1; $i <= $paginate->page_total(); $i++) { 
                                if($i == $paginate->page ){
                                    echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
                                }else{
                                    echo "<li><a href='index.php?page=$i'>$i</a></li>";
                                }
                            }
                            if($paginate->has_previous()){
                                echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>&larr; Previous</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">
                <?php //include("includes/sidebar.php"); ?>
            </div> -->
            <!-- /.row -->
            <?php include("includes/footer.php"); ?>