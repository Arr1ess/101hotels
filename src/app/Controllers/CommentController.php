<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CommentModel;
use App\Entities\Comment;
use Exception;

class CommentController extends ResourceController
{
    protected $modelName = 'App\Models\CommentModel';
    protected $format    = 'json';

    // Инициализация базы данных
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->model->init();
    }

    public function create()
    {
        // Проверка, что запрос является POST-запросом
        if ($this->request->getMethod() !== 'post') {
            return $this->fail('Only POST requests are allowed.', 405);
        }

        // Получение данных из тела запроса
        $data = $this->request->getJSON(true);

        // Проверка наличия необходимых полей
        if (!isset($data['email']) || !isset($data['text'])) {
            return $this->fail('Missing required fields: email or text.', 400);
        }

        // Проверка корректности email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->fail('Invalid email format.', 400);
        }

        // Создание объекта Comment
        $comment = new Comment();
        $comment->name = $data['email'];
        $comment->text = $data['text'];
        $comment->date = date('Y-m-d H:i:s'); // Устанавливаем текущую дату и время

        // Добавление комментария в базу данных
        try {
            $this->model->addComment($comment);
            return $this->respondCreated([
                'message' => 'Comment created successfully.',
                'id' => $comment->id,
                'date' => $comment->date // Возвращаем дату создания комментария
            ]);
        } catch (Exception $e) {
            return $this->fail('Failed to create comment: ' . $e->getMessage(), 500);
        }
    }

    // Удаление комментария
    public function delete($id = null)
    {
        // Проверка, что запрос является DELETE-запросом
        if ($this->request->getMethod() !== 'delete') {
            return $this->fail('Only DELETE requests are allowed.', 405);
        }

        // Проверка наличия ID комментария
        if (!$id) {
            return $this->fail('Missing required field: id.', 400);
        }

        // Удаление комментария из базы данных
        try {
            $this->model->deleteComment($id);
            return $this->respondDeleted(['message' => 'Comment deleted successfully.']);
        } catch (Exception $e) {
            return $this->fail('Failed to delete comment: ' . $e->getMessage(), 500);
        }
    }
}
