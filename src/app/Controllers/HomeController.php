<?php

namespace App\Controllers;

use App\Models\CommentModel;

class HomeController extends BaseController
{
    public function index()
    {
        // Получение всех комментариев из базы данных
        $model = new CommentModel();
        $comments = $model->getAllComments();

        // Передача данных в представление
        return view('comment_view', ['comments' => $comments]);
    }
}
