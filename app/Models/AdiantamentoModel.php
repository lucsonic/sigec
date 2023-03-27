<?php

namespace App\Models;

use CodeIgniter\Model;

class AdiantamentoModel extends Model
{
    public function getAdiantamentos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('adiantamento a');

        $builder->select("a.*, CASE WHEN f.tipopessoa = 'Física' THEN f.nome
                          WHEN f.tipopessoa = 'Jurídica' THEN f.nomefantasia
                          ELSE f.razaosocial END AS nome_funcionario");
        $builder->join('funcionarios f', 'a.idfuncionario = f.idfuncionario');
        $builder->orderBy('a.data_adt');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findAdiantamento($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('adiantamento a');

        $builder->select("a.*, CASE WHEN f.tipopessoa = 'Física' THEN f.nome
                          WHEN f.tipopessoa = 'Jurídica' THEN f.nomefantasia
                          ELSE f.razaosocial END AS nome_funcionario");
        $builder->join('funcionarios f', 'a.idfuncionario = f.idfuncionario');
        $builder->where('a.idadiantamento = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function atualizaAdiantamento($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('adiantamento');

        $builder->where('idadiantamento', $data['idadiantamento']);
        $builder->set($data);
        $builder->update($data);
    }

    public function salvaAdiantamento($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('adiantamento');

        return $builder->insert($data);
    }

    public function excluiAdiantamento($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('adiantamento');

        $builder->where('idadiantamento', $id);
        $builder->delete();
    }
}
