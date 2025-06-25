$(document).on("submit", "form[data-request='ajaxSubmit']", function (e) {
    e.preventDefault();

    const $form = $(this);
    const formData = new FormData(this);
    const url = $form.attr("action");
    const method = $form.attr("method") || "POST";

    const $submitButton = $form.children("button[type='submit']");
    const submitButtonText = $submitButton.text();

    $submitButton.text("Loading...").prop("disabled", true);

    $.ajax({
        url: url,
        method: method,
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.status == "success") {
                if (response.type == "toggle") {
                    $(`#${response.hidetab}`).hide();
                    $(`#${response.showtab}`).show();
                }
            }
            showPositionToast(response.status, response.msg);

            $submitButton.text(submitButtonText).prop("disabled", false);
        },
        error: function (xhr) {
            showPositionToast(
                "danger",
                "Something went wrong, please try again."
            );
            console.log(xhr.responseText);

            $submitButton.text(submitButtonText).prop("disabled", false);
        },
    });
});
