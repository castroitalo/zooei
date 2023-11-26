jQuery(function ($) {

    // Acknowledge disclaimer
    $(".disclaimer-accept-button").on("click", function (e) {
        window.location.replace("http://localhost:8080/?accept=true");
    });
});
