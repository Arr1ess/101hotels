$(document).ready(function() {
    // Обработка отправки формы добавления комментария
    $('#addCommentForm').on('submit', function(e) {
        e.preventDefault(); // Предотвращаем стандартное поведение формы

        var formData = {
            email: $('#email').val(),
            text: $('#text').val()
        };

        $.ajax({
            url: '/comments',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                alert('Comment added successfully!');
                // Очищаем форму
                $('#addCommentForm')[0].reset();
                // Добавляем новый комментарий на страницу
                var newComment = `
                    <div class="card mb-3 comment-item">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Comment by ${formData.email}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">${response.date}</h6>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm delete-comment" data-comment-id="${response.id}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p class="card-text">${formData.text}</p>
                        </div>
                    </div>
                `;
                $('.container').prepend(newComment);
                recalculatePagination();
            },
            error: function(xhr, status, error) {
                alert('Error adding comment: ' + error);
            }
        });
    });
});