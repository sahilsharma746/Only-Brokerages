$(document).ready(function () {
    $.each($('.donate-chart'), function () {
        const options = {
            series: JSON.parse($(this).attr('series')) || [50, 25, 25],
            labels: JSON.parse($(this).attr('labels').replace(/'/g, '"')) || [
                (1, 2, 3),
            ],
            legend: {
                position: 'bottom',
                floating: false,
                itemMargin: {
                    horizontal: 100,
                    vertical: 5,
                },
            },
            colors: ['#FF7675', '#6C5CE7', '#FFA62B', '#FFEAA7'],
            title: {
                text: this.title,
                align: 'left',
            },
            chart: {
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '50%',
                        labels: {
                            show: false,
                            total: {
                                show: true,
                                label: 'Total',
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
                            position: 'bottom',
                        },
                    },
                },
            ],
        };
        const chart = new ApexCharts(this, options);
        chart.render();
    });


    $(document).on('change','.attach-file-input-group .attach-icon input',function () {
            try {
                const placeholder = $(this).prev('[type="placeholder"]');
                const fileName = this.files[0].name;
                if (fileName) {
                    placeholder.text(fileName).attr('hasFile', 'true');
                }
            } catch (error) {
                console.warn(error);
            }
        },
    );

    const searchInputFormControl = (searchInput) => {
        $(searchInput).attr('placeholder', 'Search for user etc...');
        $(searchInput)
            .prev()
            .html('<i class="fa-solid fa-magnifying-glass"></i>');
        $(searchInput).prev().addClass('all-user-table-label');
        $(searchInput).prev().css({
            'margin-right': '-30px',
            opacity: 0.5,
        });
    };

    if (jQuery('.all-admin-table-no-data').length == 0) {
    // if (jQuery('.all-user-table-no-data').length === 0) {
            const tableAllUserTable = new DataTable('#all-admin-table', {
            initComplete: function () {
                // Access the search input field and set a placeholder
                const searchInput = document.querySelector(
                    '[type="search"][aria-controls="all-admin-table"]',
                );
                if (searchInput) searchInputFormControl(searchInput);
            },
        });
    }

    // const tableLoginHistoryTable = new DataTable('#login-history-table', {
    //     initComplete: function () {
    //         // Access the search input field and set a placeholder
    //         const searchInput = document.querySelector(
    //             '[type="search"][aria-controls="login-history-table"]',
    //         );
    //         if (searchInput) searchInputFormControl(searchInput);
    //     },
    // });


    // const tableAllDepositTable = new DataTable('#all-deposit-table', {
    //     initComplete: function () {
    //         // Access the search input field and set a placeholder
    //         const searchInput = document.querySelector(
    //             '[type="search"][aria-controls="all-deposit-table"]',
    //         );
    //         if (searchInput) searchInputFormControl(searchInput);
    //     },
    // });


    // const tableAllWithdrawTable = new DataTable('#all-withdraw-table', {
    //     initComplete: function () {
    //         // Access the search input field and set a placeholder
    //         const searchInput = document.querySelector(
    //             '[type="search"][aria-controls="all-withdraw-table"]',
    //         );
    //         if (searchInput) searchInputFormControl(searchInput);
    //     },
    // });


    // const tableAllTradeTable = new DataTable('#all-trade-table', {
    //     initComplete: function () {
    //         // Access the search input field and set a placeholder
    //         const searchInput = document.querySelector(
    //             '[type="search"][aria-controls="all-trade-table"]',
    //         );
    //         if (searchInput) searchInputFormControl(searchInput);
    //     },
    // });


    // const tableAllAssetsTable = new DataTable('#all-assets-table', {
    //     initComplete: function () {
    //         // Access the search input field and set a placeholder
    //         const searchInput = document.querySelector(
    //             '[type="search"][aria-controls="all-assets-table"]',
    //         );
    //         if (searchInput) searchInputFormControl(searchInput);
    //     },
    // });


    $(document).on('click', '.notification-card .btn-delete', function () {
        $(this)
            .closest('.notification-card')
            .fadeOut(300, () => {
                $(this).remove();
            });
    });


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


    $(document).on('click', '.btn-delete-tr', function () {
        const tr = $(this).closest('tr');
        if (tr.length)
            tr.fadeOut(300, () => {
                $(this).remove();
            });
    });

    let imgSrc = '';
    $('#bot-software-img').on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imgSrc = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });


    $(document).on('click', '#btn-add-software', function () {
        const cardBody = $(this).closest('.card').find('.card-body');
        if (cardBody.length) {
            const name = cardBody.find('#bot-software-name').val();
            const description = cardBody
                .find('#bot-software-description')
                .val();
            const tr = `
<tr>
    <td>
        <img src="${
            imgSrc ? imgSrc : 'https://dummyimage.com/64x64/D9D9D9/000000'
        }" alt="">
        <div class="name">${name}</div>
    </td>
    <td>${description}</td>
    <td>${new Date().toLocaleDateString()}</td>
    <td>
        <div class="dropdown w-max">
            <a class="btn-dropdown">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </a>

            <ul class="list-style-none dropdown-menu d-flex flex-column">
                <li class="dropdown-item">
                    <a class="btn btn-delete-tr">Delete</a>
                </li>
            </ul>
        </div>
    </td>
</tr>`;
            if (name && description) {
                $('.bot-software-table tbody').append(tr);
            }
        }
    });
    //* Add software script end ==============================

    //* enabled disabled button for system settings start =====
    $(document).on('click', '.admin-system-settings-section .btn', function () {
        if ($(this).hasClass('btn-enabled')) {
            $(this).removeClass('btn-enabled');
            $(this).addClass('btn-disabled');
        } else {
            $(this).addClass('btn-enabled');
            $(this).removeClass('btn-disabled');
        }
    });
    //* enabled disabled button for system settings end =======

    //* user-trade-result-percentage script start ===
    $(document).on('keyup', '.user-trade-result-percentage', function () {
        const value = $(this).val();
        const selectorOptions = $(this)
            .closest('.modal-body')
            .find('.userTradeResult');

        if (value > 10) {
            selectorOptions.val('Win'); // Select "Win"
        } else if (value < 10) {
            selectorOptions.val('Loss'); // Select "Loss"
        } else if (value == 10) {
            selectorOptions.val('Radom'); // Select "Random"
        } else {
            selectorOptions.val(''); // Deselect if none match
        }

        // update Nice Select wrapper
        selectorOptions.next('.nice-select').remove();
        NiceSelect.bind(selectorOptions[0]);
    });

    //* user-trade-result-percentage script end ===

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
});



jQuery(document).on( 'click', '.btnn-margin', function(){
    jQuery('.btnn-margin').removeClass('active');
    jQuery(this).addClass('active');
    var value = jQuery(this).val();
    jQuery('.user-trade-margin').val(value);
});


   // Change the label text based on the selected trade result
 
function updateLabel() {
    var tradeResult = document.getElementById("trade_result").value;
    var percentageLabel = document.getElementById("percentage_label");

    // Change the label text based on the selected trade result
    percentageLabel.innerText = "Percentage " + tradeResult + " %";
  }