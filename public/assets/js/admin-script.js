$(document).ready(function () {
    $.each($(".donate-chart"), function () {
        const options = {
            series: JSON.parse($(this).attr("series")) || [50, 25, 25],
            labels: JSON.parse($(this).attr("labels").replace(/'/g, '"')) || [
                (1, 2, 3),
            ],
            legend: {
                position: "bottom",
                floating: false,
                itemMargin: {
                    horizontal: 100,
                    vertical: 5,
                },
            },
            colors: ["#FF7675", "#6C5CE7", "#FFA62B", "#FFEAA7"],
            title: {
                text: this.title,
                align: "left",
            },
            chart: {
                type: "donut",
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "50%",
                        labels: {
                            show: false,
                            total: {
                                show: true,
                                label: "Total",
                            },
                        },
                    },
                },
            },
            dataLabels: {
                enabled: false,
            },
            responsive: [
                {
                    breakpoint: 324,
                    options: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: "bottom",
                        },
                    },
                },
            ],
        };
        const chart = new ApexCharts(this, options);
        chart.render();
    });

    $(document).on(
        "change",
        ".attach-file-input-group .attach-icon input",
        function () {
            try {
                const placeholder = $(this).prev('[type="placeholder"]');
                const fileName = this.files[0].name;
                if (fileName) {
                    placeholder.text(fileName).attr("hasFile", "true");
                }
            } catch (error) {
                console.warn(error);
            }
        }
    );

    const searchInputFormControl = (searchInput) => {
        $(searchInput).attr("placeholder", "Search for user etc...");
        $(searchInput)
            .prev()
            .html('<i class="fa-solid fa-magnifying-glass"></i>');
        $(searchInput).prev().addClass("all-user-table-label");
        $(searchInput).prev().css({
            "margin-right": "-30px",
            opacity: 0.5,
        });
    };

    if (jQuery(".all-admin-table-no-data").length == 0) {
        // if (jQuery('.all-user-table-no-data').length === 0) {
        const tableAllUserTable = new DataTable("#all-admin-table", {
            initComplete: function () {
                // Access the search input field and set a placeholder
                const searchInput = document.querySelector(
                    '[type="search"][aria-controls="all-admin-table"]'
                );
                if (searchInput) searchInputFormControl(searchInput);
            },
        });
    }

    $(document).on("click", ".notification-card .btn-delete", function () {
        $(this)
            .closest(".notification-card")
            .fadeOut(300, () => {
                $(this).remove();
            });
    });

    $(document).on("click", ".open_add_education_type_modal", function () {
        jQuery("#add-market-for-user").fadeIn();
    });

    $(document).on("click", ".btn-modal-close", function () {
        jQuery("#add-market-for-user").fadeOut();
        $("body").removeClass("overflowY-hidden");
    });

    $(document).on("click", ".education_type_submit", function () {
        jQuery("#add-market-for-user form").submit();
    });

    $(document).on("click", ".add_education_topic", function () {
        jQuery(".add_education_topic_form").submit();
    });

    $(document).on("click", ".btn-delete-tr", function () {
        const tr = $(this).closest("tr");
        if (tr.length)
            tr.fadeOut(300, () => {
                $(this).remove();
            });
    });

    let imgSrc = "";
    $("#bot-software-img").on("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imgSrc = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    //* enabled disabled button for system settings start =====
    $(document).on("click", ".admin-system-settings-section .btn", function () {
        if ($(this).hasClass("btn-enabled")) {
            $(this).removeClass("btn-enabled");
            $(this).addClass("btn-disabled");
        } else {
            $(this).addClass("btn-enabled");
            $(this).removeClass("btn-disabled");
        }
    });
    //* enabled disabled button for system settings end =======

    //* user-trade-result-percentage script start ===
    $(document).on("keyup", ".user-trade-result-percentage", function () {
        const value = $(this).val();
        const selectorOptions = $(this)
            .closest(".modal-body")
            .find(".userTradeResult");

        if (value > 10) {
            selectorOptions.val("Win"); // Select "Win"
        } else if (value < 10) {
            selectorOptions.val("Loss"); // Select "Loss"
        } else if (value == 10) {
            selectorOptions.val("Radom"); // Select "Random"
        } else {
            selectorOptions.val(""); // Deselect if none match
        }

        // update Nice Select wrapper
        selectorOptions.next(".nice-select").remove();
        NiceSelect.bind(selectorOptions[0]);
    });

    //* user-trade-result-percentage script end ===

    //* Password show/hide icon script start ==========
    $(document).on("click", ".input-group .eye-icon", function () {
        const inputId = $(this).attr("for");
        if ($(this).find(".fa-eye-slash").length) {
            $(this).html(`<i class="fa-regular fa-eye"></i>`);
            $(`#${inputId}`).attr("type", "text");
        } else {
            $(this).html(`<i class="fa-regular fa-eye-slash"></i>`);
            $(`#${inputId}`).attr("type", "password");
        }
    }); //? Password show/hide icon script end =========
});

