$(document).ready(function () {
    //* admin left navigation active script start =======
    const leftNavOpen = () => {
        $('#btn-nav-toggle').addClass('nav-displayed');
        $('#left-nav').addClass('active');
    };
    const leftNavClose = () => {
        $('#btn-nav-toggle').removeClass('nav-displayed');
        $('#left-nav').removeClass('active');
    };
    $(document).on('click', '#btn-nav-toggle', function () {
        if ($(this).hasClass('nav-displayed')) {
            leftNavClose();
        } else {
            leftNavOpen();
        }
    });
    $(document).on('click', '#left-nav:not(ul > *)', function (e) {
        if (!$(e.target).is('ul')) leftNavClose();
    });
    //* admin left navigation active script end =======
});
