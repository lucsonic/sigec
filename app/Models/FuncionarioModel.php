<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
    public function getFuncionarios()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcionarios');

        $builder->select("CASE WHEN tipopessoa = 'Física' THEN nome
                          WHEN tipopessoa = 'Jurídica' THEN nomefantasia
                          ELSE razaosocial END AS nome_funcionario, idfuncionario, endereco, bairro, 
                          cidade, uf, cep, cpf, rg, orgaorg, nomefuncao, email, entrada, saida,
                          nomesetor, sexo, formacao, estadocivil, ativo, datanascimento, telefones,
                          datacadastro, observacao, tipopessoa, nomefantasia, razaosocial, cnpj, nomecontato");
        $builder->join('setor', 'funcionarios.idsetor = setor.idsetor');
        $builder->join('funcao', 'funcionarios.idfuncao = funcao.idfuncao');
        $builder->orderBy('1 ASC');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function getSetores()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('setor');

        $builder->select('*');
        $builder->orderBy('nomesetor ASC');
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function findFuncionarioFuncao($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcionarios');

        $builder->select('*');
        $builder->where('idfuncao = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }

    public function salvaFuncionario($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcionarios');

        return $builder->insert($data);
    }

    public function salvaSetor($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('setor');

        return $builder->insert($data);
    }

    public function atualizaFuncionario($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcionarios');

        $builder->where('idfuncionario', $data['idfuncionario']);
        $builder->set($data);
        $builder->update($data);
    }

    public function findFuncionario($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('funcionarios f');

        $builder->select("CASE WHEN f.tipopessoa = 'Física' THEN f.nome
                          WHEN f.tipopessoa = 'Jurídica' THEN f.nomefantasia
                          ELSE f.razaosocial END AS nome_funcionario, f.idfuncionario, f.endereco, f.bairro, f.entrada, f.saida, 
                          f.cidade, f.uf, f.cep, f.cpf, f.rg, f.orgaorg, fu.nomefuncao, f.email, f.idsetor, f.idfuncao,
                          s.nomesetor, f.sexo, f.formacao, f.estadocivil, f.ativo, f.datanascimento, f.telefones,
                          f.datacadastro, f.observacao, f.tipopessoa, f.nomefantasia, f.razaosocial, f.cnpj, f.nomecontato");
        $builder->join('setor s', 'f.idsetor = s.idsetor');
        $builder->join('funcao fu', 'f.idfuncao = fu.idfuncao');
        $builder->where('f.idfuncionario = ' . $id);
        $query = $builder->get();

        if (empty($query->getResultArray())) {
            return false;
        }

        return $query->getResultArray();
    }
}
