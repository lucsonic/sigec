<?php

namespace App\Models;

use CodeIgniter\Model;

class FeriadoModel extends Model
{
    public function getFeriados()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        $builder->select('*');
        $builder->where('ano = ' . date('Y'));
        $builder->orderBy('mes, dia');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function getFeriadoFolha($ano, $mes, $dia)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        $builder->select('*');
        $builder->where('ano = ' . $ano . ' and mes = ' . $mes . ' and dia = ' . $dia);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findFeriado($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        $builder->select('*');
        $builder->where('idferiado = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaFeriado($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        $builder->where('idferiado', $data['idferiado']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaFeriado($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        return $builder->insert($data);
    }

    public function excluiFeriado($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('feriado');

        $builder->where('idferiado', $id);
        $builder->delete();
    }
}
