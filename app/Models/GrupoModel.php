<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    public function getGrupos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('grupos');

        $builder->select('*');
        $builder->orderBy('descricao');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findGrupo($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('grupos');

        $builder->select('*');
        $builder->where('idgrupo = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaGrupo($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('grupos');

        $builder->where('idgrupo', $data['idgrupo']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaGrupo($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('grupos');

        return $builder->insert($data);
    }

    public function excluiGrupo($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('grupos');

        $builder->where('idgrupo', $id);
        $builder->delete();
    }
}