jQuery(document).on("click", ".btnn-margin", function () {
    jQuery(".btnn-margin").removeClass("active");
    jQuery(this).addClass("active");
    var value = jQuery(this).val();
    jQuery(".user-trade-margin").val(value);
});

// Change the label text based on the selected trade result

function updateLabel() {
    var tradeResult = document.getElementById("trade_result").value;
    var percentageLabel = document.getElementById("percentage_label");

    // Change the label text based on the selected trade result
    percentageLabel.innerText = "Percentage " + tradeResult + " %";
}

// admin settings page script

jQuery(document).on("click", ".add_more_leagal_block", function (e) {
    e.preventDefault(); // Prevent the default link behavior

    // Define the new input group
    var newInputGroup = `<br>
    <div class="input-group">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title[]" placeholder="Enter Title">
    </div>
    <div class="input-group" style="display: grid; !important">
        <label class="form-label">Link</label>
        <input class="form-control" type="text" name="link[]" placeholder="Link please include http or https">
        <a href="#" class="remove-block" style="margin-top: 10px;">- Remove</a>
    </div>
    `;

    // Find the last .input-group inside the .card-body and insert after it
    jQuery(this)
        .closest(".card")
        .find(".card-body .input-group:last")
        .after(newInputGroup);
});

jQuery(document).on("click", ".remove-block", function (e) {
    e.preventDefault(); // Prevent the default link behavior
    // Remove the entire input group including the title and link input fields and the remove button
    jQuery(this).closest(".input-group").prev(".input-group").remove(); // Remove the previous input group (Title)
    jQuery(this).closest(".input-group").remove(); // Remove the current input group (Link and Remove button)
});

jQuery(document).on("click", ".btn-update-legal-settings", function (e) {
    e.preventDefault();
    jQuery(this).closest("form").submit();
});

$(document).on("submit", ".add_education_topic_form", function (event) {
    var content = $("#content").html();
    var content_short_description = $("#content_short_description").html();

    // Set the hidden input value to the content
    $("#education_description").val(content);

    $("#education_short_description").val(content_short_description);
});

// -------------------------------------------adding tarding bot-------------------------------------------------

function openTradingBotModal() {
    $("#trading-bot-modal").fadeIn(); // Show the modal with a fade-in effect
}

// Function to close the modal
function closeTradingBotModal() {
    $("#trading-bot-modal").fadeOut();
}

function openTradingBotInfoModal(element) {
    const botId = $(element).data("bot-id");

    $("#bot_id").val(botId);

    $("#trading-bot-license-modal").fadeIn();

    $("#bot-market").trigger("change");
}

function closeTradingBotInfoModal() {
    $("#trading-bot-license-modal").fadeOut();
}

