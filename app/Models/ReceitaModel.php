<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceitaModel extends Model
{
    public function getReceitas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita r');

        $builder->select('r.*, t.desctiporeceita');
        $builder->join('tipo_receita t', 'r.idtipo = t.idtiporeceita');
        $builder->orderBy('r.data_rec');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function getTiposReceita()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_receita');

        $builder->select('*');
        $builder->orderBy('desctiporeceita');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findReceita($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita r');

        $builder->select('r.*, t.desctiporeceita');
        $builder->join('tipo_receita t', 'r.idtipo = t.idtiporeceita');
        $builder->where('r.idreceita = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findReceitaTipo($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita');

        $builder->select('*');
        $builder->where('idtipo = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaReceita($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita');

        $builder->where('idreceita', $data['idreceita']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaReceita($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita');

        return $builder->insert($data);
    }

    public function salvaTipoRec($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_receita');

        return $builder->insert($data);
    }

    public function excluiReceita($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('receita');

        $builder->where('idreceita', $id);
        $builder->delete();
    }
}
