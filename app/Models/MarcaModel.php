<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcaModel extends Model
{
    public function getMarcas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marcas');

        $builder->select('*');
        $builder->orderBy('descricao');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findMarca($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marcas');

        $builder->select('*');
        $builder->where('idmarca = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaMarca($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marcas');

        $builder->where('idmarca', $data['idmarca']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaMarca($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marcas');

        return $builder->insert($data);
    }

    public function excluiMarca($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('marcas');

        $builder->where('idmarca', $id);
        $builder->delete();
    }
}
