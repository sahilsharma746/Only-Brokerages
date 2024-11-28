//* Navigation nav-tab script ===============
document.addEventListener('click', function(e) {
    if (e.target.closest('a[data-toggle="tab"]')) {
        e.preventDefault();
        const $parent = e.target.closest('.nav-item');
        if ($parent) {
            const tabPane = e.target
                .closest('[data-toggle]')
                .getAttribute('href');
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
$(document).ready(function() {
    $(document).on('click', '#left-nav:not(ul > *)', function(e) {
        if (!$(e.target).is('ul')) leftNavClose();
    });
    //* user left navigation active script end =======
    //* attach file form control script start =========
    $(document).on(
        'change',
        '.attach-file-input-group .attach-icon input',
        function() {
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
    $(document).on('click', '.input-group .eye-icon', function() {
        const inputId = $(this).attr('for');
        if ($(this).find('.fa-eye-slash').length) {
            $(this).html(`<i class="fa-regular fa-eye"></i>`);
            $(`#${inputId}`).attr('type', 'text');
        } else {
            $(this).html(`<i class="fa-regular fa-eye-slash"></i>`);
            $(`#${inputId}`).attr('type', 'password');
        }
    }); //? Password show/hide icon script end =========
});
$(document).ready(function() {
    loadEducationFirstPost();

});
// update the education posts based on the selected type
$(document).on('click', '.education_type', function() {
    $('.education_type').removeClass('active');
    $(this).addClass('active');
    $('#loader-image').show();
    $('#trading-news-container .news-content').hide();
    $('.education_posts').empty();
    var id = $(this).data('id');
    $.ajax({
        type: 'GET',
        url: educationPostsByTypeURL,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                $.each(response.data, function(index, post) {
                    const shortDescription = post.short_description.length > 30 ?
                        post.short_description.substring(0, 30) + '...' :
                        post.short_description;
                    const date = new Date(post.created_at);
                    const formattedDate = date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: '2-digit',
                        year: 'numeric'
                    });
                    const html = `
<ul class="list-style-none">
   <li>
      <a href="javascript:void(0)" data-id="${post.id}" class="education_selected">
      <span class="news-title">${shortDescription}</span>
      <span class="news-time">${formattedDate}</span>
      </a>
   </li>
</ul>
`;
                    $('#news-title-area').append(html);
                    loadEducationFirstPost();
                });
            }
        },
    });
});
// // Event handler for clicking on an education post
$(document).on('click', '.education_selected', function() {
    $('.education_selected').removeClass('active');
    $(this).addClass('active');
    $('#loader-image').show();
    $('#trading-news-container .news-content').hide();
    var id = $(this).data('id');
    loadEducationPost(id);
});

function loadEducationFirstPost() {
    // Automatically load the first education post on page load
    var firstPost = $('.education_selected').first();
    if (firstPost.length) {
        var id = firstPost.data('id'); // Get the ID of the first post
        loadEducationPost(id); // Load the first post
        firstPost.addClass('active'); // Set the first post as active
    }
}
// Function to load the education post data
function loadEducationPost(id) {
    $.ajax({
        type: 'GET',
        url: educationPostById,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                $('#loader-image').hide();
                $('#trading-news-container .news-content').show();
                var educationPost = response.data;
                var newsContainer = $('#trading-news-container');
                newsContainer.find('.news-title-img').html('<img src="../uploads/education_images/' + educationPost.image + '" class="education-image-large">');
                newsContainer.find('.news-title').text(educationPost.title);
                newsContainer.find('.short_description').html(educationPost.short_description);
                jQuery('.short_description').css({
                    'padding': '10px',
                    'font-size': '25px'
                });
                const date = new Date(educationPost.created_at);
                const formattedDate = date.toLocaleDateString('en-US', {
                    month: 'short', // "Jan", "Feb", etc.
                    day: '2-digit', // "01", "02", etc.
                    year: 'numeric' // "2024"
                });
                newsContainer.find('.news-post-time').text(formattedDate);
                // News body
                newsContainer.find('.news-body').html(educationPost.description);
                jQuery('.news-body').css({
                    'line-height': '1.6',
                    'padding': '10px',
                    'border-radius': '8px',
                    'font-size': '17px'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
$(document).ready(function() {
    if ($('#user-deposit-area').length && $('#user-deposit-area #promptType').length) {
        var prompt_key = localStorage.getItem("promptkey");
        var prompt_amount_deposit = localStorage.getItem("promtAmountKey");
        var deposit_amount_for_activate_bot = localStorage.getItem("deposit_amount_for_activate_bot");
        var bot_id = localStorage.getItem("bot_id");
        if (prompt_key) {
            $('#payment-1-tab #promptType, #payment-2-tab #promptType, #payment-3-tab #promptType').val(prompt_key);
        }
        if (prompt_amount_deposit) {
            // $('#prompt_amount_deposit').val(prompt_amount_deposit);
            $('#payment-1-tab #prompt_amount_deposit, #payment-2-tab #prompt_amount_deposit, #payment-3-tab #prompt_amount_deposit').val(prompt_amount_deposit);
        }
        if (deposit_amount_for_activate_bot) {
            $('#payment-1-tab #prompt_amount_deposit, #payment-2-tab #prompt_amount_deposit, #payment-3-tab #prompt_amount_deposit').val(deposit_amount_for_activate_bot);
        }
        if (bot_id) {
            $(' #bot_id').val(bot_id);
        }
        $('.deposit_form_for_prompt').on('submit', function() {
            localStorage.removeItem("promptkey");
            localStorage.removeItem("promtAmountKey");
            localStorage.removeItem("deposit_amount_for_activate_bot");
            localStorage.removeItem("bot_id");
        });
    }
});
// --------------------------Trading bot js  for the user--------------------------------------------

jQuery(document).on('click', '.btn-load-software', function() {
    var parent = $(this).closest('.bot-main-card');
    var botId = $(this).data('bot-id');
    var botName = parent.find('.trading-bots-name').text();
    var botImage = parent.find('.bot-image').attr('src');
    var licenseKey = parent.find('#bot-main-license-key').val();
    var depositAmount = parent.find('#bot-deposit-amount').val();
    $('#trading-bot-license-modal .bot-modal-image').attr('src', botImage);
    $('#trading-bot-license-modal .bot_id').val(botId);
    $('#trading-bot-license-modal .modal-title').text(botName);
    $('#trading-bot-license-modal .modal-trading-bot-deposit-amount').text(depositAmount);
    $('#trading-bot-license-modal .bot-modal-license_key').val(licenseKey);
    $('#trading-bot-license-modal .deposit_amount').val(depositAmount);
    $('#trading-bot-license-modal').fadeIn();
});
jQuery(document).on('click', '.btn-modal-close', function() {
    $('#trading-bot-license-modal').fadeOut();
});
jQuery(document).on('click', '.generate-license-key-modal', function() {
    console.log('adasd');
    const licenseKey = jQuery(this).parents('.trading-bot-license-modal').find('.bot-modal-license_key').val();
    console.log(licenseKey);
    jQuery(this).parents('.trading-bot-license-modal').find('#trading-bot-license-Key').val(licenseKey);
})

$(document).on('click', '.btn-license-submit', function(e) {
    e.preventDefault();

    // Get form values
    const licenseKey = $('#trading-bot-license-Key').val();
    const botId = $('.bot_id').val();
    const depositAmount = $('.deposit_amount').val();

    // Make AJAX request
    $.ajax({
        url: tradingBotLicenseUrl,
        method: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            license_key: licenseKey,
            bot_id: botId,
            deposit_amount: depositAmount,
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {

                var botId = response.bot_id;
                const $currentCard = $(`.bot-main-card:has([data-bot-id="${botId}"])`);
                const botName = $currentCard.find('.trading-bots-name').text();
                const botImage = $currentCard.find('.bot-image').attr('src');
                const mainLicenseKey = $currentCard.find('#bot-main-license-key').val();
                const mainDepositAmount = $currentCard.find('#bot-deposit-amount').val();

                $('#trading-bot-success-modal .bot-modal-image').attr('src', botImage);
                $('#trading-bot-success-modal .modal-title').text(botName);
                $('#trading-bot-success-modal .modal-trading-bot-deposit-amount').text(mainDepositAmount);
                $('#trading-bot-success-modal .sucess-bot-modal-license_key').val(mainLicenseKey);
                $('#trading-bot-success-modal .deposit_amount').val(mainDepositAmount);
                $('#trading-bot-success-modal .bot_id').val(botId);


                $('#trading-bot-license-modal').hide();
                $('#trading-bot-success-modal').show();
            } else {
                localStorage.setItem('bot_id', response.bot_id);
                localStorage.setItem('deposit_amount_for_activate_bot', response.deposit_amount);
                window.location.href = depositeUrl;
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    });
});


     $('#trading-bot-success-modal .btn-modal-close').on('click', function() {
        $('#trading-bot-success-modal').hide();
    });



    if (jQuery("#trading-bot-history-table").length > 0) {
        let table = new DataTable("#trading-bot-history-table", {
            responsive: true,
            scrollY: "700px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            initComplete: function () {
                const searchInput = document.querySelector(
                    '[type="search"][aria-controls="trading-bot-history-table"]'
                );
                if (searchInput) {
                    searchInput.placeholder = "Search for trade etc...";
                }

                const lengthSelect = document.querySelector(
                    'select[name="trading-bot-history-table_length"]'
                );
                if (lengthSelect) {
                    lengthSelect.classList.add("trading-bot-history-table_length");
                }

                const tableBody = document.querySelector('#trading-bot-history-table tbody');
                if (tableBody && tableBody.rows.length === 0) {
                    const noDataRow = document.createElement('tr');
                    const noDataCell = document.createElement('td');
                    noDataCell.colSpan = 9;
                    noDataCell.textContent = 'No data available';
                    noDataCell.classList.add('text-center');
                    noDataRow.appendChild(noDataCell);
                    tableBody.appendChild(noDataRow);
                }
            },
        });
    }
