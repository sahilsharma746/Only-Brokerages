window.addEventListener("load", function () {
    document.querySelectorAll("svg").forEach(function (svg) {
        svg.style.display = "none";
        svg.offsetHeight; // trigger a reflow, flushing the CSS changes
        svg.style.display = "block";
    });
});

//* Navigation nav-tab script ===============
document.addEventListener("click", function (e) {
    if (e.target.closest('a[data-toggle="tab"]')) {
        e.preventDefault();
        const $parent = e.target.closest(".nav-item");

        if (true) {
            const tabPane = e.target
                .closest("[data-toggle]")
                .getAttribute("href");
            console.log(tabPane);
            if (!tabPane) return;

            const navTabs = e.target.closest(".nav-tabs");
            const liElements = navTabs.querySelectorAll("li");
            liElements.forEach((li) => {
                li.classList.remove("active");
            });
            $parent.classList.add("active");

            try {
                const tabPaneElement = document.querySelector(tabPane);
                const siblings = tabPaneElement.parentNode.children;
                for (const sibling of siblings) {
                    sibling !== tabPaneElement &&
                        sibling.classList.remove("active", "in");
                }

                tabPaneElement.classList.add("active");
                setTimeout(() => {
                    tabPaneElement.classList.add("in");
                }, 150);

                localStorage.setItem("activeLeftTab", tabPane);
            } catch (error) {
                console.warn(`Id not found ${tabPane}`);
            }
        }
    }

    if (e.target.closest('a[forward-toggle="tab"]')) {
        const target = e.target
            .closest("[forward-toggle]")
            .getAttribute("href");
        if (target)
            document
                .querySelector(`a[data-toggle="tab"][href="${target}"]`)
                ?.click();
    }
});

// nav-tab script end.

$(document).ready(function() {
    //! active tab with localStorage ________________
    const activeLeftTab = $(".left-nav .nav-item.active a").attr("href");
    const activeLeftTabLocalStorage = localStorage.getItem("activeLeftTab");
    if (activeLeftTab !== activeLeftTabLocalStorage) {
        const leftActiveNav = $(
            `a[data-toggle="tab"][href="${activeLeftTabLocalStorage}"]`
        );
        if (leftActiveNav.length) leftActiveNav[0].click();
    } else {
        console.log(activeLeftTabLocalStorage);
    }

    //? active tab with localStorage

    //* attach file form control script start =========
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

                //* this script for "section.account-verification" start _____↓
                const isParentVerification = $(this).closest(
                    ".account-verification"
                );
                if (!isParentVerification.length) return;
                const target = $(this).closest(".attach-icon").attr("for");
                if (fileName && target) {
                    $(`.check-files-valid-grid [data-label="${target}"]`).attr(
                        "verified",
                        "true"
                    );
                } //? this script for "section.account-verification" end ________↑
            } catch (error) {
                console.warn(error);
            }
        }
    ); //? attach file form control script end ========

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

    //* Payment Method collapsible script start ========
    $(document).on(
        "click",
        '[data-toggle="collapse"]:not(.active)',
        function (e) {
            e.preventDefault();
            const target = $(this).addClass("active").attr("href");
            $(target).removeClass("d-none");

            const cardList = $(this).closest(".card").siblings();
            $.each(cardList, function (index, card) {
                $(this).find('[data-toggle="collapse"]').removeClass("active");
                $(this).find(".card-body.collapse").addClass("d-none");
            });
        }
    ); //? Payment Method collapsible script end ==========

    //! Market watch collapsible script start ========
    $(document).on("click", ".market-watch-grid [data-target]", function () {
        if (!$(this).hasClass("active")) {
            const target = $(this).attr("data-target");
            $(this).addClass("active").siblings("a").removeClass("active");
            $(`.market-watch-grid ${target}`)
                .removeClass("d-none")
                .siblings(".collapse")
                .addClass("d-none");
        }
    }); //? Market watch collapsible script end ==========
    //! Deposit area collapsible script start ========
    $(document).on(
        "click",
        ".navigation-card-group [data-target]",
        function () {
            if (!$(this).hasClass("active")) {
                const target = $(this).attr("data-target");
                $(this)
                    .addClass("active")
                    .closest("li")
                    .siblings()
                    .find("a")
                    .removeClass("active");
                $(`#payment-method-and-history ${target}`)
                    .removeClass("d-none")
                    .siblings(".collapse")
                    .addClass("d-none");
            }
        }
    ); //? Deposit area collapsible script end ==========

    //* modal script start ===============================
    $(document).on("click", '[data-toggle="modal"]', function () {
        const target = $(this).attr("href");
        $(target).show();
        $("body").addClass("overflowY-hidden");

        $(target)
            .find(".btn-modal-close")
            .click(function (e) {
                $(target).fadeOut();
                $("body").removeClass("overflowY-hidden");
            });
    });
});

