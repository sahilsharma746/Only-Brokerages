$(document).ready(function () {
    //* admin left navigation active script start =======
    const leftNavOpen = () => {
        $("#btn-nav-toggle").addClass("nav-displayed");
        $("#left-nav").addClass("active");
    };
    const leftNavClose = () => {
        $("#btn-nav-toggle").removeClass("nav-displayed");
        $("#left-nav").removeClass("active");
    };
    $(document).on("click", "#btn-nav-toggle", function () {
        if ($(this).hasClass("nav-displayed")) {
            leftNavClose();
        } else {
            leftNavOpen();
        }
    });

    $(document).on("click", "#left-nav:not(ul > *)", function (e) {
        if (!$(e.target).is("ul")) leftNavClose();
    });

    //* admin left navigation active script end =======

    // -------------------TRADE RESULT POPUP-----------------------------------------

    document.querySelectorAll(".trade_reult_margin_btn").forEach((button) => {
        button.addEventListener("click", function () {
            // Toggle the 'selected' class on click
            this.classList.toggle("selected");

            // Get the values of the selected buttons
            const selectedValues = Array.from(
                document.querySelectorAll(".trade_reult_margin_btn.selected")
            ).map((btn) => btn.value);
            console.log("Selected margins:", selectedValues); // Log selected values to the console
        });
    });

    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = "block";
    }


    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = "none";
    }


    window.onclick = function (event) {
        const modals = document.querySelectorAll(".modal");
        modals.forEach((modal) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    };
});

// -------------------USER UPGRADE PROMPTS POPUP-----------------------------------------

jQuery(document).on("change", "#userPermissionUpgradePrompt", function () {
    const upgradePromptValue = $(this).val();
    if (upgradePromptValue == "1") {
        $("#accountPlanUpgradeModal").show();
    } else {
        $("#accountPlanUpgradeModal").hide();
    }
});

jQuery("#upgradePlanForm").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#upgradePlanForm').find(".upgradepromptKey").val();
    var plan_id = $("#new_plan").val();
    var prompt_setting = $("#userPermissionUpgradePrompt").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        plan_id: plan_id,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('accountPlanUpgradeModal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});

// ----------------------------------------------------- Identity Prompt -----------------------------------------------
$("#userPermissionIdentityPrompt").on("change", function () {
    if ($(this).val() == "1") {
        swal({
            title: "Are you sure?",
            text: "Do you want to enable the Identity Prompt for this user?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willEnable) => {
            if (willEnable) {
                const type = $(this).data("type");
                var selected_value = $(this).val();

                var data = {
                    _token: $('input[name="_token"]').val(),
                    prompt_key: type,
                    prompt_setting: selected_value,
                };

                console.log(data);
                jQuery.ajax({
                    url: upgradePromptUrl,
                    type: "POST",
                    cache: false,
                    data: data,
                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire({
                                title: "Prompt Added!",
                                text: "Prompt added for this user successfully.",
                                icon: "success",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Oops, Something Went Wrong!",
                            text: "Failed to add prompt for this user. Please try again.",
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    },
                });
            } else {
                $(this).val("0");
            }
        });
    }
});
// ---------------------------------------------------Account On Hold Prompt--------------------------------------------

$("#userPermissionAccountOnHoldPrompt").on("change", function () {
    if ($(this).val() == "1") {
        swal({
            title: "Are you sure?",
            text: "Do you want to enable the Account On Hold Prompt for this user?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willEnable) => {
            if (willEnable) {
                const type = $(this).data("type");
                var selected_value = $(this).val();

                var data = {
                    _token: $('input[name="_token"]').val(),
                    prompt_key: type,
                    prompt_setting: selected_value,
                };
                console.log(data);

                jQuery.ajax({
                    url: upgradePromptUrl,
                    type: "POST",
                    cache: false,
                    data: data,
                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire({
                                title: "Prompt Added!",
                                text: "Prompt added for this user successfully.",
                                icon: "success",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Oops, Something Went Wrong!",
                            text: "Failed to add prompt for this user. Please try again.",
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    },
                });
            } else {
                $(this).val("0");
            }
        });
    }
});
// ---------------------------------------------KYC verification-------------------------------------------

$("#userPermissionKYCVerificationPrompt").on("change", function () {
    if ($(this).val() == "1") {
        swal({
            title: "Are you sure?",
            text: "Do you want to enable the KYC Verification Prompt for this user?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willEnable) => {
            if (willEnable) {
                const type = $(this).data("type");
                var selected_value = $(this).val();
                var data = {
                    _token: $('input[name="_token"]').val(),
                    prompt_key: type,
                    prompt_setting: selected_value,
                };
console.log(data);
                jQuery.ajax({
                    url: upgradePromptUrl,
                    type: "POST",
                    cache: false,
                    data: data,
                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire({
                                title: "Prompt Added!",
                                text: "Prompt added for this user successfully.",
                                icon: "success",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            title: "Oops, Something Went Wrong!",
                            text: "Failed to add prompt for this user. Please try again.",
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    },
                });
            } else {
                $(this).val("0");
            }
        });
    }
});

// --------------------------------------------------Account Certificate Prompt Modal-----------------------------------------------------------
jQuery(document).on("change", "#userPermissionAccountCertificatePrompt", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#account_certificate_prompt-modal").show();
    } else {
        $("#account_certificate_prompt-modal").hide();
    }
});


jQuery("#account_certificate_form").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#account_certificate_form').find(".account_certificate_promptKey").val();
    var amount =$('#account_certificate_form').find("#amount").val();
    var prompt_setting = $("#userPermissionAccountCertificatePrompt").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('account_certificate_prompt-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });

});
//----------------------------------------------------Tax Reference Prompt Modal ---------------------------------------------------->
jQuery(document).on("change", "#userPermissionTaxReferencePrompt", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#tax_reference_prompt-modal").show();
    } else {
        $("tax_reference_prompt-modal").hide();
    }
});


