$(document).ready(function() {
    // Обработка нажатия на кнопку удаления комментария
    $('.delete-comment').on('click', function() {
        var commentId = $(this).data('comment-id');

        // Подтверждение удаления
        if (confirm('Are you sure you want to delete this comment?')) {
            // Отправка AJAX-запроса на удаление комментария
            $.ajax({
                url: '/comments/' + commentId,
                type: 'DELETE',
                contentType: 'application/json',
                success: function(response) {
                    // Удаление комментария из DOM
                    $(this).closest('.card').remove();
                    console.log(response.message);
                    recalculatePagination();
                }.bind(this), // Привязываем контекст к текущему элементу
                error: function(xhr, status, error) {
                    console.error('Error deleting comment:', xhr.responseJSON.error);
                }
            });
        }
    });
});