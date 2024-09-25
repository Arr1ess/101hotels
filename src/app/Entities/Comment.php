<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Comment extends Entity
{
    protected $attributes = [
        'id' => null,
        'name' => null,
        'text' => null,
        'date' => null,
    ];

    protected $datamap = [];
    protected $dates   = [];
    protected $casts   = [];

    public function __construct(?int $id = null, ?string $name = null, ?string $text = null, ?string $date = null)
    {
        parent::__construct();

        // Заполняем массив $attributes
        $this->attributes['id'] = $id;
        $this->attributes['name'] = $name;
        $this->attributes['text'] = $text;
        $this->attributes['date'] = $date;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getText()
    {
        return $this->attributes['text'];
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }
}