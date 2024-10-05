//* Navigation nav-tab script ===============
document.addEventListener('click', function (e) {
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

$(document).ready(function () {


    $(document).on('click', '#left-nav:not(ul > *)', function (e) {
        if (!$(e.target).is('ul')) leftNavClose();
    });
    //* user left navigation active script end =======

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

    //* live Chat script start ========================
    const sendMessage = () => {
        const textBox = (text, imgSrc) => {
            return `
<div class="user-text-box d-flex align-items-start g-8">
    <p class="message">${text}</p>
    <div class="icon-area d-flex justify-content-center align-items-center">
        <img class="user-icon" src="${
            imgSrc ? imgSrc : 'https://dummyimage.com/40x40/f0b90b/000000'
        }" alt="user name">
    </div>
</div>`;
        };
        const message = $('#live-chat-input');
        if (message.val()) {
            try {
                const $newElement = $(textBox(message.val())).css({
                    opacity: 0,
                });
                $('#chat-body').append($newElement);
                $newElement.animate({ opacity: 1 }, 500); // 500 is the duration in milliseconds

                $('#live-chat-section .scroll').animate(
                    {
                        scrollTop: $('#live-chat-section .scroll')[0]
                            .scrollHeight,
                    },
                    1000,
                );
                message.val('');
                message.focus();
            } catch (error) {
                console.warn(error);
            }
        }
    };
    $('#send-message').on('click', sendMessage);
    $(document).on('keypress', '#live-chat-input', function (e) {
        if (e.which === 13) sendMessage();
    });
    //* live Chat script end ===========================

    //* Payment Method collapsible script start ========

    $(document).on(
        'click',
        '.collapsible-card-group [data-toggle="collapse"]:not(.active)',
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

    //! Market watch collapsible script start =============
    $(document).on(
        'click',
        '.market-watch-table-indicators a.btn:not(.active)',
        function () {
            try {
                $(this).addClass('active').siblings().removeClass('active');
                const target = $(this).attr('href');
                $(`${target}`)
                    .removeClass('d-none')
                    .siblings('tbody')
                    .addClass('d-none');
            } catch (err) {
                console.warn(err);
            }
        },
    ); //? Market watch collapsible script end ============
    //! Deposit area collapsible script start =============
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
    ); //? Deposit area collapsible script end ============

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
    }); //? modal script end =================================

    $(document).on('click', '.btn-confirm-info', function () {
        const cardBody = $(
            '.user-deposit-area .collapsible-card-group .card .card-body.collapse.active',
        );
        if (cardBody.length) {
            const amount = cardBody.find('.amount').val();
            $('.depositFinishModal .modal-text').text(
                `You request has been received. Please note that we only receive bank wire transfer for payments above $${amount}. Any lesser payment must be processed via bitcoin`,
            );
        }
    });
});

//* copy to clipboard area start ========================
const copyToClipboard = (id) => {
    // Get the input field
    var copyText = document.querySelector(id);

    if (!copyText) {
        console.warn('Element not found', id);
        return;
    }

    // Create a temporary textarea element to hold the text
    var tempTextArea = document.createElement('textarea');
    tempTextArea.value = copyText.value;
    document.body.appendChild(tempTextArea);

    // Select the text in the textarea
    tempTextArea.select();
    tempTextArea.setSelectionRange(0, tempTextArea.value.length); // For mobile devices

    try {
        // Copy the text to the clipboard
        var successful = document.execCommand('copy');
        if (successful) {
            alert('Copied the text: ' + tempTextArea.value);
        } else {
            console.error('Failed to copy text');
        }
    } catch (err) {
        console.error('Could not copy text: ', err);
    }

    // Remove the temporary textarea element
    document.body.removeChild(tempTextArea);
};


$(document).on('click', '.clone-icon', function () {
    const targetId = $(this).attr('for');
    if (targetId) copyToClipboard(`#${targetId}`);
}); //? copy to clipboard area end =====================


//* search script area start ==========================
$(document).on('keyup', '.search-input-group .search-input', function (e) {
    const value = this.value.toLowerCase();
    console.log(value);
}); //? search script area end ============================



let btnViewHistory = null;
$(document).on('click', '.btn-load-software', function () {
    btnViewHistory = $(this).prev('.btn-view-history');
});

$(document).on(
    'click',
    '.trading-bot-license-modal .btn-license-submit',
    function () {
        btnViewHistory.removeClass('d-none');
        btnViewHistory = null;
    },
);

$(document).on('click', '.btn-view-history', function () {
    $('.trading-bots-area').addClass('d-none');
    $('.bot-trading-history').removeClass('d-none');
});


$(document).on('click', '[href="#trading-bots-area"]', function () {
    $('.trading-bots-area').removeClass('d-none');
    $('.bot-trading-history').addClass('d-none');
});
//* trading bot script end ===================


const searchInputFormControl = (searchInput) => {
    $(searchInput).attr('placeholder', 'Search for user etc...');
    $(searchInput)
        .prev()
        .html('<i class="fa-solid fa-magnifying-glass"></i>');
    $(searchInput).prev().addClass('trading-history-table-label');
    $(searchInput).prev().css({
        'margin-right': '-30px',
        opacity: 0.5,
    });
};