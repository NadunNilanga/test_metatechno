import { confirmDialog, showAlert } from "./app.js";

$(document).ready(function () {
    loadCompanyCombo();
});

function loadCompanyCombo() {
    if ($("#combo_company").length > 0) {
        $.ajax({
            url: "api/view_company",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            data: null,
            success: function (response) {
                var combo_data = "";
                $.each(response, function (index, value) {
                    combo_data +=
                        '<option value="' +
                        value.id +
                        '">' +
                        value.name +
                        "</option>";
                });
                $("#combo_company").html(combo_data);
            },
            error: function () {
                showAlert("error", "Something Went wrong");
            },
        });
    }
}
