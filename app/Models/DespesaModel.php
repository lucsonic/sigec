<?php

namespace App\Models;

use CodeIgniter\Model;

class DespesaModel extends Model
{
    public function getDespesas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa d');

        $builder->select('d.*, t.desctipodespesa');
        $builder->join('tipo_despesa t', 'd.idtipo = t.idtipodespesa');
        $builder->orderBy('d.data_desp');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function getTiposDespesa()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_despesa');

        $builder->select('*');
        $builder->orderBy('desctipodespesa');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findDespesa($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa d');

        $builder->select('d.*, t.desctipodespesa');
        $builder->join('tipo_despesa t', 'd.idtipo = t.idtipodespesa');
        $builder->where('d.iddespesa = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findDespesaTipo($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa');

        $builder->select('*');
        $builder->where('iddespesa = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaDespesa($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa');

        $builder->where('iddespesa', $data['iddespesa']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaDespesa($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa');

        return $builder->insert($data);
    }

    public function salvaTipoDesp($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_despesa');

        return $builder->insert($data);
    }

    public function excluiDespesa($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('despesa');

        $builder->where('iddespesa', $id);
        $builder->delete();
    }
}
