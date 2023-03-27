<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorModel extends Model
{
    public function getFornecedores()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('fornecedores');

        $builder->select('*');
        $builder->orderBy('nomefantasia');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findFornecedor($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('fornecedores');

        $builder->select('*');
        $builder->where('idfornecedor = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaFornecedor($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('fornecedores');

        $builder->where('idfornecedor', $data['idfornecedor']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaFornecedor($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('fornecedores');

        return $builder->insert($data);
    }
}
