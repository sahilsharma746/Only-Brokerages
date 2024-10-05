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

    /*<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#panelPill1">Active</a>
            </li>
            <li class=""><a data-toggle="pill" href="#panelPill2">Menu 1</a></li>
            <li class="disabled"><a data-toggle="pill" href="#panelPill3">Disabled</a></li>
        </ul>
        <div class="panel panel-default" style="margin-top: 10px;">
            <div class="tab-content panel-body">

                <div id="panelPill1" class="tab-pane fade active in">
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                        do
                        eiusmod
                        tempor
                        incididunt ut labore et
                        dolore magna aliqua.</p>
                </div>
                <div id="panelPill2" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris
                        nisi
                        ut
                        aliquip ex
                        ea commodo consequat.
                    </p>
                </div>
                <div id="panelPill3" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit
                        voluptatem
                        accusantium
                        doloremque
                        laudantium, totam rem
                        aperiam.</p>
                </div>
            </div>
        </div>
    </div>
</div>
    */
});

// nav-tab script end.

$(document).ready(function () {
    //* Verification section script start =========
    $(document).on(
        'change',
        '.account-verification .attach-icon input',
        function () {
            try {
                const placeholder = $(this).prev('[type="placeholder"]');
                const target = $(this).closest('.attach-icon').attr('for');
                console.log(target);
                const fileName = this.files[0].name;
                if (fileName && placeholder && target) {
                    placeholder.text(fileName).attr('hasFile', 'true');
                    $(`.check-files-valid-grid [data-label="${target}"]`).attr(
                        'verified',
                        'true',
                    );
                }
            } catch (error) {
                console.warn(error);
            }
        },
    );

    //* Verification section script end =========

    //* Password show/hide icon script start =========
    $(document).on('click', '.input-group .eye-icon', function () {
        const inputId = $(this).attr('for');
        if ($(this).find('.fa-eye-slash').length) {
            $(this).html(`<i class="fa-regular fa-eye"></i>`);
            $(`#${inputId}`).attr('type', 'text');
        } else {
            $(this).html(`<i class="fa-regular fa-eye-slash"></i>`);
            $(`#${inputId}`).attr('type', 'password');
        }
    });
    //* Password show/hide icon script end =========

    //* live Chat script start =======================
    const sendMessage = () => {
        const textBox = (text, imgSrc) => {
            return `
<div class="user-text-box d-flex align-items-start g-8">
    <p class="message">${text}</p>
    <div class="icon-area d-flex justify-content-center align-items-center">
        <img class="user-icon" src="${
            imgSrc ? imgSrc : './assets/img/site-logo.png'
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

    //* live Chat script end =========================
});

//* market-watch-grid area start ======================
// new TradingView.widget({
//     width: '100%',
//     height: 'calc(100vh - 75px)',
//     symbol: 'COINBASE:BTCUSD',
//     interval: '1',
//     timezone: 'Etc/UTC',
//     theme: 'dark',
//     style: '1',
//     locale: 'en',
//     toolbar_bg: '#f1f3f6',
//     enable_publishing: false,
//     hide_side_toolbar: false,
//     allow_symbol_change: true,
//     details: true,
//     studies: [
//         'BB@tv-basicstudies',
//         'Volume@tv-basicstudies',
//         'VWAP@tv-basicstudies',
//     ],
//     container_id: 'krust-investments-tradingView-card',
// });

//* market-watch-grid area end ======================

//* copy to clipboard area start ======================
// function copyToClipboard(id) {
//     // Get the input field
//     var copyText = document.querySelector(id);

//     if (!copyText) {
//         console.warn('Element not found', id);
//         return;
//     }

//     // Create a temporary textarea element to hold the text
//     var tempTextArea = document.createElement('textarea');
//     tempTextArea.value = copyText.value;
//     document.body.appendChild(tempTextArea);

//     // Select the text in the textarea
//     tempTextArea.select();
//     tempTextArea.setSelectionRange(0, tempTextArea.value.length); // For mobile devices

//     try {
//         // Copy the text to the clipboard
//         var successful = document.execCommand('copy');
//         if (successful) {
//             alert('Copied the text: ' + tempTextArea.value);
//         } else {
//             console.error('Failed to copy text');
//         }
//     } catch (err) {
//         console.error('Could not copy text: ', err);
//     }

//     // Remove the temporary textarea element
//     document.body.removeChild(tempTextArea);
// }

$(document).on('click', '.clone-icon', function () {
    const targetId = $(this).attr('for');
    if (targetId) copyToClipboard(`#${targetId}`);
});

//* copy to clipboard area end ======================
// user trade Result loos win /random
