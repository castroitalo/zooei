jQuery(function ($) {
    
    // Check if data is being sent correctly
    $(".btn-create-comment").on("click", function (e) {
        let commentText = $("#comment-text");

        // If comment text wasn't passed
        if (commentText.val() === "") {
            e.preventDefault();
            postText.addClass("input-invalid");
            postText.val("Um texto é obrigatório");
        }
    });
});
