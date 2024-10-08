
window.addEventListener('load', function() {
    document.querySelectorAll('svg').forEach(function(svg) {
        svg.style.display = 'none';
        svg.offsetHeight; // trigger a reflow, flushing the CSS changes
        svg.style.display = 'block';
    });
});

//* Navigation nav-tab script ===============
document.addEventListener('click', function (e) {
    if (e.target.closest('a[data-toggle="tab"]')) {
        e.preventDefault();
        const $parent = e.target.closest('.nav-item');

        if (true) {
            const tabPane = e.target
                .closest('[data-toggle]')
                .getAttribute('href');
            console.log(tabPane);
            if (!tabPane) return;

            const navTabs = e.target.closest('.nav-tabs');
            const liElements = navTabs.querySelectorAll('li');
            liElements.forEach((li) => {
                li.classList.remove('active');
            });
            $parent.classList.add('active');

            try {
                const tabPaneElement = document.querySelector(tabPane);
                const siblings = tabPaneElement.parentNode.children;
                for (const sibling of siblings) {
                    sibling !== tabPaneElement &&
                        sibling.classList.remove('active', 'in');
                }

                tabPaneElement.classList.add('active');
                setTimeout(() => {
                    tabPaneElement.classList.add('in');
                }, 150);

                localStorage.setItem('activeLeftTab', tabPane);
            } catch (error) {
                console.warn(`Id not found ${tabPane}`);
            }
        }
    }

    if (e.target.closest('a[forward-toggle="tab"]')) {
        const target = e.target
            .closest('[forward-toggle]')
            .getAttribute('href');
        if (target)
            document
                .querySelector(`a[data-toggle="tab"][href="${target}"]`)
                ?.click();
    }
});

// nav-tab script end.

$(document).ready(function () {

    //! active tab with localStorage ________________
    const activeLeftTab = $('.left-nav .nav-item.active a').attr('href');
    const activeLeftTabLocalStorage = localStorage.getItem('activeLeftTab');
    if (activeLeftTab !== activeLeftTabLocalStorage) {
        const leftActiveNav = $(
            `a[data-toggle="tab"][href="${activeLeftTabLocalStorage}"]`,
        );
        if (leftActiveNav.length) leftActiveNav[0].click();
    } else {
        console.log(activeLeftTabLocalStorage);
    } 
    

    //? active tab with localStorage

    //* attach file form control script start =========
    $(document).on(
        'change',
        '.attach-file-input-group .attach-icon input',
        function () {
            try {
                const placeholder = $(this).prev('[type="placeholder"]');
                const fileName = this.files[0].name;
                if (fileName) {
                    placeholder.text(fileName).attr('hasFile', 'true');
                }

                //* this script for "section.account-verification" start _____↓
                const isParentVerification = $(this).closest(
                    '.account-verification',
                );
                if (!isParentVerification.length) return;
                const target = $(this).closest('.attach-icon').attr('for');
                if (fileName && target) {
                    $(`.check-files-valid-grid [data-label="${target}"]`).attr(
                        'verified',
                        'true',
                    );
                } //? this script for "section.account-verification" end ________↑
            } catch (error) {
                console.warn(error);
            }
        },
    ); //? attach file form control script end ========

    //* Password show/hide icon script start ==========
    $(document).on('click', '.input-group .eye-icon', function () {
        const inputId = $(this).attr('for');
        if ($(this).find('.fa-eye-slash').length) {
            $(this).html(`<i class="fa-regular fa-eye"></i>`);
            $(`#${inputId}`).attr('type', 'text');
        } else {
            $(this).html(`<i class="fa-regular fa-eye-slash"></i>`);
            $(`#${inputId}`).attr('type', 'password');
        }
    }); //? Password show/hide icon script end =========


    //* Payment Method collapsible script start ========
    $(document).on(
        'click',
        '[data-toggle="collapse"]:not(.active)',
        function (e) {
            e.preventDefault();
            const target = $(this).addClass('active').attr('href');
            $(target).removeClass('d-none');

            const cardList = $(this).closest('.card').siblings();
            $.each(cardList, function (index, card) {
                $(this).find('[data-toggle="collapse"]').removeClass('active');
                $(this).find('.card-body.collapse').addClass('d-none');
            });
        },
    ); //? Payment Method collapsible script end ==========

    //! Market watch collapsible script start ========
    $(document).on('click', '.market-watch-grid [data-target]', function () {
        if (!$(this).hasClass('active')) {
            const target = $(this).attr('data-target');
            $(this)
                .addClass('active')
                .siblings('a')
                .removeClass('active');
            $(`.market-watch-grid ${target}`)
                .removeClass('d-none')
                .siblings('.collapse')
                .addClass('d-none');
        }
    }); //? Market watch collapsible script end ==========
    //! Deposit area collapsible script start ========
    $(document).on(
        'click',
        '.navigation-card-group [data-target]',
        function () {
            if (!$(this).hasClass('active')) {
                const target = $(this).attr('data-target');
                $(this)
                    .addClass('active')
                    .closest('li')
                    .siblings()
                    .find('a')
                    .removeClass('active');
                $(`#payment-method-and-history ${target}`)
                    .removeClass('d-none')
                    .siblings('.collapse')
                    .addClass('d-none');
            }
        },
    ); //? Deposit area collapsible script end ==========

    //* modal script start ===============================
    $(document).on('click', '[data-toggle="modal"]', function () {
        const target = $(this).attr('href');
        $(target).fadeIn();
        $('body').addClass('overflowY-hidden');

        $(target)
            .find('.btn-modal-close')
            .click(function (e) {
                $(target).fadeOut();
                $('body').removeClass('overflowY-hidden');
            });
    });
});


