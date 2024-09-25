<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use App\Entities\Comment;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'text', 'date'];
    protected $returnType = Comment::class;

    // Проверка наличия таблицы
    private function checkTableExists()
    {
        $db = \Config\Database::connect();
        $tableName = $this->table;
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = $db->query($sql);

        return $result->getNumRows() > 0;
    }

    // Создание таблицы
    private function createTable()
    {
        $db = \Config\Database::connect();

        $sql = "CREATE TABLE comments (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            text TEXT NOT NULL,
            date DATE NOT NULL
        )";

        try {
            $db->query($sql);
        } catch (Exception $e) {
            die("Error creating table: " . $e->getMessage());
        }
    }

    // Инициализация: проверка и создание таблицы в случае необходимости
    public function init()
    {
        if (!$this->checkTableExists()) {
            $this->createTable();
        }
    }

    // Добавление комментария в базу данных
    public function addComment($comment)
    {
        $data = [
            'name' => $comment->name,
            'text' => $comment->text,
            'date' => $comment->date,
        ];

        try {
            $this->insert($data);
        } catch (Exception $e) {
            die("Error inserting comment: " . $e->getMessage());
        }
    }

    // Получение всех комментариев из базы данных
    public function getAllComments()
    {
        try {
            $result = $this->orderBy('date', 'DESC')->findAll();

            $comments = [];
            foreach ($result as $row) {
                $comments[] = $row;
            }

            return $comments;
        } catch (Exception $e) {
            die("Error fetching comments: " . $e->getMessage());
        }
    }

    // Удаление комментария из базы данных
    public function deleteComment($id)
    {
        try {
            $this->delete($id);
        } catch (Exception $e) {
            throw new Exception("Error deleting comment: " . $e->getMessage());
        }
    }
}