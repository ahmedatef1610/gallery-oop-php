
<?php
    $photos = Photo::find_all();
?>

<div class="modal fade" id="photo-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Gallery System Library</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="thumbnails row">
                            <!-- PHP LOOP HERE CODE HERE-->
                            <?php foreach($photos as $photo): ?>
                                <div class="col-sm-2 vcenter">
                                    <a id="" href="#" class="thumbnail">
                                        <img 
                                            class="modal_thumbnails img-responsive" 
                                            src="<?php echo $photo->picture_path() ?>" 
                                            data-id="<?php echo $photo->photo_id; ?>"
                                            data-name="<?php echo $photo->photo_filename ?>"
                                        >
                                    </a>
                                    <div class="photo-id hidden"></div>
                                </div>
                            <?php endforeach; ?>
                            <!-- PHP LOOP HERE CODE HERE-->
                        </div>
                    </div>
                    <!--col-md-9 -->
                    <div class="col-md-3">
                        <div id="modal_sidebar"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <!--Modal Body-->
            <div class="modal-footer">
                <div class="row">
                    <!--Closes Modal-->
                    <button 
                        id="set_user_image" 
                        type="button" 
                        name="select_image"
                        class="btn btn-primary" 
                        disabled="true" 
                        data-dismiss="modal">
                            Apply Selection
                    </button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->