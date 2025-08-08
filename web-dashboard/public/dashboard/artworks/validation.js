// Define form element
const form = document.getElementById("kt_modal_new_user");
var validator = FormValidation.formValidation(form, {
    fields: {
        title: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
            },
        },
        title_it: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
            },
        },
        description: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
            },
        },
        description_it: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
            },
        },
        image: {
            validators: {
                notEmpty: {
                    message: "This is required.",
                },
                file: {
                    extension: "jpeg,jpg,png,gif,webp",
                    type: "image/jpeg,image/png,image/gif,image/webp",
                    message: "The selected file is not a valid image.",
                },
            },
        },
        category: {
            validators: {
                notEmpty: {
                    message: "This  field is required.",
                },
            },
        },
        artist_name: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
            },
        },
        year_created: {
            validators: {
                notEmpty: {
                    message: "This field is required.",
                },
                regexp: {
                    regexp: /^\d{4}$/,
                    message: "Enter a valid 4-digit year.",
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
                    let url = "/artworks";

                    // Check if submitButton has 'update-user' class
                    if (submitButton.classList.contains("update-user")) {
                        const artworkId = $("#artworkId").val();
                        url = "/artworks/" + artworkId;
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
