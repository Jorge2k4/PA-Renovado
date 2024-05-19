/*$(function () {

    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function ($form, event, errors) {
        },
        submitSuccess: function ($form, event) {
            event.preventDefault();
            var name = $("input#nombre").val();
            var email = $("input#correo").val();
            var subject = $("input#asunto").val();
            var message = $("textarea#msg").val();

            $this = $("#sendMessageButton");
            $this.prop("disabled", true);

            $.ajax({
                url: "contact.php",
                type: "post",
                data: {
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                },
                cache: false,
                success: function () {
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                    $('#success > .alert-success')
                            .append("<strong>Your message has been sent. </strong>");
                    $('#success > .alert-success')
                            .append('</div>');
                    $('#contactForm').trigger("reset");
                },
                error: function () {
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                    $('#success > .alert-danger').append($("<strong>").text("Sorry " + name + ", it seems that our mail server is not responding. Please try again later!"));
                    $('#success > .alert-danger').append('</div>');
                    $('#contactForm').trigger("reset");
                },
                complete: function () {
                    setTimeout(function () {
                        $this.prop("disabled", false);
                    }, 1000);
                }
            });
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

$('#name').focus(function () {
    $('#success').html('');
});*/


$(function () {

    // Use data attributes for unobtrusive JavaScript
    $("#contactForm").attr("data-success", "#success"); // Success message container ID
  
    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function ($form, event, errors) {
        // Handle validation errors (optional)
        // You can display error messages using the `errors` object
        console.error("Validation errors:", errors);
      },
      submitSuccess: function ($form, event) {
        event.preventDefault();
        var name = $("input#nombre").val();
        var email = $("input#correo").val();
        var subject = $("input#asunto").val();
        var message = $("textarea#msg").val();
  
        $this = $("#sendMessageButton");
        $this.prop("disabled", true); // Disable submit button
  
        $.ajax({
          url: "contact.php",
          type: "post",
          data: {
            name: name,
            email: email,
            subject: subject,
            message: message
          },
          cache: false,
          success: function () {
            // Handle successful submission
            $("#success").html("<div class='alert alert-success'>");
            $("#success > .alert-success").html(
              "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
            ).append("<strong>Su mensaje ha sido enviado. </strong>");
            $("#success > .alert-success").append("</div>");
            $("#contactForm").trigger("reset");
            $this.prop("disabled", false); // Enable submit button
            },
            error: function (jqXHR, textStatus, errorThrown) {
            // Handle AJAX errors
            console.error("AJAX Error:", jqXHR, textStatus, errorThrown);
            $("#success").html("<div class='alert alert-danger'>");
            $("#success > .alert-danger").html(
              "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"
            ).append("<strong>Error: </strong>" + errorThrown);
            $("#success > .alert-danger").append("</div>");
            $this.prop("disabled", false); // Enable submit button
          }
        });
      },
      filter: function () {
        return $(this).is(":visible");
      }
    });
  
    $("a[data-toggle=\"tab\"]").click(function (e) {
      e.preventDefault();
      $(this).tab("show");
    });
  });
  
  $('#name').focus(function () {
    $('#success').html('');
  });
  
