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
                $(selector).hasClass("userWithdrawalMethodClass")||
                $(selector).hasClass("trading-bot-history-table-area")||
                $(selector).hasClass("trading-bot-history-table_length")
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

    // Fetch crypto data
    fetch(apiUrlCrypto)
        .then((response) => {
            if (!response.ok) {
                return false;
            }
            return response.json();
        })
        .then((cryptoData) => {
            // Fetch Forex data
            return fetch(apiUrlForex)
                .then((response) => response.json())
                .then((forexData) => {
                    // Fetch Stock data
                    return fetch(apiUrlStocks)
                        .then((response) => response.json())
                        .then((stockData) => {
                            // Fetch Futures data
                            return fetch(apiUrlFutures)
                                .then((response) => response.json())
                                .then((futuresData) => {
                                    // Fetch Indices data
                                    return fetch(apiUrlIndices)
                                        .then((response) => response.json())
                                        .then((indicesData) => {
                                            //fetch efts data
                                            return fetch(apiUrletfs)
                                                .then((response) => response.json())
                                                .then((eftsData) => {
                                            // Slice first 10 items from each data set
                                            const cryptoItems = cryptoData.slice(0, 10);
                                            const forexItems = forexData.slice(0, 10);
                                            const stockItems = stockData.slice(0, 10);
                                            const futuresItems = futuresData.slice(0, 10);
                                            const indicesItems = indicesData.slice(0, 10);
                                            const eftsItems = eftsData.slice(0, 10);

                                            // Mix the data, alternating between all the types
                                            const combinedData = [];
                                            for (let i = 0; i < 10; i++) {
                                                if (cryptoItems[i]) combinedData.push({ type: 'crypto', pair: cryptoItems[i] });
                                                if (forexItems[i]) combinedData.push({ type: 'forex', pair: forexItems[i] });
                                                if (stockItems[i]) combinedData.push({ type: 'stock', pair: stockItems[i] });
                                                if (futuresItems[i]) combinedData.push({ type: 'futures', pair: futuresItems[i] });
                                                if (indicesItems[i]) combinedData.push({ type: 'indices', pair: indicesItems[i] });
                                                if (eftsItems[i]) combinedData.push({ type: 'efts', pair: eftsItems[i] });

                                            }

                                            // Process and append the mixed data
                                            combinedData.forEach((item) => {
                                                main_nav_li += "<li>";
                                                main_nav_li += '<div class="price-card d-flex flex-column">';
                                                main_nav_li +=
                                                    '<div class="d-flex justify-content-between align-items-center g-10">';
                                                main_nav_li +=
                                                    '<div class="country-name d-flex align-items-center g-8">';

                                                if (item.type === 'crypto') {
                                                    // Crypto Data
                                                    main_nav_li +=
                                                        '<img src="' +
                                                        item.pair.image +
                                                        '" alt="' +
                                                        item.pair.name +
                                                        ' logo" class="flag">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase() + "/USD</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        item.pair.current_price.toFixed(2) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (item.pair.price_change_percentage_24h >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (item.pair.price_change_percentage_24h >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.price_change_percentage_24h.toFixed(2) +
                                                        "%</span>";
                                                } else if (item.type === 'forex') {
                                                    // Forex Data
                                                    main_nav_li +=
                                                        '<img class="flag" src="' +
                                                        item.pair.base_currency_image +
                                                        '" alt="' +
                                                        item.pair.symbol +
                                                        ' logo">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase() + "</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        parseFloat(item.pair.current_price).toFixed(4) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (parseFloat(item.pair.percentage_change) >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (parseFloat(item.pair.percentage_change) >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.percentage_change +
                                                        "%</span>";
                                                } else if (item.type === 'stock') {
                                                    // Stock Data
                                                    main_nav_li +=
                                                        '<img class="flag" src="' +
                                                        item.pair.logo +
                                                        '" alt="' +
                                                        item.pair.symbol +
                                                        ' logo">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase() + "</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        parseFloat(item.pair.current_price).toFixed(2) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (parseFloat(item.pair.percent_change) >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (parseFloat(item.pair.percent_change) >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.percent_change +
                                                        "%</span>";
                                                } else if (item.type === 'futures') {
                                                    // Futures Data
                                                    main_nav_li +=
                                                        '<img class="flag" src="' +
                                                        item.pair.logo_url +
                                                        '" alt="' +
                                                        item.pair.symbol +
                                                        ' logo">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase().replace('=F', '') + "</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        parseFloat(item.pair.regularMarketPrice).toFixed(2) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (parseFloat(item.pair.change_percentage) >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (parseFloat(item.pair.change_percentage) >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.change_percentage +
                                                        "%</span>";
                                                } else if (item.type === 'indices') {
                                                    // Indices Data
                                                    main_nav_li +=
                                                        '<img class="flag" src="' +
                                                        item.pair.logo +
                                                        '" alt="' +
                                                        item.pair.symbol +
                                                        ' logo">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase() + "</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        parseFloat(item.pair.current_price).toFixed(2) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (parseFloat(item.pair.change_percentage) >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (parseFloat(item.pair.change_percentage) >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.change_percentage +
                                                        "%</span>";
                                                }else if (item.type === 'efts') {
                                                    // Indices Data
                                                    main_nav_li +=
                                                        '<img class="flag" src="' +
                                                        item.pair.logo_url +
                                                        '" alt="' +
                                                        item.pair.symbol +
                                                        ' logo">';
                                                    main_nav_li +=
                                                        "<span>" + item.pair.symbol.toUpperCase() + "</span>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="price">$' +
                                                        parseFloat(item.pair.current_price).toFixed(2) +
                                                        "</div>";
                                                    main_nav_li += "</div>";
                                                    main_nav_li +=
                                                        '<div class="percentage-area d-flex align-items-center g-8">';
                                                    main_nav_li +=
                                                        '<i class="fa-solid ' +
                                                        (parseFloat(item.pair.change_percent) >= 0
                                                            ? "fa-chevron-up"
                                                            : "fa-chevron-down") +
                                                        '"></i>';
                                                    main_nav_li +=
                                                        '<span class="percentage ' +
                                                        (parseFloat(item.pair.change_percent) >= 0
                                                            ? "text-success"
                                                            : "text-danger") +
                                                        '">' +
                                                        item.pair.change_percent +
                                                        "%</span>";
                                                }
                                                main_nav_li += "</div>";
                                                main_nav_li += "</li>";
                                            });

                                            const container = document.getElementById("site-main-nav");
                                            container.innerHTML = main_nav_li;

                                            const marqueeContent = $('ul.marquee-content');
                                            $('.marquee').css(
                                                '--marquee-elements',
                                                marqueeContent.children().length,
                                            );
                                        });
                                });
                        });
                });
            });
        })
        .catch((error) => {
            console.error(
                "There was a problem with the fetch operation:",
                error
            );
        });
}


});

jQuery(document).on("click", ".live-chat-section", function (e) {
    e.preventDefault(); // Prevent the default link behavior
    if (typeof tidioChatApi !== 'undefined') {
        tidioChatApi.open();
    }
});

jQuery(document).on("click", ".live-chat-withdraw-section", function (event) {
    event.preventDefault(); // Prevent the default link behavior
    if (typeof tidioChatApi !== 'undefined') {
        tidioChatApi.open();
    }
});
