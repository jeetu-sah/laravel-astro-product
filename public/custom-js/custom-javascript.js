$(document).on("submit", "form", function (e) {
    e.preventDefault();

    const $form = $(this);
    const formData = new FormData(this);
    const url = $form.attr("action");
    const method = $form.attr("method") || "POST";

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
                var toastEl = $(response.toast);
                toastEl.children(".toast-body").html(response.msg);
                $(response.toast).toast("show");

                if (response.type == "toggle") {
                    $(`#${response.hidetab}`).hide();
                    $(`#${response.showtab}`).show();
                }
            }
        },
        error: function (xhr) {
            alert("Something went wrong!");
            console.log(xhr.responseText);
        },
    });
});