$(document).on('click', '.clone-icon', function () {
    const targetId = $(this).attr('for');
    if (targetId) copyToClipboard(`#${targetId}`);
});


if( jQuery( '#trading-history-table' ).length > 0) {
    let table = new DataTable('#trading-history-table', {
        responsive: true,
        initComplete: function () {
            // Access the search input field and set a placeholder
            const searchInput = document.querySelector(
                '[type="search"][aria-controls="trading-history-table"]',
            );
            if (searchInput) {
                searchInput.placeholder = 'Search for trade etc...';
                searchInput.previousSibling.innerHTML = `<i class="fa-solid fa-magnifying-glass"></i>`;
                searchInput.previousSibling.classList.add(
                    'trading-history-table-label',
                );

                const btn =
                    '<a class="btn w-max" id="btn-download-trading-history"><i class="fa-solid fa-download"></i>&nbsp;Print As PDF</a>';
                searchInput.parentNode.insertAdjacentHTML('beforeend', btn);

                document.getElementById('btn-download-trading-history').addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = '/user/generate-pdf'; 
                });
            }


            // Add custom class to the page length select dropdown
            const lengthSelect = document.querySelector(
                'select[name="trading-history-table_length"]'
            );
            if (lengthSelect) {
                lengthSelect.classList.add('trading-history-table_length');
            }
        },
    });
}


// when user click yes on first popup
jQuery(document).on( 'click',  '.btn-confirm-deposit', function() {
    var payment_method_id = jQuery(this).data('gatewayid');
    jQuery('#depositSecondModal').show();
    jQuery('#depositSecondModal').find('.confirm-deposit-success').data('gatewayid', payment_method_id );
});

// when user click no on second popup
jQuery(document).on( 'click',  '.deposit-use-bitcoin', function() {
    var bitcoin_tab_id = jQuery(this).data('bitcointabid');
    jQuery('#depositSecondModal').hide();
    jQuery('.deposit-'+bitcoin_tab_id).trigger('click');
});

// when user click yes on second popup
jQuery(document).on( 'click',  '.confirm-deposit-success', function() {
    var payment_method_id = jQuery(this).data('gatewayid');
    window.location.href = 'deposit-transfer/'+payment_method_id;
});