$(document).on("click", ".clone-icon", function () {
    const targetId = $(this).attr("for");
    if (targetId) copyToClipboard(`#${targetId}`);
});


if (jQuery("#trading-history-table").length > 0) {
    let table = new DataTable("#trading-history-table", {
        responsive: true,
        scrollY: "700px",
        scrollCollapse: true,
        initComplete: function () {
            // Search input field customization
            const searchInput = document.querySelector(
                '[type="search"][aria-controls="trading-history-table"]'
            );
            if (searchInput) {
                searchInput.placeholder = "Search for trade etc...";
                searchInput.previousSibling.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i>`;
                searchInput.previousSibling.classList.add("trading-history-table-label");

                // Add a button for downloading as PDF
                const btn = '<a class="print_as_pdf w-max" id="btn-download-trading-history"><i class="fa-solid fa-download"></i>&nbsp;Print As PDF</a>';
                searchInput.parentNode.insertAdjacentHTML('beforeend', btn);

                // Add event listener for the PDF download button
                document.getElementById("btn-download-trading-history").addEventListener("click", function (e) {
                    e.preventDefault();
                    window.location.href = tradingHistoryDownloadPdf;
                });
            }

            // Add custom class to the page length select dropdown
            const lengthSelect = document.querySelector('select[name="trading-history-table_length"]');
            if (lengthSelect) {
                lengthSelect.classList.add("trading-history-table_length");
            }
        },
    });
}



// when user click yes on first popup
jQuery(document).on("click", ".btn-confirm-deposit", function () {
    var payment_method_id = jQuery(this).data("gatewayid");
    jQuery("#depositSecondModal").show();
    jQuery("#depositSecondModal")
        .find(".confirm-deposit-success")
        .data("gatewayid", payment_method_id);
});

// when user click no on second popup
jQuery(document).on("click", ".deposit-use-bitcoin", function () {
    var bitcoin_tab_id = jQuery(this).data("bitcointabid");
    jQuery("#depositSecondModal").hide();
    jQuery(".deposit-" + bitcoin_tab_id).trigger("click");
});

// when user click yes on second popup
jQuery(document).on("click", ".confirm-deposit-success", function () {
    var payment_method_id = jQuery(this).data("gatewayid");
    window.location.href = "deposit-transfer/" + payment_method_id;
});


jQuery(document).ready(function() {
    function fetchCryptoData(apiUrl, cryptoNames) {
        fetch(apiUrl)
            .then((response) => response.json()) // Convert response to JSON
            .then((jsonData) => {
                // Filter only the specified cryptocurrencies
                const filteredData = jsonData.filter((item) =>
                    cryptoNames.includes(item.name.toLowerCase())
                );

                filteredData.forEach((cryptoData) => {
                    // Select the corresponding card based on the crypto name
                    const selector = `.${cryptoData.name.toLowerCase()}-dashboard-data`;

                    // Format current price with commas
                    const formattedPrice = Number(
                        cryptoData.current_price.toFixed(2)
                    ).toLocaleString();
                    jQuery(selector).find(".amount").text(formattedPrice);

                    // Update percentage data
                    const percentage =
                        cryptoData.price_change_percentage_24h.toFixed(2);
                    const percentageData = `${percentage}%`;
                    jQuery(selector).find(".percentage").text(percentageData);

                    // Add arrow up/down and class based on positive/negative percentage
                    const arrowIcon =
                        cryptoData.price_change_percentage_24h >= 0
                            ? "fa-arrow-up"
                            : "fa-arrow-down";
                    const statusClass =
                        cryptoData.price_change_percentage_24h >= 0
                            ? "text-primary"
                            : "text-danger";

                    // Update arrow icon and class
                    jQuery(selector)
                        .find(".status i")
                        .removeClass("fa-arrow-up fa-arrow-down")
                        .addClass(arrowIcon);
                    jQuery(selector)
                        .find(".percentage-data")
                        .removeClass("text-primary text-danger")
                        .addClass(statusClass);
                });
            })
            .catch((error) => console.error("Error fetching data:", error));
    }

    // Specify the cryptocurrencies you want to fetch
    var cryptoNames = ["bitcoin", "ethereum", "solana", "tether"];

    // Fetch and update the data for the specified cryptocurrencies
    fetchCryptoData(apiUrlCrypto, cryptoNames);
});

// market-news-data
jQuery(document).ready(function () {

    loadDefaultMarketNews();
})


$(document).on('click', '.news_type', function() {
    $('#selected-news-body-footer').hide();
    $('.news_type').removeClass('active');
    $(this).addClass('active');
    var newsType = $(this).data('type');

    loadMarketNews(newsType);
});

function loadDefaultMarketNews() {
    $('.news-body-footer').hide();
    var defaultNewsType = 'crypto-news';
    loadMarketNews(defaultNewsType);
}

function loadMarketNews(newsType) {
    $('#loader-image').show();
    $('#news-image').hide();

    $('#selected-news-title').text('');
    $('#selected-news-body').html('');
    $('#selected-news-time').text('');
    $('#selected-news-body-footer a').attr('href', '#');

    $.ajax({
        type: 'GET',
        url: urlgetingnewsdata,
        data: { type: newsType },
        success: function(response) {
            $('#loader-image').hide();
            $('#selected-news-body-footer').show();
            $('#news-title-area .news').show();
            if (response.success) {
                var newsList = response.data;
                var newsContainer = $('#news-title-area ul.news');
                newsContainer.empty();
                newsList.forEach(function(news) {
                    newsContainer.append(`
                        <li class="feed_selected"
                            data-image="${news.image}"
                            data-title="${news.title}"
                            data-description="${news.description}"
                            data-link="${news.link}">
                            <a>
                                <span class="news-title">
                                    ${news.title.length > 30 ? news.title.substring(0, 30) + '...' : news.title}
                                </span>
                                <span class="news-time">${news.pub_date}</span>

                            </a>
                        </li>
                    `);
                });
                if (newsList.length > 0) {
                    var firstNews = newsList[0];
                    loadNewsDetails(firstNews.image, firstNews.title, firstNews.description, firstNews.pub_date, firstNews.link);

                    $('#news-title-area ul.news li:first-child a').addClass('active');
                }
            }
        },
        error: function(xhr) {
            $('#loader-image').hide();
            console.log(xhr.responseText);
        }
    });
}
// function for load first news
function loadNewsDetails(image, title, description, pubDate, link) {
    description = description.replace(/<br\s*[\/]?>/gi, "</p><p>");
    description = description.replace(/(Bitcoin whales|Whale Appetite|Netflow Metrics|Price Prediction)/gi, "<strong>$1</strong>");

    let formattedContent = addLineBreaksAfter200Words(description, 200);

    jQuery("#news-image").attr("src", image).show();
    jQuery("#selected-news-title").text(title);

    if (title.trim() !== "") {
        jQuery("#selected-news-title").css({
            padding: "10px",
            "font-size": "30px",
        });
    }

    jQuery("#selected-news-time").text(pubDate);
    jQuery("#selected-news-body").html(formattedContent);
    jQuery("#selected-news-body-footer a").attr("href", link);

    if (formattedContent.trim() !== "") {
        jQuery("#selected-news-body").css({
            "line-height": "1.6",
            padding: "10px",
            "border-radius": "8px",
            "font-size": "17px",
        });
    }

    if (link.trim() !== "") {
        jQuery("#selected-news-body-footer").css({
            padding: "10px",
            "font-size": "20px",
        });
    }
}


// Click event for news items
jQuery(document).on("click", ".main-news-area #news-title-area ul li", function () {

    jQuery("#news-title-area ul li a").removeClass("active");


    jQuery(this).find("a").addClass("active");

    var image = jQuery(this).data("image");
    var title = jQuery(this).data("title");
    var description = jQuery(this).data("description");
    var pubDate = jQuery(this).find(".news-time").text();
    var link = jQuery(this).data("link");

    description = description.replace(/<br\s*[\/]?>/gi, "</p><p>");
    description = description.replace(
        /(Bitcoin whales|Whale Appetite|Netflow Metrics|Price Prediction)/gi,
        "<strong>$1</strong>"
    );

    if (window.innerWidth < 678) {
        jQuery('html, body').animate({
            scrollTop: jQuery('.trading-news-container').offset().top
        }, 500);
    } else {
        jQuery('html, body').animate({
            scrollTop: jQuery('.news-page').offset().top
        }, 500);
    }

    let formattedContent = addLineBreaksAfter200Words(description, 200);

    // Update the details section with the selected news information
    jQuery("#news-image").attr("src", image).show(); // Show the news image
    jQuery("#selected-news-title").text(title); // Set the title

    if (title.trim() !== "") {
        jQuery("#selected-news-title").css({
            padding: "10px",
            "font-size": "30px",
        });
    }

    jQuery("#selected-news-time").text(pubDate); // Set the publication date
    jQuery("#selected-news-body").html(formattedContent); // Set the news body
    jQuery("#selected-news-body-footer a").attr("href", link); // Set the news link

    // Apply the styles if formattedContent is not empty
    if (formattedContent.trim() !== "") {
        jQuery("#selected-news-body").css({
            "line-height": "1.6",
            padding: "10px",
            "border-radius": "8px",
            "font-size": "17px",
        });
    }

    if (link.trim() !== "") {
        jQuery("#selected-news-body-footer").css({
            padding: "10px",
            "font-size": "20px",
        });
    }

    jQuery(
        "main > article .market-news-section .news-search-card .card-body.scroll"
    ).css({
        height: "calc(110vh - 74px - 150px)",
        overflow: "auto",
        "margin-top": "10px",
    });
});



jQuery(document).on('click', '.main-news-area .news_type', function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Remove the 'active' class from all news type buttons
    jQuery('.news_type').removeClass('active');

    // Add the 'active' class to the clicked button
    jQuery(this).addClass('active');

    // Get the type of news to show
    var type = jQuery(this).data('type');

    // Hide all news sections
    jQuery('#news-title-area ul').hide();

    // Show the selected news section
    jQuery('#news-title-area .' + type).show();

    // Trigger click on the first news item of the selected type
    var firstItem = jQuery('#news-title-area .' + type + ' li:first-child');
    if (firstItem.length) {
        firstItem.click(); // Simulate a click on the first item
    }
});





//-- ----------------------------------When the admin enables or sets the upgrade prompt for the user, this popup will be displayed.

function addLineBreaksAfter200Words(content, wordLimit) {
    // Split the content into an array of words
    let words = content.split(" ");

    let formattedContent = []; // To store the chunks of text
    let tempContent = []; // To build each chunk until it reaches the word limit

    // Loop through the words
    for (let i = 0; i < words.length; i++) {
        tempContent.push(words[i]);

        // Check if the word limit is reached and the last word ends with a full stop
        if (tempContent.length >= wordLimit && words[i].endsWith(".")) {
            // Join the words for this chunk and add a line break
            formattedContent.push(tempContent.join(" ") + "<br><br>");
            tempContent = []; // Reset tempContent to start a new chunk
        }
    }

    // Add any remaining words that didn't meet the full stop condition
    if (tempContent.length > 0) {
        formattedContent.push(tempContent.join(" "));
    }

    // Join all the formatted content back into a single string
    return formattedContent.join("");
}

// on load do a ajax call and chcek there which prompts is on than show that prompt

jQuery(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    jQuery.ajax({
        type: "GET",
        url: userPromptsUrl,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        xhrFields: {
            withCredentials: true,
        },
        success: function (response) {

            if( response.prompt ) {

                let resultData = JSON.parse(response.prompt_data.result);
                console.log(resultData);
                let prompt_key = response.prompt_data.key;
                console.log(prompt_key);

                if (prompt_key === 'upgrade_prompt' && resultData.prompt_setting === 'yes') {
                    $('#upgrade_propmpt_plan_name').text(resultData.upgrade_prompt_plan_name);
                    $('#upgrade_propmpt_plan_id').val(resultData.upgrade_prompt_plan_id);
                    var promptKey =  $('#upgrade_propmpt_type').val(prompt_key);
                    showUpgradePlanModal();
                }

                if (prompt_key === 'identity_prompt' && resultData.prompt_setting === 'yes') {
                    showIdentityErrorModal();
                }
                if (prompt_key === 'account_on_hold_prompt' && resultData.prompt_setting === 'yes') {
                    showAccountOnHoldModal();
                }
                if (prompt_key === 'kyc_verification_prompt' && resultData.prompt_setting === 'yes') {
                    showKYCVerificationModal();
                }
                if (prompt_key === 'account_certificate_prompt' && resultData.prompt_setting === 'yes') {
                    $('#account_certificate_prompt_amount').val(resultData.prompt_amount);
                    showAccountCertificatePromptModal();
                }
                if (prompt_key === 'tax_reference_prompt' && resultData.prompt_setting === 'yes') {
                    $('#tax_reference_prompt_amount').val(resultData.prompt_amount);
                    showTaxReferencePromptModal();
                }
                if (prompt_key === 'axillary_system_prompt' && resultData.prompt_setting === 'yes') {
                    $('#axillary_system_prompt_amount').val(resultData.prompt_amount);
                    $('.axillary_prompt_amount').text('$' + resultData.prompt_amount);

                        showAxillarySystemPromptModal();
                }
                if (prompt_key === 'trade_limit_prompt' && resultData.prompt_setting === 'yes') {
                    $('#trade_limit_prompt_amount').val(resultData.prompt_amount);
                    showTradeLimitPromptModal();
                }
                if (prompt_key === 'credit_facility_approval' && resultData.prompt_setting === 'yes') {
                    $('#credit_facility_amount').text(resultData.prompt_amount);

                    $('#credit_facility_approval_amount').val(resultData.prompt_amount);
                    showCreditFacilityApprovalModal();
                }
                if (prompt_key === 'loan_facility_approval' && resultData.prompt_setting === 'yes') {
                    $('#loan_facility_amount').text(resultData.prompt_amount);
                    $('#loan_facility_approval_amount').val(resultData.prompt_amount);
                    showLoanFacilityApprovalModal();
                }

            }

        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
    });

    var defaultNewsType = 'crypto-news'; // Set your default news type here
    jQuery('.news_type[data-type="' + defaultNewsType + '"]').click();

});
function showUpgradePlanModal() {
    $("#upgradeRequiredModal").hide();
    $("#upgradeRequiredModal").show();
}

function showIdentityErrorModal() {
    $("#identityErrorModal").show();
}

function showKYCVerificationModal() {
    $("#kycVerificationModal").show();
}

function showAccountOnHoldModal() {
    $("#accountOnHoldModal").show();
}

function showTaxReferencePromptModal() {
    $("#accountOnHoldModal").show();
}

function showAccountCertificatePromptModal() {
    $("#accountCertificateModal").show();
}

function showTaxReferencePromptModal() {
    $("#taxReferenceModal").show();
}

function showAxillarySystemPromptModal() {
    $("#axillarySystemModal").show();
}

function showTradeLimitPromptModal() {
    $("#tradeLimitModal").show();
}

function showCreditFacilityApprovalModal() {
    $("#creditFacilityApprovalModal").show();
}

function showLoanFacilityApprovalModal() {
    $("#loanFacilityApprovalModal").show();
}


$('#upgradeRequiredModal .upgrade_prompt').on('click', function() {
    jQuery("#upgradeRequiredModal").hide();
    var promptKey = "upgrade_prompt";
    localStorage.setItem("promptkey", promptKey);
    var planId = $('#upgrade_propmpt_plan_id').val();
    var upgradePlanUrl = depositeUrl +"/"+ planId;
    window.location.href = upgradePlanUrl;
});


$('#identityErrorModal .identity_error_prompt').on('click', function() {
    jQuery("#identityErrorModal").hide();
    if (typeof tidioChatApi !== 'undefined') {
        tidioChatApi.open();
    }
});

$('#kycVerificationModal .kyc_verification_prompt').on('click', function() {

    var currentUrl = window.location.href;
    if (currentUrl !== userDashboard) {
        window.location.href = userDashboard;
    }

    jQuery("#kycVerificationModal").hide();
    jQuery('.tab-pane').removeClass('active');
    jQuery('.account-verification').addClass('active');

});

$('#accountOnHoldModal .account_on_hold_prompt').on('click', function() {
    jQuery("#accountOnHoldModal").hide();
    if (typeof tidioChatApi !== 'undefined') {
        tidioChatApi.open();
    }
});

$('#axillarySystemModal .axillary_system_prompt').on('click', function() {
    const promptAmount = $('#axillary_system_prompt_amount').val();
    localStorage.setItem("promptkey", "axillary_system_prompt");
    localStorage.setItem("promtAmountKey", promptAmount);
    jQuery("#axillarySystemModal").hide();
    window.location.href = depositeUrl;
});

$('#accountCertificateModal .account_certificate_prompt').on('click', function() {
    const promptAmount = $('#account_certificate_prompt_amount').val();

    localStorage.setItem("promptkey", "account_certificate_prompt");
    localStorage.setItem("promtAmountKey", promptAmount);
 $('#axillary_system_prompt_amount').val(0);
    jQuery("#accountCertificateModal").hide();
    window.location.href = depositeUrl;
});

$('#taxReferenceModal .tax_reference_prompt').on('click', function() {
    const promptAmount = $('#tax_reference_prompt_amount').val();
    localStorage.setItem("promptkey", "tax_reference_prompt");
    localStorage.setItem("promtAmountKey", promptAmount);

    jQuery("#taxReferenceModal").hide();
    window.location.href = depositeUrl;
});

$('#tradeLimitModal .trade_limit_prompt').on('click', function() {
    const promptAmount = $('#trade_limit_prompt_amount').val();
    localStorage.setItem("promptkey", "trade_limit_prompt");
    localStorage.setItem("promtAmountKey", promptAmount);

    jQuery("#tradeLimitModal").hide();
    window.location.href = depositeUrl;
});

$('#creditFacilityApprovalModal .credit_facility_approval').on('click', function() {
    const promptAmount = $('#credit_facility_approval_amount').val();

    localStorage.setItem("promptkey", "credit_facility_approval");
    localStorage.setItem("promtAmountKey", promptAmount);

    jQuery("#creditFacilityApprovalModal").hide();
    window.location.href = depositeUrl;
});

$('#loanFacilityApprovalModal .loan_facility_approval').on('click', function() {
    const promptAmount = $('#loan_facility_approval_amount').val();

    localStorage.setItem("promptkey", "loan_facility_approval");
    localStorage.setItem("promtAmountKey", promptAmount);

    jQuery("#loanFacilityApprovalModal").hide();
    window.location.href = depositeUrl;
});

   function addLineBreaksAfter200Words(content, wordLimit) {
        // Split the content into an array of words
        let words = content.split(' ');

        let formattedContent = [];  // To store the chunks of text
        let tempContent = [];  // To build each chunk until it reaches the word limit

        // Loop through the words
        for (let i = 0; i < words.length; i++) {
            tempContent.push(words[i]);

            // Check if the word limit is reached and the last word ends with a full stop
            if (tempContent.length >= wordLimit && words[i].endsWith('.')) {
                // Join the words for this chunk and add a line break
                formattedContent.push(tempContent.join(' ') + '<br><br>');
                tempContent = [];  // Reset tempContent to start a new chunk
            }
        }

        // Add any remaining words that didn't meet the full stop condition
        if (tempContent.length > 0) {
            formattedContent.push(tempContent.join(' '));
        }

        // Join all the formatted content back into a single string
        return formattedContent.join('');
    }
