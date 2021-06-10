$(document).ready(function () {
    categorySlug();
    subCategorySlug();
    category();
    subCategory();
});

function categorySlug() {
    $(document).on("input", "#category", function () {
        let category = $("#category").val();
        let slug = category.replace(/\s+/g, "-");
        $("#slug").val(slug.toLowerCase());
    });
}
function subCategorySlug() {
    $(document).on("input", "#subCategory", function () {
        let category = $("#subCategory").val();
        let slug = category.replace(/\s+/g, "-");
        $("#subCatSlug").val(slug.toLowerCase());
    });
}

function category() {
    $(document).on("click", "#status", function () {
        let value = $(this).data("checkboxvalue");
        if (value === 1) {
            $(this).data("checkboxvalue", 0);
            $("#statusText").text("Inactive");
            $("#statusText").removeClass("text-success");
            $("#statusText").addClass("text-danger");
        } else {
            $(this).data("checkboxvalue", 1);
            $("#statusText").text("Active");
            $("#statusText").removeClass("text-danger");
            $("#statusText").addClass("text-success");
        }
    });
}
function subCategory() {
    $(document).on("click", "#SubCategoryStatus", function () {
        let value = $(this).data("subcatcheckboxvalue");
        if (value === 1) {
            $(this).data("subcatcheckboxvalue", 0);
            $("#SubCatstatusText").text("Inactive");
            $("#SubCatstatusText").removeClass("text-success");
            $("#SubCatstatusText").addClass("text-danger");
        } else {
            $(this).data("subcatcheckboxvalue", 1);
            $("#SubCatstatusText").text("Active");
            $("#SubCatstatusText").removeClass("text-danger");
            $("#SubCatstatusText").addClass("text-success");
        }
    });
}
