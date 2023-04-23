<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [];

    public function setPassword(string $pass)
    {
        $this->attributes['senha_user'] = password_hash($pass, PASSWORD_BCRYPT);

        return $this;
    }

}