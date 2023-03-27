<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $user = 'usuario';

    public function getLogin($user = null)
    {
        if ($user === null) {
            return $this->findAll();
        }

        return $this->asArray()->where(['usuario' => $user])->First();
    }
}
