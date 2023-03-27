<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissaoModel extends Model
{
    protected $table = 'permissoes';
    protected $primaryKey = 'idPermissao';

    public function getPermissoes($idusuario = null)
    {
        if ($idusuario === null) {
            return $this->findAll();
        }

        return $this->asArray()->where(['idUsuario' => $idusuario])->First();
    }
}