$(document).ready(function () {
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            console.log("Modal found and opened");
            modal.style.display = "flex";
        } else {
            console.error(`Modal with ID ${modalId} not found.`);
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = "none";
        } else {
            console.error(`Modal with ID ${modalId} not found.`);
        }
    }

    $(".btn-generate-license").click(function (e) {
        e.preventDefault();

        const licenseKey = $(this).data("license");

        const tempInput = $("<input>")
            .val(licenseKey)
            .appendTo("body")
            .select();

        document.execCommand("copy");

        tempInput.remove();

        alert("License Key copied to clipboard: " + licenseKey);
    });

    $("#bot-market").on("change", function () {
        var selectedMarket = $(this).val();
        var apiUrl = "";

        switch (selectedMarket) {
            case "crypto":
                apiUrl = apiUrlCrypto;
                break;
            case "forex":
                apiUrl = apiUrlForex;
                break;
            case "indices":
                apiUrl = apiUrlIndices;
                break;
            case "stocks":
                apiUrl = apiUrlStocks;
                break;
            case "futures":
                apiUrl = apiUrlFutures;
                break;
            case "etfs":
                apiUrl = apiUrletfs;
                break;
            default:
                console.log("No valid market selected.");
                return;
        }

        $.ajax({
            url: apiUrl,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $("#bot-asset").empty();
                response.forEach(function (item) {
                    var symbol = item.symbol.toUpperCase().replace("=F", "");
                    $("#bot-asset").append(new Option(symbol, symbol));
                });
            },
            error: function (xhr, status, error) {
                console.log("Error fetching data:", error);
            },
        });
    });

    $(".btn-bot-edit-info").on("click", function (e) {
        e.preventDefault();
        const userId = $("#user_id").val();
        const botIdValue = $("#bot_id").val();
        const formData = {
            user_id: userId,
            bot_id: botIdValue,
            bot_trade_result: $("#bot-results").val(),
            bot_percentage: $("#bot-percentage").val(),
            bot_duration: $("#bot-duration-unit").val(),
            bot_market: $("#bot-market").val(),
            bot_asset: $("#bot-asset").val(),
            bot_capital: $("#bot-capital").val(),
            bot_trade_count: $("#bot-trade-count").val(),
            order_type: $("#bot_order_type").val(),
            margin: $("#bot_margin").val(),
        };
        $.ajax({
            url: urlEditTradingBot,
            method: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                    $("#trading-bot-license-modal").hide();
                }
                if (response.status === "insufficient_amount") {
                    Swal.fire({
                        icon: "warning",
                        title: "Insufficient Balance",
                        text: "The user cannot perform this trade with the specified amount and trade count, so please reduce the balance.",
                        confirmButtonText: "OK",
                    });
                }
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors)
                        .map((errorArray) => errorArray.join("<br>"))
                        .join("<br>");

                    Swal.fire({
                        title: "Validation Error!",
                        html: errorMessages,
                        icon: "error",
                        confirmButtonText: "Ok",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log("Error adding asset:", error);
                console.error("Error details:", xhr.responseText);
            },
        });
    });

    $(".btn-edit-software").on("click", function () {
        const botName = $(this).data("name");
        const botLicenseKey = $(this).data("licensekey");
        const botDescription = $(this).data("description");
        const botTitle = $(this).data("title");
        const botDepositAmount = $(this).data("deposit_amount");
        const botImage = $(this).data("image");
        const botId = $(this).data("id");
        const showImage = $(this).data("showimage");
        const imageName = showImage.split("/").pop();

        $("#modal-bot-name").val(botName);
        $("#modal-bot-license-key").val(botLicenseKey);
        $("#modal-bot-description").val(botDescription);
        $("#modal-bot-title").val(botTitle);
        $("#modal-bot-deposit-amount").val(botDepositAmount);
        $("#modal-bot-image").attr("src", showImage);
        $("#modal-bot-image-text").text(imageName);
        $("#bot-id").val(botId);

        const imageUrl = botImage;
        $("#image-preview").attr("src", imageUrl).show();

        $("#update-trading-bot-modal").show();
    });

    $(".btn-update-bot").on("click", function (e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append("id", $("#bot-id").val());
        formData.append("name", $("#modal-bot-name").val());
        formData.append("title", $("#modal-bot-title").val());
        formData.append("description", $("#modal-bot-description").val());
        formData.append("deposit_amount", $("#modal-bot-deposit-amount").val());
        formData.append("license_key", $("#modal-bot-license-key").val());
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        var imageFile = $("#modal-bot-image-upload")[0].files[0];
        if (imageFile) {
            formData.append("image", imageFile);
        }

        $.ajax({
            url: urlUpdateTradingBot,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("AJAX success callback triggered:", response);
                Swal.fire({
                    title: "Success!",
                    text: "Trading bot updated successfully!",
                    icon: "success",
                    confirmButtonText: "OK",
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
                closeModal("update-trading-bot-modal");
            },

            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error!",
                    text:
                        "There was an error updating the trading bot: " +
                        xhr.responseJSON.message,
                    icon: "error",
                    confirmButtonText: "Try Again",
                });
            },
        });
    });

    $("#generate-license-key").on("click", function () {
        const charset =
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&*!";
        let licenseKey = "";
        const length = 30;

        for (let i = 0; i < length; i++) {
            const randomChar = charset.charAt(
                Math.floor(Math.random() * charset.length)
            );
            licenseKey += randomChar;
        }

        $("#bot-license-key").val(licenseKey);
    });
});


function toggleButton() {
    var button = $("#toggleButton");
    var isEnabled = button.hasClass("btn-enabled");

    if (isEnabled) {
      button.removeClass("btn-enabled").addClass("btn-disabled").text("Enable");
    } else {
      button.removeClass("btn-disabled").addClass("btn-enabled").text("Disable");
    }
    sendButtonStatus(isEnabled ? 'disable' : 'enable');
  }

  function sendButtonStatus(status) {
    console.log("Sending status:", status);
    $.ajax({
      url: enableDisableTradingBot,
      type: "POST",
      data: JSON.stringify({ status: status }),
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
      contentType: "application/json",
      success: function(response) {
        if (response.status === 'success') {
            // Show SweetAlert success popup
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'The status has been updated successfully.',
                confirmButtonText: 'OK'
            });
        } else {
            // Handle cases where the response status is not 'success'
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an issue updating the status.',
                confirmButtonText: 'OK'
            });
        }
      },
      error: function(xhr, status, error) {
        console.error("Error sending status:", error);
      }
    });
  }
