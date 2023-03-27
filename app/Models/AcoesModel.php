<?php

namespace App\Models;

use CodeIgniter\Model;

class AcoesModel extends Model
{
    public function grava_acao($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('log_acoes');

        return $builder->insert($data);
    }

    public function getAcoes($d1, $d2)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('log_acoes a');

        $builder->select('a.*, u.usuario');
        $builder->join('usuarios u', 'a.idusuario = u.id');
        $builder->where('a.data_acao >= "' . $d1 . '" and a.data_acao <= "' . $d2 . '"');
        $builder->orderBy('a.data_acao');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }
}
