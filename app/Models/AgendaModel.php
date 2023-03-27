<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    public function getAgendas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');

        $builder->select('*');
        $builder->orderBy('data_comp');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findAgenda($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');

        $builder->select('*');
        $builder->where('idagenda = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaAgenda($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');

        $builder->where('idagenda', $data['idagenda']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaAgenda($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');

        return $builder->insert($data);
    }

    public function excluiAgenda($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agenda');

        $builder->where('idagenda', $id);
        $builder->delete();
    }
}
