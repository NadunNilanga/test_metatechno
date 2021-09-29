import { confirmDialog, showAlert } from "./app.js";

var employee_required_feilds = ["txt_first_name", "txt_last_name"];
var employee_phone_number_feilds = ["txt_phone"];
var regex =
    /^(?:0|94|\+94|0094)?(?:(11|21|23|24|25|26|27|31|32|33|34|35|36|37|38|41|45|47|51|52|54|55|57|63|65|66|67|81|91)(0|2|3|4|5|7|9)|7(0|1|2|5|6|7|8)\d)\d{6}$/;

function validate(required_feilds, phone_number_feilds) {
    $(".validation_msg").text("");
    var validation = true;

    $.each(required_feilds, function (index, item) {
        if (
            $("#" + item)
                .val()
                .trim().length == 0 ||
            $("#" + item).val() == null
        ) {
            validation = false;
            $("#lbl_validation_" + item).text("This feild is required");
        }
    });

    $.each(phone_number_feilds, function (index, item) {
        if (!regex.test($("#" + item).val())) {
            $("#lbl_validation_" + item).text("Invalid phone number");
            validation = false;
        }
    });
    return validation;
}
//end validation

$(document).ready(function () {
    loadEmployeeTable();
});

$("#btn_employee_save").click(function () {
    let employee_data = {
        first_name: $("#txt_first_name").val(),
        last_name: $("#txt_last_name").val(),
        company_id: $("#combo_company").val(),
        email: $("#txt_email").val(),
        phone: $("#txt_phone").val(),
    };

    if (validate(employee_required_feilds, employee_phone_number_feilds)) {
        $.ajax({
            url: "api/save_employee",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            data: employee_data,
            success: function (response) {
                showAlert("success", "Data Saved Successfully");
                clearEmployeeForm();
                loadEmployeeTable();
            },
            error: function (response) {
                if (response.status === 422) {
                    showAlert("error", " The given data was invalid.");
                } else {
                    showAlert("error", " Something went wrong");
                }
            },
        });
    }
});

$("#btn_employee_update").click(function () {
    let employee_data = {
        first_name: $("#txt_first_name").val(),
        last_name: $("#txt_last_name").val(),
        company_id: $("#combo_company").val(),
        email: $("#txt_email").val(),
        phone: $("#txt_phone").val(),
    };
    confirmDialog(
        "Are you sure you want to update ?",
        "Update",
        "#f0ad4e",
        function () {
            $.ajax({
                url:
                    "api/update_employee/id/" + $("#btn_employee_update").val(),
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Accept: "application/json",
                },
                data: employee_data,
                success: function (response) {
                    showAlert("success", "Data updated successfully");
                    clearEmployeeForm();
                    loadEmployeeTable();
                },
                error: function () {
                    showAlert("error", "Communication error");
                },
            });
        }
    );
});

$("#btn_employee_delete").click(function () {
    confirmDialog(
        "Are you sure you want to delete ?",
        "Delete",
        "#d9534f",
        function () {
            $.ajax({
                url: "api/delete_staff/id/" + $("#btn_employee_delete").val(),
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Accept: "application/json",
                },
                data: null,
                success: function (response) {
                    showAlert("success", "Data Deleted Successfully");
                    clearEmployeeForm();
                    loadEmployeeTable();
                },
                error: function () {
                    showAlert("error", "Communication error");
                },
            });
        }
    );
});

function loadEmployeeTable() {
    if ($("#tbl_employee").length > 0) {
        $("#tbl_employee").DataTable().clear().destroy();
        $.ajax({
            url: "api/view_employee",
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            data: null,
            success: function (response) {
                let tbl_html = "";
                let row_num = 0;
                $.each(response, function (index, value) {
                    row_num++;
                    tbl_html += "<tr>";
                    tbl_html += "<td>" + value.first_name + "</td>";
                    tbl_html += "<td>" + value.last_name + "</td>";
                    tbl_html += "<td>" + value.email + "</td>";
                    tbl_html += "<td>" + value.phone + "</td>";
                    tbl_html += "<td>" + value.company_name + "</td>";
                    tbl_html +=
                        '<td class=" "><button type="button" class="ab btn btn-success btn-sm btn_select_employee" data-row="' +
                        encodeURIComponent(JSON.stringify(value)) +
                        '" >Select</button></td>';
                    tbl_html += "</tr>";
                });
                $(".tbl_employee").html(tbl_html);
                $("#tbl_employee").DataTable({ responsive: true });
            },
            error: function () {
                showAlert("error", "Something Went wrong");
            },
        });
    }
}

$(document).on("click", ".btn_select_employee", function () {
    let selected_employee = JSON.parse(decodeURIComponent($(this).data("row")));
    $("#txt_first_name").val(selected_employee.first_name);
    $("#txt_last_name").val(selected_employee.last_name);
    $("#txt_email").val(selected_employee.email);
    $("#txt_phone").val(selected_employee.phone);
    $("#combo_company").val(selected_employee.company_id);
    $("#combo_company").change();

    $("#btn_employee_update").removeClass("d-none");
    $("#btn_employee_delete").removeClass("d-none");
    $("#btn_employee_save").addClass("d-none");

    $("#btn_employee_update").val(selected_employee.id);
    $("#btn_employee_delete").val(selected_employee.id);
});

$("#btn_employee_clear_form").click(function () {
    clearEmployeeForm();
});

function clearEmployeeForm() {
    $("#txt_first_name").val("");
    $("#txt_last_name").val("");
    $("#txt_email").val("");
    $("#txt_phone").val("");

    $("#btn_employee_save").removeClass("d-none");
    $("#btn_employee_update").addClass("d-none");
    $("#btn_employee_delete").addClass("d-none");
}
