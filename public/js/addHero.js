$(document).ready(function () {
    $(".browse-btn").click(function () {
        $(this).closest(".upload-container").find(".file-input").click();
    });

    $(".file-input").change(function (e) {
        var file = e.target.files[0];
        var uploadContainer = $(this).closest(".upload-container");
        if (file) {
            if (file.size > 1 * 1024 * 1024) {
                alert("File terlalu besar. Maksimal 1MB.");
                $(this).val("");
                return;
            }

            if (
                !file.type.match("image/jpeg") &&
                !file.type.match("image/jpg") &&
                !file.type.match("image/png")
            ) {
                alert("Format file harus .jpg atau .png");
                $(this).val("");
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                uploadContainer
                    .find(".file-info")
                    .html(
                        `
                    <img src="${e.target.result}" alt="Preview">
                    <div class="file-details">
                        <div>${file.name}</div>
                        <div>${(file.size / 1024).toFixed(2)} KB</div>
                    </div>
                    <button class="remove-btn">×</button>
                `
                    )
                    .show();
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).on("click", ".remove-btn", function () {
        var uploadContainer = $(this).closest(".upload-container");
        uploadContainer.find(".file-input").val("");
        uploadContainer.find(".file-info").hide().empty();
    });
});