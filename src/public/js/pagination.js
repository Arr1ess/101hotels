window.recalculatePagination = function() {
    const commentsPerPage = 3;
    let $comments = $('.comment-item');
    let totalComments = $comments.length;
    let totalPages = Math.ceil(totalComments / commentsPerPage);
    let currentPage = 1;

    function showPage(page) {
        $comments.hide();
        const start = (page - 1) * commentsPerPage;
        const end = start + commentsPerPage;
        $comments.slice(start, end).show();
    }

    function updatePagination() {
        $('#prev-page').toggleClass('disabled', currentPage === 1);
        $('#next-page').toggleClass('disabled', currentPage === totalPages);

        // Обновляем номера страниц
        $('#page-1 .page-link').text(1);
        $('#page-last .page-link').text(totalPages);
        $('#page-current .page-link').text(currentPage).parent().toggleClass('active', true);
        $('#page-current-prev .page-link').text(currentPage - 1);
        $('#page-current-next .page-link').text(currentPage + 1);

        // Показываем или скрываем эллипсисы
        $('#page-ellipsis-left').toggle(currentPage > 3);
        $('#page-ellipsis-right').toggle(currentPage < totalPages - 2);

        // Показываем или скрываем кнопки с номерами страниц
        $('#page-1').toggle(totalPages > 1);
        $('#page-current-prev').toggle(currentPage > 2);
        $('#page-current-next').toggle(currentPage < totalPages - 1);
        $('#page-last').toggle(totalPages > 1);
    }

    $comments = $('.comment-item');
    totalComments = $comments.length;
    totalPages = Math.ceil(totalComments / commentsPerPage);
    if (currentPage > totalPages) {
        currentPage = totalPages;
    }
    showPage(currentPage);
    updatePagination();
};

$(document).ready(function() {
    const commentsPerPage = 3;
    let $comments = $('.comment-item');
    let totalComments = $comments.length;
    let totalPages = Math.ceil(totalComments / commentsPerPage);
    let currentPage = 1;

    function showPage(page) {
        $comments.hide();
        const start = (page - 1) * commentsPerPage;
        const end = start + commentsPerPage;
        $comments.slice(start, end).show();
    }

    function updatePagination() {
        $('#prev-page').toggleClass('disabled', currentPage === 1);
        $('#next-page').toggleClass('disabled', currentPage === totalPages);

        // Обновляем номера страниц
        $('#page-1 .page-link').text(1);
        $('#page-last .page-link').text(totalPages);
        $('#page-current .page-link').text(currentPage).parent().toggleClass('active', true);
        $('#page-current-prev .page-link').text(currentPage - 1);
        $('#page-current-next .page-link').text(currentPage + 1);

        // Показываем или скрываем эллипсисы
        $('#page-ellipsis-left').toggle(currentPage > 3);
        $('#page-ellipsis-right').toggle(currentPage < totalPages - 2);

        // Показываем или скрываем кнопки с номерами страниц
        $('#page-1').toggle(totalPages > 1);
        $('#page-current-prev').toggle(currentPage > 2);
        $('#page-current-next').toggle(currentPage < totalPages - 1);
        $('#page-last').toggle(totalPages > 1);
    }

    $('#prev-page button').click(function() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
            updatePagination();
        }
    });

    $('#next-page button').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
            updatePagination();
        }
    });

    $('.page-number button').click(function() {
        currentPage = parseInt($(this).text());
        showPage(currentPage);
        updatePagination();
    });

    // Инициализация
    showPage(currentPage);
    updatePagination();
});