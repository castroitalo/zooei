jQuery(function ($) {

    // Check if data is being sent correctly
    $(".btn-create-post").on("click", function (e) {
        let postText = $("#post-text");

        // If post text wasn't passed
        if (postText.val() === "") {
            e.preventDefault();
            postText.addClass("input-invalid");
            postText.val("Um texto é obrigatório");
        }
    });
});
