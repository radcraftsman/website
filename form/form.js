$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
        name: $("#name").val(),
        email: $("#email").val(),
        subject: $("#subject").val(),
        message: $("#message").val(),
        };
  
        $.post('contact.php', function(formData) {
            console.log(data);

            if (!data.success) {
                if (data.errors.name) {
                    $("#name-group").addClass("has-error");
                    $("#name-group").append(
                    '<div class="help-block">' + data.errors.name + "</div>"
                    );
                }
                if (data.errors.email) {
                    $("#email-group").addClass("has-error");
                    $("#email-group").append(
                    '<div class="help-block">' + data.errors.email + "</div>"
                    );
                }
                if (data.errors.subject) {
                    $("#subject-group").addClass("has-error");
                    $("#subject-group").append(
                    '<div class="help-block">' + data.errors.subject + "</div>"
                    );
                }
                if (data.errors.message) {
                    $("#message-group").addClass("has-error");
                    $("#message-group").append(
                        '<div class="help-block">' + data.errors.message + "</div>"
                    );
                    }

            } else {
                $("form").html(
                    '<div class="alert alert-success">' + data.message + "</div>"
                );
            }
        })
        .fail(function (data) {
            $("form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
        });

        event.preventDefault();
    });
});