jQuery(document).ready(function() {
    function fetchCryptoData(apiUrl, cryptoNames) {
        fetch(apiUrl)
            .then(response => response.json())  // Convert response to JSON
            .then(jsonData => {
                // Filter only the specified cryptocurrencies
                const filteredData = jsonData.filter(item => cryptoNames.includes(item.name.toLowerCase()));

                filteredData.forEach(cryptoData => {
                    // Select the corresponding card based on the crypto name
                    const selector = `.${cryptoData.name.toLowerCase()}-dashboard-data`;

                    // Format current price with commas
                    const formattedPrice = Number(cryptoData.current_price.toFixed(2)).toLocaleString();
                    jQuery(selector).find('.amount').text(formattedPrice);

                    // Update percentage data
                    const percentage = cryptoData.price_change_percentage_24h.toFixed(2);
                    const percentageData = `${percentage}%`;
                    jQuery(selector).find('.percentage').text(percentageData);

                    // Add arrow up/down and class based on positive/negative percentage
                    const arrowIcon = (cryptoData.price_change_percentage_24h >= 0) ? 'fa-arrow-up' : 'fa-arrow-down';
                    const statusClass = (cryptoData.price_change_percentage_24h >= 0) ? 'text-primary' : 'text-danger';

                    // Update arrow icon and class
                    jQuery(selector).find('.status i').removeClass('fa-arrow-up fa-arrow-down').addClass(arrowIcon);
                    jQuery(selector).find('.percentage-data').removeClass('text-primary text-danger').addClass(statusClass);
                });
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // Specify the cryptocurrencies you want to fetch
    var cryptoNames = ['bitcoin', 'ethereum', 'solana', 'tether'];

    // Fetch and update the data for the specified cryptocurrencies
    fetchCryptoData(apiUrlCrypto, cryptoNames);
});



    jQuery(document).on('click', '.news_type', function(e) {
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

    // Click event for news items
    jQuery(document).on('click', '#news-title-area ul li', function() {
        
        jQuery('#news-title-area ul li a').removeClass('active');

        // Add 'active' class to the <a> element of the clicked news item
        jQuery(this).find('a').addClass('active');

        // Get data attributes from the clicked news item
        var image = jQuery(this).data('image');
        var title = jQuery(this).data('title');
        var description = jQuery(this).data('description');
        var pubDate = jQuery(this).find('.news-time').text(); // Get publication date
        var link = jQuery(this).data('link');

        // Update the details section with the selected news information
        jQuery('#news-image').attr('src', image).show(); // Show the news image
        jQuery('#selected-news-title').text(title); // Set the title
        jQuery('#selected-news-time').text(pubDate); // Set the publication date
        jQuery('#selected-news-body').html(description); // Set the description
        jQuery('#selected-news-body-footer a').attr('href', link);
    });

    // Optional: If you want to show the first item of the default selected news type on page load
    jQuery(document).ready(function() {
        var defaultNewsType = 'crypto-news'; // Set your default news type here
        jQuery('.news_type[data-type="' + defaultNewsType + '"]').click(); // Simulate a click to show default news
        if( jQuery('#userWithdrawalMethod' ).length > 0 ) {
            const selectedMethod = localStorage.getItem('previous_selected_method');
            if( selectedMethod != null ) {
                $('#userWithdrawalMethod option').filter(function() {
                    return $(this).data('method') == selectedMethod;
                }).prop('selected', true);
            }
        }
    });


    jQuery('#userWithdrawalMethod').change(function() {
        var selectedMethod = jQuery('#userWithdrawalMethod option:selected').data('method');

        console.log( selectedMethod );

        if( selectedMethod != undefined ) {
            localStorage.setItem('previous_selected_method', selectedMethod);
        }

        // Hide all method fields initially
        jQuery('#crypto-fields, #crypto-address-tag, #paypal-field, #bank-fields, #bank-account-number, #bank-account-type, #bank-short-code, #bank-account-holder').hide();
    
        // Show the relevant fields based on the selected method
        if (selectedMethod === 'bitcoin' || selectedMethod === 'usdt' || selectedMethod === 'xmr') {
            jQuery('#crypto-fields, #crypto-address-tag').show();
        } else if (selectedMethod === 'deposit via paypal') {
            jQuery('#paypal-field').show();
        } else if (selectedMethod === 'deposit via bank') {
            jQuery('#bank-fields, #bank-account-number, #bank-account-type, #bank-short-code, #bank-account-holder').show();
        }
    });
    
    // Trigger the change event to handle pre-selected methods (optional)
    jQuery('#userWithdrawalMethod').trigger('change');



