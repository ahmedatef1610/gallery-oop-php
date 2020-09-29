ClassicEditor.create(document.querySelector("#description"))
  .then((editor) => {
    //console.log(editor);
  })
  .catch((error) => {
    //console.error(error);
  });

$(document).on("click", '[data-toggle="lightbox"]', function (event) {
  event.preventDefault();
  $(this).ekkoLightbox({
    alwaysShowClose: true,
  });
});

$(document).ready(function () {
    let user_id;
    let image_name;
    let photo_id;

    //1
    $(".modal_thumbnails").click(function () {
        
        $("#set_user_image").prop("disabled", false);

        $(this).addClass("selected");

        user_id = $("#user-id").val();
        image_name = $(this).data("name");
        photo_id = $(this).data("id");

        $.ajax({
            url: "includes/ajax_code.php",
            data: { photo_id },
            type: "POST",
            success: function (data) {
                //console.log(data);
                if (!data.error) {
                    $("#modal_sidebar").html(data);
                }
            },
            error: function (data) {
                console.log("error: ",data);
            },
        });

    });

    //2
    $("#set_user_image").click(function () {
        $.ajax({
            url: "includes/ajax_code.php",
            data: { image_name, user_id  },
            type: "POST",
            success: function (data) {
                //console.log(data);
                if (!data.error) {
                    $(".user_image_box a img").prop("src", data);
                    location.reload({forcedReload: true});
                }
            },
            error: function (data) {
                console.log("error: ",data);
            },
        });
    });

    /*************Edit Photo side bar************/
    //3
    $(".info-box-header").click(function () {
        $(".inside").slideToggle("fast");
        $("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon ");
    });
    /***********Delete Function***********/
    //4
    $(".delete_link").click(function () {
        return confirm("Are you sure you want to delete this item");
    });
});
