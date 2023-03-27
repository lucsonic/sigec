<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncoesModel extends Model
{
    public function getFuncoes()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcao');

        $builder->select('*');
        $builder->orderBy('nomefuncao ASC');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findFuncao($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcao');

        $builder->select('*');
        $builder->where('idfuncao = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaFuncao($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcao');

        $builder->where('idfuncao', $data['idfuncao']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaFuncao($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcao');

        return $builder->insert($data);
    }

    public function excluiFuncao($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcao');

        $builder->where('idfuncao', $id);
        $builder->delete();
    }
}
