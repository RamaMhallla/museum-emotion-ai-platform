// Define form element
const form = document.getElementById("kt_modal_new_user");
var validator = FormValidation.formValidation(form, {
    fields: {
        user_name: {
            validators: {
                notEmpty: {
                    message: "The name field is required.",
                },
            },
        },
        email: {
            validators: {
                notEmpty: {
                    message: "The email field is required.",
                },
                emailAddress: {
                    message: "The email address is not valid.",
                },
            },
        },
        password: {
            validators: {
                notEmpty: {
                    message: "The password field is required.",
                },
            },
        },
    },

    plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap5({
            rowSelector: ".fv-row",
            eleInvalidClass: "",
            eleValidClass: "",
        }),
    },
});

// Submit button handler
const submitButton = document.getElementById("submitAddUser");
submitButton.addEventListener("click", function (e) {
    e.preventDefault();

    if (validator) {
        validator.validate().then(function (status) {
            console.log("validated!");

            if (status == "Valid") {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;

                setTimeout(function () {
                    var formData = new FormData(
                        $("#kt_modal_new_address_form")[0]
                    );
                    let url = "/users";

                    // Check if submitButton has 'update-user' class
                    if (submitButton.classList.contains("update-user")) {
                        const userId = $("#userId").val();
                        url = "/users/" + userId;
                        type = "POST";
                        formData.append("_method", "PUT");
                    }

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $("#kt_modal_new_user").modal("hide");
                            if (data.success) {
                                form.style.display = "none";
                                showSuccesFunction();
                                $(".swal2-confirm").on("click", function () {
                                    location.reload();
                                });
                            }
                            if (data.errors) {
                                displayErrors(data.errors);
                            }
                        },
                        error: function (data) {
                            displayErrors(data.responseJSON.errors);
                            //$('#errorContainer').text(data.errors).show();
                            setTimeout(function () {
                                $("#errorContainer").fadeOut(
                                    "slow",
                                    function () {
                                        $("#errorContainer").empty();
                                    }
                                );
                            }, 5000);
                        },
                    });
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                    //form.submit(); // Submit form
                }, 2000);
            }
        });
    }
});



