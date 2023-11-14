jQuery(function ($) {
    
    // Check if data is being sent correctly
    $(".btn-create-post").on("click", function (e) {
        let postText = $(".post-text");
        let postImage = $(".post-image");

        // If post text wasn't passed
        if (postText.val() === "") {
            e.preventDefault();
            postText.addClass("input-invalid");
        }

        // If post image wasn't passed
        if (postImage.get(0).files.length === 0) {
            e.preventDefault();
            postText.addClass("input-invalid");
            postText.val("Invalid image.");
        }
    });
});
