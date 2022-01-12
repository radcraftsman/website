$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        table: $("#table").val(),
        };
  
        $.ajax({
            type: "POST",
            url: "https://radcraftsman.ca/form/detail_contact.php",
            data: formData,
            dataType: "json",
            encode: true,
            success: function(data) { console.log("success") },
            error: function(ts) { console.log("failed") }
        }).done(function (data) {
            console.log(data);

            if (!data.success) {
                console.log(data);
                $("form").html(
                    '<div class="alert alert-danger">Form inputs were wrong, please try again.</div>'
                );
            } else {
                $("form").html(
                    '<div class="alert alert-success">' + data.message + "</div>"
                );
            }
        })
        .fail(function (data) {
            console.log(data);
            $("form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
        });

        event.preventDefault();
    });
});