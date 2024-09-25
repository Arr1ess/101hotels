<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div id="comments-container">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card mb-3 comment-item" style="display: none;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Comment by <?= esc($comment->getName()) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= esc($comment->getDate()) ?></h6>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm delete-comment" data-comment-id="<?= esc($comment->id) ?>">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= esc($comment->getText()) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    No comments found.
                </div>
            <?php endif; ?>
        </div>

        <!-- Пагинация -->
        <nav aria-label="Comments pagination" class="mt-3">
            <ul class="pagination justify-content-center" id="pagination">
                <li class="page-item" id="prev-page">
                    <button class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
                <li class="page-item page-number" id="page-1">
                    <button class="page-link">1</button>
                </li>
                <li class="page-item disabled" id="page-ellipsis-left">
                    <button class="page-link">...</button>
                </li>
                <li class="page-item page-number" id="page-current-prev">
                    <button class="page-link">2</button>
                </li>
                <li class="page-item page-number active" id="page-current">
                    <button class="page-link">3</button>
                </li>
                <li class="page-item page-number" id="page-current-next">
                    <button class="page-link">4</button>
                </li>
                <li class="page-item disabled" id="page-ellipsis-right">
                    <button class="page-link">...</button>
                </li>
                <li class="page-item page-number" id="page-last">
                    <button class="page-link">5</button>
                </li>
                <li class="page-item" id="next-page">
                    <button class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
            </ul>
        </nav>

        <!-- Форма для создания комментария -->
        <div class="card mt-5">
            <div class="card-header">
                <h5 class="card-title">Add a Comment</h5>
            </div>
            <div class="card-body">
                <form id="addCommentForm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Comment</label>
                        <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/delete_comment.js"></script>
    <script src="js/add_comment.js"></script>
    <script src="js/pagination.js"></script>
</body>

</html>