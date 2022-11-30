$(document).ready(function () {
    console.log("document loaded");
    $.ajax({
        type: "GET",
        url: 'http://localhost:8000/api/gallery',
        success: function (response) {
            var gal = '';
            response['galleries'].forEach(element => {
                gal +=
                    '<div class="col-sm-2"> <div> <a class="example-image-link" href="http://localhost:8000/storage/posts_image/' +
                    element['picture'] +
                    '" data-lightbox="example-2" data-title=""> <img class="example-image img-fluid mb-2" src="http://localhost:8000/storage/posts_image/' +
                    element['picture'] + '" alt="image-1" /> </a> </div> </div>';
            });
            $('#gallery-api').html(gal);
        }
    });
});

$(window).on("load", function () {
    console.log("window loaded");
});