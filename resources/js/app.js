import * as sweetAlert2 from "sweetalert2";

window._ = require("lodash");
window.Popper = require("popper.js").default;
window.$ = window.jQuery = require("jquery");

require("./bootstrap");
require("./employees");
require("./companies");
require("datatables.net-bs4");

function showAlert(icon_type, message) {
    sweetAlert2.fire({
        text: message,
        icon: icon_type,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", sweetAlert2.stopTimer);
            toast.addEventListener("mouseleave", sweetAlert2.resumeTimer);
        },
    });
}

function confirmDialog(message, btnText, btnColor, action) {
    sweetAlert2
        .fire({
            text: message,
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: btnColor,
            cancelButtonColor: "##f7f7f7",
            confirmButtonText: btnText,
            cancelButtonText: "Cancel",
        })
        .then(function (success) {
            if (success.isConfirmed) {
                action();
            }
        });
}

require("select2");
$("select").select2();

export { sweetAlert2, showAlert, confirmDialog };