jQuery("#tax_reference_form").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#tax_reference_form').find(".tax_reference_promptKey").val();
    var amount =$('#tax_reference_form').find("#amount").val();
    var prompt_setting = $("#userPermissionTaxReferencePrompt").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('tax_reference_prompt-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});
//----------------------------------------------------Axillary System Prompt Modal  ---------------------------------------------------->
jQuery(document).on("change", "#userPermissionAxillarySystemPrompt", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#axillary_system_prompt-modal").show();
    } else {
        $("#axillary_system_prompt-modal").hide();
    }
});

jQuery("#axillary_system_form").on("submit", function (e) {

    e.preventDefault();

    var prompt_key = $('#axillary_system_form').find(".axillary_system_promptKey").val();
    var amount =$('#axillary_system_form').find("#amount").val();
    var prompt_setting = $("#userPermissionAxillarySystemPrompt").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('axillary_system_prompt-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});

//----------------------------------------------------Trade Limit Prompt  Modal ---------------------------------------------------->
jQuery(document).on("change", "#userPermissionTradeLimitPrompt", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#trade_limit_prompt-modal").show();
    } else {
        $("#trade_limit_prompt-modal").hide();
    }
});


jQuery("#trade_limit_form").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#trade_limit_form').find(".trade_limit_promptKey").val();
    var amount =$('#trade_limit_form').find("#amount").val();
    var prompt_setting = $("#userPermissionTradeLimitPrompt").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('trade_limit_prompt-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});
//----------------------------------------------------Credit Facility Approval Modal ---------------------------------------------------->

jQuery(document).on("change", "#userPermissionCreditFacilityApproval", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#credit_facility_approval-modal").show();
    } else {
        $("#credit_facility_approval-modal").hide();
    }
});

jQuery("#credit_facility_form").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#credit_facility_form').find(".credit_facility_approvalKey").val();
    var amount =$('#credit_facility_form').find("#amount").val();
    var prompt_setting = $("#userPermissionCreditFacilityApproval").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('credit_facility_approval-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});
//----------------------------------------------------Loan Facility Approval  Modal ---------------------------------------------------->
jQuery(document).on("change", "#userPermissionLoanFacilityApproval", function () {

    const upgradePromptValue = $(this).val();
    console.log(upgradePromptValue);
    if (upgradePromptValue == "1") {
        $("#loan_facility_approval-modal").show();
    } else {
        $("#loan_facility_approval-modal").hide();
    }
});


jQuery("#loan_facility_form").on("submit", function (e) {
    e.preventDefault();

    var prompt_key = $('#loan_facility_form').find(".loan_facility_approvalKey").val();
    var amount =$('#loan_facility_form').find("#amount").val();
    var prompt_setting = $("#userPermissionLoanFacilityApproval").val();

    var data = {
        _token: $('input[name="_token"]').val(),
        prompt_key: prompt_key,
        amount: amount,
        prompt_setting: prompt_setting,
    };

    console.log(data);

    jQuery.ajax({
        url: upgradePromptUrl,
        type: "POST",
        cache: false,
        data: data,
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    title: "Prompt Added!",
                    text: "Prompt added for this user successfully.",
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
            closeModal('loan_facility_approval-modal');
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Oops, Something Went Wrong!",
                text: "Failed to add prompt for this user. Please try again.",
                icon: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        },
    });
});


// --------------------------------slecet no for all the prompt and permsiions-----------------------------------÷

$(".user-info-form select.no_prompt_prermisiion").change(function () {
    const selectedValue = $(this).val();
    const type = $(this).data("type");
    const csrfToken = $('input[name="_token"]').val();
    if (selectedValue != "1") {
        swal({
            title: "Are you sure?",
            text:
                "Do you want to disable the " +
                type.replace(/_/g, " ") +
                " for this user?",
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                // AJAX request
                $.ajax({
                    url: DeletePromptUrl,
                    method: "POST",
                    data: {
                        _token: csrfToken,
                        type: type,
                    },
                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire({
                                title: "Prompt Removed!",
                                text: "Successfully removed prompt for this user.",
                                icon: "success",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: "Oops, Something Went Wrong!",
                            text: "Failed to remove prompt for this user. Please try again.",
                            icon: "error",
                            timer: 3000,
                            showConfirmButton: true,
                            confirmButtonText: "Try Again",
                        });
                    },
                });
            }
        });
    }
});

