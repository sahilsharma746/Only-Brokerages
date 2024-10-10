// Add nice 2 select for all the selects in the site
jQuery(document).ready(function () {
    if (typeof NiceSelect !== "undefined" && NiceSelect.bind) {
        $.each($("select"), function (index, selector) {
            const id = $(selector).attr("id");
            const searchable = $(selector).attr("searchable");

            // Skip the select elements with specific classes
            if (
                $(selector).hasClass("trading-history-table_length") ||
                $(selector).hasClass("select_account_type") ||
                $(selector).hasClass("userWithdrawalMethodClass")
            ) {
                return true; // This continues to the next iteration, skipping the current one
            }

            const options = {
                searchable: searchable == "true" || false,
                placeholder: "select",
                searchtext: "Search",
                selectedtext: "geselecteerd",
            };

            NiceSelect.bind(document.getElementById(id), options);
        });
    }

    if (jQuery("#userWithdrawalMethod").length > 0) {
        if (typeof NiceSelect !== "undefined" && NiceSelect.bind) {
            console.log("NiceSelect is available.");

            let selectedMethod = localStorage.getItem(
                "previous_selected_method"
            );

            if (!selectedMethod) {
                selectedMethod = "bitcoin";
            }

            $("#userWithdrawalMethod option")
                .filter(function () {
                    return $(this).data("method") === selectedMethod;
                })
                .prop("selected", true);

            const idq = $("#userWithdrawalMethod").attr("id");
            const searchableq = $("#userWithdrawalMethod").attr("searchable");
            const optionsq = {
                searchable: searchableq === "true" || false,
                placeholder: "select",
                searchtext: "Search",
                selectedtext: "geseqlecteerd",
            };
            NiceSelect.bind(document.getElementById(idq), optionsq);

            updateFields();

            $("#userWithdrawalMethod").on("change", function () {
                updateFields();
            });
        }
    }

    // Function to update fields based on the selected withdrawal method
    function updateFields() {
        const selectedMethod = jQuery(
            "#userWithdrawalMethod option:selected"
        ).data("method");

        // Hide all method fields initially
        jQuery(
            "#crypto-fields, #crypto-address-tag, #paypal-field, #bank-fields, #bank-account-number, #bank-account-type, #bank-short-code, #bank-account-holder"
        ).hide();

        // Show the relevant fields based on the selected method
        if (
            selectedMethod === "bitcoin" ||
            selectedMethod === "usdt" ||
            selectedMethod === "xmr"
        ) {
            jQuery("#crypto-fields, #crypto-address-tag").show();
        } else if (selectedMethod === "deposit via paypal") {
            jQuery("#paypal-field").show();
        } else if (selectedMethod === "deposit via bank") {
            jQuery(
                "#bank-fields, #bank-account-number, #bank-account-type, #bank-short-code, #bank-account-holder"
            ).show();
        }

        // Store the selected method in local storage
        localStorage.setItem("previous_selected_method", selectedMethod);
    }

    if (jQuery("#site-main-nav").length > 0) {
        var main_nav_li = "";
        fetch(apiUrlCrypto)
            .then((response) => {
                if (!response.ok) {
                    return false;
                }
                return response.json();
            })
            .then((data) => {
                const container = document.getElementById("site-main-nav");
                container.innerHTML = "";
                data.forEach((pair) => {
                    main_nav_li += "<li>";
                    main_nav_li +=
                        '<div class="price-card d-flex flex-column">';
                    main_nav_li +=
                        '<div class="d-flex justify-content-between align-items-center g-10">';
                    main_nav_li +=
                        '<div class="country-name d-flex align-items-center g-8">';
                    main_nav_li +=
                        '<img src="' +
                        pair.image +
                        '" alt="' +
                        pair.name +
                        ' logo" class="flag">';
                    main_nav_li +=
                        "<span>" + pair.symbol.toUpperCase() + "/USD</span>";
                    main_nav_li += "</div>";
                    main_nav_li +=
                        '<div class="price">$' +
                        pair.current_price.toFixed(2) +
                        "</div>";
                    main_nav_li += "</div>";
                    main_nav_li +=
                        '<div class="percentage-area d-flex align-items-center g-8">';
                    main_nav_li +=
                        '<i class="fa-solid ' +
                        (pair.price_change_percentage_24h >= 0
                            ? "fa-chevron-up"
                            : "fa-chevron-down") +
                        '"></i>';
                    main_nav_li +=
                        '<span class="percentage ' +
                        (pair.price_change_percentage_24h >= 0
                            ? "text-success"
                            : "text-danger") +
                        '">' +
                        pair.price_change_percentage_24h.toFixed(2) +
                        "%</span>";
                    main_nav_li += "</div>";
                    main_nav_li += "</div>";
                    main_nav_li += "</li>";
                });
                container.innerHTML = main_nav_li;
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    }
});

jQuery(document).on("click", ".live-chat-section", function () {
    tidioChatApi.open();
});

jQuery(document).on("click", ".live-chat-withdraw-section", function (event) {
    event.preventDefault(); // Prevent the default link behavior
    tidioChatApi.open(); // Open the chat
});
